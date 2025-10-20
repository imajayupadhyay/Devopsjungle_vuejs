<template>
  <div class="bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 transition-colors duration-200">
    <!-- Include AOS -->
    <Head>
      <title>{{ blog.title }} - DevOps Jungle</title>
      <meta name="description" :content="blog.excerpt">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    </Head>

    <!-- Header -->
    <Header />

    <!-- Main Content -->
    <main>
      <!-- Hero Section -->
      <section class="gradient-bg py-16 lg:py-20">
        <div class="max-w-4xl mx-auto px-4">
          <!-- Breadcrumb -->
          <div class="mb-6" data-aos="fade-up">
            <Link href="/blogs" class="inline-flex items-center text-gray-600 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">
              <i class="fas fa-arrow-left mr-2"></i>Back to Blogs
            </Link>
          </div>

          <!-- Category & Read Time -->
          <div class="flex items-center space-x-4 mb-6" data-aos="fade-up" data-aos-delay="100">
            <span class="px-4 py-2 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 text-sm font-medium rounded-full">{{ blog.category }}</span>
            <span class="text-gray-600 dark:text-gray-300 flex items-center"><i class="fas fa-clock mr-2"></i>{{ blog.readTime }}</span>
            <span class="text-gray-600 dark:text-gray-300 flex items-center"><i class="fas fa-eye mr-2"></i>{{ blog.views }}</span>
          </div>

          <!-- Title -->
          <h1 class="text-4xl md:text-5xl font-bold text-gray-800 dark:text-white mb-6 leading-tight" data-aos="fade-up" data-aos-delay="200">{{ blog.title }}</h1>

          <!-- Author Info -->
          <div class="flex items-center justify-between border-b border-gray-200 dark:border-gray-700 pb-6 mb-8" data-aos="fade-up" data-aos-delay="300">
            <div class="flex items-center space-x-4">
              <img :src="blog.author.avatar" :alt="blog.author.name" class="w-14 h-14 rounded-full border-2 border-emerald-600" />
              <div>
                <p class="text-gray-800 dark:text-white font-semibold">{{ blog.author.name }}</p>
                <p class="text-gray-500 dark:text-gray-400 text-sm">{{ blog.author.role }}</p>
              </div>
            </div>
            <div class="text-right">
              <p class="text-gray-500 dark:text-gray-400 text-sm">Published</p>
              <p class="text-gray-800 dark:text-white font-medium">{{ blog.publishedAt }}</p>
            </div>
          </div>
        </div>
      </section>

      <!-- Featured Image -->
      <section class="py-8 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-5xl mx-auto px-4">
          <div class="rounded-2xl overflow-hidden shadow-2xl" data-aos="zoom-in">
            <img :src="blog.image" :alt="blog.title" class="w-full h-96 object-cover" />
          </div>
        </div>
      </section>

      <!-- Blog Content -->
      <section class="py-12 bg-white dark:bg-gray-900">
        <div class="max-w-4xl mx-auto px-4">
          <article class="prose prose-lg max-w-none" data-aos="fade-up">
            <div v-html="blog.content" class="blog-content text-gray-700 dark:text-gray-300 leading-relaxed"></div>
          </article>

          <!-- Tags -->
          <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-700" data-aos="fade-up">
            <h3 class="text-gray-800 dark:text-white font-semibold mb-4 flex items-center">
              <i class="fas fa-tags text-emerald-600 mr-2"></i>Tags
            </h3>
            <div class="flex flex-wrap gap-3">
              <span v-for="tag in blog.tags" :key="tag" class="px-4 py-2 bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 text-sm rounded-full hover:bg-emerald-50 dark:hover:bg-emerald-900/20 hover:border-emerald-600 transition-colors cursor-pointer">
                {{ tag }}
              </span>
            </div>
          </div>

          <!-- Share Section -->
          <div class="mt-8 pt-8 border-t border-gray-200 dark:border-gray-700" data-aos="fade-up">
            <h3 class="text-gray-800 dark:text-white font-semibold mb-4 flex items-center">
              <i class="fas fa-share-alt text-emerald-600 mr-2"></i>Share this article
            </h3>
            <div class="flex space-x-4">
              <a href="#" class="w-12 h-12 flex items-center justify-center bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-emerald-600 hover:text-white hover:border-emerald-600 transition-all">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="w-12 h-12 flex items-center justify-center bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-emerald-600 hover:text-white hover:border-emerald-600 transition-all">
                <i class="fab fa-linkedin"></i>
              </a>
              <a href="#" class="w-12 h-12 flex items-center justify-center bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-emerald-600 hover:text-white hover:border-emerald-600 transition-all">
                <i class="fab fa-facebook"></i>
              </a>
              <a href="#" class="w-12 h-12 flex items-center justify-center bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-emerald-600 hover:text-white hover:border-emerald-600 transition-all">
                <i class="fas fa-link"></i>
              </a>
            </div>
          </div>

          <!-- Author Bio -->
          <div class="mt-12 p-8 bg-gradient-to-br from-emerald-50 to-green-50 dark:from-emerald-900/20 dark:to-green-900/20 border border-emerald-200 dark:border-emerald-800 rounded-2xl" data-aos="fade-up">
            <div class="flex items-start space-x-6">
              <img :src="blog.author.avatar" :alt="blog.author.name" class="w-24 h-24 rounded-full border-4 border-emerald-600 flex-shrink-0" />
              <div>
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">{{ blog.author.name }}</h3>
                <p class="text-emerald-600 dark:text-emerald-400 mb-4 font-medium">{{ blog.author.role }}</p>
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ blog.author.bio }}</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Related Blogs -->
      <section class="py-16 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-6xl mx-auto px-4">
          <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-12 flex items-center" data-aos="fade-up">
            <i class="fas fa-lightbulb text-yellow-500 mr-3"></i>Related Articles
          </h2>
          <div class="grid md:grid-cols-3 gap-8">
            <Link v-for="(relatedBlog, index) in relatedBlogs" :key="relatedBlog.id" :href="`/blogs/${relatedBlog.slug}`" class="group" :data-aos="'fade-up'" :data-aos-delay="index * 100">
              <article class="bg-white dark:bg-gray-900 rounded-xl overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:scale-[1.03] h-full flex flex-col border border-gray-200 dark:border-gray-700">
                <div class="relative h-48 overflow-hidden">
                  <img :src="relatedBlog.image" :alt="relatedBlog.title" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                  <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                  <div class="absolute bottom-4 left-4">
                    <span class="px-3 py-1 bg-emerald-600 text-white text-xs font-medium rounded-full">{{ relatedBlog.category }}</span>
                  </div>
                </div>
                <div class="p-6 flex-1 flex flex-col">
                  <div class="flex items-center space-x-3 mb-3 text-sm text-gray-500 dark:text-gray-400">
                    <span class="flex items-center"><i class="fas fa-clock mr-1"></i> {{ relatedBlog.readTime }}</span>
                  </div>
                  <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-3 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors line-clamp-2">{{ relatedBlog.title }}</h3>
                  <p class="text-gray-600 dark:text-gray-300 mb-4 line-clamp-2 flex-1">{{ relatedBlog.excerpt }}</p>
                </div>
              </article>
            </Link>
          </div>
        </div>
      </section>

      <!-- Newsletter CTA -->
      <section class="py-20 gradient-bg">
        <div class="max-w-4xl mx-auto px-4 text-center" data-aos="fade-up">
          <div class="flex justify-center mb-6">
            <div class="w-16 h-16 gradient-btn rounded-full flex items-center justify-center animate-float">
              <i class="fas fa-envelope text-white text-2xl"></i>
            </div>
          </div>
          <h2 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-white mb-4">Stay Updated</h2>
          <p class="text-gray-600 dark:text-gray-300 mb-8 text-lg">Get the latest DevOps and Cloud insights delivered to your inbox</p>
          <div class="flex flex-col sm:flex-row gap-4 justify-center max-w-xl mx-auto">
            <input type="email" placeholder="Enter your email" class="px-6 py-3 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-600 flex-1" />
            <button class="gradient-btn text-white px-8 py-3 rounded-lg font-semibold hover:opacity-90 transition-opacity">Subscribe</button>
          </div>
        </div>
      </section>
    </main>

    <!-- Footer -->
    <Footer />
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3'
import Header from '../Common/Header.vue'
import Footer from '../Common/Footer.vue'

export default {
  name: 'BlogDetail',
  components: {
    Head,
    Link,
    Header,
    Footer
  },
  props: {
    blog: {
      type: Object,
      required: true
    },
    relatedBlogs: {
      type: Array,
      required: true
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

.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

/* Blog Content Styling */
:deep(.blog-content h2) {
  @apply text-2xl font-bold text-gray-800 dark:text-white mt-8 mb-4;
}

:deep(.blog-content h3) {
  @apply text-xl font-bold text-gray-800 dark:text-white mt-6 mb-3;
}

:deep(.blog-content p) {
  @apply mb-4 leading-relaxed text-gray-700 dark:text-gray-300;
}

:deep(.blog-content ul) {
  @apply list-disc list-inside mb-4 space-y-2;
}

:deep(.blog-content ol) {
  @apply list-decimal list-inside mb-4 space-y-2;
}

:deep(.blog-content li) {
  @apply text-gray-700 dark:text-gray-300;
}

:deep(.blog-content strong) {
  @apply text-gray-800 dark:text-white font-semibold;
}

:deep(.blog-content code) {
  @apply bg-gray-100 dark:bg-gray-800 text-emerald-600 dark:text-emerald-400 px-2 py-1 rounded text-sm;
}

:deep(.blog-content pre) {
  @apply bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4 overflow-x-auto mb-4;
}

:deep(.blog-content blockquote) {
  @apply border-l-4 border-emerald-600 pl-4 italic text-gray-600 dark:text-gray-400 my-4;
}

:deep(.blog-content a) {
  @apply text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 transition-colors underline;
}

:deep(.blog-content table) {
  @apply w-full border-collapse mb-4;
}

:deep(.blog-content th) {
  @apply bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-white font-semibold p-2 border border-gray-200 dark:border-gray-700;
}

:deep(.blog-content td) {
  @apply text-gray-700 dark:text-gray-300 p-2 border border-gray-200 dark:border-gray-700;
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
