<template>
  <div class="bg-white dark:bg-gray-900">
    <Head>
      <title>Career Guidance & Job Placement - DevOps Jungle</title>
      <meta name="description" content="Transform your DevOps career with expert guidance. Resume optimization, interview coaching, salary negotiation, and direct connections to top employers.">
    </Head>

    <DevOpsHeader />

    <!-- Hero with Diagonal Split Design -->
    <section class="relative overflow-hidden min-h-screen flex items-center">
      <!-- Diagonal Background Split -->
      <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-600 via-teal-600 to-green-700 clip-diagonal"></div>
        <div class="absolute inset-0 bg-white dark:bg-gray-900 clip-diagonal-inverse"></div>
      </div>

      <!-- Animated Particles -->
      <div class="absolute inset-0">
        <div class="particle particle-1"></div>
        <div class="particle particle-2"></div>
        <div class="particle particle-3"></div>
        <div class="particle particle-4"></div>
        <div class="particle particle-5"></div>
      </div>

      <div class="max-w-7xl mx-auto px-4 relative z-10 w-full py-20">
        <!-- Breadcrumb -->
        <nav class="mb-12" data-aos="fade-right">
          <ol class="flex items-center space-x-2 text-sm text-white">
            <li><a href="/" class="hover:underline opacity-80">Home</a></li>
            <li><span class="opacity-60">/</span></li>
            <li><a href="/services" class="hover:underline opacity-80">Services</a></li>
            <li><span class="opacity-60">/</span></li>
            <li class="opacity-90">Career Guidance</li>
          </ol>
        </nav>

        <div class="grid lg:grid-cols-2 gap-16 items-center">
          <!-- Left Side - Content -->
          <div class="text-white" data-aos="fade-right">
            <div class="inline-flex items-center px-5 py-2 bg-white/10 backdrop-blur-sm rounded-full mb-6 border border-white/20">
              <i class="fas fa-rocket text-emerald-300 mr-2"></i>
              <span class="text-sm font-semibold">Launch Your Dream Career</span>
            </div>

            <h1 class="text-6xl lg:text-7xl font-black mb-6 leading-tight">
              Navigate Your
              <span class="block text-transparent bg-clip-text bg-gradient-to-r from-emerald-300 via-teal-300 to-green-300">
                DevOps Career
              </span>
              with Confidence
            </h1>

            <p class="text-xl text-emerald-100 mb-8 leading-relaxed">
              From resume optimization to landing six-figure offers, we guide you through every step of your career journey. Get personalized strategies, insider insights, and direct connections to hiring managers at top tech companies.
            </p>

            <div class="flex flex-wrap gap-4 mb-12">
              <button class="px-8 py-4 bg-white text-emerald-600 rounded-2xl font-bold hover:bg-emerald-400 hover:text-white transform hover:scale-105 transition-all duration-200 shadow-xl">
                <i class="fas fa-user-check mr-2"></i>
                Get Started Now
              </button>
              <button class="px-8 py-4 bg-white/10 backdrop-blur-sm text-white rounded-2xl font-bold border-2 border-white/30 hover:bg-white/20 transition-all duration-200">
                <i class="fas fa-video mr-2"></i>
                See Success Stories
              </button>
            </div>

            <!-- Achievement Badges -->
            <div class="flex flex-wrap gap-6">
              <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-emerald-400 rounded-full flex items-center justify-center">
                  <i class="fas fa-trophy text-gray-900 text-xl"></i>
                </div>
                <div>
                  <div class="font-bold text-2xl">95%</div>
                  <div class="text-sm text-emerald-200">Placement Rate</div>
                </div>
              </div>
              <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-teal-400 rounded-full flex items-center justify-center">
                  <i class="fas fa-dollar-sign text-gray-900 text-xl"></i>
                </div>
                <div>
                  <div class="font-bold text-2xl">$120K</div>
                  <div class="text-sm text-emerald-200">Avg. Salary</div>
                </div>
              </div>
              <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-green-400 rounded-full flex items-center justify-center">
                  <i class="fas fa-clock text-gray-900 text-xl"></i>
                </div>
                <div>
                  <div class="font-bold text-2xl">6 Weeks</div>
                  <div class="text-sm text-emerald-200">Avg. Time to Offer</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Right Side - Interactive SVG -->
          <div class="relative" data-aos="fade-left">
            <svg viewBox="0 0 600 600" class="w-full h-full">
              <!-- Career Path Illustration -->
              <!-- Starting Point -->
              <g class="animate-pulse-slow">
                <circle cx="100" cy="500" r="40" fill="url(#startGradient)" opacity="0.9"/>
                <text x="100" y="510" text-anchor="middle" fill="white" font-size="30" font-weight="bold">Start</text>
              </g>

              <!-- Step 1: Resume -->
              <g class="animate-float animation-delay-500">
                <circle cx="200" cy="400" r="50" fill="url(#step1Gradient)"/>
                <text x="200" y="410" text-anchor="middle" font-size="35">📝</text>
                <text x="200" y="340" text-anchor="middle" fill="#065f46" font-size="14" font-weight="bold">Resume</text>
              </g>
              <path d="M 140 480 Q 170 440 160 400" stroke="#34d399" stroke-width="3" stroke-dasharray="5,5" fill="none" class="animate-dash"/>

              <!-- Step 2: Skills -->
              <g class="animate-float animation-delay-1000">
                <circle cx="350" cy="350" r="50" fill="url(#step2Gradient)"/>
                <text x="350" y="360" text-anchor="middle" font-size="35">🎯</text>
                <text x="350" y="290" text-anchor="middle" fill="#065f46" font-size="14" font-weight="bold">Skills</text>
              </g>
              <path d="M 250 390 Q 300 370 300 350" stroke="#2dd4bf" stroke-width="3" stroke-dasharray="5,5" fill="none" class="animate-dash"/>

              <!-- Step 3: Interview -->
              <g class="animate-float animation-delay-1500">
                <circle cx="450" cy="250" r="50" fill="url(#step3Gradient)"/>
                <text x="450" y="260" text-anchor="middle" font-size="35">💼</text>
                <text x="450" y="190" text-anchor="middle" fill="#065f46" font-size="14" font-weight="bold">Interview</text>
              </g>
              <path d="M 400 340 Q 425 295 425 250" stroke="#4ade80" stroke-width="3" stroke-dasharray="5,5" fill="none" class="animate-dash"/>

              <!-- Step 4: Offer -->
              <g class="animate-float animation-delay-2000">
                <circle cx="500" cy="120" r="55" fill="url(#step4Gradient)"/>
                <text x="500" y="130" text-anchor="middle" font-size="35">🎉</text>
                <text x="500" y="60" text-anchor="middle" fill="#065f46" font-size="14" font-weight="bold">Job Offer!</text>
              </g>
              <path d="M 480 200 Q 490 160 490 120" stroke="#fbbf24" stroke-width="3" stroke-dasharray="5,5" fill="none" class="animate-dash"/>

              <!-- Success Stars -->
              <g class="animate-twinkle">
                <circle cx="520" cy="80" r="3" fill="#fbbf24"/>
                <circle cx="540" cy="100" r="2" fill="#fbbf24"/>
                <circle cx="560" cy="70" r="2.5" fill="#fbbf24"/>
              </g>

              <!-- Gradients -->
              <defs>
                <linearGradient id="startGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                  <stop offset="0%" style="stop-color:#059669;stop-opacity:1"/>
                  <stop offset="100%" style="stop-color:#047857;stop-opacity:1"/>
                </linearGradient>
                <linearGradient id="step1Gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                  <stop offset="0%" style="stop-color:#34d399;stop-opacity:0.8"/>
                  <stop offset="100%" style="stop-color:#10b981;stop-opacity:0.9"/>
                </linearGradient>
                <linearGradient id="step2Gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                  <stop offset="0%" style="stop-color:#2dd4bf;stop-opacity:0.8"/>
                  <stop offset="100%" style="stop-color:#14b8a6;stop-opacity:0.9"/>
                </linearGradient>
                <linearGradient id="step3Gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                  <stop offset="0%" style="stop-color:#4ade80;stop-opacity:0.8"/>
                  <stop offset="100%" style="stop-color:#22c55e;stop-opacity:0.9"/>
                </linearGradient>
                <linearGradient id="step4Gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                  <stop offset="0%" style="stop-color:#fbbf24;stop-opacity:1"/>
                  <stop offset="100%" style="stop-color:#f59e0b;stop-opacity:1"/>
                </linearGradient>
              </defs>
            </svg>
          </div>
        </div>
      </div>
    </section>

    <!-- What's Included - Card Stack Layout -->
    <section class="py-24 bg-gray-50 dark:bg-gray-800 relative overflow-hidden">
      <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-20" data-aos="fade-up">
          <h2 class="text-5xl lg:text-6xl font-black text-gray-900 dark:text-white mb-6">
            Everything You Need to
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-600"> Land Your Dream Job</span>
          </h2>
          <p class="text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
            Our comprehensive program covers every aspect of your job search journey
          </p>
        </div>

        <!-- Staggered Card Layout -->
        <div class="space-y-8">
          <!-- Card 1 - Resume & LinkedIn -->
          <div class="grid lg:grid-cols-2 gap-8 items-center" data-aos="fade-right">
            <div class="order-2 lg:order-1">
              <div class="bg-white dark:bg-gray-900 rounded-3xl p-10 shadow-2xl border-4 border-emerald-500 transform hover:scale-105 transition-all duration-300">
                <div class="flex items-start space-x-6">
                  <div class="flex-shrink-0">
                    <div class="w-20 h-20 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center transform -rotate-6">
                      <i class="fas fa-file-alt text-white text-3xl"></i>
                    </div>
                  </div>
                  <div>
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Resume & LinkedIn Optimization</h3>
                    <p class="text-lg text-gray-600 dark:text-gray-400 mb-6">
                      Transform your resume from invisible to irresistible. We rewrite your resume using ATS-friendly formats and industry-proven keywords that get past automated filters and land on hiring managers' desks.
                    </p>
                    <ul class="space-y-3">
                      <li class="flex items-start">
                        <i class="fas fa-check-circle text-emerald-500 mr-3 mt-1"></i>
                        <span class="text-gray-700 dark:text-gray-300">ATS-optimized formatting for 95%+ scan success rate</span>
                      </li>
                      <li class="flex items-start">
                        <i class="fas fa-check-circle text-emerald-500 mr-3 mt-1"></i>
                        <span class="text-gray-700 dark:text-gray-300">Achievement-focused bullet points with quantified results</span>
                      </li>
                      <li class="flex items-start">
                        <i class="fas fa-check-circle text-emerald-500 mr-3 mt-1"></i>
                        <span class="text-gray-700 dark:text-gray-300">LinkedIn profile revamp to attract recruiters</span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="order-1 lg:order-2" data-aos="fade-left">
              <div class="text-6xl text-center">📄✨</div>
            </div>
          </div>

          <!-- Card 2 - Portfolio & Projects -->
          <div class="grid lg:grid-cols-2 gap-8 items-center" data-aos="fade-left">
            <div data-aos="fade-right">
              <div class="text-6xl text-center">🚀💼</div>
            </div>
            <div>
              <div class="bg-white dark:bg-gray-900 rounded-3xl p-10 shadow-2xl border-4 border-teal-500 transform hover:scale-105 transition-all duration-300">
                <div class="flex items-start space-x-6">
                  <div class="flex-shrink-0">
                    <div class="w-20 h-20 bg-gradient-to-br from-teal-500 to-emerald-600 rounded-2xl flex items-center justify-center transform rotate-6">
                      <i class="fas fa-laptop-code text-white text-3xl"></i>
                    </div>
                  </div>
                  <div>
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Portfolio Project Development</h3>
                    <p class="text-lg text-gray-600 dark:text-gray-400 mb-6">
                      Stand out with a portfolio that showcases real DevOps expertise. We guide you in building production-grade projects that demonstrate your skills to employers.
                    </p>
                    <ul class="space-y-3">
                      <li class="flex items-start">
                        <i class="fas fa-check-circle text-teal-500 mr-3 mt-1"></i>
                        <span class="text-gray-700 dark:text-gray-300">CI/CD pipeline projects with GitHub Actions & Jenkins</span>
                      </li>
                      <li class="flex items-start">
                        <i class="fas fa-check-circle text-teal-500 mr-3 mt-1"></i>
                        <span class="text-gray-700 dark:text-gray-300">Infrastructure as Code with Terraform & CloudFormation</span>
                      </li>
                      <li class="flex items-start">
                        <i class="fas fa-check-circle text-teal-500 mr-3 mt-1"></i>
                        <span class="text-gray-700 dark:text-gray-300">Kubernetes deployment & monitoring demonstrations</span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Card 3 - Interview Mastery -->
          <div class="grid lg:grid-cols-2 gap-8 items-center" data-aos="fade-right">
            <div class="order-2 lg:order-1">
              <div class="bg-white dark:bg-gray-900 rounded-3xl p-10 shadow-2xl border-4 border-green-500 transform hover:scale-105 transition-all duration-300">
                <div class="flex items-start space-x-6">
                  <div class="flex-shrink-0">
                    <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center transform -rotate-6">
                      <i class="fas fa-comments text-white text-3xl"></i>
                    </div>
                  </div>
                  <div>
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Interview Mastery Program</h3>
                    <p class="text-lg text-gray-600 dark:text-gray-400 mb-6">
                      Walk into interviews with unshakeable confidence. Practice with real interview questions, receive detailed feedback, and learn to articulate your value proposition like a pro.
                    </p>
                    <ul class="space-y-3">
                      <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mr-3 mt-1"></i>
                        <span class="text-gray-700 dark:text-gray-300">Mock interviews with detailed feedback & recordings</span>
                      </li>
                      <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mr-3 mt-1"></i>
                        <span class="text-gray-700 dark:text-gray-300">Technical & behavioral question bank with answers</span>
                      </li>
                      <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mr-3 mt-1"></i>
                        <span class="text-gray-700 dark:text-gray-300">STAR method framework for behavioral questions</span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="order-1 lg:order-2" data-aos="fade-left">
              <div class="text-6xl text-center">🎤💪</div>
            </div>
          </div>

          <!-- Card 4 - Salary Negotiation -->
          <div class="grid lg:grid-cols-2 gap-8 items-center" data-aos="fade-left">
            <div data-aos="fade-right">
              <div class="text-6xl text-center">💰🤝</div>
            </div>
            <div>
              <div class="bg-white dark:bg-gray-900 rounded-3xl p-10 shadow-2xl border-4 border-green-500 transform hover:scale-105 transition-all duration-300">
                <div class="flex items-start space-x-6">
                  <div class="flex-shrink-0">
                    <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center transform rotate-6">
                      <i class="fas fa-chart-line text-white text-3xl"></i>
                    </div>
                  </div>
                  <div>
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Salary Negotiation Coaching</h3>
                    <p class="text-lg text-gray-600 dark:text-gray-400 mb-6">
                      Don't leave money on the table. Learn proven negotiation tactics to secure offers $20K-$40K higher than initial proposals. Our clients average 30% higher salaries.
                    </p>
                    <ul class="space-y-3">
                      <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mr-3 mt-1"></i>
                        <span class="text-gray-700 dark:text-gray-300">Market research & salary benchmarking for your role</span>
                      </li>
                      <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mr-3 mt-1"></i>
                        <span class="text-gray-700 dark:text-gray-300">Negotiation scripts & counter-offer strategies</span>
                      </li>
                      <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mr-3 mt-1"></i>
                        <span class="text-gray-700 dark:text-gray-300">Benefits package evaluation & equity negotiation</span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Success Stories Slider -->
    <section class="py-24 bg-gradient-to-br from-emerald-600 via-teal-600 to-green-700 relative overflow-hidden">
      <div class="absolute inset-0 opacity-10 pattern-dots"></div>

      <div class="max-w-7xl mx-auto px-4 relative z-10">
        <div class="text-center mb-16" data-aos="fade-up">
          <h2 class="text-5xl font-black text-white mb-4">Real Results, Real People</h2>
          <p class="text-xl text-emerald-100">See how we've transformed careers</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
          <!-- Testimonial 1 -->
          <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 border border-white/20" data-aos="fade-up">
            <div class="flex items-center mb-6">
              <div class="w-16 h-16 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full flex items-center justify-center text-2xl mr-4">
                👨‍💻
              </div>
              <div>
                <div class="font-bold text-white text-lg">Sarah Chen</div>
                <div class="text-teal-200 text-sm">Junior Dev → Senior DevOps at AWS</div>
              </div>
            </div>
            <div class="text-yellow-400 mb-3">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <p class="text-white/90 italic">
              "Went from $75K to $145K in 8 weeks! The interview prep was game-changing. I felt confident in every conversation and landed 3 offers."
            </p>
          </div>

          <!-- Testimonial 2 -->
          <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 border border-white/20" data-aos="fade-up" data-aos-delay="100">
            <div class="flex items-center mb-6">
              <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-emerald-500 rounded-full flex items-center justify-center text-2xl mr-4">
                👨‍🔧
              </div>
              <div>
                <div class="font-bold text-white text-lg">Marcus Johnson</div>
                <div class="text-teal-200 text-sm">SysAdmin → DevOps Lead at Netflix</div>
              </div>
            </div>
            <div class="text-yellow-400 mb-3">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <p class="text-white/90 italic">
              "The portfolio projects made all the difference. Recruiters actually reached out to ME after seeing my GitHub. Best investment ever!"
            </p>
          </div>

          <!-- Testimonial 3 -->
          <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 border border-white/20" data-aos="fade-up" data-aos-delay="200">
            <div class="flex items-center mb-6">
              <div class="w-16 h-16 bg-gradient-to-br from-pink-400 to-purple-500 rounded-full flex items-center justify-center text-2xl mr-4">
                👩‍💼
              </div>
              <div>
                <div class="font-bold text-white text-lg">Priya Patel</div>
                <div class="text-teal-200 text-sm">Career Switcher → DevOps at Google</div>
              </div>
            </div>
            <div class="text-yellow-400 mb-3">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <p class="text-white/90 italic">
              "Coming from a non-tech background, I was lost. The career guidance gave me a clear path and now I'm at my dream company!"
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Pricing - Comparison Table -->
    <section class="py-24 bg-white dark:bg-gray-900">
      <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
          <h2 class="text-5xl font-black text-gray-900 dark:text-white mb-4">
            Investment in Your Future
          </h2>
          <p class="text-xl text-gray-600 dark:text-gray-400">
            Choose the package that matches your career goals
          </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
          <!-- Essential Package -->
          <div class="bg-gray-50 dark:bg-gray-800 rounded-2xl p-8 border-2 border-gray-200 dark:border-gray-700" data-aos="fade-up">
            <div class="text-center mb-8">
              <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Essential</h3>
              <div class="text-5xl font-black text-gray-900 dark:text-white mb-2">$999</div>
              <p class="text-gray-600 dark:text-gray-400">One-time payment</p>
            </div>
            <ul class="space-y-4 mb-8">
              <li class="flex items-start">
                <i class="fas fa-check text-emerald-500 mr-3 mt-1"></i>
                <span class="text-gray-700 dark:text-gray-300">Resume & LinkedIn optimization</span>
              </li>
              <li class="flex items-start">
                <i class="fas fa-check text-emerald-500 mr-3 mt-1"></i>
                <span class="text-gray-700 dark:text-gray-300">2 mock interview sessions</span>
              </li>
              <li class="flex items-start">
                <i class="fas fa-check text-emerald-500 mr-3 mt-1"></i>
                <span class="text-gray-700 dark:text-gray-300">Job search strategy guide</span>
              </li>
              <li class="flex items-start">
                <i class="fas fa-check text-emerald-500 mr-3 mt-1"></i>
                <span class="text-gray-700 dark:text-gray-300">30 days email support</span>
              </li>
            </ul>
            <button class="w-full py-4 bg-gray-800 dark:bg-gray-700 text-white rounded-xl font-bold hover:bg-gray-700 dark:hover:bg-gray-600 transition-all">
              Get Started
            </button>
          </div>

          <!-- Professional Package (Popular) -->
          <div class="bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl p-8 border-4 border-yellow-400 transform scale-105 relative" data-aos="fade-up" data-aos-delay="100">
            <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 px-6 py-2 bg-yellow-400 text-gray-900 rounded-full text-sm font-black">
              MOST POPULAR
            </div>
            <div class="text-center mb-8">
              <h3 class="text-2xl font-bold text-white mb-2">Professional</h3>
              <div class="text-5xl font-black text-white mb-2">$1,999</div>
              <p class="text-emerald-100">Best Value</p>
            </div>
            <ul class="space-y-4 mb-8">
              <li class="flex items-start">
                <i class="fas fa-check text-yellow-400 mr-3 mt-1"></i>
                <span class="text-white">Everything in Essential, plus:</span>
              </li>
              <li class="flex items-start">
                <i class="fas fa-check text-yellow-400 mr-3 mt-1"></i>
                <span class="text-white">Portfolio project development</span>
              </li>
              <li class="flex items-start">
                <i class="fas fa-check text-yellow-400 mr-3 mt-1"></i>
                <span class="text-white">6 mock interview sessions</span>
              </li>
              <li class="flex items-start">
                <i class="fas fa-check text-yellow-400 mr-3 mt-1"></i>
                <span class="text-white">Salary negotiation coaching</span>
              </li>
              <li class="flex items-start">
                <i class="fas fa-check text-yellow-400 mr-3 mt-1"></i>
                <span class="text-white">Direct recruiter introductions</span>
              </li>
              <li class="flex items-start">
                <i class="fas fa-check text-yellow-400 mr-3 mt-1"></i>
                <span class="text-white">90 days support</span>
              </li>
            </ul>
            <button class="w-full py-4 bg-yellow-400 text-gray-900 rounded-xl font-black hover:bg-yellow-300 transition-all">
              Get Started Now
            </button>
          </div>

          <!-- Enterprise Package -->
          <div class="bg-gray-50 dark:bg-gray-800 rounded-2xl p-8 border-2 border-gray-200 dark:border-gray-700" data-aos="fade-up" data-aos-delay="200">
            <div class="text-center mb-8">
              <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Executive</h3>
              <div class="text-5xl font-black text-gray-900 dark:text-white mb-2">$3,999</div>
              <p class="text-gray-600 dark:text-gray-400">Premium experience</p>
            </div>
            <ul class="space-y-4 mb-8">
              <li class="flex items-start">
                <i class="fas fa-check text-emerald-500 mr-3 mt-1"></i>
                <span class="text-gray-700 dark:text-gray-300">Everything in Professional, plus:</span>
              </li>
              <li class="flex items-start">
                <i class="fas fa-check text-emerald-500 mr-3 mt-1"></i>
                <span class="text-gray-700 dark:text-gray-300">Unlimited mock interviews</span>
              </li>
              <li class="flex items-start">
                <i class="fas fa-check text-emerald-500 mr-3 mt-1"></i>
                <span class="text-gray-700 dark:text-gray-300">Personal career coach</span>
              </li>
              <li class="flex items-start">
                <i class="fas fa-check text-emerald-500 mr-3 mt-1"></i>
                <span class="text-gray-700 dark:text-gray-300">C-level interview prep</span>
              </li>
              <li class="flex items-start">
                <i class="fas fa-check text-emerald-500 mr-3 mt-1"></i>
                <span class="text-gray-700 dark:text-gray-300">6 months support</span>
              </li>
              <li class="flex items-start">
                <i class="fas fa-check text-emerald-500 mr-3 mt-1"></i>
                <span class="text-gray-700 dark:text-gray-300">Job placement guarantee</span>
              </li>
            </ul>
            <button class="w-full py-4 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-xl font-bold hover:shadow-lg transition-all">
              Get Started
            </button>
          </div>
        </div>

        <div class="text-center mt-12" data-aos="fade-up">
          <p class="text-gray-600 dark:text-gray-400 mb-4">
            <i class="fas fa-shield-alt text-green-500 mr-2"></i>
            30-day money-back guarantee • No questions asked
          </p>
        </div>
      </div>
    </section>

    <!-- Final CTA -->
    <section class="py-20 bg-gradient-to-r from-emerald-600 to-teal-600">
      <div class="max-w-4xl mx-auto px-4 text-center" data-aos="fade-up">
        <h2 class="text-5xl font-black text-white mb-6">
          Your Dream Job is Waiting
        </h2>
        <p class="text-2xl text-emerald-100 mb-10">
          Stop applying. Start getting hired.
        </p>
        <button class="px-12 py-6 bg-yellow-400 text-gray-900 rounded-2xl font-black text-xl hover:bg-yellow-300 transform hover:scale-105 transition-all shadow-2xl">
          <i class="fas fa-rocket mr-3"></i>
          Launch My Career Now
        </button>
        <p class="text-emerald-100 mt-6">
          <i class="fas fa-users mr-2"></i>
          Join 1,247 professionals who landed their dream jobs this year
        </p>
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
  name: 'CareerGuidancePage',
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
.clip-diagonal {
  clip-path: polygon(0 0, 70% 0, 50% 100%, 0% 100%);
}

.clip-diagonal-inverse {
  clip-path: polygon(70% 0, 100% 0, 100% 100%, 50% 100%);
}

@keyframes float {
  0%, 100% {
    transform: translateY(0px);
  }
  50% {
    transform: translateY(-30px);
  }
}

@keyframes pulse-slow {
  0%, 100% {
    opacity: 1;
    transform: scale(1);
  }
  50% {
    opacity: 0.7;
    transform: scale(1.1);
  }
}

@keyframes dash {
  to {
    stroke-dashoffset: -100;
  }
}

@keyframes twinkle {
  0%, 100% {
    opacity: 1;
    transform: scale(1);
  }
  50% {
    opacity: 0.3;
    transform: scale(0.8);
  }
}

@keyframes particle-float {
  0%, 100% {
    transform: translate(0, 0);
  }
  50% {
    transform: translate(var(--tx), var(--ty));
  }
}

.particle {
  position: absolute;
  width: 4px;
  height: 4px;
  background: rgba(255, 255, 255, 0.5);
  border-radius: 50%;
  animation: particle-float 15s infinite ease-in-out;
}

.particle-1 {
  top: 20%;
  left: 10%;
  --tx: 30px;
  --ty: -40px;
  animation-delay: 0s;
}

.particle-2 {
  top: 40%;
  left: 30%;
  --tx: -20px;
  --ty: 30px;
  animation-delay: 2s;
}

.particle-3 {
  top: 60%;
  left: 50%;
  --tx: 40px;
  --ty: -20px;
  animation-delay: 4s;
}

.particle-4 {
  top: 30%;
  left: 70%;
  --tx: -30px;
  --ty: 40px;
  animation-delay: 1s;
}

.particle-5 {
  top: 80%;
  left: 20%;
  --tx: 20px;
  --ty: -30px;
  animation-delay: 3s;
}

.animate-float {
  animation: float 8s ease-in-out infinite;
}

.animate-pulse-slow {
  animation: pulse-slow 3s ease-in-out infinite;
}

.animate-dash {
  animation: dash 20s linear infinite;
}

.animate-twinkle {
  animation: twinkle 2s ease-in-out infinite;
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

.pattern-dots {
  background-image: radial-gradient(circle, rgba(255, 255, 255, 0.15) 1px, transparent 1px);
  background-size: 20px 20px;
}
</style>
