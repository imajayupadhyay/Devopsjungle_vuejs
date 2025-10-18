<template>
  <!-- Compact Top Bar -->
  <div id="topbar" class="bg-gray-50 dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 text-xs">
    <div class="max-w-7xl mx-auto px-4">
      <div class="flex justify-between items-center py-2">
        <div class="flex items-center space-x-4 text-gray-600 dark:text-gray-300">
          <span class="flex items-center">
            <i class="fas fa-envelope mr-1 text-xs"></i>
            support@devopsjungle.com
          </span>
          <span class="flex items-center">
            <i class="fas fa-phone mr-1 text-xs"></i>
            +1 (555) 123-4567
          </span>
        </div>
        <div class="flex items-center space-x-3">
          <span class="text-primary-600 dark:text-primary-400 font-medium">
            <i class="fas fa-star mr-1"></i>
            30% Off All Courses - Limited Time!
          </span>
          <button @click="closeTopbar" class="text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300 ml-2">
            <i class="fas fa-times text-xs"></i>
          </button>
        </div>
      </div>
    </div>
  </div>

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

          <!-- Auth Buttons -->
          <div class="hidden md:flex items-center space-x-2">
            <a href="#" class="text-sm text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 font-medium">Login</a>
            <a href="#" class="gradient-btn text-white px-3 py-1.5 rounded text-sm font-medium hover:opacity-90 transition-opacity">Sign Up</a>
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
          <a href="/support" :class="getMobileNavLinkClass('/support')">Support</a>
        </nav>

        <!-- Mobile Auth -->
        <div class="mt-6 pt-4 border-t border-gray-100 dark:border-gray-700 space-y-2">
          <a href="#" class="block w-full text-center border border-primary-600 text-primary-600 dark:border-primary-400 dark:text-primary-400 py-2 rounded text-sm font-medium hover:bg-primary-50 dark:hover:bg-primary-900">Login</a>
          <a href="#" class="block w-full text-center gradient-btn text-white py-2 rounded text-sm font-medium hover:opacity-90">Sign Up</a>
        </div>
      </div>
    </div>

    <!-- Search Modal -->
    <div v-show="showSearchModal" class="fixed inset-0 bg-black bg-opacity-50 z-50">
      <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-lg">
          <div class="p-4">
            <div class="flex justify-between items-center mb-3">
              <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Search</h3>
              <button @click="closeSearchModal" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">
                <i class="fas fa-times"></i>
              </button>
            </div>
            <div class="relative">
              <input ref="searchInput" type="text" placeholder="Search courses, certifications, tools..." class="w-full pl-10 pr-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded focus:outline-none focus:border-primary-500 dark:focus:border-primary-400">
              <i class="fas fa-search absolute left-3 top-4 text-gray-400 dark:text-gray-500"></i>
            </div>
            <div class="mt-3 text-sm text-gray-600 dark:text-gray-300">
              Popular: <span class="text-primary-600 dark:text-primary-400">AWS</span>, <span class="text-primary-600 dark:text-primary-400">Docker</span>, <span class="text-primary-600 dark:text-primary-400">Kubernetes</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Mobile Overlay -->
  <div v-show="showMobileMenu" @click="closeMobileMenu" class="fixed inset-0 bg-black bg-opacity-30 z-40 lg:hidden"></div>
</template>

<script>
export default {
  name: 'DevOpsHeader',
  data() {
    return {
      isDark: false,
      showMobileMenu: false,
      showSearchModal: false
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
    closeTopbar() {
      const topbar = document.getElementById('topbar');
      if (topbar) {
        topbar.style.display = 'none';
      }
    },
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
      this.$nextTick(() => {
        if (this.$refs.searchInput) {
          this.$refs.searchInput.focus();
        }
      });
    },
    closeSearchModal() {
      this.showSearchModal = false;
    },
    handleKeydown(event) {
      if (event.key === 'Escape') {
        this.closeMobileMenu();
        this.closeSearchModal();
      }
    },
    isActiveRoute(path) {
      if (path === '/') {
        return this.currentPath === '/' || this.currentPath === ''
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