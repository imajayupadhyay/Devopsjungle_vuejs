<template>
  <div class="bg-gray-50 dark:bg-gray-900 text-gray-700 dark:text-gray-300 transition-colors duration-200">
    <Head>
      <title>{{ course.title }} - Course Details</title>
      <meta name="description" :content="`${course.description} - Learn ${course.category.toUpperCase()} with expert instruction.`">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    </Head>

    <!-- Header -->
    <DevOpsHeader />

    <!-- Breadcrumb -->
    <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                <Link href="/" class="hover:text-primary-600 dark:hover:text-primary-400">Home</Link>
                <i class="fas fa-chevron-right mx-2 text-xs"></i>
                <Link href="/courses" class="hover:text-primary-600 dark:hover:text-primary-400">Courses</Link>
                <i class="fas fa-chevron-right mx-2 text-xs"></i>
                <Link href="/courses" class="hover:text-primary-600 dark:hover:text-primary-400">{{ getCategoryName(course.category) }}</Link>
                <i class="fas fa-chevron-right mx-2 text-xs"></i>
                <span class="text-gray-700 dark:text-gray-300">{{ course.title }}</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="grid lg:grid-cols-3 gap-8">

            <!-- Main Column -->
            <div class="lg:col-span-2">

                <!-- Course Header -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden mb-8">
                    <div class="course-gradient p-8" :style="getCourseGradient()">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center">
                                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-4 shadow-md">
                                    <i :class="getCourseIcon()" class="text-3xl text-white"></i>
                                </div>
                                <div>
                                    <div class="flex items-center space-x-2 mb-2">
                                        <span class="text-xs font-semibold text-white uppercase tracking-wide bg-white bg-opacity-20 px-2 py-1 rounded">
                                            {{ course.category }}
                                        </span>
                                        <span v-if="course.bestseller" class="bg-orange-500 text-white px-2 py-1 rounded text-xs font-bold">
                                            Best Seller
                                        </span>
                                    </div>
                                    <h1 class="text-3xl font-bold text-white mb-1">{{ course.title }}</h1>
                                    <p class="text-lg text-white opacity-90">{{ course.instructor }}</p>
                                </div>
                            </div>
                            <span :class="getLevelClass()" class="px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                {{ course.level.charAt(0).toUpperCase() + course.level.slice(1) }}
                            </span>
                        </div>

                        <p class="text-white opacity-90 mb-6">
                            {{ course.description }}
                        </p>

                        <!-- Quick Stats -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="bg-white bg-opacity-20 rounded-lg p-3 text-center">
                                <div class="text-2xl font-bold text-white">{{ course.lessons }}</div>
                                <div class="text-xs text-white opacity-75">Lessons</div>
                            </div>
                            <div class="bg-white bg-opacity-20 rounded-lg p-3 text-center">
                                <div class="text-2xl font-bold text-white">{{ course.duration }}h</div>
                                <div class="text-xs text-white opacity-75">Duration</div>
                            </div>
                            <div class="bg-white bg-opacity-20 rounded-lg p-3 text-center">
                                <div class="text-2xl font-bold text-white">{{ course.rating }}</div>
                                <div class="text-xs text-white opacity-75">Rating</div>
                            </div>
                            <div class="bg-white bg-opacity-20 rounded-lg p-3 text-center">
                                <div class="text-2xl font-bold text-white">{{ formatNumber(course.students) }}</div>
                                <div class="text-xs text-white opacity-75">Students</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabs Navigation -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md mb-8">
                    <div class="border-b border-gray-200 dark:border-gray-700">
                        <div class="flex overflow-x-auto">
                            <button
                                class="tab-btn px-6 py-4 font-medium whitespace-nowrap"
                                :class="{ 'active': activeTab === 'overview' }"
                                @click="switchTab('overview')"
                            >
                                Overview
                            </button>
                            <button
                                class="tab-btn px-6 py-4 font-medium whitespace-nowrap"
                                :class="{ 'active': activeTab === 'curriculum' }"
                                @click="switchTab('curriculum')"
                            >
                                Curriculum
                            </button>
                            <button
                                class="tab-btn px-6 py-4 font-medium whitespace-nowrap"
                                :class="{ 'active': activeTab === 'instructor' }"
                                @click="switchTab('instructor')"
                            >
                                Instructor
                            </button>
                            <button
                                class="tab-btn px-6 py-4 font-medium whitespace-nowrap"
                                :class="{ 'active': activeTab === 'reviews' }"
                                @click="switchTab('reviews')"
                            >
                                Reviews
                            </button>
                            <button
                                class="tab-btn px-6 py-4 font-medium whitespace-nowrap"
                                :class="{ 'active': activeTab === 'faq' }"
                                @click="switchTab('faq')"
                            >
                                FAQ
                            </button>
                        </div>
                    </div>

                    <!-- Tab Content: Overview -->
                    <div v-show="activeTab === 'overview'" class="tab-content p-6">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Course Overview</h2>

                        <div class="space-y-6">
                            <div>
                                <h3 class="font-semibold text-gray-800 dark:text-white mb-2">What You'll Learn</h3>
                                <div class="grid md:grid-cols-2 gap-3">
                                    <div v-for="skill in course.skills" :key="skill" class="flex items-start">
                                        <i class="fas fa-check text-primary-600 dark:text-primary-400 mt-1 mr-2"></i>
                                        <span class="text-gray-600 dark:text-gray-300">{{ skill }}</span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="font-semibold text-gray-800 dark:text-white mb-2">Course Requirements</h3>
                                <ul class="list-disc list-inside text-gray-600 dark:text-gray-300 space-y-1">
                                    <li v-for="requirement in getRequirements()" :key="requirement">{{ requirement }}</li>
                                </ul>
                            </div>

                            <div>
                                <h3 class="font-semibold text-gray-800 dark:text-white mb-2">Who This Course Is For</h3>
                                <ul class="list-disc list-inside text-gray-600 dark:text-gray-300 space-y-1">
                                    <li v-for="audience in getTargetAudience()" :key="audience">{{ audience }}</li>
                                </ul>
                            </div>

                            <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                                <div class="flex items-start">
                                    <i class="fas fa-info-circle text-blue-600 dark:text-blue-400 mt-1 mr-3"></i>
                                    <div>
                                        <h4 class="font-semibold text-blue-900 dark:text-blue-200 mb-1">Course Features</h4>
                                        <p class="text-blue-800 dark:text-blue-300 text-sm">
                                            {{ course.duration }} hours of on-demand video, {{ course.lessons }} lectures,
                                            {{ course.certificate ? 'Certificate of completion' : 'No certificate' }},
                                            Full lifetime access, Access on mobile and TV
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Content: Curriculum -->
                    <div v-show="activeTab === 'curriculum'" class="tab-content p-6">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Course Curriculum</h2>

                        <div class="space-y-4">
                            <div v-for="(module, index) in getCurriculum()" :key="index" class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                                <button
                                    class="accordion-btn w-full flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600"
                                    @click="toggleAccordion(index)"
                                >
                                    <div class="flex items-center">
                                        <span class="font-semibold text-gray-800 dark:text-white">Module {{ index + 1 }}: {{ module.title }}</span>
                                        <span class="ml-3 text-sm text-gray-500 dark:text-gray-400">({{ module.lessons }} lessons • {{ module.duration }}h)</span>
                                    </div>
                                    <i class="fas fa-chevron-down text-gray-500 dark:text-gray-400" :class="{ 'fa-chevron-up': openAccordions.includes(index) }"></i>
                                </button>
                                <div class="accordion-content p-4" :class="{ 'active': openAccordions.includes(index) }">
                                    <ul class="space-y-2">
                                        <li v-for="(lesson, lessonIndex) in module.content" :key="lessonIndex" class="flex items-center text-gray-600 dark:text-gray-300">
                                            <i class="fas fa-play-circle text-primary-600 dark:text-primary-400 mr-2"></i>
                                            <span class="text-sm">{{ lesson }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Content: Instructor -->
                    <div v-show="activeTab === 'instructor'" class="tab-content p-6">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">About the Instructor</h2>

                        <div class="flex items-start space-x-4 mb-6">
                            <div class="w-20 h-20 bg-primary-100 dark:bg-primary-900 rounded-full flex items-center justify-center">
                                <span class="text-primary-700 dark:text-primary-300 font-bold text-2xl">{{ getInstructorInitials() }}</span>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-800 dark:text-white">{{ course.instructor }}</h3>
                                <p class="text-gray-600 dark:text-gray-300 mb-2">Expert {{ course.category.toUpperCase() }} Instructor</p>
                                <div class="flex space-x-4 text-sm text-gray-500 dark:text-gray-400">
                                    <span><i class="fas fa-users mr-1"></i>{{ formatNumber(course.students) }} students</span>
                                    <span><i class="fas fa-star mr-1"></i>{{ course.rating }} rating</span>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <p class="text-gray-600 dark:text-gray-300">
                                {{ getInstructorBio() }}
                            </p>

                            <div>
                                <h4 class="font-semibold text-gray-800 dark:text-white mb-2">Expertise</h4>
                                <div class="flex flex-wrap gap-2">
                                    <span v-for="skill in course.skills.slice(0, 6)" :key="skill" class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-3 py-1 rounded-full text-sm">
                                        {{ skill }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Content: Reviews -->
                    <div v-show="activeTab === 'reviews'" class="tab-content p-6">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Student Reviews</h2>

                        <!-- Rating Summary -->
                        <div class="bg-gradient-to-r from-green-50 to-blue-50 dark:from-green-900/20 dark:to-blue-900/20 rounded-lg p-6 mb-6">
                            <div class="grid md:grid-cols-2 gap-6">
                                <div class="text-center">
                                    <div class="text-5xl font-bold gradient-text mb-2">{{ course.rating }}</div>
                                    <div class="flex justify-center mb-2">
                                        <i v-for="n in 5" :key="n" :class="[
                                            'fas fa-star',
                                            n <= Math.floor(course.rating) ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600'
                                        ]"></i>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-300">Based on {{ formatNumber(course.reviews) }} reviews</p>
                                </div>
                                <div class="space-y-2">
                                    <div class="flex items-center">
                                        <span class="text-sm text-gray-600 dark:text-gray-300 w-12">5 star</span>
                                        <div class="flex-1 mx-3">
                                            <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-2">
                                                <div class="bg-yellow-400 h-2 rounded-full" style="width: 70%"></div>
                                            </div>
                                        </div>
                                        <span class="text-sm text-gray-600 dark:text-gray-300 w-12 text-right">70%</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-sm text-gray-600 dark:text-gray-300 w-12">4 star</span>
                                        <div class="flex-1 mx-3">
                                            <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-2">
                                                <div class="bg-yellow-400 h-2 rounded-full" style="width: 20%"></div>
                                            </div>
                                        </div>
                                        <span class="text-sm text-gray-600 dark:text-gray-300 w-12 text-right">20%</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-sm text-gray-600 dark:text-gray-300 w-12">3 star</span>
                                        <div class="flex-1 mx-3">
                                            <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-2">
                                                <div class="bg-yellow-400 h-2 rounded-full" style="width: 7%"></div>
                                            </div>
                                        </div>
                                        <span class="text-sm text-gray-600 dark:text-gray-300 w-12 text-right">7%</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-sm text-gray-600 dark:text-gray-300 w-12">2 star</span>
                                        <div class="flex-1 mx-3">
                                            <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-2">
                                                <div class="bg-yellow-400 h-2 rounded-full" style="width: 2%"></div>
                                            </div>
                                        </div>
                                        <span class="text-sm text-gray-600 dark:text-gray-300 w-12 text-right">2%</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-sm text-gray-600 dark:text-gray-300 w-12">1 star</span>
                                        <div class="flex-1 mx-3">
                                            <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-2">
                                                <div class="bg-yellow-400 h-2 rounded-full" style="width: 1%"></div>
                                            </div>
                                        </div>
                                        <span class="text-sm text-gray-600 dark:text-gray-300 w-12 text-right">1%</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Individual Reviews -->
                        <div class="space-y-4">
                            <div v-for="review in getCourseReviews()" :key="review.id" class="review-card border border-gray-200 dark:border-gray-700 rounded-lg p-5">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-primary-100 dark:bg-primary-900 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-primary-700 dark:text-primary-300 font-semibold">{{ review.initials }}</span>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-800 dark:text-white">{{ review.name }}</h4>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ review.role }}</p>
                                        </div>
                                    </div>
                                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ review.timeAgo }}</span>
                                </div>
                                <div class="flex mb-2">
                                    <i v-for="star in 5" :key="star" :class="star <= review.rating ? 'fas fa-star text-yellow-400' : 'far fa-star text-gray-300 dark:text-gray-600'" class="text-sm"></i>
                                </div>
                                <h5 class="font-semibold text-gray-800 dark:text-white mb-2">{{ review.title }}</h5>
                                <p class="text-gray-600 dark:text-gray-300 mb-3">{{ review.content }}</p>
                                <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                    <span class="flex items-center mr-4">
                                        <i class="fas fa-check-circle text-green-500 mr-1"></i>
                                        Verified Purchase
                                    </span>
                                    <span class="flex items-center">
                                        <i class="fas fa-thumbs-up mr-1"></i>
                                        Helpful ({{ review.helpful }})
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-6">
                            <button class="border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 px-6 py-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                Load More Reviews
                            </button>
                        </div>
                    </div>

                    <!-- Tab Content: FAQ -->
                    <div v-show="activeTab === 'faq'" class="tab-content p-6">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Frequently Asked Questions</h2>

                        <div class="space-y-3">
                            <div v-for="(faq, index) in getFAQs()" :key="index" class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                                <button
                                    class="accordion-btn w-full flex items-center justify-between p-4 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 text-left"
                                    @click="toggleFaqAccordion(index)"
                                >
                                    <span class="font-semibold text-gray-800 dark:text-white">{{ faq.question }}</span>
                                    <i class="fas fa-chevron-down text-gray-500 dark:text-gray-400" :class="{ 'fa-chevron-up': openFaqs.includes(index) }"></i>
                                </button>
                                <div class="accordion-content p-4 bg-gray-50 dark:bg-gray-700" :class="{ 'active': openFaqs.includes(index) }">
                                    <p class="text-gray-600 dark:text-gray-300">{{ faq.answer }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Related Courses -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Related Courses</h2>
                    <div class="space-y-3">
                        <Link
                            v-for="related in relatedCourses"
                            :key="related.id"
                            :href="`/courses/${related.id}`"
                            class="flex items-center p-3 border border-gray-200 dark:border-gray-700 rounded-lg hover:border-primary-500 dark:hover:border-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-colors"
                        >
                            <i :class="getCourseIcon(related.category)" class="text-2xl mr-3"></i>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-800 dark:text-white">{{ related.title }}</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ related.instructor }}</p>
                                <div class="flex items-center space-x-2 mt-1">
                                    <span class="text-sm font-bold text-primary-600 dark:text-primary-400">${{ related.price }}</span>
                                    <div class="flex">
                                        <i v-for="n in 5" :key="n" :class="[
                                            'fas fa-star text-xs',
                                            n <= Math.floor(related.rating) ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600'
                                        ]"></i>
                                    </div>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">({{ related.rating }})</span>
                                </div>
                            </div>
                            <i class="fas fa-arrow-right ml-auto text-gray-400 dark:text-gray-500"></i>
                        </Link>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="sticky-sidebar space-y-6">

                    <!-- Enrollment Card -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden border-2 border-primary-200 dark:border-primary-600">
                        <div class="course-gradient p-4" :style="getCourseGradient()">
                            <h3 class="text-xl font-bold text-white">Enroll in this Course</h3>
                        </div>
                        <div class="p-6">
                            <div class="mb-6">
                                <div class="flex items-baseline mb-2">
                                    <span class="text-4xl font-bold gradient-text">${{ course.price }}</span>
                                    <span v-if="course.originalPrice" class="text-gray-500 dark:text-gray-400 line-through ml-2">${{ course.originalPrice }}</span>
                                    <span v-if="course.originalPrice" class="bg-red-500 text-white text-xs px-2 py-1 rounded ml-2">
                                        {{ Math.round((1 - course.price / course.originalPrice) * 100) }}% OFF
                                    </span>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">One-time payment - Full lifetime access</p>
                            </div>

                            <div class="space-y-3 mb-6">
                                <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                    <i class="fas fa-play-circle text-primary-600 dark:text-primary-400 mr-2"></i>
                                    <span>{{ course.lessons }} on-demand video lessons</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                    <i class="fas fa-clock text-primary-600 dark:text-primary-400 mr-2"></i>
                                    <span>{{ course.duration }} hours of content</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                    <i class="fas fa-mobile-alt text-primary-600 dark:text-primary-400 mr-2"></i>
                                    <span>Access on mobile and desktop</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                    <i class="fas fa-infinity text-primary-600 dark:text-primary-400 mr-2"></i>
                                    <span>Full lifetime access</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                    <i class="fas fa-certificate text-primary-600 dark:text-primary-400 mr-2"></i>
                                    <span>{{ course.certificate ? 'Certificate of completion' : 'No certificate' }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                    <i class="fas fa-undo text-primary-600 dark:text-primary-400 mr-2"></i>
                                    <span>30-day money-back guarantee</span>
                                </div>
                            </div>

                            <button @click="openEnrollmentModal" class="w-full gradient-btn text-white py-3 rounded-lg font-semibold hover:opacity-90 transition-opacity mb-3">
                                <i class="fas fa-play mr-2"></i>Enroll Now
                            </button>
                            <button @click="addToWishlist" class="w-full border-2 border-primary-600 dark:border-primary-400 text-primary-600 dark:text-primary-400 py-3 rounded-lg font-semibold hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-colors">
                                <i class="fas fa-heart mr-2"></i>Add to Wishlist
                            </button>

                            <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                                <div class="flex items-center justify-center text-sm text-gray-600 dark:text-gray-300">
                                    <i class="fas fa-shield-alt text-primary-600 dark:text-primary-400 mr-2"></i>
                                    <span>Secure Payment - SSL Protected</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Course Features -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
                        <h3 class="font-bold text-gray-800 dark:text-white mb-4">This Course Includes</h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex items-center text-gray-600 dark:text-gray-300">
                                <i class="fas fa-video text-primary-600 dark:text-primary-400 mr-3 w-4"></i>
                                <span>{{ course.duration }} hours on-demand video</span>
                            </div>
                            <div class="flex items-center text-gray-600 dark:text-gray-300">
                                <i class="fas fa-file-alt text-primary-600 dark:text-primary-400 mr-3 w-4"></i>
                                <span>Downloadable resources</span>
                            </div>
                            <div class="flex items-center text-gray-600 dark:text-gray-300">
                                <i class="fas fa-code text-primary-600 dark:text-primary-400 mr-3 w-4"></i>
                                <span>Hands-on exercises</span>
                            </div>
                            <div class="flex items-center text-gray-600 dark:text-gray-300">
                                <i class="fas fa-users text-primary-600 dark:text-primary-400 mr-3 w-4"></i>
                                <span>Access to instructor</span>
                            </div>
                            <div class="flex items-center text-gray-600 dark:text-gray-300">
                                <i class="fas fa-mobile-alt text-primary-600 dark:text-primary-400 mr-3 w-4"></i>
                                <span>Access on mobile and TV</span>
                            </div>
                        </div>
                    </div>

                    <!-- Need Help -->
                    <div class="bg-gradient-to-br from-primary-50 to-blue-50 dark:from-primary-900/20 dark:to-blue-900/20 rounded-xl p-6">
                        <h3 class="font-bold text-gray-800 dark:text-white mb-2">Need Help?</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">Our support team is here to help you choose the right course for your career goals.</p>
                        <div class="space-y-2">
                            <a href="#" class="flex items-center text-sm text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300">
                                <i class="fas fa-comments mr-2"></i>
                                Live Chat Support
                            </a>
                            <a href="#" class="flex items-center text-sm text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300">
                                <i class="fas fa-envelope mr-2"></i>
                                Email Support
                            </a>
                            <a href="#" class="flex items-center text-sm text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300">
                                <i class="fas fa-phone mr-2"></i>
                                Call Us
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Enrollment Modal -->
    <div v-show="showEnrollmentModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-md">
            <div class="course-gradient p-6 rounded-t-2xl" :style="getCourseGradient()">
                <div class="flex justify-between items-center">
                    <h3 class="text-2xl font-bold text-white">Enroll in Course</h3>
                    <button @click="closeEnrollmentModal" class="text-white hover:text-gray-200">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            <div class="p-6">
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-gray-700 dark:text-gray-300">{{ course.title }}</span>
                        <span class="font-bold text-gray-800 dark:text-white">${{ course.price }}.00</span>
                    </div>
                    <div v-if="course.originalPrice" class="flex justify-between items-center mb-4">
                        <span class="text-gray-700 dark:text-gray-300">Discount ({{ Math.round((1 - course.price / course.originalPrice) * 100) }}%)</span>
                        <span class="font-bold text-green-600 dark:text-green-400">-${{ course.originalPrice - course.price }}.00</span>
                    </div>
                    <div class="border-t border-gray-200 dark:border-gray-600 pt-4 flex justify-between items-center">
                        <span class="text-lg font-bold text-gray-800 dark:text-white">Total</span>
                        <span class="text-2xl font-bold gradient-text">${{ course.price }}.00</span>
                    </div>
                </div>

                <form @submit.prevent="processEnrollment" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email Address</label>
                        <input v-model="enrollmentForm.email" type="email" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:border-primary-500 dark:focus:border-primary-400" placeholder="your@email.com">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Card Information</label>
                        <input v-model="enrollmentForm.cardNumber" type="text" placeholder="1234 5678 9012 3456" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:border-primary-500 dark:focus:border-primary-400 mb-2">
                        <div class="grid grid-cols-2 gap-2">
                            <input v-model="enrollmentForm.expiryDate" type="text" placeholder="MM/YY" class="px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:border-primary-500 dark:focus:border-primary-400">
                            <input v-model="enrollmentForm.cvc" type="text" placeholder="CVC" class="px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:border-primary-500 dark:focus:border-primary-400">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Cardholder Name</label>
                        <input v-model="enrollmentForm.cardholderName" type="text" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:border-primary-500 dark:focus:border-primary-400" placeholder="John Doe">
                    </div>

                    <div>
                        <label class="flex items-start">
                            <input v-model="enrollmentForm.agreeToTerms" type="checkbox" required class="mt-1 mr-2">
                            <span class="text-sm text-gray-600 dark:text-gray-300">
                                I agree to the <a href="#" class="text-primary-600 dark:text-primary-400 hover:underline">Terms of Service</a> and <a href="#" class="text-primary-600 dark:text-primary-400 hover:underline">Privacy Policy</a>
                            </span>
                        </label>
                    </div>

                    <button type="submit" :disabled="processing" class="w-full gradient-btn text-white py-3 rounded-lg font-semibold hover:opacity-90 transition-opacity">
                        <i v-if="processing" class="fas fa-spinner fa-spin mr-2"></i>
                        <i v-else class="fas fa-lock mr-2"></i>
                        {{ processing ? 'Processing...' : 'Complete Enrollment' }}
                    </button>
                </form>

                <div class="mt-4 flex items-center justify-center space-x-4 text-gray-400">
                    <i class="fab fa-cc-visa text-3xl"></i>
                    <i class="fab fa-cc-mastercard text-3xl"></i>
                    <i class="fab fa-cc-amex text-3xl"></i>
                    <i class="fab fa-cc-paypal text-3xl"></i>
                </div>

                <p class="text-xs text-center text-gray-500 dark:text-gray-400 mt-4">
                    Your payment information is encrypted and secure. We never store your card details.
                </p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <DevOpsFooter />
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3'
import DevOpsHeader from '../Common/Header.vue'
import DevOpsFooter from '../Common/Footer.vue'

export default {
  name: 'CourseDetailPage',
  components: {
    Head,
    Link,
    DevOpsHeader,
    DevOpsFooter
  },
  props: {
    course: {
      type: Object,
      required: true
    },
    relatedCourses: {
      type: Array,
      default: () => []
    }
  },
  data() {
    return {
      activeTab: 'overview',
      openAccordions: [],
      openFaqs: [],
      showEnrollmentModal: false,
      processing: false,
      enrollmentForm: {
        email: '',
        cardNumber: '',
        expiryDate: '',
        cvc: '',
        cardholderName: '',
        agreeToTerms: false
      }
    }
  },
  methods: {
    switchTab(tab) {
      this.activeTab = tab
    },
    toggleAccordion(index) {
      const accordionIndex = this.openAccordions.indexOf(index)
      if (accordionIndex > -1) {
        this.openAccordions.splice(accordionIndex, 1)
      } else {
        this.openAccordions.push(index)
      }
    },
    toggleFaqAccordion(index) {
      const faqIndex = this.openFaqs.indexOf(index)
      if (faqIndex > -1) {
        this.openFaqs.splice(faqIndex, 1)
      } else {
        this.openFaqs.push(index)
      }
    },
    openEnrollmentModal() {
      this.showEnrollmentModal = true
      document.body.style.overflow = 'hidden'
    },
    closeEnrollmentModal() {
      this.showEnrollmentModal = false
      document.body.style.overflow = ''
    },
    processEnrollment() {
      this.processing = true

      // Simulate payment processing
      setTimeout(() => {
        this.processing = false
        this.closeEnrollmentModal()
        alert('Enrollment successful! Check your email for course access instructions.')

        // Reset form
        this.enrollmentForm = {
          email: '',
          cardNumber: '',
          expiryDate: '',
          cvc: '',
          cardholderName: '',
          agreeToTerms: false
        }
      }, 2000)
    },
    addToWishlist() {
      alert('Course added to wishlist!')
    },
    getCourseIcon(category = null) {
      const cat = category || this.course.category
      const icons = {
        aws: 'fab fa-aws',
        azure: 'fab fa-microsoft',
        terraform: 'fas fa-code-branch',
        linux: 'fab fa-linux',
        jenkins: 'fas fa-cog',
        docker: 'fab fa-docker',
        kubernetes: 'fas fa-dharmachakra',
        ansible: 'fas fa-server',
        git: 'fab fa-git-alt',
        python: 'fab fa-python',
        devops: 'fas fa-infinity'
      }
      return icons[cat] || 'fas fa-graduation-cap'
    },
    getCourseGradient() {
      const gradients = {
        aws: 'background: linear-gradient(135deg, #FF9900 0%, #FF6600 100%)',
        azure: 'background: linear-gradient(135deg, #0078D4 0%, #005A9E 100%)',
        terraform: 'background: linear-gradient(135deg, #623CE4 0%, #4A29C8 100%)',
        linux: 'background: linear-gradient(135deg, #FCC624 0%, #E3B505 100%)',
        jenkins: 'background: linear-gradient(135deg, #D4E3F4 0%, #4A90E2 100%)',
        docker: 'background: linear-gradient(135deg, #2496ED 0%, #0DB7ED 100%)',
        kubernetes: 'background: linear-gradient(135deg, #326CE5 0%, #1A73E8 100%)',
        ansible: 'background: linear-gradient(135deg, #EE0000 0%, #CC0000 100%)',
        git: 'background: linear-gradient(135deg, #F05032 0%, #E44D26 100%)',
        python: 'background: linear-gradient(135deg, #3776AB 0%, #FFD43B 100%)',
        devops: 'background: linear-gradient(135deg, #047857 0%, #10b981 100%)'
      }
      return gradients[this.course.category] || 'background: linear-gradient(135deg, #047857 0%, #10b981 100%)'
    },
    getLevelClass() {
      const classes = {
        beginner: 'bg-green-500 text-white',
        intermediate: 'bg-yellow-500 text-white',
        advanced: 'bg-orange-500 text-white',
        expert: 'bg-red-500 text-white'
      }
      return classes[this.course.level] || classes.intermediate
    },
    getCategoryName(category) {
      const names = {
        aws: 'Amazon AWS',
        azure: 'Microsoft Azure',
        terraform: 'Terraform',
        linux: 'Linux',
        jenkins: 'Jenkins',
        docker: 'Docker',
        kubernetes: 'Kubernetes',
        ansible: 'Ansible',
        git: 'Git',
        python: 'Python',
        devops: 'DevOps'
      }
      return names[category] || category.toUpperCase()
    },
    formatNumber(num) {
      if (num >= 1000000) return (num / 1000000).toFixed(1) + 'M'
      if (num >= 1000) return (num / 1000).toFixed(1) + 'K'
      return num.toString()
    },
    getInstructorInitials() {
      return this.course.instructor.split(' ').map(n => n[0]).join('').slice(0, 2)
    },
    getInstructorBio() {
      const bios = {
        aws: `With over 10 years of experience in cloud computing and AWS architecture, our instructor has helped thousands of students achieve their AWS certifications. As a certified AWS Solutions Architect Professional, they bring real-world enterprise experience to every lesson.`,
        azure: `A Microsoft MVP and Azure architect with extensive experience in enterprise cloud solutions. Has designed and implemented large-scale Azure infrastructures for Fortune 500 companies and is passionate about sharing practical knowledge.`,
        terraform: `Infrastructure as Code expert with deep knowledge of Terraform across multiple cloud platforms. Has implemented Terraform solutions for companies ranging from startups to enterprise organizations.`,
        linux: `Linux system administrator and engineer with 15+ years of experience. Expert in enterprise Linux environments, automation, and container technologies.`,
        jenkins: `DevOps engineer specializing in CI/CD pipeline automation and Jenkins administration. Has implemented Jenkins solutions for high-scale development teams.`,
        docker: `Container technology expert and Docker Captain. Specializes in containerization strategies and orchestration for production environments.`,
        kubernetes: `Kubernetes administrator and CKA/CKAD certified instructor. Expert in container orchestration and cloud-native application deployment.`
      }
      return bios[this.course.category] || `Expert instructor with extensive experience in ${this.course.category.toUpperCase()} technologies and practical industry knowledge.`
    },
    getRequirements() {
      const requirements = {
        aws: ['Basic understanding of cloud computing concepts', 'Familiarity with basic networking', 'Access to an AWS account (free tier is sufficient)', 'Basic command line knowledge'],
        azure: ['Basic understanding of cloud computing', 'Familiarity with Windows or Linux', 'Access to Azure account (free tier available)', 'Basic PowerShell knowledge helpful'],
        terraform: ['Basic understanding of infrastructure concepts', 'Familiarity with at least one cloud platform', 'Basic command line experience', 'Understanding of version control (Git)'],
        linux: ['Basic computer skills', 'Access to a Linux system or virtual machine', 'Willingness to learn command line', 'No prior Linux experience required'],
        jenkins: ['Basic understanding of software development', 'Familiarity with version control systems', 'Basic command line knowledge', 'Understanding of build processes'],
        docker: ['Basic understanding of application development', 'Command line familiarity', 'Basic Linux knowledge helpful', 'Understanding of virtualization concepts'],
        kubernetes: ['Docker knowledge required', 'Basic Linux command line skills', 'Understanding of container concepts', 'Familiarity with YAML format']
      }
      return requirements[this.course.category] || ['Basic computer skills', 'Eagerness to learn', 'No prior experience required']
    },
    getTargetAudience() {
      const audiences = {
        aws: ['Developers wanting to learn cloud computing', 'System administrators moving to cloud', 'IT professionals seeking AWS certification', 'Students starting cloud career'],
        azure: ['IT professionals learning Microsoft cloud', 'Developers working with Azure', 'System administrators', 'Students pursuing Azure certifications'],
        terraform: ['DevOps engineers', 'Infrastructure engineers', 'Cloud architects', 'Developers working with infrastructure'],
        linux: ['IT beginners', 'Windows administrators learning Linux', 'Students pursuing IT careers', 'Developers needing Linux skills'],
        jenkins: ['Software developers', 'DevOps engineers', 'Build engineers', 'QA engineers working with CI/CD'],
        docker: ['Software developers', 'DevOps engineers', 'System administrators', 'Anyone interested in containerization'],
        kubernetes: ['DevOps engineers', 'Container specialists', 'Cloud engineers', 'Platform engineers']
      }
      return audiences[this.course.category] || ['IT professionals', 'Developers', 'Students', 'Career changers']
    },
    getCurriculum() {
      const curricula = {
        aws: [
          {
            title: 'Introduction to AWS Cloud',
            lessons: 8,
            duration: 3,
            content: ['What is Cloud Computing?', 'AWS Global Infrastructure', 'AWS Free Tier Overview', 'Creating Your AWS Account', 'AWS Console Navigation', 'AWS CLI Setup', 'Basic Security Best Practices', 'Cost Management Basics']
          },
          {
            title: 'Compute Services',
            lessons: 15,
            duration: 8,
            content: ['EC2 Fundamentals', 'Instance Types and Pricing', 'Security Groups', 'Key Pairs', 'EBS Volumes', 'AMIs', 'Load Balancers', 'Auto Scaling Groups', 'Lambda Functions', 'Elastic Beanstalk']
          },
          {
            title: 'Storage and Databases',
            lessons: 12,
            duration: 6,
            content: ['S3 Bucket Management', 'S3 Storage Classes', 'RDS Setup and Management', 'DynamoDB Basics', 'ElastiCache', 'Redshift Overview']
          },
          {
            title: 'Networking and Security',
            lessons: 10,
            duration: 5,
            content: ['VPC Creation', 'Subnets and Route Tables', 'Internet Gateways', 'NAT Gateways', 'IAM Users and Roles', 'Policies and Permissions']
          }
        ],
        terraform: [
          {
            title: 'Terraform Fundamentals',
            lessons: 10,
            duration: 4,
            content: ['Infrastructure as Code Concepts', 'Terraform Installation', 'HCL Syntax', 'Providers and Resources', 'Variables and Outputs', 'State Management']
          },
          {
            title: 'Advanced Terraform',
            lessons: 12,
            duration: 6,
            content: ['Modules Creation', 'Remote State', 'Workspaces', 'Terraform Cloud', 'Policy as Code', 'Best Practices']
          }
        ]
      }
      return curricula[this.course.category] || [
        {
          title: 'Course Introduction',
          lessons: 5,
          duration: 2,
          content: ['Course Overview', 'Prerequisites', 'Setting up Environment', 'Basic Concepts', 'Getting Started']
        },
        {
          title: 'Core Concepts',
          lessons: 10,
          duration: 5,
          content: ['Fundamental Principles', 'Best Practices', 'Common Patterns', 'Hands-on Exercises', 'Real-world Examples']
        }
      ]
    },
    getCourseReviews() {
      return [
        {
          id: 1,
          name: 'Alex Johnson',
          initials: 'AJ',
          role: 'DevOps Engineer',
          rating: 5,
          title: 'Excellent course content!',
          content: 'This course provided exactly what I needed to advance my career. The instructor explains complex concepts clearly and the hands-on labs were very practical.',
          timeAgo: '2 weeks ago',
          helpful: 45
        },
        {
          id: 2,
          name: 'Maria Garcia',
          initials: 'MG',
          role: 'Cloud Architect',
          rating: 5,
          title: 'Highly recommended',
          content: 'Great course structure and comprehensive coverage. The practical examples helped me understand how to apply these concepts in real-world scenarios.',
          timeAgo: '1 month ago',
          helpful: 32
        },
        {
          id: 3,
          name: 'David Chen',
          initials: 'DC',
          role: 'Software Developer',
          rating: 4,
          title: 'Good content, could use more examples',
          content: 'Overall good course with solid fundamentals. Would benefit from a few more practical examples in some sections.',
          timeAgo: '3 weeks ago',
          helpful: 28
        }
      ]
    },
    getFAQs() {
      return [
        {
          question: 'How long do I have access to the course?',
          answer: 'You have lifetime access to all course materials, including any future updates to the content.'
        },
        {
          question: 'Are there any prerequisites for this course?',
          answer: 'The specific prerequisites are listed in the course overview. Generally, basic computer skills and eagerness to learn are sufficient for most courses.'
        },
        {
          question: 'Do I get a certificate upon completion?',
          answer: `${this.course.certificate ? 'Yes, you will receive a certificate of completion that you can add to your LinkedIn profile and resume.' : 'This course does not include a certificate of completion.'}`
        },
        {
          question: 'Can I get a refund if I\'m not satisfied?',
          answer: 'Yes, we offer a 30-day money-back guarantee. If you\'re not satisfied with the course, you can request a full refund within 30 days of purchase.'
        },
        {
          question: 'Is this course updated regularly?',
          answer: 'Yes, we regularly update our courses to reflect the latest industry practices and tool versions. All updates are included in your lifetime access.'
        }
      ]
    }
  },
  mounted() {
    // Close modal on escape key
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        this.closeEnrollmentModal()
      }
    })
  }
}
</script>

<style scoped>
.gradient-btn {
  background: linear-gradient(135deg, #047857 0%, #10b981 100%);
}

.course-gradient {
  background: linear-gradient(135deg, #047857 0%, #10b981 100%);
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

.sticky-sidebar {
  position: sticky;
  top: 20px;
}

.tab-btn {
  border-bottom: 2px solid transparent;
  transition: all 0.3s ease;
}

.tab-btn.active {
  border-bottom-color: #047857;
  color: #047857;
}

.dark .tab-btn.active {
  border-bottom-color: #10b981;
  color: #10b981;
}

.accordion-content {
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.3s ease;
}

.accordion-content.active {
  max-height: 500px;
}

.review-card {
  transition: transform 0.3s ease;
}

.review-card:hover {
  transform: translateY(-2px);
}
</style>