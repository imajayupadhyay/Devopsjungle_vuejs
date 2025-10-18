<template>
  <div class="bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 transition-colors duration-200" data-theme="light">
    <!-- Include Font Awesome and AOS -->
    <Head>
      <title>{{ exam.title }} - Practice Labs - DevOpsJungle</title>
      <meta name="description" :content="`Practice labs for ${exam.title} certification. Hands-on exercises to master ${exam.code} exam objectives.`">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    </Head>

    <!-- Header -->
    <DevOpsHeader />

    <!-- Main Content -->
    <main class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800">
      <!-- Breadcrumb -->
      <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-4">
          <nav class="flex items-center space-x-2 text-sm">
            <a href="/practice-labs" class="text-gray-500 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400">
              Practice Labs
            </a>
            <i class="fas fa-chevron-right text-gray-400 dark:text-gray-500 text-xs"></i>
            <span class="text-gray-900 dark:text-white font-medium">{{ exam.code }}</span>
          </nav>
        </div>
      </div>

      <!-- Exam Header -->
      <section class="py-12 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4">
          <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">
            <!-- Exam Info -->
            <div class="flex-1" data-aos="fade-right">
              <div class="flex items-center mb-4">
                <div :class="[
                  'w-16 h-16 rounded-xl flex items-center justify-center text-white text-2xl mr-6',
                  exam.provider === 'aws' ? 'bg-orange-500' :
                  exam.provider === 'azure' ? 'bg-blue-500' :
                  exam.provider === 'gcp' ? 'bg-green-500' :
                  exam.provider === 'kubernetes' ? 'bg-blue-600' :
                  'bg-gray-500'
                ]">
                  <i :class="exam.icon"></i>
                </div>
                <div>
                  <div class="flex items-center gap-3 mb-2">
                    <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white">{{ exam.code }}</h1>
                    <span v-if="exam.badge" :class="[
                      'px-3 py-1 rounded-full text-sm font-medium',
                      exam.badge === 'Popular' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' :
                      exam.badge === 'New' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' :
                      'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200'
                    ]">
                      {{ exam.badge }}
                    </span>
                  </div>
                  <h2 class="text-lg text-gray-600 dark:text-gray-300">{{ exam.title }}</h2>
                </div>
              </div>
              <p class="text-gray-600 dark:text-gray-300 mb-6 max-w-2xl">{{ exam.description }}</p>

              <!-- Quick Stats -->
              <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="text-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                  <div class="text-2xl font-bold text-primary-600 dark:text-primary-400">{{ labs.length }}</div>
                  <div class="text-sm text-gray-500 dark:text-gray-400">Practice Labs</div>
                </div>
                <div class="text-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                  <div class="text-2xl font-bold text-green-600 dark:text-green-400">{{ exam.difficulty }}</div>
                  <div class="text-sm text-gray-500 dark:text-gray-400">Difficulty</div>
                </div>
                <div class="text-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                  <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ totalDuration }}</div>
                  <div class="text-sm text-gray-500 dark:text-gray-400">Total Hours</div>
                </div>
                <div class="text-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                  <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ completedLabs }}</div>
                  <div class="text-sm text-gray-500 dark:text-gray-400">Completed</div>
                </div>
              </div>
            </div>

            <!-- Progress Card -->
            <div class="lg:w-80" data-aos="fade-left">
              <div class="bg-gradient-to-br from-primary-500 to-blue-600 text-white p-6 rounded-xl shadow-lg">
                <h3 class="text-lg font-semibold mb-4">Your Progress</h3>
                <div class="mb-4">
                  <div class="flex justify-between text-sm mb-2">
                    <span>Overall Progress</span>
                    <span>{{ Math.round((completedLabs / labs.length) * 100) }}%</span>
                  </div>
                  <div class="w-full bg-white/20 rounded-full h-2">
                    <div
                      class="bg-white h-2 rounded-full transition-all duration-300"
                      :style="{ width: `${(completedLabs / labs.length) * 100}%` }"
                    ></div>
                  </div>
                </div>
                <div class="grid grid-cols-2 gap-4 text-center">
                  <div>
                    <div class="text-2xl font-bold">{{ completedLabs }}</div>
                    <div class="text-sm opacity-90">Completed</div>
                  </div>
                  <div>
                    <div class="text-2xl font-bold">{{ labs.length - completedLabs }}</div>
                    <div class="text-sm opacity-90">Remaining</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Filter and Search -->
      <section class="py-8 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4">
          <FilterBar
            :search-query="searchQuery"
            @update:search-query="searchQuery = $event"
            :filters="filterOptions"
            @filter-change="handleFilterChange"
            search-placeholder="Search labs..."
          />
        </div>
      </section>

      <!-- Labs Grid -->
      <section class="py-12">
        <div class="max-w-7xl mx-auto px-4">
          <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-8">
            <LabCard
              v-for="(lab, index) in filteredLabs"
              :key="lab.id"
              :lab="lab"
              :exam-id="exam.id"
              :aos-delay="index * 50"
            />
          </div>

          <!-- No Labs Found -->
          <div v-if="filteredLabs.length === 0" class="text-center py-12" data-aos="fade-up">
            <div class="text-gray-400 dark:text-gray-500 mb-4">
              <i class="fas fa-search text-4xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">No labs found</h3>
            <p class="text-gray-600 dark:text-gray-300">Try adjusting your search or filter criteria.</p>
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
import LabCard from './Components/LabCard.vue';
import FilterBar from './Components/FilterBar.vue';

export default {
  name: 'ExamLabs',
  components: {
    Head,
    DevOpsHeader,
    DevOpsFooter,
    LabCard,
    FilterBar
  },
  props: {
    exam: {
      type: Object,
      required: true
    },
    labs: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      searchQuery: '',
      selectedDifficulty: '',
      selectedStatus: '',
      filterOptions: [
        {
          key: 'difficulty',
          placeholder: 'All Difficulties',
          value: '',
          options: [
            { value: 'Beginner', label: 'Beginner' },
            { value: 'Intermediate', label: 'Intermediate' },
            { value: 'Advanced', label: 'Advanced' }
          ]
        },
        {
          key: 'status',
          placeholder: 'All Status',
          value: '',
          options: [
            { value: 'completed', label: 'Completed' },
            { value: 'in-progress', label: 'In Progress' },
            { value: 'not-started', label: 'Not Started' }
          ]
        }
      ]
    }
  },
  computed: {
    filteredLabs() {
      let filtered = this.labs;

      // Search filter
      if (this.searchQuery) {
        filtered = filtered.filter(lab =>
          lab.title.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
          lab.description.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
          lab.skills.some(skill => skill.toLowerCase().includes(this.searchQuery.toLowerCase()))
        );
      }

      // Difficulty filter
      if (this.selectedDifficulty) {
        filtered = filtered.filter(lab => lab.difficulty === this.selectedDifficulty);
      }

      // Status filter
      if (this.selectedStatus) {
        filtered = filtered.filter(lab => lab.status === this.selectedStatus);
      }

      return filtered;
    },
    completedLabs() {
      return this.labs.filter(lab => lab.status === 'completed').length;
    },
    totalDuration() {
      return this.labs.reduce((total, lab) => {
        const duration = parseInt(lab.duration.split(' ')[0]);
        return total + duration;
      }, 0);
    }
  },
  mounted() {
    this.loadAOS();
  },
  methods: {
    handleFilterChange(filterData) {
      const filterOption = this.filterOptions.find(f => f.key === filterData.key);
      if (filterOption) {
        filterOption.value = filterData.value;
        if (filterData.key === 'difficulty') {
          this.selectedDifficulty = filterData.value;
        } else if (filterData.key === 'status') {
          this.selectedStatus = filterData.value;
        }
      }
    },
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
.gradient-btn {
  background: linear-gradient(135deg, #059669 0%, #0891b2 100%);
}

.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>