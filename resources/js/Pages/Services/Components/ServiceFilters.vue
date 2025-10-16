<template>
  <div class="flex flex-wrap items-center justify-between gap-4">
    <!-- Service Categories -->
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
        <i :class="[
          category.icon,
          'text-sm',
          selectedCategory === category.id
            ? 'text-white'
            : 'text-gray-600 dark:text-gray-400'
        ]"></i>
        <span>{{ category.name }}</span>
        <span v-if="selectedCategory !== category.id" class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 px-2 py-0.5 rounded-full text-xs">
          {{ category.count }}
        </span>
      </button>
    </div>

    <!-- Filters and Search -->
    <div class="flex flex-wrap items-center gap-3">
      <!-- Search -->
      <div class="relative">
        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 dark:text-gray-500"></i>
        <input
          type="text"
          :value="searchQuery"
          @input="$emit('search-change', $event.target.value)"
          placeholder="Search services..."
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

      <!-- Service Type Filter -->
      <select
        :value="typeFilter"
        @change="$emit('type-change', $event.target.value)"
        class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-primary-500 dark:focus:border-primary-400 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
      >
        <option value="all">All Types</option>
        <option value="individual">Individual</option>
        <option value="group">Group</option>
        <option value="corporate">Corporate</option>
        <option value="self-paced">Self-Paced</option>
      </select>

      <!-- Price Range Filter -->
      <select
        :value="priceFilter"
        @change="$emit('price-change', $event.target.value)"
        class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-primary-500 dark:focus:border-primary-400 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
      >
        <option value="all">Any Price</option>
        <option value="free">Free</option>
        <option value="under-100">Under $100</option>
        <option value="100-500">$100 - $500</option>
        <option value="500-1000">$500 - $1000</option>
        <option value="over-1000">$1000+</option>
      </select>

      <!-- Sort -->
      <select
        :value="sortOption"
        @change="$emit('sort-change', $event.target.value)"
        class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-primary-500 dark:focus:border-primary-400 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
      >
        <option value="popularity">Most Popular</option>
        <option value="rating">Highest Rated</option>
        <option value="price-low">Price: Low to High</option>
        <option value="price-high">Price: High to Low</option>
        <option value="newest">Newest First</option>
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
  name: 'ServiceFilters',
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
    typeFilter: {
      type: String,
      default: 'all'
    },
    priceFilter: {
      type: String,
      default: 'all'
    },
    sortOption: {
      type: String,
      default: 'popularity'
    }
  },
  emits: ['category-change', 'search-change', 'type-change', 'price-change', 'sort-change', 'clear-filters'],
  computed: {
    hasActiveFilters() {
      return this.selectedCategory !== 'all' ||
             this.searchQuery !== '' ||
             this.typeFilter !== 'all' ||
             this.priceFilter !== 'all' ||
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