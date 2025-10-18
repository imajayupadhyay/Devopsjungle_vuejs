<template>
  <!-- Stats Section -->
  <section class="py-20 gradient-bg pattern-bg relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0 bg-gradient-to-r from-emerald-600/5 to-green-600/5"></div>
    <div class="absolute top-10 left-10 w-32 h-32 bg-gradient-to-br from-emerald-500/10 to-green-500/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-10 right-10 w-40 h-40 bg-gradient-to-br from-green-500/10 to-emerald-500/10 rounded-full blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-4 relative z-10">
      <!-- Section Header -->
      <div class="text-center mb-16" data-aos="fade-up">
        <h2 class="text-3xl lg:text-4xl font-bold text-gray-800 dark:text-white mb-4">
          Trusted by <span class="gradient-text">Thousands</span> Worldwide
        </h2>
        <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
          Join our growing community of DevOps professionals and accelerate your career
        </p>
      </div>

      <!-- Stats Grid -->
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
        <!-- Stat Card 1 -->
        <div class="group" data-aos="fade-up" data-aos-delay="100">
          <div class="relative bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl p-6 lg:p-8 shadow-lg hover:shadow-2xl transform hover:scale-105 transition-all duration-300 border border-white/20 dark:border-gray-700/50">
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-green-500/5 rounded-2xl"></div>
            <div class="relative z-10 text-center">
              <div class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-br from-emerald-500 to-green-500 rounded-xl mb-4 group-hover:scale-110 transition-transform duration-300">
                <i class="fas fa-users text-white text-xl"></i>
              </div>
              <div class="text-3xl lg:text-4xl font-bold gradient-text counter mb-2" :data-count="50000">
                {{ formatNumber(counters.students) }}+
              </div>
              <p class="text-sm lg:text-base text-gray-600 dark:text-gray-300 font-medium">Students Trained</p>
            </div>
          </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="group" data-aos="fade-up" data-aos-delay="200">
          <div class="relative bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl p-6 lg:p-8 shadow-lg hover:shadow-2xl transform hover:scale-105 transition-all duration-300 border border-white/20 dark:border-gray-700/50">
            <div class="absolute inset-0 bg-gradient-to-br from-green-500/5 to-emerald-500/5 rounded-2xl"></div>
            <div class="relative z-10 text-center">
              <div class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl mb-4 group-hover:scale-110 transition-transform duration-300">
                <i class="fas fa-book-open text-white text-xl"></i>
              </div>
              <div class="text-3xl lg:text-4xl font-bold gradient-text counter mb-2" :data-count="500">
                {{ counters.courses }}+
              </div>
              <p class="text-sm lg:text-base text-gray-600 dark:text-gray-300 font-medium">Courses Available</p>
            </div>
          </div>
        </div>

        <!-- Stat Card 3 -->
        <div class="group" data-aos="fade-up" data-aos-delay="300">
          <div class="relative bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl p-6 lg:p-8 shadow-lg hover:shadow-2xl transform hover:scale-105 transition-all duration-300 border border-white/20 dark:border-gray-700/50">
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-green-500/5 rounded-2xl"></div>
            <div class="relative z-10 text-center">
              <div class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-br from-emerald-500 to-green-500 rounded-xl mb-4 group-hover:scale-110 transition-transform duration-300">
                <i class="fas fa-trophy text-white text-xl"></i>
              </div>
              <div class="text-3xl lg:text-4xl font-bold gradient-text counter mb-2" :data-count="98">
                {{ counters.success }}%
              </div>
              <p class="text-sm lg:text-base text-gray-600 dark:text-gray-300 font-medium">Success Rate</p>
            </div>
          </div>
        </div>

        <!-- Stat Card 4 -->
        <div class="group" data-aos="fade-up" data-aos-delay="400">
          <div class="relative bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl p-6 lg:p-8 shadow-lg hover:shadow-2xl transform hover:scale-105 transition-all duration-300 border border-white/20 dark:border-gray-700/50">
            <div class="absolute inset-0 bg-gradient-to-br from-green-500/5 to-emerald-500/5 rounded-2xl"></div>
            <div class="relative z-10 text-center">
              <div class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl mb-4 group-hover:scale-110 transition-transform duration-300">
                <i class="fas fa-headset text-white text-xl"></i>
              </div>
              <div class="text-3xl lg:text-4xl font-bold gradient-text counter mb-2" :data-count="24">
                {{ counters.support }}/7
              </div>
              <p class="text-sm lg:text-base text-gray-600 dark:text-gray-300 font-medium">Support Hours</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Additional Info -->
      <div class="mt-16 text-center" data-aos="fade-up" data-aos-delay="500">
        <div class="flex flex-wrap justify-center items-center gap-8 text-sm lg:text-base text-gray-600 dark:text-gray-300">
          <div class="flex items-center space-x-2">
            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
            <span>Live Support</span>
          </div>
          <div class="flex items-center space-x-2">
            <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
            <span>Industry Certified</span>
          </div>
          <div class="flex items-center space-x-2">
            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
            <span>Lifetime Access</span>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'StatsSection',
  data() {
    return {
      counters: {
        students: 0,
        courses: 0,
        success: 0,
        support: 0
      },
      hasAnimated: false
    }
  },
  mounted() {
    // Start animation after component is fully mounted
    this.$nextTick(() => {
      setTimeout(() => {
        if (!this.hasAnimated) {
          this.hasAnimated = true;
          this.animateCounters();
        }
      }, 500); // Start animation 500ms after component mounts
    });
  },
  methods: {

    animateCounters() {
      const targets = {
        students: 50000,
        courses: 500,
        success: 98,
        support: 24
      };

      Object.keys(targets).forEach((key, index) => {
        const target = targets[key];
        const duration = 2500; // Animation duration in ms
        const startDelay = index * 150; // Stagger each counter

        setTimeout(() => {
          const startTime = Date.now();

          const animate = () => {
            const now = Date.now();
            const elapsed = now - startTime;
            const progress = Math.min(elapsed / duration, 1);

            // Ease out cubic function for smooth animation
            const easeProgress = 1 - Math.pow(1 - progress, 3);

            const currentValue = Math.floor(target * easeProgress);
            this.counters[key] = currentValue;

            if (progress < 1) {
              requestAnimationFrame(animate);
            } else {
              this.counters[key] = target;
            }
          };

          // Start the animation
          this.counters[key] = 0; // Ensure it starts from 0
          animate();
        }, startDelay);
      });
    },

    formatNumber(num) {
      if (num >= 1000) {
        return (num / 1000).toFixed(0) + 'K';
      }
      return num.toString();
    }
  }
}
</script>