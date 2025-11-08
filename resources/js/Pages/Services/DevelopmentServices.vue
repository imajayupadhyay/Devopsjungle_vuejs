<template>
  <div class="bg-white dark:bg-gray-900">
    <Head>
      <title>Development Services - Custom DevOps Tools & Automation | DevOps Jungle</title>
      <meta name="description" content="Custom DevOps tool development, CI/CD pipeline automation, infrastructure as code, and bespoke automation solutions. Transform your DevOps workflows.">
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
            <li class="text-gray-600 dark:text-gray-400">Development Services</li>
          </ol>
        </nav>

        <div class="grid lg:grid-cols-2 gap-12 items-center">
          <!-- Left Content -->
          <div data-aos="fade-right">
            <div class="inline-flex items-center px-4 py-2 bg-emerald-100 dark:bg-emerald-900/30 rounded-full mb-6">
              <i class="fas fa-code text-teal-500 mr-2"></i>
              <span class="text-sm font-medium text-emerald-800 dark:text-emerald-300">Custom DevOps Development</span>
            </div>

            <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 dark:text-white mb-6 leading-tight">
              Build Custom
              <span class="block bg-gradient-to-r from-emerald-600 to-teal-600 dark:from-emerald-400 dark:to-teal-400 bg-clip-text text-transparent">
                DevOps Solutions
              </span>
              That Scale
            </h1>

            <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 leading-relaxed">
              Transform your DevOps workflows with custom-built tools, automated pipelines, and infrastructure as code. We develop tailored solutions that fit your unique requirements.
            </p>

            <div class="flex flex-wrap gap-4 mb-8">
              <button class="px-8 py-4 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-emerald-500/50 transform hover:-translate-y-1 transition-all duration-200">
                <i class="fas fa-rocket mr-2"></i>
                Start Project
              </button>
              <button class="px-8 py-4 bg-white dark:bg-gray-800 text-gray-800 dark:text-white rounded-xl font-semibold border-2 border-gray-200 dark:border-gray-700 hover:border-emerald-500 transition-all duration-200">
                <i class="fas fa-calendar-check mr-2"></i>
                Book Discovery Call
              </button>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-3 gap-6">
              <div>
                <div class="text-3xl font-bold text-gray-900 dark:text-white">500+</div>
                <div class="text-sm text-gray-600 dark:text-gray-400">Automations Built</div>
              </div>
              <div>
                <div class="text-3xl font-bold text-gray-900 dark:text-white">70%</div>
                <div class="text-sm text-gray-600 dark:text-gray-400">Time Saved</div>
              </div>
              <div>
                <div class="text-3xl font-bold text-gray-900 dark:text-white">100+</div>
                <div class="text-sm text-gray-600 dark:text-gray-400">Happy Clients</div>
              </div>
            </div>
          </div>

          <!-- Right Side - Code Terminal Animation -->
          <div class="relative" data-aos="fade-left">
            <div class="bg-gray-900 rounded-2xl shadow-2xl overflow-hidden border border-gray-700">
              <!-- Terminal Header -->
              <div class="bg-gray-800 px-4 py-3 flex items-center gap-2 border-b border-gray-700">
                <div class="flex gap-2">
                  <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                  <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                  <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                </div>
                <span class="text-gray-400 text-sm ml-4">devops-automation.sh</span>
              </div>

              <!-- Terminal Body -->
              <div class="p-6 font-mono text-sm">
                <div class="text-emerald-400 mb-2">$ ./deploy-pipeline.sh</div>
                <div class="text-gray-400 mb-1">
                  <span class="text-blue-400">✓</span> Building Docker image...
                </div>
                <div class="text-gray-400 mb-1">
                  <span class="text-blue-400">✓</span> Running tests...
                </div>
                <div class="text-gray-400 mb-1">
                  <span class="text-blue-400">✓</span> Deploying to Kubernetes...
                </div>
                <div class="text-gray-400 mb-4">
                  <span class="text-green-400">✓</span> Deployment successful!
                </div>

                <div class="text-emerald-400 mb-2">$ terraform apply</div>
                <div class="text-gray-400 mb-1">
                  <span class="text-yellow-400">→</span> Creating AWS resources...
                </div>
                <div class="text-gray-400 mb-1">
                  <span class="text-blue-400">✓</span> VPC created
                </div>
                <div class="text-gray-400 mb-1">
                  <span class="text-blue-400">✓</span> EC2 instances launched
                </div>
                <div class="text-gray-400">
                  <span class="text-green-400">✓</span> Infrastructure ready
                </div>

                <div class="mt-4 flex items-center">
                  <span class="text-emerald-400">$ </span>
                  <span class="animate-pulse ml-1">█</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- What We Build -->
    <section class="py-20 bg-white dark:bg-gray-900">
      <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
          <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">
            What We Build
          </h2>
          <p class="text-xl text-gray-600 dark:text-gray-400">
            Custom DevOps solutions tailored to your needs
          </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          <!-- Service 1 -->
          <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 border-2 border-gray-100 dark:border-gray-700 hover:border-emerald-500 transition-all hover:shadow-xl hover:-translate-y-2" data-aos="fade-up">
            <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center mb-6">
              <i class="fas fa-project-diagram text-white text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">CI/CD Pipelines</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
              Custom build, test, and deployment pipelines for any tech stack
            </p>
            <div class="space-y-2">
              <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <i class="fas fa-check-circle text-emerald-500 mr-2"></i>
                Jenkins, GitLab CI, GitHub Actions
              </div>
              <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <i class="fas fa-check-circle text-emerald-500 mr-2"></i>
                Multi-environment deployments
              </div>
            </div>
          </div>

          <!-- Service 2 -->
          <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 border-2 border-gray-100 dark:border-gray-700 hover:border-emerald-500 transition-all hover:shadow-xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
            <div class="w-16 h-16 bg-gradient-to-br from-teal-500 to-emerald-600 rounded-2xl flex items-center justify-center mb-6">
              <i class="fas fa-file-code text-white text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Infrastructure as Code</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
              Automated infrastructure provisioning and management
            </p>
            <div class="space-y-2">
              <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <i class="fas fa-check-circle text-emerald-500 mr-2"></i>
                Terraform, Pulumi, CloudFormation
              </div>
              <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <i class="fas fa-check-circle text-emerald-500 mr-2"></i>
                Version-controlled infrastructure
              </div>
            </div>
          </div>

          <!-- Service 3 -->
          <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 border-2 border-gray-100 dark:border-gray-700 hover:border-emerald-500 transition-all hover:shadow-xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
            <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mb-6">
              <i class="fas fa-robot text-white text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Automation Scripts</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
              Custom automation for repetitive tasks and workflows
            </p>
            <div class="space-y-2">
              <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <i class="fas fa-check-circle text-emerald-500 mr-2"></i>
                Python, Bash, PowerShell
              </div>
              <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <i class="fas fa-check-circle text-emerald-500 mr-2"></i>
                API integrations
              </div>
            </div>
          </div>

          <!-- Service 4 -->
          <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 border-2 border-gray-100 dark:border-gray-700 hover:border-emerald-500 transition-all hover:shadow-xl hover:-translate-y-2" data-aos="fade-up">
            <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center mb-6">
              <i class="fas fa-cubes text-white text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Container Orchestration</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
              Docker and Kubernetes deployment strategies
            </p>
            <div class="space-y-2">
              <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <i class="fas fa-check-circle text-emerald-500 mr-2"></i>
                Kubernetes manifests & Helm charts
              </div>
              <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <i class="fas fa-check-circle text-emerald-500 mr-2"></i>
                Service mesh implementation
              </div>
            </div>
          </div>

          <!-- Service 5 -->
          <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 border-2 border-gray-100 dark:border-gray-700 hover:border-emerald-500 transition-all hover:shadow-xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
            <div class="w-16 h-16 bg-gradient-to-br from-teal-500 to-emerald-600 rounded-2xl flex items-center justify-center mb-6">
              <i class="fas fa-chart-line text-white text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Monitoring & Observability</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
              Custom dashboards and alerting solutions
            </p>
            <div class="space-y-2">
              <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <i class="fas fa-check-circle text-emerald-500 mr-2"></i>
                Prometheus, Grafana, ELK
              </div>
              <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <i class="fas fa-check-circle text-emerald-500 mr-2"></i>
                Custom metrics & alerts
              </div>
            </div>
          </div>

          <!-- Service 6 -->
          <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 border-2 border-gray-100 dark:border-gray-700 hover:border-emerald-500 transition-all hover:shadow-xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
            <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mb-6">
              <i class="fas fa-toolbox text-white text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Custom DevOps Tools</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
              Bespoke tools and CLI applications for your workflows
            </p>
            <div class="space-y-2">
              <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <i class="fas fa-check-circle text-emerald-500 mr-2"></i>
                Go, Python, Node.js
              </div>
              <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <i class="fas fa-check-circle text-emerald-500 mr-2"></i>
                Web dashboards & CLIs
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Tech Stack -->
    <section class="py-20 bg-gray-50 dark:bg-gray-800">
      <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
          <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">
            Our Technology Stack
          </h2>
          <p class="text-xl text-gray-600 dark:text-gray-400">
            We work with the latest and most reliable DevOps technologies
          </p>
        </div>

        <div class="grid md:grid-cols-4 gap-6">
          <!-- Category 1: Languages -->
          <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 border border-gray-200 dark:border-gray-700" data-aos="fade-up">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Languages</h3>
            <div class="space-y-2">
              <div class="flex items-center text-gray-700 dark:text-gray-300 text-sm">
                <i class="fab fa-python text-emerald-500 mr-2"></i>
                Python
              </div>
              <div class="flex items-center text-gray-700 dark:text-gray-300 text-sm">
                <i class="fab fa-golang text-emerald-500 mr-2"></i>
                Go
              </div>
              <div class="flex items-center text-gray-700 dark:text-gray-300 text-sm">
                <i class="fab fa-node-js text-emerald-500 mr-2"></i>
                Node.js
              </div>
              <div class="flex items-center text-gray-700 dark:text-gray-300 text-sm">
                <i class="fas fa-terminal text-emerald-500 mr-2"></i>
                Bash/Shell
              </div>
            </div>
          </div>

          <!-- Category 2: CI/CD -->
          <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 border border-gray-200 dark:border-gray-700" data-aos="fade-up" data-aos-delay="100">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">CI/CD</h3>
            <div class="space-y-2">
              <div class="flex items-center text-gray-700 dark:text-gray-300 text-sm">
                <i class="fab fa-jenkins text-teal-500 mr-2"></i>
                Jenkins
              </div>
              <div class="flex items-center text-gray-700 dark:text-gray-300 text-sm">
                <i class="fab fa-github text-teal-500 mr-2"></i>
                GitHub Actions
              </div>
              <div class="flex items-center text-gray-700 dark:text-gray-300 text-sm">
                <i class="fab fa-gitlab text-teal-500 mr-2"></i>
                GitLab CI
              </div>
              <div class="flex items-center text-gray-700 dark:text-gray-300 text-sm">
                <i class="fas fa-circle text-teal-500 mr-2"></i>
                CircleCI
              </div>
            </div>
          </div>

          <!-- Category 3: IaC -->
          <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 border border-gray-200 dark:border-gray-700" data-aos="fade-up" data-aos-delay="200">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Infrastructure</h3>
            <div class="space-y-2">
              <div class="flex items-center text-gray-700 dark:text-gray-300 text-sm">
                <i class="fas fa-cube text-green-500 mr-2"></i>
                Terraform
              </div>
              <div class="flex items-center text-gray-700 dark:text-gray-300 text-sm">
                <i class="fas fa-cloud text-green-500 mr-2"></i>
                CloudFormation
              </div>
              <div class="flex items-center text-gray-700 dark:text-gray-300 text-sm">
                <i class="fab fa-ansible text-green-500 mr-2"></i>
                Ansible
              </div>
              <div class="flex items-center text-gray-700 dark:text-gray-300 text-sm">
                <i class="fas fa-cogs text-green-500 mr-2"></i>
                Pulumi
              </div>
            </div>
          </div>

          <!-- Category 4: Containers -->
          <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 border border-gray-200 dark:border-gray-700" data-aos="fade-up" data-aos-delay="300">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Containers</h3>
            <div class="space-y-2">
              <div class="flex items-center text-gray-700 dark:text-gray-300 text-sm">
                <i class="fab fa-docker text-emerald-500 mr-2"></i>
                Docker
              </div>
              <div class="flex items-center text-gray-700 dark:text-gray-300 text-sm">
                <i class="fas fa-dharmachakra text-emerald-500 mr-2"></i>
                Kubernetes
              </div>
              <div class="flex items-center text-gray-700 dark:text-gray-300 text-sm">
                <i class="fas fa-ship text-emerald-500 mr-2"></i>
                Helm
              </div>
              <div class="flex items-center text-gray-700 dark:text-gray-300 text-sm">
                <i class="fas fa-project-diagram text-emerald-500 mr-2"></i>
                Istio
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Development Process -->
    <section class="py-20 bg-white dark:bg-gray-900">
      <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
          <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">
            Our Development Process
          </h2>
          <p class="text-xl text-gray-600 dark:text-gray-400">
            Agile approach to deliver quality solutions fast
          </p>
        </div>

        <div class="relative">
          <div class="grid md:grid-cols-5 gap-6">
            <!-- Step 1 -->
            <div class="relative text-center" data-aos="fade-up">
              <div class="w-20 h-20 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="text-3xl font-bold text-white">1</span>
              </div>
              <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Discovery</h3>
              <p class="text-sm text-gray-600 dark:text-gray-400">
                Understand requirements and pain points
              </p>
              <!-- Arrow to next step -->
              <div class="hidden md:block absolute top-10 -right-3 text-emerald-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
              </div>
            </div>

            <!-- Step 2 -->
            <div class="relative text-center" data-aos="fade-up" data-aos-delay="100">
              <div class="w-20 h-20 bg-gradient-to-br from-teal-500 to-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="text-3xl font-bold text-white">2</span>
              </div>
              <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Design</h3>
              <p class="text-sm text-gray-600 dark:text-gray-400">
                Architecture and technical planning
              </p>
              <!-- Arrow to next step -->
              <div class="hidden md:block absolute top-10 -right-3 text-teal-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
              </div>
            </div>

            <!-- Step 3 -->
            <div class="relative text-center" data-aos="fade-up" data-aos-delay="200">
              <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="text-3xl font-bold text-white">3</span>
              </div>
              <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Development</h3>
              <p class="text-sm text-gray-600 dark:text-gray-400">
                Build with best practices and testing
              </p>
              <!-- Arrow to next step -->
              <div class="hidden md:block absolute top-10 -right-3 text-green-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
              </div>
            </div>

            <!-- Step 4 -->
            <div class="relative text-center" data-aos="fade-up" data-aos-delay="300">
              <div class="w-20 h-20 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="text-3xl font-bold text-white">4</span>
              </div>
              <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Testing</h3>
              <p class="text-sm text-gray-600 dark:text-gray-400">
                Comprehensive testing and QA
              </p>
              <!-- Arrow to next step -->
              <div class="hidden md:block absolute top-10 -right-3 text-emerald-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
              </div>
            </div>

            <!-- Step 5 -->
            <div class="relative text-center" data-aos="fade-up" data-aos-delay="400">
              <div class="w-20 h-20 bg-gradient-to-br from-teal-500 to-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="text-3xl font-bold text-white">5</span>
              </div>
              <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Delivery</h3>
              <p class="text-sm text-gray-600 dark:text-gray-400">
                Deploy and provide documentation
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Project Examples -->
    <section class="py-20 bg-gray-50 dark:bg-gray-800">
      <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
          <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">
            Recent Projects
          </h2>
          <p class="text-xl text-gray-600 dark:text-gray-400">
            Custom solutions we've built for our clients
          </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
          <!-- Project 1 -->
          <div class="bg-white dark:bg-gray-900 rounded-2xl p-8 border-2 border-gray-200 dark:border-gray-700 hover:border-emerald-500 transition-all hover:shadow-xl" data-aos="fade-up">
            <div class="text-4xl mb-4">🚀</div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Multi-Cloud Deployment Tool</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
              CLI tool to deploy applications across AWS, Azure, and GCP from a single configuration
            </p>
            <div class="flex flex-wrap gap-2">
              <span class="px-3 py-1 bg-emerald-100 dark:bg-emerald-900 text-emerald-700 dark:text-emerald-300 rounded-full text-xs">Go</span>
              <span class="px-3 py-1 bg-teal-100 dark:bg-teal-900 text-teal-700 dark:text-teal-300 rounded-full text-xs">Terraform</span>
              <span class="px-3 py-1 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-full text-xs">Multi-Cloud</span>
            </div>
          </div>

          <!-- Project 2 -->
          <div class="bg-white dark:bg-gray-900 rounded-2xl p-8 border-2 border-gray-200 dark:border-gray-700 hover:border-emerald-500 transition-all hover:shadow-xl" data-aos="fade-up" data-aos-delay="100">
            <div class="text-4xl mb-4">📊</div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Custom Metrics Dashboard</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
              Real-time dashboard aggregating metrics from multiple sources with custom alerting
            </p>
            <div class="flex flex-wrap gap-2">
              <span class="px-3 py-1 bg-emerald-100 dark:bg-emerald-900 text-emerald-700 dark:text-emerald-300 rounded-full text-xs">React</span>
              <span class="px-3 py-1 bg-teal-100 dark:bg-teal-900 text-teal-700 dark:text-teal-300 rounded-full text-xs">Prometheus</span>
              <span class="px-3 py-1 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-full text-xs">Grafana</span>
            </div>
          </div>

          <!-- Project 3 -->
          <div class="bg-white dark:bg-gray-900 rounded-2xl p-8 border-2 border-gray-200 dark:border-gray-700 hover:border-emerald-500 transition-all hover:shadow-xl" data-aos="fade-up" data-aos-delay="200">
            <div class="text-4xl mb-4">⚡</div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Auto-Scaling Pipeline</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
              Intelligent CI/CD pipeline that auto-scales based on repository activity and build queue
            </p>
            <div class="flex flex-wrap gap-2">
              <span class="px-3 py-1 bg-emerald-100 dark:bg-emerald-900 text-emerald-700 dark:text-emerald-300 rounded-full text-xs">Python</span>
              <span class="px-3 py-1 bg-teal-100 dark:bg-teal-900 text-teal-700 dark:text-teal-300 rounded-full text-xs">Jenkins</span>
              <span class="px-3 py-1 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-full text-xs">Kubernetes</span>
            </div>
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
          Ready to Automate Your DevOps Workflows?
        </h2>
        <p class="text-xl text-emerald-50 mb-10">
          Let's build custom solutions that transform how you work
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <button class="px-10 py-5 bg-white text-emerald-600 rounded-xl font-bold hover:shadow-2xl transform hover:-translate-y-1 transition-all">
            <i class="fas fa-comments mr-2"></i>
            Schedule Discovery Call
          </button>
          <button class="px-10 py-5 bg-transparent border-2 border-white text-white rounded-xl font-bold hover:bg-white hover:text-emerald-600 transition-all">
            <i class="fas fa-file-alt mr-2"></i>
            View Portfolio
          </button>
        </div>

        <div class="mt-12 flex justify-center items-center flex-wrap gap-6 text-emerald-50">
          <div class="flex items-center">
            <i class="fas fa-check-circle text-green-400 mr-2"></i>
            <span>Free consultation</span>
          </div>
          <div class="flex items-center">
            <i class="fas fa-check-circle text-green-400 mr-2"></i>
            <span>Custom solutions</span>
          </div>
          <div class="flex items-center">
            <i class="fas fa-check-circle text-green-400 mr-2"></i>
            <span>Agile delivery</span>
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
  name: 'DevelopmentServicesPage',
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

.animate-blob {
  animation: blob 7s infinite;
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
