<template>
    <nav class="bg-white p-4 shadow-md">
      <div class="container mx-auto flex justify-between items-center">
        <img src="/logo.png" class="w-32 md:w-48" alt="Logo">
  
        <!-- Tombol Toggle untuk Menu Mobile -->
        <button @click="menuOpen = !menuOpen"
                class="md:hidden text-gray-600 focus:outline-none">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
               xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 6h16M4 12h16m-7 6h7"></path>
          </svg>
        </button>
  
        <!-- Daftar Menu -->
        <div :class="menuOpen ? 'block' : 'hidden md:flex md:items-center md:space-x-6'">
          <Link href="/" class="text-blue-500 font-bold hover:underline montserrat">
            <i class="mdi mdi-home"></i> Beranda
          </Link>
          <Link href="/products" class="text-blue-500 font-bold hover:underline montserrat" >
            <i class="mdi mdi-cart"></i> Produk
          </Link>
          <Link href="/about" class="text-blue-500 font-bold hover:underline montserrat">
            <i class="mdi mdi-information"></i> Tentang
          </Link>
          <Link href="/post" class="text-blue-500 font-bold hover:underline montserrat">
            <i class="mdi mdi-face-agent"></i> Post
          </Link>
          <Link href="/contact" class="text-blue-500 font-bold hover:underline montserrat">
            <i class="mdi mdi-email-heart-outline"></i> Kontak
          </Link>
          <a href="/dashboard" class="text-blue-500 font-bold hover:underline montserrat">
            <i class="mdi mdi-account"></i> Akun
          </a>
        </div>
      </div>
    </nav>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { Link } from '@inertiajs/vue3'; // Pastikan import Link dari Inertia
  
  const menuOpen = ref(false);
  
  function scrollToSection(sectionId) {
    // Implementasi fungsi scrollToSection sesuai kebutuhan Anda
    console.log(`Scroll to section: ${sectionId}`);
  }
  </script>
  
  <style scoped>
  /* Tambahkan styling tambahan di sini jika diperlukan */
  </style>
  