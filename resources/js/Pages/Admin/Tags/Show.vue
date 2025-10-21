<template>
  <div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-200">
    <Head :title="`Tag: ${tag.name}`" />

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
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
          <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
              <Link
                :href="route('admin.tags.index')"
                class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white"
              >
                <i class="fas fa-arrow-left"></i>
              </Link>
              <div>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">{{ tag.name }}</h2>
                <p class="mt-2 text-gray-600 dark:text-gray-400">Tag details and blog posts</p>
              </div>
            </div>
            <div class="flex space-x-3">
              <Link
                :href="route('admin.tags.edit', tag.id)"
                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition duration-200"
              >
                <i class="fas fa-edit mr-2"></i>
                Edit Tag
              </Link>
              <button
                @click="toggleStatus"
                :class="[
                  'inline-flex items-center px-4 py-2 text-white text-sm font-medium rounded-lg transition duration-200',
                  tag.is_active
                    ? 'bg-red-600 hover:bg-red-700'
                    : 'bg-green-600 hover:bg-green-700'
                ]"
              >
                {{ tag.is_active ? 'Deactivate' : 'Activate' }}
              </button>
            </div>
          </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
          <!-- Tag Details -->
          <div class="lg:col-span-1">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
              <div class="p-6">
                <!-- Tag Visual -->
                <div class="text-center mb-6">
                  <div
                    class="inline-flex px-6 py-3 rounded-full text-lg font-medium mb-4"
                    :style="`background-color: ${tag.color}20; color: ${tag.color}; border: 2px solid ${tag.color}40`"
                  >
                    {{ tag.name }}
                  </div>
                  <p class="text-gray-600 dark:text-gray-400">{{ tag.slug }}</p>
                </div>

                <!-- Description -->
                <div v-if="tag.description" class="mb-6">
                  <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</h4>
                  <p class="text-gray-600 dark:text-gray-400">{{ tag.description }}</p>
                </div>

                <!-- Status and Stats -->
                <div class="space-y-4">
                  <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Status</span>
                    <span
                      :class="[
                        'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium',
                        tag.is_active
                          ? 'bg-green-100 dark:bg-green-900/20 text-green-800 dark:text-green-300'
                          : 'bg-red-100 dark:bg-red-900/20 text-red-800 dark:text-red-300'
                      ]"
                    >
                      {{ tag.is_active ? 'Active' : 'Inactive' }}
                    </span>
                  </div>

                  <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Total Posts</span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/20 text-blue-800 dark:text-blue-300">
                      {{ tag.posts_count || 0 }}
                    </span>
                  </div>

                  <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Color</span>
                    <div class="flex items-center space-x-2">
                      <div
                        class="w-4 h-4 rounded-full border border-gray-300 dark:border-gray-600"
                        :style="`background-color: ${tag.color}`"
                      ></div>
                      <span class="text-sm text-gray-600 dark:text-gray-400">{{ tag.color }}</span>
                    </div>
                  </div>

                  <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Created</span>
                    <span class="text-sm text-gray-600 dark:text-gray-400">
                      {{ new Date(tag.created_at).toLocaleDateString() }}
                    </span>
                  </div>

                  <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Last Updated</span>
                    <span class="text-sm text-gray-600 dark:text-gray-400">
                      {{ new Date(tag.updated_at).toLocaleDateString() }}
                    </span>
                  </div>
                </div>

                <!-- SEO Information -->
                <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-600">
                  <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-4">SEO Information</h4>

                  <div v-if="tag.meta_title" class="mb-3">
                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Meta Title</label>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ tag.meta_title }}</p>
                  </div>

                  <div v-if="tag.meta_description">
                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Meta Description</label>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ tag.meta_description }}</p>
                  </div>

                  <div v-if="!tag.meta_title && !tag.meta_description" class="text-sm text-gray-500 dark:text-gray-400 italic">
                    No SEO information provided
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Blog Posts -->
          <div class="lg:col-span-2">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
              <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                <div class="flex items-center justify-between">
                  <h3 class="text-lg font-medium text-gray-900 dark:text-white">Recent Blog Posts</h3>
                  <Link
                    :href="route('admin.blogs.create', { tag: tag.id })"
                    class="inline-flex items-center px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm rounded-lg transition duration-200"
                  >
                    <i class="fas fa-plus mr-1"></i>
                    Add Post
                  </Link>
                </div>
              </div>

              <div class="p-6">
                <div v-if="tag.blogs && tag.blogs.length > 0" class="space-y-4">
                  <div
                    v-for="blog in tag.blogs"
                    :key="blog.id"
                    class="flex items-start space-x-4 p-4 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200"
                  >
                    <!-- Featured Image -->
                    <div v-if="blog.featured_image" class="flex-shrink-0">
                      <img
                        :src="`/storage/${blog.featured_image}`"
                        :alt="blog.title"
                        class="w-16 h-16 object-cover rounded-lg"
                      />
                    </div>
                    <div v-else class="flex-shrink-0 w-16 h-16 bg-gray-200 dark:bg-gray-600 rounded-lg flex items-center justify-center">
                      <i class="fas fa-file-text text-gray-400 text-2xl"></i>
                    </div>

                    <!-- Blog Info -->
                    <div class="flex-1 min-w-0">
                      <h4 class="text-sm font-medium text-gray-900 dark:text-white truncate">
                        {{ blog.title }}
                      </h4>
                      <p class="text-sm text-gray-600 dark:text-gray-400 mt-1 line-clamp-2">
                        {{ blog.excerpt }}
                      </p>
                      <div class="flex items-center mt-2 space-x-4 text-xs text-gray-500 dark:text-gray-400">
                        <span>{{ blog.author_name }}</span>
                        <span>{{ new Date(blog.created_at).toLocaleDateString() }}</span>
                        <span v-if="blog.category" class="flex items-center">
                          <div
                            class="w-2 h-2 rounded-full mr-1"
                            :style="`background-color: ${blog.category.color}`"
                          ></div>
                          {{ blog.category.name }}
                        </span>
                        <span
                          :class="[
                            'px-2 py-0.5 rounded-full',
                            blog.status === 'published'
                              ? 'bg-green-100 dark:bg-green-900/20 text-green-600 dark:text-green-400'
                              : blog.status === 'draft'
                              ? 'bg-gray-100 dark:bg-gray-900/20 text-gray-600 dark:text-gray-400'
                              : 'bg-blue-100 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400'
                          ]"
                        >
                          {{ blog.status }}
                        </span>
                      </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex-shrink-0 flex items-center space-x-2">
                      <Link
                        :href="route('admin.blogs.edit', blog.id)"
                        class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300"
                      >
                        <i class="fas fa-edit"></i>
                      </Link>
                      <Link
                        :href="route('admin.blogs.show', blog.id)"
                        class="text-emerald-600 dark:text-emerald-400 hover:text-emerald-900 dark:hover:text-emerald-300"
                      >
                        <i class="fas fa-eye"></i>
                      </Link>
                    </div>
                  </div>
                </div>

                <div v-else class="text-center py-12">
                  <i class="fas fa-tags text-gray-400 text-3xl mx-auto mb-4"></i>
                  <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No blog posts yet</h3>
                  <p class="text-gray-600 dark:text-gray-400 mb-4">
                    This tag hasn't been used in any blog posts yet.
                  </p>
                  <Link
                    :href="route('admin.blogs.create', { tag: tag.id })"
                    class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition duration-200"
                  >
                    <i class="fas fa-plus mr-2"></i>
                    Create First Post
                  </Link>
                </div>

                <!-- View All Posts Link -->
                <div v-if="tag.blogs && tag.blogs.length > 0" class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-600 text-center">
                  <Link
                    :href="route('admin.blogs.index', { tag: tag.id })"
                    class="text-emerald-600 dark:text-emerald-400 hover:text-emerald-900 dark:hover:text-emerald-300 text-sm font-medium"
                  >
                    View all posts with this tag →
                  </Link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import { Head, Link, router } from '@inertiajs/vue3'
import { ref, onMounted } from 'vue'
// Using Font Awesome icons for consistency
import Sidebar from '../Common/Sidebar.vue'
import Topbar from '../Common/Topbar.vue'

const props = defineProps({
  tag: Object
})

const sidebarCollapsed = ref(false)
const isDark = ref(false)

const toggleStatus = () => {
  router.patch(route('admin.tags.toggle-status', props.tag.id), {}, {
    preserveScroll: true
  })
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