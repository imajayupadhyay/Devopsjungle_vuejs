<template>
  <aside
    :class="[
      'fixed left-0 top-0 h-screen bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 transition-all duration-300 z-40',
      isCollapsed ? 'w-20' : 'w-64'
    ]"
  >
    <!-- Logo Section -->
    <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
      <div v-if="!isCollapsed" class="flex items-center space-x-3">
        <div class="w-10 h-10 gradient-btn rounded-lg flex items-center justify-center">
          <i class="fas fa-shield-alt text-white text-lg"></i>
        </div>
        <div>
          <h2 class="text-gray-800 dark:text-white font-bold text-lg">DevOps Jungle</h2>
          <p class="text-gray-500 dark:text-gray-400 text-xs">Admin Panel</p>
        </div>
      </div>
      <div v-else class="w-10 h-10 gradient-btn rounded-lg flex items-center justify-center mx-auto">
        <i class="fas fa-shield-alt text-white text-lg"></i>
      </div>
    </div>

    <!-- Toggle Button -->
    <button
      @click="toggleSidebar"
      class="absolute -right-3 top-20 w-6 h-6 bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-full flex items-center justify-center text-white shadow-lg hover:shadow-xl transition-all duration-200"
      :title="isCollapsed ? 'Expand Sidebar' : 'Collapse Sidebar'"
    >
      <i :class="isCollapsed ? 'fas fa-chevron-right text-xs' : 'fas fa-chevron-left text-xs'"></i>
    </button>

    <!-- Navigation Menu -->
    <nav class="mt-6 px-3 space-y-1 overflow-y-auto" style="max-height: calc(100vh - 180px);">
      <div v-for="item in menuItems" :key="item.name">
        <!-- Menu Item without submenu -->
        <Link
          v-if="!item.submenu"
          :href="item.href"
          :class="[
            'flex items-center px-3 py-3 rounded-lg transition-all duration-200 group relative',
            isActive(item.href)
              ? 'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 shadow-sm'
              : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-emerald-600 dark:hover:text-emerald-400'
          ]"
        >
          <i :class="[item.icon, 'text-lg', isCollapsed ? 'mx-auto' : 'mr-3']"></i>
          <span v-if="!isCollapsed" class="font-medium">{{ item.name }}</span>
          <span v-if="!isCollapsed && item.badge"
            class="ml-auto bg-gradient-to-r from-red-500 to-red-600 text-white text-xs font-bold px-2 py-1 rounded-full">
            {{ item.badge }}
          </span>

          <!-- Tooltip for collapsed state -->
          <div v-if="isCollapsed"
            class="absolute left-full ml-2 px-3 py-2 bg-gray-800 dark:bg-gray-700 text-white text-sm rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 whitespace-nowrap z-50">
            {{ item.name }}
            <div class="absolute top-1/2 -left-1 transform -translate-y-1/2 w-2 h-2 bg-gray-800 dark:bg-gray-700 rotate-45"></div>
          </div>
        </Link>

        <!-- Menu Item with submenu -->
        <div v-else>
          <button
            @click="toggleSubmenu(item.name)"
            :class="[
              'w-full flex items-center px-3 py-3 rounded-lg transition-all duration-200 group relative',
              isSubmenuOpen(item.name) || isSubmenuItemActive(item)
                ? 'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 shadow-sm'
                : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-emerald-600 dark:hover:text-emerald-400'
            ]"
          >
            <i :class="[item.icon, 'text-lg', isCollapsed ? 'mx-auto' : 'mr-3']"></i>
            <span v-if="!isCollapsed" class="font-medium flex-1 text-left">{{ item.name }}</span>
            <i v-if="!isCollapsed"
              :class="[
                'fas fa-chevron-down text-xs transition-transform duration-200',
                isSubmenuOpen(item.name) ? 'rotate-180' : ''
              ]"></i>

            <!-- Tooltip for collapsed state -->
            <div v-if="isCollapsed"
              class="absolute left-full ml-2 px-3 py-2 bg-gray-800 dark:bg-gray-700 text-white text-sm rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 whitespace-nowrap z-50">
              {{ item.name }}
              <div class="absolute top-1/2 -left-1 transform -translate-y-1/2 w-2 h-2 bg-gray-800 dark:bg-gray-700 rotate-45"></div>
            </div>
          </button>

          <!-- Submenu -->
          <div v-if="!isCollapsed && isSubmenuOpen(item.name)" class="ml-4 mt-1 space-y-1">
            <Link
              v-for="subitem in item.submenu"
              :key="subitem.name"
              :href="subitem.href"
              :class="[
                'flex items-center px-3 py-2 rounded-lg transition-all duration-200 text-sm',
                isActive(subitem.href)
                  ? 'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400'
                  : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-emerald-600 dark:hover:text-emerald-400'
              ]"
            >
              <i :class="[subitem.icon, 'text-sm mr-3']"></i>
              <span>{{ subitem.name }}</span>
            </Link>
          </div>
        </div>
      </div>
    </nav>

    <!-- User Section at Bottom -->
    <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
      <div :class="['flex items-center', isCollapsed ? 'justify-center' : 'space-x-3']">
        <img
          :src="userAvatar"
          :alt="userName"
          class="w-10 h-10 rounded-full border-2 border-emerald-600"
        >
        <div v-if="!isCollapsed" class="flex-1 min-w-0">
          <p class="text-gray-800 dark:text-white text-sm font-medium truncate">{{ userName }}</p>
          <p class="text-gray-500 dark:text-gray-400 text-xs">Administrator</p>
        </div>
      </div>
    </div>
  </aside>
</template>

<script>
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3'

export default {
  name: 'AdminSidebar',
  components: {
    Link
  },
  props: {
    userName: {
      type: String,
      default: 'Admin User'
    },
    userAvatar: {
      type: String,
      default: ''
    }
  },
  emits: ['toggle'],
  setup(_, { emit }) {
    const isCollapsed = ref(false)
    const openSubmenus = ref([])
    const currentPath = window.location.pathname

    const menuItems = [
      {
        name: 'Dashboard',
        icon: 'fas fa-dashboard',
        href: '/admin/dashboard'
      },
      {
        name: 'Users',
        icon: 'fas fa-users',
        submenu: [
          { name: 'Admins', icon: 'fas fa-user-shield', href: '/admin/users' },
          { name: 'Students', icon: 'fas fa-user-graduate', href: '/admin/students' }
        ]
      },
      {
        name: 'Blog Management',
        icon: 'fas fa-blog',
        submenu: [
          { name: 'All Posts', icon: 'fas fa-newspaper', href: '/admin/blogs' },
          { name: 'Categories', icon: 'fas fa-folder', href: '/admin/categories' },
          { name: 'Tags', icon: 'fas fa-tags', href: '/admin/tags' }
        ]
      },
      {
        name: 'Exam Dumps',
        icon: 'fas fa-file-alt',
        submenu: [
          { name: 'All Dumps', icon: 'fas fa-list', href: '/admin/exam-dumps' },
          { name: 'Create New', icon: 'fas fa-plus-circle', href: '/admin/exam-dumps/create' },
          { name: 'Providers', icon: 'fas fa-building', href: '/admin/exam-providers' }
        ]
      },
      {
        name: 'Courses',
        icon: 'fas fa-graduation-cap',
        submenu: [
          { name: 'All Courses', icon: 'fas fa-list', href: '/admin/courses' },
          { name: 'Create New', icon: 'fas fa-plus-circle', href: '/admin/courses/create' },
          { name: 'Categories', icon: 'fas fa-folder', href: '/admin/course-categories' }
        ]
      },
      {
        name: 'Support',
        icon: 'fas fa-life-ring',
        href: '/admin/support'
      }
    ]

    const toggleSidebar = () => {
      isCollapsed.value = !isCollapsed.value
      if (isCollapsed.value) {
        openSubmenus.value = []
      } else {
        // Re-initialize open submenus when expanding
        initializeOpenSubmenus()
      }
      emit('toggle', isCollapsed.value)
    }

    const toggleSubmenu = (name) => {
      const index = openSubmenus.value.indexOf(name)
      if (index > -1) {
        openSubmenus.value.splice(index, 1)
      } else {
        openSubmenus.value.push(name)
      }
    }

    const isSubmenuOpen = (name) => {
      return openSubmenus.value.includes(name)
    }

    const isActive = (href) => {
      if (!href) return false
      return currentPath === href || currentPath.startsWith(href + '/')
    }

    // Check if any submenu item is active
    const isSubmenuItemActive = (item) => {
      if (!item.submenu) return false
      return item.submenu.some(subitem => isActive(subitem.href))
    }

    // Initialize open submenus based on current route
    const initializeOpenSubmenus = () => {
      menuItems.forEach(item => {
        if (item.submenu) {
          const hasActiveChild = item.submenu.some(subitem => isActive(subitem.href))
          if (hasActiveChild && !openSubmenus.value.includes(item.name)) {
            openSubmenus.value.push(item.name)
          }
        }
      })
    }

    // Initialize on mount
    initializeOpenSubmenus()

    return {
      isCollapsed,
      menuItems,
      toggleSidebar,
      toggleSubmenu,
      isSubmenuOpen,
      isActive,
      isSubmenuItemActive
    }
  }
}
</script>

<style scoped>
.gradient-btn {
  background: linear-gradient(135deg, #047857 0%, #10b981 100%);
}

/* Custom scrollbar */
nav::-webkit-scrollbar {
  width: 4px;
}

nav::-webkit-scrollbar-track {
  background: transparent;
}

nav::-webkit-scrollbar-thumb {
  background: rgba(156, 163, 175, 0.3);
  border-radius: 2px;
}

nav::-webkit-scrollbar-thumb:hover {
  background: rgba(156, 163, 175, 0.5);
}

.dark nav::-webkit-scrollbar-thumb {
  background: rgba(255, 255, 255, 0.1);
}

.dark nav::-webkit-scrollbar-thumb:hover {
  background: rgba(255, 255, 255, 0.2);
}
</style>
