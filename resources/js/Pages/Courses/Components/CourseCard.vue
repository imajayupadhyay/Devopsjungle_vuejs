<template>
  <div
    :class="[
      'bg-white dark:bg-gray-900 rounded-xl shadow-md card-hover overflow-hidden border border-gray-100 dark:border-gray-700 transition-all duration-300',
      viewMode === 'list' ? 'flex' : ''
    ]"
  >
    <!-- Course Image & Level -->
    <div :class="viewMode === 'list' ? 'w-80 flex-shrink-0' : ''">
      <div class="relative">
        <div :class="[
          'bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 flex items-center justify-center',
          viewMode === 'list' ? 'h-full w-full' : 'h-48'
        ]" :style="getCourseGradient()">
          <div class="text-center text-white">
            <i :class="getCourseIcon()" class="text-5xl mb-2 opacity-90"></i>
            <div v-if="viewMode === 'list'" class="text-white">
              <div class="font-bold text-lg">{{ course.title }}</div>
              <div class="text-sm opacity-90">{{ course.category.toUpperCase() }}</div>
            </div>
          </div>
        </div>

        <!-- Level Badge -->
        <div class="absolute top-3 left-3">
          <span :class="getLevelClass()" class="px-3 py-1 rounded-full text-xs font-bold shadow-lg">
            {{ course.level.charAt(0).toUpperCase() + course.level.slice(1) }}
          </span>
        </div>

        <!-- Featured Badge -->
        <div v-if="course.featured" class="absolute top-3 right-3">
          <span class="bg-yellow-500 text-white px-2 py-1 rounded-full text-xs font-bold shadow-lg">
            <i class="fas fa-star mr-1"></i>Featured
          </span>
        </div>

        <!-- Duration -->
        <div v-if="viewMode === 'grid'" class="absolute bottom-3 right-3">
          <span class="bg-black bg-opacity-50 text-white px-2 py-1 rounded text-xs font-semibold">
            <i class="fas fa-clock mr-1"></i>{{ course.duration }}h
          </span>
        </div>
      </div>
    </div>

    <!-- Content -->
    <div :class="['p-6', viewMode === 'list' ? 'flex-1 flex flex-col justify-between' : '']">
      <div>
        <!-- Header -->
        <div class="flex justify-between items-start mb-4">
          <div :class="viewMode === 'list' ? 'flex-1' : ''">
            <div class="flex items-center space-x-2 mb-2">
              <span class="text-xs font-semibold text-primary-600 dark:text-primary-400 uppercase tracking-wide">
                {{ course.category }}
              </span>
              <span v-if="course.bestseller" class="bg-orange-100 dark:bg-orange-900 text-orange-800 dark:text-orange-200 px-2 py-1 rounded text-xs font-bold">
                Best Seller
              </span>
            </div>
            <h3 class="font-bold text-gray-800 dark:text-white text-lg leading-tight mb-2">{{ course.title }}</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">{{ course.instructor }}</p>
          </div>
          <div v-if="viewMode === 'grid'" class="text-right">
            <div class="text-2xl font-bold gradient-text">${{ course.price }}</div>
            <div v-if="course.originalPrice" class="text-sm text-gray-500 dark:text-gray-400 line-through">${{ course.originalPrice }}</div>
          </div>
        </div>

        <!-- Description -->
        <p class="text-gray-600 dark:text-gray-300 mb-4 text-sm leading-relaxed">{{ course.description }}</p>

        <!-- Stats Grid -->
        <div :class="['grid gap-3 mb-4', viewMode === 'list' ? 'grid-cols-6' : 'grid-cols-3']">
          <div class="text-center">
            <div class="flex items-center justify-center mb-1">
              <i class="fas fa-play-circle text-blue-500 text-sm mr-1"></i>
            </div>
            <div class="text-sm font-bold text-gray-800 dark:text-white">{{ course.lessons }}</div>
            <div class="text-xs text-gray-500 dark:text-gray-400">Lessons</div>
          </div>
          <div class="text-center">
            <div class="flex items-center justify-center mb-1">
              <i class="fas fa-clock text-orange-500 text-sm mr-1"></i>
            </div>
            <div class="text-sm font-bold text-gray-800 dark:text-white">{{ course.duration }}h</div>
            <div class="text-xs text-gray-500 dark:text-gray-400">Duration</div>
          </div>
          <div class="text-center">
            <div class="flex items-center justify-center mb-1">
              <i class="fas fa-users text-green-500 text-sm mr-1"></i>
            </div>
            <div class="text-sm font-bold text-gray-800 dark:text-white">{{ formatNumber(course.students) }}</div>
            <div class="text-xs text-gray-500 dark:text-gray-400">Students</div>
          </div>
          <div v-if="viewMode === 'list'" class="text-center">
            <div class="flex items-center justify-center mb-1">
              <i class="fas fa-star text-yellow-500 text-sm mr-1"></i>
            </div>
            <div class="text-sm font-bold text-gray-800 dark:text-white">{{ course.rating }}</div>
            <div class="text-xs text-gray-500 dark:text-gray-400">Rating</div>
          </div>
          <div v-if="viewMode === 'list'" class="text-center">
            <div class="flex items-center justify-center mb-1">
              <i class="fas fa-certificate text-purple-500 text-sm mr-1"></i>
            </div>
            <div class="text-sm font-bold text-gray-800 dark:text-white">{{ course.certificate ? 'Yes' : 'No' }}</div>
            <div class="text-xs text-gray-500 dark:text-gray-400">Certificate</div>
          </div>
          <div v-if="viewMode === 'list'" class="text-center">
            <div class="flex items-center justify-center mb-1">
              <i class="fas fa-dollar-sign text-purple-500 text-sm mr-1"></i>
            </div>
            <div class="text-sm font-bold text-gray-800 dark:text-white">${{ course.price }}</div>
            <div class="text-xs text-gray-500 dark:text-gray-400">Price</div>
          </div>
        </div>

        <!-- Skills Tags -->
        <div v-if="viewMode === 'grid'" class="mb-4">
          <div class="flex flex-wrap gap-1">
            <span
              v-for="skill in course.skills.slice(0, 3)"
              :key="skill"
              class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-2 py-1 rounded text-xs"
            >
              {{ skill }}
            </span>
            <span v-if="course.skills.length > 3" class="bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400 px-2 py-1 rounded text-xs">
              +{{ course.skills.length - 3 }} more
            </span>
          </div>
        </div>

        <!-- Skills for List View -->
        <div v-if="viewMode === 'list'" class="mb-4">
          <div class="flex flex-wrap gap-1">
            <span
              v-for="skill in course.skills"
              :key="skill"
              class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-2 py-1 rounded text-xs"
            >
              {{ skill }}
            </span>
          </div>
        </div>
      </div>

      <!-- Actions -->
      <div :class="['flex gap-3', viewMode === 'list' ? 'mt-auto' : '']">
        <button
          @click="$emit('enroll', course)"
          class="flex-1 gradient-btn text-white py-2.5 rounded-lg font-semibold hover:opacity-90 transform hover:scale-105 transition-all duration-200 text-sm"
        >
          <i class="fas fa-play mr-2"></i>
          Enroll Now
        </button>
        <button
          @click="$emit('preview', course)"
          class="flex-1 border-2 border-primary-600 dark:border-primary-400 text-primary-600 dark:text-primary-400 py-2.5 rounded-lg font-semibold hover:bg-primary-50 dark:hover:bg-primary-900 transition-colors text-sm"
        >
          <i class="fas fa-eye mr-2"></i>
          Preview
        </button>
      </div>

      <!-- Meta Info -->
      <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
        <div class="flex items-center space-x-4 text-xs text-gray-500 dark:text-gray-400">
          <span class="flex items-center">
            <i class="fas fa-calendar-alt mr-1"></i>
            Updated {{ formatDate(course.lastUpdated) }}
          </span>
          <span class="flex items-center">
            <i class="fas fa-language mr-1"></i>
            {{ course.language }}
          </span>
        </div>
        <div v-if="viewMode === 'grid'" class="flex items-center space-x-1">
          <div class="flex">
            <i v-for="n in 5" :key="n" :class="[
              'fas fa-star text-xs',
              n <= Math.floor(course.rating) ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600'
            ]"></i>
          </div>
          <span class="text-xs text-gray-500 dark:text-gray-400 ml-1">{{ course.rating }} ({{ formatNumber(course.reviews) }})</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'CourseCard',
  props: {
    course: {
      type: Object,
      required: true
    },
    viewMode: {
      type: String,
      default: 'grid',
      validator: (value) => ['grid', 'list'].includes(value)
    }
  },
  emits: ['enroll', 'preview'],
  methods: {
    getCourseIcon() {
      const icons = {
        aws: 'fab fa-aws',
        azure: 'fab fa-microsoft',
        terraform: 'fas fa-code-branch',
        linux: 'fab fa-linux',
        jenkins: 'fas fa-cog',
        docker: 'fab fa-docker',
        kubernetes: 'fas fa-dharmachakra',
        ansible: 'fas fa-server',
        git: 'fab fa-git-alt',
        python: 'fab fa-python',
        devops: 'fas fa-infinity'
      }
      return icons[this.course.category] || 'fas fa-graduation-cap'
    },
    getCourseGradient() {
      const gradients = {
        aws: 'background: linear-gradient(135deg, #FF9900 0%, #FF6600 100%)',
        azure: 'background: linear-gradient(135deg, #0078D4 0%, #005A9E 100%)',
        terraform: 'background: linear-gradient(135deg, #623CE4 0%, #4A29C8 100%)',
        linux: 'background: linear-gradient(135deg, #FCC624 0%, #E3B505 100%)',
        jenkins: 'background: linear-gradient(135deg, #D4E3F4 0%, #4A90E2 100%)',
        docker: 'background: linear-gradient(135deg, #2496ED 0%, #0DB7ED 100%)',
        kubernetes: 'background: linear-gradient(135deg, #326CE5 0%, #1A73E8 100%)',
        ansible: 'background: linear-gradient(135deg, #EE0000 0%, #CC0000 100%)',
        git: 'background: linear-gradient(135deg, #F05032 0%, #E44D26 100%)',
        python: 'background: linear-gradient(135deg, #3776AB 0%, #FFD43B 100%)',
        devops: 'background: linear-gradient(135deg, #047857 0%, #10b981 100%)'
      }
      return gradients[this.course.category] || 'background: linear-gradient(135deg, #047857 0%, #10b981 100%)'
    },
    getLevelClass() {
      const classes = {
        beginner: 'bg-green-500 text-white',
        intermediate: 'bg-yellow-500 text-white',
        advanced: 'bg-orange-500 text-white',
        expert: 'bg-red-500 text-white'
      }
      return classes[this.course.level] || classes.intermediate
    },
    formatNumber(num) {
      if (num >= 1000000) return (num / 1000000).toFixed(1) + 'M'
      if (num >= 1000) return (num / 1000).toFixed(1) + 'K'
      return num.toString()
    },
    formatDate(dateString) {
      const date = new Date(dateString)
      const now = new Date()
      const diffTime = Math.abs(now - date)
      const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24))

      if (diffDays === 1) return 'yesterday'
      if (diffDays < 30) return `${diffDays} days ago`
      if (diffDays < 60) return '1 month ago'
      return `${Math.floor(diffDays / 30)} months ago`
    }
  }
}
</script>

<style scoped>
.gradient-btn {
  background: linear-gradient(135deg, #047857 0%, #10b981 100%);
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

.card-hover {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card-hover:hover {
  transform: translateY(-4px);
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}
</style>