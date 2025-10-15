<template>
  <!-- Testimonials -->
  <section class="py-16 bg-white dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4">
      <div class="text-center mb-12" data-aos="fade-up">
        <h2 class="text-3xl lg:text-4xl font-bold text-gray-800 dark:text-white mb-4">What Our Students Say</h2>
        <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">Join thousands of successful DevOps professionals who started their journey with us</p>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Testimonial 1 -->
        <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-6 card-hover" data-aos="fade-up" data-aos-delay="100">
          <div class="flex items-center mb-4">
            <div class="w-12 h-12 bg-primary-100 dark:bg-primary-800 rounded-full flex items-center justify-center mr-4">
              <span class="text-primary-600 dark:text-primary-400 font-bold">JD</span>
            </div>
            <div>
              <h4 class="font-bold text-gray-800 dark:text-white">John Doe</h4>
              <p class="text-sm text-gray-500 dark:text-gray-400">DevOps Engineer at Amazon</p>
            </div>
          </div>
          <div class="flex mb-4">
            <i class="fas fa-star text-yellow-400"></i>
            <i class="fas fa-star text-yellow-400"></i>
            <i class="fas fa-star text-yellow-400"></i>
            <i class="fas fa-star text-yellow-400"></i>
            <i class="fas fa-star text-yellow-400"></i>
          </div>
          <p class="text-sm text-gray-600 dark:text-gray-300 italic">"DevOps Jungle helped me transition from development to DevOps. The hands-on labs were incredibly valuable for real-world experience."</p>
        </div>

        <!-- Testimonial 2 -->
        <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-6 card-hover" data-aos="fade-up" data-aos-delay="200">
          <div class="flex items-center mb-4">
            <div class="w-12 h-12 bg-primary-100 dark:bg-primary-800 rounded-full flex items-center justify-center mr-4">
              <span class="text-primary-600 dark:text-primary-400 font-bold">SM</span>
            </div>
            <div>
              <h4 class="font-bold text-gray-800 dark:text-white">Sarah Miller</h4>
              <p class="text-sm text-gray-500 dark:text-gray-400">Cloud Architect at Microsoft</p>
            </div>
          </div>
          <div class="flex mb-4">
            <i class="fas fa-star text-yellow-400"></i>
            <i class="fas fa-star text-yellow-400"></i>
            <i class="fas fa-star text-yellow-400"></i>
            <i class="fas fa-star text-yellow-400"></i>
            <i class="fas fa-star text-yellow-400"></i>
          </div>
          <p class="text-sm text-gray-600 dark:text-gray-300 italic">"The AWS certification course was comprehensive and up-to-date. I passed my exam on the first try thanks to their excellent preparation materials."</p>
        </div>

        <!-- Testimonial 3 -->
        <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-6 card-hover" data-aos="fade-up" data-aos-delay="300">
          <div class="flex items-center mb-4">
            <div class="w-12 h-12 bg-primary-100 dark:bg-primary-800 rounded-full flex items-center justify-center mr-4">
              <span class="text-primary-600 dark:text-primary-400 font-bold">MJ</span>
            </div>
            <div>
              <h4 class="font-bold text-gray-800 dark:text-white">Mike Johnson</h4>
              <p class="text-sm text-gray-500 dark:text-gray-400">SRE at Google</p>
            </div>
          </div>
          <div class="flex mb-4">
            <i class="fas fa-star text-yellow-400"></i>
            <i class="fas fa-star text-yellow-400"></i>
            <i class="fas fa-star text-yellow-400"></i>
            <i class="fas fa-star text-yellow-400"></i>
            <i class="fas fa-star text-yellow-400"></i>
          </div>
          <p class="text-sm text-gray-600 dark:text-gray-300 italic">"Outstanding Docker and Kubernetes course! The instructor's expertise and the practical approach made complex concepts easy to understand."</p>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'Testimonials'
}
</script>