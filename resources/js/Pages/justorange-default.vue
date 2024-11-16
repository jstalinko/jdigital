<template>
  <Title/>
  <div>
    <div>
  <nav class="p-4 border-b-4 border-black">
    <div class="container mx-auto flex justify-between items-center">
      <img src="/logo.png" class="w-48 hover:grayscale hover:contrast-150">
      <div class="hidden md:block">
        <Link
          class="text-black bg-yellow-400 border-2 border-black font-bold mx-2 px-3 py-2 hover:bg-yellow-500 montserrat shadow-neobrutal"
          to="#"><i class="mdi mdi-home"></i> Beranda</Link>
        <Link
          class="text-black bg-pink-400 border-2 border-black font-bold mx-2 px-3 py-2 hover:bg-pink-500 montserrat shadow-neobrutal"
          to="#productSection" @click="scrollToSection('productSection')"><i class="mdi mdi-cart"></i> Produk</Link>
        <Link
          class="text-black bg-green-400 border-2 border-black font-bold mx-2 px-3 py-2 hover:bg-green-500 montserrat shadow-neobrutal"
          to="#aboutSection" @click="scrollToSection('aboutSection')"><i class="mdi mdi-information"></i> Tentang</Link>
        <Link
          class="text-black bg-blue-400 border-2 border-black font-bold mx-2 px-3 py-2 hover:bg-blue-500 montserrat shadow-neobrutal"
          to="#serviceSection" @click="scrollToSection('serviceSection')"><i class="mdi mdi-face-agent"></i> Layanan</Link>
        <Link
          class="text-black bg-orange-400 border-2 border-black font-bold mx-2 px-3 py-2 hover:bg-orange-500 montserrat shadow-neobrutal"
          to="#contactSection" @click="scrollToSection('contactSection')"><i
          class="mdi mdi-email-heart-outline"></i> Kontak</Link>
        <Link
          class="text-black bg-purple-400 border-2 border-black font-bold mx-2 px-3 py-2 hover:bg-purple-500 montserrat shadow-neobrutal"
          to="/dashboard"><i class="mdi mdi-account"></i> Akun</Link>
       
      </div>
    </div>
  </nav>
  <section class="flex items-center justify-center h-screen bg-pink-100">
    <div class="text-center">
      <h1 class="text-black text-5xl md:text-8xl font-extrabold mb-4 montserrat border-4 border-black p-4 inline-block">
        {{ clockNow }}</h1>
        <br>
      <h1 class="text-black text-5xl md:text-8xl font-extrabold mb-4 titillium-web-bold  p-4 ">
        {{ textWelcome }}</h1>
        <br>
      <h2 class="text-black text-2xl md:text-4xl font-bold mb-4 montserrat ">
        Your digital transformation partner.</h2>
      <div>
        <Link to="/products"
          class="bg-yellow-400 border-4 border-black text-black font-bold py-3 px-6 rounded-none hover:bg-yellow-500 transition montserrat shadow-neobrutal">
          Eksplor</Link>&nbsp;&nbsp;
        <Link to="/contact"
          class="bg-transparent border-4 border-black text-black font-bold py-3 px-6 rounded-none hover:bg-black hover:text-white transition montserrat shadow-neobrutal">
          Hubungi Kami</Link>
      </div>
    </div>
    <div class="flying-cubes">
      <div v-for="i in 10" :key="i" class="cube border-2 border-black bg-gray-100"></div>
    </div>
  </section>
</div>

    <About />
    <Services />
    <Product :products="props.products" :categories="props.categories" />

    <PostSection :posts="props.posts" />
    <ContactUs />

    <Footer />
  </div>

  <CookieAlert />
  <Favorites />

  <Navbar class="block md:hidden"/>
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
import Title from './Components/Section/Title.vue';

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

/* Optional: Custom Neobrutalist shadow effect */
.shadow-neobrutal {
  box-shadow: 6px 6px 0px 0px black;
}
.shadow-neobrutal:hover{
  box-shadow: 1px 1px 0px 0px black;
}
</style>

