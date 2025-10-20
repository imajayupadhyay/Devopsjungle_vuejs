<template>
  <!-- Signup Modal -->
  <SignupModal
    :isVisible="showSignupModal"
    @close="closeSignupModal"
    @switch-to-login="switchToLogin"
    @signup-success="handleSignupSuccess"
    @login-success="handleLoginSuccess"
  />

  <!-- Login Modal -->
  <LoginModal
    :isVisible="showLoginModal"
    @close="closeLoginModal"
    @switch-to-signup="switchToSignup"
    @login-success="handleLoginSuccess"
  />

  <!-- Notification Modal -->
  <NotificationModal
    :isVisible="showNotification"
    :type="notification.type"
    :title="notification.title"
    :message="notification.message"
    :confirmText="notification.confirmText"
    :autoClose="notification.autoClose"
    @close="closeNotification"
  />

  <!-- Search Modal -->
  <SearchModal
    :isVisible="showSearchModal"
    @close="closeSearchModal"
  />

  <!-- Main Header -->
  <header class="bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-700 sticky top-0 z-50 shadow-sm dark:shadow-gray-800">
    <div class="max-w-7xl mx-auto px-4">
      <div class="flex justify-between items-center h-16">
        <!-- Logo -->
        <a href="/" class="flex items-center space-x-2 hover:opacity-80 transition-opacity">
          <div class="w-8 h-8 gradient-btn rounded flex items-center justify-center">
            <i class="fas fa-code-branch text-white text-sm"></i>
          </div>
          <div>
            <h1 class="text-lg font-bold text-gray-800 dark:text-white">DevOps Jungle</h1>
            <p class="text-xs text-gray-500 dark:text-gray-400 -mt-1">Master DevOps Skills</p>
          </div>
        </a>

        <!-- Desktop Navigation -->
        <nav class="hidden lg:flex items-center space-x-6">
          <!-- Exam Dumps -->
          <a href="/dumps" :class="getNavLinkClass('/dumps')">Exam Dumps</a>

          <!-- Practice Labs -->
          <div class="relative group">
            <a href="/practice-labs" class="flex items-center space-x-1 text-sm text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors py-2">
              <span>Practice Labs</span>
              <i class="fas fa-chevron-down text-xs"></i>
            </a>
            <div class="mega-menu absolute top-full left-0 w-80 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-100 dark:border-gray-700 p-4 mt-1 group-hover:show">
              <div class="grid grid-cols-2 gap-4">
                <div>
                  <h4 class="font-semibold text-sm text-gray-800 dark:text-white mb-2 flex items-center">
                    <i class="fab fa-aws text-orange-400 mr-2 text-sm"></i>
                    AWS
                  </h4>
                  <ul class="space-y-1">
                    <li><a href="/practice-labs/aws-saa-c03" class="text-sm text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 block py-1">SAA-C03 Labs</a></li>
                    <li><a href="/practice-labs/aws-soa-c02" class="text-sm text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 block py-1">SOA-C02 Labs</a></li>
                    <li><a href="/practice-labs" class="text-sm text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 block py-1">All AWS Labs</a></li>
                  </ul>
                </div>
                <div>
                  <h4 class="font-semibold text-sm text-gray-800 dark:text-white mb-2 flex items-center">
                    <i class="fab fa-microsoft text-blue-500 mr-2 text-sm"></i>
                    Azure & More
                  </h4>
                  <ul class="space-y-1">
                    <li><a href="/practice-labs/az-900" class="text-sm text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 block py-1">AZ-900 Labs</a></li>
                    <li><a href="/practice-labs/cka" class="text-sm text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 block py-1">Kubernetes CKA</a></li>
                    <li><a href="/practice-labs" class="text-sm text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 block py-1">Browse All Labs</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <!-- Services -->
          <div class="relative group">
            <a href="/services" class="flex items-center space-x-1 text-sm text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors py-2">
              <span>Services</span>
              <i class="fas fa-chevron-down text-xs"></i>
            </a>
            <div class="mega-menu absolute top-full left-0 w-80 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-100 dark:border-gray-700 p-4 mt-1 group-hover:show">
              <div class="grid grid-cols-2 gap-4">
                <div>
                  <h4 class="font-semibold text-sm text-gray-800 dark:text-white mb-2 flex items-center">
                    <i class="fas fa-graduation-cap text-blue-500 mr-2 text-sm"></i>
                    Training
                  </h4>
                  <ul class="space-y-1">
                    <li><a href="/services/corporate-devops-training" class="text-sm text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 block py-1">Corporate Training</a></li>
                    <li><a href="/services/one-on-one-devops-mentoring" class="text-sm text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 block py-1">1-on-1 Mentoring</a></li>
                    <li><a href="/services" class="text-sm text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 block py-1">All Training Services</a></li>
                  </ul>
                </div>
                <div>
                  <h4 class="font-semibold text-sm text-gray-800 dark:text-white mb-2 flex items-center">
                    <i class="fas fa-briefcase text-purple-500 mr-2 text-sm"></i>
                    Career Support
                  </h4>
                  <ul class="space-y-1">
                    <li><a href="/services/job-placement-assistance" class="text-sm text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 block py-1">Job Placement</a></li>
                    <li><a href="/services" class="text-sm text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 block py-1">Career Consulting</a></li>
                    <li><a href="/services" class="text-sm text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 block py-1">All Career Services</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>


          <!-- Simple Links -->
          <a href="/courses" :class="getNavLinkClass('/courses')">Courses</a>
          <a href="/blogs" :class="getNavLinkClass('/blogs')">Blogs</a>
          <a href="/support" :class="getNavLinkClass('/support')">Support</a>
        </nav>

        <!-- Header Actions -->
        <div class="flex items-center space-x-3">
          <!-- Search -->
          <button @click="openSearchModal" class="text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
            <i class="fas fa-search text-sm"></i>
          </button>

          <!-- Theme Toggle -->
          <button @click="toggleTheme" class="text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
            <i :class="isDark ? 'fas fa-sun' : 'fas fa-moon'" class="text-sm"></i>
          </button>

          <!-- Auth Buttons / Profile -->
          <div class="hidden md:flex items-center space-x-2">
            <!-- Not Authenticated -->
            <template v-if="!$page.props.auth?.user">
              <button @click="openLoginModal" class="text-sm text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 font-medium">Login</button>
              <button @click="openSignupModal" class="gradient-btn text-white px-3 py-1.5 rounded text-sm font-medium hover:opacity-90 transition-opacity">Sign Up</button>
            </template>

            <!-- Authenticated -->
            <div v-else class="relative">
              <button @click="toggleProfileDropdown" class="flex items-center space-x-2 focus:outline-none">
                <img
                  :src="$page.props.auth.user.avatar_url"
                  :alt="$page.props.auth.user.name"
                  class="w-8 h-8 rounded-full border-2 border-primary-500 hover:border-primary-600 transition-colors"
                >
                <i class="fas fa-chevron-down text-xs text-gray-400"></i>
              </button>

              <!-- Profile Dropdown -->
              <div
                v-show="showProfileDropdown"
                class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-100 dark:border-gray-700 py-2 z-50"
              >
                <div class="px-4 py-2 border-b border-gray-100 dark:border-gray-700">
                  <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $page.props.auth.user.name }}</p>
                  <p class="text-xs text-gray-500 dark:text-gray-400">{{ $page.props.auth.user.email }}</p>
                </div>
                <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                  <i class="fas fa-user mr-2"></i>Profile
                </a>
                <button @click="handleLogout" class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                  <i class="fas fa-sign-out-alt mr-2"></i>Logout
                </button>
              </div>
            </div>
          </div>

          <!-- Mobile Menu -->
          <button @click="openMobileMenu" class="lg:hidden text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400">
            <i class="fas fa-bars text-lg"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile Menu -->
    <div ref="mobileMenu" class="mobile-menu fixed top-0 right-0 w-72 h-full bg-white dark:bg-gray-900 shadow-xl z-50 overflow-y-auto border-l border-gray-100 dark:border-gray-700">
      <div class="p-4">
        <!-- Mobile Header -->
        <div class="flex justify-between items-center mb-4 pb-4 border-b border-gray-100 dark:border-gray-700">
          <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Menu</h3>
          <button @click="closeMobileMenu" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">
            <i class="fas fa-times"></i>
          </button>
        </div>

        <!-- Mobile Search -->
        <div class="mb-4">
          <div class="relative">
            <input type="text" placeholder="Search..." class="w-full pl-8 pr-3 py-2 text-sm border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded focus:outline-none focus:border-primary-500">
            <i class="fas fa-search absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
          </div>
        </div>

        <!-- Mobile Navigation -->
        <nav class="space-y-1">
          <!-- Exam Dumps -->
          <a href="/dumps" :class="getMobileNavLinkClass('/dumps')">Exam Dumps</a>

          <!-- Practice Labs -->
          <div>
            <a href="/practice-labs" class="block text-sm font-medium text-gray-800 dark:text-white py-2 hover:text-primary-600 dark:hover:text-primary-400">Practice Labs</a>
            <button @click="toggleSubmenu($event)" class="mobile-nav-toggle flex justify-between items-center w-full text-left text-sm font-medium text-gray-600 dark:text-gray-300 py-1 hover:text-primary-600 dark:hover:text-primary-400 pl-4">
              <span>Browse Labs</span>
              <i class="fas fa-chevron-down text-xs"></i>
            </button>
            <div class="submenu pl-8 space-y-1">
              <a href="/practice-labs/aws-saa-c03" class="block text-sm text-gray-600 dark:text-gray-300 py-1 hover:text-primary-600 dark:hover:text-primary-400">AWS SAA-C03</a>
              <a href="/practice-labs/aws-soa-c02" class="block text-sm text-gray-600 dark:text-gray-300 py-1 hover:text-primary-600 dark:hover:text-primary-400">AWS SOA-C02</a>
              <a href="/practice-labs/az-900" class="block text-sm text-gray-600 dark:text-gray-300 py-1 hover:text-primary-600 dark:hover:text-primary-400">Azure AZ-900</a>
            </div>
          </div>

          <!-- Services -->
          <div>
            <a href="/services" class="block text-sm font-medium text-gray-800 dark:text-white py-2 hover:text-primary-600 dark:hover:text-primary-400">Services</a>
            <button @click="toggleSubmenu($event)" class="mobile-nav-toggle flex justify-between items-center w-full text-left text-sm font-medium text-gray-600 dark:text-gray-300 py-1 hover:text-primary-600 dark:hover:text-primary-400 pl-4">
              <span>Browse Services</span>
              <i class="fas fa-chevron-down text-xs"></i>
            </button>
            <div class="submenu pl-8 space-y-1">
              <a href="/services/corporate-devops-training" class="block text-sm text-gray-600 dark:text-gray-300 py-1 hover:text-primary-600 dark:hover:text-primary-400">Corporate Training</a>
              <a href="/services/one-on-one-devops-mentoring" class="block text-sm text-gray-600 dark:text-gray-300 py-1 hover:text-primary-600 dark:hover:text-primary-400">1-on-1 Mentoring</a>
              <a href="/services/job-placement-assistance" class="block text-sm text-gray-600 dark:text-gray-300 py-1 hover:text-primary-600 dark:hover:text-primary-400">Job Placement</a>
            </div>
          </div>


          <a href="/courses" :class="getMobileNavLinkClass('/courses')">Courses</a>
          <a href="/blogs" :class="getMobileNavLinkClass('/blogs')">Blogs</a>
          <a href="/support" :class="getMobileNavLinkClass('/support')">Support</a>
        </nav>

        <!-- Mobile Auth / Profile -->
        <div class="mt-6 pt-4 border-t border-gray-100 dark:border-gray-700">
          <!-- Not Authenticated -->
          <template v-if="!$page.props.auth?.user">
            <div class="space-y-2">
              <button @click="openLoginModal" class="block w-full text-center border border-primary-600 text-primary-600 dark:border-primary-400 dark:text-primary-400 py-2 rounded text-sm font-medium hover:bg-primary-50 dark:hover:bg-primary-900">Login</button>
              <button @click="openSignupModal" class="block w-full text-center gradient-btn text-white py-2 rounded text-sm font-medium hover:opacity-90">Sign Up</button>
            </div>
          </template>

          <!-- Authenticated -->
          <div v-else class="space-y-2">
            <div class="flex items-center space-x-3 p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
              <img
                :src="$page.props.auth.user.avatar_url"
                :alt="$page.props.auth.user.name"
                class="w-10 h-10 rounded-full border-2 border-primary-500"
              >
              <div class="flex-1">
                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $page.props.auth.user.name }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $page.props.auth.user.email }}</p>
              </div>
            </div>
            <a href="/profile" class="block w-full text-center border border-primary-600 text-primary-600 dark:border-primary-400 dark:text-primary-400 py-2 rounded text-sm font-medium hover:bg-primary-50 dark:hover:bg-primary-900">
              <i class="fas fa-user mr-2"></i>Profile
            </a>
            <button @click="handleLogout" class="block w-full text-center bg-red-600 text-white py-2 rounded text-sm font-medium hover:bg-red-700 transition-colors">
              <i class="fas fa-sign-out-alt mr-2"></i>Logout
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Search Modal -->
  </header>

  <!-- Mobile Overlay -->
  <div v-show="showMobileMenu" @click="closeMobileMenu" class="fixed inset-0 bg-black bg-opacity-30 z-40 lg:hidden"></div>

  <!-- Floating Support Icon -->
  <FloatingSupportIcon />
</template>

<script>
import SignupModal from './SignupModal.vue'
import LoginModal from './LoginModal.vue'
import NotificationModal from './NotificationModal.vue'
import SearchModal from './SearchModal.vue'
import FloatingSupportIcon from './FloatingSupportIcon.vue'
import { router } from '@inertiajs/vue3'

export default {
  name: 'DevOpsHeader',
  components: {
    SignupModal,
    LoginModal,
    NotificationModal,
    SearchModal,
    FloatingSupportIcon
  },
  data() {
    return {
      isDark: false,
      showMobileMenu: false,
      showSearchModal: false,
      showSignupModal: false,
      showLoginModal: false,
      showProfileDropdown: false,
      showNotification: false,
      notification: {
        type: 'success',
        title: '',
        message: '',
        confirmText: 'OK',
        autoClose: 3000
      }
    }
  },
  computed: {
    currentPath() {
      return this.$page.url
    }
  },
  mounted() {
    // Initialize theme from localStorage
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
      this.isDark = true;
      this.applyTheme();
    }

    // Add keyboard event listener for ESC key
    document.addEventListener('keydown', this.handleKeydown);
  },
  beforeUnmount() {
    document.removeEventListener('keydown', this.handleKeydown);
  },
  methods: {
    toggleTheme() {
      this.isDark = !this.isDark;
      this.applyTheme();
      localStorage.setItem('theme', this.isDark ? 'dark' : 'light');
    },
    applyTheme() {
      const body = document.body;
      if (this.isDark) {
        body.setAttribute('data-theme', 'dark');
        body.classList.add('dark', 'bg-gray-900', 'text-white');
        body.classList.remove('bg-white', 'text-gray-700');
      } else {
        body.setAttribute('data-theme', 'light');
        body.classList.remove('dark', 'bg-gray-900', 'text-white');
        body.classList.add('bg-white', 'text-gray-700');
      }
    },
    openMobileMenu() {
      this.showMobileMenu = true;
      this.$refs.mobileMenu.classList.add('show');
      document.body.style.overflow = 'hidden';
    },
    closeMobileMenu() {
      this.showMobileMenu = false;
      this.$refs.mobileMenu.classList.remove('show');
      document.body.style.overflow = '';
    },
    toggleSubmenu(event) {
      const submenu = event.target.nextElementSibling;
      const icon = event.target.querySelector('i');

      if (submenu && icon) {
        submenu.classList.toggle('show');
        icon.classList.toggle('fa-chevron-down');
        icon.classList.toggle('fa-chevron-up');
      }
    },
    openSearchModal() {
      this.showSearchModal = true;
    },
    closeSearchModal() {
      this.showSearchModal = false;
    },
    openSignupModal() {
      this.showSignupModal = true;
      this.closeMobileMenu();
    },
    closeSignupModal() {
      this.showSignupModal = false;
    },
    switchToLogin() {
      this.closeSignupModal();
      this.openLoginModal();
    },
    openLoginModal() {
      this.showLoginModal = true;
      this.closeMobileMenu();
    },
    closeLoginModal() {
      this.showLoginModal = false;
    },
    switchToSignup() {
      this.closeLoginModal();
      this.openSignupModal();
    },
    toggleProfileDropdown() {
      this.showProfileDropdown = !this.showProfileDropdown;
    },
    async handleLogout() {
      try {
        await router.post('/logout', {}, {
          onSuccess: () => {
            this.showProfileDropdown = false;
            this.closeMobileMenu();
            this.showNotificationModal('success', 'Logged Out Successfully', 'You have been logged out from your account. See you soon!');
          },
          onError: () => {
            this.showNotificationModal('error', 'Logout Failed', 'There was an error logging you out. Please try again.');
          }
        });
      } catch (error) {
        console.error('Logout error:', error);
        this.showNotificationModal('error', 'Logout Failed', 'There was an error logging you out. Please try again.');
      }
    },
    showNotificationModal(type, title, message, options = {}) {
      this.notification = {
        type,
        title,
        message,
        confirmText: options.confirmText || 'OK',
        autoClose: options.autoClose !== undefined ? options.autoClose : 3000
      };
      this.showNotification = true;
    },
    closeNotification() {
      this.showNotification = false;
    },
    handleLoginSuccess(data) {
      const userName = data.user?.name || 'there';
      this.showNotificationModal('success', 'Welcome Back!', `Hello ${userName}! You have been successfully logged in.`);
    },
    handleSignupSuccess(data) {
      const userName = data.userName || 'there';
      this.showNotificationModal('success', 'Account Created!', `Welcome to DevOps Jungle, ${userName}! Your account has been created successfully.`);
    },
    handleKeydown(event) {
      if (event.key === 'Escape') {
        this.closeMobileMenu();
        this.closeSearchModal();
        this.closeSignupModal();
        this.closeLoginModal();
        this.showProfileDropdown = false;
      }
    },
    isActiveRoute(path) {
      if (path === '/') {
        return this.currentPath === '/' || this.currentPath === ''
      }
      // For blog routes, also match detail pages
      if (path === '/blogs' && this.currentPath.startsWith('/blogs')) {
        return true
      }
      return this.currentPath === path
    },
    getNavLinkClass(path) {
      return this.isActiveRoute(path)
        ? 'text-sm text-primary-600 dark:text-primary-400 font-medium transition-colors border-b-2 border-primary-600 dark:border-primary-400 pb-1'
        : 'text-sm text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors'
    },
    getMobileNavLinkClass(path) {
      return this.isActiveRoute(path)
        ? 'block text-sm font-medium text-primary-600 dark:text-primary-400 py-2 bg-primary-50 dark:bg-primary-900 px-3 rounded'
        : 'block text-sm font-medium text-gray-800 dark:text-white py-2 hover:text-primary-600 dark:hover:text-primary-400'
    }
  }
}
</script>