<template>
  <transition name="modal">
    <div v-if="show && ticket" class="fixed inset-0 z-50 overflow-y-auto" @click.self="close">
      <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
        <!-- Background Overlay -->
        <div class="fixed inset-0 transition-opacity bg-black/70 backdrop-blur-sm" @click="close"></div>

        <!-- Modal Panel -->
        <div class="relative inline-block w-full max-w-2xl px-4 pt-5 pb-4 overflow-hidden text-left align-middle transition-all transform bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-2xl sm:my-8 sm:p-6">
          <!-- Close Button -->
          <button
            @click="close"
            class="absolute top-4 right-4 p-2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-all duration-200 z-10"
          >
            <i class="fas fa-times"></i>
          </button>

          <!-- Ticket Header -->
          <div class="mb-6 pb-6 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-start justify-between">
              <div>
                <div class="flex items-center space-x-2 mb-2">
                  <h3 class="text-2xl font-bold text-gray-800 dark:text-white">Ticket #{{ ticket.id }}</h3>
                  <span
                    :class="[
                      'px-3 py-1 rounded-full text-xs font-semibold',
                      ticket.status === 'pending'
                        ? 'bg-yellow-100 dark:bg-yellow-900/20 text-yellow-700 dark:text-yellow-300 border border-yellow-200 dark:border-yellow-800'
                        : ticket.status === 'in_progress'
                        ? 'bg-purple-100 dark:bg-purple-900/20 text-purple-700 dark:text-purple-300 border border-purple-200 dark:border-purple-800'
                        : ticket.status === 'resolved'
                        ? 'bg-green-100 dark:bg-green-900/20 text-green-700 dark:text-green-300 border border-green-200 dark:border-green-800'
                        : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-600'
                    ]"
                  >
                    {{ formatStatus(ticket.status) }}
                  </span>
                  <span
                    :class="[
                      'px-3 py-1 rounded-full text-xs font-semibold',
                      ticket.priority === 'urgent'
                        ? 'bg-red-100 dark:bg-red-900/20 text-red-700 dark:text-red-300 border border-red-200 dark:border-red-800'
                        : ticket.priority === 'high'
                        ? 'bg-orange-100 dark:bg-orange-900/20 text-orange-700 dark:text-orange-300 border border-orange-200 dark:border-orange-800'
                        : ticket.priority === 'medium'
                        ? 'bg-yellow-100 dark:bg-yellow-900/20 text-yellow-700 dark:text-yellow-300 border border-yellow-200 dark:border-yellow-800'
                        : 'bg-blue-100 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-800'
                    ]"
                  >
                    {{ formatPriority(ticket.priority) }}
                  </span>
                </div>
                <p class="text-gray-600 dark:text-gray-400">Submitted {{ formatDate(ticket.created_at) }}</p>
              </div>
            </div>
          </div>

          <!-- Ticket Details -->
          <div class="space-y-6">
            <!-- Requester Information -->
            <div>
              <h4 class="text-gray-800 dark:text-white font-semibold mb-3 flex items-center">
                <i class="fas fa-user text-emerald-600 dark:text-emerald-400 mr-2"></i>
                Requester Information
              </h4>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg p-4">
                  <p class="text-gray-600 dark:text-gray-400 text-sm mb-1">Name</p>
                  <p class="text-gray-800 dark:text-white font-medium">{{ ticket.name }}</p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg p-4">
                  <p class="text-gray-600 dark:text-gray-400 text-sm mb-1">Email</p>
                  <p class="text-gray-800 dark:text-white font-medium">{{ ticket.email }}</p>
                </div>
                <div v-if="ticket.number" class="bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg p-4 md:col-span-2">
                  <p class="text-gray-600 dark:text-gray-400 text-sm mb-1">Phone Number</p>
                  <p class="text-gray-800 dark:text-white font-medium">{{ ticket.number }}</p>
                </div>
              </div>
            </div>

            <!-- Message -->
            <div>
              <h4 class="text-gray-800 dark:text-white font-semibold mb-3 flex items-center">
                <i class="fas fa-message text-emerald-600 dark:text-emerald-400 mr-2"></i>
                Message
              </h4>
              <div class="bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg p-4">
                <p class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap">{{ ticket.message }}</p>
              </div>
            </div>

            <!-- Ticket Meta -->
            <div>
              <h4 class="text-gray-800 dark:text-white font-semibold mb-3 flex items-center">
                <i class="fas fa-info-circle text-emerald-600 dark:text-emerald-400 mr-2"></i>
                Ticket Information
              </h4>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg p-4">
                  <p class="text-gray-600 dark:text-gray-400 text-sm mb-1">Created</p>
                  <p class="text-gray-800 dark:text-white font-medium">{{ formatDate(ticket.created_at) }}</p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg p-4">
                  <p class="text-gray-600 dark:text-gray-400 text-sm mb-1">Last Updated</p>
                  <p class="text-gray-800 dark:text-white font-medium">{{ formatDate(ticket.updated_at) }}</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="flex items-center justify-end space-x-3 pt-6 mt-6 border-t border-gray-200 dark:border-gray-700">
            <button
              type="button"
              @click="close"
              class="px-6 py-3 bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg font-medium hover:bg-gray-200 dark:hover:bg-gray-600 transition-all duration-200"
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
  name: 'TicketViewModal',
  props: {
    show: {
      type: Boolean,
      default: false
    },
    ticket: {
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
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
      })
    }

    const formatStatus = (status) => {
      const statusMap = {
        pending: 'Pending',
        in_progress: 'In Progress',
        resolved: 'Resolved',
        closed: 'Closed'
      }
      return statusMap[status] || status
    }

    const formatPriority = (priority) => {
      const priorityMap = {
        low: 'Low',
        medium: 'Medium',
        high: 'High',
        urgent: 'Urgent'
      }
      return priorityMap[priority] || priority
    }

    return {
      close,
      formatDate,
      formatStatus,
      formatPriority
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
