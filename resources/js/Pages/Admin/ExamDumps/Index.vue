<template>
  <div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-200">
    <Head>
      <title>Exam Dumps Management - DevOps Jungle Admin</title>
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
              <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">Exam Dumps Management</h1>
              <p class="text-gray-600 dark:text-gray-400">Create and manage certification exam dumps</p>
            </div>
            <Link
              :href="route('admin.exam-dumps.create')"
              class="px-6 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-lg font-semibold hover:from-emerald-600 hover:to-emerald-700 transition-all duration-200 flex items-center space-x-2 shadow-lg"
            >
              <i class="fas fa-plus"></i>
              <span>Create New Dump</span>
            </Link>
          </div>

          <!-- Stats Cards -->
          <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-4 shadow-sm">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-600 dark:text-gray-400 text-sm">Total Dumps</p>
                  <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ stats.total }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/20 rounded-lg flex items-center justify-center">
                  <i class="fas fa-file-alt text-blue-600 dark:text-blue-400 text-xl"></i>
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
                  <p class="text-gray-600 dark:text-gray-400 text-sm">Free Dumps</p>
                  <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ stats.free }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/20 rounded-lg flex items-center justify-center">
                  <i class="fas fa-gift text-purple-600 dark:text-purple-400 text-xl"></i>
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
                placeholder="Search exam dumps..."
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

            <!-- Provider & Difficulty Filters -->
            <div class="flex gap-2">
              <select
                v-model="localFilters.provider"
                @change="updateFilter('provider', $event.target.value)"
                class="px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500"
              >
                <option value="all">All Providers</option>
                <option v-for="provider in providers" :key="provider.id" :value="provider.id">
                  {{ provider.name }}
                </option>
              </select>

              <select
                v-model="localFilters.difficulty"
                @change="updateFilter('difficulty', $event.target.value)"
                class="px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500"
              >
                <option value="all">All Levels</option>
                <option value="beginner">Beginner</option>
                <option value="intermediate">Intermediate</option>
                <option value="expert">Expert</option>
              </select>
            </div>
          </div>
        </div>

        <!-- Bulk Actions -->
        <div v-if="selectedDumps.length > 0" class="bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-xl p-4 mb-6">
          <div class="flex items-center justify-between">
            <span class="text-emerald-700 dark:text-emerald-300 font-medium">
              {{ selectedDumps.length }} exam dump(s) selected
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

        <!-- Exam Dumps Table -->
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
                    Exam
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                    Provider
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                    Difficulty
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
                  v-for="dump in examDumps.data"
                  :key="dump.id"
                  class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
                >
                  <td class="px-6 py-4">
                    <input
                      type="checkbox"
                      :checked="selectedDumps.includes(dump.id)"
                      @change="toggleSelect(dump.id)"
                      class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500"
                    />
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex-1 min-w-0">
                      <div class="flex items-center space-x-2 mb-1">
                        <p class="text-gray-800 dark:text-white font-bold font-mono">{{ dump.code }}</p>
                        <span v-if="dump.featured" class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 dark:bg-yellow-900/20 text-yellow-800 dark:text-yellow-300">
                          <i class="fas fa-star mr-1"></i>
                          Featured
                        </span>
                      </div>
                      <p class="text-gray-600 dark:text-gray-400 text-sm line-clamp-1">{{ dump.title }}</p>
                      <div class="flex items-center space-x-2 mt-1">
                        <span v-if="dump.badge" class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300">
                          {{ dump.badge }}
                        </span>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex items-center space-x-2">
                      <i :class="dump.provider?.icon || 'fas fa-certificate'" class="text-2xl" style="color: #047857"></i>
                      <span class="text-gray-700 dark:text-gray-300 font-medium">{{ dump.provider?.name || 'N/A' }}</span>
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <span
                      :class="[
                        'px-3 py-1 rounded-full text-xs font-semibold',
                        dump.difficulty === 'beginner'
                          ? 'bg-green-100 dark:bg-green-900/20 text-green-700 dark:text-green-300'
                          : dump.difficulty === 'intermediate'
                          ? 'bg-yellow-100 dark:bg-yellow-900/20 text-yellow-700 dark:text-yellow-300'
                          : 'bg-red-100 dark:bg-red-900/20 text-red-700 dark:text-red-300'
                      ]"
                    >
                      {{ formatDifficulty(dump.difficulty) }}
                    </span>
                  </td>
                  <td class="px-6 py-4">
                    <div v-if="dump.is_free" class="flex items-center space-x-1">
                      <span class="px-3 py-1 bg-green-100 dark:bg-green-900/20 text-green-700 dark:text-green-300 rounded-full text-xs font-bold">
                        FREE
                      </span>
                    </div>
                    <div v-else>
                      <p class="text-gray-800 dark:text-white font-bold">${{ dump.price }}</p>
                      <p v-if="dump.original_price" class="text-gray-500 dark:text-gray-400 text-xs line-through">
                        ${{ dump.original_price }}
                      </p>
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <span
                      :class="[
                        'px-3 py-1 rounded-full text-xs font-semibold',
                        dump.status === 'published'
                          ? 'bg-green-100 dark:bg-green-900/20 text-green-700 dark:text-green-300'
                          : dump.status === 'draft'
                          ? 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300'
                          : 'bg-red-100 dark:bg-red-900/20 text-red-700 dark:text-red-300'
                      ]"
                    >
                      {{ formatStatus(dump.status) }}
                    </span>
                  </td>
                  <td class="px-6 py-4">
                    <div class="space-y-1 text-xs">
                      <div class="flex items-center text-gray-600 dark:text-gray-400">
                        <i class="fas fa-question-circle mr-1"></i>
                        <span>{{ dump.questions_count }} Q's</span>
                      </div>
                      <div class="flex items-center text-gray-600 dark:text-gray-400">
                        <i class="fas fa-download mr-1"></i>
                        <span>{{ dump.downloads || 0 }} DL</span>
                      </div>
                      <div class="flex items-center text-gray-600 dark:text-gray-400">
                        <i class="fas fa-eye mr-1"></i>
                        <span>{{ dump.views || 0 }} views</span>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 text-right">
                    <div class="flex items-center justify-end space-x-2">
                      <!-- Edit -->
                      <Link
                        :href="route('admin.exam-dumps.edit', dump.id)"
                        class="p-2 text-emerald-600 dark:text-emerald-400 hover:bg-emerald-100 dark:hover:bg-emerald-900/20 rounded-lg transition-all duration-200"
                        title="Edit"
                      >
                        <i class="fas fa-edit"></i>
                      </Link>

                      <!-- Status Actions -->
                      <button
                        v-if="dump.status === 'draft'"
                        @click="publishDump(dump)"
                        class="p-2 text-green-600 dark:text-green-400 hover:bg-green-100 dark:hover:bg-green-900/20 rounded-lg transition-all duration-200"
                        title="Publish"
                      >
                        <i class="fas fa-paper-plane"></i>
                      </button>

                      <button
                        v-if="dump.status === 'published'"
                        @click="unpublishDump(dump)"
                        class="p-2 text-orange-600 dark:text-orange-400 hover:bg-orange-100 dark:hover:bg-orange-900/20 rounded-lg transition-all duration-200"
                        title="Unpublish"
                      >
                        <i class="fas fa-pause"></i>
                      </button>

                      <!-- Toggle Featured -->
                      <button
                        @click="toggleFeatured(dump)"
                        :class="[
                          'p-2 rounded-lg transition-all duration-200',
                          dump.featured
                            ? 'text-yellow-600 dark:text-yellow-400 hover:bg-yellow-100 dark:hover:bg-yellow-900/20'
                            : 'text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700'
                        ]"
                        :title="dump.featured ? 'Remove from Featured' : 'Mark as Featured'"
                      >
                        <i class="fas fa-star"></i>
                      </button>

                      <!-- Duplicate -->
                      <button
                        @click="duplicateDump(dump)"
                        class="p-2 text-purple-600 dark:text-purple-400 hover:bg-purple-100 dark:hover:bg-purple-900/20 rounded-lg transition-all duration-200"
                        title="Duplicate"
                      >
                        <i class="fas fa-copy"></i>
                      </button>

                      <!-- Delete -->
                      <button
                        @click="confirmDelete(dump)"
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
          <div v-if="examDumps.data.length > 0" class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800">
            <div class="flex items-center justify-between">
              <p class="text-gray-600 dark:text-gray-400 text-sm">
                Showing {{ examDumps.from }} to {{ examDumps.to }} of {{ examDumps.total }} exam dumps
              </p>
              <div class="flex items-center space-x-2">
                <template v-for="link in examDumps.links" :key="link.label">
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
          <div v-if="examDumps.data.length === 0" class="px-6 py-12 text-center">
            <i class="fas fa-file-alt text-gray-400 dark:text-gray-600 text-5xl mb-4"></i>
            <p class="text-gray-600 dark:text-gray-400 text-lg">No exam dumps found</p>
            <p class="text-gray-500 dark:text-gray-500 text-sm mt-2">Try adjusting your search or filters</p>
          </div>
        </div>
      </div>
    </main>

    <!-- Delete Confirmation Modal -->
    <ConfirmModal
      :show="showDeleteModal"
      title="Delete Exam Dump"
      message="Are you sure you want to delete this exam dump? This action cannot be undone."
      @confirm="deleteDump"
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
  name: 'ExamDumpsIndex',
  components: {
    Head,
    Link,
    Sidebar,
    Topbar,
    ConfirmModal
  },
  props: {
    examDumps: {
      type: Object,
      required: true
    },
    filters: {
      type: Object,
      default: () => ({
        search: '',
        status: 'all',
        provider: 'all',
        difficulty: 'all',
        pricing: 'all',
        featured: '',
        sort_by: 'created_at',
        sort_order: 'desc'
      })
    },
    stats: {
      type: Object,
      default: () => ({})
    },
    providers: {
      type: Array,
      default: () => []
    }
  },
  setup(props) {
    const sidebarCollapsed = ref(false)
    const isDark = ref(false)
    const showDeleteModal = ref(false)
    const dumpToDelete = ref(null)
    const searchQuery = ref(props.filters?.search || '')
    const selectedDumps = ref([])

    // Reactive filters object
    const localFilters = ref({
      search: props.filters?.search || '',
      status: props.filters?.status || 'all',
      provider: props.filters?.provider || 'all',
      difficulty: props.filters?.difficulty || 'all',
      pricing: props.filters?.pricing || 'all',
      featured: props.filters?.featured || '',
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
      return props.examDumps.data.length > 0 &&
             selectedDumps.value.length === props.examDumps.data.length
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
      router.get(route('admin.exam-dumps.index'), localFilters.value, {
        preserveState: true,
        preserveScroll: true
      })
    }

    const toggleSelect = (id) => {
      const index = selectedDumps.value.indexOf(id)
      if (index > -1) {
        selectedDumps.value.splice(index, 1)
      } else {
        selectedDumps.value.push(id)
      }
    }

    const toggleSelectAll = () => {
      if (allSelected.value) {
        selectedDumps.value = []
      } else {
        selectedDumps.value = props.examDumps.data.map(dump => dump.id)
      }
    }

    const bulkAction = (action) => {
      if (selectedDumps.value.length === 0) return

      if (action === 'delete') {
        if (!confirm(`Are you sure you want to delete ${selectedDumps.value.length} exam dump(s)?`)) {
          return
        }
      }

      router.post(route('admin.exam-dumps.bulk-action'), {
        action: action,
        exam_dump_ids: selectedDumps.value
      }, {
        onSuccess: () => {
          selectedDumps.value = []
        }
      })
    }

    const publishDump = (dump) => {
      router.post(route('admin.exam-dumps.publish', dump.id))
    }

    const unpublishDump = (dump) => {
      router.post(route('admin.exam-dumps.unpublish', dump.id))
    }

    const toggleFeatured = (dump) => {
      router.post(route('admin.exam-dumps.toggle-featured', dump.id))
    }

    const duplicateDump = (dump) => {
      router.post(route('admin.exam-dumps.duplicate', dump.id))
    }

    const confirmDelete = (dump) => {
      dumpToDelete.value = dump
      showDeleteModal.value = true
    }

    const deleteDump = () => {
      if (dumpToDelete.value) {
        router.delete(route('admin.exam-dumps.destroy', dumpToDelete.value.id), {
          onSuccess: () => {
            closeDeleteModal()
          }
        })
      }
    }

    const closeDeleteModal = () => {
      showDeleteModal.value = false
      dumpToDelete.value = null
    }

    const formatStatus = (status) => {
      return status.charAt(0).toUpperCase() + status.slice(1)
    }

    const formatDifficulty = (difficulty) => {
      return difficulty.charAt(0).toUpperCase() + difficulty.slice(1)
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
      dumpToDelete,
      searchQuery,
      selectedDumps,
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
      publishDump,
      unpublishDump,
      toggleFeatured,
      duplicateDump,
      confirmDelete,
      deleteDump,
      closeDeleteModal,
      formatStatus,
      formatDifficulty,
      route
    }
  }
}
</script>
