<template>
  <div class="flex flex-wrap items-center justify-between gap-4">
    <!-- Categories -->
    <div class="flex flex-wrap gap-2">
      <button
        v-for="category in categories"
        :key="category.id"
        @click="$emit('category-change', category.id)"
        :class="[
          'px-4 py-2 rounded-lg font-medium transition-all duration-200 flex items-center space-x-2',
          selectedCategory === category.id
            ? 'gradient-btn text-white shadow-lg'
            : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-700 hover:border-primary-500 dark:hover:border-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900/20'
        ]"
      >
        <i :class="category.icon" class="text-sm"></i>
        <span>{{ category.name }}</span>
        <span v-if="selectedCategory !== category.id" class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 px-2 py-0.5 rounded-full text-xs">
          {{ category.count }}
        </span>
      </button>
    </div>

    <!-- Search and Filters -->
    <div class="flex flex-wrap items-center gap-3">
      <!-- Search -->
      <div class="relative">
        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 dark:text-gray-500"></i>
        <input
          type="text"
          :value="searchQuery"
          @input="$emit('search-change', $event.target.value)"
          placeholder="Search courses..."
          class="pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-primary-500 dark:focus:border-primary-400 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 w-64"
        >
        <button
          v-if="searchQuery"
          @click="$emit('search-change', '')"
          class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300"
        >
          <i class="fas fa-times"></i>
        </button>
      </div>

      <!-- Level Filter -->
      <select
        :value="levelFilter"
        @change="$emit('level-change', $event.target.value)"
        class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-primary-500 dark:focus:border-primary-400 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
      >
        <option value="all">All Levels</option>
        <option value="beginner">Beginner</option>
        <option value="intermediate">Intermediate</option>
        <option value="advanced">Advanced</option>
        <option value="expert">Expert</option>
      </select>

      <!-- Duration Filter -->
      <select
        :value="durationFilter"
        @change="$emit('duration-change', $event.target.value)"
        class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-primary-500 dark:focus:border-primary-400 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
      >
        <option value="all">Any Duration</option>
        <option value="short">0-5 hours</option>
        <option value="medium">5-20 hours</option>
        <option value="long">20+ hours</option>
      </select>

      <!-- Sort -->
      <select
        :value="sortOption"
        @change="$emit('sort-change', $event.target.value)"
        class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-primary-500 dark:focus:border-primary-400 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
      >
        <option value="popularity">Most Popular</option>
        <option value="newest">Newest First</option>
        <option value="rating">Highest Rated</option>
        <option value="price-low">Price: Low to High</option>
        <option value="price-high">Price: High to Low</option>
        <option value="duration">Duration</option>
      </select>

      <!-- Clear Filters -->
      <button
        v-if="hasActiveFilters"
        @click="$emit('clear-filters')"
        class="px-4 py-2 text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
      >
        <i class="fas fa-times mr-2"></i>Clear
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: 'CourseFilters',
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
    levelFilter: {
      type: String,
      default: 'all'
    },
    durationFilter: {
      type: String,
      default: 'all'
    },
    sortOption: {
      type: String,
      default: 'popularity'
    }
  },
  emits: ['category-change', 'search-change', 'level-change', 'duration-change', 'sort-change', 'clear-filters'],
  computed: {
    hasActiveFilters() {
      return this.selectedCategory !== 'all' ||
             this.searchQuery !== '' ||
             this.levelFilter !== 'all' ||
             this.durationFilter !== 'all' ||
             this.sortOption !== 'popularity'
    }
  }
}
</script>

<style scoped>
.gradient-btn {
  background: linear-gradient(135deg, #047857 0%, #10b981 100%);
}
</style>