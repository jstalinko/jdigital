<template>
  <header class="bg-white border-4 border-black">
    <div class="container mx-auto flex justify-between items-center h-16 px-4 sm:px-6 lg:px-8">
      <!-- Logo -->
      <img 
        src="/logo.png" 
        alt="Home" 
        class="w-48 hover:grayscale hover:contrast-150 cursor-pointer"
      />

      <!-- Navigation (Desktop) -->
      <div class="hidden md:flex items-center space-x-3">
        <Link
          class="text-black bg-yellow-400 border-2 border-black font-bold px-3 py-2 hover:bg-yellow-500 montserrat shadow-neobrutal"
          href="/?ref=nav_home"
        >
          🏠 Beranda
        </Link>
        <Link
          class="text-black bg-pink-400 border-2 border-black font-bold px-3 py-2 hover:bg-pink-500 montserrat shadow-neobrutal"
          href="/products"
        >
          🛒 Produk
        </Link>
        <Link
          class="text-black bg-green-400 border-2 border-black font-bold px-3 py-2 hover:bg-green-500 montserrat shadow-neobrutal"
          href="/about"
        >
          ℹ️ Tentang
        </Link>
        <Link
          class="text-black bg-orange-400 border-2 border-black font-bold px-3 py-2 hover:bg-orange-500 montserrat shadow-neobrutal"
          href="/contact"
        >
          📞 Kontak
        </Link>
        <Link
          class="text-black bg-purple-400 border-2 border-black font-bold px-3 py-2 hover:bg-purple-500 montserrat shadow-neobrutal"
          href="/posts"
        >
          📰 Blog
        </Link>
        <Link
          class="text-black bg-purple-400 border-2 border-black font-bold px-3 py-2 hover:bg-purple-500 montserrat shadow-neobrutal"
          href="/dashboard"
        >
          🔑 Akun
        </Link>
      </div>

      <!-- Mobile Menu Button -->
      <button 
        @click="toggleMenu" 
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

    <!-- Mobile Menu (Dropdown) -->
    <div 
      v-if="menuOpen" 
      class="md:hidden bg-white border-t-4 border-black py-3 px-4 shadow-neobrutal"
    >
      <Link
        class="block text-black bg-yellow-400 border-2 border-black font-bold px-3 py-2 my-2 hover:bg-yellow-500 montserrat shadow-neobrutal"
        href="/?ref=nav_home"
      >
        🏠 Beranda
      </Link>
      <Link
        class="block text-black bg-pink-400 border-2 border-black font-bold px-3 py-2 my-2 hover:bg-pink-500 montserrat shadow-neobrutal"
        href="/products"
      >
        🛒 Produk
      </Link>
      <Link
        class="block text-black bg-green-400 border-2 border-black font-bold px-3 py-2 my-2 hover:bg-green-500 montserrat shadow-neobrutal"
        href="/about"
      >
        ℹ️ Tentang
      </Link>
      <Link
        class="block text-black bg-orange-400 border-2 border-black font-bold px-3 py-2 my-2 hover:bg-orange-500 montserrat shadow-neobrutal"
        href="/contact"
      >
        📞 Kontak
      </Link>
      <Link
        class="block text-black bg-purple-400 border-2 border-black font-bold px-3 py-2 my-2 hover:bg-purple-500 montserrat shadow-neobrutal"
        href="/posts"
      >
        📰 Blog
      </Link>
      <Link
        class="block text-black bg-purple-400 border-2 border-black font-bold px-3 py-2 my-2 hover:bg-purple-500 montserrat shadow-neobrutal"
        href="/dashboard"
      >
        🔑 Akun
      </Link>
    </div>
  </header>
</template>

<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";

const menuOpen = ref(false);

const toggleMenu = () => {
  menuOpen.value = !menuOpen.value;
};
</script>

<style scoped>
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
