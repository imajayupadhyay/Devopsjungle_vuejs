<template>
  <div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-200">
    <Head>
      <title>{{ isEditing ? 'Edit Exam Dump' : 'Create Exam Dump' }} - DevOps Jungle Admin</title>
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
              {{ isEditing ? 'Edit Exam Dump' : 'Create New Exam Dump' }}
            </h1>
            <p class="text-gray-600 dark:text-gray-400">
              {{ isEditing ? 'Update exam dump content and settings' : 'Add a new certification exam dump' }}
            </p>
          </div>
          <Link
            :href="route('admin.exam-dumps.index')"
            class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors"
          >
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Exam Dumps
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
                    Exam Title <span class="text-red-500">*</span>
                  </label>
                  <input
                    id="title"
                    v-model="form.title"
                    type="text"
                    required
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    placeholder="e.g., AWS Certified Solutions Architect - Associate"
                  />
                  <p v-if="form.errors?.title" class="text-red-500 text-sm mt-1">{{ form.errors.title }}</p>
                </div>

                <!-- Exam Code & Slug -->
                <div class="grid grid-cols-2 gap-4 mb-4">
                  <div>
                    <label for="code" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                      Exam Code <span class="text-red-500">*</span>
                    </label>
                    <input
                      id="code"
                      v-model="form.code"
                      type="text"
                      required
                      class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all font-mono font-bold"
                      placeholder="SAA-C03"
                      @input="generateSlug"
                    />
                    <p v-if="form.errors?.code" class="text-red-500 text-sm mt-1">{{ form.errors.code }}</p>
                  </div>

                  <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                      URL Slug
                    </label>
                    <input
                      id="slug"
                      v-model="form.slug"
                      type="text"
                      class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                      placeholder="auto-generated"
                    />
                    <p v-if="form.errors?.slug" class="text-red-500 text-sm mt-1">{{ form.errors.slug }}</p>
                  </div>
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
                    placeholder="Brief description for the exam dump listing page"
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
                    placeholder="Detailed description for the exam detail page"
                  ></textarea>
                </div>
              </div>

              <!-- Exam Details -->
              <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Exam Details</h3>

                <div class="grid grid-cols-2 gap-4 mb-4">
                  <!-- Questions Count -->
                  <div>
                    <label for="questions_count" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                      Questions Count <span class="text-red-500">*</span>
                    </label>
                    <input
                      id="questions_count"
                      v-model.number="form.questions_count"
                      type="number"
                      required
                      min="1"
                      class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                      placeholder="385"
                    />
                    <p v-if="form.errors?.questions_count" class="text-red-500 text-sm mt-1">{{ form.errors.questions_count }}</p>
                  </div>

                  <!-- Duration -->
                  <div>
                    <label for="duration_minutes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                      Duration (minutes) <span class="text-red-500">*</span>
                    </label>
                    <input
                      id="duration_minutes"
                      v-model.number="form.duration_minutes"
                      type="number"
                      required
                      min="1"
                      class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                      placeholder="130"
                    />
                    <p v-if="form.errors?.duration_minutes" class="text-red-500 text-sm mt-1">{{ form.errors.duration_minutes }}</p>
                  </div>

                  <!-- Passing Score -->
                  <div>
                    <label for="passing_score" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                      Passing Score <span class="text-red-500">*</span>
                    </label>
                    <input
                      id="passing_score"
                      v-model.number="form.passing_score"
                      type="number"
                      required
                      min="0"
                      max="1000"
                      class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                      placeholder="720"
                    />
                    <p v-if="form.errors?.passing_score" class="text-red-500 text-sm mt-1">{{ form.errors.passing_score }}</p>
                  </div>

                  <!-- Success Rate -->
                  <div>
                    <label for="success_rate" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                      Success Rate (%)
                    </label>
                    <input
                      id="success_rate"
                      v-model.number="form.success_rate"
                      type="number"
                      min="0"
                      max="100"
                      class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                      placeholder="94"
                    />
                  </div>
                </div>
              </div>

              <!-- Pricing & Files -->
              <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Pricing & Files</h3>

                <!-- Is Free Checkbox -->
                <div class="mb-4">
                  <label class="flex items-center">
                    <input
                      v-model="form.is_free"
                      type="checkbox"
                      class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500 mr-2"
                    />
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                      This is a free exam dump
                    </span>
                  </label>
                </div>

                <div v-if="!form.is_free" class="grid grid-cols-2 gap-4 mb-4">
                  <!-- Price -->
                  <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                      Price ($) <span class="text-red-500">*</span>
                    </label>
                    <input
                      id="price"
                      v-model.number="form.price"
                      type="number"
                      :required="!form.is_free"
                      min="0"
                      step="0.01"
                      class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                      placeholder="299.00"
                    />
                    <p v-if="form.errors?.price" class="text-red-500 text-sm mt-1">{{ form.errors.price }}</p>
                  </div>

                  <!-- Original Price (for showing discount) -->
                  <div>
                    <label for="original_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                      Original Price ($)
                    </label>
                    <input
                      id="original_price"
                      v-model.number="form.original_price"
                      type="number"
                      min="0"
                      step="0.01"
                      class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                      placeholder="599.00"
                    />
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Used to show discount percentage</p>
                  </div>
                </div>

                <!-- PDF File Upload -->
                <div class="mb-4">
                  <label for="pdf_file" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Full Exam PDF
                  </label>
                  <input
                    id="pdf_file"
                    ref="pdfFileInput"
                    type="file"
                    accept=".pdf"
                    @change="handlePdfUpload"
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100"
                  />
                  <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Upload the full exam dump PDF (max 10MB)</p>
                  <p v-if="form.pdf_file_name" class="text-sm text-emerald-600 dark:text-emerald-400 mt-1">
                    <i class="fas fa-file-pdf mr-1"></i>{{ form.pdf_file_name }}
                  </p>
                </div>

                <!-- Sample PDF Upload -->
                <div class="mb-4">
                  <label for="sample_pdf" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Sample PDF
                  </label>
                  <input
                    id="sample_pdf"
                    ref="samplePdfInput"
                    type="file"
                    accept=".pdf"
                    @change="handleSamplePdfUpload"
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100"
                  />
                  <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Upload a sample PDF for preview (max 5MB)</p>
                  <p v-if="form.sample_pdf_name" class="text-sm text-emerald-600 dark:text-emerald-400 mt-1">
                    <i class="fas fa-file-pdf mr-1"></i>{{ form.sample_pdf_name }}
                  </p>
                </div>
              </div>

              <!-- Prerequisites & Target Audience -->
              <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Additional Information</h3>

                <!-- Prerequisites -->
                <div class="mb-4">
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Prerequisites
                  </label>
                  <div class="space-y-2">
                    <div v-for="(prerequisite, index) in form.prerequisites" :key="index" class="flex items-center space-x-2">
                      <input
                        v-model="form.prerequisites[index]"
                        type="text"
                        class="flex-1 px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white"
                        placeholder="e.g., 1+ years AWS experience"
                      />
                      <button
                        type="button"
                        @click="removePrerequisite(index)"
                        class="p-2 text-red-600 hover:bg-red-100 dark:hover:bg-red-900/20 rounded-lg"
                      >
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <button
                    type="button"
                    @click="addPrerequisite"
                    class="mt-2 px-4 py-2 text-sm text-emerald-600 dark:text-emerald-400 hover:bg-emerald-100 dark:hover:bg-emerald-900/20 rounded-lg transition-colors"
                  >
                    <i class="fas fa-plus mr-1"></i>Add Prerequisite
                  </button>
                </div>

                <!-- Target Audience -->
                <div class="mb-4">
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Target Audience
                  </label>
                  <div class="space-y-2">
                    <div v-for="(audience, index) in form.target_audience" :key="index" class="flex items-center space-x-2">
                      <input
                        v-model="form.target_audience[index]"
                        type="text"
                        class="flex-1 px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white"
                        placeholder="e.g., Solutions Architects"
                      />
                      <button
                        type="button"
                        @click="removeTargetAudience(index)"
                        class="p-2 text-red-600 hover:bg-red-100 dark:hover:bg-red-900/20 rounded-lg"
                      >
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <button
                    type="button"
                    @click="addTargetAudience"
                    class="mt-2 px-4 py-2 text-sm text-emerald-600 dark:text-emerald-400 hover:bg-emerald-100 dark:hover:bg-emerald-900/20 rounded-lg transition-colors"
                  >
                    <i class="fas fa-plus mr-1"></i>Add Target Audience
                  </button>
                </div>

                <!-- What You'll Learn -->
                <div class="mb-4">
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    What You'll Learn
                  </label>
                  <div class="space-y-2">
                    <div v-for="(learn, index) in form.what_you_learn" :key="index" class="flex items-center space-x-2">
                      <input
                        v-model="form.what_you_learn[index]"
                        type="text"
                        class="flex-1 px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white"
                        placeholder="e.g., Design highly available systems"
                      />
                      <button
                        type="button"
                        @click="removeWhatYouLearn(index)"
                        class="p-2 text-red-600 hover:bg-red-100 dark:hover:bg-red-900/20 rounded-lg"
                      >
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <button
                    type="button"
                    @click="addWhatYouLearn"
                    class="mt-2 px-4 py-2 text-sm text-emerald-600 dark:text-emerald-400 hover:bg-emerald-100 dark:hover:bg-emerald-900/20 rounded-lg transition-colors"
                  >
                    <i class="fas fa-plus mr-1"></i>Add Learning Outcome
                  </button>
                </div>
              </div>

              <!-- SEO Settings -->
              <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">SEO Settings</h3>

                <!-- Meta Title -->
                <div class="mb-4">
                  <label for="meta_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Meta Title
                  </label>
                  <input
                    id="meta_title"
                    v-model="form.meta_title"
                    type="text"
                    maxlength="70"
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    placeholder="SEO title (max 70 characters)"
                  />
                  <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ (form.meta_title || '').length }}/70 characters</p>
                </div>

                <!-- Meta Description -->
                <div class="mb-4">
                  <label for="meta_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Meta Description
                  </label>
                  <textarea
                    id="meta_description"
                    v-model="form.meta_description"
                    rows="3"
                    maxlength="160"
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    placeholder="SEO description (max 160 characters)"
                  ></textarea>
                  <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ (form.meta_description || '').length }}/160 characters</p>
                </div>

                <!-- Meta Keywords -->
                <div class="mb-4">
                  <label for="meta_keywords" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Meta Keywords
                  </label>
                  <input
                    id="meta_keywords"
                    v-model="form.meta_keywords"
                    type="text"
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    placeholder="aws, certification, exam, saa-c03"
                  />
                  <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Comma-separated keywords</p>
                </div>
              </div>
            </div>

            <!-- Sidebar Column -->
            <div class="lg:col-span-1 space-y-6">
              <!-- Publishing Options -->
              <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Publishing</h3>

                <!-- Status -->
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
                </div>

                <!-- Featured -->
                <div class="mb-4">
                  <label class="flex items-center">
                    <input
                      v-model="form.featured"
                      type="checkbox"
                      class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500 mr-2"
                    />
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                      Featured Exam
                    </span>
                  </label>
                  <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Show on homepage</p>
                </div>

                <!-- Badge -->
                <div class="mb-4">
                  <label for="badge" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Badge
                  </label>
                  <select
                    id="badge"
                    v-model="form.badge"
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                  >
                    <option value="">No Badge</option>
                    <option value="Most Popular">Most Popular</option>
                    <option value="High Demand">High Demand</option>
                    <option value="Entry Level">Entry Level</option>
                    <option value="Hands-on">Hands-on</option>
                  </select>
                </div>

                <!-- Popularity -->
                <div class="mb-4">
                  <label for="popularity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Popularity (0-100)
                  </label>
                  <input
                    id="popularity"
                    v-model.number="form.popularity"
                    type="number"
                    min="0"
                    max="100"
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    placeholder="85"
                  />
                  <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Used for sorting</p>
                </div>
              </div>

              <!-- Provider & Difficulty -->
              <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Classification</h3>

                <!-- Provider -->
                <div class="mb-4">
                  <label for="exam_provider_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Provider <span class="text-red-500">*</span>
                  </label>
                  <select
                    id="exam_provider_id"
                    v-model="form.exam_provider_id"
                    required
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                  >
                    <option value="">Select Provider</option>
                    <option v-for="provider in providers" :key="provider.id" :value="provider.id">
                      {{ provider.name }}
                    </option>
                  </select>
                  <p v-if="form.errors?.exam_provider_id" class="text-red-500 text-sm mt-1">{{ form.errors.exam_provider_id }}</p>
                </div>

                <!-- Difficulty -->
                <div class="mb-4">
                  <label for="difficulty" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Difficulty <span class="text-red-500">*</span>
                  </label>
                  <select
                    id="difficulty"
                    v-model="form.difficulty"
                    required
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                  >
                    <option value="">Select Difficulty</option>
                    <option value="beginner">Beginner</option>
                    <option value="intermediate">Intermediate</option>
                    <option value="expert">Expert</option>
                  </select>
                  <p v-if="form.errors?.difficulty" class="text-red-500 text-sm mt-1">{{ form.errors.difficulty }}</p>
                </div>
              </div>

              <!-- Topics -->
              <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Topics</h3>
                <div class="space-y-2 max-h-64 overflow-y-auto">
                  <label v-for="topic in topics" :key="topic.id" class="flex items-center">
                    <input
                      v-model="form.topic_ids"
                      type="checkbox"
                      :value="topic.id"
                      class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500 mr-2"
                    />
                    <span class="text-sm text-gray-700 dark:text-gray-300">{{ topic.name }}</span>
                  </label>
                </div>
              </div>

              <!-- Submit Buttons -->
              <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm">
                <div class="space-y-3">
                  <button
                    type="submit"
                    :disabled="form.processing"
                    class="w-full px-6 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-lg font-semibold hover:from-emerald-600 hover:to-emerald-700 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                  >
                    <span v-if="!form.processing">
                      <i class="fas fa-save mr-2"></i>
                      {{ isEditing ? 'Update Exam Dump' : 'Create Exam Dump' }}
                    </span>
                    <span v-else>
                      <i class="fas fa-spinner fa-spin mr-2"></i>
                      {{ isEditing ? 'Updating...' : 'Creating...' }}
                    </span>
                  </button>

                  <Link
                    :href="route('admin.exam-dumps.index')"
                    class="block w-full px-6 py-3 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors text-center"
                  >
                    Cancel
                  </Link>
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
import { Head, Link, router } from '@inertiajs/vue3'
import { ref, reactive, onMounted } from 'vue'
import Sidebar from '../Common/Sidebar.vue'
import Topbar from '../Common/Topbar.vue'

export default {
  name: 'ExamDumpForm',
  components: {
    Head,
    Link,
    Sidebar,
    Topbar
  },
  props: {
    examDump: {
      type: Object,
      default: null
    },
    providers: {
      type: Array,
      default: () => []
    },
    topics: {
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
    const pdfFileInput = ref(null)
    const samplePdfInput = ref(null)

    // Form state
    const form = reactive({
      title: props.examDump?.title || '',
      code: props.examDump?.code || '',
      slug: props.examDump?.slug || '',
      description: props.examDump?.description || '',
      full_description: props.examDump?.full_description || '',
      exam_provider_id: props.examDump?.exam_provider_id || '',
      difficulty: props.examDump?.difficulty || '',
      questions_count: props.examDump?.questions_count || null,
      duration_minutes: props.examDump?.duration_minutes || null,
      passing_score: props.examDump?.passing_score || null,
      price: props.examDump?.price || 0,
      original_price: props.examDump?.original_price || null,
      is_free: props.examDump?.is_free || false,
      success_rate: props.examDump?.success_rate || null,
      popularity: props.examDump?.popularity || 0,
      status: props.examDump?.status || 'draft',
      featured: props.examDump?.featured || false,
      badge: props.examDump?.badge || '',
      pdf_file: null,
      sample_pdf: null,
      pdf_file_name: props.examDump?.pdf_file || '',
      sample_pdf_name: props.examDump?.sample_pdf || '',
      prerequisites: props.examDump?.prerequisites || [],
      target_audience: props.examDump?.target_audience || [],
      what_you_learn: props.examDump?.what_you_learn || [],
      topic_ids: props.examDump?.topics?.map(t => t.id) || [],
      meta_title: props.examDump?.meta_title || '',
      meta_description: props.examDump?.meta_description || '',
      meta_keywords: props.examDump?.meta_keywords || '',
      processing: false,
      errors: {}
    })

    // Methods
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
      if (form.code && !props.isEditing) {
        form.slug = form.code.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '')
      }
    }

    const handlePdfUpload = (event) => {
      const file = event.target.files[0]
      if (file) {
        form.pdf_file = file
        form.pdf_file_name = file.name
      }
    }

    const handleSamplePdfUpload = (event) => {
      const file = event.target.files[0]
      if (file) {
        form.sample_pdf = file
        form.sample_pdf_name = file.name
      }
    }

    const addPrerequisite = () => {
      form.prerequisites.push('')
    }

    const removePrerequisite = (index) => {
      form.prerequisites.splice(index, 1)
    }

    const addTargetAudience = () => {
      form.target_audience.push('')
    }

    const removeTargetAudience = (index) => {
      form.target_audience.splice(index, 1)
    }

    const addWhatYouLearn = () => {
      form.what_you_learn.push('')
    }

    const removeWhatYouLearn = (index) => {
      form.what_you_learn.splice(index, 1)
    }

    const submit = () => {
      form.processing = true
      form.errors = {}

      const formData = new FormData()

      // Add _method for PUT request when editing
      if (props.isEditing) {
        formData.append('_method', 'PUT')
      }

      // Append all form fields
      Object.keys(form).forEach(key => {
        if (key === 'processing' || key === 'errors' || key === 'pdf_file_name' || key === 'sample_pdf_name') {
          return
        }

        if (key === 'pdf_file' || key === 'sample_pdf') {
          if (form[key] instanceof File) {
            formData.append(key, form[key])
          }
        } else if (key === 'is_free' || key === 'featured') {
          // Handle boolean fields - convert to 1 or 0
          formData.append(key, form[key] ? 1 : 0)
        } else if (Array.isArray(form[key])) {
          // Filter out empty strings
          const filtered = form[key].filter(item => item !== '')
          if (filtered.length > 0) {
            // Append each array item individually with array notation
            filtered.forEach((item, index) => {
              formData.append(`${key}[${index}]`, item)
            })
          }
        } else if (form[key] !== null && form[key] !== '') {
          formData.append(key, form[key])
        }
      })

      const url = props.isEditing
        ? window.route('admin.exam-dumps.update', props.examDump.id)
        : window.route('admin.exam-dumps.store')

      // Debug: Log form data
      console.log('Form Data being submitted:', Object.fromEntries(formData))
      console.log('URL:', url)

      router.post(url, formData, {
        onSuccess: (page) => {
          console.log('Success!', page)
          form.processing = false
        },
        onError: (errors) => {
          console.error('Validation Errors:', errors)
          form.errors = errors
          form.processing = false

          // Show alert with errors
          const errorMessages = Object.values(errors).flat().join('\n')
          alert('Validation Errors:\n\n' + errorMessages)
        },
        onFinish: () => {
          console.log('Request finished')
        }
      })
    }

    // Initialize dark mode
    onMounted(() => {
      const theme = localStorage.getItem('theme')
      if (theme === 'dark') {
        isDark.value = true
        document.documentElement.classList.add('dark')
      }

      // Initialize empty arrays if needed
      if (form.prerequisites.length === 0) {
        addPrerequisite()
      }
      if (form.target_audience.length === 0) {
        addTargetAudience()
      }
      if (form.what_you_learn.length === 0) {
        addWhatYouLearn()
      }
    })

    return {
      sidebarCollapsed,
      isDark,
      pdfFileInput,
      samplePdfInput,
      form,
      handleSidebarToggle,
      toggleTheme,
      generateSlug,
      handlePdfUpload,
      handleSamplePdfUpload,
      addPrerequisite,
      removePrerequisite,
      addTargetAudience,
      removeTargetAudience,
      addWhatYouLearn,
      removeWhatYouLearn,
      submit
    }
  }
}
</script>
