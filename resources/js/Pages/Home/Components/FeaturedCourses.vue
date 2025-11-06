<template>
  <!-- Featured Courses -->
  <section class="py-16 bg-gray-50 dark:bg-gray-800">
    <div class="max-w-7xl mx-auto px-4">
      <div class="text-center mb-12" data-aos="fade-up">
        <h2 class="text-3xl lg:text-4xl font-bold text-gray-800 dark:text-white mb-4">Featured Courses</h2>
        <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">Master the most in-demand DevOps technologies with our expert-crafted courses</p>
      </div>

      <div v-if="courses && courses.length > 0" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Dynamic Course Cards -->
        <div
          v-for="(course, index) in courses"
          :key="course.id"
          class="bg-white dark:bg-gray-900 rounded-xl shadow-md card-hover overflow-hidden"
          data-aos="fade-up"
          :data-aos-delay="(index + 1) * 100"
        >
          <div class="gradient-btn h-2"></div>
          <div class="p-6">
            <div class="flex items-center mb-4">
              <div
                class="w-12 h-12 rounded-lg flex items-center justify-center mr-4"
                :style="{ backgroundColor: getColorWithOpacity(course.categoryColor, 0.1) }"
              >
                <i
                  :class="course.categoryIcon || 'fas fa-graduation-cap'"
                  :style="{ color: course.categoryColor || '#047857' }"
                  class="text-xl"
                ></i>
              </div>
              <div>
                <h3 class="font-bold text-gray-800 dark:text-white line-clamp-1">{{ course.title }}</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ course.categoryName }}</p>
              </div>
            </div>
            <p class="text-sm text-gray-600 dark:text-gray-300 mb-4 line-clamp-2">
              {{ course.description }}
            </p>
            <div class="flex items-center justify-between mb-4">
              <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                <i class="fas fa-clock mr-1"></i>
                <span>{{ course.duration }} hours</span>
              </div>
              <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                <i class="fas fa-users mr-1"></i>
                <span>{{ formatNumber(course.students) }} enrolled</span>
              </div>
            </div>
            <div class="flex items-center justify-between mb-2">
              <div class="flex items-center">
                <div class="flex items-center text-yellow-500 mr-2">
                  <i class="fas fa-star text-sm"></i>
                  <span class="ml-1 text-sm font-semibold text-gray-700 dark:text-gray-300">{{ course.rating }}</span>
                </div>
              </div>
              <div v-if="course.originalPrice && course.originalPrice > course.price" class="text-sm text-gray-500 dark:text-gray-400 line-through">
                ${{ course.originalPrice }}
              </div>
            </div>
            <div class="flex items-center justify-between">
              <div class="text-2xl font-bold gradient-text">${{ course.price }}</div>
              <Link
                :href="`/courses/${course.id}`"
                class="gradient-btn text-white px-4 py-2 rounded text-sm font-medium hover:opacity-90"
              >
                View Course
              </Link>
            </div>
          </div>
        </div>
      </div>

      <!-- Empty State -->
      <div v-else class="text-center py-12">
        <i class="fas fa-graduation-cap text-gray-400 text-5xl mb-4"></i>
        <p class="text-gray-600 dark:text-gray-400">No featured courses available at the moment.</p>
      </div>

      <div class="text-center mt-12" data-aos="fade-up" data-aos-delay="400">
        <Link
          href="/courses"
          class="gradient-btn text-white px-8 py-3 rounded-lg font-semibold hover:opacity-90 transform hover:scale-105 transition-all duration-200 inline-block"
        >
          View All Courses <i class="fas fa-arrow-right ml-2"></i>
        </Link>
      </div>
    </div>
  </section>
</template>

<script>
import { Link } from '@inertiajs/vue3'

export default {
  name: 'FeaturedCourses',
  components: {
    Link
  },
  props: {
    courses: {
      type: Array,
      default: () => []
    }
  },
  methods: {
    formatNumber(num) {
      if (!num) return '0'
      return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')
    },
    getColorWithOpacity(color, opacity) {
      if (!color) return `rgba(4, 120, 87, ${opacity})`

      // Convert hex to RGB with opacity
      const hex = color.replace('#', '')
      const r = parseInt(hex.substring(0, 2), 16)
      const g = parseInt(hex.substring(2, 4), 16)
      const b = parseInt(hex.substring(4, 6), 16)

      return `rgba(${r}, ${g}, ${b}, ${opacity})`
    }
  }
}
</script>

<style scoped>
.line-clamp-1 {
  overflow: hidden;
  display: -webkit-box;
  -webkit-line-clamp: 1;
  -webkit-box-orient: vertical;
}

.line-clamp-2 {
  overflow: hidden;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
}
</style>
