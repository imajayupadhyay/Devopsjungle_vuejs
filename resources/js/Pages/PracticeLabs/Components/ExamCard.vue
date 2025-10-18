<template>
  <div
    class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-gray-700 overflow-hidden group"
    data-aos="fade-up"
    :data-aos-delay="aosDelay"
  >
    <!-- Card Header -->
    <div class="p-6 border-b border-gray-100 dark:border-gray-700">
      <div class="flex items-start justify-between mb-4">
        <div class="flex items-center">
          <div :class="[
            'w-12 h-12 rounded-lg flex items-center justify-center text-white text-xl mr-4',
            providerColorClass
          ]">
            <i :class="exam.icon"></i>
          </div>
          <div>
            <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ exam.code }}</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ exam.provider.toUpperCase() }}</p>
          </div>
        </div>
        <span v-if="exam.badge" :class="badgeColorClass">
          {{ exam.badge }}
        </span>
      </div>
      <h4 class="text-xl font-semibold text-gray-900 dark:text-white mb-2 line-clamp-2">
        {{ exam.title }}
      </h4>
      <p class="text-gray-600 dark:text-gray-300 text-sm line-clamp-2">
        {{ exam.description }}
      </p>
    </div>

    <!-- Card Body -->
    <div class="p-6">
      <!-- Lab Stats -->
      <div class="grid grid-cols-2 gap-4 mb-6">
        <div class="text-center">
          <div class="text-2xl font-bold text-primary-600 dark:text-primary-400">{{ exam.labCount }}</div>
          <div class="text-sm text-gray-500 dark:text-gray-400">Practice Labs</div>
        </div>
        <div class="text-center">
          <div class="text-2xl font-bold text-green-600 dark:text-green-400">{{ exam.difficulty }}</div>
          <div class="text-sm text-gray-500 dark:text-gray-400">Difficulty</div>
        </div>
      </div>

      <!-- Topics -->
      <div class="mb-6">
        <h5 class="text-sm font-semibold text-gray-900 dark:text-white mb-2">Lab Topics:</h5>
        <div class="flex flex-wrap gap-2">
          <span
            v-for="topic in displayTopics"
            :key="topic"
            class="px-2 py-1 bg-primary-100 dark:bg-primary-900 text-primary-700 dark:text-primary-300 rounded text-xs font-medium"
          >
            {{ topic }}
          </span>
          <span v-if="exam.topics.length > maxTopicsToShow" class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 rounded text-xs">
            +{{ exam.topics.length - maxTopicsToShow }} more
          </span>
        </div>
      </div>

      <!-- Action Button -->
      <a
        :href="examUrl"
        class="w-full gradient-btn text-white py-3 px-4 rounded-lg font-semibold text-center block hover:opacity-90 transition-opacity group-hover:shadow-lg"
      >
        <i class="fas fa-play mr-2"></i>
        {{ buttonText }}
      </a>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ExamCard',
  props: {
    exam: {
      type: Object,
      required: true,
      validator(value) {
        const requiredFields = ['id', 'title', 'code', 'provider', 'icon', 'difficulty', 'labCount', 'description', 'topics'];
        return requiredFields.every(field => field in value);
      }
    },
    aosDelay: {
      type: Number,
      default: 0
    },
    maxTopicsToShow: {
      type: Number,
      default: 3
    },
    buttonText: {
      type: String,
      default: 'Start Labs'
    },
    baseUrl: {
      type: String,
      default: '/practice-labs'
    }
  },
  computed: {
    providerColorClass() {
      const colors = {
        aws: 'bg-orange-500',
        azure: 'bg-blue-500',
        gcp: 'bg-green-500',
        kubernetes: 'bg-blue-600',
        docker: 'bg-blue-400'
      };
      return colors[this.exam.provider] || 'bg-gray-500';
    },
    badgeColorClass() {
      const badgeClasses = {
        'Popular': 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
        'New': 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
        'Expert': 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200',
        'Hot': 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200'
      };
      const baseClass = 'px-2 py-1 rounded-full text-xs font-medium';
      const colorClass = badgeClasses[this.exam.badge] || 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200';
      return `${baseClass} ${colorClass}`;
    },
    displayTopics() {
      return this.exam.topics.slice(0, this.maxTopicsToShow);
    },
    examUrl() {
      return `${this.baseUrl}/${this.exam.id}`;
    }
  }
}
</script>

<style scoped>
.gradient-btn {
  background: linear-gradient(135deg, #059669 0%, #0891b2 100%);
}

.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>