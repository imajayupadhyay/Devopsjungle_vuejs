<template>
  <!-- Signup Modal -->
  <div
    v-show="isVisible"
    class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
    @click.self="closeModal"
  >
    <div
      class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-md transform transition-all duration-300"
      :class="isVisible ? 'scale-100 opacity-100' : 'scale-95 opacity-0'"
    >
      <!-- Modal Header -->
      <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700">
        <div>
          <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Join DevOps Jungle</h2>
          <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Start your DevOps journey today</p>
        </div>
        <button
          @click="closeModal"
          class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition-colors"
        >
          <i class="fas fa-times text-xl"></i>
        </button>
      </div>

      <!-- Modal Body -->
      <div class="p-6">
        <!-- Success Message -->
        <div
          v-if="showSuccess"
          class="mb-6 p-4 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 rounded-lg"
        >
          <div class="flex items-center">
            <i class="fas fa-check-circle text-green-500 mr-3"></i>
            <div>
              <h3 class="text-sm font-medium text-green-800 dark:text-green-200">Account Created Successfully!</h3>
              <p class="text-sm text-green-700 dark:text-green-300 mt-1">Welcome to DevOps Jungle. You can now access all our courses and labs.</p>
            </div>
          </div>
        </div>

        <!-- Signup Form -->
        <form v-if="!showSuccess" @submit.prevent="handleSignup" class="space-y-5">
          <!-- Name Field -->
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Full Name *
            </label>
            <div class="relative">
              <input
                id="name"
                v-model="form.name"
                type="text"
                required
                class="w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-colors"
                :class="{ 'border-red-300 focus:ring-red-500': errors.name }"
                placeholder="Enter your full name"
              >
              <i class="fas fa-user absolute left-3 top-4 text-gray-400 dark:text-gray-500"></i>
            </div>
            <p v-if="errors.name" class="mt-1 text-sm text-red-600 dark:text-red-400">{{ errors.name }}</p>
          </div>

          <!-- Email Field -->
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Email Address *
            </label>
            <div class="relative">
              <input
                id="email"
                v-model="form.email"
                type="email"
                required
                class="w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-colors"
                :class="{ 'border-red-300 focus:ring-red-500': errors.email }"
                placeholder="Enter your email address"
              >
              <i class="fas fa-envelope absolute left-3 top-4 text-gray-400 dark:text-gray-500"></i>
            </div>
            <p v-if="errors.email" class="mt-1 text-sm text-red-600 dark:text-red-400">{{ errors.email }}</p>
          </div>

          <!-- Phone Field -->
          <div>
            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Phone Number *
            </label>
            <div class="relative">
              <input
                id="phone"
                v-model="form.phone"
                type="tel"
                required
                class="w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-colors"
                :class="{ 'border-red-300 focus:ring-red-500': errors.phone }"
                placeholder="Enter your phone number"
              >
              <i class="fas fa-phone absolute left-3 top-4 text-gray-400 dark:text-gray-500"></i>
            </div>
            <p v-if="errors.phone" class="mt-1 text-sm text-red-600 dark:text-red-400">{{ errors.phone }}</p>
          </div>

          <!-- Password Field -->
          <div>
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Password *
            </label>
            <div class="relative">
              <input
                id="password"
                v-model="form.password"
                :type="showPassword ? 'text' : 'password'"
                required
                class="w-full pl-10 pr-12 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-colors"
                :class="{ 'border-red-300 focus:ring-red-500': errors.password }"
                placeholder="Create a strong password"
              >
              <i class="fas fa-lock absolute left-3 top-4 text-gray-400 dark:text-gray-500"></i>
              <button
                type="button"
                @click="showPassword = !showPassword"
                class="absolute right-3 top-4 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300"
              >
                <i :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
              </button>
            </div>
            <p v-if="errors.password" class="mt-1 text-sm text-red-600 dark:text-red-400">{{ errors.password }}</p>
            <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">
              Password must be at least 8 characters long
            </div>
          </div>

          <!-- Terms and Conditions -->
          <div class="flex items-start">
            <input
              id="terms"
              v-model="form.acceptTerms"
              type="checkbox"
              required
              class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 mt-1"
            >
            <label for="terms" class="ml-3 text-sm text-gray-600 dark:text-gray-400">
              I agree to the
              <a href="#" class="text-primary-600 dark:text-primary-400 hover:underline">Terms of Service</a>
              and
              <a href="#" class="text-primary-600 dark:text-primary-400 hover:underline">Privacy Policy</a>
            </label>
          </div>

          <!-- Submit Button -->
          <button
            type="submit"
            :disabled="isLoading"
            class="w-full gradient-btn text-white py-3 px-4 rounded-lg font-semibold transition-all duration-200 hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed"
          >
            <span v-if="isLoading" class="flex items-center justify-center">
              <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              Creating Account...
            </span>
            <span v-else class="flex items-center justify-center">
              <i class="fas fa-user-plus mr-2"></i>
              Create Account
            </span>
          </button>

          <!-- Login Link -->
          <div class="text-center text-sm text-gray-600 dark:text-gray-400">
            Already have an account?
            <button
              type="button"
              @click="switchToLogin"
              class="text-primary-600 dark:text-primary-400 hover:underline font-medium"
            >
              Sign In
            </button>
          </div>
        </form>

        <!-- Success Actions -->
        <div v-if="showSuccess" class="space-y-4">
          <button
            @click="closeModal"
            class="w-full gradient-btn text-white py-3 px-4 rounded-lg font-semibold transition-all duration-200 hover:opacity-90"
          >
            <i class="fas fa-rocket mr-2"></i>
            Start Learning
          </button>
          <button
            @click="closeModal"
            class="w-full text-center text-sm text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200"
          >
            Close
          </button>
        </div>
      </div>

      <!-- Modal Footer -->
      <div v-if="!showSuccess" class="px-6 py-4 bg-gray-50 dark:bg-gray-700/50 rounded-b-xl">
        <div class="flex items-center justify-center space-x-4 text-xs text-gray-500 dark:text-gray-400">
          <div class="flex items-center">
            <i class="fas fa-shield-alt mr-1 text-primary-600"></i>
            <span>Secure Registration</span>
          </div>
          <div class="flex items-center">
            <i class="fas fa-user-check mr-1 text-primary-600"></i>
            <span>Instant Access</span>
          </div>
          <div class="flex items-center">
            <i class="fas fa-graduation-cap mr-1 text-primary-600"></i>
            <span>Free Courses</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { router } from '@inertiajs/vue3'

export default {
  name: 'SignupModal',
  props: {
    isVisible: {
      type: Boolean,
      default: false
    }
  },
  emits: ['close', 'switch-to-login'],
  data() {
    return {
      form: {
        name: '',
        email: '',
        phone: '',
        password: '',
        acceptTerms: false
      },
      errors: {},
      showPassword: false,
      isLoading: false,
      showSuccess: false
    }
  },
  watch: {
    isVisible(newVal) {
      if (newVal) {
        this.resetForm()
        document.body.style.overflow = 'hidden'
      } else {
        document.body.style.overflow = ''
      }
    }
  },
  beforeUnmount() {
    document.body.style.overflow = ''
  },
  methods: {
    closeModal() {
      this.$emit('close')
    },
    switchToLogin() {
      this.$emit('switch-to-login')
    },
    resetForm() {
      this.form = {
        name: '',
        email: '',
        phone: '',
        password: '',
        acceptTerms: false
      }
      this.errors = {}
      this.showSuccess = false
      this.isLoading = false
    },
    validateForm() {
      this.errors = {}

      // Name validation
      if (!this.form.name.trim()) {
        this.errors.name = 'Full name is required'
      } else if (this.form.name.trim().length < 2) {
        this.errors.name = 'Name must be at least 2 characters'
      }

      // Email validation
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
      if (!this.form.email.trim()) {
        this.errors.email = 'Email address is required'
      } else if (!emailPattern.test(this.form.email)) {
        this.errors.email = 'Please enter a valid email address'
      }

      // Phone validation
      const phonePattern = /^[\+]?[1-9][\d]{0,15}$/
      if (!this.form.phone.trim()) {
        this.errors.phone = 'Phone number is required'
      } else if (!phonePattern.test(this.form.phone.replace(/[\s\-\(\)]/g, ''))) {
        this.errors.phone = 'Please enter a valid phone number'
      }

      // Password validation
      if (!this.form.password) {
        this.errors.password = 'Password is required'
      } else if (this.form.password.length < 8) {
        this.errors.password = 'Password must be at least 8 characters'
      }

      return Object.keys(this.errors).length === 0
    },
    async handleSignup() {
      if (!this.validateForm()) {
        return
      }

      this.isLoading = true

      try {
        await router.post('/signup', {
          name: this.form.name.trim(),
          email: this.form.email.trim().toLowerCase(),
          phone: this.form.phone.trim(),
          password: this.form.password
        }, {
          onSuccess: () => {
            this.showSuccess = true
            this.isLoading = false
          },
          onError: (errors) => {
            this.errors = errors
            this.isLoading = false
          }
        })
      } catch (error) {
        console.error('Signup error:', error)
        this.errors.general = 'An error occurred. Please try again.'
        this.isLoading = false
      }
    }
  }
}
</script>

<style scoped>
.gradient-btn {
  background: linear-gradient(135deg, #059669 0%, #0891b2 100%);
}
</style>