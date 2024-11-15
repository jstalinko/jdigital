<template>
  <header class="bg-white border-4 border-black">
    <div class="container mx-auto flex justify-between items-center h-16 px-4 sm:px-6 lg:px-8">
      <!-- Logo -->
      <img 
        src="/logo.png" 
        alt="Home" 
        class="w-48 hover:grayscale hover:contrast-150 cursor-pointer"
      />

      <!-- Navigation -->
      <div class="hidden md:flex items-center space-x-3">
        <Link
          class="text-black bg-yellow-400 border-2 border-black font-bold px-3 py-2 hover:bg-yellow-500 montserrat shadow-neobrutal"
          href="/?ref=nav_home"
        >
          🏠 Beranda
        </Link>
        <Link
          class="text-black bg-pink-400 border-2 border-black font-bold px-3 py-2 hover:bg-pink-500 montserrat shadow-neobrutal"
          href="#productSection"
        >
          🛒 Produk
        </Link>
        <Link
          class="text-black bg-green-400 border-2 border-black font-bold px-3 py-2 hover:bg-green-500 montserrat shadow-neobrutal"
          href="#aboutSection"
        >
          ℹ️ Tentang
        </Link>
        <Link
          class="text-black bg-blue-400 border-2 border-black font-bold px-3 py-2 hover:bg-blue-500 montserrat shadow-neobrutal"
          href="#serviceSection"
        >
          🛠️ Layanan
        </Link>
        <Link
          class="text-black bg-orange-400 border-2 border-black font-bold px-3 py-2 hover:bg-orange-500 montserrat shadow-neobrutal"
          href="#contactSection"
        >
          📞 Kontak
        </Link>
        <Link
          class="text-black bg-purple-400 border-2 border-black font-bold px-3 py-2 hover:bg-purple-500 montserrat shadow-neobrutal"
          href="/dashboard"
        >
          🔑 Akun
        </Link>
        <button 
          @click="toggleDarkMode" 
          class="ml-3 px-4 py-2 border-2 border-black bg-gray-300 hover:bg-gray-400"
        >
          <i :class="isDarkMode ? 'mdi mdi-weather-sunny text-yellow-500' : 'mdi mdi-weather-night text-black'"></i>
        </button>
      </div>

      <!-- Mobile Menu Button -->
      <button 
        class="block md:hidden border-4 border-black p-2 bg-white hover:bg-gray-200 shadow-neobrutal"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-6 w-6"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
          stroke-width="2"
        >
          <path 
            stroke-linecap="round" 
            stroke-linejoin="round" 
            d="M4 6h16M4 12h16M4 18h16" 
          />
        </svg>
      </button>
    </div>
  </header>
</template>

<style>
/* Optional: Neobrutalist shadows for buttons */
.shadow-neobrutal {
  box-shadow: 6px 6px 0px 0px black;
}
.shadow-neobrutal:hover {
  box-shadow: 2px 2px 0px 0px black;
}
.montserrat {
  font-family: 'Montserrat', sans-serif;
}
</style>

<script setup>
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";

const isDarkMode = ref(false);

const toggleDarkMode = () => {
  isDarkMode.value = !isDarkMode.value;
  document.documentElement.classList.toggle("dark", isDarkMode.value);
};
</script>
