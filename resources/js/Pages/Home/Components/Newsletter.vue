<template>
  <!-- Newsletter -->
  <section class="py-16 gradient-bg">
    <div class="max-w-4xl mx-auto px-4 text-center" data-aos="fade-up">
      <h2 class="text-3xl lg:text-4xl font-bold text-gray-800 dark:text-white mb-4">Stay Updated with DevOps Trends</h2>
      <p class="text-lg text-gray-600 dark:text-gray-300 mb-8">Get the latest DevOps news, tutorials, and exclusive content delivered to your inbox</p>
      <div class="flex flex-col sm:flex-row max-w-md mx-auto gap-4">
        <input v-model="newsletterEmail" type="email" placeholder="Enter your email" class="flex-1 px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:border-primary-500 dark:focus:border-primary-400">
        <button @click="handleNewsletterSubscribe" class="gradient-btn text-white px-6 py-3 rounded-lg font-medium hover:opacity-90 whitespace-nowrap">
          Subscribe <i class="fas fa-paper-plane ml-2"></i>
        </button>
      </div>
      <p class="text-xs text-gray-500 dark:text-gray-400 mt-4">No spam, unsubscribe at any time</p>
    </div>
  </section>
</template>

<script>
export default {
  name: 'Newsletter',
  data() {
    return {
      newsletterEmail: ''
    }
  },
  methods: {
    handleNewsletterSubscribe() {
      if (this.newsletterEmail && this.newsletterEmail.includes('@')) {
        alert('Thank you for subscribing! We\'ll keep you updated with the latest DevOps trends.');
        this.newsletterEmail = '';
      } else {
        alert('Please enter a valid email address.');
      }
    }
  }
}
</script>