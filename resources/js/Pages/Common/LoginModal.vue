<template>
  <!-- Login Modal -->
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
          <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Welcome Back</h2>
          <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Sign in to your DevOps Jungle account</p>
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
        <!-- Login Form -->
        <form @submit.prevent="handleLogin" class="space-y-5">
          <!-- Email Field -->
          <div>
            <label for="loginEmail" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Email Address *
            </label>
            <div class="relative">
              <input
                id="loginEmail"
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

          <!-- Password Field -->
          <div>
            <label for="loginPassword" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Password *
            </label>
            <div class="relative">
              <input
                id="loginPassword"
                v-model="form.password"
                :type="showPassword ? 'text' : 'password'"
                required
                class="w-full pl-10 pr-12 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-colors"
                :class="{ 'border-red-300 focus:ring-red-500': errors.password }"
                placeholder="Enter your password"
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
          </div>

          <!-- Remember Me & Forgot Password -->
          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <input
                id="remember"
                v-model="form.remember"
                type="checkbox"
                class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
              >
              <label for="remember" class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                Remember me
              </label>
            </div>
            <a href="#" class="text-sm text-primary-600 dark:text-primary-400 hover:underline">
              Forgot password?
            </a>
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
              Signing In...
            </span>
            <span v-else class="flex items-center justify-center">
              <i class="fas fa-sign-in-alt mr-2"></i>
              Sign In
            </span>
          </button>

          <!-- General Error Message -->
          <div v-if="errors.general" class="p-4 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-700 rounded-lg">
            <div class="flex items-center">
              <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
              <p class="text-sm text-red-800 dark:text-red-200">{{ errors.general }}</p>
            </div>
          </div>

          <!-- Signup Link -->
          <div class="text-center text-sm text-gray-600 dark:text-gray-400">
            Don't have an account?
            <button
              type="button"
              @click="switchToSignup"
              class="text-primary-600 dark:text-primary-400 hover:underline font-medium"
            >
              Sign Up
            </button>
          </div>
        </form>
      </div>

      <!-- Modal Footer -->
      <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700/50 rounded-b-xl">
        <div class="flex items-center justify-center space-x-4 text-xs text-gray-500 dark:text-gray-400">
          <div class="flex items-center">
            <i class="fas fa-shield-alt mr-1 text-primary-600"></i>
            <span>Secure Login</span>
          </div>
          <div class="flex items-center">
            <i class="fas fa-user-shield mr-1 text-primary-600"></i>
            <span>Protected Account</span>
          </div>
          <div class="flex items-center">
            <i class="fas fa-lock mr-1 text-primary-600"></i>
            <span>Encrypted</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { router } from '@inertiajs/vue3'

export default {
  name: 'LoginModal',
  props: {
    isVisible: {
      type: Boolean,
      default: false
    }
  },
  emits: ['close', 'switch-to-signup'],
  data() {
    return {
      form: {
        email: '',
        password: '',
        remember: false
      },
      errors: {},
      showPassword: false,
      isLoading: false
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
    switchToSignup() {
      this.$emit('switch-to-signup')
    },
    resetForm() {
      this.form = {
        email: '',
        password: '',
        remember: false
      }
      this.errors = {}
      this.isLoading = false
    },
    validateForm() {
      this.errors = {}

      // Email validation
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
      if (!this.form.email.trim()) {
        this.errors.email = 'Email address is required'
      } else if (!emailPattern.test(this.form.email)) {
        this.errors.email = 'Please enter a valid email address'
      }

      // Password validation
      if (!this.form.password) {
        this.errors.password = 'Password is required'
      }

      return Object.keys(this.errors).length === 0
    },
    async handleLogin() {
      if (!this.validateForm()) {
        return
      }

      this.isLoading = true

      try {
        await router.post('/login', {
          email: this.form.email.trim().toLowerCase(),
          password: this.form.password,
          remember: this.form.remember
        }, {
          onSuccess: () => {
            this.closeModal()
            this.isLoading = false
          },
          onError: (errors) => {
            this.errors = errors
            this.isLoading = false
          }
        })
      } catch (error) {
        console.error('Login error:', error)
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