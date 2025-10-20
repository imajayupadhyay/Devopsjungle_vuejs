<template>
  <transition name="modal">
    <div v-if="show" class="fixed inset-0 z-50 overflow-y-auto" @click.self="close">
      <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
        <!-- Background Overlay -->
        <div class="fixed inset-0 transition-opacity bg-black/70 backdrop-blur-sm" @click="close"></div>

        <!-- Modal Panel -->
        <div class="relative inline-block w-full max-w-3xl px-4 pt-5 pb-4 overflow-hidden text-left align-middle transition-all transform bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-2xl sm:my-8 sm:p-6">
          <!-- Close Button -->
          <button
            @click="close"
            class="absolute top-4 right-4 p-2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-all duration-200"
          >
            <i class="fas fa-times"></i>
          </button>

          <!-- Modal Header -->
          <div class="mb-6">
            <div class="w-12 h-12 bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-lg flex items-center justify-center mb-4">
              <i :class="isEditing ? 'fas fa-user-edit' : 'fas fa-user-plus'" class="text-white text-xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 dark:text-white">
              {{ isEditing ? 'Edit Student' : 'Create New Student' }}
            </h3>
            <p class="text-gray-600 dark:text-gray-400 mt-1">
              {{ isEditing ? 'Update student information' : 'Add a new student to the system' }}
            </p>
          </div>

          <!-- Form -->
          <form @submit.prevent="submit" class="space-y-6">
            <!-- Basic Information -->
            <div>
              <h4 class="text-gray-800 dark:text-white font-semibold mb-3 flex items-center">
                <i class="fas fa-user text-emerald-600 dark:text-emerald-400 mr-2"></i>
                Basic Information
              </h4>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Name -->
                <div>
                  <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Full Name <span class="text-red-500">*</span>
                  </label>
                  <input
                    id="name"
                    v-model="form.name"
                    type="text"
                    required
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    placeholder="Enter full name"
                  />
                  <p v-if="form.errors?.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</p>
                </div>

                <!-- Email -->
                <div>
                  <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Email Address <span class="text-red-500">*</span>
                  </label>
                  <input
                    id="email"
                    v-model="form.email"
                    type="email"
                    required
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    placeholder="Enter email address"
                  />
                  <p v-if="form.errors?.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</p>
                </div>

                <!-- Phone -->
                <div>
                  <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Phone Number <span class="text-red-500">*</span>
                  </label>
                  <input
                    id="phone"
                    v-model="form.phone"
                    type="tel"
                    required
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    placeholder="Enter phone number"
                  />
                  <p v-if="form.errors?.phone" class="text-red-500 text-sm mt-1">{{ form.errors.phone }}</p>
                </div>

                <!-- Password -->
                <div>
                  <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Password <span v-if="!isEditing" class="text-red-500">*</span>
                    <span v-else class="text-gray-500 dark:text-gray-400 text-xs">(leave blank to keep current)</span>
                  </label>
                  <div class="relative">
                    <input
                      id="password"
                      v-model="form.password"
                      :type="showPassword ? 'text' : 'password'"
                      :required="!isEditing"
                      class="w-full px-4 py-3 pr-12 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                      :placeholder="isEditing ? 'Enter new password (optional)' : 'Enter password'"
                    />
                    <button
                      type="button"
                      @click="showPassword = !showPassword"
                      class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-700 dark:hover:text-white"
                    >
                      <i :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                    </button>
                  </div>
                  <p v-if="form.errors?.password" class="text-red-500 text-sm mt-1">{{ form.errors.password }}</p>
                </div>
              </div>
            </div>

            <!-- Personal Details -->
            <div>
              <h4 class="text-gray-800 dark:text-white font-semibold mb-3 flex items-center">
                <i class="fas fa-id-card text-emerald-600 dark:text-emerald-400 mr-2"></i>
                Personal Details
              </h4>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Date of Birth -->
                <div>
                  <label for="date_of_birth" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Date of Birth
                  </label>
                  <input
                    id="date_of_birth"
                    v-model="form.date_of_birth"
                    type="date"
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                  />
                  <p v-if="form.errors?.date_of_birth" class="text-red-500 text-sm mt-1">{{ form.errors.date_of_birth }}</p>
                </div>

                <!-- Gender -->
                <div>
                  <label for="gender" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Gender
                  </label>
                  <select
                    id="gender"
                    v-model="form.gender"
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                  >
                    <option value="">Select gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                    <option value="prefer_not_to_say">Prefer not to say</option>
                  </select>
                  <p v-if="form.errors?.gender" class="text-red-500 text-sm mt-1">{{ form.errors.gender }}</p>
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
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    placeholder="Enter country"
                  />
                  <p v-if="form.errors?.country" class="text-red-500 text-sm mt-1">{{ form.errors.country }}</p>
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
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    placeholder="Enter city"
                  />
                  <p v-if="form.errors?.city" class="text-red-500 text-sm mt-1">{{ form.errors.city }}</p>
                </div>
              </div>
            </div>

            <!-- Additional Information -->
            <div>
              <h4 class="text-gray-800 dark:text-white font-semibold mb-3 flex items-center">
                <i class="fas fa-cog text-emerald-600 dark:text-emerald-400 mr-2"></i>
                Additional Information
              </h4>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Status -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Status <span class="text-red-500">*</span>
                  </label>
                  <div class="grid grid-cols-3 gap-2">
                    <button
                      type="button"
                      @click="form.status = 'active'"
                      :class="[
                        'p-3 rounded-lg border-2 transition-all duration-200',
                        form.status === 'active'
                          ? 'border-green-500 bg-green-50 dark:bg-green-900/20'
                          : 'border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 hover:border-gray-400 dark:hover:border-gray-500'
                      ]"
                    >
                      <i class="fas fa-check-circle text-green-600 dark:text-green-400 block mb-1"></i>
                      <p :class="form.status === 'active' ? 'text-gray-800 dark:text-white' : 'text-gray-600 dark:text-gray-400'" class="text-xs font-medium">Active</p>
                    </button>
                    <button
                      type="button"
                      @click="form.status = 'inactive'"
                      :class="[
                        'p-3 rounded-lg border-2 transition-all duration-200',
                        form.status === 'inactive'
                          ? 'border-gray-500 bg-gray-50 dark:bg-gray-900/20'
                          : 'border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 hover:border-gray-400 dark:hover:border-gray-500'
                      ]"
                    >
                      <i class="fas fa-minus-circle text-gray-600 dark:text-gray-400 block mb-1"></i>
                      <p :class="form.status === 'inactive' ? 'text-gray-800 dark:text-white' : 'text-gray-600 dark:text-gray-400'" class="text-xs font-medium">Inactive</p>
                    </button>
                    <button
                      type="button"
                      @click="form.status = 'suspended'"
                      :class="[
                        'p-3 rounded-lg border-2 transition-all duration-200',
                        form.status === 'suspended'
                          ? 'border-red-500 bg-red-50 dark:bg-red-900/20'
                          : 'border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 hover:border-gray-400 dark:hover:border-gray-500'
                      ]"
                    >
                      <i class="fas fa-ban text-red-600 dark:text-red-400 block mb-1"></i>
                      <p :class="form.status === 'suspended' ? 'text-gray-800 dark:text-white' : 'text-gray-600 dark:text-gray-400'" class="text-xs font-medium">Suspended</p>
                    </button>
                  </div>
                </div>

                <!-- Timezone -->
                <div>
                  <label for="timezone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Timezone
                  </label>
                  <input
                    id="timezone"
                    v-model="form.timezone"
                    type="text"
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    placeholder="e.g., UTC, America/New_York"
                  />
                  <p v-if="form.errors?.timezone" class="text-red-500 text-sm mt-1">{{ form.errors.timezone }}</p>
                </div>
              </div>

              <!-- Bio -->
              <div class="mt-4">
                <label for="bio" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Bio / Description
                </label>
                <textarea
                  id="bio"
                  v-model="form.bio"
                  rows="3"
                  class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all resize-none"
                  placeholder="Enter student bio or description..."
                ></textarea>
                <p v-if="form.errors?.bio" class="text-red-500 text-sm mt-1">{{ form.errors.bio }}</p>
              </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
              <button
                type="button"
                @click="close"
                class="px-6 py-3 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg font-medium hover:bg-gray-200 dark:hover:bg-gray-600 transition-all duration-200"
              >
                Cancel
              </button>
              <button
                type="submit"
                :disabled="form.processing"
                class="px-6 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-lg font-semibold hover:from-emerald-600 hover:to-emerald-700 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed flex items-center space-x-2"
              >
                <i v-if="form.processing" class="fas fa-spinner fa-spin"></i>
                <i v-else :class="isEditing ? 'fas fa-save' : 'fas fa-plus'"></i>
                <span>{{ isEditing ? 'Update Student' : 'Create Student' }}</span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
import { ref, watch, computed } from 'vue'
import { useForm } from '@inertiajs/vue3'

export default {
  name: 'StudentModal',
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
  emits: ['close', 'submit'],
  setup(props, { emit }) {
    const showPassword = ref(false)

    const form = useForm({
      name: '',
      email: '',
      phone: '',
      password: '',
      status: 'active',
      bio: '',
      date_of_birth: '',
      gender: '',
      country: '',
      city: '',
      timezone: 'UTC'
    })

    const isEditing = computed(() => !!props.student)

    // Watch for student prop changes to populate form
    watch(() => props.student, (newStudent) => {
      if (newStudent) {
        form.name = newStudent.name || ''
        form.email = newStudent.email || ''
        form.phone = newStudent.phone || ''
        form.password = ''
        form.status = newStudent.status || 'active'
        form.bio = newStudent.bio || ''
        // Format date properly for input[type="date"]
        if (newStudent.date_of_birth) {
          // If it's already in YYYY-MM-DD format, use it directly
          // Otherwise, parse and format it
          const date = new Date(newStudent.date_of_birth)
          if (!isNaN(date.getTime())) {
            form.date_of_birth = date.toISOString().split('T')[0]
          } else {
            form.date_of_birth = ''
          }
        } else {
          form.date_of_birth = ''
        }
        form.gender = newStudent.gender || ''
        form.country = newStudent.country || ''
        form.city = newStudent.city || ''
        form.timezone = newStudent.timezone || 'UTC'
      } else {
        form.reset()
      }
    }, { immediate: true })

    const close = () => {
      form.reset()
      form.clearErrors()
      showPassword.value = false
      emit('close')
    }

    const submit = () => {
      emit('submit', form.data())
    }

    return {
      form,
      showPassword,
      isEditing,
      close,
      submit
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

/* Custom select arrow styling */
select {
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%239ca3af' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
  background-position: right 0.5rem center;
  background-repeat: no-repeat;
  background-size: 1.5em 1.5em;
  padding-right: 2.5rem;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
}

select option {
  background-color: #f9fafb;
  color: #1f2937;
}

.dark select option {
  background-color: #374151;
  color: white;
}
</style>
