<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-900 via-gray-900 to-black">
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
        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl shadow-2xl overflow-hidden">
          <div class="px-8 py-12 text-center">
            <!-- Welcome Icon -->
            <div class="w-24 h-24 gradient-btn rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
              <i class="fas fa-crown text-white text-3xl"></i>
            </div>

            <!-- Welcome Message -->
            <h1 class="text-4xl font-bold text-white mb-4">
              Welcome back, {{ admin.name }}!
            </h1>
            <p class="text-xl text-gray-300 mb-8">
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
              <h3 class="text-2xl font-bold text-white mb-6">Quick Actions</h3>
              <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <button class="p-6 bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl hover:bg-white/10 transition-all duration-200 group">
                  <i class="fas fa-users text-2xl text-gray-300 group-hover:text-primary-400 mb-3 transition-colors"></i>
                  <p class="text-sm font-medium text-white">Manage Users</p>
                </button>
                <button class="p-6 bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl hover:bg-white/10 transition-all duration-200 group">
                  <i class="fas fa-book text-2xl text-gray-300 group-hover:text-primary-400 mb-3 transition-colors"></i>
                  <p class="text-sm font-medium text-white">Course Management</p>
                </button>
                <button class="p-6 bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl hover:bg-white/10 transition-all duration-200 group">
                  <i class="fas fa-chart-bar text-2xl text-gray-300 group-hover:text-primary-400 mb-3 transition-colors"></i>
                  <p class="text-sm font-medium text-white">Analytics</p>
                </button>
                <button class="p-6 bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl hover:bg-white/10 transition-all duration-200 group">
                  <i class="fas fa-cog text-2xl text-gray-300 group-hover:text-primary-400 mb-3 transition-colors"></i>
                  <p class="text-sm font-medium text-white">Settings</p>
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
import { ref } from 'vue'
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

    const handleSidebarToggle = (collapsed) => {
      sidebarCollapsed.value = collapsed
    }

    const getCurrentTime = () => {
      return new Date().toLocaleTimeString('en-US', {
        hour: '2-digit',
        minute: '2-digit'
      })
    }

    return {
      sidebarCollapsed,
      handleSidebarToggle,
      getCurrentTime
    }
  }
}
</script>