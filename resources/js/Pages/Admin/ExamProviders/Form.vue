<template>
  <div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-200">
    <Head>
      <title>{{ isEditing ? 'Edit Provider' : 'Create Provider' }} - DevOps Jungle Admin</title>
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
      :isDark="isDark"
      @toggle-theme="toggleTheme"
    />

    <!-- Main Content -->
    <main
      :class="[
        'pt-16 transition-all duration-300 min-h-screen',
        sidebarCollapsed ? 'ml-20' : 'ml-64'
      ]"
    >
      <div class="p-6">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
          <div>
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">
              {{ isEditing ? 'Edit Exam Provider' : 'Create New Provider' }}
            </h1>
            <p class="text-gray-600 dark:text-gray-400">
              {{ isEditing ? 'Update provider information' : 'Add a new certification provider' }}
            </p>
          </div>
          <Link
            :href="route('admin.exam-providers.index')"
            class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors"
          >
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Providers
          </Link>
        </div>

        <form @submit.prevent="submit" class="max-w-4xl">
          <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content Column -->
            <div class="lg:col-span-2 space-y-6">
              <!-- Basic Information -->
              <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Basic Information</h3>

                <!-- Name -->
                <div class="mb-4">
                  <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Provider Name <span class="text-red-500">*</span>
                  </label>
                  <input
                    id="name"
                    v-model="form.name"
                    type="text"
                    required
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    placeholder="e.g., Amazon AWS"
                    @input="generateSlug"
                  />
                  <p v-if="form.errors?.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</p>
                </div>

                <!-- Slug -->
                <div class="mb-4">
                  <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    URL Slug <span class="text-red-500">*</span>
                  </label>
                  <input
                    id="slug"
                    v-model="form.slug"
                    type="text"
                    required
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all font-mono"
                    placeholder="e.g., aws"
                  />
                  <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Used in URLs (lowercase, no spaces)</p>
                  <p v-if="form.errors?.slug" class="text-red-500 text-sm mt-1">{{ form.errors.slug }}</p>
                </div>

                <!-- Description -->
                <div class="mb-4">
                  <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Description
                  </label>
                  <textarea
                    id="description"
                    v-model="form.description"
                    rows="3"
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    placeholder="Brief description about this certification provider"
                  ></textarea>
                </div>

                <!-- Icon -->
                <div class="mb-4">
                  <label for="icon" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Icon Class
                  </label>
                  <input
                    id="icon"
                    v-model="form.icon"
                    type="text"
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all font-mono"
                    placeholder="e.g., fab fa-aws"
                  />
                  <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                    Font Awesome icon class (e.g., fab fa-aws, fab fa-microsoft, fab fa-google)
                  </p>

                  <!-- Icon Preview -->
                  <div v-if="form.icon" class="mt-3 flex items-center space-x-3">
                    <span class="text-gray-600 dark:text-gray-400 text-sm">Preview:</span>
                    <div
                      class="w-12 h-12 rounded-lg flex items-center justify-center"
                      :style="form.gradient_color || 'background: linear-gradient(135deg, #047857 0%, #10b981 100%)'"
                    >
                      <i :class="form.icon" class="text-white text-2xl"></i>
                    </div>
                  </div>
                </div>

                <!-- Gradient Color -->
                <div class="mb-4">
                  <label for="gradient_color" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Gradient Background
                  </label>
                  <input
                    id="gradient_color"
                    v-model="form.gradient_color"
                    type="text"
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all font-mono text-sm"
                    placeholder="background: linear-gradient(135deg, #FF9900 0%, #FF6600 100%)"
                  />
                  <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">CSS gradient for provider card background</p>

                  <!-- Quick Gradient Buttons -->
                  <div class="mt-3 space-y-2">
                    <p class="text-xs text-gray-600 dark:text-gray-400">Quick select:</p>
                    <div class="flex flex-wrap gap-2">
                      <button
                        type="button"
                        @click="form.gradient_color = 'background: linear-gradient(135deg, #FF9900 0%, #FF6600 100%)'"
                        class="w-12 h-12 rounded-lg"
                        style="background: linear-gradient(135deg, #FF9900 0%, #FF6600 100%)"
                        title="AWS Orange"
                      ></button>
                      <button
                        type="button"
                        @click="form.gradient_color = 'background: linear-gradient(135deg, #0078D4 0%, #005A9E 100%)'"
                        class="w-12 h-12 rounded-lg"
                        style="background: linear-gradient(135deg, #0078D4 0%, #005A9E 100%)"
                        title="Azure Blue"
                      ></button>
                      <button
                        type="button"
                        @click="form.gradient_color = 'background: linear-gradient(135deg, #4285F4 0%, #34A853 50%, #FBBC04 100%)'"
                        class="w-12 h-12 rounded-lg"
                        style="background: linear-gradient(135deg, #4285F4 0%, #34A853 50%, #FBBC04 100%)"
                        title="Google Colors"
                      ></button>
                      <button
                        type="button"
                        @click="form.gradient_color = 'background: linear-gradient(135deg, #326CE5 0%, #1A73E8 100%)'"
                        class="w-12 h-12 rounded-lg"
                        style="background: linear-gradient(135deg, #326CE5 0%, #1A73E8 100%)"
                        title="Kubernetes Blue"
                      ></button>
                      <button
                        type="button"
                        @click="form.gradient_color = 'background: linear-gradient(135deg, #2496ED 0%, #0DB7ED 100%)'"
                        class="w-12 h-12 rounded-lg"
                        style="background: linear-gradient(135deg, #2496ED 0%, #0DB7ED 100%)"
                        title="Docker Blue"
                      ></button>
                      <button
                        type="button"
                        @click="form.gradient_color = 'background: linear-gradient(135deg, #047857 0%, #10b981 100%)'"
                        class="w-12 h-12 rounded-lg"
                        style="background: linear-gradient(135deg, #047857 0%, #10b981 100%)"
                        title="Emerald Green"
                      ></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Sidebar Column -->
            <div class="lg:col-span-1 space-y-6">
              <!-- Settings -->
              <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Settings</h3>

                <!-- Active Status -->
                <div class="mb-4">
                  <label class="flex items-center">
                    <input
                      v-model="form.is_active"
                      type="checkbox"
                      class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500 mr-2"
                    />
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                      Active Provider
                    </span>
                  </label>
                  <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Show this provider on frontend</p>
                </div>

                <!-- Sort Order -->
                <div class="mb-4">
                  <label for="sort_order" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Sort Order
                  </label>
                  <input
                    id="sort_order"
                    v-model.number="form.sort_order"
                    type="number"
                    min="0"
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    placeholder="0"
                  />
                  <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Lower numbers appear first</p>
                </div>
              </div>

              <!-- Submit Buttons -->
              <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm">
                <div class="space-y-3">
                  <button
                    type="submit"
                    :disabled="form.processing"
                    class="w-full px-6 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-lg font-semibold hover:from-emerald-600 hover:to-emerald-700 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                  >
                    <span v-if="!form.processing">
                      <i class="fas fa-save mr-2"></i>
                      {{ isEditing ? 'Update Provider' : 'Create Provider' }}
                    </span>
                    <span v-else>
                      <i class="fas fa-spinner fa-spin mr-2"></i>
                      {{ isEditing ? 'Updating...' : 'Creating...' }}
                    </span>
                  </button>

                  <Link
                    :href="route('admin.exam-providers.index')"
                    class="block w-full px-6 py-3 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors text-center"
                  >
                    Cancel
                  </Link>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </main>
  </div>
</template>

<script>
import { Head, Link, router } from '@inertiajs/vue3'
import { ref, reactive, onMounted } from 'vue'
import Sidebar from '../Common/Sidebar.vue'
import Topbar from '../Common/Topbar.vue'

export default {
  name: 'ExamProviderForm',
  components: {
    Head,
    Link,
    Sidebar,
    Topbar
  },
  props: {
    provider: {
      type: Object,
      default: null
    },
    isEditing: {
      type: Boolean,
      default: false
    }
  },
  setup(props) {
    const sidebarCollapsed = ref(false)
    const isDark = ref(false)

    // Form state
    const form = reactive({
      name: props.provider?.name || '',
      slug: props.provider?.slug || '',
      icon: props.provider?.icon || '',
      description: props.provider?.description || '',
      gradient_color: props.provider?.gradient_color || '',
      is_active: props.provider?.is_active !== undefined ? props.provider.is_active : true,
      sort_order: props.provider?.sort_order || 0,
      processing: false,
      errors: {}
    })

    // Methods
    const handleSidebarToggle = () => {
      sidebarCollapsed.value = !sidebarCollapsed.value
    }

    const toggleTheme = () => {
      isDark.value = !isDark.value
      if (isDark.value) {
        document.documentElement.classList.add('dark')
        localStorage.setItem('theme', 'dark')
      } else {
        document.documentElement.classList.remove('dark')
        localStorage.setItem('theme', 'light')
      }
    }

    const generateSlug = () => {
      if (form.name && !props.isEditing) {
        form.slug = form.name.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '')
      }
    }

    const submit = () => {
      form.processing = true
      form.errors = {}

      const url = props.isEditing
        ? route('admin.exam-providers.update', props.provider.id)
        : route('admin.exam-providers.store')

      router.post(url, {
        name: form.name,
        slug: form.slug,
        icon: form.icon,
        description: form.description,
        gradient_color: form.gradient_color,
        is_active: form.is_active,
        sort_order: form.sort_order
      }, {
        onSuccess: () => {
          form.processing = false
        },
        onError: (errors) => {
          form.errors = errors
          form.processing = false
        }
      })
    }

    // Initialize dark mode
    onMounted(() => {
      const theme = localStorage.getItem('theme')
      if (theme === 'dark') {
        isDark.value = true
        document.documentElement.classList.add('dark')
      }
    })

    return {
      sidebarCollapsed,
      isDark,
      form,
      handleSidebarToggle,
      toggleTheme,
      generateSlug,
      submit,
      route
    }
  }
}
</script>
