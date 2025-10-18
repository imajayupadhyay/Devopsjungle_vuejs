<template>
  <div class="bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 transition-colors duration-200">
    <!-- Include AOS -->
    <Head>
      <title>DevOps Courses - DevOps Jungle</title>
      <meta name="description" content="Master DevOps with comprehensive courses on AWS, Azure, Terraform, Linux, Jenkins, and more. Expert-led training for DevOps professionals.">
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
              <!-- Animated Course Icon -->
              <div class="relative">
                <div class="w-24 h-24 gradient-btn rounded-2xl flex items-center justify-center animate-float">
                  <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 14l9-5-9-5-9 5 9 5z"/>
                    <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                  </svg>
                </div>
                <div class="absolute -top-2 -right-2 w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center animate-bounce">
                  <i class="fas fa-graduation-cap text-yellow-800 text-sm"></i>
                </div>
              </div>
            </div>
            <h1 class="text-4xl lg:text-6xl font-bold text-gray-800 dark:text-white mb-6 leading-tight">
              Master <span class="gradient-text">DevOps</span> Skills
            </h1>
            <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-3xl mx-auto leading-relaxed">
              Learn from industry experts with hands-on courses covering AWS, Azure, Terraform, Jenkins, Docker, Kubernetes, and more. Build your DevOps career today.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
              <div class="flex items-center text-gray-600 dark:text-gray-300">
                <i class="fas fa-users text-blue-500 mr-2"></i>
                <span>150,000+ Students</span>
              </div>
              <div class="flex items-center text-gray-600 dark:text-gray-300">
                <i class="fas fa-star text-yellow-500 mr-2"></i>
                <span>4.8 Average Rating</span>
              </div>
              <div class="flex items-center text-gray-600 dark:text-gray-300">
                <i class="fas fa-certificate text-purple-500 mr-2"></i>
                <span>Industry Certificates</span>
              </div>
            </div>
          </div>

          <!-- Stats -->
          <div class="grid grid-cols-2 lg:grid-cols-4 gap-6" data-aos="fade-up" data-aos-delay="200">
            <div class="text-center">
              <div class="text-3xl font-bold gradient-text">{{ stats.totalCourses }}</div>
              <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Total Courses</p>
            </div>
            <div class="text-center">
              <div class="text-3xl font-bold gradient-text">{{ stats.totalHours }}</div>
              <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Learning Hours</p>
            </div>
            <div class="text-center">
              <div class="text-3xl font-bold gradient-text">{{ stats.avgRating }}</div>
              <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Avg Rating</p>
            </div>
            <div class="text-center">
              <div class="text-3xl font-bold gradient-text">{{ stats.instructors }}</div>
              <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Expert Instructors</p>
            </div>
          </div>
        </div>
      </section>

      <!-- Filters Section -->
      <section class="py-8 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 sticky top-16 z-40">
        <div class="max-w-7xl mx-auto px-4">
          <CourseFilters
            :categories="categories"
            :selected-category="selectedCategory"
            :search-query="searchQuery"
            :level-filter="levelFilter"
            :duration-filter="durationFilter"
            :sort-option="sortOption"
            @category-change="handleCategoryChange"
            @search-change="handleSearchChange"
            @level-change="handleLevelChange"
            @duration-change="handleDurationChange"
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
                {{ filteredCourses.length }} {{ selectedCategory === 'all' ? 'DevOps Courses' : `${getCategoryName(selectedCategory)} Courses` }}
              </h2>
              <p class="text-gray-600 dark:text-gray-300 mt-1">
                {{ searchQuery ? `Results for "${searchQuery}"` : 'Build your DevOps expertise with hands-on training' }}
              </p>
            </div>
            <div class="flex items-center space-x-4">
              <button @click="toggleViewMode" class="p-2 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                <i :class="viewMode === 'grid' ? 'fas fa-list' : 'fas fa-th-large'" class="text-gray-600 dark:text-gray-300"></i>
              </button>
            </div>
          </div>

          <!-- No Results -->
          <div v-if="filteredCourses.length === 0" class="text-center py-16" data-aos="fade-up">
            <div class="w-24 h-24 mx-auto mb-6 text-gray-400 dark:text-gray-500">
              <i class="fas fa-search text-6xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">No courses found</h3>
            <p class="text-gray-600 dark:text-gray-300 mb-6">Try adjusting your filters or search terms</p>
            <button @click="clearFilters" class="gradient-btn text-white px-6 py-2 rounded-lg font-medium hover:opacity-90 transition-opacity">
              Clear All Filters
            </button>
          </div>

          <!-- Course Cards Grid -->
          <div v-else :class="viewMode === 'grid' ? 'grid md:grid-cols-2 lg:grid-cols-3 gap-6' : 'space-y-4'">
            <CourseCard
              v-for="(course, index) in filteredCourses"
              :key="course.id"
              :course="course"
              :view-mode="viewMode"
              :data-aos="'fade-up'"
              :data-aos-delay="index * 100"
              @enroll="handleEnroll"
              @preview="handlePreview"
            />
          </div>

          <!-- Load More Button -->
          <div v-if="canLoadMore" class="text-center mt-12" data-aos="fade-up">
            <button @click="loadMore" class="gradient-btn text-white px-8 py-3 rounded-lg font-semibold hover:opacity-90 transform hover:scale-105 transition-all duration-200">
              <i class="fas fa-plus mr-2"></i>
              Load More Courses
            </button>
          </div>
        </div>
      </section>

      <!-- CTA Section -->
      <section class="py-16 gradient-bg">
        <div class="max-w-4xl mx-auto px-4 text-center" data-aos="fade-up">
          <h2 class="text-3xl lg:text-4xl font-bold text-gray-800 dark:text-white mb-6">
            Ready to Accelerate Your DevOps Career?
          </h2>
          <p class="text-lg text-gray-600 dark:text-gray-300 mb-8">
            Join thousands of professionals who have transformed their careers with our comprehensive DevOps training programs
          </p>
          <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <button class="gradient-btn text-white px-8 py-4 rounded-lg text-lg font-semibold hover:opacity-90 transform hover:scale-105 transition-all duration-200">
              <i class="fas fa-rocket mr-2"></i>
              Start Learning Today
            </button>
            <button class="border-2 border-primary-600 dark:border-primary-400 text-primary-600 dark:text-primary-400 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-primary-50 dark:hover:bg-primary-900 transform hover:scale-105 transition-all duration-200">
              <i class="fas fa-calendar mr-2"></i>
              Book Free Consultation
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
import CourseFilters from './Components/CourseFilters.vue'
import CourseCard from './Components/CourseCard.vue'

export default {
  name: 'CoursesPage',
  components: {
    Head,
    DevOpsHeader,
    DevOpsFooter,
    CourseFilters,
    CourseCard
  },
  data() {
    return {
      selectedCategory: 'all',
      searchQuery: '',
      levelFilter: 'all',
      durationFilter: 'all',
      sortOption: 'popularity',
      viewMode: 'grid',
      displayLimit: 12,

      stats: {
        totalCourses: 45,
        totalHours: 850,
        avgRating: 4.8,
        instructors: 15
      },

      categories: [
        { id: 'all', name: 'All Courses', icon: 'fas fa-graduation-cap', count: 45 },
        { id: 'aws', name: 'Amazon AWS', icon: 'fab fa-aws', count: 12 },
        { id: 'azure', name: 'Microsoft Azure', icon: 'fab fa-microsoft', count: 8 },
        { id: 'terraform', name: 'Terraform', icon: 'fas fa-code-branch', count: 5 },
        { id: 'linux', name: 'Linux', icon: 'fab fa-linux', count: 6 },
        { id: 'jenkins', name: 'Jenkins', icon: 'fas fa-cog', count: 4 },
        { id: 'docker', name: 'Docker', icon: 'fab fa-docker', count: 5 },
        { id: 'kubernetes', name: 'Kubernetes', icon: 'fas fa-dharmachakra', count: 5 }
      ],

      courses: [
        // AWS Courses
        {
          id: 'aws-complete-guide',
          title: 'Complete AWS Cloud Practitioner & Solutions Architect',
          category: 'aws',
          level: 'intermediate',
          instructor: 'John Mitchell, AWS Solutions Architect',
          description: 'Master AWS from basics to advanced with hands-on labs, real-world projects, and certification preparation.',
          duration: 45,
          lessons: 120,
          students: 85000,
          rating: 4.9,
          reviews: 12500,
          price: 129,
          originalPrice: 199,
          language: 'English',
          certificate: true,
          bestseller: true,
          featured: true,
          lastUpdated: '2024-12-01',
          skills: ['EC2', 'S3', 'RDS', 'Lambda', 'CloudFormation', 'VPC', 'IAM', 'Route53']
        },
        {
          id: 'aws-devops-engineer',
          title: 'AWS DevOps Engineer Professional Certification',
          category: 'aws',
          level: 'advanced',
          instructor: 'Sarah Johnson, DevOps Expert',
          description: 'Advanced AWS DevOps practices including CI/CD, infrastructure as code, monitoring, and automation.',
          duration: 38,
          lessons: 95,
          students: 42000,
          rating: 4.8,
          reviews: 6800,
          price: 149,
          originalPrice: 229,
          language: 'English',
          certificate: true,
          bestseller: false,
          featured: true,
          lastUpdated: '2024-11-28',
          skills: ['CodePipeline', 'CodeBuild', 'CodeDeploy', 'CloudWatch', 'ECS', 'EKS', 'Terraform']
        },
        {
          id: 'aws-serverless',
          title: 'AWS Serverless Development with Lambda & API Gateway',
          category: 'aws',
          level: 'intermediate',
          instructor: 'Michael Chen, Serverless Architect',
          description: 'Build scalable serverless applications using AWS Lambda, API Gateway, DynamoDB, and more.',
          duration: 28,
          lessons: 75,
          students: 28000,
          rating: 4.7,
          reviews: 4200,
          price: 99,
          originalPrice: 149,
          language: 'English',
          certificate: true,
          bestseller: false,
          featured: false,
          lastUpdated: '2024-12-05',
          skills: ['Lambda', 'API Gateway', 'DynamoDB', 'S3', 'CloudWatch', 'SAM', 'Serverless Framework']
        },

        // Azure Courses
        {
          id: 'azure-fundamentals-expert',
          title: 'Microsoft Azure Fundamentals to Expert Path',
          category: 'azure',
          level: 'beginner',
          instructor: 'David Williams, Azure MVP',
          description: 'Complete Azure journey from basics to advanced concepts with hands-on labs and real projects.',
          duration: 42,
          lessons: 110,
          students: 65000,
          rating: 4.8,
          reviews: 9800,
          price: 119,
          originalPrice: 179,
          language: 'English',
          certificate: true,
          bestseller: true,
          featured: true,
          lastUpdated: '2024-11-30',
          skills: ['Azure VMs', 'App Service', 'Storage', 'SQL Database', 'Active Directory', 'DevOps', 'ARM Templates']
        },
        {
          id: 'azure-devops-complete',
          title: 'Azure DevOps & CI/CD Pipeline Mastery',
          category: 'azure',
          level: 'intermediate',
          instructor: 'Lisa Rodriguez, DevOps Consultant',
          description: 'Master Azure DevOps services including Repos, Pipelines, Boards, and Artifacts for enterprise development.',
          duration: 32,
          lessons: 85,
          students: 38000,
          rating: 4.7,
          reviews: 5600,
          price: 109,
          originalPrice: 159,
          language: 'English',
          certificate: true,
          bestseller: false,
          featured: false,
          lastUpdated: '2024-12-03',
          skills: ['Azure Repos', 'Azure Pipelines', 'Azure Boards', 'YAML', 'ARM Templates', 'Kubernetes']
        },

        // Terraform Courses
        {
          id: 'terraform-complete-guide',
          title: 'Terraform: Infrastructure as Code Complete Guide',
          category: 'terraform',
          level: 'intermediate',
          instructor: 'Alex Thompson, Infrastructure Expert',
          description: 'Master Terraform for AWS, Azure, and GCP. Learn best practices, modules, and enterprise patterns.',
          duration: 35,
          lessons: 90,
          students: 45000,
          rating: 4.9,
          reviews: 7200,
          price: 119,
          originalPrice: 169,
          language: 'English',
          certificate: true,
          bestseller: true,
          featured: true,
          lastUpdated: '2024-12-08',
          skills: ['HCL', 'Providers', 'Modules', 'State Management', 'Terraform Cloud', 'Multi-cloud', 'Best Practices']
        },
        {
          id: 'terraform-aws-advanced',
          title: 'Advanced Terraform for AWS Infrastructure',
          category: 'terraform',
          level: 'advanced',
          instructor: 'Rachel Green, Cloud Architect',
          description: 'Advanced Terraform patterns for complex AWS infrastructures including modules, workspaces, and automation.',
          duration: 25,
          lessons: 65,
          students: 22000,
          rating: 4.8,
          reviews: 3400,
          price: 99,
          originalPrice: 139,
          language: 'English',
          certificate: true,
          bestseller: false,
          featured: false,
          lastUpdated: '2024-11-25',
          skills: ['Advanced Modules', 'Workspaces', 'Remote State', 'Policy as Code', 'Atlantis', 'GitOps']
        },

        // Linux Courses
        {
          id: 'linux-system-admin',
          title: 'Linux System Administration: Beginner to Advanced',
          category: 'linux',
          level: 'beginner',
          instructor: 'Robert Martinez, Linux Expert',
          description: 'Comprehensive Linux training covering system administration, security, networking, and automation.',
          duration: 40,
          lessons: 105,
          students: 78000,
          rating: 4.8,
          reviews: 11200,
          price: 89,
          originalPrice: 129,
          language: 'English',
          certificate: true,
          bestseller: true,
          featured: true,
          lastUpdated: '2024-12-10',
          skills: ['Command Line', 'System Administration', 'Networking', 'Security', 'Shell Scripting', 'Package Management']
        },
        {
          id: 'linux-docker-kubernetes',
          title: 'Linux for Docker & Kubernetes Administrators',
          category: 'linux',
          level: 'intermediate',
          instructor: 'Jennifer Lee, Container Expert',
          description: 'Specialized Linux skills for container and Kubernetes environments with hands-on practice.',
          duration: 30,
          lessons: 80,
          students: 35000,
          rating: 4.7,
          reviews: 5100,
          price: 99,
          originalPrice: 149,
          language: 'English',
          certificate: true,
          bestseller: false,
          featured: false,
          lastUpdated: '2024-11-20',
          skills: ['Container Runtime', 'Namespaces', 'Cgroups', 'Networking', 'Storage', 'Security']
        },

        // Jenkins Courses
        {
          id: 'jenkins-cicd-complete',
          title: 'Jenkins CI/CD Pipeline: Complete DevOps Guide',
          category: 'jenkins',
          level: 'intermediate',
          instructor: 'Mark Wilson, DevOps Engineer',
          description: 'Master Jenkins for building robust CI/CD pipelines with Docker, Kubernetes, and cloud integration.',
          duration: 28,
          lessons: 75,
          students: 52000,
          rating: 4.7,
          reviews: 7800,
          price: 99,
          originalPrice: 139,
          language: 'English',
          certificate: true,
          bestseller: true,
          featured: true,
          lastUpdated: '2024-12-02',
          skills: ['Pipeline as Code', 'Groovy', 'Docker Integration', 'Kubernetes', 'Git Hooks', 'Blue Ocean']
        },
        {
          id: 'jenkins-advanced-automation',
          title: 'Advanced Jenkins Automation & Scaling',
          category: 'jenkins',
          level: 'advanced',
          instructor: 'Emily Davis, Automation Specialist',
          description: 'Advanced Jenkins configurations, distributed builds, security, and enterprise-scale automation.',
          duration: 22,
          lessons: 60,
          students: 18000,
          rating: 4.8,
          reviews: 2700,
          price: 109,
          originalPrice: 159,
          language: 'English',
          certificate: true,
          bestseller: false,
          featured: false,
          lastUpdated: '2024-11-18',
          skills: ['Distributed Builds', 'Security', 'Plugin Development', 'Performance Tuning', 'Monitoring']
        },

        // Docker Courses
        {
          id: 'docker-complete-guide',
          title: 'Docker & Container Technology Complete Guide',
          category: 'docker',
          level: 'beginner',
          instructor: 'Tom Anderson, Container Architect',
          description: 'Master Docker from basics to production deployment with best practices and real-world projects.',
          duration: 32,
          lessons: 85,
          students: 92000,
          rating: 4.9,
          reviews: 14500,
          price: 89,
          originalPrice: 129,
          language: 'English',
          certificate: true,
          bestseller: true,
          featured: true,
          lastUpdated: '2024-12-12',
          skills: ['Docker Engine', 'Dockerfile', 'Docker Compose', 'Networking', 'Volumes', 'Registry', 'Security']
        },
        {
          id: 'docker-swarm-production',
          title: 'Docker Swarm & Production Container Orchestration',
          category: 'docker',
          level: 'advanced',
          instructor: 'Sophie Turner, Container Expert',
          description: 'Production-ready container orchestration with Docker Swarm, monitoring, and high availability.',
          duration: 24,
          lessons: 65,
          students: 25000,
          rating: 4.6,
          reviews: 3800,
          price: 99,
          originalPrice: 149,
          language: 'English',
          certificate: true,
          bestseller: false,
          featured: false,
          lastUpdated: '2024-11-15',
          skills: ['Docker Swarm', 'Service Discovery', 'Load Balancing', 'Secrets Management', 'Monitoring']
        },

        // Kubernetes Courses
        {
          id: 'kubernetes-complete-guide',
          title: 'Kubernetes Complete Guide: Beginner to Expert',
          category: 'kubernetes',
          level: 'intermediate',
          instructor: 'Kevin Brown, Kubernetes Specialist',
          description: 'Comprehensive Kubernetes training covering all concepts from pods to production cluster management.',
          duration: 48,
          lessons: 125,
          students: 68000,
          rating: 4.8,
          reviews: 10200,
          price: 139,
          originalPrice: 199,
          language: 'English',
          certificate: true,
          bestseller: true,
          featured: true,
          lastUpdated: '2024-12-06',
          skills: ['Pods', 'Services', 'Deployments', 'ConfigMaps', 'Secrets', 'Ingress', 'Helm', 'Monitoring']
        },
        {
          id: 'kubernetes-security',
          title: 'Kubernetes Security & Best Practices',
          category: 'kubernetes',
          level: 'advanced',
          instructor: 'Anna Clark, Security Expert',
          description: 'Advanced Kubernetes security concepts including RBAC, network policies, and compliance.',
          duration: 26,
          lessons: 70,
          students: 28000,
          rating: 4.7,
          reviews: 4100,
          price: 119,
          originalPrice: 169,
          language: 'English',
          certificate: true,
          bestseller: false,
          featured: false,
          lastUpdated: '2024-11-22',
          skills: ['RBAC', 'Network Policies', 'Pod Security', 'Admission Controllers', 'Falco', 'OPA Gatekeeper']
        }
      ]
    }
  },
  computed: {
    filteredCourses() {
      let filtered = [...this.courses]

      // Category filter
      if (this.selectedCategory !== 'all') {
        filtered = filtered.filter(course => course.category === this.selectedCategory)
      }

      // Search filter
      if (this.searchQuery) {
        const query = this.searchQuery.toLowerCase()
        filtered = filtered.filter(course =>
          course.title.toLowerCase().includes(query) ||
          course.description.toLowerCase().includes(query) ||
          course.instructor.toLowerCase().includes(query) ||
          course.skills.some(skill => skill.toLowerCase().includes(query))
        )
      }

      // Level filter
      if (this.levelFilter !== 'all') {
        filtered = filtered.filter(course => course.level === this.levelFilter)
      }

      // Duration filter
      if (this.durationFilter !== 'all') {
        filtered = filtered.filter(course => {
          if (this.durationFilter === 'short') return course.duration <= 5
          if (this.durationFilter === 'medium') return course.duration > 5 && course.duration <= 20
          if (this.durationFilter === 'long') return course.duration > 20
          return true
        })
      }

      // Sort
      switch (this.sortOption) {
        case 'popularity':
          filtered.sort((a, b) => b.students - a.students)
          break
        case 'newest':
          filtered.sort((a, b) => new Date(b.lastUpdated) - new Date(a.lastUpdated))
          break
        case 'rating':
          filtered.sort((a, b) => b.rating - a.rating)
          break
        case 'price-low':
          filtered.sort((a, b) => a.price - b.price)
          break
        case 'price-high':
          filtered.sort((a, b) => b.price - a.price)
          break
        case 'duration':
          filtered.sort((a, b) => a.duration - b.duration)
          break
      }

      return filtered.slice(0, this.displayLimit)
    },
    canLoadMore() {
      return this.displayLimit < this.courses.length
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
    handleLevelChange(level) {
      this.levelFilter = level
      this.displayLimit = 12
    },
    handleDurationChange(duration) {
      this.durationFilter = duration
      this.displayLimit = 12
    },
    handleSortChange(sort) {
      this.sortOption = sort
    },
    clearFilters() {
      this.selectedCategory = 'all'
      this.searchQuery = ''
      this.levelFilter = 'all'
      this.durationFilter = 'all'
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
    handleEnroll(course) {
      console.log('Enroll in course:', course)
      // Implement enrollment logic
    },
    handlePreview(course) {
      // Navigate to the individual course detail page
      this.$inertia.visit(`/courses/${course.id}`)
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