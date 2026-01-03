<template>
  <!-- Hero Section -->
  <section class="gradient-bg py-16 lg:py-24 pattern-bg relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4">
      <div class="grid lg:grid-cols-2 gap-12 items-center">
        <div data-aos="fade-right">
          <h1 class="text-4xl lg:text-6xl font-bold text-gray-800 dark:text-white mb-6 leading-tight">
            Master <span class="gradient-text">DevOps</span><br>
            Skills From Scratch
          </h1>
          <p class="text-lg text-gray-600 dark:text-gray-300 mb-8 leading-relaxed">
            Accelerate your career with our comprehensive DevOps training. Get certified, practice in real labs, and land your dream job with confidence.
          </p>
          <div class="flex flex-col sm:flex-row gap-4 mb-8">
            <a href="#" class="gradient-btn text-white px-8 py-4 rounded-lg text-lg font-semibold hover:opacity-90 transform hover:scale-105 transition-all duration-200 text-center">
              <i class="fas fa-rocket mr-2"></i>Start Learning Now
            </a>
            <a href="#" class="border-2 border-primary-600 dark:border-primary-400 text-primary-600 dark:text-primary-400 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-primary-50 dark:hover:bg-primary-900 transform hover:scale-105 transition-all duration-200 text-center">
              <i class="fas fa-play mr-2"></i>Watch Demo
            </a>
          </div>
          <div class="flex items-center space-x-8 text-sm text-gray-600 dark:text-gray-300">
            <div class="flex items-center">
              <i class="fas fa-users text-primary-600 dark:text-primary-400 mr-2"></i>
              50K+ Students
            </div>
            <div class="flex items-center">
              <i class="fas fa-star text-yellow-500 mr-2"></i>
              4.9/5 Rating
            </div>
            <div class="flex items-center">
              <i class="fas fa-certificate text-primary-600 dark:text-primary-400 mr-2"></i>
              Industry Certified
            </div>
          </div>
        </div>

        <div class="relative" data-aos="fade-left">
          <div class="relative z-10">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-8 transform rotate-3 hover:rotate-0 transition-transform duration-500">
              <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-gray-800 dark:text-white">DevOps Pipeline</h3>
                <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
              </div>
              <div class="space-y-3">
                <div class="flex items-center space-x-3">
                  <i class="fab fa-git-alt text-orange-500"></i>
                  <span class="text-sm text-gray-700 dark:text-gray-300">Code → Git Repository</span>
                </div>
                <div class="flex items-center space-x-3">
                  <i class="fas fa-cogs text-blue-500"></i>
                  <span class="text-sm text-gray-700 dark:text-gray-300">Build → Jenkins CI/CD</span>
                </div>
                <div class="flex items-center space-x-3">
                  <i class="fab fa-docker text-blue-400"></i>
                  <span class="text-sm text-gray-700 dark:text-gray-300">Container → Docker</span>
                </div>
                <div class="flex items-center space-x-3">
                  <i class="fas fa-cloud text-gray-500"></i>
                  <span class="text-sm text-gray-700 dark:text-gray-300">Deploy → AWS/Azure</span>
                </div>
              </div>
            </div>
          </div>
          <div class="absolute top-4 left-4 w-full h-full bg-primary-200 dark:bg-primary-800 rounded-2xl -z-10"></div>

          <!-- Floating Elements -->
          <div class="absolute -top-8 -right-8 w-16 h-16 bg-yellow-200 rounded-full animate-float"></div>
          <div class="absolute -bottom-8 -left-8 w-12 h-12 bg-blue-200 rounded-full animate-bounce-slow"></div>
          <div class="absolute top-1/2 -right-12 w-8 h-8 bg-purple-200 rounded-full animate-pulse-slow"></div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'HeroSection'
}
</script>