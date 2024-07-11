<template>
  <div>
    <button 
      @click="toggleFavorites"
      class="fixed bottom-4 right-4 bg-red-500 text-white px-5 py-4 rounded-full shadow-lg hover:bg-red-600"
    >
      <i class="mdi mdi-heart"></i>
    </button>
    
    <div v-if="showFavorites" class="fixed bottom-20 right-4 bg-white border p-4 rounded-lg shadow-lg w-64 max-h-64 overflow-y-auto">
      <h3 class="text-lg font-bold mb-2">Produk Favorit</h3>
      <ul>
        <li v-for="product in favorites" :key="product" class="mb-2 hover:bg-gray-300 p-1 rounded cursor-pointer">
            <Link :href="'/product/'+product.slug"><span>{{ product.name }}</span></Link>
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import Cookies from 'js-cookie';

const showFavorites = ref(false);
const favorites = ref([]);

const toggleFavorites = () => {
  showFavorites.value = !showFavorites.value;
};

const getFavoritesFromCookies = () => {
  const favoritesCookie = Cookies.get('favorites');
  if (favoritesCookie) {
    favorites.value = JSON.parse(favoritesCookie);
  }
};
setInterval(function(){
    const favoritesCookie = Cookies.get('favorites');
  if (favoritesCookie) {
    favorites.value = JSON.parse(favoritesCookie);

  }
},20000);

onMounted(() => {
  getFavoritesFromCookies();
});
</script>