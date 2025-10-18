<template>
  <div class="bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 transition-colors duration-200">
    <!-- Include AOS -->
    <Head>
      <title>Exam Dumps - DevOps Jungle</title>
      <meta name="description" content="Access comprehensive exam dumps for AWS, Azure, and GCP certifications. Updated questions, practice tests, and study materials for DevOps professionals.">
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
              <!-- Animated Exam Icon -->
              <div class="relative">
                <div class="w-24 h-24 gradient-btn rounded-2xl flex items-center justify-center animate-float">
                  <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                  </svg>
                </div>
                <div class="absolute -top-2 -right-2 w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center animate-bounce">
                  <i class="fas fa-star text-yellow-800 text-sm"></i>
                </div>
              </div>
            </div>
            <h1 class="text-4xl lg:text-6xl font-bold text-gray-800 dark:text-white mb-6 leading-tight">
              Premium <span class="gradient-text">Exam Dumps</span>
            </h1>
            <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-3xl mx-auto leading-relaxed">
              Ace your cloud certifications with our comprehensive, up-to-date exam dumps. Real questions, detailed explanations, and guaranteed success.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
              <div class="flex items-center text-gray-600 dark:text-gray-300">
                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                <span>95%+ Success Rate</span>
              </div>
              <div class="flex items-center text-gray-600 dark:text-gray-300">
                <i class="fas fa-sync-alt text-blue-500 mr-2"></i>
                <span>Updated Monthly</span>
              </div>
              <div class="flex items-center text-gray-600 dark:text-gray-300">
                <i class="fas fa-shield-alt text-purple-500 mr-2"></i>
                <span>100% Valid Questions</span>
              </div>
            </div>
          </div>

          <!-- Stats -->
          <div class="grid grid-cols-2 lg:grid-cols-4 gap-6" data-aos="fade-up" data-aos-delay="200">
            <div class="text-center">
              <div class="text-3xl font-bold gradient-text">{{ stats.totalExams }}</div>
              <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Total Exams</p>
            </div>
            <div class="text-center">
              <div class="text-3xl font-bold gradient-text">{{ stats.totalQuestions }}</div>
              <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Questions</p>
            </div>
            <div class="text-center">
              <div class="text-3xl font-bold gradient-text">{{ stats.successRate }}%</div>
              <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Success Rate</p>
            </div>
            <div class="text-center">
              <div class="text-3xl font-bold gradient-text">{{ stats.satisfied }}K+</div>
              <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Satisfied Users</p>
            </div>
          </div>
        </div>
      </section>

      <!-- Filters Section -->
      <section class="py-8 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 sticky top-16 z-40">
        <div class="max-w-7xl mx-auto px-4">
          <ExamFilters
            :categories="categories"
            :selected-category="selectedCategory"
            :search-query="searchQuery"
            :difficulty-filter="difficultyFilter"
            :sort-option="sortOption"
            @category-change="handleCategoryChange"
            @search-change="handleSearchChange"
            @difficulty-change="handleDifficultyChange"
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
                {{ filteredExams.length }} {{ selectedCategory === 'all' ? 'Exam Dumps' : `${getCategoryName(selectedCategory)} Exams` }}
              </h2>
              <p class="text-gray-600 dark:text-gray-300 mt-1">
                {{ searchQuery ? `Results for "${searchQuery}"` : 'Choose your certification path' }}
              </p>
            </div>
            <div class="flex items-center space-x-4">
              <button @click="toggleViewMode" class="p-2 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                <i :class="viewMode === 'grid' ? 'fas fa-list' : 'fas fa-th-large'" class="text-gray-600 dark:text-gray-300"></i>
              </button>
            </div>
          </div>

          <!-- No Results -->
          <div v-if="filteredExams.length === 0" class="text-center py-16" data-aos="fade-up">
            <div class="w-24 h-24 mx-auto mb-6 text-gray-400 dark:text-gray-500">
              <i class="fas fa-search text-6xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">No exams found</h3>
            <p class="text-gray-600 dark:text-gray-300 mb-6">Try adjusting your filters or search terms</p>
            <button @click="clearFilters" class="gradient-btn text-white px-6 py-2 rounded-lg font-medium hover:opacity-90 transition-opacity">
              Clear All Filters
            </button>
          </div>

          <!-- Exam Cards Grid -->
          <div v-else :class="viewMode === 'grid' ? 'grid md:grid-cols-2 lg:grid-cols-3 gap-6' : 'space-y-4'">
            <ExamCard
              v-for="(exam, index) in filteredExams"
              :key="exam.id"
              :exam="exam"
              :view-mode="viewMode"
              :data-aos="'fade-up'"
              :data-aos-delay="index * 100"
              @download="handleDownload"
              @preview="handlePreview"
            />
          </div>

          <!-- Load More Button -->
          <div v-if="canLoadMore" class="text-center mt-12" data-aos="fade-up">
            <button @click="loadMore" class="gradient-btn text-white px-8 py-3 rounded-lg font-semibold hover:opacity-90 transform hover:scale-105 transition-all duration-200">
              <i class="fas fa-plus mr-2"></i>
              Load More Exams
            </button>
          </div>
        </div>
      </section>

      <!-- CTA Section -->
      <section class="py-16 gradient-bg">
        <div class="max-w-4xl mx-auto px-4 text-center" data-aos="fade-up">
          <h2 class="text-3xl lg:text-4xl font-bold text-gray-800 dark:text-white mb-6">
            Ready to Start Your Certification Journey?
          </h2>
          <p class="text-lg text-gray-600 dark:text-gray-300 mb-8">
            Join thousands of successful professionals who achieved their certifications with our premium exam dumps
          </p>
          <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <button class="gradient-btn text-white px-8 py-4 rounded-lg text-lg font-semibold hover:opacity-90 transform hover:scale-105 transition-all duration-200">
              <i class="fas fa-download mr-2"></i>
              Get All Access Pass
            </button>
            <button class="border-2 border-primary-600 dark:border-primary-400 text-primary-600 dark:text-primary-400 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-primary-50 dark:hover:bg-primary-900 transform hover:scale-105 transition-all duration-200">
              <i class="fas fa-play mr-2"></i>
              View Sample Questions
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
import ExamFilters from './Components/ExamFilters.vue'
import ExamCard from './Components/ExamCard.vue'

export default {
  name: 'ExamDumpsPage',
  components: {
    Head,
    DevOpsHeader,
    DevOpsFooter,
    ExamFilters,
    ExamCard
  },
  data() {
    return {
      selectedCategory: 'all',
      searchQuery: '',
      difficultyFilter: 'all',
      sortOption: 'popularity',
      viewMode: 'grid',
      displayLimit: 12,

      stats: {
        totalExams: 150,
        totalQuestions: 25000,
        successRate: 97,
        satisfied: 50
      },

      categories: [
        { id: 'all', name: 'All Exams', icon: 'fas fa-globe', count: 150 },
        { id: 'aws', name: 'Amazon AWS', icon: 'fab fa-aws', count: 65 },
        { id: 'azure', name: 'Microsoft Azure', icon: 'fab fa-microsoft', count: 45 },
        { id: 'gcp', name: 'Google Cloud', icon: 'fab fa-google', count: 25 },
        { id: 'kubernetes', name: 'Kubernetes', icon: 'fas fa-dharmachakra', count: 8 },
        { id: 'docker', name: 'Docker', icon: 'fab fa-docker', count: 7 }
      ],

      exams: [
        // AWS Exams
        {
          id: 'aws-saa-c03',
          title: 'AWS Certified Solutions Architect - Associate',
          code: 'SAA-C03',
          provider: 'aws',
          difficulty: 'intermediate',
          questions: 385,
          duration: 130,
          passingScore: 720,
          price: 299,
          popularity: 98,
          lastUpdated: '2024-12-15',
          successRate: 94,
          description: 'Validate technical skills and expertise in designing distributed systems on AWS.',
          topics: ['Compute', 'Storage', 'Database', 'Network & Security', 'Management & Governance'],
          prerequisites: ['1+ years AWS experience', 'Basic understanding of cloud concepts'],
          badge: 'Most Popular',
          featured: true
        },
        {
          id: 'aws-soa-c02',
          title: 'AWS Certified SysOps Administrator - Associate',
          code: 'SOA-C02',
          provider: 'aws',
          difficulty: 'intermediate',
          questions: 298,
          duration: 130,
          passingScore: 720,
          price: 299,
          popularity: 85,
          lastUpdated: '2024-12-10',
          successRate: 91,
          description: 'Demonstrate skills in deployment, management, and operations on AWS.',
          topics: ['Monitoring & Logging', 'Remediation', 'Cost & Performance', 'Security'],
          prerequisites: ['1+ years AWS operations experience']
        },
        {
          id: 'aws-dva-c02',
          title: 'AWS Certified Developer - Associate',
          code: 'DVA-C02',
          provider: 'aws',
          difficulty: 'intermediate',
          questions: 245,
          duration: 130,
          passingScore: 720,
          price: 299,
          popularity: 82,
          lastUpdated: '2024-12-12',
          successRate: 89,
          description: 'Validate proficiency in developing applications on AWS.',
          topics: ['Development', 'Security', 'Deployment', 'Troubleshooting & Optimization'],
          prerequisites: ['1+ years AWS development experience']
        },
        {
          id: 'aws-sap-c02',
          title: 'AWS Certified Solutions Architect - Professional',
          code: 'SAP-C02',
          provider: 'aws',
          difficulty: 'expert',
          questions: 450,
          duration: 180,
          passingScore: 750,
          price: 399,
          popularity: 76,
          lastUpdated: '2024-11-28',
          successRate: 85,
          description: 'Advanced skills in designing complex solutions on AWS.',
          topics: ['Design Solutions', 'Migration Planning', 'Cost Control', 'Continuous Improvement'],
          prerequisites: ['AWS Associate certification', '2+ years advanced AWS experience']
        },
        {
          id: 'aws-dop-c02',
          title: 'AWS Certified DevOps Engineer - Professional',
          code: 'DOP-C02',
          provider: 'aws',
          difficulty: 'expert',
          questions: 365,
          duration: 180,
          passingScore: 750,
          price: 399,
          popularity: 78,
          lastUpdated: '2024-12-01',
          successRate: 87,
          description: 'Demonstrate expertise in provisioning, operating, and managing AWS environments.',
          topics: ['SDLC Automation', 'Configuration Management', 'Monitoring & Logging', 'Incident Response'],
          prerequisites: ['AWS Associate certification', 'DevOps experience'],
          badge: 'High Demand'
        },

        // Azure Exams
        {
          id: 'az-900',
          title: 'Microsoft Azure Fundamentals',
          code: 'AZ-900',
          provider: 'azure',
          difficulty: 'beginner',
          questions: 180,
          duration: 85,
          passingScore: 700,
          price: 199,
          popularity: 92,
          lastUpdated: '2024-12-18',
          successRate: 96,
          description: 'Foundational knowledge of cloud services and how they are provided with Azure.',
          topics: ['Cloud Concepts', 'Core Azure Services', 'Security', 'Pricing & Support'],
          prerequisites: ['None - Entry level'],
          badge: 'Entry Level'
        },
        {
          id: 'az-104',
          title: 'Microsoft Azure Administrator',
          code: 'AZ-104',
          provider: 'azure',
          difficulty: 'intermediate',
          questions: 320,
          duration: 120,
          passingScore: 700,
          price: 299,
          popularity: 88,
          lastUpdated: '2024-12-14',
          successRate: 92,
          description: 'Skills needed to implement, manage, and monitor Azure environments.',
          topics: ['Identity & Governance', 'Storage', 'Compute', 'Virtual Networking', 'Monitoring'],
          prerequisites: ['6+ months Azure admin experience']
        },
        {
          id: 'az-204',
          title: 'Developing Solutions for Microsoft Azure',
          code: 'AZ-204',
          provider: 'azure',
          difficulty: 'intermediate',
          questions: 285,
          duration: 120,
          passingScore: 700,
          price: 299,
          popularity: 79,
          lastUpdated: '2024-12-08',
          successRate: 88,
          description: 'Skills to design, build, test, and maintain cloud applications on Azure.',
          topics: ['Azure Compute', 'Azure Storage', 'Azure Security', 'Monitoring & Optimization'],
          prerequisites: ['1+ years Azure development experience']
        },
        {
          id: 'az-400',
          title: 'Designing and Implementing Microsoft DevOps Solutions',
          code: 'AZ-400',
          provider: 'azure',
          difficulty: 'expert',
          questions: 340,
          duration: 150,
          passingScore: 700,
          price: 399,
          popularity: 73,
          lastUpdated: '2024-11-25',
          successRate: 84,
          description: 'DevOps practices that combine people, process, and technologies.',
          topics: ['Development Strategy', 'Source Control', 'Build & Release', 'Testing', 'Monitoring'],
          prerequisites: ['Azure expertise', 'DevOps experience'],
          featured: true
        },
        {
          id: 'az-305',
          title: 'Designing Microsoft Azure Infrastructure Solutions',
          code: 'AZ-305',
          provider: 'azure',
          difficulty: 'expert',
          questions: 295,
          duration: 120,
          passingScore: 700,
          price: 399,
          popularity: 71,
          lastUpdated: '2024-12-02',
          successRate: 86,
          description: 'Advanced skills for designing solutions that run on Azure.',
          topics: ['Identity & Security', 'Data Storage', 'Business Continuity', 'Infrastructure'],
          prerequisites: ['AZ-104 certification', 'Advanced Azure experience']
        },

        // GCP Exams
        {
          id: 'gcp-ace',
          title: 'Google Cloud Associate Cloud Engineer',
          code: 'ACE',
          provider: 'gcp',
          difficulty: 'intermediate',
          questions: 150,
          duration: 120,
          passingScore: 80,
          price: 250,
          popularity: 84,
          lastUpdated: '2024-12-05',
          successRate: 90,
          description: 'Deploy applications, monitor operations, and manage enterprise solutions on GCP.',
          topics: ['Cloud Console', 'Command Line', 'Compute Engine', 'Storage', 'Networking'],
          prerequisites: ['6+ months GCP experience']
        },
        {
          id: 'gcp-pca',
          title: 'Google Cloud Professional Cloud Architect',
          code: 'PCA',
          provider: 'gcp',
          difficulty: 'expert',
          questions: 200,
          duration: 120,
          passingScore: 80,
          price: 399,
          popularity: 77,
          lastUpdated: '2024-11-30',
          successRate: 83,
          description: 'Design, develop, and manage robust, secure, scalable, and dynamic solutions.',
          topics: ['Solution Design', 'Implementation', 'Security & Compliance', 'Optimization'],
          prerequisites: ['3+ years industry experience', '1+ year GCP experience']
        },
        {
          id: 'gcp-pde',
          title: 'Google Cloud Professional Data Engineer',
          code: 'PDE',
          provider: 'gcp',
          difficulty: 'expert',
          questions: 180,
          duration: 120,
          passingScore: 80,
          price: 399,
          popularity: 69,
          lastUpdated: '2024-12-03',
          successRate: 81,
          description: 'Design, build, operationalize, secure, and monitor data processing systems.',
          topics: ['Data Systems', 'Machine Learning', 'Case Studies', 'Security', 'Monitoring'],
          prerequisites: ['3+ years industry experience', 'Data engineering experience']
        },

        // Kubernetes Exams
        {
          id: 'cka',
          title: 'Certified Kubernetes Administrator',
          code: 'CKA',
          provider: 'kubernetes',
          difficulty: 'expert',
          questions: 17,
          duration: 120,
          passingScore: 66,
          price: 395,
          popularity: 86,
          lastUpdated: '2024-12-01',
          successRate: 78,
          description: 'Hands-on skills for Kubernetes administration.',
          topics: ['Cluster Architecture', 'Workloads & Scheduling', 'Services & Networking', 'Storage'],
          prerequisites: ['Kubernetes experience', 'Linux knowledge'],
          badge: 'Hands-on'
        },
        {
          id: 'ckad',
          title: 'Certified Kubernetes Application Developer',
          code: 'CKAD',
          provider: 'kubernetes',
          difficulty: 'intermediate',
          questions: 15,
          duration: 120,
          passingScore: 66,
          price: 395,
          popularity: 82,
          lastUpdated: '2024-11-28',
          successRate: 75,
          description: 'Skills for designing and building applications in Kubernetes.',
          topics: ['Application Design', 'Application Deployment', 'Application Observability', 'Environment'],
          prerequisites: ['Container experience', 'Application development']
        }
      ]
    }
  },
  computed: {
    filteredExams() {
      let filtered = [...this.exams]

      // Category filter
      if (this.selectedCategory !== 'all') {
        filtered = filtered.filter(exam => exam.provider === this.selectedCategory)
      }

      // Search filter
      if (this.searchQuery) {
        const query = this.searchQuery.toLowerCase()
        filtered = filtered.filter(exam =>
          exam.title.toLowerCase().includes(query) ||
          exam.code.toLowerCase().includes(query) ||
          exam.description.toLowerCase().includes(query) ||
          exam.topics.some(topic => topic.toLowerCase().includes(query))
        )
      }

      // Difficulty filter
      if (this.difficultyFilter !== 'all') {
        filtered = filtered.filter(exam => exam.difficulty === this.difficultyFilter)
      }

      // Sort
      switch (this.sortOption) {
        case 'popularity':
          filtered.sort((a, b) => b.popularity - a.popularity)
          break
        case 'newest':
          filtered.sort((a, b) => new Date(b.lastUpdated) - new Date(a.lastUpdated))
          break
        case 'price-low':
          filtered.sort((a, b) => a.price - b.price)
          break
        case 'price-high':
          filtered.sort((a, b) => b.price - a.price)
          break
        case 'success-rate':
          filtered.sort((a, b) => b.successRate - a.successRate)
          break
      }

      return filtered.slice(0, this.displayLimit)
    },
    canLoadMore() {
      return this.displayLimit < this.exams.length
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
    handleDifficultyChange(difficulty) {
      this.difficultyFilter = difficulty
      this.displayLimit = 12
    },
    handleSortChange(sort) {
      this.sortOption = sort
    },
    clearFilters() {
      this.selectedCategory = 'all'
      this.searchQuery = ''
      this.difficultyFilter = 'all'
      this.sortOption = 'popularity'
      this.displayLimit = 12
    },
    toggleViewMode() {
      this.viewMode = this.viewMode === 'grid' ? 'list' : 'grid'
    },
    loadMore() {
      this.displayLimit += 12
    },
    getCategoryName(categoryId) {
      const category = this.categories.find(cat => cat.id === categoryId)
      return category ? category.name : categoryId.toUpperCase()
    },
    handleDownload(exam) {
      console.log('Download exam:', exam)
      // Implement download logic
    },
    handlePreview(exam) {
      // Navigate to the individual exam detail page
      this.$inertia.visit(`/dumps/${exam.id}`)
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
  0%, 100% { transform: translateY(0px); }
  50% { transform: translateY(-10px); }
}

.animate-float {
  animation: float 3s ease-in-out infinite;
}
</style>