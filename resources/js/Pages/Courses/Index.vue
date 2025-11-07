<template>
  <div class="bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 transition-colors duration-200">
    <!-- Include AOS -->
    <Head>
      <title>DevOps Courses - DevOps Jungle</title>
      <meta name="description" content="Master DevOps with comprehensive courses on AWS, Azure, Terraform, Linux, Jenkins, and more. Expert-led training for DevOps professionals.">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    </Head>

    <!-- Header -->
    <DevOpsHeader />

    <!-- Main Content -->
    <main>
      <!-- Hero Section -->
      <section class="gradient-bg py-16 lg:py-20">
        <div class="max-w-7xl mx-auto px-4">
          <div class="text-center mb-12" data-aos="fade-up">
            <div class="flex justify-center mb-6">
              <!-- Animated Course Icon -->
              <div class="relative">
                <div class="w-24 h-24 gradient-btn rounded-2xl flex items-center justify-center animate-float">
                  <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 14l9-5-9-5-9 5 9 5z"/>
                    <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                  </svg>
                </div>
                <div class="absolute -top-2 -right-2 w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center animate-bounce">
                  <i class="fas fa-graduation-cap text-yellow-800 text-sm"></i>
                </div>
              </div>
            </div>
            <h1 class="text-4xl lg:text-6xl font-bold text-gray-800 dark:text-white mb-6 leading-tight">
              Master <span class="gradient-text">DevOps</span> Skills
            </h1>
            <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-3xl mx-auto leading-relaxed">
              Learn from industry experts with hands-on courses covering AWS, Azure, Terraform, Jenkins, Docker, Kubernetes, and more. Build your DevOps career today.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
              <div class="flex items-center text-gray-600 dark:text-gray-300">
                <i class="fas fa-users text-blue-500 mr-2"></i>
                <span>150,000+ Students</span>
              </div>
              <div class="flex items-center text-gray-600 dark:text-gray-300">
                <i class="fas fa-star text-yellow-500 mr-2"></i>
                <span>4.8 Average Rating</span>
              </div>
              <div class="flex items-center text-gray-600 dark:text-gray-300">
                <i class="fas fa-certificate text-purple-500 mr-2"></i>
                <span>Industry Certificates</span>
              </div>
            </div>
          </div>

          <!-- Stats -->
          <div class="grid grid-cols-2 lg:grid-cols-4 gap-6" data-aos="fade-up" data-aos-delay="200">
            <div class="text-center">
              <div class="text-3xl font-bold gradient-text">{{ stats.totalCourses }}</div>
              <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Total Courses</p>
            </div>
            <div class="text-center">
              <div class="text-3xl font-bold gradient-text">{{ stats.totalHours }}</div>
              <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Learning Hours</p>
            </div>
            <div class="text-center">
              <div class="text-3xl font-bold gradient-text">{{ stats.avgRating }}</div>
              <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Avg Rating</p>
            </div>
            <div class="text-center">
              <div class="text-3xl font-bold gradient-text">{{ stats.instructors }}</div>
              <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Expert Instructors</p>
            </div>
          </div>
        </div>
      </section>

      <!-- Filters Section -->
      <section class="py-8 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 sticky top-16 z-40">
        <div class="max-w-7xl mx-auto px-4">
          <CourseFilters
            :categories="categories"
            :selected-category="selectedCategory"
            :search-query="searchQuery"
            :level-filter="levelFilter"
            :duration-filter="durationFilter"
            :sort-option="sortOption"
            @category-change="handleCategoryChange"
            @search-change="handleSearchChange"
            @level-change="handleLevelChange"
            @duration-change="handleDurationChange"
            @sort-change="handleSortChange"
            @clear-filters="clearFilters"
          />
        </div>
      </section>

      <!-- Results Section -->
      <section class="py-16 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4">
          <!-- Results Header -->
          <div class="flex justify-between items-center mb-8" data-aos="fade-up">
            <div>
              <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                {{ filteredCourses.length }} {{ selectedCategory === 'all' ? 'DevOps Courses' : `${getCategoryName(selectedCategory)} Courses` }}
              </h2>
              <p class="text-gray-600 dark:text-gray-300 mt-1">
                {{ searchQuery ? `Results for "${searchQuery}"` : 'Build your DevOps expertise with hands-on training' }}
              </p>
            </div>
            <div class="flex items-center space-x-4">
              <button @click="toggleViewMode" class="p-2 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                <i :class="viewMode === 'grid' ? 'fas fa-list' : 'fas fa-th-large'" class="text-gray-600 dark:text-gray-300"></i>
              </button>
            </div>
          </div>

          <!-- No Results -->
          <div v-if="filteredCourses.length === 0" class="text-center py-16" data-aos="fade-up">
            <div class="w-24 h-24 mx-auto mb-6 text-gray-400 dark:text-gray-500">
              <i class="fas fa-search text-6xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">No courses found</h3>
            <p class="text-gray-600 dark:text-gray-300 mb-6">Try adjusting your filters or search terms</p>
            <button @click="clearFilters" class="gradient-btn text-white px-6 py-2 rounded-lg font-medium hover:opacity-90 transition-opacity">
              Clear All Filters
            </button>
          </div>

          <!-- Course Cards Grid -->
          <div v-else :class="viewMode === 'grid' ? 'grid md:grid-cols-2 lg:grid-cols-3 gap-6' : 'space-y-4'">
            <CourseCard
              v-for="(course, index) in filteredCourses"
              :key="course.id"
              :course="course"
              :view-mode="viewMode"
              :data-aos="'fade-up'"
              :data-aos-delay="index * 100"
              @enroll="handleEnroll"
              @preview="handlePreview"
            />
          </div>

          <!-- Load More Button -->
          <div v-if="canLoadMore" class="text-center mt-12" data-aos="fade-up">
            <button @click="loadMore" class="gradient-btn text-white px-8 py-3 rounded-lg font-semibold hover:opacity-90 transform hover:scale-105 transition-all duration-200">
              <i class="fas fa-plus mr-2"></i>
              Load More Courses
            </button>
          </div>
        </div>
      </section>

      <!-- CTA Section -->
      <section class="py-16 gradient-bg">
        <div class="max-w-4xl mx-auto px-4 text-center" data-aos="fade-up">
          <h2 class="text-3xl lg:text-4xl font-bold text-gray-800 dark:text-white mb-6">
            Ready to Accelerate Your DevOps Career?
          </h2>
          <p class="text-lg text-gray-600 dark:text-gray-300 mb-8">
            Join thousands of professionals who have transformed their careers with our comprehensive DevOps training programs
          </p>
          <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <button class="gradient-btn text-white px-8 py-4 rounded-lg text-lg font-semibold hover:opacity-90 transform hover:scale-105 transition-all duration-200">
              <i class="fas fa-rocket mr-2"></i>
              Start Learning Today
            </button>
            <button class="border-2 border-primary-600 dark:border-primary-400 text-primary-600 dark:text-primary-400 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-primary-50 dark:hover:bg-primary-900 transform hover:scale-105 transition-all duration-200">
              <i class="fas fa-calendar mr-2"></i>
              Book Free Consultation
            </button>
          </div>
        </div>
      </section>
    </main>

    <!-- Footer -->
    <DevOpsFooter />
  </div>
</template>

<script>
import { Head } from '@inertiajs/vue3'
import DevOpsHeader from '../Common/Header.vue'
import DevOpsFooter from '../Common/Footer.vue'
import CourseFilters from './Components/CourseFilters.vue'
import CourseCard from './Components/CourseCard.vue'

export default {
  name: 'CoursesPage',
  components: {
    Head,
    DevOpsHeader,
    DevOpsFooter,
    CourseFilters,
    CourseCard
  },
  props: {
    courses: {
      type: Array,
      default: () => []
    },
    pagination: {
      type: Object,
      default: () => ({})
    },
    categories: {
      type: Array,
      default: () => []
    },
    levels: {
      type: Array,
      default: () => []
    },
    featuredCourses: {
      type: Array,
      default: () => []
    },
    bestsellerCourses: {
      type: Array,
      default: () => []
    },
    filters: {
      type: Object,
      default: () => ({})
    }
  },
  data() {
    return {
      selectedCategory: this.filters.category || 'all',
      searchQuery: this.filters.search || '',
      levelFilter: this.filters.level || 'all',
      durationFilter: 'short',
      sortOption: 'newest',
      viewMode: 'grid',

      stats: {
        totalCourses: this.pagination.total || 0,
        totalHours: 850,
        avgRating: 4.8,
        instructors: 15
      }
    }
  },
  computed: {
    filteredCourses() {
      return this.courses || []
    },
    canLoadMore() {
      return this.pagination && this.pagination.current_page < this.pagination.last_page
    }
  },
  mounted() {
    this.loadAOS()
  },
  methods: {
    loadAOS() {
      if (typeof window.AOS !== 'undefined') {
        window.AOS.init({
          duration: 800,
          easing: 'ease-out',
          once: true
        })
        return
      }

      const script = document.createElement('script')
      script.src = 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js'
      script.onload = () => {
        if (typeof window.AOS !== 'undefined') {
          window.AOS.init({
            duration: 800,
            easing: 'ease-out',
            once: true
          })
        }
      }
      document.head.appendChild(script)
    },
    handleCategoryChange(category) {
      this.selectedCategory = category
      this.$inertia.get('/courses', {
        category: category,
        search: this.searchQuery,
        level: this.levelFilter,
      }, {
        preserveState: true,
        preserveScroll: true
      })
    },
    handleSearchChange(query) {
      this.searchQuery = query
      this.$inertia.get('/courses', {
        search: query,
        category: this.selectedCategory,
        level: this.levelFilter,
      }, {
        preserveState: true,
        preserveScroll: true
      })
    },
    handleLevelChange(level) {
      this.levelFilter = level
      this.$inertia.get('/courses', {
        level: level,
        category: this.selectedCategory,
        search: this.searchQuery,
      }, {
        preserveState: true,
        preserveScroll: true
      })
    },
    handleDurationChange(duration) {
      this.durationFilter = duration
    },
    handleSortChange(sort) {
      this.sortOption = sort
      this.$inertia.get('/courses', {
        sort: sort,
        category: this.selectedCategory,
        search: this.searchQuery,
        level: this.levelFilter,
      }, {
        preserveState: true,
        preserveScroll: true
      })
    },
    clearFilters() {
      this.selectedCategory = 'all'
      this.searchQuery = ''
      this.levelFilter = 'all'
      this.durationFilter = 'short'
      this.sortOption = 'newest'
      this.$inertia.get('/courses', {}, {
        preserveState: true,
        preserveScroll: true
      })
    },
    toggleViewMode() {
      this.viewMode = this.viewMode === 'grid' ? 'list' : 'grid'
    },
    loadMore() {
      if (this.canLoadMore) {
        const nextPage = this.pagination.current_page + 1
        this.$inertia.get('/courses', {
          page: nextPage,
          category: this.selectedCategory,
          search: this.searchQuery,
          level: this.levelFilter,
          sort: this.sortOption,
        }, {
          preserveState: true,
          preserveScroll: false
        })
      }
    },
    getCategoryName(categoryId) {
      const category = this.categories.find(cat => cat.id === categoryId)
      return category ? category.name : categoryId.toUpperCase()
    },
    handleEnroll(course) {
      console.log('Enroll in course:', course)
    },
    handlePreview(course) {
      this.$inertia.visit(`/courses/${course.id}`)
    }
  }
}
</script>

<style scoped>
.gradient-btn {
  background: linear-gradient(135deg, #047857 0%, #10b981 100%);
}

.gradient-bg {
  background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 50%, #bbf7d0 100%);
}

.dark .gradient-bg {
  background: linear-gradient(135deg, #047857 0%, #065f46 50%, #064e3b 100%);
}

.gradient-text {
  background: linear-gradient(135deg, #047857 0%, #10b981 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.dark .gradient-text {
  background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

@keyframes float {
  0%, 100% {
    transform: translateY(0px);
  }
  50% {
    transform: translateY(-10px);
  }
}

.animate-float {
  animation: float 3s ease-in-out infinite;
}
</style>
