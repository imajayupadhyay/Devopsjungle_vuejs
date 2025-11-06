<template>
  <div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-200">
    <Head>
      <title>Courses Management - DevOps Jungle Admin</title>
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
              <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">Courses Management</h1>
              <p class="text-gray-600 dark:text-gray-400">Create and manage DevOps courses</p>
            </div>
            <Link
              :href="route('admin.courses.create')"
              class="px-6 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-lg font-semibold hover:from-emerald-600 hover:to-emerald-700 transition-all duration-200 flex items-center space-x-2 shadow-lg"
            >
              <i class="fas fa-plus"></i>
              <span>Create New Course</span>
            </Link>
          </div>

          <!-- Stats Cards -->
          <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-4 shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-600 dark:text-gray-400 text-sm">Total Courses</p>
                  <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ stats.total }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/20 rounded-lg flex items-center justify-center">
                  <i class="fas fa-graduation-cap text-blue-600 dark:text-blue-400 text-xl"></i>
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
                  <p class="text-gray-600 dark:text-gray-400 text-sm">Featured</p>
                  <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ stats.featured }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900/20 rounded-lg flex items-center justify-center">
                  <i class="fas fa-star text-yellow-600 dark:text-yellow-400 text-xl"></i>
                </div>
              </div>
            </div>
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-4 shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-600 dark:text-gray-400 text-sm">Bestsellers</p>
                  <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ stats.bestseller }}</p>
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
                placeholder="Search courses..."
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

            <!-- Category & Level Filters -->
            <div class="flex gap-2">
              <select
                v-model="localFilters.category"
                @change="updateFilter('category', $event.target.value)"
                class="px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500"
              >
                <option value="all">All Categories</option>
                <option v-for="category in categories" :key="category.id" :value="category.id">
                  {{ category.name }}
                </option>
              </select>

              <select
                v-model="localFilters.level"
                @change="updateFilter('level', $event.target.value)"
                class="px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500"
              >
                <option value="all">All Levels</option>
                <option value="beginner">Beginner</option>
                <option value="intermediate">Intermediate</option>
                <option value="advanced">Advanced</option>
                <option value="expert">Expert</option>
              </select>
            </div>
          </div>
        </div>

        <!-- Bulk Actions -->
        <div v-if="selectedCourses.length > 0" class="bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-xl p-4 mb-6">
          <div class="flex items-center justify-between">
            <span class="text-emerald-700 dark:text-emerald-300 font-medium">
              {{ selectedCourses.length }} course(s) selected
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

        <!-- Courses Table -->
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
                    Course
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                    Category
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                    Level
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                    Pricing
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                    Status
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                    Stats
                  </th>
                  <th class="px-6 py-4 text-right text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                    Actions
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                <tr
                  v-for="course in courses.data"
                  :key="course.id"
                  class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
                >
                  <td class="px-6 py-4">
                    <input
                      type="checkbox"
                      :checked="selectedCourses.includes(course.id)"
                      @change="toggleSelect(course.id)"
                      class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500"
                    />
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex-1 min-w-0">
                      <div class="flex items-center space-x-2 mb-1">
                        <p class="text-gray-800 dark:text-white font-bold">{{ course.title }}</p>
                        <span v-if="course.featured" class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 dark:bg-yellow-900/20 text-yellow-800 dark:text-yellow-300">
                          <i class="fas fa-star mr-1"></i>
                          Featured
                        </span>
                        <span v-if="course.bestseller" class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-orange-100 dark:bg-orange-900/20 text-orange-800 dark:text-orange-300">
                          <i class="fas fa-fire mr-1"></i>
                          Bestseller
                        </span>
                      </div>
                      <p class="text-gray-600 dark:text-gray-400 text-sm line-clamp-1">{{ course.instructor }}</p>
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <div v-if="course.category" class="flex items-center space-x-2">
                      <i :class="course.category.icon || 'fas fa-folder'" class="text-2xl" :style="{ color: course.category.color || '#047857' }"></i>
                      <span class="text-gray-700 dark:text-gray-300 font-medium">{{ course.category.name }}</span>
                    </div>
                    <span v-else class="text-gray-400 dark:text-gray-600 text-sm italic">No category</span>
                  </td>
                  <td class="px-6 py-4">
                    <span
                      :class="[
                        'px-3 py-1 rounded-full text-xs font-semibold',
                        course.level === 'beginner'
                          ? 'bg-green-100 dark:bg-green-900/20 text-green-700 dark:text-green-300'
                          : course.level === 'intermediate'
                          ? 'bg-yellow-100 dark:bg-yellow-900/20 text-yellow-700 dark:text-yellow-300'
                          : course.level === 'advanced'
                          ? 'bg-orange-100 dark:bg-orange-900/20 text-orange-700 dark:text-orange-300'
                          : 'bg-red-100 dark:bg-red-900/20 text-red-700 dark:text-red-300'
                      ]"
                    >
                      {{ formatLevel(course.level) }}
                    </span>
                  </td>
                  <td class="px-6 py-4">
                    <div>
                      <p class="text-gray-800 dark:text-white font-bold">${{ course.price }}</p>
                      <p v-if="course.original_price" class="text-gray-500 dark:text-gray-400 text-xs line-through">
                        ${{ course.original_price }}
                      </p>
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <span
                      :class="[
                        'px-3 py-1 rounded-full text-xs font-semibold',
                        course.status === 'published'
                          ? 'bg-green-100 dark:bg-green-900/20 text-green-700 dark:text-green-300'
                          : course.status === 'draft'
                          ? 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300'
                          : 'bg-red-100 dark:bg-red-900/20 text-red-700 dark:text-red-300'
                      ]"
                    >
                      {{ formatStatus(course.status) }}
                    </span>
                  </td>
                  <td class="px-6 py-4">
                    <div class="space-y-1 text-xs">
                      <div class="flex items-center text-gray-600 dark:text-gray-400">
                        <i class="fas fa-play-circle mr-1"></i>
                        <span>{{ course.lessons }} lessons</span>
                      </div>
                      <div class="flex items-center text-gray-600 dark:text-gray-400">
                        <i class="fas fa-users mr-1"></i>
                        <span>{{ course.students || 0 }} students</span>
                      </div>
                      <div class="flex items-center text-gray-600 dark:text-gray-400">
                        <i class="fas fa-star mr-1"></i>
                        <span>{{ course.rating }} ({{ course.reviews || 0 }})</span>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 text-right">
                    <div class="flex items-center justify-end space-x-2">
                      <!-- Edit -->
                      <Link
                        :href="route('admin.courses.edit', course.id)"
                        class="p-2 text-emerald-600 dark:text-emerald-400 hover:bg-emerald-100 dark:hover:bg-emerald-900/20 rounded-lg transition-all duration-200"
                        title="Edit"
                      >
                        <i class="fas fa-edit"></i>
                      </Link>

                      <!-- Status Actions -->
                      <button
                        v-if="course.status === 'draft'"
                        @click="publishCourse(course)"
                        class="p-2 text-green-600 dark:text-green-400 hover:bg-green-100 dark:hover:bg-green-900/20 rounded-lg transition-all duration-200"
                        title="Publish"
                      >
                        <i class="fas fa-paper-plane"></i>
                      </button>

                      <button
                        v-if="course.status === 'published'"
                        @click="unpublishCourse(course)"
                        class="p-2 text-orange-600 dark:text-orange-400 hover:bg-orange-100 dark:hover:bg-orange-900/20 rounded-lg transition-all duration-200"
                        title="Unpublish"
                      >
                        <i class="fas fa-pause"></i>
                      </button>

                      <!-- Toggle Featured -->
                      <button
                        @click="toggleFeatured(course)"
                        :class="[
                          'p-2 rounded-lg transition-all duration-200',
                          course.featured
                            ? 'text-yellow-600 dark:text-yellow-400 hover:bg-yellow-100 dark:hover:bg-yellow-900/20'
                            : 'text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700'
                        ]"
                        :title="course.featured ? 'Remove from Featured' : 'Mark as Featured'"
                      >
                        <i class="fas fa-star"></i>
                      </button>

                      <!-- Duplicate -->
                      <button
                        @click="duplicateCourse(course)"
                        class="p-2 text-purple-600 dark:text-purple-400 hover:bg-purple-100 dark:hover:bg-purple-900/20 rounded-lg transition-all duration-200"
                        title="Duplicate"
                      >
                        <i class="fas fa-copy"></i>
                      </button>

                      <!-- Delete -->
                      <button
                        @click="confirmDelete(course)"
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
          <div v-if="courses.data.length > 0" class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800">
            <div class="flex items-center justify-between">
              <p class="text-gray-600 dark:text-gray-400 text-sm">
                Showing {{ courses.from }} to {{ courses.to }} of {{ courses.total }} courses
              </p>
              <div class="flex items-center space-x-2">
                <template v-for="link in courses.links" :key="link.label">
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
          <div v-if="courses.data.length === 0" class="px-6 py-12 text-center">
            <i class="fas fa-graduation-cap text-gray-400 dark:text-gray-600 text-5xl mb-4"></i>
            <p class="text-gray-600 dark:text-gray-400 text-lg">No courses found</p>
            <p class="text-gray-500 dark:text-gray-500 text-sm mt-2">Try adjusting your search or filters</p>
          </div>
        </div>
      </div>
    </main>

    <!-- Delete Confirmation Modal -->
    <ConfirmModal
      :show="showDeleteModal"
      title="Delete Course"
      message="Are you sure you want to delete this course? This action cannot be undone."
      @confirm="deleteCourse"
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
  name: 'CoursesIndex',
  components: {
    Head,
    Link,
    Sidebar,
    Topbar,
    ConfirmModal
  },
  props: {
    courses: {
      type: Object,
      required: true
    },
    filters: {
      type: Object,
      default: () => ({
        search: '',
        status: 'all',
        category: 'all',
        level: 'all',
        featured: '',
        bestseller: '',
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
    const courseToDelete = ref(null)
    const searchQuery = ref(props.filters?.search || '')
    const selectedCourses = ref([])

    // Reactive filters object
    const localFilters = ref({
      search: props.filters?.search || '',
      status: props.filters?.status || 'all',
      category: props.filters?.category || 'all',
      level: props.filters?.level || 'all',
      featured: props.filters?.featured || '',
      bestseller: props.filters?.bestseller || '',
      sort_by: props.filters?.sort_by || 'created_at',
      sort_order: props.filters?.sort_order || 'desc'
    })

    const statusFilters = [
      { label: 'All', value: 'all' },
      { label: 'Published', value: 'published' },
      { label: 'Draft', value: 'draft' },
      { label: 'Archived', value: 'archived' }
    ]

    // Computed
    const allSelected = computed(() => {
      return props.courses.data.length > 0 &&
             selectedCourses.value.length === props.courses.data.length
    })

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
      router.get(route('admin.courses.index'), localFilters.value, {
        preserveState: true,
        preserveScroll: true
      })
    }

    const toggleSelect = (id) => {
      const index = selectedCourses.value.indexOf(id)
      if (index > -1) {
        selectedCourses.value.splice(index, 1)
      } else {
        selectedCourses.value.push(id)
      }
    }

    const toggleSelectAll = () => {
      if (allSelected.value) {
        selectedCourses.value = []
      } else {
        selectedCourses.value = props.courses.data.map(course => course.id)
      }
    }

    const bulkAction = (action) => {
      if (selectedCourses.value.length === 0) return

      if (action === 'delete') {
        if (!confirm(`Are you sure you want to delete ${selectedCourses.value.length} course(s)?`)) {
          return
        }
      }

      router.post(route('admin.courses.bulk-action'), {
        action: action,
        course_ids: selectedCourses.value
      }, {
        onSuccess: () => {
          selectedCourses.value = []
        }
      })
    }

    const publishCourse = (course) => {
      router.post(route('admin.courses.publish', course.id))
    }

    const unpublishCourse = (course) => {
      router.post(route('admin.courses.unpublish', course.id))
    }

    const toggleFeatured = (course) => {
      router.post(route('admin.courses.toggle-featured', course.id))
    }

    const duplicateCourse = (course) => {
      router.post(route('admin.courses.duplicate', course.id))
    }

    const confirmDelete = (course) => {
      courseToDelete.value = course
      showDeleteModal.value = true
    }

    const deleteCourse = () => {
      if (courseToDelete.value) {
        router.delete(route('admin.courses.destroy', courseToDelete.value.id), {
          onSuccess: () => {
            closeDeleteModal()
          }
        })
      }
    }

    const closeDeleteModal = () => {
      showDeleteModal.value = false
      courseToDelete.value = null
    }

    const formatStatus = (status) => {
      return status.charAt(0).toUpperCase() + status.slice(1)
    }

    const formatLevel = (level) => {
      return level.charAt(0).toUpperCase() + level.slice(1)
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
      courseToDelete,
      searchQuery,
      selectedCourses,
      localFilters,
      statusFilters,
      allSelected,
      handleSidebarToggle,
      toggleTheme,
      debouncedSearch,
      updateFilter,
      toggleSelect,
      toggleSelectAll,
      bulkAction,
      publishCourse,
      unpublishCourse,
      toggleFeatured,
      duplicateCourse,
      confirmDelete,
      deleteCourse,
      closeDeleteModal,
      formatStatus,
      formatLevel,
      route
    }
  }
}
</script>
