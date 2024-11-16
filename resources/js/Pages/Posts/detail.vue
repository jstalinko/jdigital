<template>
  <div class="bg-yellow-200 min-h-screen">
      <Title :title="props.post.title" />
      <div>
          <Navbar />
          <div class="container mx-auto">
              <div class="mt-10">
                  <Breadcumbs
                      :breadcrumbs="[{ label: 'Beranda', href: '/' }, { label: 'Post', href: '/posts' }, { label: props.post.title, href: '?' }]"
                  />
                  <div class="flex flex-col md:flex-row mt-5">
                      <!-- Main Post Section -->
                      <div class="basis-3/4 container min-h-screen bg-white border-4 border-black  shadow-neobrutal p-5">
                          <h3 class="text-3xl font-bold montserrat mb-3 mt-3 p-3 border-b-4 border-black">
                              {{ props.post.title }}
                          </h3>
                          <img
                              :src="imageUrl(props.post.image)"
                              :alt="props.post.title"
                              class="max-w-full  mx-auto object-cover mb-5 border-4 border-black"
                          />
                          <div v-html="props.post.content" class="prose md:prose-xl"></div>
                      </div>

                      <!-- Sidebar -->
                      <div class="basis-1/4 px-3 py-3">
                          <!-- Search Section -->
                          <div class="bg-white border-4 border-black  shadow-neobrutal p-4">
                              <div class="font-bold text-xl text-center mb-2 border-b-4 border-black pb-2 montserrat">
                                  Pencarian
                              </div>
                              <input
                                  class="border-4 border-black p-2 w-full  focus:outline-none focus:ring-4 focus:ring-black"
                                  v-model="searchQuery"
                              />
                              <button
                                  class="bg-blue-500 hover:bg-blue-600 border-4 border-black p-2 w-full  mt-3 text-white shadow-neobrutal"
                                  type="button"
                                  @click="handleClick"
                              >
                                  <i class="mdi mdi-magnify"></i> Cari
                              </button>
                          </div>

                          <!-- Tags Section -->
                          <Card
                              textHeader="Tags"
                              :Footer="props.post.tags"
                              :url="props?.global?.currentUrl"
                              class="mt-4"
                          />

                          <!-- Related Posts Section -->
                          <div class="bg-white border-4 border-black  shadow-neobrutal p-4 mt-4">
                              <div class="font-bold text-xl text-center mb-2 border-b-4 border-black pb-2 montserrat">
                                  Post Serupa
                              </div>
                              <div
                                  class="bg-gray-200 border-4 border-black  shadow-neobrutal mb-3 flex overflow-hidden"
                                  v-for="(post, index) in props.posts"
                                  :key="index"
                              >
                                  <img
                                      class="w-1/3 object-cover border-r-4 border-black"
                                      :src="post.image"
                                      :alt="post.title"
                                  />
                                  <div class="w-2/3 p-4">
                                      <Link :href="'/post/' + post.slug">
                                          <h2 class="text-sm text-black font-bold hover:text-blue-500">
                                              {{ post.title }}
                                          </h2>
                                      </Link>
                                  </div>
                              </div>
                          </div>

                          <!-- Share Section -->
                          <Card
                              textHeader="Bagikan"
                              textContent="Tertarik dengan produk ini? bagikan ke teman atau kerabat anda!"
                              Footer="sharer"
                              :url="props?.global?.currentUrl"
                              class="mt-4"
                          />
                      </div>
                  </div>
              </div>
          </div>
          <Footer />
      </div>
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
};
</script>

<style scoped>
.shadow-neobrutal {
  box-shadow: 8px 8px 0px 0px #000;
}
</style>
