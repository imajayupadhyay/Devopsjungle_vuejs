<template>
  <div class="bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 transition-colors duration-200">
    <Head>
      <title>Professional DevOps Services - DevOps Jungle</title>
      <meta name="description" content="Transform your career and business with our premium DevOps services. One-to-one mentorship, career guidance, cloud migration, and development services.">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    </Head>

    <DevOpsHeader />

    <main>
      <!-- Hero Section with Animated SVG -->
      <section class="relative overflow-hidden bg-gradient-to-br from-emerald-50 via-green-50 to-teal-50 dark:from-gray-900 dark:via-emerald-950 dark:to-gray-900 py-20 lg:py-32">
        <!-- Floating Elements Background -->
        <div class="absolute inset-0 overflow-hidden">
          <div class="absolute top-20 left-10 w-72 h-72 bg-emerald-200/30 dark:bg-emerald-500/10 rounded-full blur-3xl animate-blob"></div>
          <div class="absolute top-40 right-10 w-96 h-96 bg-teal-200/30 dark:bg-teal-500/10 rounded-full blur-3xl animate-blob animation-delay-2000"></div>
          <div class="absolute -bottom-32 left-1/3 w-96 h-96 bg-green-200/30 dark:bg-green-500/10 rounded-full blur-3xl animate-blob animation-delay-4000"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 relative z-10">
          <div class="grid lg:grid-cols-2 gap-12 items-center">
            <!-- Left Content -->
            <div data-aos="fade-right">
              <div class="inline-flex items-center px-4 py-2 bg-emerald-100 dark:bg-emerald-900/30 rounded-full mb-6">
                <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse mr-2"></span>
                <span class="text-sm font-medium text-emerald-800 dark:text-emerald-300">Premium DevOps Services</span>
              </div>

              <h1 class="text-5xl lg:text-7xl font-bold text-gray-900 dark:text-white mb-6 leading-tight">
                Accelerate Your
                <span class="block bg-gradient-to-r from-emerald-600 to-teal-600 dark:from-emerald-400 dark:to-teal-400 bg-clip-text text-transparent">
                  DevOps Journey
                </span>
              </h1>

              <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 leading-relaxed">
                From personalized mentorship to enterprise cloud solutions, we provide end-to-end DevOps services tailored to your needs.
              </p>

              <div class="flex flex-wrap gap-4 mb-12">
                <button class="px-8 py-4 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-emerald-500/50 transform hover:-translate-y-1 transition-all duration-200">
                  Explore Services
                  <i class="fas fa-arrow-right ml-2"></i>
                </button>
                <button class="px-8 py-4 bg-white dark:bg-gray-800 text-gray-800 dark:text-white rounded-xl font-semibold border-2 border-gray-200 dark:border-gray-700 hover:border-emerald-500 dark:hover:border-emerald-500 transition-all duration-200">
                  Book Consultation
                </button>
              </div>

              <!-- Trust Indicators -->
              <div class="flex flex-wrap gap-8">
                <div>
                  <div class="text-3xl font-bold text-gray-900 dark:text-white">500+</div>
                  <div class="text-sm text-gray-600 dark:text-gray-400">Happy Clients</div>
                </div>
                <div>
                  <div class="text-3xl font-bold text-gray-900 dark:text-white">98%</div>
                  <div class="text-sm text-gray-600 dark:text-gray-400">Satisfaction Rate</div>
                </div>
                <div>
                  <div class="text-3xl font-bold text-gray-900 dark:text-white">24/7</div>
                  <div class="text-sm text-gray-600 dark:text-gray-400">Support Available</div>
                </div>
              </div>
            </div>

            <!-- Right SVG Illustration -->
            <div class="relative" data-aos="fade-left">
              <div class="relative w-full h-[500px]">
                <!-- Animated SVG Illustration -->
                <svg viewBox="0 0 500 500" class="w-full h-full">
                  <!-- Cloud -->
                  <g class="animate-float">
                    <ellipse cx="250" cy="150" rx="80" ry="50" fill="url(#cloudGradient)" opacity="0.9"/>
                    <ellipse cx="210" cy="140" rx="60" ry="40" fill="url(#cloudGradient)" opacity="0.95"/>
                    <ellipse cx="290" cy="140" rx="60" ry="40" fill="url(#cloudGradient)" opacity="0.95"/>
                  </g>

                  <!-- Floating Icons -->
                  <g class="animate-pulse-slow">
                    <circle cx="150" cy="200" r="30" fill="url(#icon1Gradient)" opacity="0.8"/>
                    <text x="150" y="210" text-anchor="middle" fill="white" font-size="20">👨‍💼</text>
                  </g>

                  <g class="animate-pulse-slow animation-delay-1000">
                    <circle cx="350" cy="220" r="30" fill="url(#icon2Gradient)" opacity="0.8"/>
                    <text x="350" y="230" text-anchor="middle" fill="white" font-size="20">☁️</text>
                  </g>

                  <g class="animate-pulse-slow animation-delay-2000">
                    <circle cx="180" cy="320" r="30" fill="url(#icon3Gradient)" opacity="0.8"/>
                    <text x="180" y="330" text-anchor="middle" fill="white" font-size="20">🚀</text>
                  </g>

                  <g class="animate-pulse-slow animation-delay-3000">
                    <circle cx="320" cy="340" r="30" fill="url(#icon4Gradient)" opacity="0.8"/>
                    <text x="320" y="350" text-anchor="middle" fill="white" font-size="20">💻</text>
                  </g>

                  <!-- Central Element -->
                  <g transform="translate(250, 280)">
                    <circle r="60" fill="url(#centralGradient)" class="animate-ping-slow"/>
                    <circle r="50" fill="url(#centralGradient)"/>
                    <text y="10" text-anchor="middle" fill="white" font-size="30" font-weight="bold">DevOps</text>
                  </g>

                  <!-- Connecting Lines -->
                  <g stroke="url(#lineGradient)" stroke-width="2" stroke-dasharray="5,5" opacity="0.6" class="animate-dash">
                    <line x1="150" y1="200" x2="220" y2="250"/>
                    <line x1="350" y1="220" x2="280" y2="250"/>
                    <line x1="180" y1="320" x2="220" y2="290"/>
                    <line x1="320" y1="340" x2="280" y2="290"/>
                  </g>

                  <!-- Gradients -->
                  <defs>
                    <linearGradient id="cloudGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                      <stop offset="0%" style="stop-color:#10b981;stop-opacity:0.8" />
                      <stop offset="100%" style="stop-color:#14b8a6;stop-opacity:0.9" />
                    </linearGradient>
                    <linearGradient id="icon1Gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                      <stop offset="0%" style="stop-color:#059669;stop-opacity:1" />
                      <stop offset="100%" style="stop-color:#047857;stop-opacity:1" />
                    </linearGradient>
                    <linearGradient id="icon2Gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                      <stop offset="0%" style="stop-color:#0d9488;stop-opacity:1" />
                      <stop offset="100%" style="stop-color:#0f766e;stop-opacity:1" />
                    </linearGradient>
                    <linearGradient id="icon3Gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                      <stop offset="0%" style="stop-color:#10b981;stop-opacity:1" />
                      <stop offset="100%" style="stop-color:#059669;stop-opacity:1" />
                    </linearGradient>
                    <linearGradient id="icon4Gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                      <stop offset="0%" style="stop-color:#14b8a6;stop-opacity:1" />
                      <stop offset="100%" style="stop-color:#0d9488;stop-opacity:1" />
                    </linearGradient>
                    <linearGradient id="centralGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                      <stop offset="0%" style="stop-color:#047857;stop-opacity:1" />
                      <stop offset="100%" style="stop-color:#0f766e;stop-opacity:1" />
                    </linearGradient>
                    <linearGradient id="lineGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                      <stop offset="0%" style="stop-color:#10b981;stop-opacity:0.6" />
                      <stop offset="100%" style="stop-color:#14b8a6;stop-opacity:0.6" />
                    </linearGradient>
                  </defs>
                </svg>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Services Grid -->
      <section class="py-20 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4">
          <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">
              Our Premium Services
            </h2>
            <p class="text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
              Comprehensive DevOps solutions designed to transform your career and business
            </p>
          </div>

          <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Service Card 1: One-to-One Mentorship -->
            <div class="group relative bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 border-2 border-gray-100 dark:border-gray-700 hover:border-emerald-500 dark:hover:border-emerald-500 transition-all duration-300 hover:shadow-2xl hover:-translate-y-2" data-aos="fade-up">
              <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-emerald-400/20 to-teal-400/20 rounded-bl-full"></div>

              <div class="relative">
                <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                  <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                  </svg>
                </div>

                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">
                  One-to-One Mentorship
                </h3>

                <p class="text-gray-600 dark:text-gray-400 mb-6 leading-relaxed">
                  Personalized guidance from industry experts. Get tailored career advice, technical mentorship, and hands-on project support.
                </p>

                <ul class="space-y-2 mb-6">
                  <li class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                    <i class="fas fa-check-circle text-emerald-500 mr-2"></i>
                    Weekly 1-on-1 sessions
                  </li>
                  <li class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                    <i class="fas fa-check-circle text-emerald-500 mr-2"></i>
                    Personalized learning path
                  </li>
                  <li class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                    <i class="fas fa-check-circle text-emerald-500 mr-2"></i>
                    Real-world project guidance
                  </li>
                </ul>

                <a href="/services/mentorship" class="block w-full py-3 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-emerald-500/50 transition-all duration-200 text-center">
                  Learn More
                  <i class="fas fa-arrow-right ml-2"></i>
                </a>
              </div>
            </div>

            <!-- Service Card 2: Career Guidance -->
            <div class="group relative bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 border-2 border-gray-100 dark:border-gray-700 hover:border-emerald-500 dark:hover:border-emerald-500 transition-all duration-300 hover:shadow-2xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
              <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-400/20 to-indigo-400/20 rounded-bl-full"></div>

              <div class="relative">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                  <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                  </svg>
                </div>

                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">
                  Career Guidance
                </h3>

                <p class="text-gray-600 dark:text-gray-400 mb-6 leading-relaxed">
                  Strategic career planning and job placement support. Navigate your DevOps career path with confidence and clarity.
                </p>

                <ul class="space-y-2 mb-6">
                  <li class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                    <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                    Resume & portfolio review
                  </li>
                  <li class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                    <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                    Interview preparation
                  </li>
                  <li class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                    <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                    Job placement assistance
                  </li>
                </ul>

                <a href="/services/career-guidance" class="block w-full py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-blue-500/50 transition-all duration-200 text-center">
                  Learn More
                  <i class="fas fa-arrow-right ml-2"></i>
                </a>
              </div>
            </div>

            <!-- Service Card 3: DevOps Transition -->
            <div class="group relative bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 border-2 border-gray-100 dark:border-gray-700 hover:border-emerald-500 dark:hover:border-emerald-500 transition-all duration-300 hover:shadow-2xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
              <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-purple-400/20 to-pink-400/20 rounded-bl-full"></div>

              <div class="relative">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                  <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                  </svg>
                </div>

                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">
                  Transition to DevOps
                </h3>

                <p class="text-gray-600 dark:text-gray-400 mb-6 leading-relaxed">
                  Complete career transition program. Move from any IT background into a thriving DevOps career with structured guidance.
                </p>

                <ul class="space-y-2 mb-6">
                  <li class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                    <i class="fas fa-check-circle text-purple-500 mr-2"></i>
                    Skills gap analysis
                  </li>
                  <li class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                    <i class="fas fa-check-circle text-purple-500 mr-2"></i>
                    Structured learning path
                  </li>
                  <li class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                    <i class="fas fa-check-circle text-purple-500 mr-2"></i>
                    Industry networking
                  </li>
                </ul>

                <button class="w-full py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-purple-500/50 transition-all duration-200">
                  Learn More
                  <i class="fas fa-arrow-right ml-2"></i>
                </button>
              </div>
            </div>

            <!-- Service Card 4: Migration Services -->
            <div class="group relative bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 border-2 border-gray-100 dark:border-gray-700 hover:border-emerald-500 dark:hover:border-emerald-500 transition-all duration-300 hover:shadow-2xl hover:-translate-y-2" data-aos="fade-up">
              <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-orange-400/20 to-red-400/20 rounded-bl-full"></div>

              <div class="relative">
                <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                  <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                  </svg>
                </div>

                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">
                  Migration Services
                </h3>

                <p class="text-gray-600 dark:text-gray-400 mb-6 leading-relaxed">
                  Seamless cloud migration solutions. Move your infrastructure to modern cloud platforms with zero downtime and optimized costs.
                </p>

                <ul class="space-y-2 mb-6">
                  <li class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                    <i class="fas fa-check-circle text-orange-500 mr-2"></i>
                    Assessment & planning
                  </li>
                  <li class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                    <i class="fas fa-check-circle text-orange-500 mr-2"></i>
                    Zero-downtime migration
                  </li>
                  <li class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                    <i class="fas fa-check-circle text-orange-500 mr-2"></i>
                    Post-migration support
                  </li>
                </ul>

                <button class="w-full py-3 bg-gradient-to-r from-orange-600 to-red-600 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-orange-500/50 transition-all duration-200">
                  Learn More
                  <i class="fas fa-arrow-right ml-2"></i>
                </button>
              </div>
            </div>

            <!-- Service Card 5: Cloud Services -->
            <div class="group relative bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 border-2 border-gray-100 dark:border-gray-700 hover:border-emerald-500 dark:hover:border-emerald-500 transition-all duration-300 hover:shadow-2xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
              <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-cyan-400/20 to-blue-400/20 rounded-bl-full"></div>

              <div class="relative">
                <div class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                  <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/>
                  </svg>
                </div>

                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">
                  Cloud Services
                </h3>

                <p class="text-gray-600 dark:text-gray-400 mb-6 leading-relaxed">
                  Comprehensive cloud architecture and management. Design, deploy, and optimize your cloud infrastructure for maximum efficiency.
                </p>

                <ul class="space-y-2 mb-6">
                  <li class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                    <i class="fas fa-check-circle text-cyan-500 mr-2"></i>
                    Multi-cloud architecture
                  </li>
                  <li class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                    <i class="fas fa-check-circle text-cyan-500 mr-2"></i>
                    Cost optimization
                  </li>
                  <li class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                    <i class="fas fa-check-circle text-cyan-500 mr-2"></i>
                    24/7 monitoring
                  </li>
                </ul>

                <button class="w-full py-3 bg-gradient-to-r from-cyan-600 to-blue-600 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-cyan-500/50 transition-all duration-200">
                  Learn More
                  <i class="fas fa-arrow-right ml-2"></i>
                </button>
              </div>
            </div>

            <!-- Service Card 6: Development Services -->
            <div class="group relative bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 border-2 border-gray-100 dark:border-gray-700 hover:border-emerald-500 dark:hover:border-emerald-500 transition-all duration-300 hover:shadow-2xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
              <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-green-400/20 to-emerald-400/20 rounded-bl-full"></div>

              <div class="relative">
                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                  <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                  </svg>
                </div>

                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">
                  Development Services
                </h3>

                <p class="text-gray-600 dark:text-gray-400 mb-6 leading-relaxed">
                  Custom DevOps tool development and automation. Build, automate, and streamline your DevOps workflows with cutting-edge solutions.
                </p>

                <ul class="space-y-2 mb-6">
                  <li class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                    Custom CI/CD pipelines
                  </li>
                  <li class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                    Automation scripts
                  </li>
                  <li class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                    IaC templates
                  </li>
                </ul>

                <button class="w-full py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-green-500/50 transition-all duration-200">
                  Learn More
                  <i class="fas fa-arrow-right ml-2"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- CTA Section -->
      <section class="py-20 bg-gradient-to-br from-emerald-600 to-teal-600 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
          <div class="absolute inset-0 pattern-dots"></div>
        </div>

        <div class="max-w-4xl mx-auto px-4 text-center relative z-10" data-aos="fade-up">
          <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6">
            Ready to Transform Your DevOps Journey?
          </h2>
          <p class="text-xl text-emerald-50 mb-10 leading-relaxed">
            Book a free consultation with our experts and discover how we can help you achieve your goals
          </p>
          <div class="flex flex-wrap justify-center gap-4">
            <button class="px-8 py-4 bg-white text-emerald-600 rounded-xl font-bold hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-200">
              <i class="fas fa-calendar-alt mr-2"></i>
              Schedule Free Consultation
            </button>
            <button class="px-8 py-4 bg-transparent border-2 border-white text-white rounded-xl font-bold hover:bg-white hover:text-emerald-600 transition-all duration-200">
              <i class="fas fa-phone mr-2"></i>
              Call Us Now
            </button>
          </div>
        </div>
      </section>
    </main>

    <DevOpsFooter />
  </div>
</template>

<script>
import { Head } from '@inertiajs/vue3'
import DevOpsHeader from '../Common/Header.vue'
import DevOpsFooter from '../Common/Footer.vue'

export default {
  name: 'ServicesPage',
  components: {
    Head,
    DevOpsHeader,
    DevOpsFooter
  },
  mounted() {
    this.loadAOS()
  },
  methods: {
    loadAOS() {
      if (typeof window.AOS !== 'undefined') {
        window.AOS.init({
          duration: 800,
          easing: 'ease-out',
          once: true
        })
        return
      }

      const script = document.createElement('script')
      script.src = 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js'
      script.onload = () => {
        if (typeof window.AOS !== 'undefined') {
          window.AOS.init({
            duration: 800,
            easing: 'ease-out',
            once: true
          })
        }
      }
      document.head.appendChild(script)
    }
  }
}
</script>

<style scoped>
@keyframes blob {
  0%, 100% {
    transform: translate(0, 0) scale(1);
  }
  33% {
    transform: translate(30px, -50px) scale(1.1);
  }
  66% {
    transform: translate(-20px, 20px) scale(0.9);
  }
}

@keyframes float {
  0%, 100% {
    transform: translateY(0px);
  }
  50% {
    transform: translateY(-20px);
  }
}

@keyframes pulse-slow {
  0%, 100% {
    opacity: 1;
    transform: scale(1);
  }
  50% {
    opacity: 0.8;
    transform: scale(1.05);
  }
}

@keyframes ping-slow {
  0% {
    transform: scale(1);
    opacity: 1;
  }
  75%, 100% {
    transform: scale(1.5);
    opacity: 0;
  }
}

@keyframes dash {
  to {
    stroke-dashoffset: -100;
  }
}

.animate-blob {
  animation: blob 7s infinite;
}

.animation-delay-2000 {
  animation-delay: 2s;
}

.animation-delay-4000 {
  animation-delay: 4s;
}

.animation-delay-1000 {
  animation-delay: 1s;
}

.animation-delay-3000 {
  animation-delay: 3s;
}

.animate-float {
  animation: float 6s ease-in-out infinite;
}

.animate-pulse-slow {
  animation: pulse-slow 3s ease-in-out infinite;
}

.animate-ping-slow {
  animation: ping-slow 3s cubic-bezier(0, 0, 0.2, 1) infinite;
}

.animate-dash {
  animation: dash 20s linear infinite;
}

.pattern-dots {
  background-image: radial-gradient(circle, rgba(255, 255, 255, 0.3) 1px, transparent 1px);
  background-size: 20px 20px;
}
</style>
