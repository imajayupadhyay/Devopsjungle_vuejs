<template>
  <div class="bg-white dark:bg-gray-900">
    <Head>
      <title>Transition to DevOps - Transform Your Tech Career | DevOps Jungle</title>
      <meta name="description" content="Make a seamless transition to DevOps from any tech background. Structured learning path, hands-on labs, mentorship, and job placement support to launch your DevOps career.">
    </Head>

    <DevOpsHeader />

    <!-- Hero Section - Split Screen with Timeline -->
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
            <li class="text-gray-600 dark:text-gray-400">Transition to DevOps</li>
          </ol>
        </nav>

        <div class="grid lg:grid-cols-2 gap-16 items-center">
          <!-- Left Content -->
          <div data-aos="fade-right">
            <div class="inline-flex items-center px-4 py-2 bg-emerald-100 dark:bg-emerald-900/30 rounded-full mb-6">
              <i class="fas fa-bolt text-yellow-500 mr-2 animate-pulse"></i>
              <span class="text-sm font-medium text-emerald-800 dark:text-emerald-300">Career Transformation Program</span>
            </div>

            <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 dark:text-white mb-6 leading-tight">
              Transition to
              <span class="block bg-gradient-to-r from-emerald-600 to-teal-600 dark:from-emerald-400 dark:to-teal-400 bg-clip-text text-transparent">
                DevOps Engineering
              </span>
              in 12 Weeks
            </h1>

            <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 leading-relaxed">
              Whether you're a developer, sysadmin, or IT professional, we'll guide your complete transformation into a DevOps engineer. Structured curriculum, real-world projects, and guaranteed job placement support.
            </p>

            <div class="flex flex-wrap gap-4 mb-8">
              <button class="px-8 py-4 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-emerald-500/50 transform hover:-translate-y-1 transition-all duration-200">
                <i class="fas fa-rocket mr-2"></i>
                Start Your Journey
              </button>
              <button class="px-8 py-4 bg-white dark:bg-gray-800 text-gray-800 dark:text-white rounded-xl font-semibold border-2 border-gray-200 dark:border-gray-700 hover:border-emerald-500 transition-all duration-200">
                <i class="fas fa-map mr-2"></i>
                View Roadmap
              </button>
            </div>

            <!-- Key Stats -->
            <div class="grid grid-cols-3 gap-6">
              <div>
                <div class="text-3xl font-bold text-gray-900 dark:text-white">12</div>
                <div class="text-sm text-gray-600 dark:text-gray-400">Weeks</div>
              </div>
              <div>
                <div class="text-3xl font-bold text-gray-900 dark:text-white">500+</div>
                <div class="text-sm text-gray-600 dark:text-gray-400">Transitions</div>
              </div>
              <div>
                <div class="text-3xl font-bold text-gray-900 dark:text-white">98%</div>
                <div class="text-sm text-gray-600 dark:text-gray-400">Success Rate</div>
              </div>
            </div>
          </div>

          <!-- Right Side - Transformation Timeline SVG -->
          <div class="relative h-[600px]" data-aos="fade-left">
            <svg viewBox="0 0 400 600" class="w-full h-full">
              <!-- Timeline Line -->
              <line x1="200" y1="50" x2="200" y2="550" stroke="url(#timelineGradient)" stroke-width="4" class="animate-draw"/>

              <!-- Phase 1: Foundation -->
              <g class="animate-fade-in">
                <circle cx="200" cy="100" r="50" fill="url(#phase1Gradient)" stroke="#3b82f6" stroke-width="3"/>
                <text x="200" y="110" text-anchor="middle" font-size="30">🎯</text>
                <text x="280" y="90" fill="#1e40af" font-size="16" font-weight="bold">Phase 1</text>
                <text x="280" y="110" fill="#3b82f6" font-size="13">Foundation</text>
              </g>

              <!-- Phase 2: Core Skills -->
              <g class="animate-fade-in animation-delay-500">
                <circle cx="200" cy="225" r="50" fill="url(#phase2Gradient)" stroke="#6366f1" stroke-width="3"/>
                <text x="200" y="235" text-anchor="middle" font-size="30">⚙️</text>
                <text x="60" y="215" fill="#3730a3" font-size="16" font-weight="bold">Phase 2</text>
                <text x="60" y="235" fill="#6366f1" font-size="13">Core Skills</text>
              </g>

              <!-- Phase 3: Advanced -->
              <g class="animate-fade-in animation-delay-1000">
                <circle cx="200" cy="350" r="50" fill="url(#phase3Gradient)" stroke="#8b5cf6" stroke-width="3"/>
                <text x="200" y="360" text-anchor="middle" font-size="30">🚀</text>
                <text x="280" y="340" fill="#6b21a8" font-size="16" font-weight="bold">Phase 3</text>
                <text x="280" y="360" fill="#8b5cf6" font-size="13">Advanced</text>
              </g>

              <!-- Phase 4: Launch -->
              <g class="animate-fade-in animation-delay-1500">
                <circle cx="200" cy="475" r="50" fill="url(#phase4Gradient)" stroke="#10b981" stroke-width="3"/>
                <text x="200" y="485" text-anchor="middle" font-size="30">💼</text>
                <text x="60" y="465" fill="#047857" font-size="16" font-weight="bold">Phase 4</text>
                <text x="60" y="485" fill="#10b981" font-size="13">Job Launch</text>
              </g>

              <!-- Connecting Arrows -->
              <path d="M 200 150 L 200 175" stroke="#3b82f6" stroke-width="2" marker-end="url(#arrowhead)" class="animate-draw animation-delay-200"/>
              <path d="M 200 275 L 200 300" stroke="#6366f1" stroke-width="2" marker-end="url(#arrowhead)" class="animate-draw animation-delay-700"/>
              <path d="M 200 400 L 200 425" stroke="#8b5cf6" stroke-width="2" marker-end="url(#arrowhead)" class="animate-draw animation-delay-1200"/>

              <!-- Gradients & Markers -->
              <defs>
                <linearGradient id="timelineGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                  <stop offset="0%" style="stop-color:#3b82f6;stop-opacity:1"/>
                  <stop offset="33%" style="stop-color:#6366f1;stop-opacity:1"/>
                  <stop offset="66%" style="stop-color:#8b5cf6;stop-opacity:1"/>
                  <stop offset="100%" style="stop-color:#10b981;stop-opacity:1"/>
                </linearGradient>

                <radialGradient id="phase1Gradient">
                  <stop offset="0%" style="stop-color:#93c5fd;stop-opacity:0.8"/>
                  <stop offset="100%" style="stop-color:#3b82f6;stop-opacity:0.9"/>
                </radialGradient>

                <radialGradient id="phase2Gradient">
                  <stop offset="0%" style="stop-color:#a5b4fc;stop-opacity:0.8"/>
                  <stop offset="100%" style="stop-color:#6366f1;stop-opacity:0.9"/>
                </radialGradient>

                <radialGradient id="phase3Gradient">
                  <stop offset="0%" style="stop-color:#c4b5fd;stop-opacity:0.8"/>
                  <stop offset="100%" style="stop-color:#8b5cf6;stop-opacity:0.9"/>
                </radialGradient>

                <radialGradient id="phase4Gradient">
                  <stop offset="0%" style="stop-color:#6ee7b7;stop-opacity:0.8"/>
                  <stop offset="100%" style="stop-color:#10b981;stop-opacity:0.9"/>
                </radialGradient>

                <marker id="arrowhead" markerWidth="10" markerHeight="10" refX="5" refY="5" orient="auto">
                  <polygon points="0 0, 10 5, 0 10" fill="#3b82f6"/>
                </marker>
              </defs>
            </svg>
          </div>
        </div>
      </div>
    </section>

    <!-- Who Is This For? Section -->
    <section class="py-20 bg-white dark:bg-gray-900">
      <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
          <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">
            Perfect For Career Switchers
          </h2>
          <p class="text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
            No matter your current role, we have a path to DevOps for you
          </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
          <!-- Software Developers -->
          <div class="group relative bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 border-2 border-gray-100 dark:border-gray-700 hover:border-emerald-500 transition-all duration-300 hover:shadow-xl hover:-translate-y-2" data-aos="fade-up">
            <div class="text-6xl mb-6 text-center">👨‍💻</div>
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4 text-center">Software Developers</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-6 text-center">
              Expand your skillset with infrastructure, CI/CD, and cloud automation
            </p>
            <div class="space-y-2">
              <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <i class="fas fa-check-circle text-emerald-500 mr-2"></i>
                Learn infrastructure as code
              </div>
              <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <i class="fas fa-check-circle text-emerald-500 mr-2"></i>
                Master deployment pipelines
              </div>
              <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <i class="fas fa-check-circle text-emerald-500 mr-2"></i>
                Cloud platform expertise
              </div>
            </div>
          </div>

          <!-- System Administrators -->
          <div class="group relative bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 border-2 border-gray-100 dark:border-gray-700 hover:border-emerald-500 transition-all duration-300 hover:shadow-xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
            <div class="text-6xl mb-6 text-center">🔧</div>
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4 text-center">System Administrators</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-6 text-center">
              Modernize your ops skills with automation and cloud technologies
            </p>
            <div class="space-y-2">
              <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <i class="fas fa-check-circle text-emerald-500 mr-2"></i>
                Automation & scripting mastery
              </div>
              <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <i class="fas fa-check-circle text-emerald-500 mr-2"></i>
                Container orchestration
              </div>
              <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <i class="fas fa-check-circle text-emerald-500 mr-2"></i>
                Cloud migration strategies
              </div>
            </div>
          </div>

          <!-- IT Professionals -->
          <div class="group relative bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 border-2 border-gray-100 dark:border-gray-700 hover:border-emerald-500 transition-all duration-300 hover:shadow-xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
            <div class="text-6xl mb-6 text-center">💼</div>
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4 text-center">IT Professionals</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-6 text-center">
              Break into DevOps from networking, support, or QA backgrounds
            </p>
            <div class="space-y-2">
              <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <i class="fas fa-check-circle text-emerald-500 mr-2"></i>
                Foundation to advanced path
              </div>
              <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <i class="fas fa-check-circle text-emerald-500 mr-2"></i>
                Hands-on project portfolio
              </div>
              <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <i class="fas fa-check-circle text-emerald-500 mr-2"></i>
                Interview prep & placement
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- 12-Week Curriculum -->
    <section class="py-20 bg-gray-50 dark:bg-gray-800">
      <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
          <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">
            12-Week Transformation Roadmap
          </h2>
          <p class="text-xl text-gray-600 dark:text-gray-400">
            Structured, progressive curriculum from fundamentals to job-ready skills
          </p>
        </div>

        <!-- Accordion/Timeline Hybrid -->
        <div class="max-w-5xl mx-auto space-y-6">
          <!-- Weeks 1-3 -->
          <div class="bg-white dark:bg-gray-900 rounded-2xl border-2 border-emerald-200 dark:border-emerald-800 overflow-hidden hover:shadow-xl transition-all" data-aos="fade-up">
            <div class="p-8 bg-gradient-to-r from-emerald-50 to-teal-50 dark:from-emerald-950 dark:to-teal-950">
              <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-4">
                  <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center text-white text-xl font-bold">
                    1-3
                  </div>
                  <div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Foundation Phase</h3>
                    <p class="text-gray-600 dark:text-gray-400">Linux, Networking & Version Control</p>
                  </div>
                </div>
                <div class="text-emerald-600 dark:text-emerald-400 font-medium">3 Weeks</div>
              </div>
              <div class="grid md:grid-cols-3 gap-4">
                <div class="bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-200 dark:border-gray-700">
                  <div class="text-emerald-600 dark:text-emerald-400 font-semibold mb-2">Week 1</div>
                  <ul class="space-y-1 text-sm text-gray-700 dark:text-gray-300">
                    <li>• Linux fundamentals & shell</li>
                    <li>• File systems & permissions</li>
                    <li>• Package management</li>
                  </ul>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-200 dark:border-gray-700">
                  <div class="text-emerald-600 dark:text-emerald-400 font-semibold mb-2">Week 2</div>
                  <ul class="space-y-1 text-sm text-gray-700 dark:text-gray-300">
                    <li>• Networking basics</li>
                    <li>• TCP/IP, DNS, HTTP</li>
                    <li>• Firewalls & security</li>
                  </ul>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-200 dark:border-gray-700">
                  <div class="text-emerald-600 dark:text-emerald-400 font-semibold mb-2">Week 3</div>
                  <ul class="space-y-1 text-sm text-gray-700 dark:text-gray-300">
                    <li>• Git & GitHub mastery</li>
                    <li>• Branching strategies</li>
                    <li>• Collaboration workflows</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <!-- Weeks 4-7 -->
          <div class="bg-white dark:bg-gray-900 rounded-2xl border-2 border-teal-200 dark:border-teal-800 overflow-hidden hover:shadow-xl transition-all" data-aos="fade-up" data-aos-delay="100">
            <div class="p-8 bg-gradient-to-r from-teal-50 to-emerald-50 dark:from-teal-950 dark:to-emerald-950">
              <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-4">
                  <div class="w-16 h-16 bg-gradient-to-br from-teal-500 to-emerald-600 rounded-2xl flex items-center justify-center text-white text-xl font-bold">
                    4-7
                  </div>
                  <div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Core DevOps Skills</h3>
                    <p class="text-gray-600 dark:text-gray-400">Cloud, Containers & CI/CD</p>
                  </div>
                </div>
                <div class="text-teal-600 dark:text-teal-400 font-medium">4 Weeks</div>
              </div>
              <div class="grid md:grid-cols-4 gap-4">
                <div class="bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-200 dark:border-gray-700">
                  <div class="text-teal-600 dark:text-teal-400 font-semibold mb-2">Week 4</div>
                  <ul class="space-y-1 text-sm text-gray-700 dark:text-gray-300">
                    <li>• AWS fundamentals</li>
                    <li>• EC2, S3, VPC</li>
                    <li>• IAM & security</li>
                  </ul>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-200 dark:border-gray-700">
                  <div class="text-teal-600 dark:text-teal-400 font-semibold mb-2">Week 5</div>
                  <ul class="space-y-1 text-sm text-gray-700 dark:text-gray-300">
                    <li>• Docker mastery</li>
                    <li>• Container orchestration</li>
                    <li>• Image optimization</li>
                  </ul>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-200 dark:border-gray-700">
                  <div class="text-teal-600 dark:text-teal-400 font-semibold mb-2">Week 6</div>
                  <ul class="space-y-1 text-sm text-gray-700 dark:text-gray-300">
                    <li>• Jenkins & GitHub Actions</li>
                    <li>• Build pipelines</li>
                    <li>• Test automation</li>
                  </ul>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-200 dark:border-gray-700">
                  <div class="text-teal-600 dark:text-teal-400 font-semibold mb-2">Week 7</div>
                  <ul class="space-y-1 text-sm text-gray-700 dark:text-gray-300">
                    <li>• CD/deployment strategies</li>
                    <li>• Blue-green deploys</li>
                    <li>• Rollback procedures</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <!-- Weeks 8-10 -->
          <div class="bg-white dark:bg-gray-900 rounded-2xl border-2 border-green-200 dark:border-green-800 overflow-hidden hover:shadow-xl transition-all" data-aos="fade-up" data-aos-delay="200">
            <div class="p-8 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-950 dark:to-emerald-950">
              <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-4">
                  <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center text-white text-xl font-bold">
                    8-10
                  </div>
                  <div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Advanced Topics</h3>
                    <p class="text-gray-600 dark:text-gray-400">Kubernetes, IaC & Monitoring</p>
                  </div>
                </div>
                <div class="text-green-600 dark:text-green-400 font-medium">3 Weeks</div>
              </div>
              <div class="grid md:grid-cols-3 gap-4">
                <div class="bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-200 dark:border-gray-700">
                  <div class="text-green-600 dark:text-green-400 font-semibold mb-2">Week 8</div>
                  <ul class="space-y-1 text-sm text-gray-700 dark:text-gray-300">
                    <li>• Kubernetes architecture</li>
                    <li>• Deployments & services</li>
                    <li>• ConfigMaps & secrets</li>
                  </ul>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-200 dark:border-gray-700">
                  <div class="text-green-600 dark:text-green-400 font-semibold mb-2">Week 9</div>
                  <ul class="space-y-1 text-sm text-gray-700 dark:text-gray-300">
                    <li>• Terraform mastery</li>
                    <li>• CloudFormation</li>
                    <li>• State management</li>
                  </ul>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-200 dark:border-gray-700">
                  <div class="text-green-600 dark:text-green-400 font-semibold mb-2">Week 10</div>
                  <ul class="space-y-1 text-sm text-gray-700 dark:text-gray-300">
                    <li>• Prometheus & Grafana</li>
                    <li>• ELK stack</li>
                    <li>• Alerting & dashboards</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <!-- Weeks 11-12 -->
          <div class="bg-white dark:bg-gray-900 rounded-2xl border-2 border-emerald-200 dark:border-emerald-800 overflow-hidden hover:shadow-xl transition-all" data-aos="fade-up" data-aos-delay="300">
            <div class="p-8 bg-gradient-to-r from-emerald-50 to-teal-50 dark:from-emerald-950 dark:to-teal-950">
              <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-4">
                  <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center text-white text-xl font-bold">
                    11-12
                  </div>
                  <div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Job Launch</h3>
                    <p class="text-gray-600 dark:text-gray-400">Portfolio, Interviews & Placement</p>
                  </div>
                </div>
                <div class="text-emerald-600 dark:text-emerald-400 font-medium">2 Weeks</div>
              </div>
              <div class="grid md:grid-cols-2 gap-4">
                <div class="bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-200 dark:border-gray-700">
                  <div class="text-emerald-600 dark:text-emerald-400 font-semibold mb-2">Week 11</div>
                  <ul class="space-y-1 text-sm text-gray-700 dark:text-gray-300">
                    <li>• Capstone project</li>
                    <li>• Portfolio development</li>
                    <li>• Resume optimization</li>
                    <li>• LinkedIn branding</li>
                  </ul>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-200 dark:border-gray-700">
                  <div class="text-emerald-600 dark:text-emerald-400 font-semibold mb-2">Week 12</div>
                  <ul class="space-y-1 text-sm text-gray-700 dark:text-gray-300">
                    <li>• Mock interviews</li>
                    <li>• Salary negotiation</li>
                    <li>• Job applications</li>
                    <li>• Placement support</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- What's Included -->
    <section class="py-20 bg-white dark:bg-gray-900">
      <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
          <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">
            Everything You Need to Succeed
          </h2>
          <p class="text-xl text-gray-600 dark:text-gray-400">
            Comprehensive support from day one to job offer
          </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
          <!-- Feature 1 -->
          <div class="text-center group" data-aos="fade-up">
            <div class="w-20 h-20 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform shadow-lg">
              <i class="fas fa-video text-white text-3xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Live Classes</h3>
            <p class="text-gray-600 dark:text-gray-400">
              3x weekly interactive sessions with expert instructors
            </p>
          </div>

          <!-- Feature 2 -->
          <div class="text-center group" data-aos="fade-up" data-aos-delay="100">
            <div class="w-20 h-20 bg-gradient-to-br from-teal-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform shadow-lg">
              <i class="fas fa-laptop-code text-white text-3xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Hands-On Labs</h3>
            <p class="text-gray-600 dark:text-gray-400">
              50+ real-world labs in AWS cloud environment
            </p>
          </div>

          <!-- Feature 3 -->
          <div class="text-center group" data-aos="fade-up" data-aos-delay="200">
            <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform shadow-lg">
              <i class="fas fa-user-friends text-white text-3xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">1-on-1 Mentorship</h3>
            <p class="text-gray-600 dark:text-gray-400">
              Weekly personal mentorship sessions
            </p>
          </div>

          <!-- Feature 4 -->
          <div class="text-center group" data-aos="fade-up" data-aos-delay="300">
            <div class="w-20 h-20 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform shadow-lg">
              <i class="fas fa-briefcase text-white text-3xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Job Placement</h3>
            <p class="text-gray-600 dark:text-gray-400">
              Interview prep & direct employer connections
            </p>
          </div>

          <!-- Feature 5 -->
          <div class="text-center group" data-aos="fade-up">
            <div class="w-20 h-20 bg-gradient-to-br from-pink-500 to-rose-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform shadow-lg">
              <i class="fas fa-book text-white text-3xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Study Materials</h3>
            <p class="text-gray-600 dark:text-gray-400">
              Lifetime access to recordings & resources
            </p>
          </div>

          <!-- Feature 6 -->
          <div class="text-center group" data-aos="fade-up" data-aos-delay="100">
            <div class="w-20 h-20 bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform shadow-lg">
              <i class="fas fa-certificate text-white text-3xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Certification Prep</h3>
            <p class="text-gray-600 dark:text-gray-400">
              AWS certification exam preparation included
            </p>
          </div>

          <!-- Feature 7 -->
          <div class="text-center group" data-aos="fade-up" data-aos-delay="200">
            <div class="w-20 h-20 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform shadow-lg">
              <i class="fas fa-users text-white text-3xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Community</h3>
            <p class="text-gray-600 dark:text-gray-400">
              Private Slack channel for peer support
            </p>
          </div>

          <!-- Feature 8 -->
          <div class="text-center group" data-aos="fade-up" data-aos-delay="300">
            <div class="w-20 h-20 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform shadow-lg">
              <i class="fas fa-redo text-white text-3xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Retake Guarantee</h3>
            <p class="text-gray-600 dark:text-gray-400">
              Free retake if you don't land a job
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
            Invest in Your Future
          </h2>
          <p class="text-xl text-gray-600 dark:text-gray-400">
            Transform your career in just 12 weeks
          </p>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
          <!-- One-Time Payment -->
          <div class="bg-white dark:bg-gray-900 rounded-2xl p-10 border-2 border-gray-200 dark:border-gray-700 hover:border-emerald-500 transition-all duration-300 hover:shadow-xl" data-aos="fade-up">
            <div class="text-center mb-8">
              <div class="inline-block px-4 py-1 bg-emerald-100 dark:bg-emerald-900 text-emerald-600 dark:text-emerald-300 rounded-full text-sm font-bold mb-4">
                ONE-TIME PAYMENT
              </div>
              <div class="text-6xl font-bold text-gray-900 dark:text-white mb-2">$4,999</div>
              <p class="text-gray-600 dark:text-gray-400">Complete 12-week program</p>
            </div>
            <ul class="space-y-4 mb-8">
              <li class="flex items-start">
                <i class="fas fa-check-circle text-emerald-500 mr-3 mt-1 text-xl"></i>
                <span class="text-gray-700 dark:text-gray-300">Full curriculum access</span>
              </li>
              <li class="flex items-start">
                <i class="fas fa-check-circle text-emerald-500 mr-3 mt-1 text-xl"></i>
                <span class="text-gray-700 dark:text-gray-300">All features included</span>
              </li>
              <li class="flex items-start">
                <i class="fas fa-check-circle text-emerald-500 mr-3 mt-1 text-xl"></i>
                <span class="text-gray-700 dark:text-gray-300">Job placement support</span>
              </li>
              <li class="flex items-start">
                <i class="fas fa-check-circle text-emerald-500 mr-3 mt-1 text-xl"></i>
                <span class="text-gray-700 dark:text-gray-300">Lifetime materials access</span>
              </li>
            </ul>
            <button class="w-full py-4 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-emerald-500/50 transition-all">
              Enroll Now
            </button>
          </div>

          <!-- Payment Plan -->
          <div class="relative bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-950 dark:to-teal-950 rounded-2xl p-10 border-2 border-emerald-500 transform scale-105 shadow-2xl" data-aos="fade-up" data-aos-delay="100">
            <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 px-6 py-2 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-full text-sm font-black">
              MOST POPULAR
            </div>
            <div class="text-center mb-8">
              <div class="inline-block px-4 py-1 bg-emerald-600/20 text-emerald-700 dark:text-emerald-300 rounded-full text-sm font-bold mb-4">
                FLEXIBLE PAYMENT
              </div>
              <div class="text-6xl font-bold text-gray-900 dark:text-white mb-2">$499</div>
              <p class="text-gray-700 dark:text-gray-300">per month for 12 months</p>
              <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Total: $5,988 (Save $1,000 vs monthly)</p>
            </div>
            <ul class="space-y-4 mb-8">
              <li class="flex items-start">
                <i class="fas fa-check-circle text-emerald-500 mr-3 mt-1 text-xl"></i>
                <span class="text-gray-700 dark:text-gray-300">Everything in one-time plan</span>
              </li>
              <li class="flex items-start">
                <i class="fas fa-check-circle text-emerald-500 mr-3 mt-1 text-xl"></i>
                <span class="text-gray-700 dark:text-gray-300">Start for less upfront</span>
              </li>
              <li class="flex items-start">
                <i class="fas fa-check-circle text-emerald-500 mr-3 mt-1 text-xl"></i>
                <span class="text-gray-700 dark:text-gray-300">No interest charges</span>
              </li>
              <li class="flex items-start">
                <i class="fas fa-check-circle text-emerald-500 mr-3 mt-1 text-xl"></i>
                <span class="text-gray-700 dark:text-gray-300">Cancel anytime after week 4</span>
              </li>
            </ul>
            <button class="w-full py-4 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-xl font-bold hover:shadow-lg hover:shadow-emerald-500/50 transition-all">
              Get Started - $499/mo
            </button>
          </div>
        </div>

        <div class="text-center mt-12" data-aos="fade-up">
          <p class="text-gray-600 dark:text-gray-400 mb-2">
            <i class="fas fa-shield-alt text-green-500 mr-2"></i>
            14-day money-back guarantee
          </p>
          <p class="text-sm text-gray-500 dark:text-gray-500">
            Average salary increase: $35,000 • ROI in first year
          </p>
        </div>
      </div>
    </section>

    <!-- Success Stories -->
    <section class="py-20 bg-white dark:bg-gray-900">
      <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
          <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">
            Transition Success Stories
          </h2>
          <p class="text-xl text-gray-600 dark:text-gray-400">
            Real people, real transformations, real results
          </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
          <!-- Story 1 -->
          <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 border-2 border-gray-100 dark:border-gray-700 hover:border-emerald-500 transition-all hover:shadow-xl" data-aos="fade-up">
            <div class="flex items-center mb-6">
              <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center text-2xl mr-4">
                👨‍💻
              </div>
              <div>
                <div class="font-bold text-gray-900 dark:text-white text-lg">Alex Rodriguez</div>
                <div class="text-sm text-gray-600 dark:text-gray-400">Frontend Dev → DevOps</div>
              </div>
            </div>
            <div class="mb-4">
              <div class="text-3xl font-bold text-emerald-600 dark:text-emerald-400">$70K → $115K</div>
              <div class="text-sm text-gray-600 dark:text-gray-400">in 3 months</div>
            </div>
            <p class="text-gray-700 dark:text-gray-300 italic">
              "I was skeptical about switching to DevOps, but the structured program made it seamless. Now I'm working at a FAANG company!"
            </p>
          </div>

          <!-- Story 2 -->
          <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 border-2 border-gray-100 dark:border-gray-700 hover:border-teal-500 transition-all hover:shadow-xl" data-aos="fade-up" data-aos-delay="100">
            <div class="flex items-center mb-6">
              <div class="w-16 h-16 bg-gradient-to-br from-teal-500 to-emerald-600 rounded-full flex items-center justify-center text-2xl mr-4">
                👩‍🔧
              </div>
              <div>
                <div class="font-bold text-gray-900 dark:text-white text-lg">Jessica Kim</div>
                <div class="text-sm text-gray-600 dark:text-gray-400">SysAdmin → Senior DevOps</div>
              </div>
            </div>
            <div class="mb-4">
              <div class="text-3xl font-bold text-teal-600 dark:text-teal-400">$65K → $125K</div>
              <div class="text-sm text-gray-600 dark:text-gray-400">in 10 weeks</div>
            </div>
            <p class="text-gray-700 dark:text-gray-300 italic">
              "The hands-on labs were incredible. I built a portfolio that got me interviews at companies I never thought would respond."
            </p>
          </div>

          <!-- Story 3 -->
          <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 border-2 border-gray-100 dark:border-gray-700 hover:border-green-500 transition-all hover:shadow-xl" data-aos="fade-up" data-aos-delay="200">
            <div class="flex items-center mb-6">
              <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center text-2xl mr-4">
                👨‍💼
              </div>
              <div>
                <div class="font-bold text-gray-900 dark:text-white text-lg">Michael Chen</div>
                <div class="text-sm text-gray-600 dark:text-gray-400">QA Tester → DevOps Lead</div>
              </div>
            </div>
            <div class="mb-4">
              <div class="text-3xl font-bold text-green-600 dark:text-green-400">$55K → $110K</div>
              <div class="text-sm text-gray-600 dark:text-gray-400">in 12 weeks</div>
            </div>
            <p class="text-gray-700 dark:text-gray-300 italic">
              "Coming from QA with no cloud experience, I was nervous. The mentors guided me every step. Best decision of my career!"
            </p>
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
        <div class="mb-8">
          <div class="inline-flex items-center px-6 py-3 bg-yellow-400 rounded-full mb-6">
            <i class="fas fa-fire text-red-600 mr-2 animate-pulse"></i>
            <span class="text-gray-900 font-bold">Next cohort starts in 15 days - 8 spots left!</span>
          </div>
        </div>

        <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6">
          Ready to Transform Your Career?
        </h2>
        <p class="text-xl text-emerald-50 mb-10">
          Join hundreds of successful career switchers who landed DevOps roles
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <button class="px-10 py-5 bg-white text-emerald-600 rounded-xl font-bold hover:shadow-2xl transform hover:-translate-y-1 transition-all">
            <i class="fas fa-rocket mr-2"></i>
            Reserve My Spot Now
          </button>
          <button class="px-10 py-5 bg-transparent border-2 border-white text-white rounded-xl font-bold hover:bg-white hover:text-emerald-600 transition-all">
            <i class="fas fa-calendar mr-2"></i>
            Book Free Consultation
          </button>
        </div>

        <div class="mt-12 flex justify-center items-center flex-wrap gap-6 text-emerald-50">
          <div class="flex items-center">
            <i class="fas fa-check-circle text-green-400 mr-2"></i>
            <span>No prerequisites</span>
          </div>
          <div class="flex items-center">
            <i class="fas fa-check-circle text-green-400 mr-2"></i>
            <span>Job guarantee</span>
          </div>
          <div class="flex items-center">
            <i class="fas fa-check-circle text-green-400 mr-2"></i>
            <span>Financing available</span>
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
  name: 'TransitionDevopsPage',
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
@keyframes orb {
  0%, 100% {
    transform: translate(0, 0) scale(1);
  }
  33% {
    transform: translate(50px, -30px) scale(1.1);
  }
  66% {
    transform: translate(-30px, 50px) scale(0.9);
  }
}

@keyframes draw {
  from {
    stroke-dasharray: 1000;
    stroke-dashoffset: 1000;
  }
  to {
    stroke-dashoffset: 0;
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

.animate-orb {
  animation: orb 8s ease-in-out infinite;
}

.animate-draw {
  animation: draw 2s ease-out forwards;
}

.animate-fade-in {
  animation: fade-in 1s ease-out forwards;
}

.animation-delay-200 {
  animation-delay: 0.2s;
}

.animation-delay-500 {
  animation-delay: 0.5s;
}

.animation-delay-700 {
  animation-delay: 0.7s;
}

.animation-delay-1000 {
  animation-delay: 1s;
}

.animation-delay-1200 {
  animation-delay: 1.2s;
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

.animate-blob {
  animation: blob 7s infinite;
}

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

.pattern-dots {
  background-image: radial-gradient(circle, rgba(255, 255, 255, 0.3) 1px, transparent 1px);
  background-size: 20px 20px;
}
</style>
