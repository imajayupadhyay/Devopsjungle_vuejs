<template>
  <header
    :class="[
      'fixed top-0 right-0 h-16 bg-gradient-to-r from-slate-900 via-gray-900 to-slate-900 border-b border-white/10 backdrop-blur-xl z-30 transition-all duration-300',
      sidebarCollapsed ? 'left-20' : 'left-64'
    ]"
  >
    <div class="h-full px-6 flex items-center justify-between">
      <!-- Left Section - Search Bar -->
      <div class="flex-1 max-w-xl">
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-search text-gray-400"></i>
          </div>
          <input
            v-model="searchQuery"
            type="text"
            placeholder="Search..."
            class="w-full pl-10 pr-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
            @focus="showSearchResults = true"
            @blur="hideSearchResults"
          />

          <!-- Search Results Dropdown -->
          <div
            v-if="showSearchResults && searchQuery"
            class="absolute top-full mt-2 w-full bg-gray-800 border border-white/10 rounded-lg shadow-2xl overflow-hidden"
          >
            <div class="p-2 text-gray-400 text-sm">
              <i class="fas fa-info-circle mr-2"></i>
              Search functionality coming soon...
            </div>
          </div>
        </div>
      </div>

      <!-- Right Section - Actions -->
      <div class="flex items-center space-x-4 ml-6">
        <!-- Quick Add Button -->
        <button
          @click="toggleQuickAdd"
          class="relative p-2 text-gray-400 hover:text-white hover:bg-white/5 rounded-lg transition-all duration-200"
          title="Quick Add"
        >
          <i class="fas fa-plus-circle text-xl"></i>
        </button>

        <!-- Notifications -->
        <div class="relative">
          <button
            @click="toggleNotifications"
            class="relative p-2 text-gray-400 hover:text-white hover:bg-white/5 rounded-lg transition-all duration-200"
            title="Notifications"
          >
            <i class="fas fa-bell text-xl"></i>
            <span v-if="notificationCount > 0"
              class="absolute top-1 right-1 w-4 h-4 bg-gradient-to-r from-red-500 to-red-600 rounded-full flex items-center justify-center text-white text-xs font-bold">
              {{ notificationCount > 9 ? '9+' : notificationCount }}
            </span>
          </button>

          <!-- Notifications Dropdown -->
          <transition name="dropdown">
            <div
              v-if="showNotifications"
              class="absolute right-0 mt-2 w-80 bg-gray-800 border border-white/10 rounded-lg shadow-2xl overflow-hidden"
            >
              <div class="px-4 py-3 border-b border-white/10 flex items-center justify-between">
                <h3 class="text-white font-semibold">Notifications</h3>
                <button class="text-primary-400 text-sm hover:text-primary-300">Mark all read</button>
              </div>
              <div class="max-h-96 overflow-y-auto">
                <div
                  v-for="notification in notifications"
                  :key="notification.id"
                  class="px-4 py-3 hover:bg-white/5 transition-colors border-b border-white/5 last:border-b-0"
                >
                  <div class="flex items-start space-x-3">
                    <div :class="[
                      'w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0',
                      notification.type === 'success' ? 'bg-green-500/20 text-green-400' :
                      notification.type === 'warning' ? 'bg-yellow-500/20 text-yellow-400' :
                      notification.type === 'error' ? 'bg-red-500/20 text-red-400' :
                      'bg-blue-500/20 text-blue-400'
                    ]">
                      <i :class="notification.icon"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                      <p class="text-white text-sm font-medium">{{ notification.title }}</p>
                      <p class="text-gray-400 text-xs mt-1">{{ notification.message }}</p>
                      <p class="text-gray-500 text-xs mt-1">{{ notification.time }}</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="px-4 py-3 bg-white/5 text-center">
                <a href="/admin/notifications" class="text-primary-400 text-sm hover:text-primary-300">View all notifications</a>
              </div>
            </div>
          </transition>
        </div>

        <!-- Messages -->
        <button
          class="relative p-2 text-gray-400 hover:text-white hover:bg-white/5 rounded-lg transition-all duration-200"
          title="Messages"
        >
          <i class="fas fa-envelope text-xl"></i>
        </button>

        <!-- Divider -->
        <div class="h-8 w-px bg-white/10"></div>

        <!-- User Profile Dropdown -->
        <div class="relative">
          <button
            @click="toggleUserMenu"
            class="flex items-center space-x-3 p-2 rounded-lg hover:bg-white/5 transition-all duration-200"
          >
            <div class="text-right hidden sm:block">
              <p class="text-white text-sm font-medium">{{ userName }}</p>
              <p class="text-gray-400 text-xs">Administrator</p>
            </div>
            <img
              :src="userAvatar"
              :alt="userName"
              class="w-10 h-10 rounded-full border-2 border-primary-500"
            >
            <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
          </button>

          <!-- User Menu Dropdown -->
          <transition name="dropdown">
            <div
              v-if="showUserMenu"
              class="absolute right-0 mt-2 w-56 bg-gray-800 border border-white/10 rounded-lg shadow-2xl overflow-hidden"
            >
              <div class="px-4 py-3 border-b border-white/10">
                <p class="text-white font-medium">{{ userName }}</p>
                <p class="text-gray-400 text-sm">{{ userEmail }}</p>
              </div>
              <div class="py-2">
                <a
                  v-for="item in userMenuItems"
                  :key="item.name"
                  :href="item.href"
                  :class="[
                    'flex items-center px-4 py-2 text-gray-300 hover:bg-white/5 hover:text-white transition-colors',
                    item.danger ? 'text-red-400 hover:text-red-300' : ''
                  ]"
                >
                  <i :class="[item.icon, 'mr-3 text-sm w-4']"></i>
                  <span class="text-sm">{{ item.name }}</span>
                </a>
              </div>
              <div class="px-4 py-3 border-t border-white/10">
                <button
                  @click="logout"
                  class="w-full flex items-center justify-center px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-200"
                >
                  <i class="fas fa-sign-out-alt mr-2"></i>
                  Logout
                </button>
              </div>
            </div>
          </transition>
        </div>
      </div>
    </div>
  </header>
</template>

<script>
import { ref, onMounted, onUnmounted } from 'vue'
import { router } from '@inertiajs/vue3'

export default {
  name: 'AdminTopbar',
  props: {
    sidebarCollapsed: {
      type: Boolean,
      default: false
    },
    userName: {
      type: String,
      default: 'Admin User'
    },
    userEmail: {
      type: String,
      default: 'admin@example.com'
    },
    userAvatar: {
      type: String,
      default: ''
    }
  },
  setup(props) {
    const searchQuery = ref('')
    const showSearchResults = ref(false)
    const showNotifications = ref(false)
    const showUserMenu = ref(false)
    const showQuickAdd = ref(false)
    const notificationCount = ref(3)

    const notifications = [
      {
        id: 1,
        type: 'info',
        icon: 'fas fa-user-plus',
        title: 'New User Registration',
        message: 'John Doe just registered',
        time: '5 minutes ago'
      },
      {
        id: 2,
        type: 'success',
        icon: 'fas fa-check-circle',
        title: 'Course Published',
        message: 'Docker Mastery course is now live',
        time: '1 hour ago'
      },
      {
        id: 3,
        type: 'warning',
        icon: 'fas fa-exclamation-triangle',
        title: 'System Update',
        message: 'Server maintenance scheduled',
        time: '2 hours ago'
      }
    ]

    const userMenuItems = [
      { name: 'My Profile', icon: 'fas fa-user', href: '/admin/profile' },
      { name: 'Account Settings', icon: 'fas fa-cog', href: '/admin/settings/account' },
      { name: 'Activity Log', icon: 'fas fa-history', href: '/admin/activity' },
      { name: 'Help & Support', icon: 'fas fa-question-circle', href: '/admin/help' }
    ]

    const hideSearchResults = () => {
      setTimeout(() => {
        showSearchResults.value = false
      }, 200)
    }

    const toggleNotifications = () => {
      showNotifications.value = !showNotifications.value
      showUserMenu.value = false
      showQuickAdd.value = false
    }

    const toggleUserMenu = () => {
      showUserMenu.value = !showUserMenu.value
      showNotifications.value = false
      showQuickAdd.value = false
    }

    const toggleQuickAdd = () => {
      showQuickAdd.value = !showQuickAdd.value
      showNotifications.value = false
      showUserMenu.value = false
    }

    const logout = () => {
      router.post('/admin/logout')
    }

    // Close dropdowns when clicking outside
    const handleClickOutside = (event) => {
      if (!event.target.closest('.relative')) {
        showNotifications.value = false
        showUserMenu.value = false
        showQuickAdd.value = false
      }
    }

    onMounted(() => {
      document.addEventListener('click', handleClickOutside)
    })

    onUnmounted(() => {
      document.removeEventListener('click', handleClickOutside)
    })

    return {
      searchQuery,
      showSearchResults,
      showNotifications,
      showUserMenu,
      showQuickAdd,
      notificationCount,
      notifications,
      userMenuItems,
      hideSearchResults,
      toggleNotifications,
      toggleUserMenu,
      toggleQuickAdd,
      logout
    }
  }
}
</script>

<style scoped>
/* Dropdown animations */
.dropdown-enter-active,
.dropdown-leave-active {
  transition: all 0.2s ease;
}

.dropdown-enter-from {
  opacity: 0;
  transform: translateY(-10px);
}

.dropdown-leave-to {
  opacity: 0;
  transform: translateY(-10px);
}

/* Custom scrollbar for notifications */
.max-h-96::-webkit-scrollbar {
  width: 4px;
}

.max-h-96::-webkit-scrollbar-track {
  background: transparent;
}

.max-h-96::-webkit-scrollbar-thumb {
  background: rgba(255, 255, 255, 0.1);
  border-radius: 2px;
}

.max-h-96::-webkit-scrollbar-thumb:hover {
  background: rgba(255, 255, 255, 0.2);
}
</style>
