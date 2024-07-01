<template>
    <div class="container  mx-auto">
      <div v-for="post in posts" :key="post.id" class="bg-white shadow-md mb-4 rounded-lg p-4">
        <h2 class="text-xl font-semibold mb-2">{{ post.title }}</h2>
        <p class="text-gray-600 mb-4">{{ post.body }}</p>
        <div class="flex justify-end">
          <button class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
            Read More
          </button>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  
  const posts = ref([
    { id: 1, title: 'Post Title 1', body: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' },
    { id: 2, title: 'Post Title 2', body: 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' },
    { id: 3, title: 'Post Title 3', body: 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.' },
    // Tambahkan lebih banyak data post di sini
  ]);
  </script>
  
  <style>
  /* Optional: tambahkan gaya tambahan jika diperlukan */
  </style>
  