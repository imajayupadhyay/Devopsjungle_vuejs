<template>
  <div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-200">
    <Head>
      <title>{{ isEditing ? 'Edit Course' : 'Create Course' }} - DevOps Jungle Admin</title>
    </Head>

    <!-- Sidebar -->
    <Sidebar
      :userName="$page.props.auth?.user?.name || 'Admin'"
      :userAvatar="$page.props.auth?.user?.avatar_url || 'https://ui-avatars.com/api/?name=Admin&background=047857&color=fff'"
      @toggle="handleSidebarToggle"
    />

    <!-- Topbar -->
    <Topbar
      :sidebarCollapsed="sidebarCollapsed"
      :userName="$page.props.auth?.user?.name || 'Admin'"
      :userEmail="$page.props.auth?.user?.email || 'admin@example.com'"
      :userAvatar="$page.props.auth?.user?.avatar_url || 'https://ui-avatars.com/api/?name=Admin&background=047857&color=fff'"
      :isDark="isDark"
      @toggle-theme="toggleTheme"
    />

    <!-- Main Content -->
    <main
      :class="[
        'pt-16 transition-all duration-300 min-h-screen',
        sidebarCollapsed ? 'ml-20' : 'ml-64'
      ]"
    >
      <div class="p-6">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
          <div>
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">
              {{ isEditing ? 'Edit Course' : 'Create New Course' }}
            </h1>
            <p class="text-gray-600 dark:text-gray-400">
              {{ isEditing ? 'Update course information and settings' : 'Create a new DevOps course' }}
            </p>
          </div>
          <Link
            :href="route('admin.courses.index')"
            class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors"
          >
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Courses
          </Link>
        </div>

        <form @submit.prevent="submit" class="space-y-6">
          <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content Column -->
            <div class="lg:col-span-2 space-y-6">
              <!-- Basic Information -->
              <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Basic Information</h3>

                <!-- Title -->
                <div class="mb-4">
                  <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Title <span class="text-red-500">*</span>
                  </label>
                  <input
                    id="title"
                    v-model="form.title"
                    type="text"
                    required
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    placeholder="Enter course title"
                    @input="generateSlug"
                  />
                  <p v-if="form.errors?.title" class="text-red-500 text-sm mt-1">{{ form.errors.title }}</p>
                </div>

                <!-- Slug -->
                <div class="mb-4">
                  <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    URL Slug
                  </label>
                  <div class="flex">
                    <span class="inline-flex items-center px-3 border border-r-0 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-400 text-sm rounded-l-lg">
                      /courses/
                    </span>
                    <input
                      id="slug"
                      v-model="form.slug"
                      type="text"
                      class="flex-1 px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-r-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                      placeholder="auto-generated-from-title"
                    />
                  </div>
                  <p v-if="form.errors?.slug" class="text-red-500 text-sm mt-1">{{ form.errors.slug }}</p>
                </div>

                <!-- Category and Level -->
                <div class="grid grid-cols-2 gap-4 mb-4">
                  <div>
                    <label for="course_category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                      Category <span class="text-red-500">*</span>
                    </label>
                    <select
                      id="course_category_id"
                      v-model="form.course_category_id"
                      required
                      class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    >
                      <option value="">Select Category</option>
                      <option v-for="category in categories" :key="category.id" :value="category.id">
                        {{ category.name }}
                      </option>
                    </select>
                    <p v-if="form.errors?.course_category_id" class="text-red-500 text-sm mt-1">{{ form.errors.course_category_id }}</p>
                  </div>

                  <div>
                    <label for="level" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                      Level <span class="text-red-500">*</span>
                    </label>
                    <select
                      id="level"
                      v-model="form.level"
                      required
                      class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    >
                      <option value="">Select Level</option>
                      <option value="beginner">Beginner</option>
                      <option value="intermediate">Intermediate</option>
                      <option value="advanced">Advanced</option>
                      <option value="expert">Expert</option>
                    </select>
                    <p v-if="form.errors?.level" class="text-red-500 text-sm mt-1">{{ form.errors.level }}</p>
                  </div>
                </div>

                <!-- Instructor -->
                <div class="mb-4">
                  <label for="instructor" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Instructor <span class="text-red-500">*</span>
                  </label>
                  <input
                    id="instructor"
                    v-model="form.instructor"
                    type="text"
                    required
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    placeholder="Enter instructor name"
                  />
                  <p v-if="form.errors?.instructor" class="text-red-500 text-sm mt-1">{{ form.errors.instructor }}</p>
                </div>

                <!-- Description -->
                <div class="mb-4">
                  <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Short Description <span class="text-red-500">*</span>
                  </label>
                  <textarea
                    id="description"
                    v-model="form.description"
                    rows="3"
                    required
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    placeholder="Brief description of the course"
                  ></textarea>
                  <p v-if="form.errors?.description" class="text-red-500 text-sm mt-1">{{ form.errors.description }}</p>
                </div>

                <!-- Full Description -->
                <div class="mb-4">
                  <label for="full_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Full Description
                  </label>
                  <textarea
                    id="full_description"
                    v-model="form.full_description"
                    rows="6"
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    placeholder="Detailed description of the course"
                  ></textarea>
                  <p v-if="form.errors?.full_description" class="text-red-500 text-sm mt-1">{{ form.errors.full_description }}</p>
                </div>

                <!-- Duration, Lessons, Language -->
                <div class="grid grid-cols-3 gap-4">
                  <div>
                    <label for="duration" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                      Duration (hours) <span class="text-red-500">*</span>
                    </label>
                    <input
                      id="duration"
                      v-model.number="form.duration"
                      type="number"
                      min="1"
                      required
                      class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                      placeholder="8"
                    />
                    <p v-if="form.errors?.duration" class="text-red-500 text-sm mt-1">{{ form.errors.duration }}</p>
                  </div>

                  <div>
                    <label for="lessons" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                      Lessons <span class="text-red-500">*</span>
                    </label>
                    <input
                      id="lessons"
                      v-model.number="form.lessons"
                      type="number"
                      min="1"
                      required
                      class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                      placeholder="50"
                    />
                    <p v-if="form.errors?.lessons" class="text-red-500 text-sm mt-1">{{ form.errors.lessons }}</p>
                  </div>

                  <div>
                    <label for="language" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                      Language <span class="text-red-500">*</span>
                    </label>
                    <input
                      id="language"
                      v-model="form.language"
                      type="text"
                      required
                      class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                      placeholder="English"
                    />
                    <p v-if="form.errors?.language" class="text-red-500 text-sm mt-1">{{ form.errors.language }}</p>
                  </div>
                </div>
              </div>

              <!-- Pricing Information -->
              <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Pricing</h3>

                <div class="grid grid-cols-2 gap-4 mb-4">
                  <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                      Price ($) <span class="text-red-500">*</span>
                    </label>
                    <input
                      id="price"
                      v-model.number="form.price"
                      type="number"
                      step="0.01"
                      min="0"
                      required
                      class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                      placeholder="99.99"
                    />
                    <p v-if="form.errors?.price" class="text-red-500 text-sm mt-1">{{ form.errors.price }}</p>
                  </div>

                  <div>
                    <label for="original_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                      Original Price ($)
                    </label>
                    <input
                      id="original_price"
                      v-model.number="form.original_price"
                      type="number"
                      step="0.01"
                      min="0"
                      class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                      placeholder="199.99"
                    />
                    <p v-if="form.errors?.original_price" class="text-red-500 text-sm mt-1">{{ form.errors.original_price }}</p>
                  </div>
                </div>
              </div>

              <!-- Course Content -->
              <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Course Content</h3>

                <!-- What You'll Learn -->
                <div class="mb-4">
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    What You'll Learn
                  </label>
                  <div v-for="(item, index) in form.what_you_learn" :key="'learn-' + index" class="flex gap-2 mb-2">
                    <input
                      v-model="form.what_you_learn[index]"
                      type="text"
                      class="flex-1 px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500"
                      placeholder="e.g., Master Docker containerization"
                    />
                    <button
                      type="button"
                      @click="removeArrayItem('what_you_learn', index)"
                      class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600"
                    >
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                  <button
                    type="button"
                    @click="addArrayItem('what_you_learn')"
                    class="mt-2 px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600"
                  >
                    <i class="fas fa-plus mr-2"></i>Add Item
                  </button>
                </div>

                <!-- Skills -->
                <div class="mb-4">
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Skills Covered
                  </label>
                  <div v-for="(skill, index) in form.skills" :key="'skill-' + index" class="flex gap-2 mb-2">
                    <input
                      v-model="form.skills[index]"
                      type="text"
                      class="flex-1 px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500"
                      placeholder="e.g., Container orchestration"
                    />
                    <button
                      type="button"
                      @click="removeArrayItem('skills', index)"
                      class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600"
                    >
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                  <button
                    type="button"
                    @click="addArrayItem('skills')"
                    class="mt-2 px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600"
                  >
                    <i class="fas fa-plus mr-2"></i>Add Skill
                  </button>
                </div>

                <!-- Prerequisites -->
                <div class="mb-4">
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Prerequisites
                  </label>
                  <div v-for="(prereq, index) in form.prerequisites" :key="'prereq-' + index" class="flex gap-2 mb-2">
                    <input
                      v-model="form.prerequisites[index]"
                      type="text"
                      class="flex-1 px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500"
                      placeholder="e.g., Basic Linux knowledge"
                    />
                    <button
                      type="button"
                      @click="removeArrayItem('prerequisites', index)"
                      class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600"
                    >
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                  <button
                    type="button"
                    @click="addArrayItem('prerequisites')"
                    class="mt-2 px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600"
                  >
                    <i class="fas fa-plus mr-2"></i>Add Prerequisite
                  </button>
                </div>

                <!-- Target Audience -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Target Audience
                  </label>
                  <div v-for="(audience, index) in form.target_audience" :key="'audience-' + index" class="flex gap-2 mb-2">
                    <input
                      v-model="form.target_audience[index]"
                      type="text"
                      class="flex-1 px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500"
                      placeholder="e.g., DevOps engineers"
                    />
                    <button
                      type="button"
                      @click="removeArrayItem('target_audience', index)"
                      class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600"
                    >
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                  <button
                    type="button"
                    @click="addArrayItem('target_audience')"
                    class="mt-2 px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600"
                  >
                    <i class="fas fa-plus mr-2"></i>Add Audience
                  </button>
                </div>
              </div>

              <!-- SEO Settings -->
              <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">SEO Settings</h3>

                <div class="mb-4">
                  <label for="meta_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Meta Title
                  </label>
                  <input
                    id="meta_title"
                    v-model="form.meta_title"
                    type="text"
                    maxlength="70"
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    placeholder="SEO optimized title"
                  />
                  <p class="text-xs text-gray-500 mt-1">{{ form.meta_title?.length || 0 }}/70 characters</p>
                </div>

                <div class="mb-4">
                  <label for="meta_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Meta Description
                  </label>
                  <textarea
                    id="meta_description"
                    v-model="form.meta_description"
                    rows="3"
                    maxlength="160"
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    placeholder="SEO optimized description"
                  ></textarea>
                  <p class="text-xs text-gray-500 mt-1">{{ form.meta_description?.length || 0 }}/160 characters</p>
                </div>

                <div>
                  <label for="meta_keywords" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Meta Keywords
                  </label>
                  <input
                    id="meta_keywords"
                    v-model="form.meta_keywords"
                    type="text"
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    placeholder="docker, kubernetes, devops"
                  />
                </div>
              </div>
            </div>

            <!-- Sidebar Column -->
            <div class="space-y-6">
              <!-- Publish Settings -->
              <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Publish</h3>

                <div class="mb-4">
                  <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Status <span class="text-red-500">*</span>
                  </label>
                  <select
                    id="status"
                    v-model="form.status"
                    required
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                  >
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                    <option value="archived">Archived</option>
                  </select>
                  <p v-if="form.errors?.status" class="text-red-500 text-sm mt-1">{{ form.errors.status }}</p>
                </div>

                <div class="space-y-3 mb-4">
                  <label class="flex items-center">
                    <input
                      v-model="form.certificate"
                      type="checkbox"
                      class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500"
                    />
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                      <i class="fas fa-certificate text-emerald-600 mr-1"></i>
                      Certificate Included
                    </span>
                  </label>

                  <label class="flex items-center">
                    <input
                      v-model="form.featured"
                      type="checkbox"
                      class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500"
                    />
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                      <i class="fas fa-star text-yellow-500 mr-1"></i>
                      Featured Course
                    </span>
                  </label>

                  <label class="flex items-center">
                    <input
                      v-model="form.bestseller"
                      type="checkbox"
                      class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500"
                    />
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                      <i class="fas fa-fire text-orange-500 mr-1"></i>
                      Bestseller
                    </span>
                  </label>
                </div>

                <div class="flex gap-2">
                  <button
                    type="submit"
                    :disabled="form.processing"
                    class="flex-1 px-4 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-lg font-semibold hover:from-emerald-600 hover:to-emerald-700 transition-all duration-200 disabled:opacity-50"
                  >
                    <i class="fas fa-save mr-2"></i>
                    {{ isEditing ? 'Update' : 'Create' }} Course
                  </button>
                </div>
              </div>

              <!-- Stats (only for editing) -->
              <div v-if="isEditing" class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Statistics</h3>

                <div class="mb-4">
                  <label for="students" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Students Enrolled
                  </label>
                  <input
                    id="students"
                    v-model.number="form.students"
                    type="number"
                    min="0"
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    placeholder="0"
                  />
                </div>

                <div class="grid grid-cols-2 gap-4">
                  <div>
                    <label for="rating" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                      Rating
                    </label>
                    <input
                      id="rating"
                      v-model.number="form.rating"
                      type="number"
                      step="0.1"
                      min="0"
                      max="5"
                      class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                      placeholder="4.5"
                    />
                  </div>

                  <div>
                    <label for="reviews" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                      Reviews
                    </label>
                    <input
                      id="reviews"
                      v-model.number="form.reviews"
                      type="number"
                      min="0"
                      class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                      placeholder="0"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </main>
  </div>
</template>

<script>
import { Head, Link, useForm } from '@inertiajs/vue3'
import { ref, onMounted } from 'vue'
import Sidebar from '../Common/Sidebar.vue'
import Topbar from '../Common/Topbar.vue'

export default {
  name: 'CourseForm',
  components: {
    Head,
    Link,
    Sidebar,
    Topbar
  },
  props: {
    course: {
      type: Object,
      default: null
    },
    categories: {
      type: Array,
      default: () => []
    },
    isEditing: {
      type: Boolean,
      default: false
    }
  },
  setup(props) {
    const sidebarCollapsed = ref(false)
    const isDark = ref(false)

    // Initialize form with course data or defaults
    const form = useForm({
      title: props.course?.title || '',
      slug: props.course?.slug || '',
      course_category_id: props.course?.course_category_id || '',
      description: props.course?.description || '',
      full_description: props.course?.full_description || '',
      instructor: props.course?.instructor || '',
      level: props.course?.level || '',
      duration: props.course?.duration || 1,
      lessons: props.course?.lessons || 1,
      language: props.course?.language || 'English',
      price: props.course?.price || 0,
      original_price: props.course?.original_price || null,
      certificate: props.course?.certificate || false,
      bestseller: props.course?.bestseller || false,
      featured: props.course?.featured || false,
      students: props.course?.students || 0,
      rating: props.course?.rating || null,
      reviews: props.course?.reviews || 0,
      skills: props.course?.skills || [],
      prerequisites: props.course?.prerequisites || [],
      target_audience: props.course?.target_audience || [],
      what_you_learn: props.course?.what_you_learn || [],
      curriculum: props.course?.curriculum || [],
      status: props.course?.status || 'draft',
      meta_title: props.course?.meta_title || '',
      meta_description: props.course?.meta_description || '',
      meta_keywords: props.course?.meta_keywords || ''
    })

    const handleSidebarToggle = () => {
      sidebarCollapsed.value = !sidebarCollapsed.value
    }

    const toggleTheme = () => {
      isDark.value = !isDark.value
      if (isDark.value) {
        document.documentElement.classList.add('dark')
        localStorage.setItem('theme', 'dark')
      } else {
        document.documentElement.classList.remove('dark')
        localStorage.setItem('theme', 'light')
      }
    }

    const generateSlug = () => {
      if (!props.isEditing || !form.slug) {
        form.slug = form.title
          .toLowerCase()
          .replace(/[^a-z0-9]+/g, '-')
          .replace(/^-+|-+$/g, '')
      }
    }

    const addArrayItem = (field) => {
      if (!Array.isArray(form[field])) {
        form[field] = []
      }
      form[field].push('')
    }

    const removeArrayItem = (field, index) => {
      form[field].splice(index, 1)
    }

    const submit = () => {
      if (props.isEditing) {
        form.post(route('admin.courses.update', props.course.id), {
          preserveScroll: true,
          onSuccess: () => {
            // Success message will be shown via flash
          }
        })
      } else {
        form.post(route('admin.courses.store'), {
          preserveScroll: true,
          onSuccess: () => {
            // Success message will be shown via flash
          }
        })
      }
    }

    // Initialize dark mode
    onMounted(() => {
      const theme = localStorage.getItem('theme')
      if (theme === 'dark') {
        isDark.value = true
        document.documentElement.classList.add('dark')
      }
    })

    return {
      sidebarCollapsed,
      isDark,
      form,
      handleSidebarToggle,
      toggleTheme,
      generateSlug,
      addArrayItem,
      removeArrayItem,
      submit,
      route
    }
  }
}
</script>
