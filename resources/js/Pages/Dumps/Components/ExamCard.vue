<template>
  <div
    :class="[
      'bg-white dark:bg-gray-900 rounded-xl shadow-md card-hover overflow-hidden border border-gray-100 dark:border-gray-700 transition-all duration-300',
      viewMode === 'list' ? 'flex' : ''
    ]"
  >
    <!-- Provider Icon & Badge -->
    <div :class="viewMode === 'list' ? 'w-24 flex-shrink-0' : ''">
      <div class="relative">
        <div :class="[
          'flex items-center justify-center',
          viewMode === 'list' ? 'h-full w-full' : 'h-20'
        ]" :style="getProviderGradient()">
          <div class="flex items-center space-x-3">
            <i :class="getProviderIcon()" class="text-white text-2xl"></i>
            <div v-if="viewMode === 'list'" class="text-white">
              <div class="font-bold text-sm">{{ getProviderName() }}</div>
              <div class="text-xs opacity-90">{{ exam.code }}</div>
            </div>
          </div>
        </div>

        <!-- Badge -->
        <div v-if="exam.badge" class="absolute -top-1 -right-1">
          <span :class="getBadgeClass()" class="px-2 py-1 rounded-full text-xs font-bold shadow-lg">
            {{ exam.badge }}
          </span>
        </div>

        <!-- Difficulty Badge -->
        <div v-if="viewMode === 'grid'" class="absolute bottom-2 left-2">
          <span :class="getDifficultyClass()" class="px-2 py-1 rounded text-xs font-semibold">
            {{ exam.difficulty.charAt(0).toUpperCase() + exam.difficulty.slice(1) }}
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
              <h3 class="font-bold text-gray-800 dark:text-white text-lg leading-tight">{{ exam.title }}</h3>
              <span v-if="exam.featured" class="bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 px-2 py-1 rounded text-xs font-bold">
                <i class="fas fa-star mr-1"></i>Featured
              </span>
            </div>
            <div class="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
              <span class="font-mono font-bold text-primary-600 dark:text-primary-400">{{ exam.code }}</span>
              <span v-if="viewMode === 'list'" :class="getDifficultyClass()" class="px-2 py-1 rounded text-xs font-semibold">
                {{ exam.difficulty.charAt(0).toUpperCase() + exam.difficulty.slice(1) }}
              </span>
            </div>
          </div>
          <div v-if="viewMode === 'grid'" class="text-right">
            <div class="text-2xl font-bold gradient-text">${{ exam.price }}</div>
          </div>
        </div>

        <!-- Description -->
        <p class="text-gray-600 dark:text-gray-300 mb-4 text-sm leading-relaxed">{{ exam.description }}</p>

        <!-- Stats Grid -->
        <div :class="['grid gap-3 mb-4', viewMode === 'list' ? 'grid-cols-5' : 'grid-cols-2']">
          <div class="text-center">
            <div class="flex items-center justify-center mb-1">
              <i class="fas fa-question-circle text-blue-500 text-sm mr-1"></i>
            </div>
            <div class="text-sm font-bold text-gray-800 dark:text-white">{{ exam.questions }}</div>
            <div class="text-xs text-gray-500 dark:text-gray-400">Questions</div>
          </div>
          <div class="text-center">
            <div class="flex items-center justify-center mb-1">
              <i class="fas fa-clock text-orange-500 text-sm mr-1"></i>
            </div>
            <div class="text-sm font-bold text-gray-800 dark:text-white">{{ exam.duration }}m</div>
            <div class="text-xs text-gray-500 dark:text-gray-400">Duration</div>
          </div>
          <div v-if="viewMode === 'list'" class="text-center">
            <div class="flex items-center justify-center mb-1">
              <i class="fas fa-trophy text-yellow-500 text-sm mr-1"></i>
            </div>
            <div class="text-sm font-bold text-gray-800 dark:text-white">{{ exam.passingScore }}</div>
            <div class="text-xs text-gray-500 dark:text-gray-400">Pass Score</div>
          </div>
          <div v-if="viewMode === 'list'" class="text-center">
            <div class="flex items-center justify-center mb-1">
              <i class="fas fa-chart-line text-green-500 text-sm mr-1"></i>
            </div>
            <div class="text-sm font-bold text-gray-800 dark:text-white">{{ exam.successRate }}%</div>
            <div class="text-xs text-gray-500 dark:text-gray-400">Success</div>
          </div>
          <div v-if="viewMode === 'list'" class="text-center">
            <div class="flex items-center justify-center mb-1">
              <i class="fas fa-dollar-sign text-purple-500 text-sm mr-1"></i>
            </div>
            <div class="text-sm font-bold text-gray-800 dark:text-white">${{ exam.price }}</div>
            <div class="text-xs text-gray-500 dark:text-gray-400">Price</div>
          </div>
        </div>

        <!-- Topics Tags -->
        <div v-if="viewMode === 'grid'" class="mb-4">
          <div class="flex flex-wrap gap-1">
            <span
              v-for="topic in exam.topics.slice(0, 3)"
              :key="topic"
              class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-2 py-1 rounded text-xs"
            >
              {{ topic }}
            </span>
            <span v-if="exam.topics.length > 3" class="bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400 px-2 py-1 rounded text-xs">
              +{{ exam.topics.length - 3 }} more
            </span>
          </div>
        </div>

        <!-- Topics for List View -->
        <div v-if="viewMode === 'list'" class="mb-4">
          <div class="flex flex-wrap gap-1">
            <span
              v-for="topic in exam.topics"
              :key="topic"
              class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-2 py-1 rounded text-xs"
            >
              {{ topic }}
            </span>
          </div>
        </div>
      </div>

      <!-- Actions -->
      <div :class="['flex gap-3', viewMode === 'list' ? 'mt-auto' : '']">
        <button
          @click="$emit('download', exam)"
          class="flex-1 gradient-btn text-white py-2.5 rounded-lg font-semibold hover:opacity-90 transform hover:scale-105 transition-all duration-200 text-sm"
        >
          <i class="fas fa-download mr-2"></i>
          Download
        </button>
        <button
          @click="$emit('preview', exam)"
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
            Updated {{ formatDate(exam.lastUpdated) }}
          </span>
          <span class="flex items-center">
            <i class="fas fa-fire mr-1"></i>
            {{ exam.popularity }}% popularity
          </span>
        </div>
        <div v-if="viewMode === 'grid'" class="flex items-center space-x-1">
          <div class="flex">
            <i v-for="n in 5" :key="n" :class="[
              'fas fa-star text-xs',
              n <= Math.round(exam.successRate / 20) ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600'
            ]"></i>
          </div>
          <span class="text-xs text-gray-500 dark:text-gray-400 ml-1">{{ exam.successRate }}%</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ExamCard',
  props: {
    exam: {
      type: Object,
      required: true
    },
    viewMode: {
      type: String,
      default: 'grid',
      validator: (value) => ['grid', 'list'].includes(value)
    }
  },
  emits: ['download', 'preview'],
  methods: {
    getProviderIcon() {
      const icons = {
        aws: 'fab fa-aws',
        azure: 'fab fa-microsoft',
        gcp: 'fab fa-google',
        kubernetes: 'fas fa-dharmachakra',
        docker: 'fab fa-docker'
      }
      return icons[this.exam.provider] || 'fas fa-certificate'
    },
    getProviderName() {
      const names = {
        aws: 'Amazon AWS',
        azure: 'Microsoft Azure',
        gcp: 'Google Cloud',
        kubernetes: 'Kubernetes',
        docker: 'Docker'
      }
      return names[this.exam.provider] || this.exam.provider.toUpperCase()
    },
    getProviderGradient() {
      const gradients = {
        aws: 'background: linear-gradient(135deg, #FF9900 0%, #FF6600 100%)',
        azure: 'background: linear-gradient(135deg, #0078D4 0%, #005A9E 100%)',
        gcp: 'background: linear-gradient(135deg, #4285F4 0%, #34A853 50%, #FBBC04 100%)',
        kubernetes: 'background: linear-gradient(135deg, #326CE5 0%, #1A73E8 100%)',
        docker: 'background: linear-gradient(135deg, #2496ED 0%, #0DB7ED 100%)'
      }
      return gradients[this.exam.provider] || 'background: linear-gradient(135deg, #047857 0%, #10b981 100%)'
    },
    getDifficultyClass() {
      const classes = {
        beginner: 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200',
        intermediate: 'bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200',
        expert: 'bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200'
      }
      return classes[this.exam.difficulty] || classes.intermediate
    },
    getBadgeClass() {
      const classes = {
        'Most Popular': 'bg-red-500 text-white',
        'High Demand': 'bg-orange-500 text-white',
        'Entry Level': 'bg-green-500 text-white',
        'Hands-on': 'bg-blue-500 text-white'
      }
      return classes[this.exam.badge] || 'bg-purple-500 text-white'
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