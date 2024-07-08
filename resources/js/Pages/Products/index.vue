<template>
    <div>
        <Navbar />

        <div class="container mx-auto">
            <div class="mt-10">
                <Breadcumbs :breadcrumbs="breadcrumbs" />

                <div class="mt-5">
                    <h3 class="text-2xl text-center montserrat font-bold">Cari Produk</h3>
                    <form @submit.prevent="handleSearch">
                        <div class="flex items-center  border-b-2 border-gray-200 py-2">
                            <input v-model="searchQuery" type="text" placeholder="Search..."
                                class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none">
                            <button type="submit" @click="handleSearch"
                                class="flex-shrink-0 bg-blue-500 hover:bg-blue-700 border-blue-500 hover:border-blue-700 text-sm border-4 text-white py-1 px-2 rounded">
                                <i class="mdi mdi-magnify"></i> Cari
                            </button>
                        </div>
                    </form>

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