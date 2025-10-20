<template>
  <transition name="modal">
    <div v-if="show" class="fixed inset-0 z-50 overflow-y-auto" @click.self="close">
      <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
        <!-- Background Overlay -->
        <div class="fixed inset-0 transition-opacity bg-black/70 backdrop-blur-sm" @click="close"></div>

        <!-- Modal Panel -->
        <div class="relative inline-block w-full max-w-lg px-4 pt-5 pb-4 overflow-hidden text-left align-middle transition-all transform bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-2xl sm:my-8 sm:p-6">
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
              {{ isEditing ? 'Edit User' : 'Create New User' }}
            </h3>
            <p class="text-gray-600 dark:text-gray-400 mt-1">
              {{ isEditing ? 'Update user information' : 'Add a new user to the system' }}
            </p>
          </div>

          <!-- Form -->
          <form @submit.prevent="submit" class="space-y-4">
            <!-- Name Field -->
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Full Name <span class="text-red-500">*</span>
              </label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <i class="fas fa-user text-gray-400"></i>
                </div>
                <input
                  id="name"
                  v-model="form.name"
                  type="text"
                  required
                  class="w-full pl-10 pr-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                  placeholder="Enter full name"
                />
              </div>
              <p v-if="form.errors?.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</p>
            </div>

            <!-- Email Field -->
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Email Address <span class="text-red-500">*</span>
              </label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <i class="fas fa-envelope text-gray-400"></i>
                </div>
                <input
                  id="email"
                  v-model="form.email"
                  type="email"
                  required
                  class="w-full pl-10 pr-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                  placeholder="Enter email address"
                />
              </div>
              <p v-if="form.errors?.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</p>
            </div>

            <!-- Password Field -->
            <div>
              <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Password <span v-if="!isEditing" class="text-red-500">*</span>
                <span v-else class="text-gray-500 dark:text-gray-400 text-xs">(leave blank to keep current)</span>
              </label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <i class="fas fa-lock text-gray-400"></i>
                </div>
                <input
                  id="password"
                  v-model="form.password"
                  :type="showPassword ? 'text' : 'password'"
                  :required="!isEditing"
                  class="w-full pl-10 pr-12 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
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
              <p v-if="!isEditing" class="text-gray-500 dark:text-gray-400 text-xs mt-1">Minimum 8 characters</p>
            </div>

            <!-- Role Selection -->
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                User Role <span class="text-red-500">*</span>
              </label>
              <div class="grid grid-cols-2 gap-3">
                <button
                  type="button"
                  @click="form.is_admin = false"
                  :class="[
                    'p-4 rounded-lg border-2 transition-all duration-200 text-left',
                    !form.is_admin
                      ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/20'
                      : 'border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 hover:border-gray-400 dark:hover:border-gray-500'
                  ]"
                >
                  <div class="flex items-center space-x-3">
                    <div :class="[
                      'w-10 h-10 rounded-lg flex items-center justify-center',
                      !form.is_admin ? 'bg-blue-100 dark:bg-blue-900/30' : 'bg-gray-200 dark:bg-gray-600'
                    ]">
                      <i class="fas fa-user text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <div>
                      <p class="text-gray-800 dark:text-white font-medium">Regular User</p>
                      <p class="text-gray-600 dark:text-gray-400 text-xs">Limited access</p>
                    </div>
                  </div>
                </button>

                <button
                  type="button"
                  @click="form.is_admin = true"
                  :class="[
                    'p-4 rounded-lg border-2 transition-all duration-200 text-left',
                    form.is_admin
                      ? 'border-purple-500 bg-purple-50 dark:bg-purple-900/20'
                      : 'border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 hover:border-gray-400 dark:hover:border-gray-500'
                  ]"
                >
                  <div class="flex items-center space-x-3">
                    <div :class="[
                      'w-10 h-10 rounded-lg flex items-center justify-center',
                      form.is_admin ? 'bg-purple-100 dark:bg-purple-900/30' : 'bg-gray-200 dark:bg-gray-600'
                    ]">
                      <i class="fas fa-shield-alt text-purple-600 dark:text-purple-400"></i>
                    </div>
                    <div>
                      <p class="text-gray-800 dark:text-white font-medium">Administrator</p>
                      <p class="text-gray-600 dark:text-gray-400 text-xs">Full access</p>
                    </div>
                  </div>
                </button>
              </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-3 pt-4">
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
                <span>{{ isEditing ? 'Update User' : 'Create User' }}</span>
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
  name: 'UserModal',
  props: {
    show: {
      type: Boolean,
      default: false
    },
    user: {
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
      password: '',
      is_admin: false
    })

    const isEditing = computed(() => !!props.user)

    // Watch for user prop changes to populate form
    watch(() => props.user, (newUser) => {
      if (newUser) {
        form.name = newUser.name
        form.email = newUser.email
        form.password = ''
        form.is_admin = newUser.is_admin
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
</style>
