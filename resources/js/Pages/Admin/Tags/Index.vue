<template>
  <div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-200">
    <Head>
      <title>Tag Management - DevOps Jungle Admin</title>
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
              <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">Tag Management</h1>
              <p class="text-gray-600 dark:text-gray-400">Create and manage blog tags</p>
            </div>
            <Link
              :href="route('admin.tags.create')"
              class="px-6 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-lg font-semibold hover:from-emerald-600 hover:to-emerald-700 transition-all duration-200 flex items-center space-x-2 shadow-lg"
            >
              <i class="fas fa-plus"></i>
              <span>Create New Tag</span>
            </Link>
          </div>

          <!-- Stats Cards -->
          <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-4 shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-600 dark:text-gray-400 text-sm">Total Tags</p>
                  <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ stats?.total || 0 }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/20 rounded-lg flex items-center justify-center">
                  <i class="fas fa-tags text-blue-600 dark:text-blue-400 text-xl"></i>
                </div>
              </div>
            </div>
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-4 shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-600 dark:text-gray-400 text-sm">Active</p>
                  <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ stats?.active || 0 }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 dark:bg-green-900/20 rounded-lg flex items-center justify-center">
                  <i class="fas fa-check-circle text-green-600 dark:text-green-400 text-xl"></i>
                </div>
              </div>
            </div>
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-4 shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-600 dark:text-gray-400 text-sm">Inactive</p>
                  <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ stats?.inactive || 0 }}</p>
                </div>
                <div class="w-12 h-12 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                  <i class="fas fa-times-circle text-gray-600 dark:text-gray-400 text-xl"></i>
                </div>
              </div>
            </div>
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-4 shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-600 dark:text-gray-400 text-sm">Popular</p>
                  <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ stats?.popular || 0 }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/20 rounded-lg flex items-center justify-center">
                  <i class="fas fa-fire text-purple-600 dark:text-purple-400 text-xl"></i>
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
                placeholder="Search tags..."
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
                  currentStatus === filter.value
                    ? 'bg-emerald-600 text-white'
                    : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600'
                ]"
              >
                {{ filter.label }}
              </button>
            </div>
          </div>
        </div>

        <!-- Bulk Actions -->
        <div v-if="selectedTags.length > 0" class="bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-xl p-4 mb-6">
          <div class="flex items-center justify-between">
            <span class="text-emerald-700 dark:text-emerald-300 font-medium">
              {{ selectedTags.length }} tag(s) selected
            </span>
            <div class="flex items-center space-x-2">
              <button
                @click="bulkAction('activate')"
                class="px-3 py-1 bg-green-600 text-white rounded-lg text-sm hover:bg-green-700 transition-colors"
              >
                Activate
              </button>
              <button
                @click="bulkAction('deactivate')"
                class="px-3 py-1 bg-gray-600 text-white rounded-lg text-sm hover:bg-gray-700 transition-colors"
              >
                Deactivate
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

        <!-- Tags Table -->
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
                    Tag
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                    Posts Count
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                    Status
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                    Created
                  </th>
                  <th class="px-6 py-4 text-right text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                    Actions
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                <tr
                  v-for="tag in tags?.data || []"
                  :key="tag.id"
                  class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
                >
                  <td class="px-6 py-4">
                    <input
                      type="checkbox"
                      :checked="selectedTags.includes(tag.id)"
                      @change="toggleSelect(tag.id)"
                      class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500"
                    />
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex items-center space-x-3">
                      <div
                        class="w-4 h-4 rounded-full"
                        :style="`background-color: ${tag.color || '#10b981'}`"
                      ></div>
                      <div>
                        <p class="text-gray-800 dark:text-white font-medium">{{ tag.name }}</p>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">{{ tag.slug }}</p>
                        <p v-if="tag.description" class="text-gray-500 dark:text-gray-400 text-sm mt-1 line-clamp-1">
                          {{ tag.description }}
                        </p>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300">
                      {{ tag.posts_count || 0 }} posts
                    </span>
                  </td>
                  <td class="px-6 py-4">
                    <span
                      :class="[
                        'px-3 py-1 rounded-full text-xs font-semibold',
                        tag.is_active
                          ? 'bg-green-100 dark:bg-green-900/20 text-green-700 dark:text-green-300'
                          : 'bg-red-100 dark:bg-red-900/20 text-red-700 dark:text-red-300'
                      ]"
                    >
                      {{ tag.is_active ? 'Active' : 'Inactive' }}
                    </span>
                  </td>
                  <td class="px-6 py-4">
                    <p class="text-gray-700 dark:text-gray-300 text-sm">{{ formatDate(tag.created_at) }}</p>
                  </td>
                  <td class="px-6 py-4 text-right">
                    <div class="flex items-center justify-end space-x-2">
                      <!-- View -->
                      <Link
                        :href="route('admin.tags.show', tag.id)"
                        class="p-2 text-blue-600 dark:text-blue-400 hover:bg-blue-100 dark:hover:bg-blue-900/20 rounded-lg transition-all duration-200"
                        title="View Tag"
                      >
                        <i class="fas fa-eye"></i>
                      </Link>

                      <!-- Edit -->
                      <Link
                        :href="route('admin.tags.edit', tag.id)"
                        class="p-2 text-emerald-600 dark:text-emerald-400 hover:bg-emerald-100 dark:hover:bg-emerald-900/20 rounded-lg transition-all duration-200"
                        title="Edit Tag"
                      >
                        <i class="fas fa-edit"></i>
                      </Link>

                      <!-- Toggle Status -->
                      <button
                        @click="toggleStatus(tag)"
                        :class="[
                          'p-2 rounded-lg transition-all duration-200',
                          tag.is_active
                            ? 'text-orange-600 dark:text-orange-400 hover:bg-orange-100 dark:hover:bg-orange-900/20'
                            : 'text-green-600 dark:text-green-400 hover:bg-green-100 dark:hover:bg-green-900/20'
                        ]"
                        :title="tag.is_active ? 'Deactivate' : 'Activate'"
                      >
                        <i :class="tag.is_active ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                      </button>

                      <!-- Delete -->
                      <button
                        @click="confirmDelete(tag)"
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
          <div v-if="tags?.data?.length > 0" class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800">
            <div class="flex items-center justify-between">
              <p class="text-gray-600 dark:text-gray-400 text-sm">
                Showing {{ tags.from }} to {{ tags.to }} of {{ tags.total }} tags
              </p>
              <div class="flex items-center space-x-2">
                <template v-for="link in tags.links" :key="link.label">
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
          <div v-if="!tags?.data?.length" class="px-6 py-12 text-center">
            <i class="fas fa-tags text-gray-400 dark:text-gray-600 text-5xl mb-4"></i>
            <p class="text-gray-600 dark:text-gray-400 text-lg">No tags found</p>
            <p class="text-gray-500 dark:text-gray-500 text-sm mt-2">Try adjusting your search or filters</p>
          </div>
        </div>
      </div>
    </main>

    <!-- Delete Confirmation Modal -->
    <ConfirmModal
      :show="showDeleteModal"
      title="Delete Tag"
      :message="`Are you sure you want to delete '${tagToDelete?.name}'? This action cannot be undone.`"
      @confirm="deleteTag"
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
  name: 'TagsIndex',
  components: {
    Head,
    Link,
    Sidebar,
    Topbar,
    ConfirmModal
  },
  props: {
    tags: {
      type: Object,
      required: true
    },
    filters: {
      type: Object,
      default: () => ({
        search: '',
        status: 'all',
        sort_by: 'name',
        sort_order: 'asc'
      })
    },
    stats: {
      type: Object,
      default: () => ({
        total: 0,
        active: 0,
        inactive: 0,
        popular: 0
      })
    }
  },
  setup(props) {
    const sidebarCollapsed = ref(false)
    const isDark = ref(false)
    const showDeleteModal = ref(false)
    const tagToDelete = ref(null)
    const searchQuery = ref(props.filters?.search || '')
    const selectedTags = ref([])
    const currentStatus = ref(props.filters?.status || 'all')

    const statusFilters = [
      { label: 'All', value: 'all' },
      { label: 'Active', value: 'active' },
      { label: 'Inactive', value: 'inactive' }
    ]

    const allSelected = computed(() => {
      return props.tags?.data?.length > 0 && selectedTags.value.length === props.tags.data.length
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
        router.get('/admin/tags', {
          search: searchQuery.value,
          status: currentStatus.value
        }, {
          preserveState: true,
          preserveScroll: true
        })
      }, 500)
    }

    const updateFilter = (filterType, value) => {
      if (filterType === 'status') {
        currentStatus.value = value
      }

      router.get('/admin/tags', {
        search: searchQuery.value,
        status: currentStatus.value
      }, {
        preserveState: true,
        preserveScroll: true
      })
    }

    const handleSidebarToggle = (collapsed) => {
      sidebarCollapsed.value = collapsed
    }

    const toggleSelect = (tagId) => {
      const index = selectedTags.value.indexOf(tagId)
      if (index > -1) {
        selectedTags.value.splice(index, 1)
      } else {
        selectedTags.value.push(tagId)
      }
    }

    const toggleSelectAll = () => {
      if (allSelected.value) {
        selectedTags.value = []
      } else {
        selectedTags.value = props.tags?.data?.map(tag => tag.id) || []
      }
    }

    const toggleStatus = (tag) => {
      router.patch(route('admin.tags.toggle-status', tag.id), {}, {
        preserveScroll: true
      })
    }

    const confirmDelete = (tag) => {
      tagToDelete.value = tag
      showDeleteModal.value = true
    }

    const deleteTag = () => {
      if (tagToDelete.value) {
        router.delete(route('admin.tags.destroy', tagToDelete.value.id), {
          onSuccess: () => {
            closeDeleteModal()
          }
        })
      }
    }

    const closeDeleteModal = () => {
      showDeleteModal.value = false
      tagToDelete.value = null
    }

    const bulkAction = (action) => {
      router.post(route('admin.tags.bulk-action'), {
        action: action,
        tag_ids: selectedTags.value
      }, {
        onSuccess: () => {
          selectedTags.value = []
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

    return {
      sidebarCollapsed,
      isDark,
      showDeleteModal,
      searchQuery,
      selectedTags,
      currentStatus,
      statusFilters,
      allSelected,
      handleSidebarToggle,
      toggleTheme,
      debouncedSearch,
      updateFilter,
      toggleSelect,
      toggleSelectAll,
      toggleStatus,
      confirmDelete,
      deleteTag,
      closeDeleteModal,
      bulkAction,
      formatDate
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
</style>