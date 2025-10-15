<template>
  <!-- Popular Exam Dumps -->
  <section class="py-16 gradient-bg">
    <div class="max-w-7xl mx-auto px-4">
      <div class="text-center mb-12" data-aos="fade-up">
        <h2 class="text-3xl lg:text-4xl font-bold text-gray-800 dark:text-white mb-4">Popular Exam Dumps</h2>
        <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">Prepare for certification exams with our updated and verified exam dumps</p>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Exam Card 1 -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg card-hover p-6" data-aos="fade-up" data-aos-delay="100">
          <div class="flex items-center mb-4">
            <i class="fab fa-aws text-orange-500 text-2xl mr-3"></i>
            <div>
              <h3 class="font-bold text-gray-800 dark:text-white">AWS-SAA-C03</h3>
              <p class="text-sm text-gray-500 dark:text-gray-400">Solutions Architect Associate</p>
            </div>
          </div>
          <div class="mb-4">
            <div class="flex justify-between text-sm text-gray-600 dark:text-gray-300 mb-2">
              <span>Success Rate</span>
              <span>95%</span>
            </div>
            <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-2">
              <div class="bg-green-500 h-2 rounded-full" style="width: 95%"></div>
            </div>
          </div>
          <div class="flex items-center justify-between text-sm text-gray-500 dark:text-gray-400 mb-4">
            <span><i class="fas fa-question-circle mr-1"></i>385 Questions</span>
            <span><i class="fas fa-clock mr-1"></i>Updated Dec 2024</span>
          </div>
          <a href="#" @click="handleDownloadClick" class="w-full gradient-btn text-white py-2 rounded text-center font-medium hover:opacity-90 block">Download Now</a>
        </div>

        <!-- Exam Card 2 -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg card-hover p-6" data-aos="fade-up" data-aos-delay="200">
          <div class="flex items-center mb-4">
            <i class="fab fa-microsoft text-blue-500 text-2xl mr-3"></i>
            <div>
              <h3 class="font-bold text-gray-800 dark:text-white">AZ-400</h3>
              <p class="text-sm text-gray-500 dark:text-gray-400">Azure DevOps Engineer Expert</p>
            </div>
          </div>
          <div class="mb-4">
            <div class="flex justify-between text-sm text-gray-600 dark:text-gray-300 mb-2">
              <span>Success Rate</span>
              <span>92%</span>
            </div>
            <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-2">
              <div class="bg-green-500 h-2 rounded-full" style="width: 92%"></div>
            </div>
          </div>
          <div class="flex items-center justify-between text-sm text-gray-500 dark:text-gray-400 mb-4">
            <span><i class="fas fa-question-circle mr-1"></i>298 Questions</span>
            <span><i class="fas fa-clock mr-1"></i>Updated Nov 2024</span>
          </div>
          <a href="#" @click="handleDownloadClick" class="w-full gradient-btn text-white py-2 rounded text-center font-medium hover:opacity-90 block">Download Now</a>
        </div>

        <!-- Exam Card 3 -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg card-hover p-6" data-aos="fade-up" data-aos-delay="300">
          <div class="flex items-center mb-4">
            <i class="fas fa-dharmachakra text-blue-400 text-2xl mr-3"></i>
            <div>
              <h3 class="font-bold text-gray-800 dark:text-white">CKA</h3>
              <p class="text-sm text-gray-500 dark:text-gray-400">Certified Kubernetes Administrator</p>
            </div>
          </div>
          <div class="mb-4">
            <div class="flex justify-between text-sm text-gray-600 dark:text-gray-300 mb-2">
              <span>Success Rate</span>
              <span>88%</span>
            </div>
            <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-2">
              <div class="bg-green-500 h-2 rounded-full" style="width: 88%"></div>
            </div>
          </div>
          <div class="flex items-center justify-between text-sm text-gray-500 dark:text-gray-400 mb-4">
            <span><i class="fas fa-question-circle mr-1"></i>150 Questions</span>
            <span><i class="fas fa-clock mr-1"></i>Updated Oct 2024</span>
          </div>
          <a href="#" @click="handleDownloadClick" class="w-full gradient-btn text-white py-2 rounded text-center font-medium hover:opacity-90 block">Download Now</a>
        </div>
      </div>

      <div class="text-center mt-12" data-aos="fade-up" data-aos-delay="400">
        <a href="#" class="gradient-btn text-white px-8 py-3 rounded-lg font-semibold hover:opacity-90 transform hover:scale-105 transition-all duration-200">
          Browse All Exam Dumps <i class="fas fa-arrow-right ml-2"></i>
        </a>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'ExamDumps',
  methods: {
    handleDownloadClick(event) {
      event.preventDefault();
      const btn = event.target;
      const originalText = btn.textContent;
      btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Loading...';
      btn.disabled = true;

      setTimeout(() => {
        btn.innerHTML = originalText;
        btn.disabled = false;
        alert('Feature coming soon! Thank you for your interest.');
      }, 2000);
    }
  }
}
</script>