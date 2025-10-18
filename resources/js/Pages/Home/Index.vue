<template>
  <div class="bg-white text-gray-700 transition-colors duration-200" data-theme="light">
    <!-- Include AOS -->
    <Head>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    </Head>

    <!-- Header -->
    <DevOpsHeader />

    <!-- Main Content -->
    <main>
      <HeroSection />
      <StatsSection />
      <FeaturedCourses />
      <WhyChooseUs />
      <ExamDumps />
      <Testimonials />
      <PartnerLogos />
      <Newsletter />
    </main>

    <!-- Footer -->
    <DevOpsFooter />
  </div>
</template>

<script>
import { Head } from '@inertiajs/vue3';
import DevOpsHeader from '../Common/Header.vue';
import DevOpsFooter from '../Common/Footer.vue';
import HeroSection from './Components/HeroSection.vue';
import StatsSection from './Components/StatsSection.vue';
import FeaturedCourses from './Components/FeaturedCourses.vue';
import WhyChooseUs from './Components/WhyChooseUs.vue';
import ExamDumps from './Components/ExamDumps.vue';
import Testimonials from './Components/Testimonials.vue';
import PartnerLogos from './Components/PartnerLogos.vue';
import Newsletter from './Components/Newsletter.vue';

export default {
  name: 'HomePage',
  components: {
    Head,
    DevOpsHeader,
    DevOpsFooter,
    HeroSection,
    StatsSection,
    FeaturedCourses,
    WhyChooseUs,
    ExamDumps,
    Testimonials,
    PartnerLogos,
    Newsletter
  },
  mounted() {
    // Load AOS library dynamically
    this.loadAOS();
  },
  methods: {
    loadAOS() {
      // Check if AOS is already loaded
      if (typeof window.AOS !== 'undefined') {
        window.AOS.init({
          duration: 800,
          easing: 'ease-out',
          once: true
        });
        return;
      }

      // Load AOS script dynamically
      const script = document.createElement('script');
      script.src = 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js';
      script.onload = () => {
        if (typeof window.AOS !== 'undefined') {
          window.AOS.init({
            duration: 800,
            easing: 'ease-out',
            once: true
          });
        }
      };
      document.head.appendChild(script);
    }
  }
}
</script>