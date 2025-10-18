<template>
  <div class="bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 transition-colors duration-200">
    <!-- Include AOS -->
    <Head>
      <title>DevOps Services - DevOps Jungle</title>
      <meta name="description" content="Professional DevOps services including training, consulting, mentoring, job assistance, and career preparation. Transform your DevOps journey with expert guidance.">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    </Head>

    <!-- Header -->
    <DevOpsHeader />

    <!-- Main Content -->
    <main>
      <!-- Hero Section -->
      <section class="gradient-bg py-16 lg:py-20">
        <div class="max-w-7xl mx-auto px-4">
          <div class="text-center mb-12" data-aos="fade-up">
            <div class="flex justify-center mb-6">
              <!-- Animated Service Icon -->
              <div class="relative">
                <div class="w-24 h-24 gradient-btn rounded-2xl flex items-center justify-center animate-float">
                  <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 14l9-5-9-5-9 5 9 5z"/>
                    <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                  </svg>
                </div>
                <div class="absolute -top-2 -right-2 w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center animate-bounce">
                  <i class="fas fa-handshake text-yellow-800 text-sm"></i>
                </div>
              </div>
            </div>
            <h1 class="text-4xl lg:text-6xl font-bold text-gray-800 dark:text-white mb-6 leading-tight">
              Professional <span class="gradient-text">DevOps Services</span>
            </h1>
            <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-3xl mx-auto leading-relaxed">
              Accelerate your DevOps journey with our comprehensive services. From expert training and consulting to career guidance and job assistance - we've got you covered.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
              <div class="flex items-center text-gray-600 dark:text-gray-300">
                <i class="fas fa-award text-blue-500 mr-2"></i>
                <span>Expert Consultants</span>
              </div>
              <div class="flex items-center text-gray-600 dark:text-gray-300">
                <i class="fas fa-users text-green-500 mr-2"></i>
                <span>5000+ Successful Projects</span>
              </div>
              <div class="flex items-center text-gray-600 dark:text-gray-300">
                <i class="fas fa-briefcase text-purple-500 mr-2"></i>
                <span>95% Job Placement Rate</span>
              </div>
            </div>
          </div>

          <!-- Stats -->
          <div class="grid grid-cols-2 lg:grid-cols-4 gap-6" data-aos="fade-up" data-aos-delay="200">
            <div class="text-center">
              <div class="text-3xl font-bold gradient-text">{{ stats.totalServices }}</div>
              <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Total Services</p>
            </div>
            <div class="text-center">
              <div class="text-3xl font-bold gradient-text">{{ stats.completedProjects }}</div>
              <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Completed Projects</p>
            </div>
            <div class="text-center">
              <div class="text-3xl font-bold gradient-text">{{ stats.successRate }}%</div>
              <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Success Rate</p>
            </div>
            <div class="text-center">
              <div class="text-3xl font-bold gradient-text">{{ stats.expertConsultants }}</div>
              <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Expert Consultants</p>
            </div>
          </div>
        </div>
      </section>

      <!-- Filters Section -->
      <section class="py-8 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 sticky top-16 z-40">
        <div class="max-w-7xl mx-auto px-4">
          <ServiceFilters
            :categories="categories"
            :selected-category="selectedCategory"
            :search-query="searchQuery"
            :type-filter="typeFilter"
            :price-filter="priceFilter"
            :sort-option="sortOption"
            @category-change="handleCategoryChange"
            @search-change="handleSearchChange"
            @type-change="handleTypeChange"
            @price-change="handlePriceChange"
            @sort-change="handleSortChange"
            @clear-filters="clearFilters"
          />
        </div>
      </section>

      <!-- Results Section -->
      <section class="py-16 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4">
          <!-- Results Header -->
          <div class="flex justify-between items-center mb-8" data-aos="fade-up">
            <div>
              <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                {{ filteredServices.length }} {{ selectedCategory === 'all' ? 'Professional Services' : `${getCategoryName(selectedCategory)} Services` }}
              </h2>
              <p class="text-gray-600 dark:text-gray-300 mt-1">
                {{ searchQuery ? `Results for "${searchQuery}"` : 'Choose the perfect service to accelerate your DevOps career' }}
              </p>
            </div>
          </div>

          <!-- No Results -->
          <div v-if="filteredServices.length === 0" class="text-center py-16" data-aos="fade-up">
            <div class="w-24 h-24 mx-auto mb-6 text-gray-400 dark:text-gray-500">
              <i class="fas fa-search text-6xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">No services found</h3>
            <p class="text-gray-600 dark:text-gray-300 mb-6">Try adjusting your filters or search terms</p>
            <button @click="clearFilters" class="gradient-btn text-white px-6 py-2 rounded-lg font-medium hover:opacity-90 transition-opacity">
              Clear All Filters
            </button>
          </div>

          <!-- Service Cards Grid -->
          <div v-else class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <ServiceCard
              v-for="(service, index) in filteredServices"
              :key="service.id"
              :service="service"
              :data-aos="'fade-up'"
              :data-aos-delay="index * 100"
              @get-started="handleGetStarted"
              @learn-more="handleLearnMore"
            />
          </div>

          <!-- Load More Button -->
          <div v-if="canLoadMore" class="text-center mt-12" data-aos="fade-up">
            <button @click="loadMore" class="gradient-btn text-white px-8 py-3 rounded-lg font-semibold hover:opacity-90 transform hover:scale-105 transition-all duration-200">
              <i class="fas fa-plus mr-2"></i>
              Load More Services
            </button>
          </div>
        </div>
      </section>

      <!-- Why Choose Us Section -->
      <section class="py-16 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4">
          <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-800 dark:text-white mb-4">
              Why Choose DevOps Jungle?
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
              We're committed to your success with proven methodologies and industry expertise
            </p>
          </div>

          <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center" data-aos="fade-up" data-aos-delay="100">
              <div class="w-16 h-16 gradient-btn rounded-xl flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-medal text-white text-2xl"></i>
              </div>
              <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Industry Experts</h3>
              <p class="text-gray-600 dark:text-gray-300">Learn from professionals with 10+ years of DevOps experience in Fortune 500 companies.</p>
            </div>

            <div class="text-center" data-aos="fade-up" data-aos-delay="200">
              <div class="w-16 h-16 gradient-btn rounded-xl flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-chart-line text-white text-2xl"></i>
              </div>
              <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Proven Results</h3>
              <p class="text-gray-600 dark:text-gray-300">95% job placement rate and 98% client satisfaction with measurable career growth.</p>
            </div>

            <div class="text-center" data-aos="fade-up" data-aos-delay="300">
              <div class="w-16 h-16 gradient-btn rounded-xl flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-clock text-white text-2xl"></i>
              </div>
              <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Flexible Scheduling</h3>
              <p class="text-gray-600 dark:text-gray-300">Personalized scheduling that fits your lifestyle and learning preferences.</p>
            </div>

            <div class="text-center" data-aos="fade-up" data-aos-delay="400">
              <div class="w-16 h-16 gradient-btn rounded-xl flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-heart text-white text-2xl"></i>
              </div>
              <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Lifetime Support</h3>
              <p class="text-gray-600 dark:text-gray-300">Ongoing support and mentorship even after completing your service.</p>
            </div>
          </div>
        </div>
      </section>

      <!-- CTA Section -->
      <section class="py-16 gradient-bg">
        <div class="max-w-4xl mx-auto px-4 text-center" data-aos="fade-up">
          <h2 class="text-3xl lg:text-4xl font-bold text-gray-800 dark:text-white mb-6">
            Ready to Transform Your DevOps Career?
          </h2>
          <p class="text-lg text-gray-600 dark:text-gray-300 mb-8">
            Schedule a free consultation to discuss your goals and find the perfect service for your needs
          </p>
          <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <button class="gradient-btn text-white px-8 py-4 rounded-lg text-lg font-semibold hover:opacity-90 transform hover:scale-105 transition-all duration-200">
              <i class="fas fa-calendar mr-2"></i>
              Schedule Free Consultation
            </button>
            <button class="border-2 border-primary-600 dark:border-primary-400 text-primary-600 dark:text-primary-400 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-primary-50 dark:hover:bg-primary-900 transform hover:scale-105 transition-all duration-200">
              <i class="fas fa-phone mr-2"></i>
              Call Us Now
            </button>
          </div>
        </div>
      </section>
    </main>

    <!-- Footer -->
    <DevOpsFooter />
  </div>
</template>

<script>
import { Head } from '@inertiajs/vue3'
import DevOpsHeader from '../Common/Header.vue'
import DevOpsFooter from '../Common/Footer.vue'
import ServiceFilters from './Components/ServiceFilters.vue'
import ServiceCard from './Components/ServiceCard.vue'

export default {
  name: 'ServicesPage',
  components: {
    Head,
    DevOpsHeader,
    DevOpsFooter,
    ServiceFilters,
    ServiceCard
  },
  data() {
    return {
      selectedCategory: 'all',
      searchQuery: '',
      typeFilter: 'all',
      priceFilter: 'all',
      sortOption: 'popularity',
      displayLimit: 12,
      stats: {
        totalServices: '18+',
        completedProjects: '5000+',
        successRate: 95,
        expertConsultants: 25
      },

      categories: [
        { id: 'all', name: 'All Services', icon: 'fas fa-th-large', count: 18 },
        { id: 'training', name: 'Training', icon: 'fas fa-graduation-cap', count: 5 },
        { id: 'consulting', name: 'Consulting', icon: 'fas fa-cogs', count: 4 },
        { id: 'mentoring', name: 'Mentoring', icon: 'fas fa-user-tie', count: 3 },
        { id: 'job-assistance', name: 'Job Assistance', icon: 'fas fa-briefcase', count: 3 },
        { id: 'bootcamp', name: 'Bootcamps', icon: 'fas fa-rocket', count: 2 },
        { id: 'assessment', name: 'Assessment', icon: 'fas fa-clipboard-check', count: 1 }
      ],

      services: [
        // Training Services
        {
          id: 'corporate-devops-training',
          title: 'Corporate DevOps Training',
          category: 'training',
          description: 'Comprehensive DevOps training programs designed for enterprise teams. Covers CI/CD, cloud platforms, containerization, and automation.',
          icon: 'fas fa-building',
          features: [
            'Customized curriculum for your tech stack',
            'Hands-on workshops and labs',
            'Team collaboration exercises',
            'Progress tracking and assessments',
            'Post-training support and resources',
            'Certificate of completion'
          ],
          duration: '2-4 weeks',
          deliveryTime: '1-2 weeks',
          type: 'Corporate',
          rating: 4.9,
          reviews: 156,
          clients: 240,
          pricing: {
            display: 'Custom Quote',
            period: '',
            originalPrice: null,
            savings: null
          },
          popular: true
        },
        {
          id: 'individual-devops-mastery',
          title: 'Individual DevOps Mastery Program',
          category: 'training',
          description: 'Intensive one-on-one DevOps training program tailored to your specific career goals and current skill level.',
          icon: 'fas fa-user-graduate',
          features: [
            'Personalized learning path',
            'Weekly 1-on-1 sessions',
            'Real-world project assignments',
            'Career guidance and roadmap',
            'Resume and portfolio review',
            'Interview preparation'
          ],
          duration: '12 weeks',
          deliveryTime: '1 week',
          type: 'Individual',
          rating: 4.8,
          reviews: 89,
          clients: 320,
          pricing: {
            display: '$2,499',
            period: '',
            originalPrice: 3299,
            savings: 24
          },
          popular: false
        },
        {
          id: 'aws-devops-specialist',
          title: 'AWS DevOps Specialist Training',
          category: 'training',
          description: 'Become an AWS DevOps expert with comprehensive training on AWS services, automation, and best practices.',
          icon: 'fab fa-aws',
          features: [
            'AWS DevOps Professional certification prep',
            'Hands-on AWS labs',
            'CI/CD with AWS native tools',
            'Infrastructure as Code with CloudFormation',
            'Monitoring and logging strategies',
            'Cost optimization techniques'
          ],
          duration: '8 weeks',
          deliveryTime: '3-5 days',
          type: 'Group',
          rating: 4.7,
          reviews: 203,
          clients: 445,
          pricing: {
            display: '$1,299',
            period: '',
            originalPrice: 1799,
            savings: 28
          },
          popular: true
        },
        {
          id: 'kubernetes-orchestration',
          title: 'Kubernetes Orchestration Mastery',
          category: 'training',
          description: 'Master container orchestration with Kubernetes. From basics to advanced cluster management and production deployment.',
          icon: 'fas fa-dharmachakra',
          features: [
            'Kubernetes fundamentals to advanced',
            'Cluster setup and management',
            'Application deployment strategies',
            'Monitoring and troubleshooting',
            'Security best practices',
            'CKA/CKAD exam preparation'
          ],
          duration: '6 weeks',
          deliveryTime: '1 week',
          type: 'Group',
          rating: 4.8,
          reviews: 167,
          clients: 298,
          pricing: {
            display: '$999',
            period: '',
            originalPrice: 1399,
            savings: 29
          },
          popular: false
        },
        {
          id: 'cicd-pipeline-bootcamp',
          title: 'CI/CD Pipeline Bootcamp',
          category: 'training',
          description: 'Intensive bootcamp covering modern CI/CD practices with Jenkins, GitLab CI, GitHub Actions, and deployment strategies.',
          icon: 'fas fa-code-branch',
          features: [
            'Multi-platform CI/CD tools',
            'Pipeline as Code practices',
            'Automated testing integration',
            'Deployment strategies and rollbacks',
            'Security scanning and compliance',
            'Performance monitoring integration'
          ],
          duration: '4 weeks',
          deliveryTime: '1 week',
          type: 'Group',
          rating: 4.6,
          reviews: 134,
          clients: 187,
          pricing: {
            display: '$799',
            period: '',
            originalPrice: 1099,
            savings: 27
          },
          popular: false
        },

        // Consulting Services
        {
          id: 'devops-transformation-consulting',
          title: 'DevOps Transformation Consulting',
          category: 'consulting',
          description: 'End-to-end DevOps transformation consulting for organizations looking to modernize their software delivery practices.',
          icon: 'fas fa-chart-line',
          features: [
            'Current state assessment',
            'DevOps strategy development',
            'Tool selection and implementation',
            'Process optimization',
            'Team training and change management',
            'Success metrics and KPIs'
          ],
          duration: '3-6 months',
          deliveryTime: '1 week',
          type: 'Corporate',
          rating: 4.9,
          reviews: 67,
          clients: 89,
          pricing: {
            display: 'From $15K',
            period: '/project',
            originalPrice: null,
            savings: null
          },
          popular: true
        },
        {
          id: 'cloud-migration-strategy',
          title: 'Cloud Migration Strategy & Implementation',
          category: 'consulting',
          description: 'Expert guidance for migrating applications and infrastructure to cloud platforms with minimal downtime and risk.',
          icon: 'fas fa-cloud-upload-alt',
          features: [
            'Migration readiness assessment',
            'Cloud platform selection',
            'Migration strategy and roadmap',
            'Risk mitigation planning',
            'Cost optimization analysis',
            'Post-migration optimization'
          ],
          duration: '2-4 months',
          deliveryTime: '1-2 weeks',
          type: 'Corporate',
          rating: 4.8,
          reviews: 45,
          clients: 72,
          pricing: {
            display: 'From $12K',
            period: '/project',
            originalPrice: null,
            savings: null
          },
          popular: false
        },
        {
          id: 'security-compliance-audit',
          title: 'DevSecOps & Compliance Audit',
          category: 'consulting',
          description: 'Comprehensive security and compliance audit of your DevOps practices with actionable recommendations.',
          icon: 'fas fa-shield-alt',
          features: [
            'Security posture assessment',
            'Compliance gap analysis',
            'Vulnerability management review',
            'DevSecOps tool integration',
            'Policy and procedure development',
            'Remediation roadmap'
          ],
          duration: '4-6 weeks',
          deliveryTime: '1 week',
          type: 'Corporate',
          rating: 4.7,
          reviews: 38,
          clients: 56,
          pricing: {
            display: 'From $8K',
            period: '/audit',
            originalPrice: null,
            savings: null
          },
          popular: false
        },
        {
          id: 'performance-optimization',
          title: 'Performance Optimization Consulting',
          category: 'consulting',
          description: 'Optimize your application and infrastructure performance with expert analysis and implementation strategies.',
          icon: 'fas fa-tachometer-alt',
          features: [
            'Performance bottleneck analysis',
            'Infrastructure optimization',
            'Application performance tuning',
            'Monitoring and alerting setup',
            'Capacity planning',
            'Cost vs performance optimization'
          ],
          duration: '6-8 weeks',
          deliveryTime: '1 week',
          type: 'Corporate',
          rating: 4.6,
          reviews: 29,
          clients: 43,
          pricing: {
            display: 'From $10K',
            period: '/project',
            originalPrice: null,
            savings: null
          },
          popular: false
        },

        // Mentoring Services
        {
          id: 'senior-devops-mentoring',
          title: 'Senior DevOps Engineer Mentoring',
          category: 'mentoring',
          description: 'One-on-one mentoring with senior DevOps engineers to accelerate your career growth and technical expertise.',
          icon: 'fas fa-user-tie',
          features: [
            'Weekly 1-on-1 video sessions',
            'Personalized career roadmap',
            'Code and architecture reviews',
            'Interview preparation and practice',
            'Industry insights and networking',
            'Goal setting and progress tracking'
          ],
          duration: '6 months',
          deliveryTime: '2-3 days',
          type: 'Individual',
          rating: 4.9,
          reviews: 142,
          clients: 186,
          pricing: {
            display: '$299',
            period: '/month',
            originalPrice: 399,
            savings: 25
          },
          popular: true
        },
        {
          id: 'leadership-transition-coaching',
          title: 'Technical Leadership Transition Coaching',
          category: 'mentoring',
          description: 'Specialized coaching for engineers transitioning to technical leadership roles in DevOps organizations.',
          icon: 'fas fa-crown',
          features: [
            'Leadership skills development',
            'Team management strategies',
            'Technical decision making',
            'Stakeholder communication',
            'Conflict resolution techniques',
            'Engineering culture building'
          ],
          duration: '4 months',
          deliveryTime: '1 week',
          type: 'Individual',
          rating: 4.8,
          reviews: 67,
          clients: 89,
          pricing: {
            display: '$449',
            period: '/month',
            originalPrice: 599,
            savings: 25
          },
          popular: false
        },
        {
          id: 'startup-cto-advisory',
          title: 'Startup CTO Advisory',
          category: 'mentoring',
          description: 'Strategic technical advisory for startup CTOs and technical founders building scalable DevOps practices.',
          icon: 'fas fa-rocket',
          features: [
            'Technical strategy planning',
            'Architecture and scalability review',
            'Team building and hiring',
            'Vendor and tool selection',
            'Investor presentation support',
            'Technical due diligence preparation'
          ],
          duration: '12 months',
          deliveryTime: '1 week',
          type: 'Individual',
          rating: 4.7,
          reviews: 23,
          clients: 31,
          pricing: {
            display: '$799',
            period: '/month',
            originalPrice: null,
            savings: null
          },
          popular: false
        },

        // Job Assistance Services
        {
          id: 'devops-job-placement',
          title: 'DevOps Job Placement Program',
          category: 'job-assistance',
          description: 'Comprehensive job placement assistance with resume optimization, interview coaching, and direct employer connections.',
          icon: 'fas fa-briefcase',
          features: [
            'Resume and LinkedIn optimization',
            'Portfolio project development',
            'Mock interview sessions',
            'Salary negotiation coaching',
            'Direct employer connections',
            'Job placement guarantee'
          ],
          duration: '3 months',
          deliveryTime: '1 week',
          type: 'Individual',
          rating: 4.8,
          reviews: 234,
          clients: 312,
          pricing: {
            display: '$1,499',
            period: '',
            originalPrice: 1999,
            savings: 25
          },
          popular: true
        },
        {
          id: 'career-transition-support',
          title: 'Career Transition Support',
          category: 'job-assistance',
          description: 'Specialized support for professionals transitioning from other IT roles into DevOps positions.',
          icon: 'fas fa-exchange-alt',
          features: [
            'Skills gap analysis',
            'Targeted learning plan',
            'Transition timeline planning',
            'Industry networking introductions',
            'Transition story development',
            'Ongoing support during transition'
          ],
          duration: '4 months',
          deliveryTime: '1 week',
          type: 'Individual',
          rating: 4.7,
          reviews: 98,
          clients: 156,
          pricing: {
            display: '$899',
            period: '',
            originalPrice: 1199,
            savings: 25
          },
          popular: false
        },
        {
          id: 'freelance-devops-setup',
          title: 'Freelance DevOps Consultant Setup',
          category: 'job-assistance',
          description: 'Complete setup and guidance for starting a successful DevOps freelancing or consulting practice.',
          icon: 'fas fa-laptop-code',
          features: [
            'Business setup and legal guidance',
            'Service offering development',
            'Pricing strategy consultation',
            'Client acquisition strategies',
            'Contract templates and proposals',
            'Ongoing business mentoring'
          ],
          duration: '2 months',
          deliveryTime: '1 week',
          type: 'Individual',
          rating: 4.6,
          reviews: 45,
          clients: 67,
          pricing: {
            display: '$1,199',
            period: '',
            originalPrice: 1599,
            savings: 25
          },
          popular: false
        },

        // Bootcamp Services
        {
          id: 'devops-career-bootcamp',
          title: 'DevOps Career Acceleration Bootcamp',
          category: 'bootcamp',
          description: 'Intensive 12-week bootcamp combining technical training, hands-on projects, and career preparation.',
          icon: 'fas fa-rocket',
          features: [
            '12-week intensive program',
            'Full-stack DevOps curriculum',
            'Real-world project portfolio',
            'Industry mentor assignment',
            'Job placement assistance',
            'Alumni network access'
          ],
          duration: '12 weeks',
          deliveryTime: '2 weeks',
          type: 'Group',
          rating: 4.9,
          reviews: 178,
          clients: 234,
          pricing: {
            display: '$4,999',
            period: '',
            originalPrice: 6999,
            savings: 29
          },
          popular: true
        },
        {
          id: 'weekend-devops-intensive',
          title: 'Weekend DevOps Intensive',
          category: 'bootcamp',
          description: 'Weekend-focused intensive program for working professionals looking to transition into DevOps.',
          icon: 'fas fa-calendar-weekend',
          features: [
            '8-weekend program',
            'Flexible weekend schedule',
            'Working professional focused',
            'Project-based learning',
            'Career transition support',
            'Networking opportunities'
          ],
          duration: '8 weeks',
          deliveryTime: '1 week',
          type: 'Group',
          rating: 4.7,
          reviews: 89,
          clients: 123,
          pricing: {
            display: '$2,999',
            period: '',
            originalPrice: 3999,
            savings: 25
          },
          popular: false
        },

        // Assessment Services
        {
          id: 'devops-skills-assessment',
          title: 'Comprehensive DevOps Skills Assessment',
          category: 'assessment',
          description: 'Detailed assessment of your current DevOps skills with personalized learning recommendations and career guidance.',
          icon: 'fas fa-clipboard-check',
          features: [
            'Comprehensive skills evaluation',
            'Technical interview simulation',
            'Detailed feedback report',
            'Learning roadmap creation',
            'Career guidance session',
            'Progress tracking recommendations'
          ],
          duration: '1 week',
          deliveryTime: '2-3 days',
          type: 'Individual',
          rating: 4.8,
          reviews: 156,
          clients: 298,
          pricing: {
            display: '$199',
            period: '',
            originalPrice: 299,
            savings: 33
          },
          popular: false
        }
      ]
    }
  },
  computed: {
    filteredServices() {
      let filtered = [...this.services]

      // Category filter
      if (this.selectedCategory !== 'all') {
        filtered = filtered.filter(service => service.category === this.selectedCategory)
      }

      // Search filter
      if (this.searchQuery) {
        const query = this.searchQuery.toLowerCase()
        filtered = filtered.filter(service =>
          service.title.toLowerCase().includes(query) ||
          service.description.toLowerCase().includes(query) ||
          service.features.some(feature => feature.toLowerCase().includes(query))
        )
      }

      // Type filter
      if (this.typeFilter !== 'all') {
        filtered = filtered.filter(service => service.type.toLowerCase() === this.typeFilter)
      }

      // Price filter
      if (this.priceFilter !== 'all') {
        filtered = filtered.filter(service => {
          const price = this.extractPrice(service.pricing.display)
          if (this.priceFilter === 'free') return price === 0
          if (this.priceFilter === 'under-100') return price > 0 && price < 100
          if (this.priceFilter === '100-500') return price >= 100 && price <= 500
          if (this.priceFilter === '500-1000') return price > 500 && price <= 1000
          if (this.priceFilter === 'over-1000') return price > 1000
          return true
        })
      }

      // Sort
      switch (this.sortOption) {
        case 'popularity':
          filtered.sort((a, b) => b.clients - a.clients)
          break
        case 'rating':
          filtered.sort((a, b) => b.rating - a.rating)
          break
        case 'price-low':
          filtered.sort((a, b) => this.extractPrice(a.pricing.display) - this.extractPrice(b.pricing.display))
          break
        case 'price-high':
          filtered.sort((a, b) => this.extractPrice(b.pricing.display) - this.extractPrice(a.pricing.display))
          break
        case 'newest':
          // Assume services are already in newest first order
          break
        case 'duration':
          filtered.sort((a, b) => this.extractDuration(a.duration) - this.extractDuration(b.duration))
          break
      }

      return filtered.slice(0, this.displayLimit)
    },
    canLoadMore() {
      return this.displayLimit < this.services.length
    }
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
    },
    handleCategoryChange(category) {
      this.selectedCategory = category
      this.displayLimit = 12
    },
    handleSearchChange(query) {
      this.searchQuery = query
      this.displayLimit = 12
    },
    handleTypeChange(type) {
      this.typeFilter = type
      this.displayLimit = 12
    },
    handlePriceChange(price) {
      this.priceFilter = price
      this.displayLimit = 12
    },
    handleSortChange(sort) {
      this.sortOption = sort
    },
    clearFilters() {
      this.selectedCategory = 'all'
      this.searchQuery = ''
      this.typeFilter = 'all'
      this.priceFilter = 'all'
      this.sortOption = 'popularity'
      this.displayLimit = 12
    },
    loadMore() {
      this.displayLimit += 12
    },
    getCategoryName(categoryId) {
      const category = this.categories.find(cat => cat.id === categoryId)
      return category ? category.name : categoryId.toUpperCase()
    },
    handleGetStarted(service) {
      // Navigate to service detail page or open contact form
      this.$inertia.visit(`/services/${service.id}`)
    },
    handleLearnMore(service) {
      // Navigate to service detail page
      this.$inertia.visit(`/services/${service.id}`)
    },
    extractPrice(priceString) {
      const match = priceString.match(/\$?(\d{1,3}(?:,\d{3})*(?:\.\d{2})?)/)
      return match ? parseInt(match[1].replace(',', '')) : 0
    },
    extractDuration(durationString) {
      const match = durationString.match(/(\d+)/)
      return match ? parseInt(match[1]) : 0
    }
  }
}
</script>

<style scoped>
.gradient-btn {
  background: linear-gradient(135deg, #047857 0%, #10b981 100%);
}

.gradient-bg {
  background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 50%, #bbf7d0 100%);
}

.dark .gradient-bg {
  background: linear-gradient(135deg, #047857 0%, #065f46 50%, #064e3b 100%);
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

@keyframes float {
  0%, 100% {
    transform: translateY(0px);
  }
  50% {
    transform: translateY(-10px);
  }
}

.animate-float {
  animation: float 3s ease-in-out infinite;
}
</style>