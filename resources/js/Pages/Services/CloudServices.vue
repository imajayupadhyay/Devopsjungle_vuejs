<template>
  <div class="bg-white dark:bg-gray-900">
    <Head>
      <title>Cloud Services - Multi-Cloud Solutions & Architecture | DevOps Jungle</title>
      <meta name="description" content="Expert cloud architecture, deployment, and management across AWS, Azure, and GCP. Scalable, secure, and cost-optimized cloud infrastructure solutions.">
    </Head>

    <DevOpsHeader />

    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-gradient-to-br from-cyan-50 via-teal-50 to-emerald-50 dark:from-gray-900 dark:via-cyan-950 dark:to-gray-900 py-20 lg:py-32">
      <!-- Animated Background -->
      <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-20 left-10 w-96 h-96 bg-cyan-300/20 dark:bg-cyan-500/10 rounded-full blur-3xl animate-blob"></div>
        <div class="absolute top-40 right-10 w-96 h-96 bg-teal-300/20 dark:bg-teal-500/10 rounded-full blur-3xl animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-20 left-1/3 w-96 h-96 bg-emerald-300/20 dark:bg-emerald-500/10 rounded-full blur-3xl animate-blob animation-delay-4000"></div>
      </div>

      <div class="max-w-7xl mx-auto px-4 relative z-10">
        <!-- Breadcrumb -->
        <nav class="mb-8" data-aos="fade-right">
          <ol class="flex items-center space-x-2 text-sm">
            <li><a href="/" class="text-emerald-600 dark:text-emerald-400 hover:underline">Home</a></li>
            <li><span class="text-gray-400">/</span></li>
            <li><a href="/services" class="text-emerald-600 dark:text-emerald-400 hover:underline">Services</a></li>
            <li><span class="text-gray-400">/</span></li>
            <li class="text-gray-600 dark:text-gray-400">Cloud Services</li>
          </ol>
        </nav>

        <div class="grid lg:grid-cols-2 gap-12 items-center">
          <!-- Left Content -->
          <div data-aos="fade-right">
            <div class="inline-flex items-center px-4 py-2 bg-cyan-100 dark:bg-cyan-900/30 rounded-full mb-6">
              <i class="fas fa-cloud text-teal-500 mr-2"></i>
              <span class="text-sm font-medium text-cyan-800 dark:text-cyan-300">Multi-Cloud Expertise</span>
            </div>

            <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 dark:text-white mb-6 leading-tight">
              Enterprise
              <span class="block bg-gradient-to-r from-emerald-600 to-teal-600 dark:from-emerald-400 dark:to-teal-400 bg-clip-text text-transparent">
                Cloud Solutions
              </span>
              at Scale
            </h1>

            <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 leading-relaxed">
              Build, deploy, and manage robust cloud infrastructure across AWS, Azure, and GCP. From architecture design to ongoing optimization, we handle your entire cloud journey.
            </p>

            <div class="flex flex-wrap gap-4 mb-8">
              <button class="px-8 py-4 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-emerald-500/50 transform hover:-translate-y-1 transition-all duration-200">
                <i class="fas fa-rocket mr-2"></i>
                Get Started
              </button>
              <button class="px-8 py-4 bg-white dark:bg-gray-800 text-gray-800 dark:text-white rounded-xl font-semibold border-2 border-gray-200 dark:border-gray-700 hover:border-emerald-500 transition-all duration-200">
                <i class="fas fa-calendar-check mr-2"></i>
                Schedule Consultation
              </button>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-3 gap-6">
              <div>
                <div class="text-3xl font-bold text-gray-900 dark:text-white">250+</div>
                <div class="text-sm text-gray-600 dark:text-gray-400">Deployments</div>
              </div>
              <div>
                <div class="text-3xl font-bold text-gray-900 dark:text-white">99.9%</div>
                <div class="text-sm text-gray-600 dark:text-gray-400">Uptime SLA</div>
              </div>
              <div>
                <div class="text-3xl font-bold text-gray-900 dark:text-white">40%</div>
                <div class="text-sm text-gray-600 dark:text-gray-400">Cost Savings</div>
              </div>
            </div>
          </div>

          <!-- Right Illustration - Cloud Platforms -->
          <div class="relative" data-aos="fade-left">
            <div class="relative w-full h-[500px]">
              <svg viewBox="0 0 500 500" class="w-full h-full">
                <!-- Central Cloud -->
                <g class="animate-float">
                  <ellipse cx="250" cy="250" rx="120" ry="80" fill="url(#cloudGradient)" opacity="0.9"/>
                  <ellipse cx="190" cy="230" rx="90" ry="60" fill="url(#cloudGradient)" opacity="0.95"/>
                  <ellipse cx="310" cy="230" rx="90" ry="60" fill="url(#cloudGradient)" opacity="0.95"/>
                  <text x="250" y="260" text-anchor="middle" fill="white" font-size="20" font-weight="bold">Cloud</text>
                </g>

                <!-- AWS -->
                <g class="animate-pulse-slow">
                  <circle cx="150" cy="150" r="50" fill="url(#awsGradient)" opacity="0.9"/>
                  <text x="150" y="155" text-anchor="middle" fill="white" font-size="16" font-weight="bold">AWS</text>
                </g>

                <!-- Azure -->
                <g class="animate-pulse-slow animation-delay-1000">
                  <circle cx="350" cy="150" r="50" fill="url(#azureGradient)" opacity="0.9"/>
                  <text x="350" y="155" text-anchor="middle" fill="white" font-size="16" font-weight="bold">Azure</text>
                </g>

                <!-- GCP -->
                <g class="animate-pulse-slow animation-delay-2000">
                  <circle cx="250" cy="400" r="50" fill="url(#gcpGradient)" opacity="0.9"/>
                  <text x="250" y="405" text-anchor="middle" fill="white" font-size="16" font-weight="bold">GCP</text>
                </g>

                <!-- Connecting Lines -->
                <g stroke="url(#lineGradient)" stroke-width="3" opacity="0.5" class="animate-dash">
                  <line x1="180" y1="180" x2="220" y2="220"/>
                  <line x1="320" y1="180" x2="280" y2="220"/>
                  <line x1="250" y1="330" x2="250" y2="360"/>
                </g>

                <!-- Gradients -->
                <defs>
                  <linearGradient id="cloudGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" style="stop-color:#10b981;stop-opacity:1"/>
                    <stop offset="100%" style="stop-color:#14b8a6;stop-opacity:1"/>
                  </linearGradient>
                  <radialGradient id="awsGradient">
                    <stop offset="0%" style="stop-color:#06b6d4;stop-opacity:1"/>
                    <stop offset="100%" style="stop-color:#0891b2;stop-opacity:1"/>
                  </radialGradient>
                  <radialGradient id="azureGradient">
                    <stop offset="0%" style="stop-color:#14b8a6;stop-opacity:1"/>
                    <stop offset="100%" style="stop-color:#0d9488;stop-opacity:1"/>
                  </radialGradient>
                  <radialGradient id="gcpGradient">
                    <stop offset="0%" style="stop-color:#10b981;stop-opacity:1"/>
                    <stop offset="100%" style="stop-color:#059669;stop-opacity:1"/>
                  </radialGradient>
                  <linearGradient id="lineGradient">
                    <stop offset="0%" style="stop-color:#10b981;stop-opacity:0.6"/>
                    <stop offset="100%" style="stop-color:#14b8a6;stop-opacity:0.6"/>
                  </linearGradient>
                </defs>
              </svg>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Cloud Platforms -->
    <section class="py-20 bg-white dark:bg-gray-900">
      <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
          <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">
            Multi-Cloud Platform Expertise
          </h2>
          <p class="text-xl text-gray-600 dark:text-gray-400">
            We architect and manage solutions across all major cloud providers
          </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
          <!-- AWS -->
          <div class="group relative bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 border-2 border-gray-100 dark:border-gray-700 hover:border-cyan-500 transition-all duration-300 hover:shadow-xl hover:-translate-y-2" data-aos="fade-up">
            <div class="text-6xl mb-6 text-center">☁️</div>
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4 text-center">Amazon Web Services</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-6 text-center">
              Complete AWS solutions from EC2 to serverless architectures
            </p>
            <div class="space-y-2">
              <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <i class="fas fa-check-circle text-cyan-500 mr-2"></i>
                EC2, Lambda, ECS/EKS
              </div>
              <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <i class="fas fa-check-circle text-cyan-500 mr-2"></i>
                RDS, DynamoDB, S3
              </div>
              <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <i class="fas fa-check-circle text-cyan-500 mr-2"></i>
                CloudFormation & CDK
              </div>
            </div>
          </div>

          <!-- Azure -->
          <div class="group relative bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 border-2 border-gray-100 dark:border-gray-700 hover:border-teal-500 transition-all duration-300 hover:shadow-xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
            <div class="text-6xl mb-6 text-center">⛅</div>
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4 text-center">Microsoft Azure</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-6 text-center">
              Enterprise Azure deployments with hybrid cloud solutions
            </p>
            <div class="space-y-2">
              <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <i class="fas fa-check-circle text-teal-500 mr-2"></i>
                Azure VMs, App Services
              </div>
              <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <i class="fas fa-check-circle text-teal-500 mr-2"></i>
                Azure DevOps & AKS
              </div>
              <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <i class="fas fa-check-circle text-teal-500 mr-2"></i>
                ARM Templates & Bicep
              </div>
            </div>
          </div>

          <!-- GCP -->
          <div class="group relative bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 border-2 border-gray-100 dark:border-gray-700 hover:border-emerald-500 transition-all duration-300 hover:shadow-xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
            <div class="text-6xl mb-6 text-center">🌥️</div>
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4 text-center">Google Cloud Platform</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-6 text-center">
              Modern GCP infrastructure with ML/AI integration
            </p>
            <div class="space-y-2">
              <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <i class="fas fa-check-circle text-emerald-500 mr-2"></i>
                Compute Engine, GKE
              </div>
              <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <i class="fas fa-check-circle text-emerald-500 mr-2"></i>
                Cloud Functions, BigQuery
              </div>
              <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <i class="fas fa-check-circle text-emerald-500 mr-2"></i>
                Deployment Manager
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Our Services -->
    <section class="py-20 bg-gray-50 dark:bg-gray-800">
      <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
          <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">
            Comprehensive Cloud Services
          </h2>
          <p class="text-xl text-gray-600 dark:text-gray-400">
            End-to-end cloud solutions tailored to your business needs
          </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          <!-- Service 1 -->
          <div class="bg-white dark:bg-gray-900 rounded-2xl p-8 border border-gray-200 dark:border-gray-700 hover:border-emerald-500 transition-all hover:shadow-xl" data-aos="fade-up">
            <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center mb-6">
              <i class="fas fa-drafting-compass text-white text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Cloud Architecture Design</h3>
            <p class="text-gray-600 dark:text-gray-400">
              Custom cloud architecture designed for scalability, security, and cost-efficiency.
            </p>
          </div>

          <!-- Service 2 -->
          <div class="bg-white dark:bg-gray-900 rounded-2xl p-8 border border-gray-200 dark:border-gray-700 hover:border-emerald-500 transition-all hover:shadow-xl" data-aos="fade-up" data-aos-delay="100">
            <div class="w-16 h-16 bg-gradient-to-br from-teal-500 to-emerald-600 rounded-2xl flex items-center justify-center mb-6">
              <i class="fas fa-server text-white text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Infrastructure Deployment</h3>
            <p class="text-gray-600 dark:text-gray-400">
              Automated infrastructure provisioning using Terraform and CloudFormation.
            </p>
          </div>

          <!-- Service 3 -->
          <div class="bg-white dark:bg-gray-900 rounded-2xl p-8 border border-gray-200 dark:border-gray-700 hover:border-emerald-500 transition-all hover:shadow-xl" data-aos="fade-up" data-aos-delay="200">
            <div class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-teal-600 rounded-2xl flex items-center justify-center mb-6">
              <i class="fas fa-shield-alt text-white text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Security & Compliance</h3>
            <p class="text-gray-600 dark:text-gray-400">
              Enterprise-grade security with compliance frameworks (SOC2, HIPAA, PCI-DSS).
            </p>
          </div>

          <!-- Service 4 -->
          <div class="bg-white dark:bg-gray-900 rounded-2xl p-8 border border-gray-200 dark:border-gray-700 hover:border-emerald-500 transition-all hover:shadow-xl" data-aos="fade-up">
            <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-green-600 rounded-2xl flex items-center justify-center mb-6">
              <i class="fas fa-chart-line text-white text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Cost Optimization</h3>
            <p class="text-gray-600 dark:text-gray-400">
              Reduce cloud spend by 30-50% through resource optimization and right-sizing.
            </p>
          </div>

          <!-- Service 5 -->
          <div class="bg-white dark:bg-gray-900 rounded-2xl p-8 border border-gray-200 dark:border-gray-700 hover:border-emerald-500 transition-all hover:shadow-xl" data-aos="fade-up" data-aos-delay="100">
            <div class="w-16 h-16 bg-gradient-to-br from-teal-500 to-cyan-600 rounded-2xl flex items-center justify-center mb-6">
              <i class="fas fa-heartbeat text-white text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">24/7 Monitoring & Support</h3>
            <p class="text-gray-600 dark:text-gray-400">
              Proactive monitoring with instant alerts and round-the-clock support.
            </p>
          </div>

          <!-- Service 6 -->
          <div class="bg-white dark:bg-gray-900 rounded-2xl p-8 border border-gray-200 dark:border-gray-700 hover:border-emerald-500 transition-all hover:shadow-xl" data-aos="fade-up" data-aos-delay="200">
            <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mb-6">
              <i class="fas fa-sync-alt text-white text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Disaster Recovery & Backup</h3>
            <p class="text-gray-600 dark:text-gray-400">
              Automated backups and disaster recovery planning for business continuity.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Case Study -->
    <section class="py-20 bg-white dark:bg-gray-900">
      <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
          <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">
            Success Stories
          </h2>
          <p class="text-xl text-gray-600 dark:text-gray-400">
            Real results from our cloud transformation projects
          </p>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
          <!-- Case Study 1 -->
          <div class="bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-950 dark:to-teal-950 rounded-2xl p-10 border-2 border-emerald-200 dark:border-emerald-800" data-aos="fade-up">
            <div class="flex items-center mb-6">
              <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center text-3xl mr-4">
                🏢
              </div>
              <div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">E-Commerce Platform</h3>
                <p class="text-gray-600 dark:text-gray-400">15M monthly users</p>
              </div>
            </div>
            <div class="space-y-4">
              <div class="flex items-center justify-between">
                <span class="text-gray-700 dark:text-gray-300">Infrastructure Cost</span>
                <span class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">-42%</span>
              </div>
              <div class="flex items-center justify-between">
                <span class="text-gray-700 dark:text-gray-300">Page Load Time</span>
                <span class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">-65%</span>
              </div>
              <div class="flex items-center justify-between">
                <span class="text-gray-700 dark:text-gray-300">Deployment Speed</span>
                <span class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">8x Faster</span>
              </div>
            </div>
            <p class="mt-6 text-gray-700 dark:text-gray-300 italic">
              "Migrated from on-premise to AWS with zero downtime. Their auto-scaling solution handles our Black Friday traffic effortlessly."
            </p>
          </div>

          <!-- Case Study 2 -->
          <div class="bg-gradient-to-br from-cyan-50 to-teal-50 dark:from-cyan-950 dark:to-teal-950 rounded-2xl p-10 border-2 border-cyan-200 dark:border-cyan-800" data-aos="fade-up" data-aos-delay="100">
            <div class="flex items-center mb-6">
              <div class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-teal-600 rounded-xl flex items-center justify-center text-3xl mr-4">
                🏥
              </div>
              <div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Healthcare SaaS</h3>
                <p class="text-gray-600 dark:text-gray-400">HIPAA Compliant</p>
              </div>
            </div>
            <div class="space-y-4">
              <div class="flex items-center justify-between">
                <span class="text-gray-700 dark:text-gray-300">System Uptime</span>
                <span class="text-2xl font-bold text-cyan-600 dark:text-cyan-400">99.99%</span>
              </div>
              <div class="flex items-center justify-between">
                <span class="text-gray-700 dark:text-gray-300">Data Recovery Time</span>
                <span class="text-2xl font-bold text-cyan-600 dark:text-cyan-400">&lt; 1 min</span>
              </div>
              <div class="flex items-center justify-between">
                <span class="text-gray-700 dark:text-gray-300">Security Incidents</span>
                <span class="text-2xl font-bold text-cyan-600 dark:text-cyan-400">0</span>
              </div>
            </div>
            <p class="mt-6 text-gray-700 dark:text-gray-300 italic">
              "Built a multi-region Azure architecture that's fully HIPAA compliant. Outstanding security and reliability for our patient data."
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Pricing -->
    <section class="py-20 bg-gray-50 dark:bg-gray-800">
      <div class="max-w-5xl mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
          <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">
            Flexible Pricing Plans
          </h2>
          <p class="text-xl text-gray-600 dark:text-gray-400">
            Choose the plan that fits your cloud journey
          </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
          <!-- Starter -->
          <div class="bg-white dark:bg-gray-900 rounded-2xl p-8 border-2 border-gray-200 dark:border-gray-700 hover:border-emerald-500 transition-all hover:shadow-xl" data-aos="fade-up">
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Starter</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-6">For small teams and startups</p>
            <div class="mb-6">
              <span class="text-5xl font-bold text-gray-900 dark:text-white">$999</span>
              <span class="text-gray-600 dark:text-gray-400">/month</span>
            </div>
            <ul class="space-y-3 mb-8">
              <li class="flex items-center text-gray-700 dark:text-gray-300">
                <i class="fas fa-check text-emerald-500 mr-2"></i>
                Single cloud platform
              </li>
              <li class="flex items-center text-gray-700 dark:text-gray-300">
                <i class="fas fa-check text-emerald-500 mr-2"></i>
                Basic monitoring
              </li>
              <li class="flex items-center text-gray-700 dark:text-gray-300">
                <i class="fas fa-check text-emerald-500 mr-2"></i>
                Email support
              </li>
              <li class="flex items-center text-gray-700 dark:text-gray-300">
                <i class="fas fa-check text-emerald-500 mr-2"></i>
                Monthly optimization
              </li>
            </ul>
            <button class="w-full py-3 bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white rounded-xl font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 transition-all">
              Get Started
            </button>
          </div>

          <!-- Professional (Popular) -->
          <div class="relative bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-950 dark:to-teal-950 rounded-2xl p-8 border-2 border-emerald-500 transform scale-105 shadow-2xl" data-aos="fade-up" data-aos-delay="100">
            <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 px-6 py-2 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-full text-sm font-bold">
              MOST POPULAR
            </div>
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Professional</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-6">For growing businesses</p>
            <div class="mb-6">
              <span class="text-5xl font-bold text-gray-900 dark:text-white">$2,999</span>
              <span class="text-gray-600 dark:text-gray-400">/month</span>
            </div>
            <ul class="space-y-3 mb-8">
              <li class="flex items-center text-gray-700 dark:text-gray-300">
                <i class="fas fa-check text-emerald-500 mr-2"></i>
                Multi-cloud support
              </li>
              <li class="flex items-center text-gray-700 dark:text-gray-300">
                <i class="fas fa-check text-emerald-500 mr-2"></i>
                24/7 monitoring & alerts
              </li>
              <li class="flex items-center text-gray-700 dark:text-gray-300">
                <i class="fas fa-check text-emerald-500 mr-2"></i>
                Priority support
              </li>
              <li class="flex items-center text-gray-700 dark:text-gray-300">
                <i class="fas fa-check text-emerald-500 mr-2"></i>
                Weekly optimization
              </li>
              <li class="flex items-center text-gray-700 dark:text-gray-300">
                <i class="fas fa-check text-emerald-500 mr-2"></i>
                Disaster recovery
              </li>
            </ul>
            <button class="w-full py-3 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-xl font-semibold hover:shadow-lg transition-all">
              Get Started
            </button>
          </div>

          <!-- Enterprise -->
          <div class="bg-white dark:bg-gray-900 rounded-2xl p-8 border-2 border-gray-200 dark:border-gray-700 hover:border-emerald-500 transition-all hover:shadow-xl" data-aos="fade-up" data-aos-delay="200">
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Enterprise</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-6">For large organizations</p>
            <div class="mb-6">
              <span class="text-5xl font-bold text-gray-900 dark:text-white">Custom</span>
            </div>
            <ul class="space-y-3 mb-8">
              <li class="flex items-center text-gray-700 dark:text-gray-300">
                <i class="fas fa-check text-emerald-500 mr-2"></i>
                Everything in Professional
              </li>
              <li class="flex items-center text-gray-700 dark:text-gray-300">
                <i class="fas fa-check text-emerald-500 mr-2"></i>
                Dedicated cloud architect
              </li>
              <li class="flex items-center text-gray-700 dark:text-gray-300">
                <i class="fas fa-check text-emerald-500 mr-2"></i>
                Custom SLA agreements
              </li>
              <li class="flex items-center text-gray-700 dark:text-gray-300">
                <i class="fas fa-check text-emerald-500 mr-2"></i>
                Advanced security
              </li>
              <li class="flex items-center text-gray-700 dark:text-gray-300">
                <i class="fas fa-check text-emerald-500 mr-2"></i>
                White-glove onboarding
              </li>
            </ul>
            <button class="w-full py-3 bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white rounded-xl font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 transition-all">
              Contact Sales
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="py-20 bg-gradient-to-br from-emerald-600 to-teal-600 relative overflow-hidden">
      <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0 pattern-dots"></div>
      </div>

      <div class="max-w-4xl mx-auto px-4 text-center relative z-10" data-aos="fade-up">
        <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6">
          Ready to Scale Your Cloud Infrastructure?
        </h2>
        <p class="text-xl text-emerald-50 mb-10">
          Let's design a cloud solution that grows with your business
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <button class="px-10 py-5 bg-white text-emerald-600 rounded-xl font-bold hover:shadow-2xl transform hover:-translate-y-1 transition-all">
            <i class="fas fa-comments mr-2"></i>
            Schedule Free Consultation
          </button>
          <button class="px-10 py-5 bg-transparent border-2 border-white text-white rounded-xl font-bold hover:bg-white hover:text-emerald-600 transition-all">
            <i class="fas fa-download mr-2"></i>
            Download Case Studies
          </button>
        </div>

        <div class="mt-12 flex justify-center items-center flex-wrap gap-6 text-emerald-50">
          <div class="flex items-center">
            <i class="fas fa-check-circle text-green-400 mr-2"></i>
            <span>Free assessment</span>
          </div>
          <div class="flex items-center">
            <i class="fas fa-check-circle text-green-400 mr-2"></i>
            <span>No commitment</span>
          </div>
          <div class="flex items-center">
            <i class="fas fa-check-circle text-green-400 mr-2"></i>
            <span>Expert guidance</span>
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
  name: 'CloudServicesPage',
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

@keyframes dash {
  to {
    stroke-dashoffset: -100;
  }
}

.animate-blob {
  animation: blob 7s infinite;
}

.animate-float {
  animation: float 6s ease-in-out infinite;
}

.animate-pulse-slow {
  animation: pulse-slow 3s ease-in-out infinite;
}

.animate-dash {
  animation: dash 20s linear infinite;
}

.animation-delay-1000 {
  animation-delay: 1s;
}

.animation-delay-2000 {
  animation-delay: 2s;
}

.animation-delay-4000 {
  animation-delay: 4s;
}

.pattern-dots {
  background-image: radial-gradient(circle, rgba(255, 255, 255, 0.3) 1px, transparent 1px);
  background-size: 20px 20px;
}
</style>
