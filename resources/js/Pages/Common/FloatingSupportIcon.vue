<template>
  <div class="fixed bottom-6 right-6 z-50">
    <button
      @click="handleSupportClick"
      class="w-14 h-14 gradient-btn rounded-full shadow-lg hover:shadow-xl transform hover:scale-110 transition-all duration-300 flex items-center justify-center group"
      title="Support"
    >
      <i class="fas fa-headset text-white text-xl group-hover:animate-pulse"></i>
    </button>
  </div>
</template>

<script>
export default {
  name: 'FloatingSupportIcon',
  methods: {
    handleSupportClick() {
      // This will be where you add the link later
      // For now, we can redirect to the support page
      window.location.href = '/support'
    }
  }
}
</script>