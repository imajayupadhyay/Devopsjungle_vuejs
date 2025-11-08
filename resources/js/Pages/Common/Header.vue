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
          <div class="relative" @mouseenter="openMegaMenu('exam')" @mouseleave="closeMegaMenu('exam')">
            <a href="/dumps" class="flex items-center space-x-1 text-sm text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors py-2">
              <span>Exam Dumps</span>
              <i class="fas fa-chevron-down text-xs transform transition-transform duration-300" :class="{ 'rotate-180': activeMegaMenu === 'exam' }"></i>
            </a>
          </div>

          <!-- Services -->
          <div class="relative" @mouseenter="openMegaMenu('services')" @mouseleave="closeMegaMenu('services')">
            <a href="/services" class="flex items-center space-x-1 text-sm text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors py-2">
              <span>Services</span>
              <i class="fas fa-chevron-down text-xs transform transition-transform duration-300" :class="{ 'rotate-180': activeMegaMenu === 'services' }"></i>
            </a>
          </div>

          <!-- Courses -->
          <div class="relative" @mouseenter="openMegaMenu('courses')" @mouseleave="closeMegaMenu('courses')">
            <a href="/courses" class="flex items-center space-x-1 text-sm text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors py-2">
              <span>Courses</span>
              <i class="fas fa-chevron-down text-xs transform transition-transform duration-300" :class="{ 'rotate-180': activeMegaMenu === 'courses' }"></i>
            </a>
          </div>

          <!-- Simple Links -->
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
  </header>

  <!-- Full Width Mega Menus Container -->
  <div class="mega-menu-wrapper" @mouseenter="keepMegaMenuOpen" @mouseleave="closeMegaMenu()">
    <!-- Exam Dumps Mega Menu -->
    <transition name="mega-menu-fade">
      <div v-if="activeMegaMenu === 'exam'" class="mega-menu-container">
        <div class="mega-menu-content bg-white dark:bg-gray-800 shadow-2xl border-b border-gray-100 dark:border-gray-700">
          <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4 max-h-[500px] overflow-y-auto">
              <!-- Dynamic Provider Cards -->
              <template v-if="$page.props.examProviders && $page.props.examProviders.length > 0">
                <a
                  v-for="provider in $page.props.examProviders"
                  :key="provider.id"
                  :href="`/dumps?provider=${provider.slug}`"
                  class="group/item relative rounded-xl p-4 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border overflow-hidden"
                  :class="getProviderCardClass(provider.slug)"
                >
                  <div class="absolute top-0 right-0 w-20 h-20 rounded-bl-full opacity-20"
                       :class="getProviderBgAccent(provider.slug)"></div>
                  <div class="relative">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-3 group-hover/item:scale-110 transition-transform duration-300 shadow-lg"
                         :class="getProviderIconBg(provider.slug)">
                      <i :class="provider.icon || 'fas fa-certificate'" class="text-white" style="font-size: 1.25rem;"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 dark:text-white text-sm mb-1">{{ provider.name }}</h4>
                    <p class="text-xs text-gray-600 dark:text-gray-400 mb-2 line-clamp-2">{{ provider.description || 'Practice exam dumps' }}</p>
                    <div class="flex items-center justify-between mt-3">
                      <span class="text-xs font-semibold" :class="getProviderTextColor(provider.slug)">
                        {{ provider.exam_count }} {{ provider.exam_count === 1 ? 'Exam' : 'Exams' }}
                      </span>
                      <i class="fas fa-arrow-right ml-1 group-hover/item:translate-x-1 transition-transform text-xs"
                         :class="getProviderTextColor(provider.slug)"></i>
                    </div>
                  </div>
                </a>
              </template>

              <!-- Fallback if no providers -->
              <template v-else>
                <div class="col-span-full text-center py-8 text-gray-500 dark:text-gray-400">
                  <i class="fas fa-box-open text-4xl mb-3"></i>
                  <p>No exam providers available</p>
                </div>
              </template>
            </div>
          </div>
        </div>
      </div>
    </transition>

    <!-- Services Mega Menu -->
    <transition name="mega-menu-fade">
      <div v-if="activeMegaMenu === 'services'" class="mega-menu-container">
        <div class="mega-menu-content bg-white dark:bg-gray-800 shadow-2xl border-b border-gray-100 dark:border-gray-700">
          <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-6 gap-4">
              <!-- Service 1: One-to-One Mentorship -->
              <a href="/services/mentorship" class="group/item relative bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-950/30 dark:to-teal-950/30 rounded-xl p-4 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-emerald-100 dark:border-emerald-800 overflow-hidden">
                <div class="absolute top-0 right-0 w-20 h-20 bg-emerald-200/30 dark:bg-emerald-500/10 rounded-bl-full"></div>
                <div class="relative">
                  <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-lg flex items-center justify-center mb-3 group-hover/item:scale-110 transition-transform duration-300">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                  </div>
                  <h4 class="font-bold text-gray-900 dark:text-white text-sm mb-1">One-to-One Mentorship</h4>
                  <p class="text-xs text-gray-600 dark:text-gray-400 mb-2">Personalized guidance from industry experts</p>
                  <div class="flex items-center text-emerald-600 dark:text-emerald-400 text-xs font-medium">
                    Learn More
                    <i class="fas fa-arrow-right ml-1 group-hover/item:translate-x-1 transition-transform"></i>
                  </div>
                </div>
              </a>

              <!-- Service 2: Career Guidance -->
              <a href="/services/career-guidance" class="group/item relative bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-950/30 dark:to-indigo-950/30 rounded-xl p-4 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-blue-100 dark:border-blue-800 overflow-hidden">
                <div class="absolute top-0 right-0 w-20 h-20 bg-blue-200/30 dark:bg-blue-500/10 rounded-bl-full"></div>
                <div class="relative">
                  <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center mb-3 group-hover/item:scale-110 transition-transform duration-300">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                  </div>
                  <h4 class="font-bold text-gray-900 dark:text-white text-sm mb-1">Career Guidance</h4>
                  <p class="text-xs text-gray-600 dark:text-gray-400 mb-2">Strategic career planning and job placement</p>
                  <div class="flex items-center text-blue-600 dark:text-blue-400 text-xs font-medium">
                    Learn More
                    <i class="fas fa-arrow-right ml-1 group-hover/item:translate-x-1 transition-transform"></i>
                  </div>
                </div>
              </a>

              <!-- Service 3: Transition to DevOps -->
              <a href="/services/transition-devops" class="group/item relative bg-gradient-to-br from-purple-50 to-pink-50 dark:from-purple-950/30 dark:to-pink-950/30 rounded-xl p-4 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-purple-100 dark:border-purple-800 overflow-hidden">
                <div class="absolute top-0 right-0 w-20 h-20 bg-purple-200/30 dark:bg-purple-500/10 rounded-bl-full"></div>
                <div class="relative">
                  <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center mb-3 group-hover/item:scale-110 transition-transform duration-300">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                  </div>
                  <h4 class="font-bold text-gray-900 dark:text-white text-sm mb-1">Transition to DevOps</h4>
                  <p class="text-xs text-gray-600 dark:text-gray-400 mb-2">Complete career transition program</p>
                  <div class="flex items-center text-purple-600 dark:text-purple-400 text-xs font-medium">
                    Learn More
                    <i class="fas fa-arrow-right ml-1 group-hover/item:translate-x-1 transition-transform"></i>
                  </div>
                </div>
              </a>

              <!-- Service 4: Migration Services -->
              <a href="/services/migration-services" class="group/item relative bg-gradient-to-br from-orange-50 to-red-50 dark:from-orange-950/30 dark:to-red-950/30 rounded-xl p-4 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-orange-100 dark:border-orange-800 overflow-hidden">
                <div class="absolute top-0 right-0 w-20 h-20 bg-orange-200/30 dark:bg-orange-500/10 rounded-bl-full"></div>
                <div class="relative">
                  <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-600 rounded-lg flex items-center justify-center mb-3 group-hover/item:scale-110 transition-transform duration-300">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                    </svg>
                  </div>
                  <h4 class="font-bold text-gray-900 dark:text-white text-sm mb-1">Migration Services</h4>
                  <p class="text-xs text-gray-600 dark:text-gray-400 mb-2">Seamless cloud migration solutions</p>
                  <div class="flex items-center text-orange-600 dark:text-orange-400 text-xs font-medium">
                    Learn More
                    <i class="fas fa-arrow-right ml-1 group-hover/item:translate-x-1 transition-transform"></i>
                  </div>
                </div>
              </a>

              <!-- Service 5: Cloud Services -->
              <a href="/services/cloud-services" class="group/item relative bg-gradient-to-br from-cyan-50 to-blue-50 dark:from-cyan-950/30 dark:to-blue-950/30 rounded-xl p-4 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-cyan-100 dark:border-cyan-800 overflow-hidden">
                <div class="absolute top-0 right-0 w-20 h-20 bg-cyan-200/30 dark:bg-cyan-500/10 rounded-bl-full"></div>
                <div class="relative">
                  <div class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-lg flex items-center justify-center mb-3 group-hover/item:scale-110 transition-transform duration-300">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/>
                    </svg>
                  </div>
                  <h4 class="font-bold text-gray-900 dark:text-white text-sm mb-1">Cloud Services</h4>
                  <p class="text-xs text-gray-600 dark:text-gray-400 mb-2">Comprehensive cloud architecture</p>
                  <div class="flex items-center text-cyan-600 dark:text-cyan-400 text-xs font-medium">
                    Learn More
                    <i class="fas fa-arrow-right ml-1 group-hover/item:translate-x-1 transition-transform"></i>
                  </div>
                </div>
              </a>

              <!-- Service 6: Development Services -->
              <a href="/services/development-services" class="group/item relative bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-950/30 dark:to-emerald-950/30 rounded-xl p-4 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-green-100 dark:border-green-800 overflow-hidden">
                <div class="absolute top-0 right-0 w-20 h-20 bg-green-200/30 dark:bg-green-500/10 rounded-bl-full"></div>
                <div class="relative">
                  <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg flex items-center justify-center mb-3 group-hover/item:scale-110 transition-transform duration-300">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                    </svg>
                  </div>
                  <h4 class="font-bold text-gray-900 dark:text-white text-sm mb-1">Development Services</h4>
                  <p class="text-xs text-gray-600 dark:text-gray-400 mb-2">Custom DevOps tool development</p>
                  <div class="flex items-center text-green-600 dark:text-green-400 text-xs font-medium">
                    Learn More
                    <i class="fas fa-arrow-right ml-1 group-hover/item:translate-x-1 transition-transform"></i>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </transition>

    <!-- Courses Mega Menu -->
    <transition name="mega-menu-fade">
      <div v-if="activeMegaMenu === 'courses'" class="mega-menu-container">
        <div class="mega-menu-content bg-white dark:bg-gray-800 shadow-2xl border-b border-gray-100 dark:border-gray-700">
          <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4 max-h-[500px] overflow-y-auto">
              <!-- Dynamic Category Cards -->
              <template v-if="$page.props.courseCategories && $page.props.courseCategories.length > 0">
                <a
                  v-for="category in $page.props.courseCategories"
                  :key="category.id"
                  :href="`/courses?category=${category.slug}`"
                  class="group/item relative rounded-xl p-4 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border overflow-hidden"
                  :class="getCategoryCardClass(category.slug)"
                >
                  <div class="absolute top-0 right-0 w-20 h-20 rounded-bl-full opacity-20"
                       :class="getCategoryBgAccent(category.slug)"></div>
                  <div class="relative">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-3 group-hover/item:scale-110 transition-transform duration-300 shadow-lg"
                         :class="getCategoryIconBg(category.slug)">
                      <i :class="category.icon || 'fas fa-graduation-cap'" class="text-white" style="font-size: 1.25rem;"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 dark:text-white text-sm mb-1">{{ category.name }}</h4>
                    <p class="text-xs text-gray-600 dark:text-gray-400 mb-2 line-clamp-2">{{ category.description || 'DevOps courses' }}</p>
                    <div class="flex items-center justify-between mt-3">
                      <span class="text-xs font-semibold" :class="getCategoryTextColor(category.slug)">
                        {{ category.course_count }} {{ category.course_count === 1 ? 'Course' : 'Courses' }}
                      </span>
                      <i class="fas fa-arrow-right ml-1 group-hover/item:translate-x-1 transition-transform text-xs"
                         :class="getCategoryTextColor(category.slug)"></i>
                    </div>
                  </div>
                </a>
              </template>

              <!-- Fallback if no categories -->
              <template v-else>
                <div class="col-span-full text-center py-8 text-gray-500 dark:text-gray-400">
                  <i class="fas fa-box-open text-4xl mb-3"></i>
                  <p>No course categories available</p>
                </div>
              </template>
            </div>
          </div>
        </div>
      </div>
    </transition>
  </div>

  <!-- Ultra Modern Full-Width Mobile Menu -->
  <div ref="mobileMenu" class="mobile-menu fixed inset-0 w-full h-full bg-white dark:bg-gray-900 z-50 overflow-y-auto">
    <!-- Gradient Header -->
    <div class="bg-gradient-to-r from-emerald-600 via-teal-600 to-emerald-600 p-6 pb-8">
      <div class="flex justify-between items-center mb-6">
        <div>
          <h2 class="text-2xl font-bold text-white">DevOps Jungle</h2>
          <p class="text-emerald-100 text-sm">Master DevOps Skills</p>
        </div>
        <button @click="closeMobileMenu" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/20 text-white hover:bg-white/30 transition-colors">
          <i class="fas fa-times text-lg"></i>
        </button>
      </div>

      <!-- Mobile Search -->
      <div class="relative">
        <input
          type="text"
          placeholder="Search courses, dumps, services..."
          class="w-full pl-12 pr-4 py-3 text-sm bg-white/20 backdrop-blur-sm border border-white/30 text-white placeholder-emerald-100 rounded-xl focus:outline-none focus:bg-white/30 focus:border-white/50"
        >
        <i class="fas fa-search absolute left-4 top-3.5 text-emerald-100"></i>
      </div>
    </div>

    <!-- Navigation Content -->
    <div class="px-4 pb-6 -mt-4">
      <!-- Quick Actions -->
      <div class="grid grid-cols-2 gap-3 mb-6">
        <a href="/dumps" class="bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl p-4 text-white hover:shadow-lg transition-all">
          <i class="fas fa-file-alt text-2xl mb-2"></i>
          <p class="font-semibold text-sm">Exam Dumps</p>
        </a>
        <a href="/courses" class="bg-gradient-to-br from-emerald-500 to-green-600 rounded-xl p-4 text-white hover:shadow-lg transition-all">
          <i class="fas fa-graduation-cap text-2xl mb-2"></i>
          <p class="font-semibold text-sm">Courses</p>
        </a>
      </div>

      <!-- Exam Providers Section -->
      <div v-if="$page.props.examProviders && $page.props.examProviders.length > 0" class="mb-6">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3 px-2">Exam Dumps</h3>
        <div class="grid grid-cols-3 gap-2">
          <a
            v-for="provider in $page.props.examProviders.slice(0, 6)"
            :key="provider.id"
            :href="`/dumps?provider=${provider.slug}`"
            class="bg-gray-50 dark:bg-gray-800 rounded-lg p-3 text-center hover:shadow-md transition-all border border-gray-100 dark:border-gray-700"
          >
            <i :class="provider.icon" class="text-xl mb-1" :style="{ color: extractColor(provider.gradient_color) }"></i>
            <p class="text-xs font-medium text-gray-700 dark:text-gray-300 truncate">{{ provider.name }}</p>
          </a>
        </div>
        <a href="/dumps" class="block mt-3 text-center text-sm text-emerald-600 dark:text-emerald-400 font-medium py-2">
          View All Exam Dumps →
        </a>
      </div>

      <!-- Course Categories Section -->
      <div v-if="$page.props.courseCategories && $page.props.courseCategories.length > 0" class="mb-6">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3 px-2">Course Categories</h3>
        <div class="grid grid-cols-3 gap-2">
          <a
            v-for="category in $page.props.courseCategories.slice(0, 6)"
            :key="category.id"
            :href="`/courses?category=${category.slug}`"
            class="bg-gray-50 dark:bg-gray-800 rounded-lg p-3 text-center hover:shadow-md transition-all border border-gray-100 dark:border-gray-700"
          >
            <i :class="category.icon" class="text-xl mb-1" :style="{ color: extractColor(category.color) }"></i>
            <p class="text-xs font-medium text-gray-700 dark:text-gray-300 truncate">{{ category.name }}</p>
          </a>
        </div>
        <a href="/courses" class="block mt-3 text-center text-sm text-emerald-600 dark:text-emerald-400 font-medium py-2">
          View All Courses →
        </a>
      </div>

      <!-- Services Section -->
      <div class="mb-6">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3 px-2">Our Services</h3>
        <div class="space-y-2">
          <a href="/services/mentorship" class="flex items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:shadow-md transition-all">
            <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-lg flex items-center justify-center mr-3">
              <i class="fas fa-user-friends text-white"></i>
            </div>
            <span class="text-sm font-medium text-gray-900 dark:text-white">One-to-One Mentorship</span>
          </a>
          <a href="/services/career-guidance" class="flex items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:shadow-md transition-all">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-700 rounded-lg flex items-center justify-center mr-3">
              <i class="fas fa-certificate text-white"></i>
            </div>
            <span class="text-sm font-medium text-gray-900 dark:text-white">Career Guidance</span>
          </a>
        </div>
        <a href="/services" class="block mt-3 text-center text-sm text-emerald-600 dark:text-emerald-400 font-medium py-2">
          View All Services →
        </a>
      </div>

      <!-- Quick Links -->
      <div class="mb-6">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3 px-2">Quick Links</h3>
        <div class="grid grid-cols-2 gap-2">
          <a href="/blogs" class="flex items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:shadow-md transition-all">
            <i class="fas fa-blog text-purple-500 mr-2"></i>
            <span class="text-sm font-medium text-gray-900 dark:text-white">Blogs</span>
          </a>
          <a href="/support" class="flex items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:shadow-md transition-all">
            <i class="fas fa-headset text-orange-500 mr-2"></i>
            <span class="text-sm font-medium text-gray-900 dark:text-white">Support</span>
          </a>
        </div>
      </div>

      <!-- Mobile Auth / Profile -->
      <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
        <!-- Not Authenticated -->
        <template v-if="!$page.props.auth?.user">
          <div class="space-y-3">
            <button @click="openLoginModal" class="block w-full text-center border-2 border-emerald-600 text-emerald-600 dark:border-emerald-500 dark:text-emerald-500 py-3 rounded-xl text-sm font-semibold hover:bg-emerald-50 dark:hover:bg-emerald-900/20 transition-all">
              <i class="fas fa-sign-in-alt mr-2"></i>Login
            </button>
            <button @click="openSignupModal" class="block w-full text-center bg-gradient-to-r from-emerald-600 to-teal-600 text-white py-3 rounded-xl text-sm font-semibold hover:shadow-lg transition-all">
              <i class="fas fa-user-plus mr-2"></i>Sign Up Free
            </button>
          </div>
        </template>

        <!-- Authenticated -->
        <div v-else class="space-y-3">
          <div class="flex items-center space-x-3 p-4 bg-gradient-to-r from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20 rounded-xl border border-emerald-200 dark:border-emerald-800">
            <img
              :src="$page.props.auth.user.avatar_url"
              :alt="$page.props.auth.user.name"
              class="w-12 h-12 rounded-full border-2 border-emerald-500"
            >
            <div class="flex-1">
              <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $page.props.auth.user.name }}</p>
              <p class="text-xs text-gray-600 dark:text-gray-400">{{ $page.props.auth.user.email }}</p>
            </div>
          </div>
          <a href="/profile" class="block w-full text-center border-2 border-emerald-600 text-emerald-600 dark:border-emerald-500 dark:text-emerald-500 py-3 rounded-xl text-sm font-semibold hover:bg-emerald-50 dark:hover:bg-emerald-900/20 transition-all">
            <i class="fas fa-user mr-2"></i>My Profile
          </a>
          <button @click="handleLogout" class="block w-full text-center bg-red-600 text-white py-3 rounded-xl text-sm font-semibold hover:bg-red-700 transition-all">
            <i class="fas fa-sign-out-alt mr-2"></i>Logout
          </button>
        </div>
      </div>
    </div>
  </div>

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
      activeMegaMenu: null,
      megaMenuTimeout: null,
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
    if (this.megaMenuTimeout) {
      clearTimeout(this.megaMenuTimeout);
    }
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
    openMegaMenu(menuType) {
      if (this.megaMenuTimeout) {
        clearTimeout(this.megaMenuTimeout);
      }
      this.activeMegaMenu = menuType;
    },
    closeMegaMenu(menuType) {
      this.megaMenuTimeout = setTimeout(() => {
        if (!menuType || this.activeMegaMenu === menuType) {
          this.activeMegaMenu = null;
        }
      }, 100);
    },
    keepMegaMenuOpen() {
      if (this.megaMenuTimeout) {
        clearTimeout(this.megaMenuTimeout);
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
        this.activeMegaMenu = null;
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
    getProviderCardClass(providerSlug) {
      const classes = {
        'aws': 'bg-gradient-to-br from-orange-50 to-amber-50 dark:from-orange-950/30 dark:to-amber-950/30 border-orange-100 dark:border-orange-800',
        'azure': 'bg-gradient-to-br from-blue-50 to-sky-50 dark:from-blue-950/30 dark:to-sky-950/30 border-blue-100 dark:border-blue-800',
        'gcp': 'bg-gradient-to-br from-red-50 to-yellow-50 dark:from-red-950/30 dark:to-yellow-950/30 border-red-100 dark:border-red-800',
        'kubernetes': 'bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-950/30 dark:to-indigo-950/30 border-blue-100 dark:border-blue-800',
        'docker': 'bg-gradient-to-br from-cyan-50 to-blue-50 dark:from-cyan-950/30 dark:to-blue-950/30 border-cyan-100 dark:border-cyan-800',
        'linux': 'bg-gradient-to-br from-yellow-50 to-orange-50 dark:from-yellow-950/30 dark:to-orange-950/30 border-yellow-100 dark:border-yellow-800',
        'default': 'bg-gradient-to-br from-gray-50 to-slate-50 dark:from-gray-950/30 dark:to-slate-950/30 border-gray-100 dark:border-gray-800'
      }
      return classes[providerSlug] || classes['default']
    },
    getProviderIconBg(providerSlug) {
      const classes = {
        'aws': 'bg-gradient-to-br from-orange-500 to-orange-600',
        'azure': 'bg-gradient-to-br from-blue-500 to-blue-700',
        'gcp': 'bg-gradient-to-br from-red-500 to-yellow-500',
        'kubernetes': 'bg-gradient-to-br from-blue-600 to-indigo-600',
        'docker': 'bg-gradient-to-br from-cyan-500 to-blue-600',
        'linux': 'bg-gradient-to-br from-yellow-500 to-orange-500',
        'default': 'bg-gradient-to-br from-gray-500 to-slate-600'
      }
      return classes[providerSlug] || classes['default']
    },
    getProviderTextColor(providerSlug) {
      const classes = {
        'aws': 'text-orange-600 dark:text-orange-400',
        'azure': 'text-blue-600 dark:text-blue-400',
        'gcp': 'text-red-600 dark:text-yellow-400',
        'kubernetes': 'text-blue-700 dark:text-indigo-400',
        'docker': 'text-cyan-600 dark:text-cyan-400',
        'linux': 'text-yellow-600 dark:text-orange-400',
        'default': 'text-gray-600 dark:text-gray-400'
      }
      return classes[providerSlug] || classes['default']
    },
    getProviderBgAccent(providerSlug) {
      const classes = {
        'aws': 'bg-orange-400 dark:bg-orange-500',
        'azure': 'bg-blue-400 dark:bg-blue-500',
        'gcp': 'bg-red-400 dark:bg-yellow-400',
        'kubernetes': 'bg-blue-500 dark:bg-indigo-500',
        'docker': 'bg-cyan-400 dark:bg-cyan-500',
        'linux': 'bg-yellow-400 dark:bg-orange-400',
        'default': 'bg-gray-400 dark:bg-gray-500'
      }
      return classes[providerSlug] || classes['default']
    },
    getCategoryCardClass(categorySlug) {
      const classes = {
        'aws': 'bg-gradient-to-br from-orange-50 to-amber-50 dark:from-orange-950/30 dark:to-amber-950/30 border-orange-100 dark:border-orange-800',
        'azure': 'bg-gradient-to-br from-blue-50 to-sky-50 dark:from-blue-950/30 dark:to-sky-950/30 border-blue-100 dark:border-blue-800',
        'gcp': 'bg-gradient-to-br from-red-50 to-yellow-50 dark:from-red-950/30 dark:to-yellow-950/30 border-red-100 dark:border-red-800',
        'kubernetes': 'bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-950/30 dark:to-indigo-950/30 border-blue-100 dark:border-blue-800',
        'docker': 'bg-gradient-to-br from-cyan-50 to-blue-50 dark:from-cyan-950/30 dark:to-blue-950/30 border-cyan-100 dark:border-cyan-800',
        'terraform': 'bg-gradient-to-br from-purple-50 to-indigo-50 dark:from-purple-950/30 dark:to-indigo-950/30 border-purple-100 dark:border-purple-800',
        'devops': 'bg-gradient-to-br from-emerald-50 to-green-50 dark:from-emerald-950/30 dark:to-green-950/30 border-emerald-100 dark:border-emerald-800',
        'cicd': 'bg-gradient-to-br from-amber-50 to-orange-50 dark:from-amber-950/30 dark:to-orange-950/30 border-amber-100 dark:border-amber-800',
        'monitoring': 'bg-gradient-to-br from-red-50 to-rose-50 dark:from-red-950/30 dark:to-rose-950/30 border-red-100 dark:border-red-800',
        'default': 'bg-gradient-to-br from-gray-50 to-slate-50 dark:from-gray-950/30 dark:to-slate-950/30 border-gray-100 dark:border-gray-800'
      }
      return classes[categorySlug] || classes['default']
    },
    getCategoryIconBg(categorySlug) {
      const classes = {
        'aws': 'bg-gradient-to-br from-orange-500 to-orange-600',
        'azure': 'bg-gradient-to-br from-blue-500 to-blue-700',
        'gcp': 'bg-gradient-to-br from-red-500 to-yellow-500',
        'kubernetes': 'bg-gradient-to-br from-blue-600 to-indigo-600',
        'docker': 'bg-gradient-to-br from-cyan-500 to-blue-600',
        'terraform': 'bg-gradient-to-br from-purple-600 to-indigo-600',
        'devops': 'bg-gradient-to-br from-emerald-500 to-green-600',
        'cicd': 'bg-gradient-to-br from-amber-500 to-orange-600',
        'monitoring': 'bg-gradient-to-br from-red-500 to-rose-600',
        'default': 'bg-gradient-to-br from-gray-500 to-slate-600'
      }
      return classes[categorySlug] || classes['default']
    },
    getCategoryTextColor(categorySlug) {
      const classes = {
        'aws': 'text-orange-600 dark:text-orange-400',
        'azure': 'text-blue-600 dark:text-blue-400',
        'gcp': 'text-red-600 dark:text-yellow-400',
        'kubernetes': 'text-blue-700 dark:text-indigo-400',
        'docker': 'text-cyan-600 dark:text-cyan-400',
        'terraform': 'text-purple-600 dark:text-purple-400',
        'devops': 'text-emerald-600 dark:text-emerald-400',
        'cicd': 'text-amber-600 dark:text-amber-400',
        'monitoring': 'text-red-600 dark:text-rose-400',
        'default': 'text-gray-600 dark:text-gray-400'
      }
      return classes[categorySlug] || classes['default']
    },
    getCategoryBgAccent(categorySlug) {
      const classes = {
        'aws': 'bg-orange-400 dark:bg-orange-500',
        'azure': 'bg-blue-400 dark:bg-blue-500',
        'gcp': 'bg-red-400 dark:bg-yellow-400',
        'kubernetes': 'bg-blue-500 dark:bg-indigo-500',
        'docker': 'bg-cyan-400 dark:bg-cyan-500',
        'terraform': 'bg-purple-400 dark:bg-purple-500',
        'devops': 'bg-emerald-400 dark:bg-emerald-500',
        'cicd': 'bg-amber-400 dark:bg-orange-400',
        'monitoring': 'bg-red-400 dark:bg-rose-400',
        'default': 'bg-gray-400 dark:bg-gray-500'
      }
      return classes[categorySlug] || classes['default']
    },
    extractColor(gradientString) {
      if (!gradientString) return '#10B981';
      const match = gradientString.match(/#[0-9A-Fa-f]{6}/);
      return match ? match[0] : '#10B981';
    }
  }
}
</script>

<style scoped>
/* Mega Menu Container - Full Width Edge to Edge */
.mega-menu-wrapper {
  position: fixed;
  top: 64px; /* Height of header (h-16 = 4rem = 64px) */
  left: 0;
  right: 0;
  z-index: 40;
  pointer-events: none;
}

.mega-menu-container {
  width: 100%;
  pointer-events: auto;
}

.mega-menu-content {
  width: 100%;
  backdrop-filter: blur(20px);
}

/* Mega Menu Fade Transition */
.mega-menu-fade-enter-active,
.mega-menu-fade-leave-active {
  transition: all 0.2s ease-out;
}

.mega-menu-fade-enter-from {
  opacity: 0;
  transform: translateY(-10px);
}

.mega-menu-fade-leave-to {
  opacity: 0;
  transform: translateY(-5px);
}

.mega-menu-fade-enter-to,
.mega-menu-fade-leave-from {
  opacity: 1;
  transform: translateY(0);
}

/* Service Card Hover Effects */
.group\/item:hover {
  transform: translateY(-4px) scale(1.02);
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.dark .group\/item:hover {
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.2);
}

/* Custom scrollbar for mega menu */
.mega-menu-content ::-webkit-scrollbar {
  width: 6px;
}

.mega-menu-content ::-webkit-scrollbar-track {
  background: transparent;
}

.mega-menu-content ::-webkit-scrollbar-thumb {
  background: #10b981;
  border-radius: 3px;
}

.mega-menu-content ::-webkit-scrollbar-thumb:hover {
  background: #059669;
}

/* Line clamp utilities */
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

/* Ultra Modern Mobile Menu Styles */
.mobile-menu {
  transform: translateX(-100%);
  opacity: 0;
  transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.4s ease-out;
}

.mobile-menu.show {
  transform: translateX(0);
  opacity: 1;
}

/* Mobile menu backdrop blur effect */
.mobile-menu .backdrop-blur-sm {
  backdrop-filter: blur(8px);
  -webkit-backdrop-filter: blur(8px);
}

/* Mobile menu scrollbar */
.mobile-menu::-webkit-scrollbar {
  width: 4px;
}

.mobile-menu::-webkit-scrollbar-track {
  background: transparent;
}

.mobile-menu::-webkit-scrollbar-thumb {
  background: rgba(16, 185, 129, 0.3);
  border-radius: 2px;
}

.mobile-menu::-webkit-scrollbar-thumb:hover {
  background: rgba(16, 185, 129, 0.5);
}

/* Gradient animation */
.bg-gradient-to-r {
  background-size: 200% 100%;
  animation: gradientShift 3s ease infinite;
}

@keyframes gradientShift {
  0%, 100% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 100% 50%;
  }
}

/* Stagger animation for mobile menu items */
.mobile-menu .grid > a,
.mobile-menu .space-y-2 > a {
  animation: fadeInUp 0.4s ease-out forwards;
  opacity: 0;
}

.mobile-menu.show .grid > a:nth-child(1),
.mobile-menu.show .space-y-2 > a:nth-child(1) {
  animation-delay: 0.1s;
}

.mobile-menu.show .grid > a:nth-child(2),
.mobile-menu.show .space-y-2 > a:nth-child(2) {
  animation-delay: 0.15s;
}

.mobile-menu.show .grid > a:nth-child(3),
.mobile-menu.show .space-y-2 > a:nth-child(3) {
  animation-delay: 0.2s;
}

.mobile-menu.show .grid > a:nth-child(4),
.mobile-menu.show .space-y-2 > a:nth-child(4) {
  animation-delay: 0.25s;
}

.mobile-menu.show .grid > a:nth-child(5),
.mobile-menu.show .space-y-2 > a:nth-child(5) {
  animation-delay: 0.3s;
}

.mobile-menu.show .grid > a:nth-child(6),
.mobile-menu.show .space-y-2 > a:nth-child(6) {
  animation-delay: 0.35s;
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
