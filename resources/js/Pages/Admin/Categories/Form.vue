<template>
  <div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-200">
    <Head :title="isEditing ? 'Edit Category' : 'Create Category'" />

    <!-- Sidebar -->
    <Sidebar
      :userName="$page.props.auth?.user?.name || 'Admin'"
      :userAvatar="$page.props.auth?.user?.avatar_url || 'https://ui-avatars.com/api/?name=Admin&background=047857&color=fff'"
      @toggle="handleSidebarToggle"
    />

    <!-- Topbar -->
    <Topbar
      :sidebarCollapsed="sidebarCollapsed"
      :userName="$page.props.auth?.user?.name || 'Admin'"
      :userEmail="$page.props.auth?.user?.email || 'admin@example.com'"
      :userAvatar="$page.props.auth?.user?.avatar_url || 'https://ui-avatars.com/api/?name=Admin&background=047857&color=fff'"
      :isDark="isDark"
      @toggle-theme="toggleTheme"
    />

    <!-- Main Content -->
    <main
      :class="[
        'pt-16 transition-all duration-300 min-h-screen',
        sidebarCollapsed ? 'ml-20' : 'ml-64'
      ]"
    >
      <div class="p-6">
      <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
          <div class="flex items-center justify-between">
            <div>
              <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                {{ isEditing ? 'Edit Category' : 'Create Category' }}
              </h2>
              <p class="mt-2 text-gray-600 dark:text-gray-400">
                {{ isEditing ? 'Update category information' : 'Add a new category to organize your content' }}
              </p>
            </div>
            <Link
              :href="route('admin.categories.index')"
              class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg transition duration-200"
            >
              <i class="fas fa-arrow-left mr-2"></i>
              Back to Categories
            </Link>
          </div>
        </div>

        <form @submit.prevent="submit" class="space-y-8">
          <!-- Basic Information -->
          <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-600">
              <h3 class="text-lg font-medium text-gray-900 dark:text-white">Basic Information</h3>
            </div>
            <div class="p-6 space-y-6">
              <!-- Name and Slug -->
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                  <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Category Name *
                  </label>
                  <input
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                    :class="{ 'border-red-500': form.errors.name }"
                    placeholder="Enter category name"
                    @input="generateSlug"
                  />
                  <p v-if="form.errors.name" class="mt-1 text-sm text-red-600 dark:text-red-400">
                    {{ form.errors.name }}
                  </p>
                </div>

                <div>
                  <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Slug
                  </label>
                  <input
                    id="slug"
                    v-model="form.slug"
                    type="text"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                    :class="{ 'border-red-500': form.errors.slug }"
                    placeholder="category-slug"
                  />
                  <p v-if="form.errors.slug" class="mt-1 text-sm text-red-600 dark:text-red-400">
                    {{ form.errors.slug }}
                  </p>
                  <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Leave empty to auto-generate from name
                  </p>
                </div>
              </div>

              <!-- Description -->
              <div>
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Description
                </label>
                <textarea
                  id="description"
                  v-model="form.description"
                  rows="4"
                  class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                  :class="{ 'border-red-500': form.errors.description }"
                  placeholder="Brief description of this category"
                />
                <p v-if="form.errors.description" class="mt-1 text-sm text-red-600 dark:text-red-400">
                  {{ form.errors.description }}
                </p>
              </div>
            </div>
          </div>

          <!-- Visual Settings -->
          <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-600">
              <h3 class="text-lg font-medium text-gray-900 dark:text-white">Visual Settings</h3>
            </div>
            <div class="p-6 space-y-6">
              <!-- Color and Icon -->
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                  <label for="color" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Color *
                  </label>
                  <div class="flex items-center space-x-3">
                    <input
                      id="color"
                      v-model="form.color"
                      type="color"
                      class="w-12 h-10 border border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer"
                      :class="{ 'border-red-500': form.errors.color }"
                    />
                    <input
                      v-model="form.color"
                      type="text"
                      class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                      :class="{ 'border-red-500': form.errors.color }"
                      placeholder="#10b981"
                    />
                  </div>
                  <p v-if="form.errors.color" class="mt-1 text-sm text-red-600 dark:text-red-400">
                    {{ form.errors.color }}
                  </p>
                </div>

                <div>
                  <label for="icon" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Icon Class
                  </label>
                  <div class="flex items-center space-x-3">
                    <div
                      class="w-10 h-10 rounded-lg flex items-center justify-center border border-gray-300 dark:border-gray-600"
                      :style="`background-color: ${form.color}20; border-color: ${form.color}40`"
                    >
                      <i
                        :class="form.icon || 'fas fa-folder'"
                        :style="`color: ${form.color}`"
                      ></i>
                    </div>
                    <input
                      id="icon"
                      v-model="form.icon"
                      type="text"
                      class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                      :class="{ 'border-red-500': form.errors.icon }"
                      placeholder="fas fa-folder"
                    />
                  </div>
                  <p v-if="form.errors.icon" class="mt-1 text-sm text-red-600 dark:text-red-400">
                    {{ form.errors.icon }}
                  </p>
                  <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Font Awesome class (e.g., fas fa-folder)
                  </p>
                </div>
              </div>

              <!-- Image Upload -->
              <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Category Image
                </label>
                <div class="flex items-center space-x-6">
                  <!-- Current Image -->
                  <div v-if="currentImage || form.image" class="flex-shrink-0">
                    <img
                      :src="currentImage || (category?.image ? `/storage/${category.image}` : null)"
                      alt="Category image"
                      class="w-20 h-20 object-cover rounded-lg border border-gray-300 dark:border-gray-600"
                    />
                  </div>

                  <!-- Upload Button -->
                  <div class="flex-1">
                    <input
                      ref="imageInput"
                      type="file"
                      accept="image/*"
                      class="hidden"
                      @change="handleImageUpload"
                    />
                    <button
                      type="button"
                      @click="$refs.imageInput.click()"
                      class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 transition duration-200"
                    >
                      <i class="fas fa-image mr-2"></i>
                      {{ currentImage || category?.image ? 'Change Image' : 'Upload Image' }}
                    </button>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                      JPG, PNG up to 2MB
                    </p>
                  </div>
                </div>
                <p v-if="form.errors.image" class="mt-1 text-sm text-red-600 dark:text-red-400">
                  {{ form.errors.image }}
                </p>
              </div>
            </div>
          </div>

          <!-- Settings -->
          <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-600">
              <h3 class="text-lg font-medium text-gray-900 dark:text-white">Settings</h3>
            </div>
            <div class="p-6 space-y-6">
              <!-- Status and Sort Order -->
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Status
                  </label>
                  <div class="flex items-center">
                    <input
                      id="is_active"
                      v-model="form.is_active"
                      type="checkbox"
                      class="h-4 w-4 text-emerald-600 border-gray-300 dark:border-gray-600 rounded focus:ring-emerald-500"
                    />
                    <label for="is_active" class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                      Active
                    </label>
                  </div>
                  <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Only active categories will be visible to users
                  </p>
                </div>

                <div>
                  <label for="sort_order" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Sort Order
                  </label>
                  <input
                    id="sort_order"
                    v-model="form.sort_order"
                    type="number"
                    min="0"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                    :class="{ 'border-red-500': form.errors.sort_order }"
                    placeholder="0"
                  />
                  <p v-if="form.errors.sort_order" class="mt-1 text-sm text-red-600 dark:text-red-400">
                    {{ form.errors.sort_order }}
                  </p>
                  <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Lower numbers appear first
                  </p>
                </div>
              </div>
            </div>
          </div>

          <!-- SEO Settings -->
          <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-600">
              <h3 class="text-lg font-medium text-gray-900 dark:text-white">SEO Settings</h3>
            </div>
            <div class="p-6 space-y-6">
              <!-- Meta Title -->
              <div>
                <label for="meta_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Meta Title
                </label>
                <input
                  id="meta_title"
                  v-model="form.meta_title"
                  type="text"
                  maxlength="70"
                  class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                  :class="{ 'border-red-500': form.errors.meta_title }"
                  placeholder="SEO title for search engines"
                />
                <div class="flex justify-between mt-1">
                  <p v-if="form.errors.meta_title" class="text-sm text-red-600 dark:text-red-400">
                    {{ form.errors.meta_title }}
                  </p>
                  <p class="text-sm text-gray-500 dark:text-gray-400">
                    {{ form.meta_title?.length || 0 }}/70 characters
                  </p>
                </div>
              </div>

              <!-- Meta Description -->
              <div>
                <label for="meta_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Meta Description
                </label>
                <textarea
                  id="meta_description"
                  v-model="form.meta_description"
                  rows="3"
                  maxlength="160"
                  class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                  :class="{ 'border-red-500': form.errors.meta_description }"
                  placeholder="Brief description for search engine results"
                />
                <div class="flex justify-between mt-1">
                  <p v-if="form.errors.meta_description" class="text-sm text-red-600 dark:text-red-400">
                    {{ form.errors.meta_description }}
                  </p>
                  <p class="text-sm text-gray-500 dark:text-gray-400">
                    {{ form.meta_description?.length || 0 }}/160 characters
                  </p>
                </div>
              </div>

              <!-- Meta Keywords -->
              <div>
                <label for="meta_keywords" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Meta Keywords
                </label>
                <input
                  id="meta_keywords"
                  v-model="form.meta_keywords"
                  type="text"
                  class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                  :class="{ 'border-red-500': form.errors.meta_keywords }"
                  placeholder="keyword1, keyword2, keyword3"
                />
                <p v-if="form.errors.meta_keywords" class="mt-1 text-sm text-red-600 dark:text-red-400">
                  {{ form.errors.meta_keywords }}
                </p>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                  Separate keywords with commas
                </p>
              </div>
            </div>
          </div>

          <!-- Form Actions -->
          <div class="flex items-center justify-end space-x-4">
            <Link
              :href="route('admin.categories.index')"
              class="px-6 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200"
            >
              Cancel
            </Link>
            <button
              type="submit"
              :disabled="form.processing"
              class="px-6 py-2 bg-emerald-600 hover:bg-emerald-700 disabled:bg-emerald-400 text-white rounded-lg transition duration-200 flex items-center"
            >
              <svg v-if="form.processing" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              {{ isEditing ? 'Update Category' : 'Create Category' }}
            </button>
          </div>
        </form>
      </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
// Using Font Awesome icons for consistency
import Sidebar from '../Common/Sidebar.vue'
import Topbar from '../Common/Topbar.vue'

const props = defineProps({
  category: Object,
  isEditing: Boolean
})

const sidebarCollapsed = ref(false)
const isDark = ref(false)
const imageInput = ref(null)
const currentImage = ref(null)

const form = useForm({
  name: props.category?.name || '',
  slug: props.category?.slug || '',
  description: props.category?.description || '',
  color: props.category?.color || '#10b981',
  icon: props.category?.icon || 'fas fa-folder',
  image: null,
  is_active: props.category?.is_active ?? true,
  sort_order: props.category?.sort_order || '',
  meta_title: props.category?.meta_title || '',
  meta_description: props.category?.meta_description || '',
  meta_keywords: props.category?.meta_keywords || ''
})

const generateSlug = () => {
  if (!props.isEditing || !form.slug) {
    form.slug = form.name
      .toLowerCase()
      .replace(/[^a-z0-9\s-]/g, '')
      .replace(/\s+/g, '-')
      .replace(/-+/g, '-')
      .trim()
  }
}

const handleImageUpload = (event) => {
  const file = event.target.files[0]
  if (file) {
    form.image = file

    // Create preview
    const reader = new FileReader()
    reader.onload = (e) => {
      currentImage.value = e.target.result
    }
    reader.readAsDataURL(file)
  }
}

const submit = () => {
  if (props.isEditing) {
    form.patch(route('admin.categories.update', props.category.id))
  } else {
    form.post(route('admin.categories.store'))
  }
}

const handleSidebarToggle = (collapsed) => {
  sidebarCollapsed.value = collapsed
}

const toggleTheme = () => {
  isDark.value = !isDark.value
  if (isDark.value) {
    document.documentElement.classList.add('dark')
  } else {
    document.documentElement.classList.remove('dark')
  }
  localStorage.setItem('admin-theme', isDark.value ? 'dark' : 'light')
}

onMounted(() => {
  const savedTheme = localStorage.getItem('admin-theme')
  if (savedTheme === 'dark') {
    isDark.value = true
    document.documentElement.classList.add('dark')
  }
})
</script>