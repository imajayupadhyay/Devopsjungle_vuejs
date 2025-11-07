<template>
  <div class="bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300">
    <Head>
      <title>One-to-One Mentorship - DevOps Jungle</title>
      <meta name="description" content="Get personalized DevOps mentorship from industry experts. Weekly 1-on-1 sessions, customized learning paths, and hands-on project guidance.">
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
            <li class="text-gray-600 dark:text-gray-400">One-to-One Mentorship</li>
          </ol>
        </nav>

        <div class="grid lg:grid-cols-2 gap-12 items-center">
          <!-- Left Content -->
          <div data-aos="fade-right">
            <div class="inline-flex items-center px-4 py-2 bg-emerald-100 dark:bg-emerald-900/30 rounded-full mb-6">
              <i class="fas fa-star text-yellow-500 mr-2"></i>
              <span class="text-sm font-medium text-emerald-800 dark:text-emerald-300">Premium Mentorship Program</span>
            </div>

            <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 dark:text-white mb-6 leading-tight">
              One-to-One
              <span class="block bg-gradient-to-r from-emerald-600 to-teal-600 dark:from-emerald-400 dark:to-teal-400 bg-clip-text text-transparent">
                Expert Mentorship
              </span>
            </h1>

            <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 leading-relaxed">
              Accelerate your DevOps career with personalized guidance from industry veterans. Get tailored advice, hands-on project support, and career strategies designed specifically for your goals.
            </p>

            <div class="flex flex-wrap gap-4 mb-8">
              <button class="px-8 py-4 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-emerald-500/50 transform hover:-translate-y-1 transition-all duration-200">
                <i class="fas fa-calendar-check mr-2"></i>
                Book Your Session
              </button>
              <button class="px-8 py-4 bg-white dark:bg-gray-800 text-gray-800 dark:text-white rounded-xl font-semibold border-2 border-gray-200 dark:border-gray-700 hover:border-emerald-500 transition-all duration-200">
                <i class="fas fa-play-circle mr-2"></i>
                Watch Demo
              </button>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-3 gap-6">
              <div>
                <div class="text-3xl font-bold text-gray-900 dark:text-white">500+</div>
                <div class="text-sm text-gray-600 dark:text-gray-400">Mentees</div>
              </div>
              <div>
                <div class="text-3xl font-bold text-gray-900 dark:text-white">4.9</div>
                <div class="text-sm text-gray-600 dark:text-gray-400">Rating</div>
              </div>
              <div>
                <div class="text-3xl font-bold text-gray-900 dark:text-white">95%</div>
                <div class="text-sm text-gray-600 dark:text-gray-400">Success Rate</div>
              </div>
            </div>
          </div>

          <!-- Right Illustration -->
          <div class="relative" data-aos="fade-left">
            <div class="relative w-full h-[500px]">
              <svg viewBox="0 0 500 500" class="w-full h-full">
                <!-- Mentor & Mentee Illustration -->
                <g class="animate-float">
                  <!-- Mentor -->
                  <circle cx="180" cy="200" r="60" fill="url(#mentorGradient)"/>
                  <circle cx="180" cy="180" r="30" fill="#047857"/>
                  <text x="180" y="190" text-anchor="middle" fill="white" font-size="25">👨‍💼</text>
                </g>

                <g class="animate-float animation-delay-1000">
                  <!-- Mentee -->
                  <circle cx="320" cy="240" r="55" fill="url(#menteeGradient)"/>
                  <circle cx="320" cy="220" r="28" fill="#0d9488"/>
                  <text x="320" y="230" text-anchor="middle" fill="white" font-size="22">👨‍🎓</text>
                </g>

                <!-- Connection Line -->
                <g class="animate-pulse-slow">
                  <line x1="240" y1="200" x2="265" y2="225" stroke="url(#lineGradient)" stroke-width="3" stroke-dasharray="5,5"/>
                  <circle cx="252" cy="212" r="8" fill="#10b981"/>
                </g>

                <!-- Floating Icons -->
                <g class="animate-pulse-slow animation-delay-2000">
                  <circle cx="150" cy="350" r="35" fill="url(#icon1Gradient)" opacity="0.9"/>
                  <text x="150" y="360" text-anchor="middle" font-size="20">📚</text>
                </g>

                <g class="animate-pulse-slow animation-delay-3000">
                  <circle cx="350" cy="360" r="35" fill="url(#icon2Gradient)" opacity="0.9"/>
                  <text x="350" y="370" text-anchor="middle" font-size="20">🎯</text>
                </g>

                <g class="animate-pulse-slow animation-delay-4000">
                  <circle cx="250" cy="380" r="35" fill="url(#icon3Gradient)" opacity="0.9"/>
                  <text x="250" y="390" text-anchor="middle" font-size="20">💡</text>
                </g>

                <!-- Gradients -->
                <defs>
                  <linearGradient id="mentorGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" style="stop-color:#047857;stop-opacity:0.2"/>
                    <stop offset="100%" style="stop-color:#059669;stop-opacity:0.3"/>
                  </linearGradient>
                  <linearGradient id="menteeGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" style="stop-color:#0d9488;stop-opacity:0.2"/>
                    <stop offset="100%" style="stop-color:#14b8a6;stop-opacity:0.3"/>
                  </linearGradient>
                  <linearGradient id="lineGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" style="stop-color:#10b981;stop-opacity:1"/>
                    <stop offset="100%" style="stop-color:#14b8a6;stop-opacity:1"/>
                  </linearGradient>
                  <linearGradient id="icon1Gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" style="stop-color:#10b981;stop-opacity:0.8"/>
                    <stop offset="100%" style="stop-color:#047857;stop-opacity:0.9"/>
                  </linearGradient>
                  <linearGradient id="icon2Gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" style="stop-color:#14b8a6;stop-opacity:0.8"/>
                    <stop offset="100%" style="stop-color:#0d9488;stop-opacity:0.9"/>
                  </linearGradient>
                  <linearGradient id="icon3Gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" style="stop-color:#059669;stop-opacity:0.8"/>
                    <stop offset="100%" style="stop-color:#047857;stop-opacity:0.9"/>
                  </linearGradient>
                </defs>
              </svg>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- What You'll Get Section -->
    <section class="py-20 bg-white dark:bg-gray-900">
      <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
          <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">
            What You'll Get
          </h2>
          <p class="text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
            Comprehensive mentorship designed to transform your DevOps career
          </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          <!-- Feature 1 -->
          <div class="group bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 border-2 border-gray-100 dark:border-gray-700 hover:border-emerald-500 transition-all duration-300 hover:shadow-xl hover:-translate-y-2" data-aos="fade-up">
            <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
              <i class="fas fa-video text-white text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Weekly 1-on-1 Sessions</h3>
            <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
              Dedicated weekly video calls with your mentor to discuss progress, challenges, and next steps.
            </p>
          </div>

          <!-- Feature 2 -->
          <div class="group bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 border-2 border-gray-100 dark:border-gray-700 hover:border-emerald-500 transition-all duration-300 hover:shadow-xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
              <i class="fas fa-route text-white text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Personalized Learning Path</h3>
            <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
              Custom curriculum tailored to your current skills, goals, and preferred learning style.
            </p>
          </div>

          <!-- Feature 3 -->
          <div class="group bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 border-2 border-gray-100 dark:border-gray-700 hover:border-emerald-500 transition-all duration-300 hover:shadow-xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
            <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
              <i class="fas fa-project-diagram text-white text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Real-World Projects</h3>
            <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
              Work on production-grade projects with guidance to build a portfolio that impresses employers.
            </p>
          </div>

          <!-- Feature 4 -->
          <div class="group bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 border-2 border-gray-100 dark:border-gray-700 hover:border-emerald-500 transition-all duration-300 hover:shadow-xl hover:-translate-y-2" data-aos="fade-up">
            <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
              <i class="fas fa-code-branch text-white text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Code Reviews</h3>
            <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
              Get detailed feedback on your code, architecture decisions, and best practices implementation.
            </p>
          </div>

          <!-- Feature 5 -->
          <div class="group bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 border-2 border-gray-100 dark:border-gray-700 hover:border-emerald-500 transition-all duration-300 hover:shadow-xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
            <div class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
              <i class="fas fa-briefcase text-white text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Career Guidance</h3>
            <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
              Resume reviews, interview preparation, and strategies to land your dream DevOps role.
            </p>
          </div>

          <!-- Feature 6 -->
          <div class="group bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 border-2 border-gray-100 dark:border-gray-700 hover:border-emerald-500 transition-all duration-300 hover:shadow-xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
            <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
              <i class="fas fa-users text-white text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Community Access</h3>
            <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
              Join our exclusive community of mentees for networking, peer learning, and collaboration.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- How It Works -->
    <section class="py-20 bg-gray-50 dark:bg-gray-800">
      <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
          <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">
            How It Works
          </h2>
          <p class="text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
            Simple, structured process to get you started
          </p>
        </div>

        <div class="grid md:grid-cols-4 gap-8">
          <!-- Step 1 -->
          <div class="relative" data-aos="fade-up">
            <div class="bg-white dark:bg-gray-900 rounded-2xl p-8 text-center border-2 border-emerald-500 hover:shadow-xl transition-all duration-300">
              <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center mx-auto mb-6 text-white text-2xl font-bold">
                1
              </div>
              <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Book Consultation</h3>
              <p class="text-gray-600 dark:text-gray-400">
                Schedule a free 30-min intro call to discuss your goals
              </p>
            </div>
            <div class="hidden md:block absolute top-1/2 -right-4 w-8 h-0.5 bg-gradient-to-r from-emerald-500 to-teal-600"></div>
          </div>

          <!-- Step 2 -->
          <div class="relative" data-aos="fade-up" data-aos-delay="100">
            <div class="bg-white dark:bg-gray-900 rounded-2xl p-8 text-center border-2 border-blue-500 hover:shadow-xl transition-all duration-300">
              <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6 text-white text-2xl font-bold">
                2
              </div>
              <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Get Matched</h3>
              <p class="text-gray-600 dark:text-gray-400">
                We pair you with a mentor matching your needs and background
              </p>
            </div>
            <div class="hidden md:block absolute top-1/2 -right-4 w-8 h-0.5 bg-gradient-to-r from-blue-500 to-indigo-600"></div>
          </div>

          <!-- Step 3 -->
          <div class="relative" data-aos="fade-up" data-aos-delay="200">
            <div class="bg-white dark:bg-gray-900 rounded-2xl p-8 text-center border-2 border-purple-500 hover:shadow-xl transition-all duration-300">
              <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center mx-auto mb-6 text-white text-2xl font-bold">
                3
              </div>
              <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Start Learning</h3>
              <p class="text-gray-600 dark:text-gray-400">
                Begin weekly sessions with your personalized roadmap
              </p>
            </div>
            <div class="hidden md:block absolute top-1/2 -right-4 w-8 h-0.5 bg-gradient-to-r from-purple-500 to-pink-600"></div>
          </div>

          <!-- Step 4 -->
          <div data-aos="fade-up" data-aos-delay="300">
            <div class="bg-white dark:bg-gray-900 rounded-2xl p-8 text-center border-2 border-green-500 hover:shadow-xl transition-all duration-300">
              <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center mx-auto mb-6 text-white text-2xl font-bold">
                4
              </div>
              <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Achieve Goals</h3>
              <p class="text-gray-600 dark:text-gray-400">
                Land your dream job or advance in your current role
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Pricing Section -->
    <section class="py-20 bg-white dark:bg-gray-900">
      <div class="max-w-4xl mx-auto px-4">
        <div class="text-center mb-12" data-aos="fade-up">
          <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">
            Flexible Pricing Plans
          </h2>
          <p class="text-xl text-gray-600 dark:text-gray-400">
            Choose the plan that works best for you
          </p>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
          <!-- Monthly Plan -->
          <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 border-2 border-gray-200 dark:border-gray-700 hover:border-emerald-500 transition-all duration-300" data-aos="fade-up">
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Monthly Plan</h3>
            <div class="mb-6">
              <span class="text-5xl font-bold text-gray-900 dark:text-white">$299</span>
              <span class="text-gray-600 dark:text-gray-400">/month</span>
            </div>
            <ul class="space-y-4 mb-8">
              <li class="flex items-center text-gray-600 dark:text-gray-400">
                <i class="fas fa-check-circle text-emerald-500 mr-3"></i>
                4 weekly 1-on-1 sessions
              </li>
              <li class="flex items-center text-gray-600 dark:text-gray-400">
                <i class="fas fa-check-circle text-emerald-500 mr-3"></i>
                Unlimited chat support
              </li>
              <li class="flex items-center text-gray-600 dark:text-gray-400">
                <i class="fas fa-check-circle text-emerald-500 mr-3"></i>
                Code reviews
              </li>
              <li class="flex items-center text-gray-600 dark:text-gray-400">
                <i class="fas fa-check-circle text-emerald-500 mr-3"></i>
                Community access
              </li>
            </ul>
            <button class="w-full py-4 bg-gradient-to-r from-gray-600 to-gray-700 text-white rounded-xl font-semibold hover:shadow-lg transition-all">
              Get Started
            </button>
          </div>

          <!-- 3-Month Plan (Popular) -->
          <div class="relative bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-950 dark:to-teal-950 rounded-2xl p-8 border-2 border-emerald-500 hover:shadow-2xl transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
            <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 px-4 py-1 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-full text-sm font-bold">
              MOST POPULAR
            </div>
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">3-Month Plan</h3>
            <div class="mb-6">
              <span class="text-5xl font-bold text-gray-900 dark:text-white">$249</span>
              <span class="text-gray-600 dark:text-gray-400">/month</span>
              <div class="text-sm text-emerald-600 dark:text-emerald-400 font-semibold">Save $150 total</div>
            </div>
            <ul class="space-y-4 mb-8">
              <li class="flex items-center text-gray-600 dark:text-gray-400">
                <i class="fas fa-check-circle text-emerald-500 mr-3"></i>
                Everything in Monthly Plan
              </li>
              <li class="flex items-center text-gray-600 dark:text-gray-400">
                <i class="fas fa-check-circle text-emerald-500 mr-3"></i>
                Priority mentor matching
              </li>
              <li class="flex items-center text-gray-600 dark:text-gray-400">
                <i class="fas fa-check-circle text-emerald-500 mr-3"></i>
                Resume & portfolio review
              </li>
              <li class="flex items-center text-gray-600 dark:text-gray-400">
                <i class="fas fa-check-circle text-emerald-500 mr-3"></i>
                Interview preparation
              </li>
            </ul>
            <button class="w-full py-4 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-emerald-500/50 transition-all">
              Get Started - Save 17%
            </button>
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
          Ready to Transform Your Career?
        </h2>
        <p class="text-xl text-emerald-50 mb-10">
          Book a free consultation call to see if mentorship is right for you
        </p>
        <button class="px-10 py-5 bg-white text-emerald-600 rounded-xl font-bold text-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-200">
          <i class="fas fa-calendar-alt mr-2"></i>
          Schedule Free Consultation
        </button>
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
  name: 'MentorshipPage',
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

.animate-blob {
  animation: blob 7s infinite;
}

.animation-delay-1000 {
  animation-delay: 1s;
}

.animation-delay-2000 {
  animation-delay: 2s;
}

.animation-delay-3000 {
  animation-delay: 3s;
}

.animation-delay-4000 {
  animation-delay: 4s;
}

.animate-float {
  animation: float 6s ease-in-out infinite;
}

.animate-pulse-slow {
  animation: pulse-slow 3s ease-in-out infinite;
}

.pattern-dots {
  background-image: radial-gradient(circle, rgba(255, 255, 255, 0.3) 1px, transparent 1px);
  background-size: 20px 20px;
}
</style>
