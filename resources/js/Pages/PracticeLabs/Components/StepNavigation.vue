<template>
  <div class="w-80 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 fixed left-0 top-16 h-full overflow-y-auto z-30">
    <!-- Lab Header -->
    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
      <!-- Breadcrumb -->
      <nav class="flex items-center space-x-1 text-sm mb-4">
        <a href="/practice-labs" class="text-gray-500 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400">Labs</a>
        <i class="fas fa-chevron-right text-gray-400 dark:text-gray-500 text-xs"></i>
        <a :href="examUrl" class="text-gray-500 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400">{{ exam.code }}</a>
        <i class="fas fa-chevron-right text-gray-400 dark:text-gray-500 text-xs"></i>
        <span class="text-gray-900 dark:text-white font-medium">Lab</span>
      </nav>

      <!-- Lab Info -->
      <div class="flex items-center mb-4">
        <div :class="[
          'w-12 h-12 rounded-lg flex items-center justify-center text-white text-lg mr-4',
          categoryColorClass
        ]">
          <i :class="lab.icon"></i>
        </div>
        <div>
          <h1 class="text-lg font-bold text-gray-900 dark:text-white line-clamp-2">{{ lab.title }}</h1>
          <div class="flex items-center space-x-2 mt-1">
            <span :class="difficultyBadgeClass">
              {{ lab.difficulty }}
            </span>
            <span class="text-xs text-gray-500 dark:text-gray-400">{{ lab.duration }}</span>
          </div>
        </div>
      </div>

      <!-- Progress -->
      <div class="mb-4">
        <div class="flex justify-between text-sm mb-2">
          <span class="text-gray-700 dark:text-gray-300">Progress</span>
          <span class="text-gray-900 dark:text-white font-medium">{{ currentStep }}/{{ lab.steps.length }}</span>
        </div>
        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
          <div
            class="bg-gradient-to-r from-primary-500 to-blue-600 h-2 rounded-full transition-all duration-300"
            :style="{ width: progressPercentage + '%' }"
          ></div>
        </div>
      </div>
    </div>

    <!-- Steps List -->
    <div class="p-4">
      <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
        <i class="fas fa-list-ol mr-2 text-primary-600"></i>
        Lab Steps
      </h3>
      <div class="space-y-2">
        <button
          v-for="(step, index) in lab.steps"
          :key="step.id"
          @click="$emit('step-change', index + 1)"
          :class="getStepButtonClass(index + 1)"
        >
          <div class="flex items-center">
            <div :class="getStepIndicatorClass(index + 1)">
              <i v-if="currentStep > index + 1" class="fas fa-check"></i>
              <span v-else>{{ index + 1 }}</span>
            </div>
            <div class="flex-1 min-w-0">
              <div class="text-sm font-medium line-clamp-2">{{ step.title }}</div>
              <div v-if="step.estimatedTime" class="text-xs opacity-75 mt-1">{{ step.estimatedTime }}</div>
            </div>
          </div>
        </button>
      </div>
    </div>

    <!-- Lab Actions -->
    <div class="p-4 border-t border-gray-200 dark:border-gray-700 space-y-3">
      <button
        @click="$emit('reset-lab')"
        class="w-full py-2 px-4 text-sm bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors"
      >
        <i class="fas fa-redo mr-2"></i>
        {{ resetButtonText }}
      </button>
      <a
        :href="examUrl"
        class="w-full py-2 px-4 text-sm text-center block border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
      >
        <i class="fas fa-arrow-left mr-2"></i>
        {{ backButtonText }}
      </a>
    </div>
  </div>
</template>

<script>
export default {
  name: 'StepNavigation',
  props: {
    exam: {
      type: Object,
      required: true,
      validator(value) {
        return 'code' in value && 'id' in value;
      }
    },
    lab: {
      type: Object,
      required: true,
      validator(value) {
        const requiredFields = ['title', 'difficulty', 'duration', 'category', 'icon', 'steps'];
        return requiredFields.every(field => field in value);
      }
    },
    currentStep: {
      type: Number,
      required: true,
      validator(value) {
        return value >= 1;
      }
    },
    completedSteps: {
      type: Array,
      default: () => []
    },
    resetButtonText: {
      type: String,
      default: 'Reset Lab'
    },
    backButtonText: {
      type: String,
      default: 'Back to Labs'
    },
    baseUrl: {
      type: String,
      default: '/practice-labs'
    }
  },
  emits: ['step-change', 'reset-lab'],
  computed: {
    categoryColorClass() {
      const colors = {
        compute: 'bg-blue-500',
        storage: 'bg-green-500',
        database: 'bg-purple-500',
        networking: 'bg-orange-500',
        security: 'bg-red-500',
        monitoring: 'bg-yellow-500',
        deployment: 'bg-indigo-500'
      };
      return colors[this.lab.category] || 'bg-gray-500';
    },
    difficultyBadgeClass() {
      const difficulties = {
        'Beginner': 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
        'Intermediate': 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
        'Advanced': 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200'
      };
      const baseClass = 'px-2 py-1 rounded text-xs font-medium';
      const colorClass = difficulties[this.lab.difficulty] || 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200';
      return `${baseClass} ${colorClass}`;
    },
    progressPercentage() {
      return (this.currentStep / this.lab.steps.length) * 100;
    },
    examUrl() {
      return `${this.baseUrl}/${this.exam.id}`;
    }
  },
  methods: {
    getStepButtonClass(stepNumber) {
      const baseClass = 'w-full text-left p-3 rounded-lg transition-all duration-200 border';

      if (this.currentStep === stepNumber) {
        return `${baseClass} bg-primary-50 dark:bg-primary-900 border-primary-200 dark:border-primary-700 text-primary-900 dark:text-primary-100`;
      } else if (this.currentStep > stepNumber) {
        return `${baseClass} bg-green-50 dark:bg-green-900 border-green-200 dark:border-green-700 text-green-900 dark:text-green-100`;
      } else {
        return `${baseClass} bg-gray-50 dark:bg-gray-700 border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600`;
      }
    },
    getStepIndicatorClass(stepNumber) {
      const baseClass = 'w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold mr-3 flex-shrink-0';

      if (this.currentStep === stepNumber) {
        return `${baseClass} bg-primary-600 text-white`;
      } else if (this.currentStep > stepNumber) {
        return `${baseClass} bg-green-600 text-white`;
      } else {
        return `${baseClass} bg-gray-300 dark:bg-gray-600 text-gray-600 dark:text-gray-300`;
      }
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
</style>