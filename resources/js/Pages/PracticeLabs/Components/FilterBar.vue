<template>
  <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4" data-aos="fade-up">
    <!-- Search -->
    <div class="relative flex-1 max-w-md">
      <input
        :value="searchQuery"
        @input="$emit('update:search-query', $event.target.value)"
        type="text"
        :placeholder="searchPlaceholder"
        class="w-full pl-10 pr-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-lg focus:outline-none focus:border-primary-500 dark:focus:border-primary-400"
      >
      <i class="fas fa-search absolute left-3 top-4 text-gray-400 dark:text-gray-500"></i>
    </div>

    <!-- Filters -->
    <div class="flex items-center space-x-4">
      <!-- Dynamic Filters -->
      <select
        v-for="filter in filters"
        :key="filter.key"
        :value="filter.value"
        @change="$emit('filter-change', { key: filter.key, value: $event.target.value })"
        class="px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-lg focus:outline-none focus:border-primary-500 dark:focus:border-primary-400"
      >
        <option value="">{{ filter.placeholder }}</option>
        <option
          v-for="option in filter.options"
          :key="option.value"
          :value="option.value"
        >
          {{ option.label }}
        </option>
      </select>
    </div>
  </div>
</template>

<script>
export default {
  name: 'FilterBar',
  props: {
    searchQuery: {
      type: String,
      default: ''
    },
    searchPlaceholder: {
      type: String,
      default: 'Search...'
    },
    filters: {
      type: Array,
      default: () => [],
      validator(value) {
        return value.every(filter =>
          'key' in filter &&
          'placeholder' in filter &&
          'options' in filter &&
          Array.isArray(filter.options)
        );
      }
    }
  },
  emits: ['update:search-query', 'filter-change']
}
</script>