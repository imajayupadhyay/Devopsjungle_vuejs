<template>
  <!-- Notification Modal -->
  <div
    v-show="isVisible"
    class="fixed inset-0 bg-black bg-opacity-50 z-[60] flex items-center justify-center p-4"
    @click.self="closeModal"
  >
    <div
      class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-md transform transition-all duration-300"
      :class="isVisible ? 'scale-100 opacity-100' : 'scale-95 opacity-0'"
    >
      <!-- Modal Content -->
      <div class="p-6 text-center">
        <!-- Success Icon -->
        <div v-if="type === 'success'" class="mx-auto flex items-center justify-center w-16 h-16 bg-green-100 dark:bg-green-900/30 rounded-full mb-4">
          <i class="fas fa-check-circle text-3xl text-green-600 dark:text-green-400"></i>
        </div>

        <!-- Error Icon -->
        <div v-else-if="type === 'error'" class="mx-auto flex items-center justify-center w-16 h-16 bg-red-100 dark:bg-red-900/30 rounded-full mb-4">
          <i class="fas fa-exclamation-circle text-3xl text-red-600 dark:text-red-400"></i>
        </div>

        <!-- Warning Icon -->
        <div v-else-if="type === 'warning'" class="mx-auto flex items-center justify-center w-16 h-16 bg-yellow-100 dark:bg-yellow-900/30 rounded-full mb-4">
          <i class="fas fa-exclamation-triangle text-3xl text-yellow-600 dark:text-yellow-400"></i>
        </div>

        <!-- Info Icon -->
        <div v-else class="mx-auto flex items-center justify-center w-16 h-16 bg-blue-100 dark:bg-blue-900/30 rounded-full mb-4">
          <i class="fas fa-info-circle text-3xl text-blue-600 dark:text-blue-400"></i>
        </div>

        <!-- Title -->
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
          {{ title }}
        </h3>

        <!-- Message -->
        <p class="text-gray-600 dark:text-gray-400 mb-6">
          {{ message }}
        </p>

        <!-- Buttons -->
        <div class="flex space-x-3">
          <button
            v-if="showCancel"
            @click="handleCancel"
            class="flex-1 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors"
          >
            {{ cancelText }}
          </button>
          <button
            @click="handleConfirm"
            class="flex-1 px-4 py-2 text-sm font-medium text-white rounded-lg transition-colors"
            :class="buttonClass"
          >
            {{ confirmText }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'NotificationModal',
  props: {
    isVisible: {
      type: Boolean,
      default: false
    },
    type: {
      type: String,
      default: 'info',
      validator: (value) => ['success', 'error', 'warning', 'info'].includes(value)
    },
    title: {
      type: String,
      required: true
    },
    message: {
      type: String,
      required: true
    },
    confirmText: {
      type: String,
      default: 'OK'
    },
    cancelText: {
      type: String,
      default: 'Cancel'
    },
    showCancel: {
      type: Boolean,
      default: false
    },
    autoClose: {
      type: [Boolean, Number],
      default: 3000
    }
  },
  emits: ['close', 'confirm', 'cancel'],
  data() {
    return {
      autoCloseTimer: null
    }
  },
  computed: {
    buttonClass() {
      const classes = {
        success: 'bg-green-600 hover:bg-green-700',
        error: 'bg-red-600 hover:bg-red-700',
        warning: 'bg-yellow-600 hover:bg-yellow-700',
        info: 'bg-blue-600 hover:bg-blue-700'
      }
      return classes[this.type] || classes.info
    }
  },
  watch: {
    isVisible(newVal) {
      if (newVal) {
        document.body.style.overflow = 'hidden'
        this.startAutoClose()
      } else {
        document.body.style.overflow = ''
        this.clearAutoClose()
      }
    }
  },
  beforeUnmount() {
    document.body.style.overflow = ''
    this.clearAutoClose()
  },
  methods: {
    closeModal() {
      this.$emit('close')
    },
    handleConfirm() {
      this.$emit('confirm')
      this.closeModal()
    },
    handleCancel() {
      this.$emit('cancel')
      this.closeModal()
    },
    startAutoClose() {
      if (this.autoClose && typeof this.autoClose === 'number') {
        this.autoCloseTimer = setTimeout(() => {
          this.closeModal()
        }, this.autoClose)
      }
    },
    clearAutoClose() {
      if (this.autoCloseTimer) {
        clearTimeout(this.autoCloseTimer)
        this.autoCloseTimer = null
      }
    }
  }
}
</script>