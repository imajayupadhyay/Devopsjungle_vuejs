<template>
  <div class="space-y-6">
    <!-- Category Pills -->
    <div class="flex flex-wrap gap-3">
      <button
        v-for="category in categories"
        :key="category.id"
        @click="$emit('category-change', category.id)"
        :class="[
          'flex items-center space-x-2 px-4 py-2 rounded-full text-sm font-medium transition-all duration-200',
          selectedCategory === category.id
            ? 'gradient-btn text-white shadow-lg transform scale-105'
            : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-600 hover:border-primary-300 dark:hover:border-primary-500 hover:shadow-md'
        ]"
      >
        <i :class="category.icon" class="text-sm"></i>
        <span>{{ category.name }}</span>
        <span class="bg-white bg-opacity-20 px-2 py-0.5 rounded-full text-xs">{{ category.count }}</span>
      </button>
    </div>

    <!-- Advanced Filters -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
      <!-- Search -->
      <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
          <i class="fas fa-search text-gray-400 text-sm"></i>
        </div>
        <input
          :value="searchQuery"
          @input="$emit('search-change', $event.target.value)"
          type="text"
          placeholder="Search exams, codes, topics..."
          class="w-full pl-10 pr-4 py-2.5 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-lg focus:outline-none focus:border-primary-500 dark:focus:border-primary-400 transition-colors"
        >
        <button
          v-if="searchQuery"
          @click="$emit('search-change', '')"
          class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-200"
        >
          <i class="fas fa-times text-sm"></i>
        </button>
      </div>

      <!-- Difficulty Filter -->
      <div class="relative">
        <select
          :value="difficultyFilter"
          @change="$emit('difficulty-change', $event.target.value)"
          class="w-full px-4 py-2.5 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-lg focus:outline-none focus:border-primary-500 dark:focus:border-primary-400 transition-colors appearance-none"
        >
          <option value="all">All Levels</option>
          <option value="beginner">Beginner</option>
          <option value="intermediate">Intermediate</option>
          <option value="expert">Expert</option>
        </select>
        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
          <i class="fas fa-chevron-down text-gray-400 text-sm"></i>
        </div>
      </div>

      <!-- Sort Options -->
      <div class="relative">
        <select
          :value="sortOption"
          @change="$emit('sort-change', $event.target.value)"
          class="w-full px-4 py-2.5 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-lg focus:outline-none focus:border-primary-500 dark:focus:border-primary-400 transition-colors appearance-none"
        >
          <option value="popularity">Most Popular</option>
          <option value="newest">Recently Updated</option>
          <option value="price-low">Price: Low to High</option>
          <option value="price-high">Price: High to Low</option>
          <option value="success-rate">Highest Success Rate</option>
        </select>
        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
          <i class="fas fa-sort text-gray-400 text-sm"></i>
        </div>
      </div>

      <!-- Clear Filters -->
      <button
        @click="$emit('clear-filters')"
        :class="[
          'flex items-center justify-center space-x-2 px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-200',
          hasActiveFilters
            ? 'bg-red-50 dark:bg-red-900 text-red-600 dark:text-red-400 border border-red-200 dark:border-red-700 hover:bg-red-100 dark:hover:bg-red-800'
            : 'bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400 border border-gray-200 dark:border-gray-600 cursor-not-allowed'
        ]"
        :disabled="!hasActiveFilters"
      >
        <i class="fas fa-filter-circle-xmark text-sm"></i>
        <span>Clear Filters</span>
      </button>
    </div>

    <!-- Active Filters Display -->
    <div v-if="hasActiveFilters" class="flex flex-wrap gap-2">
      <span class="text-sm text-gray-600 dark:text-gray-400 mr-2">Active filters:</span>

      <!-- Category Filter -->
      <div v-if="selectedCategory !== 'all'" class="flex items-center space-x-1 bg-primary-100 dark:bg-primary-900 text-primary-800 dark:text-primary-200 px-3 py-1 rounded-full text-sm">
        <span>{{ getCategoryName(selectedCategory) }}</span>
        <button @click="$emit('category-change', 'all')" class="hover:text-primary-600 dark:hover:text-primary-400">
          <i class="fas fa-times text-xs"></i>
        </button>
      </div>

      <!-- Search Filter -->
      <div v-if="searchQuery" class="flex items-center space-x-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 px-3 py-1 rounded-full text-sm">
        <span>"{{ searchQuery }}"</span>
        <button @click="$emit('search-change', '')" class="hover:text-blue-600 dark:hover:text-blue-400">
          <i class="fas fa-times text-xs"></i>
        </button>
      </div>

      <!-- Difficulty Filter -->
      <div v-if="difficultyFilter !== 'all'" class="flex items-center space-x-1 bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200 px-3 py-1 rounded-full text-sm">
        <span>{{ difficultyFilter.charAt(0).toUpperCase() + difficultyFilter.slice(1) }}</span>
        <button @click="$emit('difficulty-change', 'all')" class="hover:text-purple-600 dark:hover:text-purple-400">
          <i class="fas fa-times text-xs"></i>
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ExamFilters',
  props: {
    categories: {
      type: Array,
      required: true
    },
    selectedCategory: {
      type: String,
      default: 'all'
    },
    searchQuery: {
      type: String,
      default: ''
    },
    difficultyFilter: {
      type: String,
      default: 'all'
    },
    sortOption: {
      type: String,
      default: 'popularity'
    }
  },
  emits: ['category-change', 'search-change', 'difficulty-change', 'sort-change', 'clear-filters'],
  computed: {
    hasActiveFilters() {
      return this.selectedCategory !== 'all' ||
             this.searchQuery !== '' ||
             this.difficultyFilter !== 'all'
    }
  },
  methods: {
    getCategoryName(categoryId) {
      const category = this.categories.find(cat => cat.id === categoryId)
      return category ? category.name : categoryId.toUpperCase()
    }
  }
}
</script>