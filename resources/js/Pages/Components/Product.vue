<template>
   <div>
    <section class="py-12 bg-gray-100 mt-10 h-screen">
      <div class="container mx-auto">
        <h2 class="text-3xl font-bold text-center mb-8 titillium-web-semibold"><i class="mdi mdi-cart-heart"></i> Our Products</h2>

        <div class="flex flex-row justify-center gap-2 flex-wrap mb-5">
          <button class="bg-blue-500 p-2 px-4 rounded-full text-white shadow-sm hover:bg-blue-600" v-for="(cat,index) in categories" :key="index">{{ cat.name }}</button>
       
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-4 gap-8 mb-5">
          <div v-for="product in products" :key="product.id" class="rounded-lg border-2 border-gray-200 overflow-hidden hover:shadow-md">
            <Link :href="'/product/'+product.slug">
            <img :src="product.image" :alt="product.name" class="w-full h-48 object-cover">
            <div class="p-4">
              <span class="text-xl font-semibold mb-2 hover:text-blue-400 hover:underline">{{ product.name }}</span>
          
              <div class="flex justify-between items-center">
                <span class="text-blue-500 font-bold text-lg ">{{ product.price }}</span>
                <div class="items-end space-x-2">
                <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-300"><i class="mdi mdi-cart"></i></button>
                <button class="bg-transparent text-gray-400"><i class="mdi mdi-heart text-2xl"></i></button>
              </div>
              </div>
            </div>
          </Link>
          </div>
        </div>
  
        <br>
        
      </div>
     
    </section>
   </div>
  </template>
  
  <script setup>
  import {Link} from '@inertiajs/vue3';
  defineProps({products: Object,categories: Object});
  </script>
