<template>
  <div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-200">
    <Head>
      <title>Exam Providers Management - DevOps Jungle Admin</title>
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
              <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">Exam Providers</h1>
              <p class="text-gray-600 dark:text-gray-400">Manage certification providers (AWS, Azure, GCP, etc.)</p>
            </div>
            <Link
              :href="route('admin.exam-providers.create')"
              class="px-6 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-lg font-semibold hover:from-emerald-600 hover:to-emerald-700 transition-all duration-200 flex items-center space-x-2 shadow-lg"
            >
              <i class="fas fa-plus"></i>
              <span>Add New Provider</span>
            </Link>
          </div>

          <!-- Stats Cards -->
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-4 shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-600 dark:text-gray-400 text-sm">Total Providers</p>
                  <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ stats.total }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/20 rounded-lg flex items-center justify-center">
                  <i class="fas fa-building text-blue-600 dark:text-blue-400 text-xl"></i>
                </div>
              </div>
            </div>
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-4 shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-600 dark:text-gray-400 text-sm">Active</p>
                  <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ stats.active }}</p>
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
                  <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ stats.inactive }}</p>
                </div>
                <div class="w-12 h-12 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                  <i class="fas fa-ban text-gray-600 dark:text-gray-400 text-xl"></i>
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
                placeholder="Search providers..."
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
                  localFilters.status === filter.value
                    ? 'bg-emerald-600 text-white'
                    : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600'
                ]"
              >
                {{ filter.label }}
              </button>
            </div>
          </div>
        </div>

        <!-- Providers Table -->
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden shadow-sm">
          <div class="overflow-x-auto">
            <table class="w-full">
              <thead class="bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                <tr>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                    Order
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                    Provider
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                    Slug
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                    Exam Dumps
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                    Status
                  </th>
                  <th class="px-6 py-4 text-right text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                    Actions
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                <tr
                  v-for="provider in providers.data"
                  :key="provider.id"
                  class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
                >
                  <td class="px-6 py-4">
                    <div class="flex items-center space-x-2">
                      <span class="text-gray-600 dark:text-gray-400 font-mono">#{{ provider.sort_order }}</span>
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex items-center space-x-3">
                      <div
                        class="w-12 h-12 rounded-lg flex items-center justify-center"
                        :style="provider.gradient_color || 'background: linear-gradient(135deg, #047857 0%, #10b981 100%)'"
                      >
                        <i :class="provider.icon || 'fas fa-certificate'" class="text-white text-xl"></i>
                      </div>
                      <div>
                        <p class="text-gray-800 dark:text-white font-semibold">{{ provider.name }}</p>
                        <p class="text-gray-500 dark:text-gray-400 text-sm line-clamp-1">{{ provider.description }}</p>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <span class="text-gray-600 dark:text-gray-400 font-mono text-sm">{{ provider.slug }}</span>
                  </td>
                  <td class="px-6 py-4">
                    <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 rounded-full text-sm font-semibold">
                      {{ provider.exam_dumps_count || 0 }} Dumps
                    </span>
                  </td>
                  <td class="px-6 py-4">
                    <span
                      :class="[
                        'px-3 py-1 rounded-full text-xs font-semibold',
                        provider.is_active
                          ? 'bg-green-100 dark:bg-green-900/20 text-green-700 dark:text-green-300'
                          : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300'
                      ]"
                    >
                      {{ provider.is_active ? 'Active' : 'Inactive' }}
                    </span>
                  </td>
                  <td class="px-6 py-4 text-right">
                    <div class="flex items-center justify-end space-x-2">
                      <!-- Edit -->
                      <Link
                        :href="route('admin.exam-providers.edit', provider.id)"
                        class="p-2 text-emerald-600 dark:text-emerald-400 hover:bg-emerald-100 dark:hover:bg-emerald-900/20 rounded-lg transition-all duration-200"
                        title="Edit"
                      >
                        <i class="fas fa-edit"></i>
                      </Link>

                      <!-- Toggle Status -->
                      <button
                        @click="toggleStatus(provider)"
                        :class="[
                          'p-2 rounded-lg transition-all duration-200',
                          provider.is_active
                            ? 'text-orange-600 dark:text-orange-400 hover:bg-orange-100 dark:hover:bg-orange-900/20'
                            : 'text-green-600 dark:text-green-400 hover:bg-green-100 dark:hover:bg-green-900/20'
                        ]"
                        :title="provider.is_active ? 'Deactivate' : 'Activate'"
                      >
                        <i :class="provider.is_active ? 'fas fa-toggle-on' : 'fas fa-toggle-off'"></i>
                      </button>

                      <!-- Delete -->
                      <button
                        @click="confirmDelete(provider)"
                        class="p-2 text-red-600 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-900/20 rounded-lg transition-all duration-200"
                        title="Delete"
                        :disabled="provider.exam_dumps_count > 0"
                        :class="provider.exam_dumps_count > 0 ? 'opacity-50 cursor-not-allowed' : ''"
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
          <div v-if="providers.data.length > 0" class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800">
            <div class="flex items-center justify-between">
              <p class="text-gray-600 dark:text-gray-400 text-sm">
                Showing {{ providers.from }} to {{ providers.to }} of {{ providers.total }} providers
              </p>
              <div class="flex items-center space-x-2">
                <template v-for="link in providers.links" :key="link.label">
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
          <div v-if="providers.data.length === 0" class="px-6 py-12 text-center">
            <i class="fas fa-building text-gray-400 dark:text-gray-600 text-5xl mb-4"></i>
            <p class="text-gray-600 dark:text-gray-400 text-lg">No exam providers found</p>
            <p class="text-gray-500 dark:text-gray-500 text-sm mt-2">Try adjusting your search or filters</p>
          </div>
        </div>
      </div>
    </main>

    <!-- Delete Confirmation Modal -->
    <ConfirmModal
      :show="showDeleteModal"
      title="Delete Exam Provider"
      message="Are you sure you want to delete this provider? This action cannot be undone."
      @confirm="deleteProvider"
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
  name: 'ExamProvidersIndex',
  components: {
    Head,
    Link,
    Sidebar,
    Topbar,
    ConfirmModal
  },
  props: {
    providers: {
      type: Object,
      required: true
    },
    filters: {
      type: Object,
      default: () => ({
        search: '',
        status: 'all',
        sort_by: 'sort_order',
        sort_order: 'asc'
      })
    },
    stats: {
      type: Object,
      default: () => ({})
    }
  },
  setup(props) {
    const sidebarCollapsed = ref(false)
    const isDark = ref(false)
    const showDeleteModal = ref(false)
    const providerToDelete = ref(null)
    const searchQuery = ref(props.filters?.search || '')

    // Reactive filters object
    const localFilters = ref({
      search: props.filters?.search || '',
      status: props.filters?.status || 'all',
      sort_by: props.filters?.sort_by || 'sort_order',
      sort_order: props.filters?.sort_order || 'asc'
    })

    const statusFilters = [
      { label: 'All', value: 'all' },
      { label: 'Active', value: 'active' },
      { label: 'Inactive', value: 'inactive' }
    ]

    // Methods
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

    let searchTimeout = null
    const debouncedSearch = () => {
      clearTimeout(searchTimeout)
      searchTimeout = setTimeout(() => {
        updateFilter('search', searchQuery.value)
      }, 500)
    }

    const updateFilter = (key, value) => {
      localFilters.value[key] = value
      router.get(route('admin.exam-providers.index'), localFilters.value, {
        preserveState: true,
        preserveScroll: true
      })
    }

    const toggleStatus = (provider) => {
      router.post(route('admin.exam-providers.toggle-status', provider.id))
    }

    const confirmDelete = (provider) => {
      if (provider.exam_dumps_count > 0) {
        alert('Cannot delete provider with existing exam dumps!')
        return
      }
      providerToDelete.value = provider
      showDeleteModal.value = true
    }

    const deleteProvider = () => {
      if (providerToDelete.value) {
        router.delete(route('admin.exam-providers.destroy', providerToDelete.value.id), {
          onSuccess: () => {
            closeDeleteModal()
          }
        })
      }
    }

    const closeDeleteModal = () => {
      showDeleteModal.value = false
      providerToDelete.value = null
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
      showDeleteModal,
      providerToDelete,
      searchQuery,
      localFilters,
      statusFilters,
      handleSidebarToggle,
      toggleTheme,
      debouncedSearch,
      updateFilter,
      toggleStatus,
      confirmDelete,
      deleteProvider,
      closeDeleteModal,
      route
    }
  }
}
</script>
