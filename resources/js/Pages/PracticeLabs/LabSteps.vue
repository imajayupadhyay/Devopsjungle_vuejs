<template>
  <div class="bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 transition-colors duration-200" data-theme="light">
    <!-- Include AOS -->
    <Head>
      <title>{{ lab.title }} - {{ exam.code }} - Practice Labs - DevOpsJungle</title>
      <meta name="description" :content="`Step-by-step practice lab: ${lab.title}. Master ${exam.code} certification skills with hands-on exercises.`">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism.min.css">
    </Head>

    <!-- Header -->
    <DevOpsHeader />

    <!-- Main Content -->
    <div class="flex min-h-screen">
      <!-- Sidebar - Steps Navigation -->
      <StepNavigation
        :exam="exam"
        :lab="lab"
        :current-step="currentStep"
        :completed-steps="completedSteps"
        @step-change="goToStep"
        @reset-lab="resetLab"
      />

      <!-- Main Content Area -->
      <div class="flex-1 ml-80">
        <!-- Step Content -->
        <div class="p-8">
          <div class="max-w-4xl mx-auto">
            <!-- Step Header -->
            <div class="mb-8" data-aos="fade-up">
              <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                  <span class="text-sm text-gray-500 dark:text-gray-400 mr-2">Step {{ currentStep }} of {{ lab.steps.length }}</span>
                  <span class="w-2 h-2 bg-gray-300 dark:bg-gray-600 rounded-full"></span>
                  <span class="text-sm text-gray-500 dark:text-gray-400 ml-2">{{ currentStepData.estimatedTime }}</span>
                </div>
                <div class="flex items-center space-x-2">
                  <button
                    v-if="currentStep > 1"
                    @click="previousStep"
                    class="px-4 py-2 text-sm bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors"
                  >
                    <i class="fas fa-chevron-left mr-2"></i>
                    Previous
                  </button>
                  <button
                    v-if="currentStep < lab.steps.length"
                    @click="nextStep"
                    class="px-4 py-2 text-sm gradient-btn text-white rounded-lg hover:opacity-90 transition-opacity"
                  >
                    Next
                    <i class="fas fa-chevron-right ml-2"></i>
                  </button>
                  <button
                    v-else
                    @click="completeLab"
                    class="px-6 py-2 text-sm bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors font-medium"
                  >
                    <i class="fas fa-check mr-2"></i>
                    Complete Lab
                  </button>
                </div>
              </div>
              <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white mb-2">
                {{ currentStepData.title }}
              </h2>
              <p v-if="currentStepData.description" class="text-gray-600 dark:text-gray-300">
                {{ currentStepData.description }}
              </p>
            </div>

            <!-- Step Content -->
            <div class="prose prose-lg dark:prose-invert max-w-none" data-aos="fade-up" data-aos-delay="100">
              <!-- Instructions -->
              <div v-if="currentStepData.instructions" class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                  <i class="fas fa-clipboard-list mr-2 text-blue-600"></i>
                  Instructions
                </h3>
                <div class="bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-700 rounded-lg p-6">
                  <div v-html="currentStepData.instructions" class="text-gray-700 dark:text-gray-300"></div>
                </div>
              </div>

              <!-- Code Block -->
              <div v-if="currentStepData.code" class="mb-8">
                <div class="flex items-center justify-between mb-4">
                  <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                    <i class="fas fa-code mr-2 text-green-600"></i>
                    {{ currentStepData.codeTitle || 'Code' }}
                  </h3>
                  <button
                    @click="copyCode"
                    class="px-3 py-1 text-sm bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors"
                  >
                    <i class="fas fa-copy mr-1"></i>
                    Copy
                  </button>
                </div>
                <div class="relative">
                  <pre class="bg-gray-900 text-green-400 p-6 rounded-lg overflow-x-auto text-sm"><code>{{ currentStepData.code }}</code></pre>
                </div>
              </div>

              <!-- Expected Output -->
              <div v-if="currentStepData.expectedOutput" class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                  <i class="fas fa-terminal mr-2 text-purple-600"></i>
                  Expected Output
                </h3>
                <div class="bg-gray-900 text-gray-300 p-6 rounded-lg overflow-x-auto text-sm">
                  <pre>{{ currentStepData.expectedOutput }}</pre>
                </div>
              </div>

              <!-- Tips -->
              <div v-if="currentStepData.tips && currentStepData.tips.length > 0" class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                  <i class="fas fa-lightbulb mr-2 text-yellow-600"></i>
                  Tips
                </h3>
                <div class="bg-yellow-50 dark:bg-yellow-900/30 border border-yellow-200 dark:border-yellow-700 rounded-lg p-6">
                  <ul class="space-y-2 text-gray-700 dark:text-gray-300">
                    <li v-for="tip in currentStepData.tips" :key="tip" class="flex items-start">
                      <i class="fas fa-star text-yellow-500 mr-2 mt-1 text-xs"></i>
                      {{ tip }}
                    </li>
                  </ul>
                </div>
              </div>

              <!-- Resources -->
              <div v-if="currentStepData.resources && currentStepData.resources.length > 0" class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                  <i class="fas fa-external-link-alt mr-2 text-indigo-600"></i>
                  Additional Resources
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <a
                    v-for="resource in currentStepData.resources"
                    :key="resource.title"
                    :href="resource.url"
                    target="_blank"
                    class="block p-4 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg hover:border-primary-300 dark:hover:border-primary-600 transition-colors"
                  >
                    <div class="flex items-center">
                      <i :class="resource.icon" class="text-primary-600 mr-3"></i>
                      <div>
                        <div class="font-medium text-gray-900 dark:text-white">{{ resource.title }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">{{ resource.description }}</div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </div>

            <!-- Step Completion -->
            <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-700" data-aos="fade-up">
              <div class="flex items-center justify-between">
                <div class="flex items-center">
                  <input
                    :id="`step-${currentStep}-complete`"
                    type="checkbox"
                    :checked="isStepCompleted"
                    @change="toggleStepCompletion"
                    class="w-5 h-5 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                  >
                  <label :for="`step-${currentStep}-complete`" class="ml-3 text-sm font-medium text-gray-900 dark:text-white">
                    Mark this step as complete
                  </label>
                </div>
                <div class="text-sm text-gray-500 dark:text-gray-400">
                  {{ completedStepsCount }}/{{ lab.steps.length }} steps completed
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Completion Modal -->
    <div v-if="showCompletionModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl max-w-md w-full" data-aos="zoom-in">
        <div class="p-6 text-center">
          <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-trophy text-white text-2xl"></i>
          </div>
          <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Lab Completed!</h3>
          <p class="text-gray-600 dark:text-gray-300 mb-6">
            Congratulations! You've successfully completed the {{ lab.title }} lab.
          </p>
          <div class="flex space-x-3">
            <a
              :href="`/practice-labs/${exam.id}`"
              class="flex-1 py-2 px-4 text-sm text-center border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
            >
              Back to Labs
            </a>
            <button
              @click="nextLab"
              class="flex-1 py-2 px-4 text-sm gradient-btn text-white rounded-lg hover:opacity-90 transition-opacity"
            >
              Next Lab
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <DevOpsFooter />
  </div>
</template>

<script>
import { Head } from '@inertiajs/vue3';
import DevOpsHeader from '../Common/Header.vue';
import DevOpsFooter from '../Common/Footer.vue';
import StepNavigation from './Components/StepNavigation.vue';

export default {
  name: 'LabSteps',
  components: {
    Head,
    DevOpsHeader,
    DevOpsFooter,
    StepNavigation
  },
  props: {
    exam: {
      type: Object,
      required: true
    },
    lab: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      currentStep: 1,
      completedSteps: [],
      showCompletionModal: false
    }
  },
  computed: {
    currentStepData() {
      return this.lab.steps[this.currentStep - 1] || {};
    },
    isStepCompleted() {
      return this.completedSteps.includes(this.currentStep);
    },
    completedStepsCount() {
      return this.completedSteps.length;
    }
  },
  mounted() {
    this.loadAOS();
    this.loadStoredProgress();
  },
  methods: {
    loadAOS() {
      if (typeof window.AOS !== 'undefined') {
        window.AOS.init({
          duration: 600,
          easing: 'ease-out',
          once: true
        });
        return;
      }

      const script = document.createElement('script');
      script.src = 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js';
      script.onload = () => {
        if (typeof window.AOS !== 'undefined') {
          window.AOS.init({
            duration: 600,
            easing: 'ease-out',
            once: true
          });
        }
      };
      document.head.appendChild(script);
    },
    loadStoredProgress() {
      const stored = localStorage.getItem(`lab-${this.lab.id}-progress`);
      if (stored) {
        const progress = JSON.parse(stored);
        this.currentStep = progress.currentStep || 1;
        this.completedSteps = progress.completedSteps || [];
      }
    },
    saveProgress() {
      const progress = {
        currentStep: this.currentStep,
        completedSteps: this.completedSteps
      };
      localStorage.setItem(`lab-${this.lab.id}-progress`, JSON.stringify(progress));
    },
    goToStep(stepNumber) {
      this.currentStep = stepNumber;
      this.saveProgress();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    },
    nextStep() {
      if (this.currentStep < this.lab.steps.length) {
        this.currentStep++;
        this.saveProgress();
        window.scrollTo({ top: 0, behavior: 'smooth' });
      }
    },
    previousStep() {
      if (this.currentStep > 1) {
        this.currentStep--;
        this.saveProgress();
        window.scrollTo({ top: 0, behavior: 'smooth' });
      }
    },
    toggleStepCompletion() {
      if (this.isStepCompleted) {
        this.completedSteps = this.completedSteps.filter(step => step !== this.currentStep);
      } else {
        this.completedSteps.push(this.currentStep);
      }
      this.saveProgress();
    },
    completeLab() {
      // Mark all steps as completed
      this.completedSteps = [...Array(this.lab.steps.length)].map((_, index) => index + 1);
      this.saveProgress();
      this.showCompletionModal = true;
    },
    resetLab() {
      if (confirm('Are you sure you want to reset your progress? This cannot be undone.')) {
        this.currentStep = 1;
        this.completedSteps = [];
        localStorage.removeItem(`lab-${this.lab.id}-progress`);
        window.scrollTo({ top: 0, behavior: 'smooth' });
      }
    },
    copyCode() {
      if (this.currentStepData.code) {
        navigator.clipboard.writeText(this.currentStepData.code).then(() => {
          // Could add a toast notification here
          console.log('Code copied to clipboard');
        });
      }
    },
    nextLab() {
      // This would navigate to the next lab in the sequence
      this.$inertia.visit(`/practice-labs/${this.exam.id}`);
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

.prose {
  max-width: none;
}

.prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
  color: inherit;
}

.prose p, .prose li {
  color: inherit;
}

.prose pre {
  background-color: #1a202c;
  color: #68d391;
}

.prose code {
  color: #68d391;
  background-color: transparent;
}
</style>