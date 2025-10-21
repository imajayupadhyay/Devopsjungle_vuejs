<template>
  <div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-200">
    <Head>
      <title>{{ blog.title }} - DevOps Jungle Admin</title>
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
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">Blog Post Preview</h1>
            <p class="text-gray-600 dark:text-gray-400">Review your blog post content and settings</p>
          </div>
          <div class="flex items-center space-x-3">
            <Link
              :href="route('admin.blogs.edit', blog.id)"
              class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors"
            >
              <i class="fas fa-edit mr-2"></i>
              Edit Post
            </Link>
            <Link
              :href="route('admin.blogs.index')"
              class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors"
            >
              <i class="fas fa-arrow-left mr-2"></i>
              Back to Posts
            </Link>
          </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
          <!-- Main Content -->
          <div class="lg:col-span-2">
            <!-- Blog Content -->
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-8 shadow-sm">
              <!-- Featured Image -->
              <div v-if="blog.featured_image" class="mb-6">
                <img
                  :src="`/storage/${blog.featured_image}`"
                  :alt="blog.title"
                  class="w-full h-64 object-cover rounded-lg"
                />
              </div>

              <!-- Title -->
              <h1 class="text-4xl font-bold text-gray-800 dark:text-white mb-4">{{ blog.title }}</h1>

              <!-- Meta Info -->
              <div class="flex items-center space-x-4 text-sm text-gray-600 dark:text-gray-400 mb-6 pb-6 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center space-x-2">
                  <img
                    :src="blog.author.avatar"
                    :alt="blog.author_name"
                    class="w-8 h-8 rounded-full"
                  />
                  <span>{{ blog.author_name }}</span>
                </div>
                <span>•</span>
                <span>{{ formatDate(blog.created_at) }}</span>
                <span>•</span>
                <span>{{ blog.read_time_formatted }}</span>
                <span>•</span>
                <span>{{ blog.views }} views</span>
              </div>

              <!-- Excerpt -->
              <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg mb-6">
                <p class="text-gray-700 dark:text-gray-300 italic">{{ blog.excerpt }}</p>
              </div>

              <!-- Content -->
              <div class="prose prose-lg dark:prose-invert max-w-none" v-html="blog.content"></div>

              <!-- Tags -->
              <div v-if="blog.tags && blog.tags.length > 0" class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Tags:</h4>
                <div class="flex flex-wrap gap-2">
                  <span
                    v-for="tag in blog.tags"
                    :key="tag"
                    class="px-3 py-1 bg-emerald-100 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-300 text-sm rounded-full"
                  >
                    {{ tag }}
                  </span>
                </div>
              </div>
            </div>
          </div>

          <!-- Sidebar -->
          <div class="space-y-6">
            <!-- Post Status -->
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm">
              <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Post Status</h3>

              <div class="space-y-3">
                <div class="flex justify-between">
                  <span class="text-gray-600 dark:text-gray-400">Status:</span>
                  <span
                    :class="[
                      'px-3 py-1 rounded-full text-xs font-semibold',
                      blog.status === 'published'
                        ? 'bg-green-100 dark:bg-green-900/20 text-green-700 dark:text-green-300'
                        : blog.status === 'draft'
                        ? 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300'
                        : blog.status === 'scheduled'
                        ? 'bg-blue-100 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300'
                        : 'bg-red-100 dark:bg-red-900/20 text-red-700 dark:text-red-300'
                    ]"
                  >
                    {{ formatStatus(blog.status) }}
                  </span>
                </div>

                <div class="flex justify-between">
                  <span class="text-gray-600 dark:text-gray-400">Category:</span>
                  <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 text-xs rounded-full">
                    {{ blog.category }}
                  </span>
                </div>

                <div v-if="blog.featured" class="flex justify-between">
                  <span class="text-gray-600 dark:text-gray-400">Featured:</span>
                  <span class="px-3 py-1 bg-yellow-100 dark:bg-yellow-900/20 text-yellow-700 dark:text-yellow-300 text-xs rounded-full">
                    <i class="fas fa-star mr-1"></i>
                    Featured
                  </span>
                </div>

                <div v-if="blog.sticky" class="flex justify-between">
                  <span class="text-gray-600 dark:text-gray-400">Sticky:</span>
                  <span class="px-3 py-1 bg-purple-100 dark:bg-purple-900/20 text-purple-700 dark:text-purple-300 text-xs rounded-full">
                    <i class="fas fa-thumbtack mr-1"></i>
                    Sticky
                  </span>
                </div>
              </div>
            </div>

            <!-- SEO Information -->
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm">
              <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">SEO Information</h3>

              <div class="space-y-3">
                <div>
                  <label class="text-sm font-medium text-gray-600 dark:text-gray-400">Meta Title:</label>
                  <p class="text-gray-800 dark:text-white">{{ blog.seo_title }}</p>
                </div>

                <div>
                  <label class="text-sm font-medium text-gray-600 dark:text-gray-400">Meta Description:</label>
                  <p class="text-gray-800 dark:text-white">{{ blog.seo_description }}</p>
                </div>

                <div v-if="blog.meta_keywords">
                  <label class="text-sm font-medium text-gray-600 dark:text-gray-400">Keywords:</label>
                  <p class="text-gray-800 dark:text-white">{{ blog.meta_keywords }}</p>
                </div>

                <div>
                  <label class="text-sm font-medium text-gray-600 dark:text-gray-400">URL Slug:</label>
                  <p class="text-gray-800 dark:text-white font-mono text-sm">/blog/{{ blog.slug }}</p>
                </div>
              </div>
            </div>

            <!-- Author Information -->
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm">
              <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Author Information</h3>

              <div class="flex items-start space-x-3">
                <img
                  :src="blog.author.avatar"
                  :alt="blog.author_name"
                  class="w-12 h-12 rounded-full"
                />
                <div>
                  <h4 class="font-semibold text-gray-800 dark:text-white">{{ blog.author_name }}</h4>
                  <p class="text-sm text-gray-600 dark:text-gray-400">{{ blog.author_role }}</p>
                  <p v-if="blog.author_bio" class="text-sm text-gray-700 dark:text-gray-300 mt-2">{{ blog.author_bio }}</p>
                </div>
              </div>
            </div>

            <!-- Publishing Information -->
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm">
              <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Publishing Information</h3>

              <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                  <span class="text-gray-600 dark:text-gray-400">Created:</span>
                  <span class="text-gray-800 dark:text-white">{{ formatDate(blog.created_at) }}</span>
                </div>

                <div class="flex justify-between">
                  <span class="text-gray-600 dark:text-gray-400">Updated:</span>
                  <span class="text-gray-800 dark:text-white">{{ formatDate(blog.updated_at) }}</span>
                </div>

                <div v-if="blog.published_at" class="flex justify-between">
                  <span class="text-gray-600 dark:text-gray-400">Published:</span>
                  <span class="text-gray-800 dark:text-white">{{ formatDate(blog.published_at) }}</span>
                </div>

                <div v-if="blog.scheduled_at" class="flex justify-between">
                  <span class="text-gray-600 dark:text-gray-400">Scheduled:</span>
                  <span class="text-gray-800 dark:text-white">{{ formatDate(blog.scheduled_at) }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3'
import { ref, onMounted } from 'vue'
import Sidebar from '../Common/Sidebar.vue'
import Topbar from '../Common/Topbar.vue'

export default {
  name: 'BlogShow',
  components: {
    Head,
    Link,
    Sidebar,
    Topbar
  },
  props: {
    blog: {
      type: Object,
      required: true
    }
  },
  setup() {
    const sidebarCollapsed = ref(false)
    const isDark = ref(false)

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

    const handleSidebarToggle = (collapsed) => {
      sidebarCollapsed.value = collapsed
    }

    const formatDate = (date) => {
      return new Date(date).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
      })
    }

    const formatStatus = (status) => {
      const statusMap = {
        published: 'Published',
        draft: 'Draft',
        scheduled: 'Scheduled',
        archived: 'Archived'
      }
      return statusMap[status] || status
    }

    return {
      sidebarCollapsed,
      isDark,
      handleSidebarToggle,
      toggleTheme,
      formatDate,
      formatStatus
    }
  }
}
</script>

<style scoped>
.prose {
  color: inherit;
}

.prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
  color: inherit;
}

.prose a {
  color: #10b981;
  text-decoration: none;
}

.prose a:hover {
  text-decoration: underline;
}

.prose code {
  background-color: #f3f4f6;
  padding: 0.125rem 0.25rem;
  border-radius: 0.25rem;
  font-size: 0.875em;
}

.dark .prose code {
  background-color: #374151;
}

.prose pre {
  background-color: #1f2937;
  color: #f9fafb;
  padding: 1rem;
  border-radius: 0.5rem;
  overflow-x: auto;
}
</style>