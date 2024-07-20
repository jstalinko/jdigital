<template>
    <Title :title="props.post.title"/>
  
  <div>
    <Navbar />

    <div class="container mx-auto">
      <div class="mt-10">
        <Breadcumbs
          :breadcrumbs="[{ label: 'Beranda', href: '/' }, { label: 'Post', href: '/posts' }, { label: props.post.title, href: '?' }]" />
        <div class="flex flex-col md:flex-row mt-5 ">
          <div class="basis-3/4 container  min-h-screen rounded border-2 py-5 px-5">
            <h3 class="text-3xl font-bold montserrat mb-3 mt-3 p-3 border-b-2 ">{{ props.post.title }}</h3>

            <img :src="imageUrl(props.post.image)" :alt="props.post.title"
              class="max-w-full rounded mx-auto object-cover mb-5 " />
            <div v-html="props.post.content" class="prose md:prose-xl"></div>
          </div>
          <div class="basis-1/4 px-3 py-3">
            <div class="max-w-sm rounded overflow-hidden shadow-lg bg-gray-100">
              <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2 text-center border-b-2 p-2 montserrat">Pencarian</div>
                <input class="border-2 rounded w-full p-2 " v-model="searchQuery">
                <button class="bg-blue-500 hover:bg-blue-600 p-2 w-full rounded text-white mt-2" type="button"
                  @click="handleClick"><i class="mdi mdi-magnify"></i> Cari</button>
              </div>
            </div>
            <br>
            <Card textHeader="Tags" :Footer="props.post.tags" :url="props?.global?.currentUrl" />
            <br>
            <div class="max-w-sm rounded overflow-hidden shadow-lg bg-gray-100">
              <div class="p-2">
                <div class="font-bold text-xl mb-2 text-center border-b-2 p-2 montserrat">Post Serupa</div>
                <div class="w-full mx-auto bg-white  overflow-hidden flex border-2 rounded mb-2"
                  v-for="(post, index) in props.posts" :key="index">
                  <img class="w-1/3 object-cover rounded" :src="post.image" :alt="post.title">
                  <div class="w-2/3 p-4">
                    <Link :href="'/post/' + post.slug">
                    <h2 class="text-sm text-gray-600 font-bold mb-2  hover:text-blue-500">{{ post.title }}</h2>
                    </Link>
                  </div>
                </div>
              </div>
            </div>
            <br>
            <Card textHeader="Bagikan" textContent="Tertarik dengan produk ini? bagikan ke teman atau kerabat anda! "
              Footer="sharer" :url="props?.global?.currentUrl" />

          </div>
        </div>
      </div>
    </div>

    <Footer/>
  </div>
</template>

<script setup>
import Navbar from '../Components/Navbar.vue';
import Card from '../Components/Card.vue';
import { imageUrl } from '#helpers';
import Breadcumbs from '../Components/Breadcumbs.vue';
import Footer from '../Components/Footer.vue';
import { Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import Title from '../Components/Section/Title.vue';
defineProps({ props: Object });
const searchQuery = ref('');
const handleClick = async () => {
  router.visit('/post/search?query=' + searchQuery.value);
}
</script>
