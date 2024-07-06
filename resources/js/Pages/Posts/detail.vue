<template>
    <Navbar/>
    <div class="container mx-auto px-4 py-8">
      <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <img class="w-full h-64 object-cover object-center" :src="props.post.image" alt="Post Image">
  
        <div class="p-6">
          <h2 class="text-2xl font-bold mb-4">{{ props.post.title }}</h2>
          <div class="text-gray-600 mb-4">{{ props.post.author }}</div>
          
          <div class="prose" v-html="props.post.content"></div>
  
          <div class="mt-6">
            <span v-for="(tag, index) in props.post.tags" :key="index"
                  class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">
              #{{ tag }}
            </span>
          </div>
        </div>
      </div>
    </div>
  </template>

<script setup>
import Navbar from '../Components/Navbar.vue';

defineProps({props: Object});
</script>