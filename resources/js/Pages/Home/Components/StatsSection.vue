<template>
  <!-- Stats Section -->
  <section class="py-16 bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4">
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-8" data-aos="fade-up">
        <div class="text-center">
          <div class="text-3xl lg:text-4xl font-bold gradient-text counter" :data-count="50000">{{ counters.students }}</div>
          <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">Students Trained</p>
        </div>
        <div class="text-center">
          <div class="text-3xl lg:text-4xl font-bold gradient-text counter" :data-count="500">{{ counters.courses }}</div>
          <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">Courses Available</p>
        </div>
        <div class="text-center">
          <div class="text-3xl lg:text-4xl font-bold gradient-text counter" :data-count="98">{{ counters.success }}</div>
          <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">Success Rate %</p>
        </div>
        <div class="text-center">
          <div class="text-3xl lg:text-4xl font-bold gradient-text counter" :data-count="24">{{ counters.support }}</div>
          <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">Support Hours</p>
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
      }
    }
  },
  mounted() {
    this.animateCounters();
  },
  methods: {
    animateCounters() {
      const targets = {
        students: 50000,
        courses: 500,
        success: 98,
        support: 24
      };

      Object.keys(targets).forEach(key => {
        const target = targets[key];
        const increment = target / 100;
        let current = 0;

        const updateCounter = () => {
          if (current < target) {
            current += increment;
            this.counters[key] = Math.ceil(current);
            requestAnimationFrame(updateCounter);
          } else {
            this.counters[key] = target;
          }
        };

        updateCounter();
      });
    }
  }
}
</script>