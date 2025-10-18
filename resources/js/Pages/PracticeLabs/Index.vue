<template>
  <div class="bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 transition-colors duration-200" data-theme="light">
    <!-- Include Font Awesome and AOS -->
    <Head>
      <title>Practice Labs - DevOpsJungle</title>
      <meta name="description" content="Choose your exam and access hands-on practice labs to master DevOps skills">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    </Head>

    <!-- Header -->
    <DevOpsHeader />

    <!-- Main Content -->
    <main class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800">
      <!-- Hero Section -->
      <section class="relative py-16 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-primary-600/10 to-blue-600/10"></div>
        <div class="relative max-w-7xl mx-auto px-4">
          <div class="text-center" data-aos="fade-up">
            <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-6">
              Practice <span class="gradient-text">Labs</span>
            </h1>
            <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-3xl mx-auto">
              Choose your certification exam and dive into hands-on practice labs. Master real-world DevOps scenarios with step-by-step guided exercises.
            </p>
            <div class="flex items-center justify-center space-x-8 text-sm text-gray-500 dark:text-gray-400">
              <div class="flex items-center">
                <i class="fas fa-clock mr-2 text-primary-600"></i>
                <span>Real-time Practice</span>
              </div>
              <div class="flex items-center">
                <i class="fas fa-laptop-code mr-2 text-primary-600"></i>
                <span>Hands-on Labs</span>
              </div>
              <div class="flex items-center">
                <i class="fas fa-certificate mr-2 text-primary-600"></i>
                <span>Exam Focused</span>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Exam Selection Section -->
      <section class="py-16">
        <div class="max-w-7xl mx-auto px-4">
          <!-- Section Header -->
          <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
              Select Your Exam
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
              Choose from our comprehensive collection of certification exams and access targeted practice labs.
            </p>
          </div>

          <!-- Exam Categories -->
          <div class="flex flex-wrap justify-center gap-4 mb-8" data-aos="fade-up" data-aos-delay="100">
            <button
              v-for="category in effectiveCategories"
              :key="category.id"
              @click="selectedCategory = category.id"
              :class="[
                'px-6 py-3 rounded-full font-medium transition-all duration-200',
                selectedCategory === category.id
                  ? 'gradient-btn text-white shadow-lg'
                  : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-600 hover:border-primary-300 hover:bg-primary-50 dark:hover:bg-gray-700'
              ]"
            >
              <i :class="category.icon" class="mr-2"></i>
              {{ category.name }}
            </button>
          </div>

          <!-- Exam Cards Grid -->
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <ExamCard
              v-for="(exam, index) in filteredExams"
              :key="exam.id"
              :exam="exam"
              :aos-delay="index * 100"
            />
          </div>
        </div>
      </section>

      <!-- Features Section -->
      <section class="py-16 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4">
          <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
              Why Practice with Our Labs?
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
              Get hands-on experience with real DevOps scenarios and tools used in production environments.
            </p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div
              v-for="feature in effectiveFeatures"
              :key="feature.id"
              class="text-center"
              data-aos="fade-up"
              :data-aos-delay="feature.id * 100"
            >
              <div :class="[
                'w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center text-white text-2xl',
                feature.color
              ]">
                <i :class="feature.icon"></i>
              </div>
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ feature.title }}</h3>
              <p class="text-gray-600 dark:text-gray-300 text-sm">{{ feature.description }}</p>
            </div>
          </div>
        </div>
      </section>
    </main>

    <!-- Footer -->
    <DevOpsFooter />
  </div>
</template>

<script>
import { Head } from '@inertiajs/vue3';
import DevOpsHeader from '../Common/Header.vue';
import DevOpsFooter from '../Common/Footer.vue';
import ExamCard from './Components/ExamCard.vue';

export default {
  name: 'PracticeLabsIndex',
  components: {
    Head,
    DevOpsHeader,
    DevOpsFooter,
    ExamCard
  },
  props: {
    exams: {
      type: Array,
      default: () => []
    },
    categories: {
      type: Array,
      default: () => []
    },
    features: {
      type: Array,
      default: () => []
    }
  },
  data() {
    return {
      selectedCategory: 'all',
      defaultCategories: [
        { id: 'all', name: 'All Exams', icon: 'fas fa-th-large' },
        { id: 'aws', name: 'AWS', icon: 'fab fa-aws' },
        { id: 'azure', name: 'Azure', icon: 'fab fa-microsoft' },
        { id: 'gcp', name: 'Google Cloud', icon: 'fab fa-google' },
        { id: 'kubernetes', name: 'Kubernetes', icon: 'fas fa-dharmachakra' },
        { id: 'docker', name: 'Docker', icon: 'fab fa-docker' }
      ],
      defaultExams: [
        {
          id: 'aws-saa-c03',
          title: 'AWS Certified Solutions Architect - Associate',
          code: 'SAA-C03',
          provider: 'aws',
          icon: 'fab fa-aws',
          difficulty: 'Intermediate',
          labCount: 45,
          description: 'Master AWS architecture patterns with hands-on labs covering EC2, S3, RDS, and more.',
          topics: ['EC2 & Auto Scaling', 'S3 & Storage', 'RDS & DynamoDB', 'VPC & Networking', 'IAM & Security', 'Lambda & Serverless'],
          badge: 'Popular'
        },
        {
          id: 'aws-soa-c02',
          title: 'AWS Certified SysOps Administrator - Associate',
          code: 'SOA-C02',
          provider: 'aws',
          icon: 'fab fa-aws',
          difficulty: 'Intermediate',
          labCount: 38,
          description: 'Practice AWS operations and system administration with real-world scenarios.',
          topics: ['CloudWatch & Monitoring', 'Systems Manager', 'Cost Optimization', 'Security & Compliance'],
          badge: null
        },
        {
          id: 'az-900',
          title: 'Microsoft Azure Fundamentals',
          code: 'AZ-900',
          provider: 'azure',
          icon: 'fab fa-microsoft',
          difficulty: 'Beginner',
          labCount: 25,
          description: 'Get started with Azure through interactive labs covering core cloud concepts.',
          topics: ['Azure Portal', 'Virtual Machines', 'Storage Accounts', 'Azure AD', 'Cost Management'],
          badge: 'New'
        },
        {
          id: 'az-104',
          title: 'Microsoft Azure Administrator',
          code: 'AZ-104',
          provider: 'azure',
          icon: 'fab fa-microsoft',
          difficulty: 'Intermediate',
          labCount: 42,
          description: 'Advanced Azure administration labs with focus on resource management and security.',
          topics: ['Resource Groups', 'Virtual Networks', 'Azure AD', 'Backup & Recovery', 'Monitoring'],
          badge: 'Popular'
        },
        {
          id: 'gcp-ace',
          title: 'Google Cloud Associate Cloud Engineer',
          code: 'ACE',
          provider: 'gcp',
          icon: 'fab fa-google',
          difficulty: 'Intermediate',
          labCount: 35,
          description: 'Practice GCP fundamentals with hands-on labs in Compute Engine, Cloud Storage, and more.',
          topics: ['Compute Engine', 'Cloud Storage', 'Cloud SQL', 'VPC Networks', 'IAM & Security'],
          badge: null
        },
        {
          id: 'cka',
          title: 'Certified Kubernetes Administrator',
          code: 'CKA',
          provider: 'kubernetes',
          icon: 'fas fa-dharmachakra',
          difficulty: 'Advanced',
          labCount: 50,
          description: 'Master Kubernetes administration with performance-based labs and real scenarios.',
          topics: ['Cluster Architecture', 'Workloads & Scheduling', 'Services & Networking', 'Storage', 'Troubleshooting'],
          badge: 'Expert'
        },
        {
          id: 'ckad',
          title: 'Certified Kubernetes Application Developer',
          code: 'CKAD',
          provider: 'kubernetes',
          icon: 'fas fa-dharmachakra',
          difficulty: 'Intermediate',
          labCount: 40,
          description: 'Develop and deploy applications on Kubernetes with practical lab exercises.',
          topics: ['Core Concepts', 'Multi-Container Pods', 'Pod Design', 'Configuration', 'Observability'],
          badge: null
        },
        {
          id: 'docker-dca',
          title: 'Docker Certified Associate',
          code: 'DCA',
          provider: 'docker',
          icon: 'fab fa-docker',
          difficulty: 'Intermediate',
          labCount: 30,
          description: 'Learn Docker containerization with hands-on labs covering all exam objectives.',
          topics: ['Container Fundamentals', 'Image Management', 'Orchestration', 'Storage & Volumes', 'Networking', 'Security'],
          badge: null
        }
      ],
      defaultFeatures: [
        {
          id: 1,
          title: 'Real Environment',
          description: 'Practice in actual cloud environments, not simulations',
          icon: 'fas fa-cloud',
          color: 'bg-blue-500'
        },
        {
          id: 2,
          title: 'Step-by-Step',
          description: 'Guided instructions with detailed explanations',
          icon: 'fas fa-list-ol',
          color: 'bg-green-500'
        },
        {
          id: 3,
          title: 'Instant Feedback',
          description: 'Get immediate results and progress tracking',
          icon: 'fas fa-check-circle',
          color: 'bg-purple-500'
        },
        {
          id: 4,
          title: 'Exam Focused',
          description: 'Labs designed to match certification requirements',
          icon: 'fas fa-trophy',
          color: 'bg-orange-500'
        }
      ]
    }
  },
  computed: {
    effectiveExams() {
      return this.exams.length > 0 ? this.exams : this.defaultExams;
    },
    effectiveCategories() {
      return this.categories.length > 0 ? this.categories : this.defaultCategories;
    },
    effectiveFeatures() {
      return this.features.length > 0 ? this.features : this.defaultFeatures;
    },
    filteredExams() {
      if (this.selectedCategory === 'all') {
        return this.effectiveExams;
      }
      return this.effectiveExams.filter(exam => exam.provider === this.selectedCategory);
    }
  },
  mounted() {
    this.loadAOS();
  },
  methods: {
    loadAOS() {
      if (typeof window.AOS !== 'undefined') {
        window.AOS.init({
          duration: 800,
          easing: 'ease-out',
          once: true
        });
        return;
      }

      const script = document.createElement('script');
      script.src = 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js';
      script.onload = () => {
        if (typeof window.AOS !== 'undefined') {
          window.AOS.init({
            duration: 800,
            easing: 'ease-out',
            once: true
          });
        }
      };
      document.head.appendChild(script);
    }
  }
}
</script>

<style scoped>
.gradient-text {
  background: linear-gradient(135deg, #059669 0%, #0891b2 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.gradient-btn {
  background: linear-gradient(135deg, #059669 0%, #0891b2 100%);
}

.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>