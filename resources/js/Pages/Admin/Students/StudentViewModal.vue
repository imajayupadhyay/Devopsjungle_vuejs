<template>
  <transition name="modal">
    <div v-if="show && student" class="fixed inset-0 z-50 overflow-y-auto" @click.self="close">
      <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
        <!-- Background Overlay -->
        <div class="fixed inset-0 transition-opacity bg-black/70 backdrop-blur-sm" @click="close"></div>

        <!-- Modal Panel -->
        <div class="relative inline-block w-full max-w-2xl px-4 pt-5 pb-4 overflow-hidden text-left align-middle transition-all transform bg-gradient-to-br from-slate-900 via-gray-900 to-black border border-white/10 rounded-2xl shadow-2xl sm:my-8 sm:p-6">
          <!-- Close Button -->
          <button
            @click="close"
            class="absolute top-4 right-4 p-2 text-gray-400 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-200 z-10"
          >
            <i class="fas fa-times"></i>
          </button>

          <!-- Student Header -->
          <div class="text-center mb-6 pb-6 border-b border-white/10">
            <img
              :src="student.avatar_url"
              :alt="student.name"
              class="w-24 h-24 rounded-full border-4 border-primary-500 mx-auto mb-4"
            />
            <h3 class="text-2xl font-bold text-white">{{ student.name }}</h3>
            <p class="text-gray-400 mt-1">{{ student.email }}</p>
            <div class="mt-3">
              <span
                :class="[
                  'px-4 py-2 rounded-full text-sm font-semibold inline-block',
                  student.status === 'active'
                    ? 'bg-green-500/20 text-green-300 border border-green-500/30'
                    : student.status === 'inactive'
                    ? 'bg-gray-500/20 text-gray-300 border border-gray-500/30'
                    : 'bg-red-500/20 text-red-300 border border-red-500/30'
                ]"
              >
                <i
                  :class="[
                    student.status === 'active' ? 'fas fa-check-circle' :
                    student.status === 'inactive' ? 'fas fa-minus-circle' :
                    'fas fa-ban'
                  ]"
                  class="mr-1"
                ></i>
                {{ student.status.charAt(0).toUpperCase() + student.status.slice(1) }}
              </span>
            </div>
          </div>

          <!-- Student Details -->
          <div class="space-y-6">
            <!-- Contact Information -->
            <div>
              <h4 class="text-white font-semibold mb-3 flex items-center">
                <i class="fas fa-address-book text-primary-400 mr-2"></i>
                Contact Information
              </h4>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white/5 border border-white/10 rounded-lg p-4">
                  <p class="text-gray-400 text-sm mb-1">Email</p>
                  <p class="text-white font-medium">{{ student.email }}</p>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-lg p-4">
                  <p class="text-gray-400 text-sm mb-1">Phone</p>
                  <p class="text-white font-medium">{{ student.phone }}</p>
                </div>
              </div>
            </div>

            <!-- Personal Information -->
            <div>
              <h4 class="text-white font-semibold mb-3 flex items-center">
                <i class="fas fa-id-card text-primary-400 mr-2"></i>
                Personal Information
              </h4>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white/5 border border-white/10 rounded-lg p-4">
                  <p class="text-gray-400 text-sm mb-1">Date of Birth</p>
                  <p class="text-white font-medium">{{ student.date_of_birth ? formatDate(student.date_of_birth) : 'Not provided' }}</p>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-lg p-4">
                  <p class="text-gray-400 text-sm mb-1">Gender</p>
                  <p class="text-white font-medium">{{ formatGender(student.gender) }}</p>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-lg p-4">
                  <p class="text-gray-400 text-sm mb-1">Country</p>
                  <p class="text-white font-medium">{{ student.country || 'Not provided' }}</p>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-lg p-4">
                  <p class="text-gray-400 text-sm mb-1">City</p>
                  <p class="text-white font-medium">{{ student.city || 'Not provided' }}</p>
                </div>
              </div>
            </div>

            <!-- Account Information -->
            <div>
              <h4 class="text-white font-semibold mb-3 flex items-center">
                <i class="fas fa-info-circle text-primary-400 mr-2"></i>
                Account Information
              </h4>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white/5 border border-white/10 rounded-lg p-4">
                  <p class="text-gray-400 text-sm mb-1">Student ID</p>
                  <p class="text-white font-medium">#{{ student.id }}</p>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-lg p-4">
                  <p class="text-gray-400 text-sm mb-1">Timezone</p>
                  <p class="text-white font-medium">{{ student.timezone || 'UTC' }}</p>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-lg p-4">
                  <p class="text-gray-400 text-sm mb-1">Registered</p>
                  <p class="text-white font-medium">{{ formatDate(student.created_at) }}</p>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-lg p-4">
                  <p class="text-gray-400 text-sm mb-1">Last Login</p>
                  <p class="text-white font-medium">{{ student.last_login_at ? formatDate(student.last_login_at) : 'Never' }}</p>
                </div>
              </div>
            </div>

            <!-- Bio -->
            <div v-if="student.bio">
              <h4 class="text-white font-semibold mb-3 flex items-center">
                <i class="fas fa-quote-left text-primary-400 mr-2"></i>
                Bio
              </h4>
              <div class="bg-white/5 border border-white/10 rounded-lg p-4">
                <p class="text-gray-300">{{ student.bio }}</p>
              </div>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="flex items-center justify-end space-x-3 pt-6 mt-6 border-t border-white/10">
            <button
              type="button"
              @click="close"
              class="px-6 py-3 bg-white/5 border border-white/10 text-white rounded-lg font-medium hover:bg-white/10 transition-all duration-200"
            >
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
export default {
  name: 'StudentViewModal',
  props: {
    show: {
      type: Boolean,
      default: false
    },
    student: {
      type: Object,
      default: null
    }
  },
  emits: ['close'],
  setup(props, { emit }) {
    const close = () => {
      emit('close')
    }

    const formatDate = (date) => {
      if (!date) return 'N/A'
      return new Date(date).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
      })
    }

    const formatGender = (gender) => {
      if (!gender) return 'Not provided'
      const genderMap = {
        male: 'Male',
        female: 'Female',
        other: 'Other',
        prefer_not_to_say: 'Prefer not to say'
      }
      return genderMap[gender] || gender
    }

    return {
      close,
      formatDate,
      formatGender
    }
  }
}
</script>

<style scoped>
/* Modal animations */
.modal-enter-active,
.modal-leave-active {
  transition: opacity 0.3s ease;
}

.modal-enter-from,
.modal-leave-to {
  opacity: 0;
}

.modal-enter-active > div > div,
.modal-leave-active > div > div {
  transition: all 0.3s ease;
}

.modal-enter-from > div > div,
.modal-leave-to > div > div {
  transform: scale(0.9);
  opacity: 0;
}
</style>
