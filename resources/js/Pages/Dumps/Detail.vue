<template>
  <div class="bg-gray-50 dark:bg-gray-900 text-gray-700 dark:text-gray-300 transition-colors duration-200">
    <Head>
      <title>{{ exam.title }} ({{ exam.code }}) - Exam Dump Details</title>
      <meta name="description" :content="`${exam.description} - Comprehensive exam dump with ${exam.questions} questions.`">
    </Head>

    <!-- Header -->
    <DevOpsHeader />

    <!-- Breadcrumb -->
    <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <div class="flex items-center text-sm text-gray-500">
                <Link href="/" class="hover:text-primary-600 dark:hover:text-primary-400">Home</Link>
                <i class="fas fa-chevron-right mx-2 text-xs"></i>
                <Link href="/dumps" class="hover:text-primary-600 dark:hover:text-primary-400">Exam Dumps</Link>
                <i class="fas fa-chevron-right mx-2 text-xs"></i>
                <Link href="/dumps" class="hover:text-primary-600 dark:hover:text-primary-400">{{ getProviderName(exam.provider) }}</Link>
                <i class="fas fa-chevron-right mx-2 text-xs"></i>
                <span class="text-gray-700 dark:text-gray-300">{{ exam.code }}</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="grid lg:grid-cols-3 gap-8">

            <!-- Main Column -->
            <div class="lg:col-span-2">

                <!-- Exam Header -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden mb-8">
                    <div class="gradient-bg p-8">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center">
                                <div class="w-16 h-16 bg-white rounded-lg flex items-center justify-center mr-4 shadow-md">
                                    <i :class="getProviderIcon(exam.provider)" class="text-3xl"></i>
                                </div>
                                <div>
                                    <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-1">{{ exam.code }}</h1>
                                    <p class="text-lg text-gray-600 dark:text-gray-300">{{ exam.title }}</p>
                                </div>
                            </div>
                            <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                Updated {{ formatDate(exam.lastUpdated) }}
                            </span>
                        </div>

                        <p class="text-gray-700 dark:text-gray-300 mb-6">
                            {{ exam.description }} This certification validates your expertise and is one of the most sought-after credentials in cloud computing.
                        </p>

                        <!-- Quick Stats -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="bg-white dark:bg-gray-700 rounded-lg p-3 text-center">
                                <div class="text-2xl font-bold gradient-text">{{ exam.questions }}</div>
                                <div class="text-xs text-gray-600 dark:text-gray-300">Questions</div>
                            </div>
                            <div class="bg-white dark:bg-gray-700 rounded-lg p-3 text-center">
                                <div class="text-2xl font-bold gradient-text">{{ exam.successRate }}%</div>
                                <div class="text-xs text-gray-600 dark:text-gray-300">Success Rate</div>
                            </div>
                            <div class="bg-white dark:bg-gray-700 rounded-lg p-3 text-center">
                                <div class="text-2xl font-bold gradient-text">{{ exam.duration }}</div>
                                <div class="text-xs text-gray-600 dark:text-gray-300">Minutes</div>
                            </div>
                            <div class="bg-white dark:bg-gray-700 rounded-lg p-3 text-center">
                                <div class="text-2xl font-bold gradient-text">{{ exam.passingScore }}</div>
                                <div class="text-xs text-gray-600 dark:text-gray-300">Passing Score</div>
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
                                :class="{ 'active': activeTab === 'content' }"
                                @click="switchTab('content')"
                            >
                                Exam Content
                            </button>
                            <button
                                class="tab-btn px-6 py-4 font-medium whitespace-nowrap"
                                :class="{ 'active': activeTab === 'samples' }"
                                @click="switchTab('samples')"
                            >
                                Sample Questions
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
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Exam Overview</h2>

                        <div class="space-y-6">
                            <div>
                                <h3 class="font-semibold text-gray-800 dark:text-white mb-2">Description</h3>
                                <p class="text-gray-600 dark:text-gray-300">
                                    {{ exam.description }} This examination is intended for individuals who perform a {{ getDifficultyRole(exam.difficulty) }} role and have experience with {{ getProviderName(exam.provider) }} cloud services.
                                </p>
                            </div>

                            <div>
                                <h3 class="font-semibold text-gray-800 dark:text-white mb-2">Target Audience</h3>
                                <ul class="list-disc list-inside text-gray-600 dark:text-gray-300 space-y-1">
                                    <li v-for="audience in getTargetAudience(exam.provider)" :key="audience">{{ audience }}</li>
                                </ul>
                            </div>

                            <div>
                                <h3 class="font-semibold text-gray-800 dark:text-white mb-2">Prerequisites</h3>
                                <ul class="list-disc list-inside text-gray-600 dark:text-gray-300 space-y-1">
                                    <li v-for="prerequisite in exam.prerequisites" :key="prerequisite">{{ prerequisite }}</li>
                                </ul>
                            </div>

                            <div>
                                <h3 class="font-semibold text-gray-800 dark:text-white mb-2">What You'll Learn</h3>
                                <div class="grid md:grid-cols-2 gap-3">
                                    <div v-for="topic in exam.topics" :key="topic" class="flex items-start">
                                        <i class="fas fa-check text-primary-600 mt-1 mr-2"></i>
                                        <span class="text-gray-600 dark:text-gray-300">{{ topic }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                                <div class="flex items-start">
                                    <i class="fas fa-info-circle text-blue-600 dark:text-blue-400 mt-1 mr-3"></i>
                                    <div>
                                        <h4 class="font-semibold text-blue-900 dark:text-blue-200 mb-1">Exam Format</h4>
                                        <p class="text-blue-800 dark:text-blue-300 text-sm">
                                            Multiple choice and multiple response questions. You have {{ exam.duration }} minutes to complete {{ exam.questions }} questions. The exam is available in multiple languages.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Content: Exam Content -->
                    <div v-show="activeTab === 'content'" class="tab-content p-6">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Exam Content Breakdown</h2>

                        <div class="space-y-4">
                            <div v-for="(topic, index) in exam.topics" :key="topic" class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                                <button
                                    class="accordion-btn w-full flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600"
                                    @click="toggleAccordion(index)"
                                >
                                    <div class="flex items-center">
                                        <span class="font-semibold text-gray-800 dark:text-white">Domain {{ index + 1 }}: {{ topic }}</span>
                                        <span class="ml-3 text-sm text-gray-500 dark:text-gray-400">({{ Math.floor(100 / exam.topics.length) }}% of exam)</span>
                                    </div>
                                    <i class="fas fa-chevron-down text-gray-500 dark:text-gray-400" :class="{ 'fa-chevron-up': openAccordions.includes(index) }"></i>
                                </button>
                                <div class="accordion-content p-4" :class="{ 'active': openAccordions.includes(index) }">
                                    <ul class="space-y-2 text-gray-600 dark:text-gray-300">
                                        <li class="flex items-start">
                                            <i class="fas fa-circle text-primary-600 text-xs mt-1.5 mr-2"></i>
                                            <span>Understand core concepts and services related to {{ topic }}</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i class="fas fa-circle text-primary-600 text-xs mt-1.5 mr-2"></i>
                                            <span>Implement best practices for {{ topic.toLowerCase() }}</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i class="fas fa-circle text-primary-600 text-xs mt-1.5 mr-2"></i>
                                            <span>Design solutions using {{ topic.toLowerCase() }} principles</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i class="fas fa-circle text-primary-600 text-xs mt-1.5 mr-2"></i>
                                            <span>Troubleshoot and optimize {{ topic.toLowerCase() }} implementations</span>
                                        </li>
                                    </ul>
                                    <div class="mt-3 pt-3 border-t border-gray-200 dark:border-gray-600">
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-600 dark:text-gray-300">Coverage</span>
                                            <span class="font-semibold text-gray-800 dark:text-white">{{ Math.floor(100 / exam.topics.length) }}%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-2 mt-2">
                                            <div class="bg-primary-600 dark:bg-primary-500 h-2 rounded-full" :style="`width: ${Math.floor(100 / exam.topics.length)}%`"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Content: Sample Questions -->
                    <div v-show="activeTab === 'samples'" class="tab-content p-6">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Sample Questions</h2>

                        <div class="space-y-6">
                            <!-- Sample Questions -->
                            <div v-for="(question, index) in sampleQuestions" :key="index" class="border border-gray-200 dark:border-gray-700 rounded-lg p-5">
                                <div class="flex items-start mb-3">
                                    <span class="bg-primary-100 dark:bg-primary-900 text-primary-700 dark:text-primary-300 px-3 py-1 rounded-full text-sm font-medium mr-3">Question {{ index + 1 }}</span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ question.topic }}</span>
                                </div>
                                <p class="text-gray-800 dark:text-gray-200 mb-4">{{ question.question }}</p>
                                <div class="space-y-2">
                                    <label
                                        v-for="(option, optionIndex) in question.options"
                                        :key="optionIndex"
                                        class="flex items-start p-3 border rounded hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer"
                                        :class="optionIndex === question.correctAnswer ? 'border-primary-200 dark:border-primary-600 bg-green-50 dark:bg-green-900/20' : 'border-gray-200 dark:border-gray-600'"
                                    >
                                        <input type="radio" :name="`q${index}`" class="mt-1 mr-3">
                                        <div>
                                            <span class="text-gray-700 dark:text-gray-300">{{ option }}</span>
                                            <div v-if="optionIndex === question.correctAnswer" class="mt-2 text-sm text-green-700 dark:text-green-400 flex items-start">
                                                <i class="fas fa-check-circle mt-0.5 mr-2"></i>
                                                <span>Correct Answer</span>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="mt-4 p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded">
                                    <h4 class="font-semibold text-blue-900 dark:text-blue-200 mb-2">Explanation:</h4>
                                    <p class="text-sm text-blue-800 dark:text-blue-300">{{ question.explanation }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 p-4 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg">
                            <div class="flex items-start">
                                <i class="fas fa-lightbulb text-yellow-600 dark:text-yellow-400 mt-1 mr-3"></i>
                                <div>
                                    <h4 class="font-semibold text-yellow-900 dark:text-yellow-200 mb-1">Full Question Bank Available</h4>
                                    <p class="text-sm text-yellow-800 dark:text-yellow-300">Download the complete exam dump to access all {{ exam.questions }} questions with detailed explanations and references.</p>
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
                                    <div class="text-5xl font-bold gradient-text mb-2">4.8</div>
                                    <div class="flex justify-center mb-2">
                                        <i class="fas fa-star text-yellow-400"></i>
                                        <i class="fas fa-star text-yellow-400"></i>
                                        <i class="fas fa-star text-yellow-400"></i>
                                        <i class="fas fa-star text-yellow-400"></i>
                                        <i class="fas fa-star-half-alt text-yellow-400"></i>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-300">Based on {{ Math.floor(exam.popularity * 23) }} reviews</p>
                                </div>
                                <div class="space-y-2">
                                    <div class="flex items-center">
                                        <span class="text-sm text-gray-600 dark:text-gray-300 w-12">5 star</span>
                                        <div class="flex-1 mx-3">
                                            <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-2">
                                                <div class="bg-yellow-400 h-2 rounded-full" style="width: 75%"></div>
                                            </div>
                                        </div>
                                        <span class="text-sm text-gray-600 dark:text-gray-300 w-12 text-right">75%</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-sm text-gray-600 w-12">4 star</span>
                                        <div class="flex-1 mx-3">
                                            <div class="w-full bg-gray-200 rounded-full h-2">
                                                <div class="bg-yellow-400 h-2 rounded-full" style="width: 18%"></div>
                                            </div>
                                        </div>
                                        <span class="text-sm text-gray-600 w-12 text-right">18%</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-sm text-gray-600 w-12">3 star</span>
                                        <div class="flex-1 mx-3">
                                            <div class="w-full bg-gray-200 rounded-full h-2">
                                                <div class="bg-yellow-400 h-2 rounded-full" style="width: 5%"></div>
                                            </div>
                                        </div>
                                        <span class="text-sm text-gray-600 w-12 text-right">5%</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-sm text-gray-600 w-12">2 star</span>
                                        <div class="flex-1 mx-3">
                                            <div class="w-full bg-gray-200 rounded-full h-2">
                                                <div class="bg-yellow-400 h-2 rounded-full" style="width: 1%"></div>
                                            </div>
                                        </div>
                                        <span class="text-sm text-gray-600 w-12 text-right">1%</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-sm text-gray-600 w-12">1 star</span>
                                        <div class="flex-1 mx-3">
                                            <div class="w-full bg-gray-200 rounded-full h-2">
                                                <div class="bg-yellow-400 h-2 rounded-full" style="width: 1%"></div>
                                            </div>
                                        </div>
                                        <span class="text-sm text-gray-600 w-12 text-right">1%</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Individual Reviews -->
                        <div class="space-y-4">
                            <div v-for="review in reviews" :key="review.id" class="review-card border border-gray-200 dark:border-gray-700 rounded-lg p-5">
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
                                    <i v-for="star in 5" :key="star" :class="star <= review.rating ? 'fas fa-star text-yellow-400' : 'far fa-star text-gray-300'" class="text-sm"></i>
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
                            <div v-for="(faq, index) in faqs" :key="index" class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
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

                <!-- Related Certifications -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Related Certifications</h2>
                    <div class="space-y-3">
                        <Link
                            v-for="related in relatedExams"
                            :key="related.id"
                            :href="`/dumps/${related.id}`"
                            class="flex items-center p-3 border border-gray-200 dark:border-gray-700 rounded-lg hover:border-primary-500 dark:hover:border-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-colors"
                        >
                            <i :class="getProviderIcon(related.provider)" class="text-2xl mr-3"></i>
                            <div>
                                <h4 class="font-semibold text-gray-800 dark:text-white">{{ related.title }}</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ related.description }}</p>
                            </div>
                            <i class="fas fa-arrow-right ml-auto text-gray-400 dark:text-gray-500"></i>
                        </Link>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="sticky-sidebar space-y-6">

                    <!-- Purchase Card -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden border-2 border-primary-200 dark:border-primary-600">
                        <div class="gradient-bg p-4">
                            <h3 class="text-xl font-bold text-gray-800 dark:text-white">Get This Exam Dump</h3>
                        </div>
                        <div class="p-6">
                            <div class="mb-6">
                                <div class="flex items-baseline mb-2">
                                    <span class="text-4xl font-bold gradient-text">${{ exam.price }}</span>
                                    <span class="text-gray-500 line-through ml-2">${{ Math.floor(exam.price * 2) }}</span>
                                    <span class="bg-red-500 text-white text-xs px-2 py-1 rounded ml-2">50% OFF</span>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Limited time offer - Price increases soon!</p>
                            </div>

                            <div class="space-y-3 mb-6">
                                <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                    <i class="fas fa-check-circle text-primary-600 dark:text-primary-400 mr-2"></i>
                                    <span>{{ exam.questions }} Practice Questions</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                    <i class="fas fa-check-circle text-primary-600 dark:text-primary-400 mr-2"></i>
                                    <span>Detailed Explanations</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                    <i class="fas fa-check-circle text-primary-600 dark:text-primary-400 mr-2"></i>
                                    <span>PDF + Online Access</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                    <i class="fas fa-check-circle text-primary-600 dark:text-primary-400 mr-2"></i>
                                    <span>Free Updates for 1 Year</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                    <i class="fas fa-check-circle text-primary-600 dark:text-primary-400 mr-2"></i>
                                    <span>Mobile App Access</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                    <i class="fas fa-check-circle text-primary-600 dark:text-primary-400 mr-2"></i>
                                    <span>Pass Guarantee</span>
                                </div>
                            </div>

                            <button @click="openPurchaseModal" class="w-full gradient-btn text-white py-3 rounded-lg font-semibold hover:opacity-90 transition-opacity mb-3">
                                <i class="fas fa-shopping-cart mr-2"></i>Buy Now
                            </button>
                            <button @click="downloadSample" class="w-full border-2 border-primary-600 dark:border-primary-400 text-primary-600 dark:text-primary-400 py-3 rounded-lg font-semibold hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-colors">
                                <i class="fas fa-file-pdf mr-2"></i>Download Free Sample
                            </button>

                            <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                                <div class="flex items-center justify-center text-sm text-gray-600 dark:text-gray-300">
                                    <i class="fas fa-shield-alt text-primary-600 dark:text-primary-400 mr-2"></i>
                                    <span>Secure Checkout - 256-bit SSL</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Study Progress Tracker -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
                        <h3 class="font-bold text-gray-800 dark:text-white mb-4">Study Progress</h3>
                        <div class="space-y-4">
                            <div class="progress-step flex items-center completed">
                                <div class="w-8 h-8 gradient-btn rounded-full flex items-center justify-center text-white mr-3 flex-shrink-0">
                                    <i class="fas fa-check text-sm"></i>
                                </div>
                                <span class="text-sm text-gray-700 dark:text-gray-300">Download Materials</span>
                            </div>
                            <div class="progress-step flex items-center">
                                <div class="w-8 h-8 bg-gray-200 dark:bg-gray-600 rounded-full flex items-center justify-center text-gray-500 dark:text-gray-400 mr-3 flex-shrink-0">
                                    2
                                </div>
                                <span class="text-sm text-gray-700 dark:text-gray-300">Study All Domains</span>
                            </div>
                            <div class="progress-step flex items-center">
                                <div class="w-8 h-8 bg-gray-200 dark:bg-gray-600 rounded-full flex items-center justify-center text-gray-500 dark:text-gray-400 mr-3 flex-shrink-0">
                                    3
                                </div>
                                <span class="text-sm text-gray-700 dark:text-gray-300">Practice Tests</span>
                            </div>
                            <div class="progress-step flex items-center">
                                <div class="w-8 h-8 bg-gray-200 dark:bg-gray-600 rounded-full flex items-center justify-center text-gray-500 dark:text-gray-400 mr-3 flex-shrink-0">
                                    4
                                </div>
                                <span class="text-sm text-gray-700 dark:text-gray-300">Schedule Exam</span>
                            </div>
                        </div>
                    </div>

                    <!-- Need Help -->
                    <div class="bg-gradient-to-br from-primary-50 to-blue-50 dark:from-primary-900/20 dark:to-blue-900/20 rounded-xl p-6">
                        <h3 class="font-bold text-gray-800 dark:text-white mb-2">Need Help?</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">Our experts are here to assist you with your preparation journey.</p>
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
                                <i class="fas fa-book mr-2"></i>
                                Study Guide
                            </a>
                        </div>
                    </div>

                    <!-- Trust Badges -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
                        <div class="space-y-4 text-center">
                            <div>
                                <i class="fas fa-users text-3xl text-primary-600 dark:text-primary-400 mb-2"></i>
                                <p class="text-sm font-semibold text-gray-800 dark:text-white">50,000+ Students</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Successfully Certified</p>
                            </div>
                            <div>
                                <i class="fas fa-award text-3xl text-primary-600 dark:text-primary-400 mb-2"></i>
                                <p class="text-sm font-semibold text-gray-800 dark:text-white">{{ exam.successRate }}% Pass Rate</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">First Attempt Success</p>
                            </div>
                            <div>
                                <i class="fas fa-clock text-3xl text-primary-600 dark:text-primary-400 mb-2"></i>
                                <p class="text-sm font-semibold text-gray-800 dark:text-white">24/7 Support</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Always Here to Help</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Purchase Modal -->
    <div v-show="showPurchaseModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-md">
            <div class="gradient-bg p-6 rounded-t-2xl">
                <div class="flex justify-between items-center">
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white">Complete Your Purchase</h3>
                    <button @click="closePurchaseModal" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            <div class="p-6">
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-gray-700 dark:text-gray-300">{{ exam.code }} Exam Dump</span>
                        <span class="font-bold text-gray-800 dark:text-white">${{ exam.price }}.00</span>
                    </div>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-gray-700 dark:text-gray-300">Discount (50%)</span>
                        <span class="font-bold text-green-600 dark:text-green-400">-${{ exam.price }}.00</span>
                    </div>
                    <div class="border-t border-gray-200 dark:border-gray-600 pt-4 flex justify-between items-center">
                        <span class="text-lg font-bold text-gray-800 dark:text-white">Total</span>
                        <span class="text-2xl font-bold gradient-text">${{ exam.price }}.00</span>
                    </div>
                </div>

                <form @submit.prevent="processPurchase" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email Address</label>
                        <input v-model="purchaseForm.email" type="email" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:border-primary-500 dark:focus:border-primary-400" placeholder="your@email.com">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Card Information</label>
                        <input v-model="purchaseForm.cardNumber" type="text" placeholder="1234 5678 9012 3456" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:border-primary-500 dark:focus:border-primary-400 mb-2">
                        <div class="grid grid-cols-2 gap-2">
                            <input v-model="purchaseForm.expiryDate" type="text" placeholder="MM/YY" class="px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:border-primary-500 dark:focus:border-primary-400">
                            <input v-model="purchaseForm.cvc" type="text" placeholder="CVC" class="px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:border-primary-500 dark:focus:border-primary-400">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Cardholder Name</label>
                        <input v-model="purchaseForm.cardholderName" type="text" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:border-primary-500 dark:focus:border-primary-400" placeholder="John Doe">
                    </div>

                    <div>
                        <label class="flex items-start">
                            <input v-model="purchaseForm.agreeToTerms" type="checkbox" required class="mt-1 mr-2">
                            <span class="text-sm text-gray-600 dark:text-gray-300">
                                I agree to the <a href="#" class="text-primary-600 dark:text-primary-400 hover:underline">Terms of Service</a> and <a href="#" class="text-primary-600 dark:text-primary-400 hover:underline">Privacy Policy</a>
                            </span>
                        </label>
                    </div>

                    <button type="submit" :disabled="processing" class="w-full gradient-btn text-white py-3 rounded-lg font-semibold hover:opacity-90 transition-opacity">
                        <i v-if="processing" class="fas fa-spinner fa-spin mr-2"></i>
                        <i v-else class="fas fa-lock mr-2"></i>
                        {{ processing ? 'Processing...' : 'Complete Secure Payment' }}
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
  name: 'DumpDetailPage',
  components: {
    Head,
    Link,
    DevOpsHeader,
    DevOpsFooter
  },
  props: {
    exam: {
      type: Object,
      required: true
    },
    relatedExams: {
      type: Array,
      default: () => []
    }
  },
  data() {
    return {
      activeTab: 'overview',
      openAccordions: [],
      openFaqs: [],
      showPurchaseModal: false,
      processing: false,
      purchaseForm: {
        email: '',
        cardNumber: '',
        expiryDate: '',
        cvc: '',
        cardholderName: '',
        agreeToTerms: false
      },
      sampleQuestions: [
        {
          question: "A company is hosting a web application on AWS using a single Amazon EC2 instance that stores user-uploaded documents in an Amazon EBS volume. For better scalability and availability, the company duplicated the architecture and created a second EC2 instance and EBS volume in another Availability Zone, placing both behind an Application Load Balancer. After completing this change, users reported that, each time they refreshed the website, they could see one subset of their documents or the other, but never all of the documents at the same time. What should a solutions architect propose to ensure users see all of their documents at once?",
          topic: "Resilient Architectures",
          options: [
            "Copy the data so both EBS volumes contain all the documents",
            "Configure the Application Load Balancer to direct a user to the server with the documents",
            "Copy the data from both EBS volumes to Amazon EFS. Modify the application to save new documents to Amazon EFS",
            "Configure the Application Load Balancer to send the request to both servers. Return each document from the correct server"
          ],
          correctAnswer: 2,
          explanation: "Amazon EFS provides shared file storage for use with Amazon EC2 instances. By storing the documents in EFS instead of EBS, both EC2 instances can access all documents simultaneously, ensuring users see their complete set of documents regardless of which instance handles their request."
        },
        {
          question: "A company wants to migrate a MySQL database to AWS. The database requires frequent writes to the database but reads can tolerate eventual consistency. Which storage solution should a solutions architect recommend?",
          topic: "High-Performance Architectures",
          options: [
            "Amazon RDS for MySQL with read replicas",
            "Amazon RDS for MySQL with Multi-AZ deployment",
            "Amazon Aurora MySQL with read replicas",
            "Amazon DynamoDB with global tables"
          ],
          correctAnswer: 2,
          explanation: "Amazon Aurora MySQL provides better write performance than standard RDS MySQL while supporting read replicas for eventual consistency reads. Aurora is designed for high-performance database workloads and offers up to 5x the throughput of standard MySQL."
        }
      ],
      reviews: [
        {
          id: 1,
          name: "Michael Roberts",
          initials: "MR",
          role: "Cloud Engineer at Tech Corp",
          rating: 5,
          title: "Excellent preparation material!",
          content: "I passed my exam on the first attempt with a high score! These dumps were incredibly helpful - the questions were very similar to what I encountered in the actual exam. The explanations helped me understand the concepts deeply rather than just memorizing answers.",
          timeAgo: "2 days ago",
          helpful: 24
        },
        {
          id: 2,
          name: "Sarah Lee",
          initials: "SL",
          role: "Solutions Architect",
          rating: 5,
          title: "Worth every penny",
          content: "The quality of questions is outstanding. Each question comes with detailed explanations and links to documentation. I particularly appreciated the scenario-based questions that helped me think like an architect. Highly recommended!",
          timeAgo: "1 week ago",
          helpful: 18
        },
        {
          id: 3,
          name: "James Chen",
          initials: "JC",
          role: "DevOps Engineer",
          rating: 4,
          title: "Good but could be better organized",
          content: "The content is great and helped me pass the exam, but I wish the questions were better organized by topic. Sometimes it was hard to focus on specific areas I was weak in. Overall, still a solid resource for exam preparation.",
          timeAgo: "2 weeks ago",
          helpful: 12
        }
      ],
      faqs: [
        {
          question: "How often are the exam dumps updated?",
          answer: "Our exam dumps are updated monthly to reflect the latest exam changes. We have a dedicated team that monitors certification updates and incorporates new question patterns immediately."
        },
        {
          question: "Are these real exam questions?",
          answer: "Our questions are based on real exam patterns and scenarios reported by certified professionals. While we cannot provide actual exam questions (which would violate policies), our questions closely mirror the style, difficulty, and topics you'll encounter in the real exam."
        },
        {
          question: "What format do the exam dumps come in?",
          answer: "You'll receive the exam dumps in multiple formats: PDF for offline study, an online practice test simulator for exam-like conditions, and a mobile app for studying on-the-go. All formats include detailed explanations and reference links."
        },
        {
          question: "Do you offer a money-back guarantee?",
          answer: "Yes! We offer a 100% pass guarantee. If you don't pass the exam after studying our materials, we'll refund your purchase or provide free access to updated materials. Terms and conditions apply - you must score at least 60% on our practice tests before attempting the real exam."
        },
        {
          question: "How long do I have access to the materials?",
          answer: "You get lifetime access to all materials, including free updates for one year. Even after the update period expires, you retain access to the version you purchased. We also provide email support for 90 days after purchase."
        },
        {
          question: "Can I share these materials with others?",
          answer: "No, the materials are for individual use only and are protected by copyright. Sharing or distributing the materials violates our terms of service and may result in account termination. We offer team discounts for corporate training needs."
        }
      ]
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
    openPurchaseModal() {
      this.showPurchaseModal = true
      document.body.style.overflow = 'hidden'
    },
    closePurchaseModal() {
      this.showPurchaseModal = false
      document.body.style.overflow = ''
    },
    processPurchase() {
      this.processing = true

      // Simulate payment processing
      setTimeout(() => {
        this.processing = false
        this.closePurchaseModal()
        alert('Payment successful! Check your email for download instructions.')

        // Reset form
        this.purchaseForm = {
          email: '',
          cardNumber: '',
          expiryDate: '',
          cvc: '',
          cardholderName: '',
          agreeToTerms: false
        }
      }, 2000)
    },
    downloadSample() {
      // Implement sample download
      alert('Sample download started!')
    },
    getProviderIcon(provider) {
      const icons = {
        aws: 'fab fa-aws text-orange-500',
        azure: 'fab fa-microsoft text-blue-500',
        gcp: 'fab fa-google text-red-500',
        kubernetes: 'fas fa-dharmachakra text-blue-600',
        docker: 'fab fa-docker text-blue-400'
      }
      return icons[provider] || 'fas fa-certificate text-gray-500'
    },
    getProviderName(provider) {
      const names = {
        aws: 'Amazon AWS',
        azure: 'Microsoft Azure',
        gcp: 'Google Cloud',
        kubernetes: 'Kubernetes',
        docker: 'Docker'
      }
      return names[provider] || provider.toUpperCase()
    },
    getDifficultyRole(difficulty) {
      const roles = {
        beginner: 'entry-level professional',
        intermediate: 'associate-level professional',
        expert: 'professional-level expert'
      }
      return roles[difficulty] || 'professional'
    },
    getTargetAudience(provider) {
      const audiences = {
        aws: ['Solutions Architects', 'Cloud Engineers', 'DevOps Engineers', 'System Administrators transitioning to cloud'],
        azure: ['Azure Administrators', 'Cloud Developers', 'DevOps Engineers', 'IT Professionals'],
        gcp: ['Cloud Engineers', 'Data Engineers', 'DevOps Engineers', 'System Administrators'],
        kubernetes: ['DevOps Engineers', 'Container Specialists', 'Platform Engineers', 'Site Reliability Engineers'],
        docker: ['DevOps Engineers', 'Software Developers', 'System Administrators', 'Container Specialists']
      }
      return audiences[provider] || ['IT Professionals', 'Cloud Engineers', 'DevOps Engineers']
    },
    formatDate(dateString) {
      const date = new Date(dateString)
      return date.toLocaleDateString('en-US', { year: 'numeric', month: 'short' })
    }
  },
  mounted() {
    // Close modal on escape key
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        this.closePurchaseModal()
      }
    })
  }
}
</script>

<style scoped>
html {
  overflow-x: hidden;
}

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

.progress-step {
  position: relative;
}

.progress-step::after {
  content: '';
  position: absolute;
  top: 50%;
  left: 100%;
  width: 100%;
  height: 2px;
  background: #e5e7eb;
  z-index: -1;
}

.dark .progress-step::after {
  background: #374151;
}

.progress-step:last-child::after {
  display: none;
}

.progress-step.completed::after {
  background: #10b981;
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