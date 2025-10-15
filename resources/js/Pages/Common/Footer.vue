<template>
  <!-- Footer -->
  <footer class="bg-gray-800 dark:bg-gray-900 text-white py-12">
    <div class="max-w-7xl mx-auto px-4">
      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
        <!-- Company Info -->
        <div>
          <div class="flex items-center space-x-2 mb-4">
            <div class="w-8 h-8 gradient-btn rounded flex items-center justify-center">
              <i class="fas fa-code-branch text-white text-sm"></i>
            </div>
            <h3 class="text-lg font-bold">DevOps Jungle</h3>
          </div>
          <p class="text-sm text-gray-400 mb-4">Master DevOps skills with our comprehensive training platform. Your journey to DevOps excellence starts here.</p>
          <div class="flex space-x-4">
            <a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">
              <i class="fab fa-facebook text-lg"></i>
            </a>
            <a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">
              <i class="fab fa-twitter text-lg"></i>
            </a>
            <a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">
              <i class="fab fa-linkedin text-lg"></i>
            </a>
            <a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">
              <i class="fab fa-youtube text-lg"></i>
            </a>
          </div>
        </div>

        <!-- Quick Links -->
        <div>
          <h4 class="font-bold mb-4">Quick Links</h4>
          <ul class="space-y-2 text-sm">
            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">About Us</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Courses</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Certifications</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Practice Labs</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Blog</a></li>
          </ul>
        </div>

        <!-- Support -->
        <div>
          <h4 class="font-bold mb-4">Support</h4>
          <ul class="space-y-2 text-sm">
            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Help Center</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Contact Us</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">FAQ</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Community</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Forums</a></li>
          </ul>
        </div>

        <!-- Contact -->
        <div>
          <h4 class="font-bold mb-4">Contact Info</h4>
          <div class="space-y-2 text-sm text-gray-400">
            <div class="flex items-center">
              <i class="fas fa-envelope mr-2"></i>
              support@devopsjungle.com
            </div>
            <div class="flex items-center">
              <i class="fas fa-phone mr-2"></i>
              +1 (555) 123-4567
            </div>
            <div class="flex items-center">
              <i class="fas fa-map-marker-alt mr-2"></i>
              123 DevOps Street, Tech City
            </div>
          </div>
        </div>
      </div>

      <!-- Bottom Footer -->
      <div class="border-t border-gray-700 pt-8 flex flex-col md:flex-row justify-between items-center">
        <p class="text-sm text-gray-400">© 2024 DevOps Jungle. All rights reserved.</p>
        <div class="flex space-x-6 mt-4 md:mt-0">
          <a href="#" class="text-sm text-gray-400 hover:text-white transition-colors">Privacy Policy</a>
          <a href="#" class="text-sm text-gray-400 hover:text-white transition-colors">Terms of Service</a>
          <a href="#" class="text-sm text-gray-400 hover:text-white transition-colors">Cookie Policy</a>
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  name: 'DevOpsFooter'
}
</script>