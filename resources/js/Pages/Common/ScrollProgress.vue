<template>
  <div class="scroll-progress" :style="{ transform: `scaleX(${scrollProgress})` }"></div>
</template>

<script>
import { ref, onMounted, onUnmounted } from 'vue'

export default {
  name: 'ScrollProgress',
  setup() {
    const scrollProgress = ref(0)

    const updateScrollProgress = () => {
      const scrollTop = window.pageYOffset || document.documentElement.scrollTop
      const docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight
      const progress = docHeight > 0 ? scrollTop / docHeight : 0
      scrollProgress.value = Math.min(Math.max(progress, 0), 1)
    }

    onMounted(() => {
      window.addEventListener('scroll', updateScrollProgress, { passive: true })
      updateScrollProgress()
    })

    onUnmounted(() => {
      window.removeEventListener('scroll', updateScrollProgress)
    })

    return {
      scrollProgress
    }
  }
}
</script>