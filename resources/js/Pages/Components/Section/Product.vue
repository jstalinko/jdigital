<template>
  <div id="productSection">
    <section class="py-12 bg-pink-100 dark:bg-black mt-10 min-h-screen">
      <div class="p-8 container mx-auto">
        <h2 class="text-4xl font-bold text-center mb-8 titillium-web-semibold text-black dark:text-white">
          <i class="mdi mdi-cart-heart"></i> {{ headTitle ?? 'Produk Kami' }}
        </h2>

        <div class="flex flex-row justify-center gap-4 flex-wrap mb-8">
          <div
            class="bg-yellow-500 border-black border-4 rounded-lg text-black px-4 py-2 w-full text-center"
            v-show="search !== undefined"
          >
            <i class="mdi mdi-magnify"></i> Hasil pencarian: 
            <span class="font-bold underline">{{ search }}</span>
          </div>

          <Link
            class="text-black bg-pink-400 border-2 border-black font-bold mx-2 px-3 py-2 hover:bg-pink-500 montserrat shadow-neobrutal"
            v-if="activeCat !== undefined"
            href="/products"
          >
            Semua
          </Link>
          <Link
            :class="activeCat !== undefined && activeCat.slug === cat.slug
              ? 'text-black bg-yellow-400 border-2 border-black font-bold mx-2 px-3 py-2 hover:bg-yellow-500 montserrat shadow-neobrutal'
              : 'text-black bg-pink-400 border-2 border-black font-bold mx-2 px-3 py-2 hover:bg-pink-500 montserrat shadow-neobrutal'"
            v-for="(cat, index) in categories"
            :key="index"
            :href="'/product/category/' + cat.slug"
          >
            {{ cat.name }}
          </Link>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-3 mb-5">
          <div
            v-for="product in products"
            :key="product.id"
            class="bg-white border-black border-4 overflow-hidden hover:bg-gray-100 shadow-neobrutal"
          >
            <img
              :src="imageUrl(product.image)"
              :alt="product.name"
              class="w-full h-48 object-cover border-b-4 border-black"
            />
            <div class="p-4">
              <Link
                :href="'/product/' + product.slug"
                class="block text-xl font-bold text-black dark:text-white mb-4 hover:underline"
              >
                {{ product.name }}
              </Link>
              <div class="flex justify-between items-center">
                <span class="text-lg font-bold text-blue-600">{{ formatCurrency(product.price) }}</span>
                <div class="flex items-center space-x-2">
                  <Link
                    class="bg-black text-white border-4 border-black py-2 px-4  hover:bg-white hover:text-black"
                    :href="'/product/checkout/' + product.slug"
                  >
                    <i class="mdi mdi-cart"></i>
                  </Link>
                  <button
                    @click="fav(product.id, product.name, product.slug)"
                    :class="loadFavorite.find(fav => fav.id == product.id)
                      ? 'text-red-500 hover:text-gray-500'
                      : 'text-gray-500 hover:text-red-500'"
                  >
                    <i class="mdi mdi-heart text-2xl"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="flex justify-center" v-if="viewAll !== true">
          <Link
            href="/products"
            class="text-black bg-yellow-400 border-2 border-black font-bold mx-2 px-3 py-2 hover:bg-yellow-500 montserrat shadow-neobrutal"
          >
            Tampilkan Semua
          </Link>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import {
  formatCurrency,
  isFavorite,
  toggleFavorite,
  loadFavorites,
  imageUrl,
} from "#helpers";

defineProps({
  products: Object,
  categories: Object,
  headTitle: String,
  viewAll: Boolean,
  activeCat: Object,
  search: String,
});

const loadFavorite = ref([]);

const fav = async (id, name, slug) => {
  await toggleFavorite(id, name, slug);
  loadFavorite.value = loadFavorites();
};

onMounted(() => {
  loadFavorite.value = loadFavorites();
});
</script>


