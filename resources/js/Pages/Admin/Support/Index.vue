<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-900 via-gray-900 to-black">
    <Head>
      <title>Support Tickets - DevOps Jungle Admin</title>
    </Head>

    <!-- Sidebar -->
    <Sidebar
      :userName="$page.props.auth?.user?.name || 'Admin'"
      :userAvatar="$page.props.auth?.user?.avatar_url || 'https://ui-avatars.com/api/?name=Admin&background=047857&color=fff'"
      @toggle="handleSidebarToggle"
    />

    <!-- Topbar -->
    <Topbar
      :sidebarCollapsed="sidebarCollapsed"
      :userName="$page.props.auth?.user?.name || 'Admin'"
      :userEmail="$page.props.auth?.user?.email || 'admin@example.com'"
      :userAvatar="$page.props.auth?.user?.avatar_url || 'https://ui-avatars.com/api/?name=Admin&background=047857&color=fff'"
    />

    <!-- Main Content -->
    <main
      :class="[
        'pt-16 transition-all duration-300 min-h-screen',
        sidebarCollapsed ? 'ml-20' : 'ml-64'
      ]"
    >
      <div class="p-6">
        <!-- Header Section -->
        <div class="mb-6">
          <div class="flex items-center justify-between mb-4">
            <div>
              <h1 class="text-3xl font-bold text-white mb-2">Support Tickets</h1>
              <p class="text-gray-400">Manage and respond to support requests</p>
            </div>
          </div>

          <!-- Stats Cards -->
          <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-xl p-4">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-400 text-sm">Total Tickets</p>
                  <p class="text-2xl font-bold text-white">{{ stats.total }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-500/20 rounded-lg flex items-center justify-center">
                  <i class="fas fa-ticket-alt text-blue-400 text-xl"></i>
                </div>
              </div>
            </div>
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-xl p-4">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-400 text-sm">Pending</p>
                  <p class="text-2xl font-bold text-white">{{ stats.pending }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-500/20 rounded-lg flex items-center justify-center">
                  <i class="fas fa-clock text-yellow-400 text-xl"></i>
                </div>
              </div>
            </div>
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-xl p-4">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-400 text-sm">In Progress</p>
                  <p class="text-2xl font-bold text-white">{{ stats.in_progress }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-500/20 rounded-lg flex items-center justify-center">
                  <i class="fas fa-spinner text-purple-400 text-xl"></i>
                </div>
              </div>
            </div>
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-xl p-4">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-400 text-sm">Resolved</p>
                  <p class="text-2xl font-bold text-white">{{ stats.resolved }}</p>
                </div>
                <div class="w-12 h-12 bg-green-500/20 rounded-lg flex items-center justify-center">
                  <i class="fas fa-check-circle text-green-400 text-xl"></i>
                </div>
              </div>
            </div>
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-xl p-4">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-400 text-sm">Closed</p>
                  <p class="text-2xl font-bold text-white">{{ stats.closed }}</p>
                </div>
                <div class="w-12 h-12 bg-gray-500/20 rounded-lg flex items-center justify-center">
                  <i class="fas fa-times-circle text-gray-400 text-xl"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Filters and Search -->
        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-xl p-4 mb-6">
          <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <!-- Search -->
            <div class="relative flex-1 max-w-md">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400"></i>
              </div>
              <input
                v-model="searchQuery"
                type="text"
                placeholder="Search tickets..."
                class="w-full pl-10 pr-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                @input="debouncedSearch"
              />
            </div>

            <!-- Status Filter -->
            <div class="flex items-center space-x-2">
              <button
                v-for="filter in statusFilters"
                :key="filter.value"
                @click="updateFilter(filter.value)"
                :class="[
                  'px-4 py-2 rounded-lg font-medium transition-all duration-200',
                  filters.filter === filter.value
                    ? 'bg-primary-500 text-white'
                    : 'bg-white/5 text-gray-400 hover:bg-white/10 hover:text-white'
                ]"
              >
                {{ filter.label }}
              </button>
            </div>
          </div>
        </div>

        <!-- Support Tickets Table -->
        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-xl overflow-hidden">
          <div class="overflow-x-auto">
            <table class="w-full">
              <thead class="bg-white/5 border-b border-white/10">
                <tr>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                    ID
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                    Requester
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                    Message
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                    Priority
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                    Status
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                    Date
                  </th>
                  <th class="px-6 py-4 text-right text-xs font-semibold text-gray-400 uppercase tracking-wider">
                    Actions
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-white/5">
                <tr
                  v-for="ticket in tickets.data"
                  :key="ticket.id"
                  class="hover:bg-white/5 transition-colors"
                >
                  <td class="px-6 py-4 whitespace-nowrap">
                    <p class="text-white font-medium">#{{ ticket.id }}</p>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div>
                      <p class="text-white font-medium">{{ ticket.name }}</p>
                      <p class="text-gray-400 text-sm">{{ ticket.email }}</p>
                      <p v-if="ticket.number" class="text-gray-400 text-xs">{{ ticket.number }}</p>
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <p class="text-gray-300 line-clamp-2">{{ ticket.message }}</p>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <select
                      :value="ticket.priority"
                      @change="updatePriority(ticket, $event.target.value)"
                      :class="[
                        'px-3 py-1 rounded-full text-xs font-semibold border cursor-pointer',
                        ticket.priority === 'urgent'
                          ? 'bg-red-500/20 text-red-300 border-red-500/30'
                          : ticket.priority === 'high'
                          ? 'bg-orange-500/20 text-orange-300 border-orange-500/30'
                          : ticket.priority === 'medium'
                          ? 'bg-yellow-500/20 text-yellow-300 border-yellow-500/30'
                          : 'bg-blue-500/20 text-blue-300 border-blue-500/30'
                      ]"
                    >
                      <option value="low">Low</option>
                      <option value="medium">Medium</option>
                      <option value="high">High</option>
                      <option value="urgent">Urgent</option>
                    </select>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <select
                      :value="ticket.status"
                      @change="updateStatus(ticket, $event.target.value)"
                      :class="[
                        'px-3 py-1 rounded-full text-xs font-semibold border cursor-pointer',
                        ticket.status === 'pending'
                          ? 'bg-yellow-500/20 text-yellow-300 border-yellow-500/30'
                          : ticket.status === 'in_progress'
                          ? 'bg-purple-500/20 text-purple-300 border-purple-500/30'
                          : ticket.status === 'resolved'
                          ? 'bg-green-500/20 text-green-300 border-green-500/30'
                          : 'bg-gray-500/20 text-gray-300 border-gray-500/30'
                      ]"
                    >
                      <option value="pending">Pending</option>
                      <option value="in_progress">In Progress</option>
                      <option value="resolved">Resolved</option>
                      <option value="closed">Closed</option>
                    </select>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <p class="text-gray-300 text-sm">{{ formatDate(ticket.created_at) }}</p>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-right">
                    <div class="flex items-center justify-end space-x-2">
                      <!-- View Details -->
                      <button
                        @click="viewTicket(ticket)"
                        class="p-2 text-blue-400 hover:bg-blue-500/20 rounded-lg transition-all duration-200"
                        title="View Details"
                      >
                        <i class="fas fa-eye"></i>
                      </button>

                      <!-- Delete -->
                      <button
                        @click="confirmDelete(ticket)"
                        class="p-2 text-red-400 hover:bg-red-500/20 rounded-lg transition-all duration-200"
                        title="Delete Ticket"
                      >
                        <i class="fas fa-trash"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Pagination -->
          <div v-if="tickets.data.length > 0" class="px-6 py-4 border-t border-white/10">
            <div class="flex items-center justify-between">
              <p class="text-gray-400 text-sm">
                Showing {{ tickets.from }} to {{ tickets.to }} of {{ tickets.total }} tickets
              </p>
              <div class="flex items-center space-x-2">
                <template v-for="link in tickets.links" :key="link.label">
                  <Link
                    v-if="link.url"
                    :href="link.url"
                    :class="[
                      'px-3 py-1 rounded-lg text-sm transition-all duration-200',
                      link.active
                        ? 'bg-primary-500 text-white'
                        : 'bg-white/5 text-gray-400 hover:bg-white/10 hover:text-white'
                    ]"
                    v-html="link.label"
                  ></Link>
                  <span
                    v-else
                    :class="[
                      'px-3 py-1 rounded-lg text-sm bg-white/5 text-gray-600 cursor-not-allowed'
                    ]"
                    v-html="link.label"
                  ></span>
                </template>
              </div>
            </div>
          </div>

          <!-- Empty State -->
          <div v-if="tickets.data.length === 0" class="px-6 py-12 text-center">
            <i class="fas fa-inbox text-gray-600 text-5xl mb-4"></i>
            <p class="text-gray-400 text-lg">No support tickets found</p>
            <p class="text-gray-500 text-sm mt-2">Try adjusting your search or filters</p>
          </div>
        </div>
      </div>
    </main>

    <!-- View Ticket Modal -->
    <TicketViewModal
      :show="showViewModal"
      :ticket="viewingTicket"
      @close="closeViewModal"
    />

    <!-- Delete Confirmation Modal -->
    <ConfirmModal
      :show="showDeleteModal"
      title="Delete Ticket"
      message="Are you sure you want to delete this support ticket? This action cannot be undone."
      @confirm="deleteTicket"
      @cancel="closeDeleteModal"
    />
  </div>
</template>

<script>
import { Head, Link, router } from '@inertiajs/vue3'
import { ref } from 'vue'
import Sidebar from '../Common/Sidebar.vue'
import Topbar from '../Common/Topbar.vue'
import TicketViewModal from './TicketViewModal.vue'
import ConfirmModal from '../Common/ConfirmModal.vue'

export default {
  name: 'SupportIndex',
  components: {
    Head,
    Link,
    Sidebar,
    Topbar,
    TicketViewModal,
    ConfirmModal
  },
  props: {
    tickets: {
      type: Object,
      required: true
    },
    filters: {
      type: Object,
      default: () => ({})
    },
    stats: {
      type: Object,
      default: () => ({})
    }
  },
  setup(props) {
    const sidebarCollapsed = ref(false)
    const showViewModal = ref(false)
    const showDeleteModal = ref(false)
    const viewingTicket = ref(null)
    const ticketToDelete = ref(null)
    const searchQuery = ref(props.filters.search || '')

    const statusFilters = [
      { label: 'All', value: 'all' },
      { label: 'Pending', value: 'pending' },
      { label: 'In Progress', value: 'in_progress' },
      { label: 'Resolved', value: 'resolved' },
      { label: 'Closed', value: 'closed' }
    ]

    let searchTimeout = null
    const debouncedSearch = () => {
      clearTimeout(searchTimeout)
      searchTimeout = setTimeout(() => {
        router.get('/admin/support', {
          search: searchQuery.value,
          filter: props.filters.filter
        }, {
          preserveState: true,
          preserveScroll: true
        })
      }, 500)
    }

    const updateFilter = (filter) => {
      router.get('/admin/support', {
        search: searchQuery.value,
        filter: filter
      }, {
        preserveState: true,
        preserveScroll: true
      })
    }

    const handleSidebarToggle = (collapsed) => {
      sidebarCollapsed.value = collapsed
    }

    const viewTicket = (ticket) => {
      viewingTicket.value = ticket
      showViewModal.value = true
    }

    const closeViewModal = () => {
      showViewModal.value = false
      viewingTicket.value = null
    }

    const updateStatus = (ticket, newStatus) => {
      router.post(`/admin/support/${ticket.id}/status`, {
        status: newStatus
      }, {
        preserveScroll: true
      })
    }

    const updatePriority = (ticket, newPriority) => {
      router.post(`/admin/support/${ticket.id}/priority`, {
        priority: newPriority
      }, {
        preserveScroll: true
      })
    }

    const confirmDelete = (ticket) => {
      ticketToDelete.value = ticket
      showDeleteModal.value = true
    }

    const deleteTicket = () => {
      if (ticketToDelete.value) {
        router.delete(`/admin/support/${ticketToDelete.value.id}`, {
          onSuccess: () => {
            closeDeleteModal()
          }
        })
      }
    }

    const closeDeleteModal = () => {
      showDeleteModal.value = false
      ticketToDelete.value = null
    }

    const formatDate = (date) => {
      return new Date(date).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
      })
    }

    return {
      sidebarCollapsed,
      showViewModal,
      showDeleteModal,
      viewingTicket,
      searchQuery,
      statusFilters,
      handleSidebarToggle,
      viewTicket,
      closeViewModal,
      updateStatus,
      updatePriority,
      confirmDelete,
      deleteTicket,
      closeDeleteModal,
      formatDate,
      debouncedSearch,
      updateFilter
    }
  }
}
</script>

<style scoped>
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

/* Custom select styling */
select {
  background-color: transparent;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
}

select option {
  background-color: #1e293b;
  color: white;
}
</style>
