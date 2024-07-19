<template>
  <div>
    <nav class="p-4">
      <div class="container mx-auto flex justify-between items-center ">
        <img src="/logo.png" class="w-48 dark:contrast-200">
        <div class="hidden md:block">
          <a class="dark:text-[#BCCCDC] text-blue-500 font-bold hover:underline mx-3 montserrat" href="#"><i
              class="mdi mdi-home"></i>
            Beranda</a>
          <Link class="dark:text-[#BCCCDC] text-blue-500 font-bold hover:underline mx-3 montserrat"
            href="#productSection" @click="scrollToSection('productSection')"><i class="mdi mdi-cart"></i>
          Produk</Link>

          <Link class="dark:text-[#BCCCDC] text-blue-500 font-bold hover:underline mx-3 montserrat" href="#aboutSection"
            @click="scrollToSection('aboutSection')"><i class="mdi mdi-information"></i> Tentang</Link>
          <Link class="dark:text-[#BCCCDC] text-blue-500 font-bold hover:underline mx-3 montserrat"
            href="#serviceSection" @click="scrollToSection('serviceSection')"><i class="mdi mdi-face-agent"></i>
          Layanan</Link>
          <Link class="dark:text-[#BCCCDC] text-blue-500 font-bold hover:underline mx-3 montserrat"
            href="#contactSection" @click="scrollToSection('contactSection')"><i
            class="mdi mdi-email-heart-outline"></i> Kontak</Link>
          <a class="dark:text-[#BCCCDC] text-blue-500 font-bold hover:underline mx-3 montserrat" href="/dashboard"><i
              class="mdi mdi-account"></i>
            Akun</a>
          <button @click="toggleDarkMode" class="ml-3 p-2 rounded bg-gray-200 dark:bg-gray-700">
            <i :class="isDarkMode ? 'mdi mdi-weather-sunny text-yellow-500' : 'mdi mdi-weather-night'"></i>
          </button>
        </div>
      </div>
    </nav>
    <section class="flex items-center justify-center h-screen">
      <div class="text-center">
        <h1 class="dark:text-[#BCCCDC] text-gray-600 text-4xl md:text-7xl font-semibold mb-4 animate-pulse montserrat">{{ clockNow
          }}</h1>
        <h1 class="dark:text-[#BCCCDC] text-gray-600 text-4xl md:text-7xl font-bold mb-4 animate-fade-in titillium-web-bold">{{
          textWelcome }}
        </h1>
        <h2 class="dark:text-[#BCCCDC] text-gray-500 text-2xl mb-3 animate-fade-in-delay montserrat">Your digital
          transformation partner.
        </h2>
        <div>
          <Link href="/products"
            class="dark:bg-blue-400 bg-blue-500 text-white font-bold py-2 px-4 rounded mr-4 hover:bg-gray-500 transition duration-300 montserrat cursor-pointer">
          Eksplor</Link>
          <Link href="/contact"
            class="bg-transparent dark:text-blue-400 text-blue-500 font-bold py-2 px-4 rounded hover:bg-gray-500 hover:text-white transition duration-300 montserrat">
          Hubungi
          Kami</Link>
        </div>
      </div>
      <div class="flying-cubes ">
        <div v-for="i in 10" :key="i" class="cube"></div>
      </div>
    </section>
    <About />
    <Services />
    <Product :products="props.products" :categories="props.categories" />

    <PostSection :posts="props.posts" />
    <ContactUs />

    <Footer />
  </div>

  <CookieAlert />
  <Favorites />

  <Navbar :mobileOnly="true"/>
</template>

<script setup>
import Product from './Components/Section/Product.vue';
import About from './Components/Section/About.vue';
import Services from './Components/Section/Services.vue';
import ContactUs from './Components/Section/ContactUs.vue';
import CookieAlert from './Components/Section/CookieAlert.vue';
import PostSection from './Components/Section/PostSection.vue';
import Favorites from './Components/Favorites.vue';
import Footer from './Components/Footer.vue';
import Navbar from './Components/Navbar.vue';
import { ref, onMounted, onUnmounted } from 'vue';
import { Link } from '@inertiajs/vue3';

defineProps({ props: Object });

const clockNow = ref('00:00:00');
const textWelcome = ref('Welcome to JavaraDigital');
const texts = [
  'Cari jasa pengembang web?',
  'Cari pengembang aplikasi?',
  'Konsultasi masalah TI?',
  'Welcome to JavaraDigital'
];
let currentIndex = 0;

const updateText = () => {
  textWelcome.value = texts[currentIndex];
  currentIndex = (currentIndex + 1) % texts.length;
};

const isDarkMode = ref(false);

const toggleDarkMode = () => {
  isDarkMode.value = !isDarkMode.value;
  if (isDarkMode.value) {
    document.documentElement.classList.add('dark');
    localStorage.setItem('theme', 'dark');
  } else {
    document.documentElement.classList.remove('dark');
    localStorage.setItem('theme', 'light');
  }
};

const updateClock = () => {
  const now = new Date();
  const hours = String(now.getHours()).padStart(2, '0');
  const minutes = String(now.getMinutes()).padStart(2, '0');
  const seconds = String(now.getSeconds()).padStart(2, '0');
  clockNow.value = `${hours}:${minutes}:${seconds}`;
}
const scrollToSection = (id) => {
  const element = document.getElementById(id);
  if (element) {
    element.scrollIntoView({ behavior: 'smooth' });
  }
};
onMounted(() => {
  updateClock();
  updateText();
  setInterval(updateClock, 1000);
  setInterval(updateText, 3000);
  if (localStorage.getItem('theme') === 'dark') {
    isDarkMode.value = true;
    document.documentElement.classList.add('dark');
  }
});
onUnmounted(() => {
  clearInterval(updateText)
});

</script>

<style scoped>
body {
  font-family: Arial, sans-serif
}

@keyframes fade-in {
  0% {
    opacity: 0
  }

  100% {
    opacity: 1
  }
}

.animate-fade-in {
  animation: 2s ease-in-out fade-in
}

.animate-fade-in-delay {
  animation: 3s ease-in-out fade-in
}

.flying-cubes {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
  z-index: -60;
}

.cube {
  position: absolute;
  width: 50px;
  height: 50px;
  background: #00f;
  animation: 15s linear infinite fly;
  border-radius: 10px;
  box-shadow: 10px 10px 10px #333
}

.cube:nth-child(2n) {
  background: #000
}

.cube:nth-child(3n) {
  background: #00f
}

@keyframes fly {
  0% {
    transform: translate3d(0, 0, 0);
    opacity: 1
  }

  100% {
    transform: translate3d(-100vw, 100vh, 0);
    opacity: 0
  }
}

.cube:first-child {
  top: 20%;
  left: 10%;
  animation-duration: 18s
}

.cube:nth-child(2) {
  top: 30%;
  left: 30%;
  animation-duration: 20s
}

.cube:nth-child(3) {
  top: 40%;
  left: 50%;
  animation-duration: 22s
}

.cube:nth-child(4) {
  top: 50%;
  left: 70%;
  animation-duration: 24s
}

.cube:nth-child(5) {
  top: 60%;
  left: 90%;
  animation-duration: 26s
}

.cube:nth-child(6) {
  top: 70%;
  left: 10%;
  animation-duration: 28s
}

.cube:nth-child(7) {
  top: 80%;
  left: 30%;
  animation-duration: 30s
}

.cube:nth-child(8) {
  top: 90%;
  left: 50%;
  animation-duration: 32s
}

.cube:nth-child(9) {
  top: 10%;
  left: 70%;
  animation-duration: 34s
}

.cube:nth-child(10) {
  top: 20%;
  left: 90%;
  animation-duration: 36s
}
</style>