<template>
  <div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-200">
    <Head>
      <title>{{ isEditing ? 'Edit Category' : 'Create Category' }} - DevOps Jungle Admin</title>
    </Head>

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
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
          <div>
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">
              {{ isEditing ? 'Edit Course Category' : 'Create New Category' }}
            </h1>
            <p class="text-gray-600 dark:text-gray-400">
              {{ isEditing ? 'Update category information' : 'Add a new course category' }}
            </p>
          </div>
          <Link
            :href="route('admin.course-categories.index')"
            class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors"
          >
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Categories
          </Link>
        </div>

        <form @submit.prevent="submit" class="max-w-4xl">
          <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content Column -->
            <div class="lg:col-span-2 space-y-6">
              <!-- Basic Information -->
              <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Basic Information</h3>

                <!-- Name -->
                <div class="mb-4">
                  <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Category Name <span class="text-red-500">*</span>
                  </label>
                  <input
                    id="name"
                    v-model="form.name"
                    type="text"
                    required
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    placeholder="e.g., Amazon AWS"
                    @input="generateSlug"
                  />
                  <p v-if="form.errors?.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</p>
                </div>

                <!-- Slug -->
                <div class="mb-4">
                  <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    URL Slug <span class="text-red-500">*</span>
                  </label>
                  <input
                    id="slug"
                    v-model="form.slug"
                    type="text"
                    required
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all font-mono"
                    placeholder="e.g., aws"
                  />
                  <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Used in URLs (lowercase, no spaces)</p>
                  <p v-if="form.errors?.slug" class="text-red-500 text-sm mt-1">{{ form.errors.slug }}</p>
                </div>

                <!-- Description -->
                <div class="mb-4">
                  <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Description
                  </label>
                  <textarea
                    id="description"
                    v-model="form.description"
                    rows="3"
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    placeholder="Brief description about this course category"
                  ></textarea>
                </div>

                <!-- Icon -->
                <div class="mb-4">
                  <label for="icon" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Icon Class
                  </label>
                  <input
                    id="icon"
                    v-model="form.icon"
                    type="text"
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all font-mono"
                    placeholder="e.g., fab fa-aws"
                  />
                  <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                    Font Awesome icon class (e.g., fab fa-aws, fab fa-docker, fab fa-linux)
                  </p>

                  <!-- Icon Preview -->
                  <div v-if="form.icon" class="mt-3 flex items-center space-x-3">
                    <span class="text-gray-600 dark:text-gray-400 text-sm">Preview:</span>
                    <div
                      class="w-12 h-12 rounded-lg flex items-center justify-center"
                      :style="{ backgroundColor: form.color || '#047857' }"
                    >
                      <i :class="form.icon" class="text-white text-2xl"></i>
                    </div>
                  </div>
                </div>

                <!-- Color -->
                <div class="mb-4">
                  <label for="color" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Color
                  </label>
                  <input
                    id="color"
                    v-model="form.color"
                    type="text"
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all font-mono text-sm"
                    placeholder="#047857"
                  />
                  <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Hex color code for category badge/icon</p>

                  <!-- Quick Color Buttons -->
                  <div class="mt-3 space-y-2">
                    <p class="text-xs text-gray-600 dark:text-gray-400">Quick select:</p>
                    <div class="flex flex-wrap gap-2">
                      <button
                        type="button"
                        @click="form.color = '#FF9900'"
                        class="w-12 h-12 rounded-lg border-2 border-gray-300 dark:border-gray-600"
                        style="background-color: #FF9900"
                        title="AWS Orange"
                      ></button>
                      <button
                        type="button"
                        @click="form.color = '#0078D4'"
                        class="w-12 h-12 rounded-lg border-2 border-gray-300 dark:border-gray-600"
                        style="background-color: #0078D4"
                        title="Azure Blue"
                      ></button>
                      <button
                        type="button"
                        @click="form.color = '#4285F4'"
                        class="w-12 h-12 rounded-lg border-2 border-gray-300 dark:border-gray-600"
                        style="background-color: #4285F4"
                        title="Google Blue"
                      ></button>
                      <button
                        type="button"
                        @click="form.color = '#326CE5'"
                        class="w-12 h-12 rounded-lg border-2 border-gray-300 dark:border-gray-600"
                        style="background-color: #326CE5"
                        title="Kubernetes Blue"
                      ></button>
                      <button
                        type="button"
                        @click="form.color = '#2496ED'"
                        class="w-12 h-12 rounded-lg border-2 border-gray-300 dark:border-gray-600"
                        style="background-color: #2496ED"
                        title="Docker Blue"
                      ></button>
                      <button
                        type="button"
                        @click="form.color = '#047857'"
                        class="w-12 h-12 rounded-lg border-2 border-gray-300 dark:border-gray-600"
                        style="background-color: #047857"
                        title="Emerald Green"
                      ></button>
                      <button
                        type="button"
                        @click="form.color = '#7C3AED'"
                        class="w-12 h-12 rounded-lg border-2 border-gray-300 dark:border-gray-600"
                        style="background-color: #7C3AED"
                        title="Purple"
                      ></button>
                      <button
                        type="button"
                        @click="form.color = '#DC2626'"
                        class="w-12 h-12 rounded-lg border-2 border-gray-300 dark:border-gray-600"
                        style="background-color: #DC2626"
                        title="Red"
                      ></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Sidebar Column -->
            <div class="space-y-6">
              <!-- Settings -->
              <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Settings</h3>

                <!-- Active Status -->
                <div class="mb-4">
                  <label class="flex items-center cursor-pointer">
                    <input
                      v-model="form.is_active"
                      type="checkbox"
                      class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500"
                    />
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                      Active Category
                    </span>
                  </label>
                  <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 ml-6">
                    Inactive categories won't be shown in course filters
                  </p>
                </div>

                <!-- Sort Order -->
                <div class="mb-4">
                  <label for="sort_order" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Sort Order
                  </label>
                  <input
                    id="sort_order"
                    v-model.number="form.sort_order"
                    type="number"
                    min="0"
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    placeholder="0"
                  />
                  <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                    Lower numbers appear first
                  </p>
                </div>

                <!-- Submit Button -->
                <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                  <button
                    type="submit"
                    :disabled="form.processing"
                    class="w-full px-4 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-lg font-semibold hover:from-emerald-600 hover:to-emerald-700 transition-all duration-200 disabled:opacity-50"
                  >
                    <i class="fas fa-save mr-2"></i>
                    {{ isEditing ? 'Update' : 'Create' }} Category
                  </button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </main>
  </div>
</template>

<script>
import { Head, Link, useForm } from '@inertiajs/vue3'
import { ref, onMounted } from 'vue'
import Sidebar from '../Common/Sidebar.vue'
import Topbar from '../Common/Topbar.vue'

export default {
  name: 'CourseCategoryForm',
  components: {
    Head,
    Link,
    Sidebar,
    Topbar
  },
  props: {
    category: {
      type: Object,
      default: null
    },
    isEditing: {
      type: Boolean,
      default: false
    }
  },
  setup(props) {
    const sidebarCollapsed = ref(false)
    const isDark = ref(false)

    // Initialize form with category data or defaults
    const form = useForm({
      name: props.category?.name || '',
      slug: props.category?.slug || '',
      icon: props.category?.icon || '',
      description: props.category?.description || '',
      color: props.category?.color || '#047857',
      is_active: props.category?.is_active ?? true,
      sort_order: props.category?.sort_order || 0
    })

    const handleSidebarToggle = () => {
      sidebarCollapsed.value = !sidebarCollapsed.value
    }

    const toggleTheme = () => {
      isDark.value = !isDark.value
      if (isDark.value) {
        document.documentElement.classList.add('dark')
        localStorage.setItem('theme', 'dark')
      } else {
        document.documentElement.classList.remove('dark')
        localStorage.setItem('theme', 'light')
      }
    }

    const generateSlug = () => {
      if (!props.isEditing || !form.slug) {
        form.slug = form.name
          .toLowerCase()
          .replace(/[^a-z0-9]+/g, '-')
          .replace(/^-+|-+$/g, '')
      }
    }

    const submit = () => {
      if (props.isEditing) {
        form.post(route('admin.course-categories.update', props.category.id), {
          preserveScroll: true
        })
      } else {
        form.post(route('admin.course-categories.store'), {
          preserveScroll: true
        })
      }
    }

    // Initialize dark mode
    onMounted(() => {
      const theme = localStorage.getItem('theme')
      if (theme === 'dark') {
        isDark.value = true
        document.documentElement.classList.add('dark')
      }
    })

    return {
      sidebarCollapsed,
      isDark,
      form,
      handleSidebarToggle,
      toggleTheme,
      generateSlug,
      submit,
      route
    }
  }
}
</script>
