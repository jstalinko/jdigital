<template>
   <div id="productSection">
    <section class="py-12 bg-gray-100 mt-10 min-h-screen" >
      <div class="container mx-auto">
        <h2 class="text-3xl font-bold text-center mb-8 titillium-web-semibold"><i class="mdi mdi-cart-heart"></i> {{ headTitle ?? 'Produk Kami'}}</h2>

        <div class="flex flex-row justify-center gap-2 flex-wrap mb-5">

          <div class="bg-blue-500 rounded text-white p-4 px-4 w-full m-4 text-md montserrat" v-show="search !== undefined">
            <i class="mdi mdi-magnify"></i> Hasil pencarian  : <span class="font-bold underline"> {{search }}</span>
          </div>
       
              <Link class="bg-blue-500 p-2 px-4 rounded-full text-white shadow-sm hover:bg-blue-600" v-if="activeCat !== undefined" href="/products">Semua</Link>
          
          <Link :class="activeCat !== undefined && activeCat.slug == cat.slug ? 'bg-white p-2 px-4 rounded-full text-blue-500 outline shadow-sm hover:bg-blue-500 hover:text-white' : 'bg-blue-500 p-2 px-4 rounded-full text-white shadow-sm hover:bg-blue-600'"  v-for="(cat,index) in categories" :key="index" :href="'/product/category/'+cat.slug">{{ cat.name }}</Link>
       
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-4 gap-8 mb-5">
          <div v-for="product in products" :key="product.id" class="rounded-lg border-2 border-gray-200 overflow-hidden hover:shadow-md">
         
            <img :src="imageUrl(product.image)" :alt="product.name" class="w-full h-48 object-cover">
            <div class="p-4">
              <Link :href="'/product/'+product.slug"> <span class="text-xl font-semibold mb-2 hover:text-blue-400 hover:underline">{{ product.name }}</span>     </Link>
          
              <div class="flex justify-between items-center">
                <span class="text-blue-500 font-bold text-lg ">{{ formatCurrency(product.price) }}</span>
                <div class="items-end space-x-2">
                <Link class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-300" :href="'/product/checkout/'+product.slug"><i class="mdi mdi-cart"></i></Link>
                <button @click="fav(product.id , product.name,product.slug)" :class="loadFavorite.find(fav => fav.id == product.id) ? 'bg-transparent text-red-500 hover:text-gray-500' : 'bg-transparent text-gray-400 hover:text-red-500'"><i class="mdi mdi-heart text-2xl"></i></button>
              </div>
              </div>
            </div>
     
          </div>
        </div>
  
      
        <div class="flex items-center justify-center" v-if="viewAll !== true">
      <Link href="/products" class="mt-10 mb-5 text-gray-600 border-2 rounded-full p-2 hover:border-black">
        Tampilkan Semua
      </Link>
    </div>      
      </div>
     
    </section>
   </div>
  </template>
  
  <script setup>
  import {Link} from '@inertiajs/vue3';
  import {watch,ref,onMounted} from 'vue';
  import {formatCurrency,isFavorite,toggleFavorite,loadFavorites , imageUrl} from '#helpers';
  defineProps({products: Object,categories: Object , headTitle: String,viewAll: Boolean , activeCat: Object,search: String });

  const loadFavorite = ref([]);
  
  const fav = async(id,name,slug) => {
      await toggleFavorite(id,name,slug);
      loadFavorite.value = loadFavorites();
  }
  onMounted(async () => {
    loadFavorite.value = loadFavorites();
  });
  </script>
