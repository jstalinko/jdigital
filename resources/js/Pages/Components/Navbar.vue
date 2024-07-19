<template>
  <nav class=" p-4 shadow-md" >
    <div class="container mx-auto flex justify-between items-center">
      <img src="/logo.png" class="w-32 md:w-48 dark:contrast-200" alt="Logo JavaraDigital">
      <!-- Daftar Menu -->
      <div class="hidden md:flex md:items-center md:space-x-6" >
        <Link href="/" class="text-blue-500 dark:text-[#BCCCDC] font-bold hover:underline montserrat">
        <i class="mdi mdi-home"></i> Beranda
        </Link>
        <Link href="/products" class="text-blue-500 dark:text-[#BCCCDC] font-bold hover:underline montserrat">
        <i class="mdi mdi-cart"></i> Produk
        </Link>
        <Link href="/about" class="text-blue-500 dark:text-[#BCCCDC] font-bold hover:underline montserrat">
        <i class="mdi mdi-information"></i> Tentang
        </Link>
        <Link href="/post" class="text-blue-500 dark:text-[#BCCCDC] font-bold hover:underline montserrat">
        <i class="mdi mdi-face-agent"></i> Post
        </Link>
        <Link href="/contact" class="text-blue-500 dark:text-[#BCCCDC] font-bold hover:underline montserrat">
        <i class="mdi mdi-email-heart-outline"></i> Kontak
        </Link>
        <a href="/dashboard" class="text-blue-500 dark:text-[#BCCCDC] font-bold hover:underline montserrat">
          <i class="mdi mdi-account"></i> Akun
        </a>
        <button @click="toggleDarkMode" class="ml-3 p-2 rounded bg-gray-200 dark:bg-gray-700">
          <i :class="isDarkMode ? 'mdi mdi-weather-sunny text-yellow-500' : 'mdi mdi-weather-night'"></i>
        </button>
      </div>

      <div class="fixed bottom-0 left-0 right-0 bg-white dark:bg-gray-800 shadow-lg md:hidden flex justify-around py-2  rounded">
        <Link href="/"
          class="text-blue-500 dark:text-[#BCCCDC] font-bold hover:underline montserrat flex flex-col items-center">
        <i class="mdi mdi-home text-2xl"></i>
        <span>Beranda</span>
        </Link>
        <Link href="/products"
          class="text-blue-500 dark:text-[#BCCCDC] font-bold hover:underline montserrat flex flex-col items-center">
        <i class="mdi mdi-cart text-2xl"></i>
        <span>Produk</span>
        </Link>
        
        <Link href="/post"
          class="text-blue-500 dark:text-[#BCCCDC] font-bold hover:underline montserrat flex flex-col items-center">
        <i class="mdi mdi-face-agent text-2xl"></i>
        <span>Post</span>
        </Link>
        <Link href="/contact"
          class="text-blue-500 dark:text-[#BCCCDC] font-bold hover:underline montserrat flex flex-col items-center">
        <i class="mdi mdi-email-heart-outline text-2xl"></i>
        <span>Kontak</span>
        </Link>
        <a href="/dashboard"
          class="text-blue-500 dark:text-[#BCCCDC] font-bold hover:underline montserrat flex flex-col items-center">
          <i class="mdi mdi-account text-2xl"></i>
          <span>Akun</span>
        </a>
       
      </div>
    </div>
  </nav>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3'; // Pastikan import Link dari Inertia



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

onMounted(() => {
  if (localStorage.getItem('theme') === 'dark') {
    isDarkMode.value = true;
    document.documentElement.classList.add('dark');
  }
});

</script>

<style scoped>
/* Tambahkan styling tambahan di sini jika diperlukan */
</style>