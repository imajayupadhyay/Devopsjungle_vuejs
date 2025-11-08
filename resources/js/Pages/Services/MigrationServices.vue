<template>
  <div class="bg-white dark:bg-gray-900">
    <Head>
      <title>Migration Services - Seamless Cloud & Infrastructure Migration | DevOps Jungle</title>
      <meta name="description" content="Zero-downtime cloud migration services. Move from on-premise to cloud, legacy to modern, or between cloud providers with expert planning and execution.">
    </Head>

    <DevOpsHeader />

    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-gradient-to-br from-emerald-50 via-green-50 to-teal-50 dark:from-gray-900 dark:via-emerald-950 dark:to-gray-900 py-20 lg:py-32">
      <!-- Animated Background -->
      <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-20 left-10 w-96 h-96 bg-emerald-300/20 dark:bg-emerald-500/10 rounded-full blur-3xl animate-blob"></div>
        <div class="absolute top-40 right-10 w-96 h-96 bg-teal-300/20 dark:bg-teal-500/10 rounded-full blur-3xl animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-20 left-1/3 w-96 h-96 bg-green-300/20 dark:bg-green-500/10 rounded-full blur-3xl animate-blob animation-delay-4000"></div>
      </div>

      <div class="max-w-7xl mx-auto px-4 relative z-10">
        <!-- Breadcrumb -->
        <nav class="mb-8" data-aos="fade-right">
          <ol class="flex items-center space-x-2 text-sm">
            <li><a href="/" class="text-emerald-600 dark:text-emerald-400 hover:underline">Home</a></li>
            <li><span class="text-gray-400">/</span></li>
            <li><a href="/services" class="text-emerald-600 dark:text-emerald-400 hover:underline">Services</a></li>
            <li><span class="text-gray-400">/</span></li>
            <li class="text-gray-600 dark:text-gray-400">Migration Services</li>
          </ol>
        </nav>

        <div class="grid lg:grid-cols-2 gap-12 items-center">
          <!-- Left Content -->
          <div data-aos="fade-right">
            <div class="inline-flex items-center px-4 py-2 bg-emerald-100 dark:bg-emerald-900/30 rounded-full mb-6">
              <i class="fas fa-exchange-alt text-teal-500 mr-2"></i>
              <span class="text-sm font-medium text-emerald-800 dark:text-emerald-300">Zero-Downtime Migration</span>
            </div>

            <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 dark:text-white mb-6 leading-tight">
              Seamless
              <span class="block bg-gradient-to-r from-emerald-600 to-teal-600 dark:from-emerald-400 dark:to-teal-400 bg-clip-text text-transparent">
                Cloud Migration
              </span>
              Solutions
            </h1>

            <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 leading-relaxed">
              Migrate your infrastructure, applications, and data to the cloud with zero downtime. From legacy systems to modern cloud platforms, we ensure a smooth transition every step of the way.
            </p>

            <div class="flex flex-wrap gap-4 mb-8">
              <button class="px-8 py-4 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-emerald-500/50 transform hover:-translate-y-1 transition-all duration-200">
                <i class="fas fa-rocket mr-2"></i>
                Start Migration
              </button>
              <button class="px-8 py-4 bg-white dark:bg-gray-800 text-gray-800 dark:text-white rounded-xl font-semibold border-2 border-gray-200 dark:border-gray-700 hover:border-emerald-500 transition-all duration-200">
                <i class="fas fa-file-alt mr-2"></i>
                Get Assessment
              </button>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-3 gap-6">
              <div>
                <div class="text-3xl font-bold text-gray-900 dark:text-white">200+</div>
                <div class="text-sm text-gray-600 dark:text-gray-400">Migrations</div>
              </div>
              <div>
                <div class="text-3xl font-bold text-gray-900 dark:text-white">100%</div>
                <div class="text-sm text-gray-600 dark:text-gray-400">Zero Downtime</div>
              </div>
              <div>
                <div class="text-3xl font-bold text-gray-900 dark:text-white">6 Weeks</div>
                <div class="text-sm text-gray-600 dark:text-gray-400">Avg Time</div>
              </div>
            </div>
          </div>

          <!-- Right Side - Migration Journey -->
          <div class="relative" data-aos="fade-left">
            <div class="relative w-full h-[500px]">
              <svg viewBox="0 0 400 500" class="w-full h-full">
                <!-- Migration Path -->
                <path d="M 80 100 Q 200 200, 320 100 Q 200 0, 80 100 M 80 250 Q 200 350, 320 250 Q 200 150, 80 250 M 80 400 Q 200 500, 320 400 Q 200 300, 80 400"
                      stroke="url(#pathGradient)"
                      stroke-width="3"
                      fill="none"
                      stroke-dasharray="10,5"
                      class="animate-dash"/>

                <!-- Start: On-Premise -->
                <g class="animate-fade-in">
                  <rect x="50" y="75" width="120" height="50" rx="10" fill="url(#startGradient)" opacity="0.9"/>
                  <text x="110" y="105" text-anchor="middle" fill="white" font-size="14" font-weight="bold">On-Premise</text>
                </g>

                <!-- Step 1: Assessment -->
                <g class="animate-fade-in animation-delay-500">
                  <circle cx="200" cy="150" r="45" fill="url(#step1Gradient)" opacity="0.9"/>
                  <text x="200" y="145" text-anchor="middle" fill="white" font-size="12" font-weight="bold">Step 1</text>
                  <text x="200" y="160" text-anchor="middle" fill="white" font-size="11">Assessment</text>
                </g>

                <!-- Step 2: Planning -->
                <g class="animate-fade-in animation-delay-1000">
                  <circle cx="200" cy="300" r="45" fill="url(#step2Gradient)" opacity="0.9"/>
                  <text x="200" y="295" text-anchor="middle" fill="white" font-size="12" font-weight="bold">Step 2</text>
                  <text x="200" y="310" text-anchor="middle" fill="white" font-size="11">Planning</text>
                </g>

                <!-- Step 3: Execution -->
                <g class="animate-fade-in animation-delay-1500">
                  <circle cx="200" cy="450" r="45" fill="url(#step3Gradient)" opacity="0.9"/>
                  <text x="200" y="445" text-anchor="middle" fill="white" font-size="12" font-weight="bold">Step 3</text>
                  <text x="200" y="460" text-anchor="middle" fill="white" font-size="11">Migration</text>
                </g>

                <!-- End: Cloud -->
                <g class="animate-fade-in animation-delay-2000">
                  <rect x="260" y="75" width="100" height="50" rx="10" fill="url(#endGradient)" opacity="0.9"/>
                  <text x="310" y="105" text-anchor="middle" fill="white" font-size="14" font-weight="bold">Cloud ☁️</text>
                </g>

                <!-- Gradients -->
                <defs>
                  <linearGradient id="pathGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" style="stop-color:#10b981;stop-opacity:0.8"/>
                    <stop offset="100%" style="stop-color:#14b8a6;stop-opacity:0.8"/>
                  </linearGradient>
                  <linearGradient id="startGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" style="stop-color:#6b7280;stop-opacity:1"/>
                    <stop offset="100%" style="stop-color:#4b5563;stop-opacity:1"/>
                  </linearGradient>
                  <radialGradient id="step1Gradient">
                    <stop offset="0%" style="stop-color:#10b981;stop-opacity:0.9"/>
                    <stop offset="100%" style="stop-color:#059669;stop-opacity:1"/>
                  </radialGradient>
                  <radialGradient id="step2Gradient">
                    <stop offset="0%" style="stop-color:#14b8a6;stop-opacity:0.9"/>
                    <stop offset="100%" style="stop-color:#0d9488;stop-opacity:1"/>
                  </radialGradient>
                  <radialGradient id="step3Gradient">
                    <stop offset="0%" style="stop-color:#22c55e;stop-opacity:0.9"/>
                    <stop offset="100%" style="stop-color:#16a34a;stop-opacity:1"/>
                  </radialGradient>
                  <linearGradient id="endGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" style="stop-color:#10b981;stop-opacity:1"/>
                    <stop offset="100%" style="stop-color:#14b8a6;stop-opacity:1"/>
                  </linearGradient>
                </defs>
              </svg>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Migration Types -->
    <section class="py-20 bg-white dark:bg-gray-900">
      <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
          <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">
            Migration Types We Handle
          </h2>
          <p class="text-xl text-gray-600 dark:text-gray-400">
            From legacy systems to modern cloud platforms
          </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
          <!-- Migration Type 1 -->
          <div class="group relative bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-6 border-2 border-gray-100 dark:border-gray-700 hover:border-emerald-500 transition-all duration-300 hover:shadow-xl hover:-translate-y-2" data-aos="fade-up">
            <div class="text-5xl mb-4 text-center">🏢</div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 text-center">On-Premise to Cloud</h3>
            <p class="text-gray-600 dark:text-gray-400 text-center text-sm">
              Migrate legacy infrastructure to AWS, Azure, or GCP
            </p>
          </div>

          <!-- Migration Type 2 -->
          <div class="group relative bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-6 border-2 border-gray-100 dark:border-gray-700 hover:border-emerald-500 transition-all duration-300 hover:shadow-xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
            <div class="text-5xl mb-4 text-center">☁️</div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 text-center">Cloud to Cloud</h3>
            <p class="text-gray-600 dark:text-gray-400 text-center text-sm">
              Switch between AWS, Azure, GCP seamlessly
            </p>
          </div>

          <!-- Migration Type 3 -->
          <div class="group relative bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-6 border-2 border-gray-100 dark:border-gray-700 hover:border-emerald-500 transition-all duration-300 hover:shadow-xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
            <div class="text-5xl mb-4 text-center">📦</div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 text-center">Application Migration</h3>
            <p class="text-gray-600 dark:text-gray-400 text-center text-sm">
              Modernize apps to microservices & containers
            </p>
          </div>

          <!-- Migration Type 4 -->
          <div class="group relative bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-6 border-2 border-gray-100 dark:border-gray-700 hover:border-emerald-500 transition-all duration-300 hover:shadow-xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="300">
            <div class="text-5xl mb-4 text-center">💾</div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 text-center">Database Migration</h3>
            <p class="text-gray-600 dark:text-gray-400 text-center text-sm">
              SQL to NoSQL, on-prem to managed databases
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Migration Process -->
    <section class="py-20 bg-gray-50 dark:bg-gray-800">
      <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
          <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">
            Our Migration Process
          </h2>
          <p class="text-xl text-gray-600 dark:text-gray-400">
            A proven 5-phase methodology for successful migrations
          </p>
        </div>

        <div class="max-w-4xl mx-auto space-y-6">
          <!-- Phase 1 -->
          <div class="bg-white dark:bg-gray-900 rounded-2xl p-8 border-l-4 border-emerald-500 hover:shadow-xl transition-all" data-aos="fade-right">
            <div class="flex items-start gap-6">
              <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center flex-shrink-0">
                <span class="text-2xl font-bold text-white">1</span>
              </div>
              <div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Discovery & Assessment</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-4">
                  Comprehensive analysis of your current infrastructure, applications, and dependencies. We identify migration candidates and assess complexity.
                </p>
                <div class="flex flex-wrap gap-2">
                  <span class="px-3 py-1 bg-emerald-100 dark:bg-emerald-900 text-emerald-700 dark:text-emerald-300 rounded-full text-sm">Infrastructure Audit</span>
                  <span class="px-3 py-1 bg-emerald-100 dark:bg-emerald-900 text-emerald-700 dark:text-emerald-300 rounded-full text-sm">Dependency Mapping</span>
                  <span class="px-3 py-1 bg-emerald-100 dark:bg-emerald-900 text-emerald-700 dark:text-emerald-300 rounded-full text-sm">Cost Analysis</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Phase 2 -->
          <div class="bg-white dark:bg-gray-900 rounded-2xl p-8 border-l-4 border-teal-500 hover:shadow-xl transition-all" data-aos="fade-right" data-aos-delay="100">
            <div class="flex items-start gap-6">
              <div class="w-16 h-16 bg-gradient-to-br from-teal-500 to-emerald-600 rounded-xl flex items-center justify-center flex-shrink-0">
                <span class="text-2xl font-bold text-white">2</span>
              </div>
              <div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Strategic Planning</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-4">
                  Create detailed migration roadmap with timelines, resource allocation, and risk mitigation strategies.
                </p>
                <div class="flex flex-wrap gap-2">
                  <span class="px-3 py-1 bg-teal-100 dark:bg-teal-900 text-teal-700 dark:text-teal-300 rounded-full text-sm">Migration Strategy</span>
                  <span class="px-3 py-1 bg-teal-100 dark:bg-teal-900 text-teal-700 dark:text-teal-300 rounded-full text-sm">Timeline Planning</span>
                  <span class="px-3 py-1 bg-teal-100 dark:bg-teal-900 text-teal-700 dark:text-teal-300 rounded-full text-sm">Risk Assessment</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Phase 3 -->
          <div class="bg-white dark:bg-gray-900 rounded-2xl p-8 border-l-4 border-green-500 hover:shadow-xl transition-all" data-aos="fade-right" data-aos-delay="200">
            <div class="flex items-start gap-6">
              <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center flex-shrink-0">
                <span class="text-2xl font-bold text-white">3</span>
              </div>
              <div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Environment Setup</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-4">
                  Configure target cloud infrastructure, networking, security, and compliance requirements.
                </p>
                <div class="flex flex-wrap gap-2">
                  <span class="px-3 py-1 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-full text-sm">Cloud Provisioning</span>
                  <span class="px-3 py-1 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-full text-sm">Network Setup</span>
                  <span class="px-3 py-1 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-full text-sm">Security Config</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Phase 4 -->
          <div class="bg-white dark:bg-gray-900 rounded-2xl p-8 border-l-4 border-emerald-600 hover:shadow-xl transition-all" data-aos="fade-right" data-aos-delay="300">
            <div class="flex items-start gap-6">
              <div class="w-16 h-16 bg-gradient-to-br from-emerald-600 to-teal-700 rounded-xl flex items-center justify-center flex-shrink-0">
                <span class="text-2xl font-bold text-white">4</span>
              </div>
              <div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Migration Execution</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-4">
                  Execute phased migration with zero downtime using blue-green or canary deployment strategies.
                </p>
                <div class="flex flex-wrap gap-2">
                  <span class="px-3 py-1 bg-emerald-100 dark:bg-emerald-900 text-emerald-700 dark:text-emerald-300 rounded-full text-sm">Data Migration</span>
                  <span class="px-3 py-1 bg-emerald-100 dark:bg-emerald-900 text-emerald-700 dark:text-emerald-300 rounded-full text-sm">App Deployment</span>
                  <span class="px-3 py-1 bg-emerald-100 dark:bg-emerald-900 text-emerald-700 dark:text-emerald-300 rounded-full text-sm">Zero Downtime</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Phase 5 -->
          <div class="bg-white dark:bg-gray-900 rounded-2xl p-8 border-l-4 border-teal-600 hover:shadow-xl transition-all" data-aos="fade-right" data-aos-delay="400">
            <div class="flex items-start gap-6">
              <div class="w-16 h-16 bg-gradient-to-br from-teal-600 to-emerald-700 rounded-xl flex items-center justify-center flex-shrink-0">
                <span class="text-2xl font-bold text-white">5</span>
              </div>
              <div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Optimization & Support</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-4">
                  Post-migration optimization, performance tuning, and ongoing support to ensure success.
                </p>
                <div class="flex flex-wrap gap-2">
                  <span class="px-3 py-1 bg-teal-100 dark:bg-teal-900 text-teal-700 dark:text-teal-300 rounded-full text-sm">Performance Tuning</span>
                  <span class="px-3 py-1 bg-teal-100 dark:bg-teal-900 text-teal-700 dark:text-teal-300 rounded-full text-sm">Cost Optimization</span>
                  <span class="px-3 py-1 bg-teal-100 dark:bg-teal-900 text-teal-700 dark:text-teal-300 rounded-full text-sm">24/7 Support</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-20 bg-white dark:bg-gray-900">
      <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
          <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">
            Why Choose Our Migration Services
          </h2>
          <p class="text-xl text-gray-600 dark:text-gray-400">
            Expertise that ensures migration success
          </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          <div class="text-center" data-aos="fade-up">
            <div class="w-20 h-20 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
              <i class="fas fa-clock text-white text-3xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Zero Downtime</h3>
            <p class="text-gray-600 dark:text-gray-400">
              100% uptime during migration using advanced techniques
            </p>
          </div>

          <div class="text-center" data-aos="fade-up" data-aos-delay="100">
            <div class="w-20 h-20 bg-gradient-to-br from-teal-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
              <i class="fas fa-shield-alt text-white text-3xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Data Security</h3>
            <p class="text-gray-600 dark:text-gray-400">
              End-to-end encryption and compliance adherence
            </p>
          </div>

          <div class="text-center" data-aos="fade-up" data-aos-delay="200">
            <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
              <i class="fas fa-dollar-sign text-white text-3xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Cost Effective</h3>
            <p class="text-gray-600 dark:text-gray-400">
              Optimize costs during and after migration
            </p>
          </div>

          <div class="text-center" data-aos="fade-up">
            <div class="w-20 h-20 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
              <i class="fas fa-users text-white text-3xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Expert Team</h3>
            <p class="text-gray-600 dark:text-gray-400">
              Certified cloud architects and engineers
            </p>
          </div>

          <div class="text-center" data-aos="fade-up" data-aos-delay="100">
            <div class="w-20 h-20 bg-gradient-to-br from-teal-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
              <i class="fas fa-check-double text-white text-3xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Proven Track Record</h3>
            <p class="text-gray-600 dark:text-gray-400">
              200+ successful migrations completed
            </p>
          </div>

          <div class="text-center" data-aos="fade-up" data-aos-delay="200">
            <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
              <i class="fas fa-headset text-white text-3xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Ongoing Support</h3>
            <p class="text-gray-600 dark:text-gray-400">
              Post-migration support and optimization
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Success Metrics -->
    <section class="py-20 bg-gradient-to-br from-emerald-600 to-teal-600">
      <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
          <h2 class="text-4xl lg:text-5xl font-bold text-white mb-4">
            Migration Success Metrics
          </h2>
          <p class="text-xl text-emerald-50">
            Real results from our recent migrations
          </p>
        </div>

        <div class="grid md:grid-cols-4 gap-8">
          <div class="text-center" data-aos="fade-up">
            <div class="text-5xl font-bold text-white mb-2">200+</div>
            <p class="text-emerald-50">Successful Migrations</p>
          </div>
          <div class="text-center" data-aos="fade-up" data-aos-delay="100">
            <div class="text-5xl font-bold text-white mb-2">100%</div>
            <p class="text-emerald-50">Zero Downtime Rate</p>
          </div>
          <div class="text-center" data-aos="fade-up" data-aos-delay="200">
            <div class="text-5xl font-bold text-white mb-2">45%</div>
            <p class="text-emerald-50">Avg Cost Reduction</p>
          </div>
          <div class="text-center" data-aos="fade-up" data-aos-delay="300">
            <div class="text-5xl font-bold text-white mb-2">6 Weeks</div>
            <p class="text-emerald-50">Average Timeline</p>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="py-20 bg-white dark:bg-gray-900">
      <div class="max-w-4xl mx-auto px-4 text-center" data-aos="fade-up">
        <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-6">
          Ready to Migrate to the Cloud?
        </h2>
        <p class="text-xl text-gray-600 dark:text-gray-400 mb-10">
          Get a free migration assessment and detailed roadmap for your cloud journey
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <button class="px-10 py-5 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-xl font-bold hover:shadow-2xl transform hover:-translate-y-1 transition-all">
            <i class="fas fa-file-alt mr-2"></i>
            Get Free Assessment
          </button>
          <button class="px-10 py-5 bg-white dark:bg-gray-800 text-gray-900 dark:text-white border-2 border-gray-200 dark:border-gray-700 rounded-xl font-bold hover:border-emerald-500 transition-all">
            <i class="fas fa-phone mr-2"></i>
            Talk to an Expert
          </button>
        </div>

        <div class="mt-12 flex justify-center items-center flex-wrap gap-6 text-gray-600 dark:text-gray-400">
          <div class="flex items-center">
            <i class="fas fa-check-circle text-emerald-500 mr-2"></i>
            <span>Free consultation</span>
          </div>
          <div class="flex items-center">
            <i class="fas fa-check-circle text-emerald-500 mr-2"></i>
            <span>No commitment</span>
          </div>
          <div class="flex items-center">
            <i class="fas fa-check-circle text-emerald-500 mr-2"></i>
            <span>Quick turnaround</span>
          </div>
        </div>
      </div>
    </section>

    <DevOpsFooter />
  </div>
</template>

<script>
import { Head } from '@inertiajs/vue3'
import DevOpsHeader from '../Common/Header.vue'
import DevOpsFooter from '../Common/Footer.vue'

export default {
  name: 'MigrationServicesPage',
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

@keyframes fade-in {
  from {
    opacity: 0;
    transform: scale(0.8);
  }
  to {
    opacity: 1;
    transform: scale(1);
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

.animate-fade-in {
  animation: fade-in 1s ease-out forwards;
}

.animate-dash {
  animation: dash 20s linear infinite;
}

.animation-delay-500 {
  animation-delay: 0.5s;
}

.animation-delay-1000 {
  animation-delay: 1s;
}

.animation-delay-1500 {
  animation-delay: 1.5s;
}

.animation-delay-2000 {
  animation-delay: 2s;
}

.animation-delay-4000 {
  animation-delay: 4s;
}
</style>
