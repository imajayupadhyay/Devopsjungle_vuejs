<template>
  <div class="bg-gray-50 dark:bg-gray-900 text-gray-700 dark:text-gray-300 transition-colors duration-200">
    <!-- Service Hero Section -->
    <div class="relative overflow-hidden">
      <!-- Background Gradient -->
      <div class="absolute inset-0 service-gradient opacity-10 dark:opacity-20"></div>

      <div class="relative container mx-auto px-4 py-16">
        <div class="max-w-4xl mx-auto">
          <!-- Breadcrumb -->
          <nav class="mb-8">
            <ol class="flex items-center space-x-2 text-sm">
              <li><a href="/" class="text-primary-600 dark:text-primary-400 hover:underline">Home</a></li>
              <li><span class="text-gray-400 dark:text-gray-600">/</span></li>
              <li><a href="/services" class="text-primary-600 dark:text-primary-400 hover:underline">Services</a></li>
              <li><span class="text-gray-400 dark:text-gray-600">/</span></li>
              <li class="text-gray-600 dark:text-gray-400">{{ service.title }}</li>
            </ol>
          </nav>

          <div class="grid lg:grid-cols-3 gap-12">
            <!-- Main Content -->
            <div class="lg:col-span-2">
              <!-- Service Header -->
              <div class="mb-8">
                <div class="flex items-center mb-4">
                  <div class="w-16 h-16 service-gradient rounded-xl flex items-center justify-center mr-6">
                    <i :class="service.icon" class="text-3xl text-white"></i>
                  </div>
                  <div>
                    <span class="inline-block bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300 px-3 py-1 rounded-full text-sm font-semibold uppercase tracking-wide mb-2">
                      {{ getCategoryName(service.category) }}
                    </span>
                    <h1 class="text-4xl font-bold text-gray-900 dark:text-white">{{ service.title }}</h1>
                  </div>
                </div>
                <p class="text-xl text-gray-600 dark:text-gray-300 leading-relaxed">
                  {{ service.description }}
                </p>
              </div>

              <!-- Service Stats -->
              <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-12">
                <div class="text-center">
                  <div class="text-3xl font-bold gradient-text">{{ service.duration }}</div>
                  <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">Duration</div>
                </div>
                <div class="text-center">
                  <div class="text-3xl font-bold gradient-text">{{ service.rating }}</div>
                  <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">Rating</div>
                </div>
                <div class="text-center">
                  <div class="text-3xl font-bold gradient-text">{{ formatNumber(service.clients) }}+</div>
                  <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">Clients</div>
                </div>
                <div class="text-center">
                  <div class="text-3xl font-bold gradient-text">{{ service.deliveryTime }}</div>
                  <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">Delivery</div>
                </div>
              </div>

              <!-- Tabs -->
              <div class="mb-8">
                <div class="border-b border-gray-200 dark:border-gray-700">
                  <nav class="-mb-px flex space-x-8">
                    <button
                      v-for="tab in tabs"
                      :key="tab.id"
                      @click="activeTab = tab.id"
                      :class="[
                        'py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200',
                        activeTab === tab.id
                          ? 'border-primary-500 text-primary-600 dark:text-primary-400'
                          : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600'
                      ]"
                    >
                      {{ tab.name }}
                    </button>
                  </nav>
                </div>
              </div>

              <!-- Tab Content -->
              <div class="space-y-8">
                <!-- Overview Tab -->
                <div v-if="activeTab === 'overview'">
                  <div class="space-y-8">
                    <!-- What's Included -->
                    <div>
                      <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">What's Included</h3>
                      <div class="grid md:grid-cols-2 gap-4">
                        <div v-for="feature in service.features" :key="feature" class="flex items-start">
                          <i class="fas fa-check-circle text-primary-600 dark:text-primary-400 mr-3 mt-1 flex-shrink-0"></i>
                          <span class="text-gray-700 dark:text-gray-300">{{ feature }}</span>
                        </div>
                      </div>
                    </div>

                    <!-- Service Type & Requirements -->
                    <div class="grid md:grid-cols-2 gap-8">
                      <div>
                        <h4 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Service Details</h4>
                        <div class="space-y-3">
                          <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Service Type:</span>
                            <span class="font-semibold capitalize">{{ service.type }}</span>
                          </div>
                          <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Delivery Time:</span>
                            <span class="font-semibold">{{ service.deliveryTime }}</span>
                          </div>
                          <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Experience Level:</span>
                            <span class="font-semibold capitalize">{{ service.level || 'All Levels' }}</span>
                          </div>
                        </div>
                      </div>
                      <div>
                        <h4 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Requirements</h4>
                        <ul class="space-y-2">
                          <li v-for="requirement in getRequirements()" :key="requirement" class="flex items-start">
                            <i class="fas fa-dot-circle text-primary-600 dark:text-primary-400 mr-2 mt-2 text-xs"></i>
                            <span class="text-gray-700 dark:text-gray-300">{{ requirement }}</span>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Process Tab -->
                <div v-if="activeTab === 'process'">
                  <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Our Process</h3>
                  <div class="space-y-6">
                    <div v-for="(step, index) in getProcessSteps()" :key="index" class="flex">
                      <div class="flex-shrink-0 w-12 h-12 bg-primary-600 dark:bg-primary-500 text-white rounded-full flex items-center justify-center font-bold text-lg mr-6">
                        {{ index + 1 }}
                      </div>
                      <div class="flex-1">
                        <h4 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ step.title }}</h4>
                        <p class="text-gray-600 dark:text-gray-300">{{ step.description }}</p>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Pricing Tab -->
                <div v-if="activeTab === 'pricing'">
                  <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Pricing Options</h3>
                  <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 border border-gray-200 dark:border-gray-700">
                    <div class="text-center mb-6">
                      <div class="text-4xl font-bold gradient-text mb-2">{{ service.pricing.display }}</div>
                      <div v-if="service.pricing.period" class="text-gray-500 dark:text-gray-400">{{ service.pricing.period }}</div>
                      <div v-if="service.pricing.originalPrice" class="mt-2">
                        <span class="text-lg text-gray-500 dark:text-gray-400 line-through mr-2">${{ service.pricing.originalPrice }}</span>
                        <span class="text-green-600 dark:text-green-400 font-semibold">Save {{ service.pricing.savings }}%</span>
                      </div>
                    </div>
                    <div class="space-y-3 mb-8">
                      <div v-for="benefit in getPricingBenefits()" :key="benefit" class="flex items-center">
                        <i class="fas fa-check text-primary-600 dark:text-primary-400 mr-3"></i>
                        <span>{{ benefit }}</span>
                      </div>
                    </div>
                    <button @click="showContactModal = true" class="w-full gradient-btn text-white py-4 rounded-lg font-semibold text-lg hover:opacity-90 transition-opacity">
                      Get Started Now
                    </button>
                  </div>
                </div>

                <!-- Reviews Tab -->
                <div v-if="activeTab === 'reviews'">
                  <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Client Reviews</h3>
                  <div class="space-y-6">
                    <div v-for="review in getReviews()" :key="review.id" class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                      <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center">
                          <div class="w-12 h-12 bg-primary-600 dark:bg-primary-500 rounded-full flex items-center justify-center text-white font-bold text-lg mr-4">
                            {{ review.author.charAt(0) }}
                          </div>
                          <div>
                            <h4 class="font-semibold text-gray-900 dark:text-white">{{ review.author }}</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ review.position }}</p>
                          </div>
                        </div>
                        <div class="flex items-center">
                          <div class="flex mr-2">
                            <i v-for="n in 5" :key="n" :class="[
                              'fas fa-star text-sm',
                              n <= review.rating ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600'
                            ]"></i>
                          </div>
                          <span class="text-sm text-gray-500 dark:text-gray-400">{{ review.date }}</span>
                        </div>
                      </div>
                      <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ review.comment }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
              <div class="sticky top-8 space-y-8">
                <!-- Quick Contact Card -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-200 dark:border-gray-700">
                  <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Get Started Today</h3>
                  <div class="space-y-4">
                    <div class="text-center">
                      <div class="text-3xl font-bold gradient-text mb-1">{{ service.pricing.display }}</div>
                      <div v-if="service.pricing.period" class="text-sm text-gray-500 dark:text-gray-400">{{ service.pricing.period }}</div>
                    </div>
                    <button @click="showContactModal = true" class="w-full gradient-btn text-white py-3 rounded-lg font-semibold hover:opacity-90 transition-opacity">
                      <i class="fas fa-rocket mr-2"></i>
                      Start Now
                    </button>
                    <button class="w-full border-2 border-primary-600 dark:border-primary-400 text-primary-600 dark:text-primary-400 py-3 rounded-lg font-semibold hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-colors">
                      <i class="fas fa-comments mr-2"></i>
                      Free Consultation
                    </button>
                  </div>
                </div>

                <!-- Contact Info -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-200 dark:border-gray-700">
                  <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Have Questions?</h3>
                  <div class="space-y-4">
                    <div class="flex items-center">
                      <i class="fas fa-phone text-primary-600 dark:text-primary-400 mr-3"></i>
                      <span>+1 (555) 123-4567</span>
                    </div>
                    <div class="flex items-center">
                      <i class="fas fa-envelope text-primary-600 dark:text-primary-400 mr-3"></i>
                      <span>services@devopsjungle.com</span>
                    </div>
                    <div class="flex items-center">
                      <i class="fas fa-clock text-primary-600 dark:text-primary-400 mr-3"></i>
                      <span>24/7 Support Available</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Contact Modal -->
    <div v-if="showContactModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
      <div class="bg-white dark:bg-gray-800 rounded-2xl max-w-md w-full p-6">
        <div class="flex justify-between items-center mb-6">
          <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Get Started</h3>
          <button @click="showContactModal = false" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
            <i class="fas fa-times text-xl"></i>
          </button>
        </div>

        <form @submit.prevent="submitContactForm" class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Full Name</label>
            <input v-model="contactForm.name" type="text" required class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-primary-500 dark:focus:border-primary-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
            <input v-model="contactForm.email" type="email" required class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-primary-500 dark:focus:border-primary-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Phone</label>
            <input v-model="contactForm.phone" type="tel" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-primary-500 dark:focus:border-primary-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Message</label>
            <textarea v-model="contactForm.message" rows="4" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-primary-500 dark:focus:border-primary-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100" placeholder="Tell us about your requirements..."></textarea>
          </div>
          <button type="submit" :disabled="isSubmitting" class="w-full gradient-btn text-white py-3 rounded-lg font-semibold hover:opacity-90 transition-opacity disabled:opacity-50">
            <span v-if="!isSubmitting">Send Message</span>
            <span v-else class="flex items-center justify-center">
              <i class="fas fa-spinner fa-spin mr-2"></i>
              Sending...
            </span>
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, computed } from 'vue'

export default {
  name: 'ServiceDetail',
  props: {
    service: {
      type: Object,
      required: true
    }
  },
  setup() {
    const activeTab = ref('overview')
    const showContactModal = ref(false)
    const isSubmitting = ref(false)

    const contactForm = ref({
      name: '',
      email: '',
      phone: '',
      message: ''
    })

    const tabs = [
      { id: 'overview', name: 'Overview' },
      { id: 'process', name: 'Our Process' },
      { id: 'pricing', name: 'Pricing' },
      { id: 'reviews', name: 'Reviews' }
    ]

    const getCategoryName = (category) => {
      const names = {
        'training': 'Training',
        'consulting': 'Consulting',
        'mentoring': 'Mentoring',
        'job-assistance': 'Job Assistance',
        'bootcamp': 'Bootcamp',
        'assessment': 'Assessment'
      }
      return names[category] || category
    }

    const formatNumber = (num) => {
      if (num >= 1000000) return (num / 1000000).toFixed(1) + 'M'
      if (num >= 1000) return (num / 1000).toFixed(1) + 'K'
      return num.toString()
    }

    const getRequirements = () => {
      return [
        'Basic understanding of technology concepts',
        'Access to computer and internet',
        'Commitment to learning and growth',
        'Professional communication skills'
      ]
    }

    const getProcessSteps = () => {
      return [
        {
          title: 'Initial Consultation',
          description: 'We discuss your needs, goals, and current situation to create a customized plan.'
        },
        {
          title: 'Strategy Development',
          description: 'Our experts develop a tailored strategy based on your specific requirements.'
        },
        {
          title: 'Implementation',
          description: 'We execute the plan with regular check-ins and progress updates.'
        },
        {
          title: 'Review & Optimize',
          description: 'Continuous monitoring and optimization to ensure maximum results.'
        }
      ]
    }

    const getPricingBenefits = () => {
      return [
        'Expert guidance and support',
        'Customized approach for your needs',
        'Regular progress tracking',
        'Money-back guarantee',
        '24/7 customer support'
      ]
    }

    const getReviews = () => {
      return [
        {
          id: 1,
          author: 'Sarah Johnson',
          position: 'DevOps Engineer at TechCorp',
          rating: 5,
          date: '2 weeks ago',
          comment: 'Exceptional service! The team helped me transition into DevOps and I landed my dream job within 3 months. Highly recommended!'
        },
        {
          id: 2,
          author: 'Michael Chen',
          position: 'Senior SRE at CloudScale',
          rating: 5,
          date: '1 month ago',
          comment: 'Professional, knowledgeable, and results-driven. The mentoring program was exactly what I needed to advance my career.'
        },
        {
          id: 3,
          author: 'Emily Rodriguez',
          position: 'Cloud Architect at InnovateTech',
          rating: 5,
          date: '6 weeks ago',
          comment: 'The training was comprehensive and practical. I gained real-world skills that I use every day in my current role.'
        }
      ]
    }

    const submitContactForm = async () => {
      isSubmitting.value = true

      // Simulate API call
      await new Promise(resolve => setTimeout(resolve, 2000))

      // Reset form and close modal
      contactForm.value = {
        name: '',
        email: '',
        phone: '',
        message: ''
      }

      isSubmitting.value = false
      showContactModal.value = false

      // Show success message (you can implement a toast notification here)
      alert('Thank you! We will contact you shortly.')
    }

    return {
      activeTab,
      showContactModal,
      isSubmitting,
      contactForm,
      tabs,
      getCategoryName,
      formatNumber,
      getRequirements,
      getProcessSteps,
      getPricingBenefits,
      getReviews,
      submitContactForm
    }
  }
}
</script>

<style scoped>
.gradient-btn {
  background: linear-gradient(135deg, #047857 0%, #10b981 100%);
}

.service-gradient {
  background: linear-gradient(135deg, #047857 0%, #10b981 100%);
}

.gradient-text {
  background: linear-gradient(135deg, #047857 0%, #10b981 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.dark .gradient-text {
  background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}
</style>