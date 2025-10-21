<template>
  <div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-200">
    <Head>
      <title>{{ isEditing ? 'Edit Blog Post' : 'Create Blog Post' }} - DevOps Jungle Admin</title>
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
              {{ isEditing ? 'Edit Blog Post' : 'Create New Blog Post' }}
            </h1>
            <p class="text-gray-600 dark:text-gray-400">
              {{ isEditing ? 'Update your blog post content and settings' : 'Write and publish a new blog post' }}
            </p>
          </div>
          <Link
            :href="route('admin.blogs.index')"
            class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors"
          >
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Posts
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
                    placeholder="Enter blog post title"
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
                      /blog/
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

                <!-- Excerpt -->
                <div class="mb-4">
                  <label for="excerpt" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Excerpt <span class="text-red-500">*</span>
                  </label>
                  <textarea
                    id="excerpt"
                    v-model="form.excerpt"
                    rows="3"
                    required
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all resize-none"
                    placeholder="Write a brief excerpt or summary of your blog post"
                  ></textarea>
                  <p v-if="form.errors?.excerpt" class="text-red-500 text-sm mt-1">{{ form.errors.excerpt }}</p>
                </div>
              </div>

              <!-- Content -->
              <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Content</h3>

                <div class="mb-4">
                  <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Blog Content <span class="text-red-500">*</span>
                  </label>
                  <textarea
                    id="content"
                    v-model="form.content"
                    rows="20"
                    required
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all resize-none"
                    placeholder="Write your blog post content here. You can use HTML markup for formatting."
                  ></textarea>
                  <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">
                    You can use HTML markup for formatting. Estimated read time: {{ estimatedReadTime }} minutes
                  </p>
                  <p v-if="form.errors?.content" class="text-red-500 text-sm mt-1">{{ form.errors.content }}</p>
                </div>
              </div>

              <!-- SEO Settings -->
              <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">
                  <i class="fas fa-search mr-2 text-emerald-600"></i>
                  SEO Settings
                </h3>

                <!-- Meta Title -->
                <div class="mb-4">
                  <label for="meta_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Meta Title ({{ form.meta_title ? form.meta_title.length : 0 }}/70)
                  </label>
                  <input
                    id="meta_title"
                    v-model="form.meta_title"
                    type="text"
                    maxlength="70"
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    placeholder="Leave blank to use post title"
                  />
                  <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">
                    The title that appears in search engine results. Recommended: 50-60 characters.
                  </p>
                </div>

                <!-- Meta Description -->
                <div class="mb-4">
                  <label for="meta_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Meta Description ({{ form.meta_description ? form.meta_description.length : 0 }}/160)
                  </label>
                  <textarea
                    id="meta_description"
                    v-model="form.meta_description"
                    rows="3"
                    maxlength="160"
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all resize-none"
                    placeholder="Leave blank to use excerpt"
                  ></textarea>
                  <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">
                    The description that appears in search engine results. Recommended: 150-160 characters.
                  </p>
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
                    placeholder="keyword1, keyword2, keyword3"
                  />
                  <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">
                    Separate keywords with commas. Example: devops, kubernetes, docker
                  </p>
                </div>

                <!-- Canonical URL -->
                <div class="mb-4">
                  <label for="canonical_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Canonical URL
                  </label>
                  <input
                    id="canonical_url"
                    v-model="form.canonical_url"
                    type="url"
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    placeholder="https://example.com/original-post"
                  />
                  <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">
                    Optional. Use if this content was originally published elsewhere.
                  </p>
                </div>
              </div>
            </div>

            <!-- Sidebar Column -->
            <div class="space-y-6">
              <!-- Publish Settings -->
              <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Publish Settings</h3>

                <!-- Status -->
                <div class="mb-4">
                  <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Status
                  </label>
                  <select
                    id="status"
                    v-model="form.status"
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500"
                  >
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                    <option value="scheduled">Scheduled</option>
                    <option value="archived">Archived</option>
                  </select>
                </div>

                <!-- Published Date -->
                <div v-if="form.status === 'published'" class="mb-4">
                  <label for="published_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Publish Date
                  </label>
                  <input
                    id="published_at"
                    v-model="form.published_at"
                    type="datetime-local"
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500"
                  />
                </div>

                <!-- Scheduled Date -->
                <div v-if="form.status === 'scheduled'" class="mb-4">
                  <label for="scheduled_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Schedule Date <span class="text-red-500">*</span>
                  </label>
                  <input
                    id="scheduled_at"
                    v-model="form.scheduled_at"
                    type="datetime-local"
                    :min="minDateTime"
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500"
                  />
                </div>

                <!-- Options -->
                <div class="space-y-3">
                  <label class="flex items-center">
                    <input
                      v-model="form.featured"
                      type="checkbox"
                      class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500"
                    />
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Featured Post</span>
                  </label>

                  <label class="flex items-center">
                    <input
                      v-model="form.sticky"
                      type="checkbox"
                      class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500"
                    />
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Sticky Post</span>
                  </label>
                </div>
              </div>

              <!-- Category & Tags -->
              <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Category & Tags</h3>

                <!-- Category -->
                <div class="mb-4">
                  <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Category <span class="text-red-500">*</span>
                  </label>
                  <select
                    id="category_id"
                    v-model="form.category_id"
                    required
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                  >
                    <option v-for="category in categories" :key="category.id" :value="category.id">
                      {{ category.name }}
                    </option>
                  </select>
                  <p v-if="form.errors?.category_id" class="text-red-500 text-sm mt-1">{{ form.errors.category_id }}</p>
                  <div class="mt-2">
                    <Link
                      :href="route('admin.categories.create')"
                      class="text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 text-sm"
                    >
                      + Create new category
                    </Link>
                  </div>
                </div>

                <!-- Tags -->
                <div class="mb-4">
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Tags
                  </label>

                  <!-- Selected Tags Display -->
                  <div v-if="selectedTags.length > 0" class="mb-3 flex flex-wrap gap-2">
                    <span
                      v-for="tag in selectedTags"
                      :key="tag.id"
                      class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 dark:bg-emerald-900/20 text-emerald-800 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800"
                    >
                      {{ tag.name }}
                      <button
                        type="button"
                        @click="removeTag(tag.id)"
                        class="ml-2 text-emerald-600 dark:text-emerald-400 hover:text-emerald-800 dark:hover:text-emerald-200"
                      >
                        ×
                      </button>
                    </span>
                  </div>

                  <!-- Tag Selection -->
                  <div class="relative">
                    <input
                      v-model="tagSearch"
                      type="text"
                      class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                      placeholder="Search and select tags..."
                      @input="searchTags"
                      @focus="showTagDropdown = true"
                    />

                    <!-- Tag Dropdown -->
                    <div
                      v-if="showTagDropdown && filteredTags.length > 0"
                      class="absolute z-10 w-full mt-1 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg shadow-lg max-h-60 overflow-y-auto"
                    >
                      <button
                        v-for="tag in filteredTags"
                        :key="tag.id"
                        type="button"
                        @click="addTag(tag)"
                        class="w-full px-4 py-2 text-left hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-800 dark:text-white flex items-center justify-between"
                      >
                        <span>{{ tag.name }}</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ tag.posts_count || 0 }} posts</span>
                      </button>
                    </div>
                  </div>

                  <div class="mt-2 flex items-center justify-between">
                    <p class="text-gray-500 dark:text-gray-400 text-sm">
                      Search for existing tags or create new ones
                    </p>
                    <Link
                      :href="route('admin.tags.create')"
                      class="text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 text-sm"
                    >
                      + Create new tag
                    </Link>
                  </div>
                </div>
              </div>

              <!-- Author Information -->
              <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Author Information</h3>

                <!-- Author Name -->
                <div class="mb-4">
                  <label for="author_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Author Name <span class="text-red-500">*</span>
                  </label>
                  <input
                    id="author_name"
                    v-model="form.author_name"
                    type="text"
                    required
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    placeholder="John Doe"
                  />
                </div>

                <!-- Author Role -->
                <div class="mb-4">
                  <label for="author_role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Author Role
                  </label>
                  <input
                    id="author_role"
                    v-model="form.author_role"
                    type="text"
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    placeholder="DevOps Engineer"
                  />
                </div>

                <!-- Author Bio -->
                <div class="mb-4">
                  <label for="author_bio" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Author Bio
                  </label>
                  <textarea
                    id="author_bio"
                    v-model="form.author_bio"
                    rows="3"
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all resize-none"
                    placeholder="Brief bio about the author"
                  ></textarea>
                </div>
              </div>

              <!-- Featured Image -->
              <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Featured Image</h3>

                <div class="mb-4">
                  <input
                    id="featured_image"
                    ref="featuredImageInput"
                    type="file"
                    accept="image/*"
                    class="hidden"
                    @change="handleFeaturedImageUpload"
                  />
                  <button
                    type="button"
                    @click="$refs.featuredImageInput.click()"
                    class="w-full p-4 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg hover:border-emerald-500 transition-colors"
                  >
                    <div v-if="featuredImagePreview" class="relative">
                      <img :src="featuredImagePreview" alt="Featured image preview" class="w-full h-48 object-cover rounded-lg" />
                      <button
                        type="button"
                        @click.stop="removeFeaturedImage"
                        class="absolute top-2 right-2 p-1 bg-red-500 text-white rounded-full hover:bg-red-600"
                      >
                        <i class="fas fa-times text-sm"></i>
                      </button>
                    </div>
                    <div v-else class="text-center">
                      <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                      <p class="text-gray-600 dark:text-gray-400">Click to upload featured image</p>
                      <p class="text-gray-500 dark:text-gray-500 text-sm">PNG, JPG up to 2MB</p>
                    </div>
                  </button>
                </div>
              </div>

              <!-- Actions -->
              <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm">
                <div class="space-y-3">
                  <button
                    type="submit"
                    :disabled="form.processing"
                    class="w-full px-6 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-lg font-semibold hover:from-emerald-600 hover:to-emerald-700 transition-all duration-200 flex items-center justify-center space-x-2 shadow-lg disabled:opacity-50"
                  >
                    <i v-if="form.processing" class="fas fa-spinner fa-spin"></i>
                    <i v-else class="fas fa-save"></i>
                    <span>{{ isEditing ? 'Update Post' : 'Save Post' }}</span>
                  </button>

                  <button
                    type="button"
                    @click="saveDraft"
                    :disabled="form.processing"
                    class="w-full px-6 py-3 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg font-medium hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors disabled:opacity-50"
                  >
                    Save as Draft
                  </button>
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
import { ref, onMounted, computed } from 'vue'
import Sidebar from '../Common/Sidebar.vue'
import Topbar from '../Common/Topbar.vue'

export default {
  name: 'BlogForm',
  components: {
    Head,
    Link,
    Sidebar,
    Topbar
  },
  props: {
    blog: {
      type: Object,
      default: null
    },
    categories: {
      type: Array,
      default: () => []
    },
    tags: {
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
    const featuredImagePreview = ref('')
    const selectedTags = ref([])
    const tagSearch = ref('')
    const showTagDropdown = ref(false)
    const filteredTags = ref([])

    // Initialize form
    const form = useForm({
      title: props.blog?.title || '',
      slug: props.blog?.slug || '',
      excerpt: props.blog?.excerpt || '',
      content: props.blog?.content || '',
      featured_image: null,
      author_name: props.blog?.author_name || '',
      author_avatar: props.blog?.author_avatar || '',
      author_role: props.blog?.author_role || 'DevOps Engineer',
      author_bio: props.blog?.author_bio || '',
      meta_title: props.blog?.meta_title || '',
      meta_description: props.blog?.meta_description || '',
      meta_keywords: props.blog?.meta_keywords || '',
      canonical_url: props.blog?.canonical_url || '',
      category_id: props.blog?.category_id || (props.categories?.length > 0 ? props.categories[0].id : null),
      tag_ids: [],
      status: props.blog?.status || 'draft',
      published_at: props.blog?.published_at ? formatDateTime(props.blog.published_at) : '',
      scheduled_at: props.blog?.scheduled_at ? formatDateTime(props.blog.scheduled_at) : '',
      featured: props.blog?.featured || false,
      sticky: props.blog?.sticky || false,
      comment_status: props.blog?.comment_status || 'open',
      ping_status: props.blog?.ping_status || true
    })

    const estimatedReadTime = computed(() => {
      if (!form.content) return 1
      const wordCount = form.content.split(/\s+/).length
      return Math.max(1, Math.ceil(wordCount / 200))
    })

    const minDateTime = computed(() => {
      const now = new Date()
      now.setMinutes(now.getMinutes() - now.getTimezoneOffset())
      return now.toISOString().slice(0, 16)
    })

    function formatDateTime(dateString) {
      const date = new Date(dateString)
      date.setMinutes(date.getMinutes() - date.getTimezoneOffset())
      return date.toISOString().slice(0, 16)
    }

    // Initialize tags
    if (props.blog?.tags) {
      selectedTags.value = props.blog.tags
      form.tag_ids = props.blog.tags.map(tag => tag.id)
    }

    // Initialize filtered tags
    filteredTags.value = props.tags || []

    // Initialize featured image preview
    if (props.blog?.featured_image) {
      featuredImagePreview.value = `/storage/${props.blog.featured_image}`
    }

    const toggleTheme = () => {
      isDark.value = !isDark.value
      if (isDark.value) {
        document.documentElement.classList.add('dark')
      } else {
        document.documentElement.classList.remove('dark')
      }
      localStorage.setItem('admin-theme', isDark.value ? 'dark' : 'light')
    }

    onMounted(() => {
      const savedTheme = localStorage.getItem('admin-theme')
      if (savedTheme === 'dark') {
        isDark.value = true
        document.documentElement.classList.add('dark')
      }
    })

    const handleSidebarToggle = (collapsed) => {
      sidebarCollapsed.value = collapsed
    }

    const generateSlug = () => {
      if (!props.isEditing || !form.slug) {
        form.slug = form.title
          .toLowerCase()
          .replace(/[^a-zA-Z0-9\s]/g, '')
          .replace(/\s+/g, '-')
          .replace(/-+/g, '-')
          .replace(/^-|-$/g, '')
      }
    }

    const searchTags = () => {
      const availableTags = props.tags || []

      if (!tagSearch.value.trim()) {
        filteredTags.value = availableTags
        showTagDropdown.value = true
        return
      }

      filteredTags.value = availableTags.filter(tag =>
        tag.name.toLowerCase().includes(tagSearch.value.toLowerCase()) &&
        !selectedTags.value.some(selected => selected.id === tag.id)
      )
      showTagDropdown.value = true
    }

    const addTag = (tag) => {
      if (!selectedTags.value.some(selected => selected.id === tag.id)) {
        selectedTags.value.push(tag)
        form.tag_ids.push(tag.id)
        tagSearch.value = ''
        showTagDropdown.value = false
        searchTags()
      }
    }

    const removeTag = (tagId) => {
      selectedTags.value = selectedTags.value.filter(tag => tag.id !== tagId)
      form.tag_ids = form.tag_ids.filter(id => id !== tagId)
      searchTags()
    }

    const handleFeaturedImageUpload = (event) => {
      const file = event.target.files[0]
      if (file) {
        form.featured_image = file
        const reader = new FileReader()
        reader.onload = (e) => {
          featuredImagePreview.value = e.target.result
        }
        reader.readAsDataURL(file)
      }
    }

    const removeFeaturedImage = () => {
      form.featured_image = null
      featuredImagePreview.value = ''
      if (props.blog?.featured_image) {
        form.featured_image = 'remove'
      }
    }

    const submit = () => {
      // Ensure category_id is not null
      if (!form.category_id && props.categories?.length > 0) {
        form.category_id = props.categories[0].id
      }

      if (props.isEditing) {
        // For updates, use POST if we have file uploads, otherwise PUT
        if (form.featured_image && form.featured_image instanceof File) {
          // Use POST for file uploads
          form.post(route('admin.blogs.update', props.blog.id))
        } else {
          // Use PUT for non-file updates
          form.put(route('admin.blogs.update', props.blog.id))
        }
      } else {
        form.post(route('admin.blogs.store'))
      }
    }

    const saveDraft = () => {
      const originalStatus = form.status
      form.status = 'draft'
      submit()
      form.status = originalStatus
    }

    // Hide dropdown when clicking outside
    const handleClickOutside = (event) => {
      if (!event.target.closest('.relative')) {
        showTagDropdown.value = false
      }
    }

    onMounted(() => {
      document.addEventListener('click', handleClickOutside)
    })

    return {
      sidebarCollapsed,
      isDark,
      form,
      featuredImagePreview,
      selectedTags,
      tagSearch,
      showTagDropdown,
      filteredTags,
      estimatedReadTime,
      minDateTime,
      handleSidebarToggle,
      toggleTheme,
      generateSlug,
      searchTags,
      addTag,
      removeTag,
      handleFeaturedImageUpload,
      removeFeaturedImage,
      submit,
      saveDraft
    }
  }
}
</script>

<style scoped>
/* Custom scrollbar for content textarea */
textarea {
  scrollbar-width: thin;
  scrollbar-color: #10b981 #f3f4f6;
}

textarea::-webkit-scrollbar {
  width: 8px;
}

textarea::-webkit-scrollbar-track {
  background: #f3f4f6;
  border-radius: 4px;
}

textarea::-webkit-scrollbar-thumb {
  background: #10b981;
  border-radius: 4px;
}

textarea::-webkit-scrollbar-thumb:hover {
  background: #059669;
}
</style>