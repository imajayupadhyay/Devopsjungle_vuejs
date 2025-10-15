<template>
  <!-- Featured Courses -->
  <section class="py-16 bg-gray-50 dark:bg-gray-800">
    <div class="max-w-7xl mx-auto px-4">
      <div class="text-center mb-12" data-aos="fade-up">
        <h2 class="text-3xl lg:text-4xl font-bold text-gray-800 dark:text-white mb-4">Featured Courses</h2>
        <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">Master the most in-demand DevOps technologies with our expert-crafted courses</p>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Course Card 1 -->
        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md card-hover overflow-hidden" data-aos="fade-up" data-aos-delay="100">
          <div class="gradient-btn h-2"></div>
          <div class="p-6">
            <div class="flex items-center mb-4">
              <div class="w-12 h-12 bg-orange-100 dark:bg-orange-900 rounded-lg flex items-center justify-center mr-4">
                <i class="fab fa-aws text-orange-500 text-xl"></i>
              </div>
              <div>
                <h3 class="font-bold text-gray-800 dark:text-white">AWS DevOps Engineer</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Professional Certification</p>
              </div>
            </div>
            <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">Master AWS DevOps services, CI/CD pipelines, and infrastructure automation.</p>
            <div class="flex items-center justify-between mb-4">
              <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                <i class="fas fa-clock mr-1"></i>
                <span>40 hours</span>
              </div>
              <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                <i class="fas fa-users mr-1"></i>
                <span>2,340 enrolled</span>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <div class="text-2xl font-bold gradient-text">$299</div>
              <a href="#" @click="handleEnrollClick" class="gradient-btn text-white px-4 py-2 rounded text-sm font-medium hover:opacity-90">Enroll Now</a>
            </div>
          </div>
        </div>

        <!-- Course Card 2 -->
        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md card-hover overflow-hidden" data-aos="fade-up" data-aos-delay="200">
          <div class="gradient-btn h-2"></div>
          <div class="p-6">
            <div class="flex items-center mb-4">
              <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center mr-4">
                <i class="fab fa-docker text-blue-500 text-xl"></i>
              </div>
              <div>
                <h3 class="font-bold text-gray-800 dark:text-white">Docker & Kubernetes</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Container Orchestration</p>
              </div>
            </div>
            <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">Learn containerization, orchestration, and microservices architecture.</p>
            <div class="flex items-center justify-between mb-4">
              <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                <i class="fas fa-clock mr-1"></i>
                <span>35 hours</span>
              </div>
              <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                <i class="fas fa-users mr-1"></i>
                <span>3,120 enrolled</span>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <div class="text-2xl font-bold gradient-text">$249</div>
              <a href="#" @click="handleEnrollClick" class="gradient-btn text-white px-4 py-2 rounded text-sm font-medium hover:opacity-90">Enroll Now</a>
            </div>
          </div>
        </div>

        <!-- Course Card 3 -->
        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md card-hover overflow-hidden" data-aos="fade-up" data-aos-delay="300">
          <div class="gradient-btn h-2"></div>
          <div class="p-6">
            <div class="flex items-center mb-4">
              <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center mr-4">
                <i class="fas fa-code-branch text-purple-500 text-xl"></i>
              </div>
              <div>
                <h3 class="font-bold text-gray-800 dark:text-white">Jenkins CI/CD Mastery</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Automation & Deployment</p>
              </div>
            </div>
            <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">Build robust CI/CD pipelines and automate your deployment processes.</p>
            <div class="flex items-center justify-between mb-4">
              <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                <i class="fas fa-clock mr-1"></i>
                <span>28 hours</span>
              </div>
              <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                <i class="fas fa-users mr-1"></i>
                <span>1,890 enrolled</span>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <div class="text-2xl font-bold gradient-text">$199</div>
              <a href="#" @click="handleEnrollClick" class="gradient-btn text-white px-4 py-2 rounded text-sm font-medium hover:opacity-90">Enroll Now</a>
            </div>
          </div>
        </div>
      </div>

      <div class="text-center mt-12" data-aos="fade-up" data-aos-delay="400">
        <a href="#" class="gradient-btn text-white px-8 py-3 rounded-lg font-semibold hover:opacity-90 transform hover:scale-105 transition-all duration-200">
          View All Courses <i class="fas fa-arrow-right ml-2"></i>
        </a>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'FeaturedCourses',
  methods: {
    handleEnrollClick(event) {
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