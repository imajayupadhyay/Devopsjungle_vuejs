<template>
  <div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-200">
    <Head>
      <title>Blog Management - DevOps Jungle Admin</title>
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
        <!-- Header Section -->
        <div class="mb-6">
          <div class="flex items-center justify-between mb-4">
            <div>
              <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">Blog Management</h1>
              <p class="text-gray-600 dark:text-gray-400">Create and manage blog posts</p>
            </div>
            <Link
              :href="route('admin.blogs.create')"
              class="px-6 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-lg font-semibold hover:from-emerald-600 hover:to-emerald-700 transition-all duration-200 flex items-center space-x-2 shadow-lg"
            >
              <i class="fas fa-plus"></i>
              <span>Create New Post</span>
            </Link>
          </div>

          <!-- Stats Cards -->
          <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-4 shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-600 dark:text-gray-400 text-sm">Total Posts</p>
                  <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ stats.total }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/20 rounded-lg flex items-center justify-center">
                  <i class="fas fa-blog text-blue-600 dark:text-blue-400 text-xl"></i>
                </div>
              </div>
            </div>
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-4 shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-600 dark:text-gray-400 text-sm">Published</p>
                  <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ stats.published }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 dark:bg-green-900/20 rounded-lg flex items-center justify-center">
                  <i class="fas fa-check-circle text-green-600 dark:text-green-400 text-xl"></i>
                </div>
              </div>
            </div>
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-4 shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-600 dark:text-gray-400 text-sm">Drafts</p>
                  <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ stats.draft }}</p>
                </div>
                <div class="w-12 h-12 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                  <i class="fas fa-edit text-gray-600 dark:text-gray-400 text-xl"></i>
                </div>
              </div>
            </div>
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-4 shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-600 dark:text-gray-400 text-sm">Scheduled</p>
                  <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ stats.scheduled }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/20 rounded-lg flex items-center justify-center">
                  <i class="fas fa-clock text-purple-600 dark:text-purple-400 text-xl"></i>
                </div>
              </div>
            </div>
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-4 shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-600 dark:text-gray-400 text-sm">Featured</p>
                  <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ stats.featured }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900/20 rounded-lg flex items-center justify-center">
                  <i class="fas fa-star text-yellow-600 dark:text-yellow-400 text-xl"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Filters and Search -->
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-4 mb-6 shadow-sm">
          <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <!-- Search -->
            <div class="relative flex-1 max-w-md">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400"></i>
              </div>
              <input
                v-model="searchQuery"
                type="text"
                placeholder="Search posts..."
                class="w-full pl-10 pr-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                @input="debouncedSearch"
              />
            </div>

            <!-- Filter Buttons -->
            <div class="flex flex-wrap items-center gap-2">
              <button
                v-for="filter in statusFilters"
                :key="filter.value"
                @click="updateFilter('status', filter.value)"
                :class="[
                  'px-4 py-2 rounded-lg font-medium transition-all duration-200',
                  filters.status === filter.value
                    ? 'bg-emerald-600 text-white'
                    : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600'
                ]"
              >
                {{ filter.label }}
              </button>
            </div>

            <!-- Category Filter -->
            <select
              v-model="filters.category"
              @change="updateFilter('category', $event.target.value)"
              class="px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500"
            >
              <option value="all">All Categories</option>
              <option v-for="category in categories" :key="category" :value="category">
                {{ category }}
              </option>
            </select>
          </div>
        </div>

        <!-- Bulk Actions -->
        <div v-if="selectedBlogs.length > 0" class="bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-xl p-4 mb-6">
          <div class="flex items-center justify-between">
            <span class="text-emerald-700 dark:text-emerald-300 font-medium">
              {{ selectedBlogs.length }} post(s) selected
            </span>
            <div class="flex items-center space-x-2">
              <button
                @click="bulkAction('publish')"
                class="px-3 py-1 bg-green-600 text-white rounded-lg text-sm hover:bg-green-700 transition-colors"
              >
                Publish
              </button>
              <button
                @click="bulkAction('unpublish')"
                class="px-3 py-1 bg-gray-600 text-white rounded-lg text-sm hover:bg-gray-700 transition-colors"
              >
                Unpublish
              </button>
              <button
                @click="bulkAction('feature')"
                class="px-3 py-1 bg-yellow-600 text-white rounded-lg text-sm hover:bg-yellow-700 transition-colors"
              >
                Feature
              </button>
              <button
                @click="bulkAction('delete')"
                class="px-3 py-1 bg-red-600 text-white rounded-lg text-sm hover:bg-red-700 transition-colors"
              >
                Delete
              </button>
            </div>
          </div>
        </div>

        <!-- Blogs Table -->
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden shadow-sm">
          <div class="overflow-x-auto">
            <table class="w-full">
              <thead class="bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                <tr>
                  <th class="px-6 py-4 text-left">
                    <input
                      type="checkbox"
                      :checked="allSelected"
                      @change="toggleSelectAll"
                      class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500"
                    />
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                    Post
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                    Author
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                    Category
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                    Status
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                    Date
                  </th>
                  <th class="px-6 py-4 text-right text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                    Actions
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                <tr
                  v-for="blog in blogs.data"
                  :key="blog.id"
                  class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
                >
                  <td class="px-6 py-4">
                    <input
                      type="checkbox"
                      :checked="selectedBlogs.includes(blog.id)"
                      @change="toggleSelect(blog.id)"
                      class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500"
                    />
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex items-start space-x-3">
                      <img
                        v-if="blog.featured_image"
                        :src="`/storage/${blog.featured_image}`"
                        :alt="blog.title"
                        class="w-16 h-12 object-cover rounded-lg"
                      />
                      <div class="w-16 h-12 bg-gray-200 dark:bg-gray-600 rounded-lg flex items-center justify-center" v-else>
                        <i class="fas fa-image text-gray-400"></i>
                      </div>
                      <div class="flex-1 min-w-0">
                        <p class="text-gray-800 dark:text-white font-medium line-clamp-1">{{ blog.title }}</p>
                        <p class="text-gray-500 dark:text-gray-400 text-sm line-clamp-2 mt-1">{{ blog.excerpt }}</p>
                        <div class="flex items-center space-x-2 mt-2">
                          <span v-if="blog.featured" class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 dark:bg-yellow-900/20 text-yellow-800 dark:text-yellow-300">
                            <i class="fas fa-star mr-1"></i>
                            Featured
                          </span>
                          <span v-if="blog.sticky" class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 dark:bg-purple-900/20 text-purple-800 dark:text-purple-300">
                            <i class="fas fa-thumbtack mr-1"></i>
                            Sticky
                          </span>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex items-center space-x-2">
                      <img
                        :src="blog.author.avatar"
                        :alt="blog.author.name"
                        class="w-8 h-8 rounded-full"
                      />
                      <div>
                        <p class="text-gray-800 dark:text-white font-medium">{{ blog.author.name }}</p>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">{{ blog.author.role }}</p>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300">
                      {{ blog.category_name }}
                    </span>
                  </td>
                  <td class="px-6 py-4">
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
                  </td>
                  <td class="px-6 py-4">
                    <div>
                      <p class="text-gray-700 dark:text-gray-300 text-sm">{{ formatDate(blog.created_at) }}</p>
                      <p v-if="blog.published_at" class="text-gray-500 dark:text-gray-400 text-xs">
                        Published: {{ formatDate(blog.published_at) }}
                      </p>
                    </div>
                  </td>
                  <td class="px-6 py-4 text-right">
                    <div class="flex items-center justify-end space-x-2">
                      <!-- View -->
                      <Link
                        :href="route('admin.blogs.show', blog.id)"
                        class="p-2 text-blue-600 dark:text-blue-400 hover:bg-blue-100 dark:hover:bg-blue-900/20 rounded-lg transition-all duration-200"
                        title="View Post"
                      >
                        <i class="fas fa-eye"></i>
                      </Link>

                      <!-- Edit -->
                      <Link
                        :href="route('admin.blogs.edit', blog.id)"
                        class="p-2 text-emerald-600 dark:text-emerald-400 hover:bg-emerald-100 dark:hover:bg-emerald-900/20 rounded-lg transition-all duration-200"
                        title="Edit Post"
                      >
                        <i class="fas fa-edit"></i>
                      </Link>

                      <!-- Status Actions -->
                      <button
                        v-if="blog.status === 'draft'"
                        @click="publishPost(blog)"
                        class="p-2 text-green-600 dark:text-green-400 hover:bg-green-100 dark:hover:bg-green-900/20 rounded-lg transition-all duration-200"
                        title="Publish"
                      >
                        <i class="fas fa-paper-plane"></i>
                      </button>

                      <button
                        v-if="blog.status === 'published'"
                        @click="unpublishPost(blog)"
                        class="p-2 text-orange-600 dark:text-orange-400 hover:bg-orange-100 dark:hover:bg-orange-900/20 rounded-lg transition-all duration-200"
                        title="Unpublish"
                      >
                        <i class="fas fa-pause"></i>
                      </button>

                      <!-- Toggle Featured -->
                      <button
                        @click="toggleFeatured(blog)"
                        :class="[
                          'p-2 rounded-lg transition-all duration-200',
                          blog.featured
                            ? 'text-yellow-600 dark:text-yellow-400 hover:bg-yellow-100 dark:hover:bg-yellow-900/20'
                            : 'text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700'
                        ]"
                        :title="blog.featured ? 'Remove from Featured' : 'Mark as Featured'"
                      >
                        <i class="fas fa-star"></i>
                      </button>

                      <!-- Duplicate -->
                      <button
                        @click="duplicatePost(blog)"
                        class="p-2 text-purple-600 dark:text-purple-400 hover:bg-purple-100 dark:hover:bg-purple-900/20 rounded-lg transition-all duration-200"
                        title="Duplicate"
                      >
                        <i class="fas fa-copy"></i>
                      </button>

                      <!-- Delete -->
                      <button
                        @click="confirmDelete(blog)"
                        class="p-2 text-red-600 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-900/20 rounded-lg transition-all duration-200"
                        title="Delete"
                      >
                        <i class="fas fa-trash"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Pagination -->
          <div v-if="blogs.data.length > 0" class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800">
            <div class="flex items-center justify-between">
              <p class="text-gray-600 dark:text-gray-400 text-sm">
                Showing {{ blogs.from }} to {{ blogs.to }} of {{ blogs.total }} posts
              </p>
              <div class="flex items-center space-x-2">
                <template v-for="link in blogs.links" :key="link.label">
                  <Link
                    v-if="link.url"
                    :href="link.url"
                    :class="[
                      'px-3 py-1 rounded-lg text-sm transition-all duration-200',
                      link.active
                        ? 'bg-emerald-600 text-white'
                        : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600'
                    ]"
                    v-html="link.label"
                  ></Link>
                  <span
                    v-else
                    :class="[
                      'px-3 py-1 rounded-lg text-sm bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-600 cursor-not-allowed'
                    ]"
                    v-html="link.label"
                  ></span>
                </template>
              </div>
            </div>
          </div>

          <!-- Empty State -->
          <div v-if="blogs.data.length === 0" class="px-6 py-12 text-center">
            <i class="fas fa-blog text-gray-400 dark:text-gray-600 text-5xl mb-4"></i>
            <p class="text-gray-600 dark:text-gray-400 text-lg">No blog posts found</p>
            <p class="text-gray-500 dark:text-gray-500 text-sm mt-2">Try adjusting your search or filters</p>
          </div>
        </div>
      </div>
    </main>

    <!-- Delete Confirmation Modal -->
    <ConfirmModal
      :show="showDeleteModal"
      title="Delete Blog Post"
      message="Are you sure you want to delete this blog post? This action cannot be undone."
      @confirm="deleteBlog"
      @cancel="closeDeleteModal"
    />
  </div>
</template>

<script>
import { Head, Link, router } from '@inertiajs/vue3'
import { ref, onMounted, computed } from 'vue'
import Sidebar from '../Common/Sidebar.vue'
import Topbar from '../Common/Topbar.vue'
import ConfirmModal from '../Common/ConfirmModal.vue'

export default {
  name: 'BlogsIndex',
  components: {
    Head,
    Link,
    Sidebar,
    Topbar,
    ConfirmModal
  },
  props: {
    blogs: {
      type: Object,
      required: true
    },
    filters: {
      type: Object,
      default: () => ({
        search: '',
        status: 'all',
        category: 'all',
        featured: '',
        sort_by: 'created_at',
        sort_order: 'desc'
      })
    },
    stats: {
      type: Object,
      default: () => ({})
    },
    categories: {
      type: Array,
      default: () => []
    }
  },
  setup(props) {
    const sidebarCollapsed = ref(false)
    const isDark = ref(false)
    const showDeleteModal = ref(false)
    const blogToDelete = ref(null)
    const searchQuery = ref(props.filters?.search || '')
    const selectedBlogs = ref([])

    // Reactive filters object
    const filters = ref({
      search: props.filters?.search || '',
      status: props.filters?.status || 'all',
      category: props.filters?.category || 'all',
      featured: props.filters?.featured || '',
      sort_by: props.filters?.sort_by || 'created_at',
      sort_order: props.filters?.sort_order || 'desc'
    })

    const statusFilters = [
      { label: 'All', value: 'all' },
      { label: 'Published', value: 'published' },
      { label: 'Draft', value: 'draft' },
      { label: 'Scheduled', value: 'scheduled' },
      { label: 'Archived', value: 'archived' }
    ]

    const allSelected = computed(() => {
      return props.blogs?.data?.length > 0 && selectedBlogs.value.length === props.blogs.data.length
    })

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

    let searchTimeout = null
    const debouncedSearch = () => {
      clearTimeout(searchTimeout)
      searchTimeout = setTimeout(() => {
        filters.value.search = searchQuery.value
        router.get('/admin/blogs', {
          search: searchQuery.value,
          ...filters.value
        }, {
          preserveState: true,
          preserveScroll: true
        })
      }, 500)
    }

    const updateFilter = (filterType, value) => {
      filters.value[filterType] = value

      router.get('/admin/blogs', {
        search: searchQuery.value,
        ...filters.value
      }, {
        preserveState: true,
        preserveScroll: true
      })
    }

    const handleSidebarToggle = (collapsed) => {
      sidebarCollapsed.value = collapsed
    }

    const toggleSelect = (blogId) => {
      const index = selectedBlogs.value.indexOf(blogId)
      if (index > -1) {
        selectedBlogs.value.splice(index, 1)
      } else {
        selectedBlogs.value.push(blogId)
      }
    }

    const toggleSelectAll = () => {
      if (allSelected.value) {
        selectedBlogs.value = []
      } else {
        selectedBlogs.value = props.blogs?.data?.map(blog => blog.id) || []
      }
    }

    const publishPost = (blog) => {
      router.post(route('admin.blogs.publish', blog.id), {}, {
        preserveScroll: true
      })
    }

    const unpublishPost = (blog) => {
      router.post(route('admin.blogs.unpublish', blog.id), {}, {
        preserveScroll: true
      })
    }

    const toggleFeatured = (blog) => {
      router.post(route('admin.blogs.toggle-featured', blog.id), {}, {
        preserveScroll: true
      })
    }

    const duplicatePost = (blog) => {
      router.post(route('admin.blogs.duplicate', blog.id))
    }

    const confirmDelete = (blog) => {
      blogToDelete.value = blog
      showDeleteModal.value = true
    }

    const deleteBlog = () => {
      if (blogToDelete.value) {
        router.delete(route('admin.blogs.destroy', blogToDelete.value.id), {
          onSuccess: () => {
            closeDeleteModal()
          }
        })
      }
    }

    const closeDeleteModal = () => {
      showDeleteModal.value = false
      blogToDelete.value = null
    }

    const bulkAction = (action) => {
      router.post(route('admin.blogs.bulk-action'), {
        action: action,
        blog_ids: selectedBlogs.value
      }, {
        onSuccess: () => {
          selectedBlogs.value = []
        }
      })
    }

    const formatDate = (date) => {
      return new Date(date).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric'
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
      showDeleteModal,
      searchQuery,
      selectedBlogs,
      statusFilters,
      allSelected,
      filters,
      handleSidebarToggle,
      toggleTheme,
      debouncedSearch,
      updateFilter,
      toggleSelect,
      toggleSelectAll,
      publishPost,
      unpublishPost,
      toggleFeatured,
      duplicatePost,
      confirmDelete,
      deleteBlog,
      closeDeleteModal,
      bulkAction,
      formatDate,
      formatStatus
    }
  }
}
</script>

<style scoped>
.line-clamp-1 {
  display: -webkit-box;
  -webkit-line-clamp: 1;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>