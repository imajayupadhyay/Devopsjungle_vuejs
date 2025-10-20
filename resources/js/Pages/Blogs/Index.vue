<template>
  <div class="bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 transition-colors duration-200">
    <!-- Include AOS -->
    <Head>
      <title>DevOps & Cloud Blog - DevOps Jungle</title>
      <meta name="description" content="Expert insights on DevOps, Cloud Computing, Kubernetes, and modern development practices">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    </Head>

    <!-- Header -->
    <Header />

    <!-- Main Content -->
    <main>
      <!-- Hero Section with Featured Blog -->
      <section class="gradient-bg py-16 lg:py-20">
        <div class="max-w-7xl mx-auto px-4">
          <div class="text-center mb-12" data-aos="fade-up">
            <div class="flex justify-center mb-6">
              <!-- Animated Blog Icon -->
              <div class="relative">
                <div class="w-24 h-24 gradient-btn rounded-2xl flex items-center justify-center animate-float">
                  <i class="fas fa-blog text-white text-4xl"></i>
                </div>
                <div class="absolute -top-2 -right-2 w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center animate-bounce">
                  <i class="fas fa-fire text-yellow-800 text-sm"></i>
                </div>
              </div>
            </div>
            <h1 class="text-4xl lg:text-6xl font-bold text-gray-800 dark:text-white mb-6 leading-tight">
              DevOps & Cloud <span class="gradient-text">Insights</span>
            </h1>
            <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-3xl mx-auto leading-relaxed">
              Expert articles on Kubernetes, CI/CD, Cloud Architecture, and modern development practices
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
              <div class="flex items-center text-gray-600 dark:text-gray-300">
                <i class="fas fa-newspaper text-emerald-600 mr-2"></i>
                <span>Latest Articles</span>
              </div>
              <div class="flex items-center text-gray-600 dark:text-gray-300">
                <i class="fas fa-users text-blue-600 mr-2"></i>
                <span>Expert Authors</span>
              </div>
              <div class="flex items-center text-gray-600 dark:text-gray-300">
                <i class="fas fa-clock text-purple-600 mr-2"></i>
                <span>Updated Weekly</span>
              </div>
            </div>
          </div>

          <!-- Featured Blog -->
          <div v-if="featuredBlog" class="max-w-6xl mx-auto" data-aos="fade-up" data-aos-delay="200">
            <Link :href="`/blogs/${featuredBlog.slug}`" class="group block">
              <div class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:scale-[1.02] border border-gray-200 dark:border-gray-700">
                <div class="grid md:grid-cols-2 gap-0">
                  <div class="relative h-64 md:h-full overflow-hidden">
                    <img :src="featuredBlog.image" :alt="featuredBlog.title" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute top-4 left-4">
                      <span class="px-4 py-2 gradient-btn text-white text-sm font-semibold rounded-full shadow-lg">
                        <i class="fas fa-star mr-1"></i>Featured
                      </span>
                    </div>
                  </div>
                  <div class="p-8 flex flex-col justify-center">
                    <div class="flex items-center space-x-4 mb-4">
                      <span class="px-3 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 text-sm font-medium rounded-full">{{ featuredBlog.category }}</span>
                      <span class="text-gray-500 dark:text-gray-400 text-sm flex items-center">
                        <i class="fas fa-clock mr-1"></i>{{ featuredBlog.readTime }}
                      </span>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-4 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">{{ featuredBlog.title }}</h2>
                    <p class="text-gray-600 dark:text-gray-300 mb-6 line-clamp-3">{{ featuredBlog.excerpt }}</p>
                    <div class="flex items-center space-x-4">
                      <img :src="featuredBlog.author.avatar" :alt="featuredBlog.author.name" class="w-12 h-12 rounded-full border-2 border-emerald-600" />
                      <div>
                        <p class="text-gray-800 dark:text-white font-medium">{{ featuredBlog.author.name }}</p>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">{{ featuredBlog.publishedAt }}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </Link>
          </div>
        </div>
      </section>

      <!-- All Blogs Grid -->
      <section class="py-16 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4">
          <div class="flex items-center justify-between mb-12" data-aos="fade-up">
            <div>
              <h2 class="text-3xl font-bold text-gray-800 dark:text-white">Latest Articles</h2>
              <p class="text-gray-600 dark:text-gray-300 mt-2">Deep dive into DevOps, Cloud, and modern development</p>
            </div>
          </div>

          <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <Link v-for="(blog, index) in blogs" :key="blog.id" :href="`/blogs/${blog.slug}`" class="group" :data-aos="'fade-up'" :data-aos-delay="index * 100">
              <article class="bg-white dark:bg-gray-900 rounded-xl overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:scale-[1.03] h-full flex flex-col border border-gray-200 dark:border-gray-700">
                <div class="relative h-48 overflow-hidden">
                  <img :src="blog.image" :alt="blog.title" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                  <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                  <div class="absolute bottom-4 left-4">
                    <span class="px-3 py-1 bg-emerald-600 text-white text-xs font-medium rounded-full">{{ blog.category }}</span>
                  </div>
                </div>
                <div class="p-6 flex-1 flex flex-col">
                  <div class="flex items-center space-x-3 mb-3 text-sm text-gray-500 dark:text-gray-400">
                    <span class="flex items-center"><i class="fas fa-clock mr-1"></i> {{ blog.readTime }}</span>
                    <span class="flex items-center"><i class="fas fa-eye mr-1"></i> {{ blog.views }}</span>
                  </div>
                  <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-3 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors line-clamp-2">{{ blog.title }}</h3>
                  <p class="text-gray-600 dark:text-gray-300 mb-4 line-clamp-3 flex-1">{{ blog.excerpt }}</p>
                  <div class="flex items-center space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <img :src="blog.author.avatar" :alt="blog.author.name" class="w-10 h-10 rounded-full border-2 border-emerald-600" />
                    <div>
                      <p class="text-gray-800 dark:text-white text-sm font-medium">{{ blog.author.name }}</p>
                      <p class="text-gray-500 dark:text-gray-400 text-xs">{{ blog.publishedAt }}</p>
                    </div>
                  </div>
                </div>
              </article>
            </Link>
          </div>
        </div>
      </section>

      <!-- Newsletter CTA Section -->
      <section class="py-20 gradient-bg">
        <div class="max-w-4xl mx-auto px-4 text-center" data-aos="fade-up">
          <div class="flex justify-center mb-6">
            <div class="w-16 h-16 gradient-btn rounded-full flex items-center justify-center">
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
  name: 'BlogsIndex',
  components: {
    Head,
    Link,
    Header,
    Footer
  },
  props: {
    blogs: {
      type: Array,
      required: true
    },
    featuredBlog: {
      type: Object,
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

.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
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
