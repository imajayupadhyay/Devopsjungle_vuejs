<template>
  <transition name="modal">
    <div v-if="show && ticket" class="fixed inset-0 z-50 overflow-y-auto" @click.self="close">
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

          <!-- Ticket Header -->
          <div class="mb-6 pb-6 border-b border-white/10">
            <div class="flex items-start justify-between">
              <div>
                <div class="flex items-center space-x-2 mb-2">
                  <h3 class="text-2xl font-bold text-white">Ticket #{{ ticket.id }}</h3>
                  <span
                    :class="[
                      'px-3 py-1 rounded-full text-xs font-semibold',
                      ticket.status === 'pending'
                        ? 'bg-yellow-500/20 text-yellow-300 border border-yellow-500/30'
                        : ticket.status === 'in_progress'
                        ? 'bg-purple-500/20 text-purple-300 border border-purple-500/30'
                        : ticket.status === 'resolved'
                        ? 'bg-green-500/20 text-green-300 border border-green-500/30'
                        : 'bg-gray-500/20 text-gray-300 border border-gray-500/30'
                    ]"
                  >
                    {{ formatStatus(ticket.status) }}
                  </span>
                  <span
                    :class="[
                      'px-3 py-1 rounded-full text-xs font-semibold',
                      ticket.priority === 'urgent'
                        ? 'bg-red-500/20 text-red-300 border border-red-500/30'
                        : ticket.priority === 'high'
                        ? 'bg-orange-500/20 text-orange-300 border border-orange-500/30'
                        : ticket.priority === 'medium'
                        ? 'bg-yellow-500/20 text-yellow-300 border border-yellow-500/30'
                        : 'bg-blue-500/20 text-blue-300 border border-blue-500/30'
                    ]"
                  >
                    {{ formatPriority(ticket.priority) }}
                  </span>
                </div>
                <p class="text-gray-400">Submitted {{ formatDate(ticket.created_at) }}</p>
              </div>
            </div>
          </div>

          <!-- Ticket Details -->
          <div class="space-y-6">
            <!-- Requester Information -->
            <div>
              <h4 class="text-white font-semibold mb-3 flex items-center">
                <i class="fas fa-user text-primary-400 mr-2"></i>
                Requester Information
              </h4>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white/5 border border-white/10 rounded-lg p-4">
                  <p class="text-gray-400 text-sm mb-1">Name</p>
                  <p class="text-white font-medium">{{ ticket.name }}</p>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-lg p-4">
                  <p class="text-gray-400 text-sm mb-1">Email</p>
                  <p class="text-white font-medium">{{ ticket.email }}</p>
                </div>
                <div v-if="ticket.number" class="bg-white/5 border border-white/10 rounded-lg p-4 md:col-span-2">
                  <p class="text-gray-400 text-sm mb-1">Phone Number</p>
                  <p class="text-white font-medium">{{ ticket.number }}</p>
                </div>
              </div>
            </div>

            <!-- Message -->
            <div>
              <h4 class="text-white font-semibold mb-3 flex items-center">
                <i class="fas fa-message text-primary-400 mr-2"></i>
                Message
              </h4>
              <div class="bg-white/5 border border-white/10 rounded-lg p-4">
                <p class="text-gray-300 whitespace-pre-wrap">{{ ticket.message }}</p>
              </div>
            </div>

            <!-- Ticket Meta -->
            <div>
              <h4 class="text-white font-semibold mb-3 flex items-center">
                <i class="fas fa-info-circle text-primary-400 mr-2"></i>
                Ticket Information
              </h4>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white/5 border border-white/10 rounded-lg p-4">
                  <p class="text-gray-400 text-sm mb-1">Created</p>
                  <p class="text-white font-medium">{{ formatDate(ticket.created_at) }}</p>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-lg p-4">
                  <p class="text-gray-400 text-sm mb-1">Last Updated</p>
                  <p class="text-white font-medium">{{ formatDate(ticket.updated_at) }}</p>
                </div>
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
