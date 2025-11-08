<template>
  <!-- Signup Modal -->
  <div
    v-show="isVisible"
    class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4"
    @click.self="closeModal"
  >
    <div
      class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-4xl transform transition-all duration-300 overflow-hidden"
      :class="isVisible ? 'scale-100 opacity-100' : 'scale-95 opacity-0'"
    >
      <!-- Modal Header with Gradient -->
      <div class="relative bg-gradient-to-r from-emerald-600 via-teal-600 to-emerald-600 p-8">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/10 rounded-full -ml-32 -mb-32 blur-3xl"></div>
        <div class="relative flex items-center justify-between">
          <div>
            <h2 class="text-3xl font-bold text-white flex items-center">
              <span class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-rocket text-white text-lg"></i>
              </span>
              Join DevOps Jungle
            </h2>
            <p class="text-emerald-100 mt-2 text-sm">Start your DevOps journey today and master cloud technologies</p>
          </div>
          <button
            @click="closeModal"
            class="w-10 h-10 flex items-center justify-center rounded-full bg-white/20 text-white hover:bg-white/30 transition-all hover:rotate-90 duration-300"
          >
            <i class="fas fa-times text-lg"></i>
          </button>
        </div>
      </div>

      <!-- Modal Body -->
      <div class="p-8">
        <!-- Success Message -->
        <div
          v-if="showSuccess"
          class="mb-6 p-6 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/30 dark:to-emerald-900/30 border-2 border-green-200 dark:border-green-700 rounded-xl"
        >
          <div class="flex items-start">
            <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
              <i class="fas fa-check text-white text-xl"></i>
            </div>
            <div>
              <h3 class="text-lg font-bold text-green-800 dark:text-green-200">Account Created Successfully!</h3>
              <p class="text-green-700 dark:text-green-300 mt-1">Welcome to DevOps Jungle. You can now access all our courses and labs.</p>
            </div>
          </div>
        </div>

        <!-- Signup Form -->
        <form v-if="!showSuccess" @submit.prevent="handleSignup" class="space-y-6">
          <!-- Two Column Grid for Fields -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name Field -->
            <div class="space-y-2">
              <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                Full Name <span class="text-red-500">*</span>
              </label>
              <div class="relative group">
                <input
                  id="name"
                  v-model="form.name"
                  type="text"
                  required
                  class="w-full pl-11 pr-4 py-3.5 border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50 text-gray-900 dark:text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all"
                  :class="{ 'border-red-300 focus:ring-red-500 focus:border-red-500': errors.name }"
                  placeholder="John Doe"
                >
                <div class="absolute left-3.5 top-3.5 w-7 h-7 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg flex items-center justify-center group-focus-within:scale-110 transition-transform">
                  <i class="fas fa-user text-emerald-600 dark:text-emerald-400 text-sm"></i>
                </div>
              </div>
              <p v-if="errors.name" class="text-xs text-red-600 dark:text-red-400 flex items-center">
                <i class="fas fa-exclamation-circle mr-1"></i>{{ errors.name }}
              </p>
            </div>

            <!-- Email Field -->
            <div class="space-y-2">
              <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                Email Address <span class="text-red-500">*</span>
              </label>
              <div class="relative group">
                <input
                  id="email"
                  v-model="form.email"
                  type="email"
                  required
                  class="w-full pl-11 pr-4 py-3.5 border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50 text-gray-900 dark:text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all"
                  :class="{ 'border-red-300 focus:ring-red-500 focus:border-red-500': errors.email }"
                  placeholder="john@example.com"
                >
                <div class="absolute left-3.5 top-3.5 w-7 h-7 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center group-focus-within:scale-110 transition-transform">
                  <i class="fas fa-envelope text-blue-600 dark:text-blue-400 text-sm"></i>
                </div>
              </div>
              <p v-if="errors.email" class="text-xs text-red-600 dark:text-red-400 flex items-center">
                <i class="fas fa-exclamation-circle mr-1"></i>{{ errors.email }}
              </p>
            </div>

            <!-- Phone Field -->
            <div class="space-y-2">
              <label for="phone" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                Phone Number <span class="text-red-500">*</span>
              </label>
              <div class="relative group">
                <input
                  id="phone"
                  v-model="form.phone"
                  type="tel"
                  required
                  class="w-full pl-11 pr-4 py-3.5 border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50 text-gray-900 dark:text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all"
                  :class="{ 'border-red-300 focus:ring-red-500 focus:border-red-500': errors.phone }"
                  placeholder="+1 234 567 8900"
                >
                <div class="absolute left-3.5 top-3.5 w-7 h-7 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center group-focus-within:scale-110 transition-transform">
                  <i class="fas fa-phone text-purple-600 dark:text-purple-400 text-sm"></i>
                </div>
              </div>
              <p v-if="errors.phone" class="text-xs text-red-600 dark:text-red-400 flex items-center">
                <i class="fas fa-exclamation-circle mr-1"></i>{{ errors.phone }}
              </p>
            </div>

            <!-- Password Field -->
            <div class="space-y-2">
              <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                Password <span class="text-red-500">*</span>
              </label>
              <div class="relative group">
                <input
                  id="password"
                  v-model="form.password"
                  :type="showPassword ? 'text' : 'password'"
                  required
                  class="w-full pl-11 pr-12 py-3.5 border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50 text-gray-900 dark:text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all"
                  :class="{ 'border-red-300 focus:ring-red-500 focus:border-red-500': errors.password }"
                  placeholder="Min. 8 characters"
                >
                <div class="absolute left-3.5 top-3.5 w-7 h-7 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center group-focus-within:scale-110 transition-transform">
                  <i class="fas fa-lock text-orange-600 dark:text-orange-400 text-sm"></i>
                </div>
                <button
                  type="button"
                  @click="showPassword = !showPassword"
                  class="absolute right-3 top-3.5 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 transition-colors"
                >
                  <i :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                </button>
              </div>
              <p v-if="errors.password" class="text-xs text-red-600 dark:text-red-400 flex items-center">
                <i class="fas fa-exclamation-circle mr-1"></i>{{ errors.password }}
              </p>
              <p v-else class="text-xs text-gray-500 dark:text-gray-400 flex items-center">
                <i class="fas fa-info-circle mr-1"></i>At least 8 characters
              </p>
            </div>
          </div>

          <!-- Terms and Conditions -->
          <div class="flex items-start p-4 bg-gray-50 dark:bg-gray-700/30 rounded-xl border border-gray-200 dark:border-gray-600">
            <input
              id="terms"
              v-model="form.acceptTerms"
              type="checkbox"
              required
              class="w-5 h-5 text-emerald-600 bg-white border-2 border-gray-300 rounded-md focus:ring-2 focus:ring-emerald-500 dark:focus:ring-emerald-600 dark:bg-gray-700 dark:border-gray-500 mt-0.5 cursor-pointer"
            >
            <label for="terms" class="ml-3 text-sm text-gray-600 dark:text-gray-300 cursor-pointer">
              I agree to the
              <a href="#" class="text-emerald-600 dark:text-emerald-400 hover:underline font-semibold">Terms of Service</a>
              and
              <a href="#" class="text-emerald-600 dark:text-emerald-400 hover:underline font-semibold">Privacy Policy</a>
            </label>
          </div>

          <!-- Submit Button -->
          <button
            type="submit"
            :disabled="isLoading"
            class="w-full relative overflow-hidden bg-gradient-to-r from-emerald-600 via-teal-600 to-emerald-600 text-white py-4 px-6 rounded-xl font-bold text-base transition-all duration-300 hover:shadow-lg hover:shadow-emerald-500/50 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:translate-y-0 group"
          >
            <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-emerald-500 to-teal-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
            <span v-if="isLoading" class="relative flex items-center justify-center">
              <svg class="animate-spin -ml-1 mr-3 h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              Creating Account...
            </span>
            <span v-else class="relative flex items-center justify-center">
              <i class="fas fa-rocket mr-2"></i>
              Create My Account
            </span>
          </button>

          <!-- Login Link -->
          <div class="text-center">
            <p class="text-sm text-gray-600 dark:text-gray-400">
              Already have an account?
              <button
                type="button"
                @click="switchToLogin"
                class="text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 font-bold ml-1 transition-colors"
              >
                Sign In →
              </button>
            </p>
          </div>
        </form>

        <!-- Success Actions -->
        <div v-if="showSuccess" class="space-y-4">
          <button
            @click="closeModal"
            class="w-full relative overflow-hidden bg-gradient-to-r from-emerald-600 via-teal-600 to-emerald-600 text-white py-4 px-6 rounded-xl font-bold transition-all duration-300 hover:shadow-lg hover:shadow-emerald-500/50 hover:-translate-y-0.5 group"
          >
            <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-emerald-500 to-teal-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
            <span class="relative flex items-center justify-center">
              <i class="fas fa-rocket mr-2"></i>
              Start Learning Now
            </span>
          </button>
          <button
            @click="closeModal"
            class="w-full text-center py-3 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition-colors"
          >
            Close
          </button>
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
  emits: ['close', 'switch-to-login', 'signup-success', 'login-success'],
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
          onSuccess: (page) => {
            this.showSuccess = true
            this.isLoading = false
            // Emit success event to parent (Header) to show notification
            this.$emit('signup-success', {
              userName: this.form.name.trim()
            })
            // Since user is now automatically logged in, emit login-success as well
            this.$emit('login-success', {
              user: page.props.auth?.user
            })
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
/* Modal Animation */
@keyframes modalSlideIn {
  from {
    opacity: 0;
    transform: scale(0.95) translateY(-20px);
  }
  to {
    opacity: 1;
    transform: scale(1) translateY(0);
  }
}

.bg-black\/60 {
  animation: fadeIn 0.3s ease-out;
}

@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

/* Gradient Header Animation */
.bg-gradient-to-r {
  background-size: 200% 100%;
  animation: gradientFlow 4s ease infinite;
}

@keyframes gradientFlow {
  0%, 100% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 100% 50%;
  }
}

/* Input Focus Ring Animation */
input:focus {
  animation: inputGlow 0.5s ease-out;
}

@keyframes inputGlow {
  0% {
    box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4);
  }
  100% {
    box-shadow: 0 0 0 4px rgba(16, 185, 129, 0);
  }
}

/* Icon Container Animation on Focus */
.group:focus-within .group-focus-within\:scale-110 {
  animation: iconBounce 0.5s ease-out;
}

@keyframes iconBounce {
  0%, 100% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.15);
  }
}

/* Submit Button Shine Effect */
button[type="submit"]::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
  transition: left 0.7s;
}

button[type="submit"]:hover::before {
  left: 100%;
}

/* Success Message Animation */
.bg-gradient-to-r.from-green-50 {
  animation: successPulse 2s ease-in-out infinite;
}

@keyframes successPulse {
  0%, 100% {
    box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.4);
  }
  50% {
    box-shadow: 0 0 0 10px rgba(34, 197, 94, 0);
  }
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .grid.grid-cols-1.md\:grid-cols-2 {
    grid-template-columns: 1fr;
  }
}
</style>