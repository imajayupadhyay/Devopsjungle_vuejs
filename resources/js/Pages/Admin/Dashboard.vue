<template>
  <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    <Head>
      <title>Admin Dashboard - DevOps Jungle</title>
      <meta name="description" content="DevOps Jungle Admin Dashboard">
    </Head>

    <!-- Navigation Header -->
    <nav class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
          <!-- Logo and Title -->
          <div class="flex items-center space-x-4">
            <div class="w-10 h-10 gradient-btn rounded-lg flex items-center justify-center">
              <i class="fas fa-shield-alt text-white text-lg"></i>
            </div>
            <div>
              <h1 class="text-xl font-bold text-gray-900 dark:text-white">Admin Panel</h1>
              <p class="text-sm text-gray-500 dark:text-gray-400">DevOps Jungle</p>
            </div>
          </div>

          <!-- Admin Info and Logout -->
          <div class="flex items-center space-x-4">
            <div class="text-right hidden sm:block">
              <p class="text-sm font-medium text-gray-900 dark:text-white">{{ admin.name }}</p>
              <p class="text-xs text-gray-500 dark:text-gray-400">Administrator</p>
            </div>
            <img
              :src="admin.avatar_url || 'https://ui-avatars.com/api/?name=' + encodeURIComponent(admin.name) + '&background=047857&color=fff'"
              :alt="admin.name"
              class="w-10 h-10 rounded-full border-2 border-primary-500"
            >
            <button
              @click="logout"
              class="text-gray-500 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 transition-colors"
              title="Logout"
            >
              <i class="fas fa-sign-out-alt text-lg"></i>
            </button>
          </div>
        </div>
      </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
      <!-- Welcome Section -->
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-2xl">
        <div class="px-8 py-12 text-center">
          <!-- Welcome Icon -->
          <div class="w-24 h-24 gradient-btn rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-crown text-white text-3xl"></i>
          </div>

          <!-- Welcome Message -->
          <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">
            Welcome back, {{ admin.name }}!
          </h1>
          <p class="text-xl text-gray-600 dark:text-gray-300 mb-8">
            You have successfully logged into the DevOps Jungle Admin Panel
          </p>

          <!-- Stats Cards -->
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
            <!-- Admin Status -->
            <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-6 text-white">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-green-100 text-sm font-medium">Status</p>
                  <p class="text-2xl font-bold">Active</p>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                  <i class="fas fa-check-circle text-2xl"></i>
                </div>
              </div>
            </div>

            <!-- Access Level -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-6 text-white">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-blue-100 text-sm font-medium">Access Level</p>
                  <p class="text-2xl font-bold">Full Admin</p>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                  <i class="fas fa-key text-2xl"></i>
                </div>
              </div>
            </div>

            <!-- Last Login -->
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl p-6 text-white">
              <div class="flex items-center justify-between">
                <div>
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
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Quick Actions</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
              <button class="p-4 bg-gray-50 dark:bg-gray-700 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors group">
                <i class="fas fa-users text-2xl text-gray-600 dark:text-gray-300 group-hover:text-primary-600 mb-2"></i>
                <p class="text-sm font-medium text-gray-900 dark:text-white">Manage Users</p>
              </button>
              <button class="p-4 bg-gray-50 dark:bg-gray-700 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors group">
                <i class="fas fa-book text-2xl text-gray-600 dark:text-gray-300 group-hover:text-primary-600 mb-2"></i>
                <p class="text-sm font-medium text-gray-900 dark:text-white">Course Management</p>
              </button>
              <button class="p-4 bg-gray-50 dark:bg-gray-700 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors group">
                <i class="fas fa-chart-bar text-2xl text-gray-600 dark:text-gray-300 group-hover:text-primary-600 mb-2"></i>
                <p class="text-sm font-medium text-gray-900 dark:text-white">Analytics</p>
              </button>
              <button class="p-4 bg-gray-50 dark:bg-gray-700 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors group">
                <i class="fas fa-cog text-2xl text-gray-600 dark:text-gray-300 group-hover:text-primary-600 mb-2"></i>
                <p class="text-sm font-medium text-gray-900 dark:text-white">Settings</p>
              </button>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script>
import { Head } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3'

export default {
  name: 'AdminDashboard',
  components: {
    Head
  },
  props: {
    admin: {
      type: Object,
      required: true
    }
  },
  methods: {
    logout() {
      router.post('/admin/logout');
    },
    getCurrentTime() {
      return new Date().toLocaleTimeString('en-US', {
        hour: '2-digit',
        minute: '2-digit'
      });
    }
  }
}
</script>