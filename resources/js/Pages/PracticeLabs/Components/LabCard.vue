<template>
  <div
    class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-gray-700 overflow-hidden group"
    data-aos="fade-up"
    :data-aos-delay="aosDelay"
  >
    <!-- Lab Status Badge -->
    <div class="relative">
      <div v-if="lab.status === 'completed'" class="absolute top-4 right-4 z-10">
        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
          <i class="fas fa-check text-white text-sm"></i>
        </div>
      </div>
      <div v-else-if="lab.status === 'in-progress'" class="absolute top-4 right-4 z-10">
        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
          <i class="fas fa-play text-white text-sm"></i>
        </div>
      </div>

      <!-- Lab Header -->
      <div class="p-6 border-b border-gray-100 dark:border-gray-700">
        <div class="flex items-start justify-between mb-4">
          <div class="flex items-center">
            <div :class="[
              'w-12 h-12 rounded-lg flex items-center justify-center text-white text-lg mr-4',
              categoryColorClass
            ]">
              <i :class="lab.icon"></i>
            </div>
            <div>
              <span :class="difficultyBadgeClass">
                {{ lab.difficulty }}
              </span>
            </div>
          </div>
        </div>
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 line-clamp-2">
          {{ lab.title }}
        </h3>
        <p class="text-gray-600 dark:text-gray-300 text-sm line-clamp-3 mb-4">
          {{ lab.description }}
        </p>
      </div>

      <!-- Lab Details -->
      <div class="p-6">
        <!-- Lab Stats -->
        <div class="grid grid-cols-3 gap-4 mb-6">
          <div class="text-center">
            <i class="fas fa-clock text-gray-400 dark:text-gray-500 mb-1"></i>
            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ lab.duration }}</div>
            <div class="text-xs text-gray-500 dark:text-gray-400">Duration</div>
          </div>
          <div class="text-center">
            <i class="fas fa-tasks text-gray-400 dark:text-gray-500 mb-1"></i>
            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ lab.steps }}</div>
            <div class="text-xs text-gray-500 dark:text-gray-400">Steps</div>
          </div>
          <div class="text-center">
            <i class="fas fa-star text-gray-400 dark:text-gray-500 mb-1"></i>
            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ lab.rating }}</div>
            <div class="text-xs text-gray-500 dark:text-gray-400">Rating</div>
          </div>
        </div>

        <!-- Skills -->
        <div class="mb-6">
          <h5 class="text-sm font-semibold text-gray-900 dark:text-white mb-2">Skills:</h5>
          <div class="flex flex-wrap gap-2">
            <span
              v-for="skill in displaySkills"
              :key="skill"
              class="px-2 py-1 bg-primary-100 dark:bg-primary-900 text-primary-700 dark:text-primary-300 rounded text-xs font-medium"
            >
              {{ skill }}
            </span>
            <span v-if="lab.skills.length > maxSkillsToShow" class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 rounded text-xs">
              +{{ lab.skills.length - maxSkillsToShow }}
            </span>
          </div>
        </div>

        <!-- Action Button -->
        <a
          :href="labUrl"
          :class="buttonClass"
        >
          <i :class="buttonIcon" class="mr-2"></i>
          {{ buttonText }}
        </a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'LabCard',
  props: {
    lab: {
      type: Object,
      required: true,
      validator(value) {
        const requiredFields = ['id', 'title', 'description', 'difficulty', 'duration', 'steps', 'rating', 'category', 'icon', 'skills', 'status'];
        return requiredFields.every(field => field in value);
      }
    },
    examId: {
      type: String,
      required: true
    },
    aosDelay: {
      type: Number,
      default: 0
    },
    maxSkillsToShow: {
      type: Number,
      default: 2
    },
    baseUrl: {
      type: String,
      default: '/practice-labs'
    }
  },
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
      const baseClass = 'px-2 py-1 rounded-full text-xs font-medium';
      const colorClass = difficulties[this.lab.difficulty] || 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200';
      return `${baseClass} ${colorClass}`;
    },
    displaySkills() {
      return this.lab.skills.slice(0, this.maxSkillsToShow);
    },
    labUrl() {
      return `${this.baseUrl}/${this.examId}/${this.lab.id}`;
    },
    buttonClass() {
      const baseClass = 'w-full py-3 px-4 rounded-lg font-semibold text-center block transition-all duration-200';

      switch (this.lab.status) {
        case 'completed':
          return `${baseClass} bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 hover:bg-green-200 dark:hover:bg-green-800`;
        case 'in-progress':
          return `${baseClass} bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 hover:bg-blue-200 dark:hover:bg-blue-800`;
        default:
          return `${baseClass} gradient-btn text-white hover:opacity-90`;
      }
    },
    buttonIcon() {
      switch (this.lab.status) {
        case 'completed':
          return 'fas fa-check-circle';
        case 'in-progress':
          return 'fas fa-play-circle';
        default:
          return 'fas fa-rocket';
      }
    },
    buttonText() {
      switch (this.lab.status) {
        case 'completed':
          return 'Review Lab';
        case 'in-progress':
          return 'Continue Lab';
        default:
          return 'Start Lab';
      }
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

.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>