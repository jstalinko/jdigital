<template>
  <div class="bg-white min-h-screen">
    <div class="container mx-auto">
      <div class="text-center mb-12 mt-10">
         
         <h1 class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl montserrat">
           Post Terbaru
         </h1>
       </div>

      <div class="grid grid-cols-2 gap-4">

      <div class="w-full mx-auto bg-white  overflow-hidden flex border-2 rounded" v-for="(post,index) in posts" :key="index">
        <img class="w-1/3 object-cover rounded" :src="post.image" :alt="post.title">
        <div class="w-2/3 p-4">
            <Link :href="'/post/'+post.slug" >
            <h2 class="text-xl font-bold mb-2  hover:text-blue-500">{{ post.title }}</h2>
            <p class="text-gray-700 mb-4">{{ stripTags(post.content.substr(0,100)) }} ...</p>
            <small class="text-gray-500 px-4 py-2 text-sm"><i class="mdi mdi-calendar"></i> {{ new Date(post.created_at).toDateString() }} </small>
            </Link>
        </div>
    </div>
    </div>
    <div class="flex items-center justify-center" v-if="viewAll !== true">
      <Link href="/posts/" class="mt-10 mb-5 text-gray-600 border-2 rounded-full p-2 hover:border-black">
        Tampilkan Semua
      </Link>
    </div>
    <br><br>

    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import {stripTags} from '#helpers';
defineProps({posts: Object,viewAll: Boolean});
</script>