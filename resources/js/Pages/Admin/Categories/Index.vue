<template>
  <div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-200">
    <Head title="Manage Categories" />

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
            <div class="flex justify-between items-center">
              <div>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Categories</h2>
                <p class="mt-2 text-gray-600 dark:text-gray-400">Manage your blog categories and organize your content</p>
              </div>
              <Link
                :href="route('admin.categories.create')"
                class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition duration-200"
              >
                <i class="fas fa-plus mr-2"></i>
                Add Category
              </Link>
            </div>
          </div>

          <!-- Stats Cards -->
          <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
              <div class="flex items-center">
                <div class="p-2 bg-blue-100 dark:bg-blue-900/20 rounded-lg">
                  <i class="fas fa-folder text-blue-600 dark:text-blue-400 text-xl"></i>
                </div>
                <div class="ml-4">
                  <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Categories</p>
                  <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ stats.total }}</p>
                </div>
              </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
              <div class="flex items-center">
                <div class="p-2 bg-green-100 dark:bg-green-900/20 rounded-lg">
                  <i class="fas fa-check-circle text-green-600 dark:text-green-400 text-xl"></i>
                </div>
                <div class="ml-4">
                  <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Active</p>
                  <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ stats.active }}</p>
                </div>
              </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
              <div class="flex items-center">
                <div class="p-2 bg-gray-100 dark:bg-gray-900/20 rounded-lg">
                  <i class="fas fa-times-circle text-gray-600 dark:text-gray-400 text-xl"></i>
                </div>
                <div class="ml-4">
                  <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Inactive</p>
                  <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ stats.inactive }}</p>
                </div>
              </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
              <div class="flex items-center">
                <div class="p-2 bg-purple-100 dark:bg-purple-900/20 rounded-lg">
                  <i class="fas fa-chart-bar text-purple-600 dark:text-purple-400 text-xl"></i>
                </div>
                <div class="ml-4">
                  <p class="text-sm font-medium text-gray-600 dark:text-gray-400">With Posts</p>
                  <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ stats.with_posts }}</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Filters and Search -->
          <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
            <div class="p-6">
              <div class="flex flex-col lg:flex-row gap-4">
                <!-- Search -->
                <div class="flex-1">
                  <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input
                      v-model="search"
                      type="text"
                      placeholder="Search categories..."
                      class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                      @input="handleSearch"
                    />
                  </div>
                </div>

                <!-- Status Filter -->
                <div>
                  <select
                    v-model="statusFilter"
                    class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                    @change="handleFilter"
                  >
                    <option value="all">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </div>

                <!-- Sort -->
                <div>
                  <select
                    v-model="sortBy"
                    class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                    @change="handleSort"
                  >
                    <option value="sort_order">Sort Order</option>
                    <option value="name">Name</option>
                    <option value="posts_count">Posts Count</option>
                    <option value="created_at">Created Date</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <!-- Categories Table -->
          <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                <thead class="bg-gray-50 dark:bg-gray-700">
                  <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                      <input
                        type="checkbox"
                        v-model="selectAll"
                        @change="toggleSelectAll"
                        class="rounded border-gray-300 dark:border-gray-600 text-emerald-600 focus:ring-emerald-500"
                      />
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                      Category
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                      Posts
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                      Status
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                      Order
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                      Created
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                      Actions
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                  <tr
                    v-for="category in categories.data"
                    :key="category.id"
                    class="hover:bg-gray-50 dark:hover:bg-gray-700"
                  >
                    <td class="px-6 py-4 whitespace-nowrap">
                      <input
                        type="checkbox"
                        :value="category.id"
                        v-model="selectedCategories"
                        class="rounded border-gray-300 dark:border-gray-600 text-emerald-600 focus:ring-emerald-500"
                      />
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div
                          class="w-10 h-10 rounded-lg flex items-center justify-center mr-4"
                          :style="`background-color: ${category.color}20; border: 1px solid ${category.color}40`"
                        >
                          <i
                            :class="category.icon || 'fas fa-folder'"
                            :style="`color: ${category.color}`"
                          ></i>
                        </div>
                        <div>
                          <div class="text-sm font-medium text-gray-900 dark:text-white">
                            {{ category.name }}
                          </div>
                          <div class="text-sm text-gray-500 dark:text-gray-400">
                            {{ category.slug }}
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/20 text-blue-800 dark:text-blue-300">
                        {{ category.posts_count || 0 }}
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <button
                        @click="toggleStatus(category)"
                        :class="[
                          'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium transition duration-200',
                          category.is_active
                            ? 'bg-green-100 dark:bg-green-900/20 text-green-800 dark:text-green-300 hover:bg-green-200 dark:hover:bg-green-900/40'
                            : 'bg-red-100 dark:bg-red-900/20 text-red-800 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-900/40'
                        ]"
                      >
                        {{ category.is_active ? 'Active' : 'Inactive' }}
                      </button>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                      {{ category.sort_order }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                      {{ new Date(category.created_at).toLocaleDateString() }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                      <div class="flex items-center justify-end space-x-2">
                        <Link
                          :href="route('admin.categories.show', category.id)"
                          class="text-emerald-600 dark:text-emerald-400 hover:text-emerald-900 dark:hover:text-emerald-300"
                        >
                          <i class="fas fa-eye"></i>
                        </Link>
                        <Link
                          :href="route('admin.categories.edit', category.id)"
                          class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300"
                        >
                          <i class="fas fa-edit"></i>
                        </Link>
                        <button
                          @click="deleteCategory(category)"
                          class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300"
                        >
                          <i class="fas fa-trash"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Pagination -->
          <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4">
              <div class="flex items-center justify-between">
                <div class="text-sm text-gray-700 dark:text-gray-300">
                  Showing {{ categories.from }} to {{ categories.to }} of {{ categories.total }} results
                </div>
                <div class="flex space-x-1">
                  <template v-for="link in categories.links" :key="link.label">
                    <Link
                      v-if="link.url"
                      :href="link.url"
                      :class="[
                        'px-3 py-2 text-sm rounded-lg transition duration-200',
                        link.active
                          ? 'bg-emerald-600 text-white'
                          : 'bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 border border-gray-300 dark:border-gray-600'
                      ]"
                      v-html="link.label"
                    />
                    <span
                      v-else
                      :class="[
                        'px-3 py-2 text-sm rounded-lg transition duration-200',
                        'bg-gray-100 dark:bg-gray-800 text-gray-400 dark:text-gray-500 border border-gray-300 dark:border-gray-600 cursor-not-allowed'
                      ]"
                      v-html="link.label"
                    />
                  </template>
                </div>
              </div>
            </div>
          </div>

          <!-- Bulk Actions -->
          <div v-if="selectedCategories.length > 0" class="fixed bottom-6 left-1/2 transform -translate-x-1/2 z-50">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 px-6 py-4">
              <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-600 dark:text-gray-400">
                  {{ selectedCategories.length }} selected
                </span>
                <div class="flex space-x-2">
                  <button
                    @click="bulkAction('activate')"
                    class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm rounded-lg transition duration-200"
                  >
                    Activate
                  </button>
                  <button
                    @click="bulkAction('deactivate')"
                    class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm rounded-lg transition duration-200"
                  >
                    Deactivate
                  </button>
                  <button
                    @click="bulkAction('delete')"
                    class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm rounded-lg transition duration-200"
                  >
                    Delete
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Delete Confirmation Modal -->
    <ConfirmModal
      :show="showDeleteModal"
      title="Delete Category"
      :message="`Are you sure you want to delete '${categoryToDelete?.name}'? This action cannot be undone.`"
      @confirmed="confirmDelete"
      @cancelled="showDeleteModal = false"
    />
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { Head, Link, router } from '@inertiajs/vue3'
import ConfirmModal from '../Common/ConfirmModal.vue'
import Sidebar from '../Common/Sidebar.vue'
import Topbar from '../Common/Topbar.vue'

const props = defineProps({
  categories: Object,
  filters: Object,
  stats: Object
})

const sidebarCollapsed = ref(false)
const isDark = ref(false)
const search = ref(props.filters.search || '')
const statusFilter = ref(props.filters.status || 'all')
const sortBy = ref(props.filters.sort_by || 'sort_order')
const selectedCategories = ref([])
const showDeleteModal = ref(false)
const categoryToDelete = ref(null)

const selectAll = computed({
  get() {
    return props.categories.data.length > 0 && selectedCategories.value.length === props.categories.data.length
  },
  set(value) {
    if (value) {
      selectedCategories.value = props.categories.data.map(category => category.id)
    } else {
      selectedCategories.value = []
    }
  }
})

const toggleSelectAll = () => {
  if (selectAll.value) {
    selectedCategories.value = []
  } else {
    selectedCategories.value = props.categories.data.map(category => category.id)
  }
}

const handleSearch = () => {
  router.get(route('admin.categories.index'), {
    search: search.value,
    status: statusFilter.value,
    sort_by: sortBy.value
  }, {
    preserveState: true,
    replace: true
  })
}

const handleFilter = () => {
  router.get(route('admin.categories.index'), {
    search: search.value,
    status: statusFilter.value,
    sort_by: sortBy.value
  }, {
    preserveState: true,
    replace: true
  })
}

const handleSort = () => {
  router.get(route('admin.categories.index'), {
    search: search.value,
    status: statusFilter.value,
    sort_by: sortBy.value
  }, {
    preserveState: true,
    replace: true
  })
}

const toggleStatus = (category) => {
  router.patch(route('admin.categories.toggle-status', category.id), {}, {
    preserveScroll: true
  })
}

const deleteCategory = (category) => {
  categoryToDelete.value = category
  showDeleteModal.value = true
}

const confirmDelete = () => {
  router.delete(route('admin.categories.destroy', categoryToDelete.value.id), {
    preserveScroll: true
  })
  showDeleteModal.value = false
  categoryToDelete.value = null
}

const bulkAction = (action) => {
  router.post(route('admin.categories.bulk-action'), {
    action: action,
    category_ids: selectedCategories.value
  }, {
    preserveScroll: true,
    onSuccess: () => {
      selectedCategories.value = []
    }
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
</script>