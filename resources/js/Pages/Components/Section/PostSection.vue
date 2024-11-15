<template>
  <div class="min-h-screen bg-white dark:bg-black bg-yellow-100 p-8">
    <div class="container mx-auto">
      <div class="text-center mb-12 mt-10">
        <h1 class="text-4xl font-extrabold text-black dark:text-white montserrat">
          Post Terbaru
        </h1>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 px-3">
        <div
          class="w-full flex border-4 border-black  overflow-hidden bg-white dark:bg-gray-800 shadow-neobrutal"
          v-for="(post, index) in posts"
          :key="index"
        >
          <img class="w-1/3 object-cover border-r-4 border-black" :src="imageUrl(post.image)" :alt="post.title" />
          <div class="w-2/3 p-4 flex flex-col justify-between">
            <div>
              <Link :href="'/post/' + post.slug">
                <h2 class="text-2xl font-bold text-black dark:text-white mb-2 hover:underline">
                  {{ post.title }}
                </h2>
              </Link>
              <p class="text-black dark:text-gray-300 mb-4">
                {{ stripTags(post.content.substr(0, 100)) }} ...
              </p>
            </div>
            <small class="text-gray-700 dark:text-gray-400 text-sm">
              <i class="mdi mdi-calendar"></i> {{ new Date(post.created_at).toDateString() }}
            </small>
          </div>
        </div>
      </div>

      <div v-if="posts.length < 1" class="mt-12">
        <div class="w-full mx-auto bg-red-500 text-white border-4 border-black  flex items-center justify-center p-10">
          <h1 class="text-4xl font-extrabold montserrat">Tidak ada data.</h1>
        </div>
      </div>

      <div class="flex items-center justify-center" v-if="viewAll !== true">
        <Link
          href="/posts/"
          class="mt-10 mb-5 px-4 py-2  border-4 border-black text-black dark:text-white bg-yellow-400 hover:bg-yellow-500"
        >
          Tampilkan Semua
        </Link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { stripTags, imageUrl } from "#helpers";
defineProps({ posts: Object, viewAll: Boolean });
</script>

<style scoped>


img {
  transition: transform 0.3s ease;
}

img:hover {
  transform: scale(1.05);
}
</style>
