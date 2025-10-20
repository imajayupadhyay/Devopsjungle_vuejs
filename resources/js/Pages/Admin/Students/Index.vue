<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-900 via-gray-900 to-black">
    <Head>
      <title>Student Management - DevOps Jungle Admin</title>
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
              <h1 class="text-3xl font-bold text-white mb-2">Student Management</h1>
              <p class="text-gray-400">Manage student accounts and information</p>
            </div>
            <button
              @click="openCreateModal"
              class="px-6 py-3 bg-gradient-to-r from-primary-500 to-primary-600 text-white rounded-lg font-semibold hover:from-primary-600 hover:to-primary-700 transition-all duration-200 flex items-center space-x-2 shadow-lg"
            >
              <i class="fas fa-user-plus"></i>
              <span>Add New Student</span>
            </button>
          </div>

          <!-- Stats Cards -->
          <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-xl p-4">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-400 text-sm">Total Students</p>
                  <p class="text-2xl font-bold text-white">{{ stats.total }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-500/20 rounded-lg flex items-center justify-center">
                  <i class="fas fa-user-graduate text-blue-400 text-xl"></i>
                </div>
              </div>
            </div>
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-xl p-4">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-400 text-sm">Active</p>
                  <p class="text-2xl font-bold text-white">{{ stats.active }}</p>
                </div>
                <div class="w-12 h-12 bg-green-500/20 rounded-lg flex items-center justify-center">
                  <i class="fas fa-check-circle text-green-400 text-xl"></i>
                </div>
              </div>
            </div>
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-xl p-4">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-400 text-sm">Inactive</p>
                  <p class="text-2xl font-bold text-white">{{ stats.inactive }}</p>
                </div>
                <div class="w-12 h-12 bg-gray-500/20 rounded-lg flex items-center justify-center">
                  <i class="fas fa-minus-circle text-gray-400 text-xl"></i>
                </div>
              </div>
            </div>
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-xl p-4">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-400 text-sm">Suspended</p>
                  <p class="text-2xl font-bold text-white">{{ stats.suspended }}</p>
                </div>
                <div class="w-12 h-12 bg-red-500/20 rounded-lg flex items-center justify-center">
                  <i class="fas fa-ban text-red-400 text-xl"></i>
                </div>
              </div>
            </div>
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-xl p-4">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-400 text-sm">New (30 days)</p>
                  <p class="text-2xl font-bold text-white">{{ stats.recent }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-500/20 rounded-lg flex items-center justify-center">
                  <i class="fas fa-star text-purple-400 text-xl"></i>
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

        <!-- Students Table -->
        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-xl overflow-hidden">
          <div class="overflow-x-auto">
            <table class="w-full">
              <thead class="bg-white/5 border-b border-white/10">
                <tr>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                    Student
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                    Email
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                    Phone
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                    Status
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                    Registered
                  </th>
                  <th class="px-6 py-4 text-right text-xs font-semibold text-gray-400 uppercase tracking-wider">
                    Actions
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-white/5">
                <tr
                  v-for="student in students.data"
                  :key="student.id"
                  class="hover:bg-white/5 transition-colors"
                >
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center space-x-3">
                      <img
                        :src="student.avatar_url"
                        :alt="student.name"
                        class="w-10 h-10 rounded-full border-2 border-primary-500"
                      />
                      <div>
                        <p class="text-white font-medium">{{ student.name }}</p>
                        <p class="text-gray-400 text-sm">ID: {{ student.id }}</p>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <p class="text-gray-300">{{ student.email }}</p>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <p class="text-gray-300">{{ student.phone }}</p>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span
                      :class="[
                        'px-3 py-1 rounded-full text-xs font-semibold',
                        student.status === 'active'
                          ? 'bg-green-500/20 text-green-300 border border-green-500/30'
                          : student.status === 'inactive'
                          ? 'bg-gray-500/20 text-gray-300 border border-gray-500/30'
                          : 'bg-red-500/20 text-red-300 border border-red-500/30'
                      ]"
                    >
                      <i
                        :class="[
                          student.status === 'active' ? 'fas fa-check-circle' :
                          student.status === 'inactive' ? 'fas fa-minus-circle' :
                          'fas fa-ban'
                        ]"
                        class="mr-1"
                      ></i>
                      {{ student.status.charAt(0).toUpperCase() + student.status.slice(1) }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <p class="text-gray-300 text-sm">{{ formatDate(student.created_at) }}</p>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-right">
                    <div class="flex items-center justify-end space-x-2">
                      <!-- View Details -->
                      <button
                        @click="viewStudent(student)"
                        class="p-2 text-blue-400 hover:bg-blue-500/20 rounded-lg transition-all duration-200"
                        title="View Details"
                      >
                        <i class="fas fa-eye"></i>
                      </button>

                      <!-- Edit -->
                      <button
                        @click="openEditModal(student)"
                        class="p-2 text-green-400 hover:bg-green-500/20 rounded-lg transition-all duration-200"
                        title="Edit Student"
                      >
                        <i class="fas fa-edit"></i>
                      </button>

                      <!-- Status Toggle -->
                      <button
                        v-if="student.status !== 'suspended'"
                        @click="toggleStatus(student)"
                        :class="[
                          'p-2 rounded-lg transition-all duration-200',
                          student.status === 'active'
                            ? 'text-orange-400 hover:bg-orange-500/20'
                            : 'text-green-400 hover:bg-green-500/20'
                        ]"
                        :title="student.status === 'active' ? 'Deactivate' : 'Activate'"
                      >
                        <i :class="student.status === 'active' ? 'fas fa-toggle-on' : 'fas fa-toggle-off'"></i>
                      </button>

                      <!-- Suspend/Activate -->
                      <button
                        @click="student.status === 'suspended' ? activateStudent(student) : suspendStudent(student)"
                        :class="[
                          'p-2 rounded-lg transition-all duration-200',
                          student.status === 'suspended'
                            ? 'text-green-400 hover:bg-green-500/20'
                            : 'text-yellow-400 hover:bg-yellow-500/20'
                        ]"
                        :title="student.status === 'suspended' ? 'Activate' : 'Suspend'"
                      >
                        <i :class="student.status === 'suspended' ? 'fas fa-user-check' : 'fas fa-user-lock'"></i>
                      </button>

                      <!-- Delete -->
                      <button
                        @click="confirmDelete(student)"
                        class="p-2 text-red-400 hover:bg-red-500/20 rounded-lg transition-all duration-200"
                        title="Delete Student"
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
          <div v-if="students.data.length > 0" class="px-6 py-4 border-t border-white/10">
            <div class="flex items-center justify-between">
              <p class="text-gray-400 text-sm">
                Showing {{ students.from }} to {{ students.to }} of {{ students.total }} students
              </p>
              <div class="flex items-center space-x-2">
                <template v-for="link in students.links" :key="link.label">
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
          <div v-if="students.data.length === 0" class="px-6 py-12 text-center">
            <i class="fas fa-user-graduate text-gray-600 text-5xl mb-4"></i>
            <p class="text-gray-400 text-lg">No students found</p>
            <p class="text-gray-500 text-sm mt-2">Try adjusting your search or filters</p>
          </div>
        </div>
      </div>
    </main>

    <!-- Create/Edit Modal -->
    <StudentModal
      :show="showModal"
      :student="selectedStudent"
      @close="closeModal"
      @submit="handleSubmit"
    />

    <!-- View Student Modal -->
    <StudentViewModal
      :show="showViewModal"
      :student="viewingStudent"
      @close="closeViewModal"
    />

    <!-- Delete Confirmation Modal -->
    <ConfirmModal
      :show="showDeleteModal"
      title="Delete Student"
      message="Are you sure you want to delete this student? This action cannot be undone."
      @confirm="deleteStudent"
      @cancel="closeDeleteModal"
    />
  </div>
</template>

<script>
import { Head, Link, router } from '@inertiajs/vue3'
import { ref } from 'vue'
import Sidebar from '../Common/Sidebar.vue'
import Topbar from '../Common/Topbar.vue'
import StudentModal from './StudentModal.vue'
import StudentViewModal from './StudentViewModal.vue'
import ConfirmModal from '../Common/ConfirmModal.vue'

export default {
  name: 'StudentsIndex',
  components: {
    Head,
    Link,
    Sidebar,
    Topbar,
    StudentModal,
    StudentViewModal,
    ConfirmModal
  },
  props: {
    students: {
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
    const showViewModal = ref(false)
    const showDeleteModal = ref(false)
    const selectedStudent = ref(null)
    const viewingStudent = ref(null)
    const studentToDelete = ref(null)
    const searchQuery = ref(props.filters.search || '')

    const filterOptions = [
      { label: 'All', value: 'all' },
      { label: 'Active', value: 'active' },
      { label: 'Inactive', value: 'inactive' },
      { label: 'Suspended', value: 'suspended' }
    ]

    let searchTimeout = null
    const debouncedSearch = () => {
      clearTimeout(searchTimeout)
      searchTimeout = setTimeout(() => {
        router.get('/admin/students', {
          search: searchQuery.value,
          filter: props.filters.filter
        }, {
          preserveState: true,
          preserveScroll: true
        })
      }, 500)
    }

    const updateFilter = (filter) => {
      router.get('/admin/students', {
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
      selectedStudent.value = null
      showModal.value = true
    }

    const openEditModal = (student) => {
      selectedStudent.value = student
      showModal.value = true
    }

    const closeModal = () => {
      showModal.value = false
      selectedStudent.value = null
    }

    const viewStudent = (student) => {
      viewingStudent.value = student
      showViewModal.value = true
    }

    const closeViewModal = () => {
      showViewModal.value = false
      viewingStudent.value = null
    }

    const handleSubmit = (formData) => {
      if (selectedStudent.value) {
        router.put(`/admin/students/${selectedStudent.value.id}`, formData, {
          onSuccess: () => closeModal()
        })
      } else {
        router.post('/admin/students', formData, {
          onSuccess: () => closeModal()
        })
      }
    }

    const confirmDelete = (student) => {
      studentToDelete.value = student
      showDeleteModal.value = true
    }

    const deleteStudent = () => {
      if (studentToDelete.value) {
        router.delete(`/admin/students/${studentToDelete.value.id}`, {
          onSuccess: () => {
            closeDeleteModal()
          }
        })
      }
    }

    const closeDeleteModal = () => {
      showDeleteModal.value = false
      studentToDelete.value = null
    }

    const toggleStatus = (student) => {
      router.post(`/admin/students/${student.id}/toggle-status`, {}, {
        preserveScroll: true
      })
    }

    const suspendStudent = (student) => {
      router.post(`/admin/students/${student.id}/suspend`, {}, {
        preserveScroll: true
      })
    }

    const activateStudent = (student) => {
      router.post(`/admin/students/${student.id}/activate`, {}, {
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
      showViewModal,
      showDeleteModal,
      selectedStudent,
      viewingStudent,
      searchQuery,
      filterOptions,
      handleSidebarToggle,
      openCreateModal,
      openEditModal,
      closeModal,
      viewStudent,
      closeViewModal,
      handleSubmit,
      confirmDelete,
      deleteStudent,
      closeDeleteModal,
      toggleStatus,
      suspendStudent,
      activateStudent,
      formatDate,
      debouncedSearch,
      updateFilter
    }
  }
}
</script>
