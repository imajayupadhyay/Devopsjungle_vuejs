<template>
  <div>
    <!-- Single Row with Search and Filters -->
    <div class="flex flex-wrap items-center gap-3">
      <!-- Search Bar -->
      <div class="relative flex-1 min-w-[300px]">
        <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 dark:text-gray-500"></i>
        <input
          type="text"
          :value="searchQuery"
          @input="$emit('search-change', $event.target.value)"
          placeholder="Search courses by title, instructor, or skills..."
          class="w-full pl-12 pr-12 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 focus:border-transparent bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400"
        >
        <button
          v-if="searchQuery"
          @click="$emit('search-change', '')"
          class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 transition-colors"
        >
          <i class="fas fa-times"></i>
        </button>
      </div>
      <!-- Category Dropdown -->
      <div class="relative" ref="categoryDropdown">
        <button
          @click="toggleCategoryDropdown"
          class="px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors flex items-center space-x-2 whitespace-nowrap"
        >
          <i :class="getSelectedCategoryIcon()" class="text-primary-600 dark:text-primary-400"></i>
          <span>{{ getSelectedCategoryName() }}</span>
          <i class="fas fa-chevron-down text-xs"></i>
        </button>

        <!-- Category Dropdown Menu -->
        <div
          v-show="showCategoryDropdown"
          class="absolute z-50 mt-2 w-72 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg max-h-96 overflow-y-auto"
        >
          <div class="p-2">
            <button
              v-for="category in categories"
              :key="category.id"
              @click="selectCategory(category.id)"
              :class="[
                'w-full flex items-center justify-between px-3 py-2 rounded-md transition-colors text-left',
                selectedCategory === category.id
                  ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-700 dark:text-primary-300'
                  : 'hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300'
              ]"
            >
              <div class="flex items-center space-x-3">
                <i :class="category.icon" class="w-5 text-center"></i>
                <span class="font-medium">{{ category.name }}</span>
              </div>
              <span class="text-xs bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 px-2 py-1 rounded-full">
                {{ category.count }}
              </span>
            </button>
          </div>
        </div>
      </div>

      <!-- Level Filter -->
      <select
        :value="levelFilter"
        @change="$emit('level-change', $event.target.value)"
        class="px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 focus:border-transparent bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
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
        class="px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 focus:border-transparent bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
      >
        <option value="short">0-5 hours</option>
        <option value="medium">5-20 hours</option>
        <option value="long">20+ hours</option>
      </select>

      <!-- Sort -->
      <select
        :value="sortOption"
        @change="$emit('sort-change', $event.target.value)"
        class="px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 focus:border-transparent bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
      >
        <option value="newest">Newest First</option>
        <option value="rating">Highest Rated</option>
        <option value="price-low">Price: Low to High</option>
        <option value="price-high">Price: High to Low</option>
        <option value="duration">Duration</option>
      </select>

      <!-- Active Filters Badge -->
      <div v-if="hasActiveFilters" class="flex items-center gap-2">
        <button
          @click="$emit('clear-filters')"
          class="px-3 py-2.5 text-sm text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 border border-red-300 dark:border-red-600 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors whitespace-nowrap"
        >
          <i class="fas fa-times mr-1"></i>Clear All
        </button>
      </div>
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
  data() {
    return {
      showCategoryDropdown: false
    }
  },
  computed: {
    hasActiveFilters() {
      return this.selectedCategory !== 'all' ||
             this.searchQuery !== ''
    }
  },
  mounted() {
    // Close dropdown when clicking outside
    document.addEventListener('click', this.handleClickOutside)
  },
  beforeUnmount() {
    document.removeEventListener('click', this.handleClickOutside)
  },
  methods: {
    toggleCategoryDropdown() {
      this.showCategoryDropdown = !this.showCategoryDropdown
    },
    selectCategory(categoryId) {
      this.$emit('category-change', categoryId)
      this.showCategoryDropdown = false
    },
    handleClickOutside(event) {
      const dropdown = this.$refs.categoryDropdown
      if (dropdown && !dropdown.contains(event.target)) {
        this.showCategoryDropdown = false
      }
    },
    getSelectedCategoryName() {
      const category = this.categories.find(cat => cat.id === this.selectedCategory)
      return category ? category.name : 'All Categories'
    },
    getSelectedCategoryIcon() {
      const category = this.categories.find(cat => cat.id === this.selectedCategory)
      return category ? category.icon : 'fas fa-th-large'
    }
  }
}
</script>

<style scoped>
/* Smooth dropdown animation */
</style>