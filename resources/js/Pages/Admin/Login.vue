<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-900 via-gray-900 to-black flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <Head>
      <title>Admin Login - DevOps Jungle</title>
      <meta name="description" content="Secure admin login for DevOps Jungle">
    </Head>

    <div class="max-w-md w-full space-y-8">
      <!-- Header -->
      <div class="text-center">
        <div class="w-16 h-16 gradient-btn rounded-full flex items-center justify-center mx-auto mb-4">
          <i class="fas fa-shield-alt text-white text-2xl"></i>
        </div>
        <h2 class="text-3xl font-bold text-white mb-2">Admin Login</h2>
        <p class="text-gray-400">Secure access to DevOps Jungle admin panel</p>
      </div>

      <!-- Login Form -->
      <div class="bg-white/5 backdrop-blur-xl rounded-2xl shadow-2xl p-8 border border-white/30 ring-1 ring-white/20">
        <form @submit.prevent="submit" class="space-y-6">
          <!-- Email Field -->
          <div>
            <label for="email" class="block text-sm font-medium text-white mb-2">
              Email Address
            </label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-envelope text-gray-300"></i>
              </div>
              <input
                id="email"
                v-model="form.email"
                type="email"
                required
                class="w-full pl-10 pr-4 py-3 bg-white/10 border border-white/40 rounded-lg text-white placeholder-gray-200 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent transition-all backdrop-blur-sm"
                placeholder="Enter your email"
              />
            </div>
            <div v-if="form.errors.email" class="text-red-400 text-sm mt-1">
              {{ form.errors.email }}
            </div>
          </div>

          <!-- Password Field -->
          <div>
            <label for="password" class="block text-sm font-medium text-white mb-2">
              Password
            </label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-lock text-gray-300"></i>
              </div>
              <input
                id="password"
                v-model="form.password"
                type="password"
                required
                class="w-full pl-10 pr-4 py-3 bg-white/10 border border-white/40 rounded-lg text-white placeholder-gray-200 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent transition-all backdrop-blur-sm"
                placeholder="Enter your password"
              />
            </div>
            <div v-if="form.errors.password" class="text-red-400 text-sm mt-1">
              {{ form.errors.password }}
            </div>
          </div>

          <!-- Submit Button -->
          <button
            type="submit"
            :disabled="form.processing"
            class="w-full gradient-btn text-white py-3 px-4 rounded-lg font-semibold text-lg hover:opacity-90 transform hover:scale-[1.02] transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
          >
            <i v-if="form.processing" class="fas fa-spinner fa-spin mr-2"></i>
            <i v-else class="fas fa-sign-in-alt mr-2"></i>
            {{ form.processing ? 'Signing In...' : 'Sign In' }}
          </button>
        </form>

        <!-- Security Notice -->
        <div class="mt-6 text-center">
          <div class="flex items-center justify-center text-gray-400 text-sm">
            <i class="fas fa-shield-alt mr-2"></i>
            <span>Secure admin access only</span>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <div class="text-center">
        <p class="text-gray-400 text-sm">
          © {{ new Date().getFullYear() }} DevOps Jungle. All rights reserved.
        </p>
      </div>
    </div>
  </div>
</template>

<script>
import { Head } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/vue3'

export default {
  name: 'AdminLogin',
  components: {
    Head
  },
  setup() {
    const form = useForm({
      email: '',
      password: '',
    })

    const submit = () => {
      form.post('/admin/devops-secure-login', {
        onFinish: () => {
          form.reset('password')
        },
      })
    }

    return {
      form,
      submit
    }
  }
}
</script>