<template>
  <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md overflow-hidden border border-gray-100 dark:border-gray-700 transition-all duration-300 hover:shadow-xl hover:border-primary-200 dark:hover:border-primary-600 group">
    <!-- Service Icon & Category -->
    <div class="relative">
      <div class="service-gradient p-6 text-center" :style="getServiceGradient()">
        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mx-auto mb-4 transform group-hover:scale-110 transition-transform duration-300">
          <i :class="service.icon" class="text-3xl text-white"></i>
        </div>
        <span class="bg-white bg-opacity-20 text-white px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wide">
          {{ service.category }}
        </span>
      </div>

      <!-- Popular Badge -->
      <div v-if="service.popular" class="absolute top-4 right-4">
        <span class="bg-yellow-500 text-white px-2 py-1 rounded-full text-xs font-bold shadow-lg">
          <i class="fas fa-star mr-1"></i>Popular
        </span>
      </div>
    </div>

    <!-- Service Content -->
    <div class="p-6">
      <!-- Header -->
      <div class="mb-4">
        <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">
          {{ service.title }}
        </h3>
        <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
          {{ service.description }}
        </p>
      </div>

      <!-- Features -->
      <div class="mb-6">
        <h4 class="font-semibold text-gray-800 dark:text-white text-sm mb-3">What's Included:</h4>
        <ul class="space-y-2">
          <li v-for="feature in service.features.slice(0, 3)" :key="feature" class="flex items-start text-sm">
            <i class="fas fa-check-circle text-primary-600 dark:text-primary-400 mr-2 mt-0.5 flex-shrink-0"></i>
            <span class="text-gray-600 dark:text-gray-300">{{ feature }}</span>
          </li>
          <li v-if="service.features.length > 3" class="text-xs text-gray-500 dark:text-gray-400 pl-6">
            +{{ service.features.length - 3 }} more features
          </li>
        </ul>
      </div>

      <!-- Stats -->
      <div class="grid grid-cols-3 gap-3 mb-6">
        <div class="text-center">
          <div class="text-lg font-bold text-primary-600 dark:text-primary-400">{{ service.duration }}</div>
          <div class="text-xs text-gray-500 dark:text-gray-400">Duration</div>
        </div>
        <div class="text-center">
          <div class="text-lg font-bold text-primary-600 dark:text-primary-400">{{ service.rating }}</div>
          <div class="text-xs text-gray-500 dark:text-gray-400">Rating</div>
        </div>
        <div class="text-center">
          <div class="text-lg font-bold text-primary-600 dark:text-primary-400">{{ formatNumber(service.clients) }}</div>
          <div class="text-xs text-gray-500 dark:text-gray-400">Clients</div>
        </div>
      </div>

      <!-- Pricing -->
      <div class="mb-6">
        <div class="flex items-center justify-between">
          <div>
            <span class="text-2xl font-bold gradient-text">{{ service.pricing.display }}</span>
            <span v-if="service.pricing.period" class="text-sm text-gray-500 dark:text-gray-400 ml-1">{{ service.pricing.period }}</span>
          </div>
          <div v-if="service.pricing.originalPrice" class="text-right">
            <div class="text-sm text-gray-500 dark:text-gray-400 line-through">${{ service.pricing.originalPrice }}</div>
            <div class="text-xs text-green-600 dark:text-green-400 font-semibold">Save {{ service.pricing.savings }}%</div>
          </div>
        </div>
      </div>

      <!-- Actions -->
      <div class="flex gap-3">
        <button
          @click="$emit('get-started', service)"
          class="flex-1 gradient-btn text-white py-2.5 rounded-lg font-semibold hover:opacity-90 transform hover:scale-105 transition-all duration-200 text-sm"
        >
          <i class="fas fa-rocket mr-2"></i>
          Get Started
        </button>
        <a
          :href="`/services/${service.id}`"
          class="flex-1 border-2 border-primary-600 dark:border-primary-400 text-primary-600 dark:text-primary-400 py-2.5 rounded-lg font-semibold hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-colors text-sm text-center flex items-center justify-center"
        >
          <i class="fas fa-info-circle mr-2"></i>
          Learn More
        </a>
      </div>

      <!-- Meta Info -->
      <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
        <div class="flex items-center space-x-3 text-xs text-gray-500 dark:text-gray-400">
          <span class="flex items-center">
            <i class="fas fa-clock mr-1"></i>
            {{ service.deliveryTime }}
          </span>
          <span class="flex items-center">
            <i class="fas fa-users mr-1"></i>
            {{ service.type }}
          </span>
        </div>
        <div class="flex items-center space-x-1">
          <div class="flex">
            <i v-for="n in 5" :key="n" :class="[
              'fas fa-star text-xs',
              n <= Math.floor(service.rating) ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600'
            ]"></i>
          </div>
          <span class="text-xs text-gray-500 dark:text-gray-400 ml-1">({{ formatNumber(service.reviews) }})</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ServiceCard',
  props: {
    service: {
      type: Object,
      required: true
    }
  },
  emits: ['get-started', 'learn-more'],
  methods: {
    getServiceGradient() {
      const gradients = {
        training: 'background: linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
        consulting: 'background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%)',
        mentoring: 'background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)',
        'job-assistance': 'background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%)',
        bootcamp: 'background: linear-gradient(135deg, #fa709a 0%, #fee140 100%)',
        assessment: 'background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%)'
      }
      return gradients[this.service.category] || 'background: linear-gradient(135deg, #047857 0%, #10b981 100%)'
    },
    formatNumber(num) {
      if (num >= 1000000) return (num / 1000000).toFixed(1) + 'M'
      if (num >= 1000) return (num / 1000).toFixed(1) + 'K'
      return num.toString()
    }
  }
}
</script>

<style scoped>
.gradient-btn {
  background: linear-gradient(135deg, #047857 0%, #10b981 100%);
}

.service-gradient {
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
</style>