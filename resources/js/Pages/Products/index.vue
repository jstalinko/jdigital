<template>
    <div>
        <Title :title="headTitle"/>
        <Navbar />

        <div class="w-full mx-auto">
            <div class="mt-10">
                <Breadcumbs :breadcrumbs="breadcrumbs" />

                <div class="mt-5">
                    <div class="max-w-7xl mx-auto">
                        <h3 class="text-2xl text-center montserrat font-bold">Cari Produk</h3>
                        <form @submit.prevent="handleSearch" class="p-4 bg-yellow-200 border-4 border-black">
    <div class="flex items-center space-x-2">
        <input 
            v-model="searchQuery" 
            type="text" 
            placeholder="Search..." 
            class="w-full p-2 bg-white text-black border-4 border-black focus:outline-none focus:ring focus:ring-pink-500 text-lg"
        />
        <button 
            type="submit" 
            @click="handleSearch" 
            class="p-2 bg-pink-500 text-black border-4 border-black hover:bg-pink-300 text-lg font-bold"
        >
            <i class="mdi mdi-magnify"></i> 
        </button>
    </div>
</form>

                    </div>

                    <div class="mt-5 mb-10">
                        <Product :products="props.products" :categories="props.categories" :viewAll="true"
                            :headTitle="headTitle" :activeCat="props?.activeCat" :search="props?.search" />
                    </div>
                </div>
            </div>
        </div>

        <Footer/>
    </div>
</template>

<script setup>
import Breadcumbs from '../Components/Breadcumbs.vue';
import Navbar from '../Components/Navbar.vue';
import Product from '../Components/Section/Product.vue';
import Footer from '../Components/Footer.vue';
import Title from '../Components/Section/Title.vue';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3'

const propz = defineProps({ props: Object });
const searchQuery = ref('');
const breadcrumbs = ref([]);
const headTitle = ref('Semua Produk');

if (propz.props?.activeCat !== undefined) {
    breadcrumbs.value = [{ label: 'Beranda', href: '/' }, { label: 'Product', href: '/products' }, { label: propz.props.activeCat.name, href: '/product/category/' + propz.props.activeCat.slug }];
    headTitle.value = propz.props.activeCat.name;
} else if (propz.props?.search !== undefined) {
    breadcrumbs.value = [{ label: 'Beranda', href: '/' }, { label: 'Product', href: '/products' }, { label: 'Search', href: '/product/search?query=' + propz.props?.search }]
    headTitle.value = 'Pencarian Produk';
} else {
    breadcrumbs.value = [{ label: 'Beranda', href: '/' }, { label: 'Semua Produk', href: '/products' }]
    headTitle.value = 'Semua Produk';
}

const handleSearch = async () => {
    router.get('/product/search', { query: searchQuery.value }, { preserveState: true });
}

</script>