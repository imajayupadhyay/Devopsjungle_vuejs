<template>
  <!-- Popular Exam Dumps -->
  <section class="py-16 gradient-bg">
    <div class="max-w-7xl mx-auto px-4">
      <div class="text-center mb-12" data-aos="fade-up">
        <h2 class="text-3xl lg:text-4xl font-bold text-gray-800 dark:text-white mb-4">Popular Exam Dumps</h2>
        <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">Prepare for certification exams with our updated and verified exam dumps</p>
      </div>

      <!-- No exams message -->
      <div v-if="displayExams.length === 0" class="text-center py-12">
        <p class="text-gray-600 dark:text-gray-400 text-lg">No exam dumps available at the moment.</p>
      </div>

      <div v-else class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Dynamic Exam Cards -->
        <div
          v-for="(exam, index) in displayExams"
          :key="exam.id"
          class="bg-white dark:bg-gray-800 rounded-xl shadow-lg card-hover p-6"
          data-aos="fade-up"
          :data-aos-delay="(index + 1) * 100"
        >
          <div class="flex items-center mb-4">
            <i :class="getProviderIcon(exam.provider)" class="text-2xl mr-3"></i>
            <div>
              <h3 class="font-bold text-gray-800 dark:text-white">{{ exam.code }}</h3>
              <p class="text-sm text-gray-500 dark:text-gray-400 truncate">{{ exam.title }}</p>
            </div>
          </div>
          <div class="mb-4">
            <div class="flex justify-between text-sm text-gray-600 dark:text-gray-300 mb-2">
              <span>Success Rate</span>
              <span>{{ exam.successRate }}%</span>
            </div>
            <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-2">
              <div class="bg-green-500 h-2 rounded-full" :style="`width: ${exam.successRate}%`"></div>
            </div>
          </div>
          <div class="flex items-center justify-between text-sm text-gray-500 dark:text-gray-400 mb-4">
            <span><i class="fas fa-question-circle mr-1"></i>{{ exam.questions }} Questions</span>
            <span><i class="fas fa-clock mr-1"></i>Updated {{ formatDate(exam.lastUpdated) }}</span>
          </div>
          <a :href="`/dumps/${exam.id}`" class="w-full gradient-btn text-white py-2 rounded text-center font-medium hover:opacity-90 block transition-all duration-200">
            <i class="fas fa-eye mr-2"></i>Preview Exam
          </a>
        </div>
      </div>

      <div class="text-center mt-12" data-aos="fade-up" data-aos-delay="400">
        <a href="/dumps" class="gradient-btn text-white px-8 py-3 rounded-lg font-semibold hover:opacity-90 transform hover:scale-105 transition-all duration-200">
          Browse All Exam Dumps <i class="fas fa-arrow-right ml-2"></i>
        </a>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'ExamDumps',
  props: {
    exams: {
      type: Array,
      default: () => []
    }
  },
  computed: {
    displayExams() {
      // Return first 3 exams if we have data, otherwise return empty array
      return this.exams.slice(0, 3)
    }
  },
  mounted() {
    console.log('ExamDumps Component - Received exams:', this.exams)
    console.log('ExamDumps Component - Display exams:', this.displayExams)
  },
  methods: {
    getProviderIcon(provider) {
      const icons = {
        'aws': 'fab fa-aws text-orange-500',
        'azure': 'fab fa-microsoft text-blue-500',
        'gcp': 'fab fa-google text-red-500',
        'kubernetes': 'fas fa-dharmachakra text-blue-400',
        'docker': 'fab fa-docker text-blue-400'
      }
      return icons[provider] || 'fas fa-certificate text-gray-500'
    },
    formatDate(dateString) {
      const date = new Date(dateString)
      return date.toLocaleDateString('en-US', { month: 'short', year: 'numeric' })
    }
  }
}
</script>