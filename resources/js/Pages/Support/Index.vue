<template>
  <div class="bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 transition-colors duration-200">
    <!-- Include Font Awesome -->
    <Head>
      <title>Support - DevOps Jungle</title>
      <meta name="description" content="Get help and support for your DevOps learning journey. Contact our expert team for assistance with courses, certifications, and technical issues.">
    </Head>

    <!-- Header -->
    <DevOpsHeader />

    <!-- Main Content -->
    <main>
      <!-- Hero Section -->
      <section class="gradient-bg py-16 lg:py-20">
        <div class="max-w-4xl mx-auto px-4 text-center">
          <div class="w-20 h-20 gradient-btn rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-headset text-white text-3xl"></i>
          </div>
          <h1 class="text-4xl lg:text-5xl font-bold text-gray-800 dark:text-white mb-6">
            How Can We Help You?
          </h1>
          <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 leading-relaxed">
            Our dedicated support team is here to assist you with any questions about our courses, certifications, or technical issues. We're committed to your success in the DevOps journey.
          </p>
          <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <div class="flex items-center text-gray-600 dark:text-gray-300">
              <i class="fas fa-clock text-primary-600 dark:text-primary-400 mr-2"></i>
              <span>24/7 Support Available</span>
            </div>
            <div class="flex items-center text-gray-600 dark:text-gray-300">
              <i class="fas fa-reply text-primary-600 dark:text-primary-400 mr-2"></i>
              <span>Response within 2 hours</span>
            </div>
          </div>
        </div>
      </section>

      <!-- Support Options -->
      <section class="py-16 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4">
          <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-800 dark:text-white mb-4">Choose Your Support Option</h2>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">Multiple ways to get the help you need, when you need it</p>
          </div>

          <div class="grid md:grid-cols-3 gap-8 mb-16">
            <!-- Live Chat -->
            <div class="text-center p-8 rounded-xl bg-gray-50 dark:bg-gray-800 card-hover">
              <div class="w-16 h-16 gradient-btn rounded-xl flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-comments text-white text-2xl"></i>
              </div>
              <h3 class="font-bold text-gray-800 dark:text-white mb-2 text-xl">Live Chat</h3>
              <p class="text-gray-600 dark:text-gray-300 mb-4">Get instant help from our support team</p>
              <button class="gradient-btn text-white px-6 py-2 rounded-lg font-medium hover:opacity-90 transition-opacity">
                Start Chat
              </button>
            </div>

            <!-- Email Support -->
            <div class="text-center p-8 rounded-xl bg-gray-50 dark:bg-gray-800 card-hover">
              <div class="w-16 h-16 gradient-btn rounded-xl flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-envelope text-white text-2xl"></i>
              </div>
              <h3 class="font-bold text-gray-800 dark:text-white mb-2 text-xl">Email Support</h3>
              <p class="text-gray-600 dark:text-gray-300 mb-4">Send us a detailed message</p>
              <a href="mailto:support@devopsjungle.com" class="inline-block border-2 border-primary-600 dark:border-primary-400 text-primary-600 dark:text-primary-400 px-6 py-2 rounded-lg font-medium hover:bg-primary-50 dark:hover:bg-primary-900 transition-colors">
                Send Email
              </a>
            </div>

            <!-- Phone Support -->
            <div class="text-center p-8 rounded-xl bg-gray-50 dark:bg-gray-800 card-hover">
              <div class="w-16 h-16 gradient-btn rounded-xl flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-phone text-white text-2xl"></i>
              </div>
              <h3 class="font-bold text-gray-800 dark:text-white mb-2 text-xl">Phone Support</h3>
              <p class="text-gray-600 dark:text-gray-300 mb-4">Speak directly with our experts</p>
              <a href="tel:+15551234567" class="inline-block border-2 border-primary-600 dark:border-primary-400 text-primary-600 dark:text-primary-400 px-6 py-2 rounded-lg font-medium hover:bg-primary-50 dark:hover:bg-primary-900 transition-colors">
                Call Now
              </a>
            </div>
          </div>
        </div>
      </section>

      <!-- Contact Form Section -->
      <section class="py-16 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-4xl mx-auto px-4">
          <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-800 dark:text-white mb-4">Send Us a Message</h2>
            <p class="text-lg text-gray-600 dark:text-gray-300">Fill out the form below and we'll get back to you as soon as possible</p>
          </div>

          <!-- Contact Form -->
          <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl p-8 lg:p-12">
            <form id="contact-form" @submit.prevent="submitForm" class="space-y-6">
              <!-- Name Field -->
              <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Full Name *
                </label>
                <input
                  v-model="form.name"
                  type="text"
                  id="name"
                  required
                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-lg focus:outline-none focus:border-primary-500 dark:focus:border-primary-400 transition-colors"
                  placeholder="Enter your full name"
                >
                <span v-if="errors.name" class="text-red-500 text-sm mt-1 block">{{ errors.name }}</span>
              </div>

              <!-- Email Field -->
              <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Email Address *
                </label>
                <input
                  v-model="form.email"
                  type="email"
                  id="email"
                  required
                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-lg focus:outline-none focus:border-primary-500 dark:focus:border-primary-400 transition-colors"
                  placeholder="Enter your email address"
                >
                <span v-if="errors.email" class="text-red-500 text-sm mt-1 block">{{ errors.email }}</span>
              </div>

              <!-- Phone Number Field -->
              <div>
                <label for="number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Phone Number
                </label>
                <input
                  v-model="form.number"
                  type="tel"
                  id="number"
                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-lg focus:outline-none focus:border-primary-500 dark:focus:border-primary-400 transition-colors"
                  placeholder="Enter your phone number (optional)"
                >
                <span v-if="errors.number" class="text-red-500 text-sm mt-1 block">{{ errors.number }}</span>
              </div>

              <!-- Message Field -->
              <div>
                <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Message *
                </label>
                <textarea
                  v-model="form.message"
                  id="message"
                  required
                  rows="6"
                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-lg focus:outline-none focus:border-primary-500 dark:focus:border-primary-400 transition-colors resize-y"
                  placeholder="Please describe how we can help you..."
                ></textarea>
                <span v-if="errors.message" class="text-red-500 text-sm mt-1 block">{{ errors.message }}</span>
              </div>

              <!-- Submit Button -->
              <div class="flex flex-col sm:flex-row gap-4 items-center">
                <button
                  type="submit"
                  :disabled="isSubmitting"
                  class="w-full sm:w-auto gradient-btn text-white px-8 py-3 rounded-lg font-semibold hover:opacity-90 transform hover:scale-105 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
                >
                  <i v-if="isSubmitting" class="fas fa-spinner fa-spin mr-2"></i>
                  <i v-else class="fas fa-paper-plane mr-2"></i>
                  {{ isSubmitting ? 'Sending...' : 'Send Message' }}
                </button>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                  We'll respond within 2 hours during business hours
                </p>
              </div>
            </form>

          </div>
        </div>
      </section>

      <!-- FAQ Section -->
      <section class="py-16 bg-white dark:bg-gray-900">
        <div class="max-w-4xl mx-auto px-4">
          <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-800 dark:text-white mb-4">Frequently Asked Questions</h2>
            <p class="text-lg text-gray-600 dark:text-gray-300">Quick answers to common questions</p>
          </div>

          <div class="space-y-6">
            <!-- FAQ Item 1 -->
            <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-6">
              <h3 class="font-bold text-gray-800 dark:text-white mb-2">How do I access my course materials?</h3>
              <p class="text-gray-600 dark:text-gray-300">After enrollment, you'll receive login credentials via email. Access your dashboard to view all course materials, labs, and progress tracking.</p>
            </div>

            <!-- FAQ Item 2 -->
            <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-6">
              <h3 class="font-bold text-gray-800 dark:text-white mb-2">What if I need help with a specific lab exercise?</h3>
              <p class="text-gray-600 dark:text-gray-300">Our instructors provide hands-on support through live chat, forums, and scheduled office hours. You can also submit specific questions through this support form.</p>
            </div>

            <!-- FAQ Item 3 -->
            <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-6">
              <h3 class="font-bold text-gray-800 dark:text-white mb-2">How long do I have access to the courses?</h3>
              <p class="text-gray-600 dark:text-gray-300">You get lifetime access to all course materials, including updates and new content additions. Your progress is saved permanently.</p>
            </div>

            <!-- FAQ Item 4 -->
            <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-6">
              <h3 class="font-bold text-gray-800 dark:text-white mb-2">Do you offer refunds?</h3>
              <p class="text-gray-600 dark:text-gray-300">Yes, we offer a 30-day money-back guarantee. If you're not satisfied with your course, contact us for a full refund within 30 days of purchase.</p>
            </div>
          </div>
        </div>
      </section>
    </main>

    <!-- Thank You Modal -->
    <div v-if="showThankYouModal" class="fixed inset-0 z-50 overflow-y-auto" @click="closeThankYouModal">
      <div class="flex items-center justify-center min-h-screen p-4">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>

        <!-- Modal Content -->
        <div @click.stop class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-8 max-w-md w-full mx-auto transform transition-all">
          <!-- Close Button -->
          <button @click="closeThankYouModal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition-colors">
            <i class="fas fa-times text-xl"></i>
          </button>

          <!-- Animated Success Icon -->
          <div class="text-center mb-6">
            <div class="w-20 h-20 mx-auto mb-4 relative">
              <!-- Animated Check Circle SVG -->
              <svg class="w-20 h-20 text-green-500" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- Background Circle with animation -->
                <circle
                  cx="50"
                  cy="50"
                  r="45"
                  stroke="currentColor"
                  stroke-width="6"
                  fill="none"
                  class="animate-draw-circle"
                  style="stroke-dasharray: 283; stroke-dashoffset: 283; animation: drawCircle 1s ease-out forwards;"
                />
                <!-- Checkmark with animation -->
                <path
                  d="M30 50 L42 62 L70 34"
                  stroke="currentColor"
                  stroke-width="6"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  class="animate-draw-check"
                  style="stroke-dasharray: 50; stroke-dashoffset: 50; animation: drawCheck 0.8s ease-out 0.3s forwards;"
                />
              </svg>
            </div>

            <!-- Success Message -->
            <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-2 animate-fade-in-up" style="animation-delay: 0.5s;">
              Thank You!
            </h3>
            <p class="text-gray-600 dark:text-gray-300 animate-fade-in-up" style="animation-delay: 0.7s;">
              Your message has been sent successfully. Our support team will get back to you within 2 hours during business hours.
            </p>
          </div>

          <!-- Action Buttons -->
          <div class="flex flex-col sm:flex-row gap-3 animate-fade-in-up" style="animation-delay: 0.9s;">
            <button @click="closeThankYouModal" class="flex-1 gradient-btn text-white px-6 py-3 rounded-lg font-semibold hover:opacity-90 transition-opacity">
              <i class="fas fa-check mr-2"></i>
              Got it!
            </button>
            <button @click="submitAnotherMessage" class="flex-1 border-2 border-primary-600 dark:border-primary-400 text-primary-600 dark:text-primary-400 px-6 py-3 rounded-lg font-semibold hover:bg-primary-50 dark:hover:bg-primary-900 transition-colors">
              <i class="fas fa-plus mr-2"></i>
              Send Another
            </button>
          </div>

          <!-- Support Info -->
          <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-600 text-center animate-fade-in-up" style="animation-delay: 1.1s;">
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Need immediate assistance?</p>
            <div class="flex justify-center space-x-4">
              <a href="tel:+15551234567" class="text-primary-600 dark:text-primary-400 hover:underline text-sm">
                <i class="fas fa-phone mr-1"></i>
                Call Us
              </a>
              <a href="mailto:support@devopsjungle.com" class="text-primary-600 dark:text-primary-400 hover:underline text-sm">
                <i class="fas fa-envelope mr-1"></i>
                Email
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <DevOpsFooter />
  </div>
</template>

<script>
import { Head } from '@inertiajs/vue3'
import DevOpsHeader from '../Common/Header.vue'
import DevOpsFooter from '../Common/Footer.vue'

export default {
  name: 'SupportPage',
  components: {
    Head,
    DevOpsHeader,
    DevOpsFooter
  },
  data() {
    return {
      form: {
        name: '',
        email: '',
        number: '',
        message: ''
      },
      errors: {},
      isSubmitting: false,
      showThankYouModal: false
    }
  },
  mounted() {
    // Add keyboard event listener for ESC key
    document.addEventListener('keydown', this.handleKeydown)
  },
  beforeUnmount() {
    document.removeEventListener('keydown', this.handleKeydown)
  },
  methods: {
    submitForm() {
      this.errors = {}
      this.isSubmitting = true

      this.$inertia.post('/support', this.form, {
        onSuccess: () => {
          this.form = {
            name: '',
            email: '',
            number: '',
            message: ''
          }
          this.showThankYouModal = true
        },
        onError: (errors) => {
          this.errors = errors
        },
        onFinish: () => {
          this.isSubmitting = false
        }
      })
    },
    closeThankYouModal() {
      this.showThankYouModal = false
    },
    submitAnotherMessage() {
      this.showThankYouModal = false
      // Scroll to form
      this.$nextTick(() => {
        const formElement = document.querySelector('#contact-form')
        if (formElement) {
          formElement.scrollIntoView({ behavior: 'smooth' })
        }
      })
    },
    handleKeydown(event) {
      if (event.key === 'Escape' && this.showThankYouModal) {
        this.closeThankYouModal()
      }
    }
  }
}
</script>