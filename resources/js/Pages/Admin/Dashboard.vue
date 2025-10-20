<template>
  <div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-200">
    <Head>
      <title>Admin Dashboard - DevOps Jungle</title>
      <meta name="description" content="DevOps Jungle Admin Dashboard">
    </Head>

    <!-- Sidebar -->
    <Sidebar
      :userName="admin.name"
      :userAvatar="admin.avatar_url || 'https://ui-avatars.com/api/?name=' + encodeURIComponent(admin.name) + '&background=047857&color=fff'"
      @toggle="handleSidebarToggle"
    />

    <!-- Topbar -->
    <Topbar
      :sidebarCollapsed="sidebarCollapsed"
      :userName="admin.name"
      :userEmail="admin.email"
      :userAvatar="admin.avatar_url || 'https://ui-avatars.com/api/?name=' + encodeURIComponent(admin.name) + '&background=047857&color=fff'"
      :isDark="isDark"
      @toggle-theme="toggleTheme"
    />

    <!-- Main Content -->
    <main
      :class="[
        'pt-16 transition-all duration-300',
        sidebarCollapsed ? 'ml-20' : 'ml-64'
      ]"
    >
      <div class="p-6">
        <!-- Welcome Section -->
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-lg overflow-hidden">
          <div class="px-8 py-12 text-center">
            <!-- Welcome Icon -->
            <div class="w-24 h-24 gradient-btn rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
              <i class="fas fa-crown text-white text-3xl"></i>
            </div>

            <!-- Welcome Message -->
            <h1 class="text-4xl font-bold text-gray-800 dark:text-white mb-4">
              Welcome back, {{ admin.name }}!
            </h1>
            <p class="text-xl text-gray-600 dark:text-gray-300 mb-8">
              You have successfully logged into the DevOps Jungle Admin Panel
            </p>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
              <!-- Admin Status -->
              <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-6 text-white shadow-xl">
                <div class="flex items-center justify-between">
                  <div class="text-left">
                    <p class="text-green-100 text-sm font-medium">Status</p>
                    <p class="text-2xl font-bold">Active</p>
                  </div>
                  <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-check-circle text-2xl"></i>
                  </div>
                </div>
              </div>

              <!-- Access Level -->
              <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-6 text-white shadow-xl">
                <div class="flex items-center justify-between">
                  <div class="text-left">
                    <p class="text-blue-100 text-sm font-medium">Access Level</p>
                    <p class="text-2xl font-bold">Full Admin</p>
                  </div>
                  <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-key text-2xl"></i>
                  </div>
                </div>
              </div>

              <!-- Last Login -->
              <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl p-6 text-white shadow-xl">
                <div class="flex items-center justify-between">
                  <div class="text-left">
                    <p class="text-purple-100 text-sm font-medium">Session</p>
                    <p class="text-2xl font-bold">{{ getCurrentTime() }}</p>
                  </div>
                  <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-clock text-2xl"></i>
                  </div>
                </div>
              </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-12">
              <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Quick Actions</h3>
              <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <button class="p-6 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-600 transition-all duration-200 group">
                  <i class="fas fa-users text-2xl text-gray-600 dark:text-gray-300 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 mb-3 transition-colors"></i>
                  <p class="text-sm font-medium text-gray-800 dark:text-white">Manage Users</p>
                </button>
                <button class="p-6 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-600 transition-all duration-200 group">
                  <i class="fas fa-book text-2xl text-gray-600 dark:text-gray-300 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 mb-3 transition-colors"></i>
                  <p class="text-sm font-medium text-gray-800 dark:text-white">Course Management</p>
                </button>
                <button class="p-6 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-600 transition-all duration-200 group">
                  <i class="fas fa-chart-bar text-2xl text-gray-600 dark:text-gray-300 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 mb-3 transition-colors"></i>
                  <p class="text-sm font-medium text-gray-800 dark:text-white">Analytics</p>
                </button>
                <button class="p-6 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-600 transition-all duration-200 group">
                  <i class="fas fa-cog text-2xl text-gray-600 dark:text-gray-300 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 mb-3 transition-colors"></i>
                  <p class="text-sm font-medium text-gray-800 dark:text-white">Settings</p>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script>
import { Head } from '@inertiajs/vue3'
import { ref, onMounted } from 'vue'
import Sidebar from './Common/Sidebar.vue'
import Topbar from './Common/Topbar.vue'

export default {
  name: 'AdminDashboard',
  components: {
    Head,
    Sidebar,
    Topbar
  },
  props: {
    admin: {
      type: Object,
      required: true
    }
  },
  setup() {
    const sidebarCollapsed = ref(false)
    const isDark = ref(false)

    const handleSidebarToggle = (collapsed) => {
      sidebarCollapsed.value = collapsed
    }

    const toggleTheme = () => {
      isDark.value = !isDark.value
      applyTheme()
      localStorage.setItem('admin-theme', isDark.value ? 'dark' : 'light')
    }

    const applyTheme = () => {
      if (isDark.value) {
        document.documentElement.classList.add('dark')
      } else {
        document.documentElement.classList.remove('dark')
      }
    }

    const getCurrentTime = () => {
      return new Date().toLocaleTimeString('en-US', {
        hour: '2-digit',
        minute: '2-digit'
      })
    }

    onMounted(() => {
      // Load theme from localStorage
      const savedTheme = localStorage.getItem('admin-theme')
      if (savedTheme === 'dark') {
        isDark.value = true
        applyTheme()
      }
    })

    return {
      sidebarCollapsed,
      isDark,
      handleSidebarToggle,
      toggleTheme,
      getCurrentTime
    }
  }
}
</script>

<style scoped>
.gradient-btn {
  background: linear-gradient(135deg, #047857 0%, #10b981 100%);
}
</style>
