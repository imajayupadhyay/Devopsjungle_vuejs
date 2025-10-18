<template>
  <!-- Search Modal -->
  <div v-show="isVisible" class="fixed inset-0 z-50 overflow-y-auto" @click="handleOutsideClick">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity"></div>

    <!-- Modal Content -->
    <div class="flex min-h-screen items-start justify-center p-4 pt-16">
      <div
        ref="modalContent"
        class="relative w-full max-w-3xl transform transition-all"
        @click.stop
      >
        <!-- Search Container -->
        <div class="bg-white/95 dark:bg-gray-900/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/20 dark:border-gray-700/50 overflow-hidden">
          <!-- Search Header -->
          <div class="p-6 border-b border-gray-100 dark:border-gray-700/50">
            <div class="flex items-center justify-between mb-4">
              <h2 class="text-xl font-bold text-gray-800 dark:text-white">
                Search <span class="gradient-text">DevOps Jungle</span>
              </h2>
              <button
                @click="$emit('close')"
                class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition-colors p-2 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg"
              >
                <i class="fas fa-times text-lg"></i>
              </button>
            </div>

            <!-- Search Input -->
            <div class="relative">
              <input
                ref="searchInput"
                v-model="searchQuery"
                @input="handleSearch"
                @keydown="handleKeydown"
                type="text"
                placeholder="Search courses, certifications, practice labs, services..."
                class="w-full pl-12 pr-12 py-4 text-lg border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-xl focus:outline-none focus:border-emerald-500 dark:focus:border-emerald-400 transition-colors"
              >
              <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                <i class="fas fa-search text-gray-400 dark:text-gray-500 text-lg"></i>
              </div>
              <div v-if="searchQuery" class="absolute right-4 top-1/2 transform -translate-y-1/2">
                <button
                  @click="clearSearch"
                  class="text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 transition-colors"
                >
                  <i class="fas fa-times text-sm"></i>
                </button>
              </div>
            </div>

            <!-- Search Suggestions -->
            <div v-if="!searchQuery" class="mt-4">
              <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Popular searches:</p>
              <div class="flex flex-wrap gap-2">
                <button
                  v-for="suggestion in popularSearches"
                  :key="suggestion"
                  @click="searchQuery = suggestion; handleSearch()"
                  class="px-3 py-1.5 text-sm bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 rounded-lg hover:bg-emerald-100 dark:hover:bg-emerald-900/50 transition-colors"
                >
                  {{ suggestion }}
                </button>
              </div>
            </div>
          </div>

          <!-- Search Results -->
          <div class="max-h-96 overflow-y-auto">
            <!-- Loading State -->
            <div v-if="isLoading" class="p-8 text-center">
              <div class="animate-spin w-8 h-8 border-2 border-emerald-500 border-t-transparent rounded-full mx-auto mb-4"></div>
              <p class="text-gray-600 dark:text-gray-400">Searching...</p>
            </div>

            <!-- No Query State -->
            <div v-else-if="!searchQuery" class="p-8">
              <div class="text-center">
                <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-green-500 rounded-xl flex items-center justify-center mx-auto mb-4">
                  <i class="fas fa-search text-white text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">What are you looking for?</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Search across courses, certifications, practice labs, and services</p>

                <!-- Quick Categories -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                  <div
                    v-for="category in quickCategories"
                    :key="category.name"
                    @click="navigateToCategory(category.path)"
                    class="p-4 bg-gray-50 dark:bg-gray-800/50 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors cursor-pointer group"
                  >
                    <div :class="category.iconColor" class="text-2xl mb-2 group-hover:scale-110 transition-transform">
                      <i :class="category.icon"></i>
                    </div>
                    <p class="text-sm font-medium text-gray-800 dark:text-white">{{ category.name }}</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- No Results -->
            <div v-else-if="searchResults.length === 0 && !isLoading" class="p-8 text-center">
              <div class="w-16 h-16 bg-gray-100 dark:bg-gray-800 rounded-xl flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-search text-gray-400 text-2xl"></i>
              </div>
              <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">No results found</h3>
              <p class="text-gray-600 dark:text-gray-400">Try adjusting your search terms or browse our categories above</p>
            </div>

            <!-- Search Results -->
            <div v-else class="p-4">
              <p class="text-sm text-gray-600 dark:text-gray-400 mb-4 px-2">
                Found {{ searchResults.length }} result{{ searchResults.length !== 1 ? 's' : '' }} for "{{ searchQuery }}"
              </p>

              <div class="space-y-2">
                <div
                  v-for="(result, index) in searchResults"
                  :key="result.id"
                  @click="navigateToResult(result)"
                  :class="{ 'bg-emerald-50 dark:bg-emerald-900/20': selectedIndex === index }"
                  class="p-4 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors cursor-pointer group"
                >
                  <div class="flex items-start space-x-4">
                    <div :class="result.iconColor" class="flex-shrink-0 w-10 h-10 rounded-lg flex items-center justify-center text-white">
                      <i :class="result.icon" class="text-sm"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                      <h4 class="text-sm font-semibold text-gray-800 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                        {{ result.title }}
                      </h4>
                      <p class="text-xs text-gray-600 dark:text-gray-400 mt-1 line-clamp-2">
                        {{ result.description }}
                      </p>
                      <div class="flex items-center mt-2 space-x-3">
                        <span class="text-xs px-2 py-1 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 rounded-lg">
                          {{ result.category }}
                        </span>
                        <span v-if="result.difficulty" class="text-xs text-gray-500 dark:text-gray-400">
                          {{ result.difficulty }}
                        </span>
                      </div>
                    </div>
                    <div class="flex-shrink-0">
                      <i class="fas fa-arrow-right text-gray-400 group-hover:text-emerald-500 transition-colors text-sm"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Footer -->
          <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-100 dark:border-gray-700/50">
            <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
              <div class="flex items-center space-x-4">
                <span><kbd class="px-2 py-1 bg-white dark:bg-gray-700 rounded border">↑↓</kbd> Navigate</span>
                <span><kbd class="px-2 py-1 bg-white dark:bg-gray-700 rounded border">Enter</kbd> Select</span>
                <span><kbd class="px-2 py-1 bg-white dark:bg-gray-700 rounded border">Esc</kbd> Close</span>
              </div>
              <span>Powered by DevOps Jungle Search</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'SearchModal',
  props: {
    isVisible: {
      type: Boolean,
      default: false
    }
  },
  emits: ['close'],
  data() {
    return {
      searchQuery: '',
      searchResults: [],
      isLoading: false,
      selectedIndex: -1,
      searchTimeout: null,

      popularSearches: [
        'AWS Certification', 'Docker', 'Kubernetes', 'DevOps Engineer', 'Azure', 'GCP', 'Jenkins', 'Terraform'
      ],

      quickCategories: [
        {
          name: 'Courses',
          icon: 'fas fa-graduation-cap',
          iconColor: 'text-blue-500',
          path: '/courses'
        },
        {
          name: 'Practice Labs',
          icon: 'fas fa-flask',
          iconColor: 'text-purple-500',
          path: '/practice-labs'
        },
        {
          name: 'Exam Dumps',
          icon: 'fas fa-certificate',
          iconColor: 'text-orange-500',
          path: '/dumps'
        },
        {
          name: 'Services',
          icon: 'fas fa-briefcase',
          iconColor: 'text-emerald-500',
          path: '/services'
        }
      ],

      // Mock data for demonstration - replace with real API calls
      allContent: [
        {
          id: 1,
          title: 'AWS Solutions Architect Associate (SAA-C03)',
          description: 'Complete course for AWS SAA-C03 certification with hands-on labs and practice exams',
          category: 'Course',
          difficulty: 'Intermediate',
          icon: 'fab fa-aws',
          iconColor: 'bg-orange-500',
          path: '/courses/aws-saa-c03'
        },
        {
          id: 2,
          title: 'Docker Fundamentals',
          description: 'Learn containerization with Docker from basics to advanced concepts',
          category: 'Course',
          difficulty: 'Beginner',
          icon: 'fab fa-docker',
          iconColor: 'bg-blue-500',
          path: '/courses/docker-fundamentals'
        },
        {
          id: 3,
          title: 'Kubernetes CKA Practice Labs',
          description: 'Hands-on labs for Certified Kubernetes Administrator certification',
          category: 'Practice Lab',
          difficulty: 'Advanced',
          icon: 'fas fa-dharmachakra',
          iconColor: 'bg-purple-500',
          path: '/practice-labs/cka'
        },
        {
          id: 4,
          title: 'Corporate DevOps Training',
          description: 'Enterprise-level DevOps training for teams and organizations',
          category: 'Service',
          difficulty: 'All Levels',
          icon: 'fas fa-building',
          iconColor: 'bg-emerald-500',
          path: '/services/corporate-devops-training'
        },
        {
          id: 5,
          title: 'Azure Fundamentals (AZ-900)',
          description: 'Microsoft Azure fundamentals certification preparation',
          category: 'Exam Dump',
          difficulty: 'Beginner',
          icon: 'fab fa-microsoft',
          iconColor: 'bg-blue-600',
          path: '/dumps/az-900'
        }
      ]
    }
  },
  watch: {
    isVisible(newVal) {
      if (newVal) {
        this.$nextTick(() => {
          if (this.$refs.searchInput) {
            this.$refs.searchInput.focus()
          }
        })
        document.addEventListener('keydown', this.handleGlobalKeydown)
      } else {
        document.removeEventListener('keydown', this.handleGlobalKeydown)
        this.clearSearch()
      }
    }
  },
  methods: {
    handleSearch() {
      if (this.searchTimeout) {
        clearTimeout(this.searchTimeout)
      }

      this.searchTimeout = setTimeout(() => {
        this.performSearch()
      }, 300)
    },

    performSearch() {
      if (!this.searchQuery.trim()) {
        this.searchResults = []
        return
      }

      this.isLoading = true
      this.selectedIndex = -1

      // Simulate API call delay
      setTimeout(() => {
        const query = this.searchQuery.toLowerCase()
        this.searchResults = this.allContent.filter(item =>
          item.title.toLowerCase().includes(query) ||
          item.description.toLowerCase().includes(query) ||
          item.category.toLowerCase().includes(query)
        )
        this.isLoading = false
      }, 500)
    },

    clearSearch() {
      this.searchQuery = ''
      this.searchResults = []
      this.selectedIndex = -1
      if (this.searchTimeout) {
        clearTimeout(this.searchTimeout)
      }
    },

    navigateToResult(result) {
      this.$emit('close')
      // Use Inertia.js navigation
      this.$inertia.visit(result.path)
    },

    navigateToCategory(path) {
      this.$emit('close')
      this.$inertia.visit(path)
    },

    handleKeydown(event) {
      if (event.key === 'ArrowDown') {
        event.preventDefault()
        this.selectedIndex = Math.min(this.selectedIndex + 1, this.searchResults.length - 1)
      } else if (event.key === 'ArrowUp') {
        event.preventDefault()
        this.selectedIndex = Math.max(this.selectedIndex - 1, -1)
      } else if (event.key === 'Enter') {
        event.preventDefault()
        if (this.selectedIndex >= 0 && this.searchResults[this.selectedIndex]) {
          this.navigateToResult(this.searchResults[this.selectedIndex])
        }
      }
    },

    handleGlobalKeydown(event) {
      if (event.key === 'Escape') {
        this.$emit('close')
      }
    },

    handleOutsideClick(event) {
      if (event.target === event.currentTarget) {
        this.$emit('close')
      }
    }
  },

  beforeUnmount() {
    document.removeEventListener('keydown', this.handleGlobalKeydown)
    if (this.searchTimeout) {
      clearTimeout(this.searchTimeout)
    }
  }
}
</script>

<style scoped>
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

kbd {
  font-family: ui-monospace, SFMono-Regular, Consolas, 'Liberation Mono', Menlo, monospace;
  font-size: 10px;
  line-height: 1;
}
</style>