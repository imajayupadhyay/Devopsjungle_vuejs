<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-900 via-gray-900 to-black">
    <Head>
      <title>User Management - DevOps Jungle Admin</title>
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
              <h1 class="text-3xl font-bold text-white mb-2">User Management</h1>
              <p class="text-gray-400">Manage admin and regular users</p>
            </div>
            <button
              @click="openCreateModal"
              class="px-6 py-3 bg-gradient-to-r from-primary-500 to-primary-600 text-white rounded-lg font-semibold hover:from-primary-600 hover:to-primary-700 transition-all duration-200 flex items-center space-x-2 shadow-lg"
            >
              <i class="fas fa-user-plus"></i>
              <span>Add New User</span>
            </button>
          </div>

          <!-- Stats Cards -->
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-xl p-4">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-400 text-sm">Total Users</p>
                  <p class="text-2xl font-bold text-white">{{ stats.total }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-500/20 rounded-lg flex items-center justify-center">
                  <i class="fas fa-users text-blue-400 text-xl"></i>
                </div>
              </div>
            </div>
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-xl p-4">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-400 text-sm">Administrators</p>
                  <p class="text-2xl font-bold text-white">{{ stats.admins }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-500/20 rounded-lg flex items-center justify-center">
                  <i class="fas fa-user-shield text-purple-400 text-xl"></i>
                </div>
              </div>
            </div>
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-xl p-4">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-400 text-sm">Regular Users</p>
                  <p class="text-2xl font-bold text-white">{{ stats.regular_users }}</p>
                </div>
                <div class="w-12 h-12 bg-green-500/20 rounded-lg flex items-center justify-center">
                  <i class="fas fa-user text-green-400 text-xl"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Filters and Search -->
        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-xl p-4 mb-6">
          <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <!-- Search -->
            <div class="relative flex-1 max-w-md">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400"></i>
              </div>
              <input
                v-model="searchQuery"
                type="text"
                placeholder="Search by name or email..."
                class="w-full pl-10 pr-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                @input="debouncedSearch"
              />
            </div>

            <!-- Filter Buttons -->
            <div class="flex items-center space-x-2">
              <button
                v-for="filter in filterOptions"
                :key="filter.value"
                @click="updateFilter(filter.value)"
                :class="[
                  'px-4 py-2 rounded-lg font-medium transition-all duration-200',
                  filters.filter === filter.value
                    ? 'bg-primary-500 text-white'
                    : 'bg-white/5 text-gray-400 hover:bg-white/10 hover:text-white'
                ]"
              >
                {{ filter.label }}
              </button>
            </div>
          </div>
        </div>

        <!-- Users Table -->
        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-xl overflow-hidden">
          <div class="overflow-x-auto">
            <table class="w-full">
              <thead class="bg-white/5 border-b border-white/10">
                <tr>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                    User
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                    Email
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                    Role
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                    Created
                  </th>
                  <th class="px-6 py-4 text-right text-xs font-semibold text-gray-400 uppercase tracking-wider">
                    Actions
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-white/5">
                <tr
                  v-for="user in users.data"
                  :key="user.id"
                  class="hover:bg-white/5 transition-colors"
                >
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center space-x-3">
                      <img
                        :src="user.avatar_url || `https://ui-avatars.com/api/?name=${encodeURIComponent(user.name)}&background=047857&color=fff`"
                        :alt="user.name"
                        class="w-10 h-10 rounded-full border-2 border-primary-500"
                      />
                      <div>
                        <p class="text-white font-medium">{{ user.name }}</p>
                        <p class="text-gray-400 text-sm">ID: {{ user.id }}</p>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <p class="text-gray-300">{{ user.email }}</p>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span
                      :class="[
                        'px-3 py-1 rounded-full text-xs font-semibold',
                        user.is_admin
                          ? 'bg-purple-500/20 text-purple-300 border border-purple-500/30'
                          : 'bg-blue-500/20 text-blue-300 border border-blue-500/30'
                      ]"
                    >
                      <i :class="user.is_admin ? 'fas fa-shield-alt' : 'fas fa-user'" class="mr-1"></i>
                      {{ user.is_admin ? 'Administrator' : 'User' }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <p class="text-gray-300 text-sm">{{ formatDate(user.created_at) }}</p>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-right">
                    <div class="flex items-center justify-end space-x-2">
                      <!-- Toggle Admin Status -->
                      <button
                        @click="toggleAdmin(user)"
                        :disabled="user.id === $page.props.auth.user.id"
                        :title="user.is_admin ? 'Remove Admin' : 'Make Admin'"
                        :class="[
                          'p-2 rounded-lg transition-all duration-200',
                          user.id === $page.props.auth.user.id
                            ? 'text-gray-600 cursor-not-allowed'
                            : 'text-purple-400 hover:bg-purple-500/20'
                        ]"
                      >
                        <i :class="user.is_admin ? 'fas fa-user-minus' : 'fas fa-user-shield'"></i>
                      </button>

                      <!-- Edit -->
                      <button
                        @click="openEditModal(user)"
                        class="p-2 text-blue-400 hover:bg-blue-500/20 rounded-lg transition-all duration-200"
                        title="Edit User"
                      >
                        <i class="fas fa-edit"></i>
                      </button>

                      <!-- Delete -->
                      <button
                        @click="confirmDelete(user)"
                        :disabled="user.id === $page.props.auth.user.id"
                        :class="[
                          'p-2 rounded-lg transition-all duration-200',
                          user.id === $page.props.auth.user.id
                            ? 'text-gray-600 cursor-not-allowed'
                            : 'text-red-400 hover:bg-red-500/20'
                        ]"
                        title="Delete User"
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
          <div v-if="users.data.length > 0" class="px-6 py-4 border-t border-white/10">
            <div class="flex items-center justify-between">
              <p class="text-gray-400 text-sm">
                Showing {{ users.from }} to {{ users.to }} of {{ users.total }} users
              </p>
              <div class="flex items-center space-x-2">
                <template v-for="link in users.links" :key="link.label">
                  <Link
                    v-if="link.url"
                    :href="link.url"
                    :class="[
                      'px-3 py-1 rounded-lg text-sm transition-all duration-200',
                      link.active
                        ? 'bg-primary-500 text-white'
                        : 'bg-white/5 text-gray-400 hover:bg-white/10 hover:text-white'
                    ]"
                    v-html="link.label"
                  ></Link>
                  <span
                    v-else
                    :class="[
                      'px-3 py-1 rounded-lg text-sm bg-white/5 text-gray-600 cursor-not-allowed'
                    ]"
                    v-html="link.label"
                  ></span>
                </template>
              </div>
            </div>
          </div>

          <!-- Empty State -->
          <div v-if="users.data.length === 0" class="px-6 py-12 text-center">
            <i class="fas fa-users text-gray-600 text-5xl mb-4"></i>
            <p class="text-gray-400 text-lg">No users found</p>
            <p class="text-gray-500 text-sm mt-2">Try adjusting your search or filters</p>
          </div>
        </div>
      </div>
    </main>

    <!-- Create/Edit Modal -->
    <UserModal
      :show="showModal"
      :user="selectedUser"
      @close="closeModal"
      @submit="handleSubmit"
    />

    <!-- Delete Confirmation Modal -->
    <ConfirmModal
      :show="showDeleteModal"
      title="Delete User"
      message="Are you sure you want to delete this user? This action cannot be undone."
      @confirm="deleteUser"
      @cancel="closeDeleteModal"
    />
  </div>
</template>

<script>
import { Head, Link, router } from '@inertiajs/vue3'
import { ref } from 'vue'
import Sidebar from '../Common/Sidebar.vue'
import Topbar from '../Common/Topbar.vue'
import UserModal from './UserModal.vue'
import ConfirmModal from '../Common/ConfirmModal.vue'

export default {
  name: 'UsersIndex',
  components: {
    Head,
    Link,
    Sidebar,
    Topbar,
    UserModal,
    ConfirmModal
  },
  props: {
    users: {
      type: Object,
      required: true
    },
    filters: {
      type: Object,
      default: () => ({})
    },
    stats: {
      type: Object,
      default: () => ({})
    }
  },
  setup(props) {
    const sidebarCollapsed = ref(false)
    const showModal = ref(false)
    const showDeleteModal = ref(false)
    const selectedUser = ref(null)
    const userToDelete = ref(null)
    const searchQuery = ref(props.filters.search || '')

    const filterOptions = [
      { label: 'All Users', value: 'all' },
      { label: 'Admins', value: 'admin' },
      { label: 'Regular Users', value: 'user' }
    ]

    let searchTimeout = null
    const debouncedSearch = () => {
      clearTimeout(searchTimeout)
      searchTimeout = setTimeout(() => {
        router.get('/admin/users', {
          search: searchQuery.value,
          filter: props.filters.filter
        }, {
          preserveState: true,
          preserveScroll: true
        })
      }, 500)
    }

    const updateFilter = (filter) => {
      router.get('/admin/users', {
        search: searchQuery.value,
        filter: filter
      }, {
        preserveState: true,
        preserveScroll: true
      })
    }

    const handleSidebarToggle = (collapsed) => {
      sidebarCollapsed.value = collapsed
    }

    const openCreateModal = () => {
      selectedUser.value = null
      showModal.value = true
    }

    const openEditModal = (user) => {
      selectedUser.value = user
      showModal.value = true
    }

    const closeModal = () => {
      showModal.value = false
      selectedUser.value = null
    }

    const handleSubmit = (formData) => {
      if (selectedUser.value) {
        // Update existing user
        router.put(`/admin/users/${selectedUser.value.id}`, formData, {
          onSuccess: () => closeModal()
        })
      } else {
        // Create new user
        router.post('/admin/users', formData, {
          onSuccess: () => closeModal()
        })
      }
    }

    const confirmDelete = (user) => {
      userToDelete.value = user
      showDeleteModal.value = true
    }

    const deleteUser = () => {
      if (userToDelete.value) {
        router.delete(`/admin/users/${userToDelete.value.id}`, {
          onSuccess: () => {
            closeDeleteModal()
          }
        })
      }
    }

    const closeDeleteModal = () => {
      showDeleteModal.value = false
      userToDelete.value = null
    }

    const toggleAdmin = (user) => {
      router.post(`/admin/users/${user.id}/toggle-admin`, {}, {
        preserveScroll: true
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
      showModal,
      showDeleteModal,
      selectedUser,
      searchQuery,
      filterOptions,
      handleSidebarToggle,
      openCreateModal,
      openEditModal,
      closeModal,
      handleSubmit,
      confirmDelete,
      deleteUser,
      closeDeleteModal,
      toggleAdmin,
      formatDate,
      debouncedSearch,
      updateFilter
    }
  }
}
</script>
