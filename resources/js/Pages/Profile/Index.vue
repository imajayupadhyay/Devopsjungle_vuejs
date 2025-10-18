<template>
  <Head title="Profile - DevOps Jungle" />

  <!-- Header -->
  <Header />

  <!-- Main Profile Content -->
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
    <div class="max-w-4xl mx-auto px-4">
      <!-- Profile Header -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 mb-6">
        <div class="relative h-32 bg-gradient-to-r from-primary-500 to-blue-600 rounded-t-xl">
          <div class="absolute -bottom-16 left-6">
            <div class="relative">
              <img
                :src="avatarPreview || user.avatar_url"
                :alt="user.name"
                class="w-32 h-32 rounded-full border-4 border-white dark:border-gray-800 shadow-lg"
              >
              <div v-if="isUploadingAvatar" class="absolute inset-0 bg-black bg-opacity-50 rounded-full flex items-center justify-center">
                <svg class="animate-spin h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
              </div>
              <button @click="triggerFileUpload" class="absolute bottom-2 right-2 bg-primary-600 hover:bg-primary-700 text-white p-2 rounded-full shadow-lg transition-colors">
                <i class="fas fa-camera text-sm"></i>
              </button>
              <input
                ref="fileInput"
                type="file"
                accept="image/*"
                @change="handleAvatarUpload"
                class="hidden"
              >
            </div>
          </div>
        </div>
        <div class="pt-20 pb-6 px-6">
          <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
              <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-1">{{ user.name }}</h1>
              <p class="text-gray-600 dark:text-gray-400">{{ user.email }}</p>
              <div class="flex items-center mt-2 text-sm text-gray-500 dark:text-gray-400">
                <i class="fas fa-calendar-alt mr-2"></i>
                Member since {{ formatDate(user.created_at) }}
              </div>
            </div>
            <div class="mt-4 md:mt-0">
              <div class="text-right">
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Profile Completion</p>
                <div class="flex items-center space-x-3">
                  <div class="w-32 bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                    <div
                      class="bg-gradient-to-r from-primary-500 to-blue-600 h-2 rounded-full transition-all duration-300"
                      :style="{ width: profileCompletionPercentage + '%' }"
                    ></div>
                  </div>
                  <span class="text-sm font-medium text-gray-900 dark:text-white">{{ profileCompletionPercentage }}%</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Profile Form -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
        <div class="p-6 border-b border-gray-100 dark:border-gray-700">
          <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Profile Information</h2>
          <p class="text-gray-600 dark:text-gray-400 mt-1">Update your personal information and preferences</p>
        </div>

        <form @submit.prevent="updateProfile" class="p-6 space-y-6">
          <!-- Profile Picture Section -->
          <div>
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4 flex items-center">
              <i class="fas fa-camera mr-2 text-primary-600"></i>
              Profile Picture
            </h3>
            <div class="flex items-center space-x-6">
              <div class="relative">
                <img
                  :src="avatarPreview || user.avatar_url"
                  :alt="user.name"
                  class="w-20 h-20 rounded-full border-2 border-gray-300 dark:border-gray-600"
                >
                <div v-if="isUploadingAvatar" class="absolute inset-0 bg-black bg-opacity-50 rounded-full flex items-center justify-center">
                  <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                  </svg>
                </div>
              </div>
              <div class="flex-1">
                <button
                  type="button"
                  @click="triggerFileUpload"
                  class="bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 px-4 py-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors flex items-center"
                >
                  <i class="fas fa-upload mr-2"></i>
                  Choose New Picture
                </button>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                  JPG, PNG or GIF. Max size 5MB.
                </p>
              </div>
            </div>
          </div>

          <!-- Personal Information Section -->
          <div>
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4 flex items-center">
              <i class="fas fa-user mr-2 text-primary-600"></i>
              Personal Information
            </h3>
            <div class="grid md:grid-cols-2 gap-6">
              <!-- Name -->
              <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Full Name *
                </label>
                <input
                  id="name"
                  v-model="form.name"
                  type="text"
                  required
                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-colors"
                  :class="{ 'border-red-300 focus:ring-red-500': errors.name }"
                >
                <p v-if="errors.name" class="mt-1 text-sm text-red-600 dark:text-red-400">{{ errors.name }}</p>
              </div>

              <!-- Email -->
              <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Email Address *
                </label>
                <input
                  id="email"
                  v-model="form.email"
                  type="email"
                  required
                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-colors"
                  :class="{ 'border-red-300 focus:ring-red-500': errors.email }"
                >
                <p v-if="errors.email" class="mt-1 text-sm text-red-600 dark:text-red-400">{{ errors.email }}</p>
              </div>

              <!-- Phone -->
              <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Phone Number
                </label>
                <input
                  id="phone"
                  v-model="form.phone"
                  type="tel"
                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-colors"
                  :class="{ 'border-red-300 focus:ring-red-500': errors.phone }"
                >
                <p v-if="errors.phone" class="mt-1 text-sm text-red-600 dark:text-red-400">{{ errors.phone }}</p>
              </div>

              <!-- Date of Birth -->
              <div>
                <label for="date_of_birth" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Date of Birth
                </label>
                <input
                  id="date_of_birth"
                  v-model="form.date_of_birth"
                  type="date"
                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-colors"
                >
              </div>

              <!-- Gender -->
              <div>
                <label for="gender" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Gender
                </label>
                <select
                  id="gender"
                  v-model="form.gender"
                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-colors"
                >
                  <option value="">Select Gender</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                  <option value="other">Other</option>
                  <option value="prefer_not_to_say">Prefer not to say</option>
                </select>
              </div>

              <!-- Country -->
              <div>
                <label for="country" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Country
                </label>
                <input
                  id="country"
                  v-model="form.country"
                  type="text"
                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-colors"
                >
              </div>

              <!-- City -->
              <div>
                <label for="city" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  City
                </label>
                <input
                  id="city"
                  v-model="form.city"
                  type="text"
                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-colors"
                >
              </div>

              <!-- Timezone -->
              <div>
                <label for="timezone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Timezone
                </label>
                <select
                  id="timezone"
                  v-model="form.timezone"
                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-colors"
                >
                  <option value="UTC">UTC</option>
                  <option value="America/New_York">Eastern Time</option>
                  <option value="America/Chicago">Central Time</option>
                  <option value="America/Denver">Mountain Time</option>
                  <option value="America/Los_Angeles">Pacific Time</option>
                  <option value="Europe/London">London</option>
                  <option value="Europe/Paris">Paris</option>
                  <option value="Asia/Tokyo">Tokyo</option>
                  <option value="Asia/Shanghai">Shanghai</option>
                  <option value="Asia/Kolkata">India</option>
                </select>
              </div>
            </div>
          </div>

          <!-- Bio Section -->
          <div>
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4 flex items-center">
              <i class="fas fa-edit mr-2 text-primary-600"></i>
              About Me
            </h3>
            <div>
              <label for="bio" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Bio
              </label>
              <textarea
                id="bio"
                v-model="form.bio"
                rows="4"
                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-colors resize-none"
                placeholder="Tell us about yourself, your experience, and your goals..."
              ></textarea>
            </div>
          </div>

          <!-- Success Message -->
          <div v-if="showSuccess" class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 rounded-lg p-4">
            <div class="flex items-center">
              <i class="fas fa-check-circle text-green-500 mr-3"></i>
              <p class="text-sm text-green-800 dark:text-green-200">Profile updated successfully!</p>
            </div>
          </div>

          <!-- Error Messages -->
          <div v-if="errors.general" class="bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-700 rounded-lg p-4">
            <div class="flex items-center">
              <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
              <p class="text-sm text-red-800 dark:text-red-200">{{ errors.general }}</p>
            </div>
          </div>

          <div v-if="errors.avatar" class="bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-700 rounded-lg p-4">
            <div class="flex items-center">
              <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
              <p class="text-sm text-red-800 dark:text-red-200">{{ errors.avatar }}</p>
            </div>
          </div>

          <!-- Submit Button -->
          <div class="flex justify-end pt-6 border-t border-gray-100 dark:border-gray-700">
            <button
              type="submit"
              :disabled="isLoading"
              class="gradient-btn text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed"
            >
              <span v-if="isLoading" class="flex items-center">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Updating...
              </span>
              <span v-else class="flex items-center">
                <i class="fas fa-save mr-2"></i>
                Save Changes
              </span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <Footer />
</template>

<script>
import { Head } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3'
import Header from '../Common/Header.vue'
import Footer from '../Common/Footer.vue'

export default {
  name: 'ProfileIndex',
  components: {
    Head,
    Header,
    Footer
  },
  props: {
    user: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      form: {
        name: this.user.name || '',
        email: this.user.email || '',
        phone: this.user.phone || '',
        date_of_birth: this.user.date_of_birth || '',
        gender: this.user.gender || '',
        country: this.user.country || '',
        city: this.user.city || '',
        timezone: this.user.timezone || 'UTC',
        bio: this.user.bio || '',
        avatar: null
      },
      errors: {},
      isLoading: false,
      showSuccess: false,
      avatarPreview: null,
      isUploadingAvatar: false
    }
  },
  computed: {
    profileCompletionPercentage() {
      const fields = [
        'name', 'email', 'phone', 'date_of_birth',
        'gender', 'country', 'city', 'bio'
      ]

      const completedFields = fields.filter(field =>
        this.form[field] && this.form[field].toString().trim() !== ''
      ).length

      return Math.round((completedFields / fields.length) * 100)
    }
  },
  methods: {
    formatDate(dateString) {
      if (!dateString) return ''
      const date = new Date(dateString)
      return date.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long'
      })
    },
    async updateProfile() {
      this.isLoading = true
      this.errors = {}
      this.showSuccess = false

      try {
        await router.put('/profile', this.form, {
          onSuccess: () => {
            this.showSuccess = true
            this.isLoading = false
            // Hide success message after 3 seconds
            setTimeout(() => {
              this.showSuccess = false
            }, 3000)
          },
          onError: (errors) => {
            this.errors = errors
            this.isLoading = false
          }
        })
      } catch (error) {
        console.error('Profile update error:', error)
        this.errors.general = 'An error occurred. Please try again.'
        this.isLoading = false
      }
    },
    triggerFileUpload() {
      // Use fileInput from the header or the form
      const fileInput = this.$refs.fileInput
      if (fileInput) {
        fileInput.click()
      }
    },
    handleAvatarUpload(event) {
      const file = event.target.files[0]
      if (!file) return

      // Validate file type
      const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif']
      if (!allowedTypes.includes(file.type)) {
        this.errors.avatar = 'Please select a valid image file (JPG, PNG, or GIF)'
        return
      }

      // Validate file size (max 5MB)
      const maxSize = 5 * 1024 * 1024 // 5MB
      if (file.size > maxSize) {
        this.errors.avatar = 'Image size must be less than 5MB'
        return
      }

      // Create preview
      const reader = new FileReader()
      reader.onload = (e) => {
        this.avatarPreview = e.target.result
      }
      reader.readAsDataURL(file)

      // Store file for upload
      this.form.avatar = file
      this.errors.avatar = null

      // Auto-upload the avatar
      this.uploadAvatar()
    },
    async uploadAvatar() {
      if (!this.form.avatar) return

      this.isUploadingAvatar = true

      const formData = new FormData()
      formData.append('avatar', this.form.avatar)

      try {
        await router.post('/profile/avatar', formData, {
          onSuccess: (page) => {
            this.isUploadingAvatar = false
            this.showSuccess = true
            this.avatarPreview = null

            // Update the user avatar in the page props
            this.$page.props.auth.user.avatar_url = page.props.auth.user.avatar_url

            setTimeout(() => {
              this.showSuccess = false
            }, 3000)
          },
          onError: (errors) => {
            this.errors = { ...this.errors, ...errors }
            this.isUploadingAvatar = false
            this.avatarPreview = null
          }
        })
      } catch (error) {
        console.error('Avatar upload error:', error)
        this.errors.avatar = 'Failed to upload avatar. Please try again.'
        this.isUploadingAvatar = false
        this.avatarPreview = null
      }
    }
  }
}
</script>

<style scoped>
.gradient-btn {
  background: linear-gradient(135deg, #059669 0%, #0891b2 100%);
}

/* Add mobile menu styles */
.mobile-menu {
  transform: translateX(100%);
  transition: transform 0.3s ease-in-out;
}

.mobile-menu.show {
  transform: translateX(0);
}

.submenu {
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.3s ease-out;
}

.submenu.show {
  max-height: 200px;
}

.mega-menu {
  opacity: 0;
  visibility: hidden;
  transform: translateY(-10px);
  transition: all 0.2s ease-out;
}

.group:hover .mega-menu {
  opacity: 1;
  visibility: visible;
  transform: translateY(0);
}

/* Primary color utilities */
.text-primary-600 {
  color: #059669;
}

.text-primary-400 {
  color: #34d399;
}

.border-primary-600 {
  border-color: #059669;
}

.border-primary-400 {
  border-color: #34d399;
}

.bg-primary-600 {
  background-color: #059669;
}

.bg-primary-50 {
  background-color: #ecfdf5;
}

.bg-primary-900 {
  background-color: #064e3b;
}

.hover\:text-primary-600:hover {
  color: #059669;
}

.hover\:text-primary-400:hover {
  color: #34d399;
}

.focus\:ring-primary-500:focus {
  --tw-ring-color: #10b981;
}

.focus\:border-primary-500:focus {
  border-color: #10b981;
}

.hover\:border-primary-600:hover {
  border-color: #059669;
}

.hover\:bg-primary-700:hover {
  background-color: #047857;
}

.dark .dark\:text-primary-400 {
  color: #34d399;
}

.dark .dark\:border-primary-400 {
  border-color: #34d399;
}

.dark .dark\:hover\:text-primary-400:hover {
  color: #34d399;
}

.dark .dark\:focus\:ring-primary-600:focus {
  --tw-ring-color: #059669;
}
</style>