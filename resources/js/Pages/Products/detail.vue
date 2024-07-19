<template>
    <div>
        <Navbar />

        <div class="container mx-auto mt-5">
            <Breadcumbs
                :breadcrumbs="[{ label: 'Beranda', href: '/' }, { label: 'Product', href: '/posts' }, { label: props.product.category.name, href: '/categories' }, { label: props.product.name, href: '?' }]" />

            <div class="mt-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex justify-center">
                        <img :src="imageUrl(props.product.image)" class="object-cover rounded max-w-full h-auto">
                    </div>
                    <div>
                        <h3 class="font-bold text-2xl montserrat">{{ props.product.name }}</h3>

                        <ul class="mt-2 p-3">
                            <li class="p-2 border-b-2 flex justify-between"><span><i class="mdi mdi-tag"></i> Kategori
                                    :</span> <span>{{ props?.product?.category?.name }}</span> </li>
                            <li class="p-2 border-b-2 flex justify-between"><span><i class="mdi mdi-cash"></i> Harga
                                    :</span> <span class="font-bold ">{{ formatCurrency(props?.product?.price) }}</span>
                            </li>
                            <li class="p-2 border-b-2 flex justify-between"><span><i class="mdi mdi-eye"></i> Dilihat
                                    :</span> <span>{{ props?.product?.views }}x</span></li>
                            <li class="p-2 border-b-2 flex justify-between"><span><i class="mdi mdi-cart-outline"></i>
                                    Terjual :</span> <span>{{ props?.product?.sold }}x</span></li>
                            <li class="p-2 border-b-2 flex justify-between"><span><i class="mdi mdi-update"></i> Update
                                    :</span> <span>{{ new Date(props?.product?.updated_at).toDateString() }}</span></li>
                            <li class="p-2 border-b-2 flex justify-between"><span><i class="mdi mdi-calendar"></i>
                                    Publish :</span> <span>{{ new Date(props?.product?.created_at).toDateString()
                                    }}</span></li>
                        </ul>
                        <div class="flex items-center flex-col">
                            <button
                                :class="loadFavorite.find(fav => fav.id == props?.product.id) ? 'bg-gray-500 text-white hover:bg-red-500 rounded p-2 w-full text-center' : 'bg-red-500 text-white hover:bg-gray-500 rounded p-2 w-full text-center'"
                                @click="fav(props.product.id, props.product.name, props.product.slug)">
                                <i class="mdi mdi-heart"></i> Favorite
                            </button><br>
                            <Link :href="'/product/checkout/' + props.product.slug"
                                class="bg-blue-500 text-white hover:bg-blue-600 rounded p-2 w-full text-center"><i
                                class="mdi mdi-cart"></i> Beli Sekarang !</Link>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row mt-5 ">
                    <div class="basis-3/4 container   min-h-screen border-2 px-10 py-10 rounded">
                        <div v-html="props.product.description" class="prose md:prose-xl dark:text-gray-100"></div>
                    </div>
                    <div class="basis-1/4">
                        <Card textHeader="Tags" :Footer="props.product.tags" :url="props?.global?.currentUrl" />
                        <br>
                        <Card textHeader="Bagikan"
                            textContent="Tertarik dengan produk ini? bagikan ke teman atau kerabat anda! "
                            Footer="sharer" :url="props?.global?.currentUrl" />
                    </div>
                </div>
            </div>

            <!-- floating checkout -->
            <div class="fixed bottom-0 inset-x-0 pb-24 md:pb-2" v-if="showButton">
                <div class="max-w-7xl sm:px-6 lg:px-8  mx-auto">
                    <div class="flex items-center">
                        <Link :href="'/product/checkout/' + props.product.slug"
                            class="bg-blue-500 text-white hover:bg-blue-600 rounded p-2 w-full text-center"><i
                            class="mdi mdi-cart"></i> Beli Sekarang !</Link>
                    </div>
                </div>
            </div>

        </div>
        <Favorites />

        <Footer/>
    </div>
</template>

<script setup>
import Navbar from '../Components/Navbar.vue';
import Card from '../Components/Card.vue';
import { formatCurrency, imageUrl, toggleFavorite, loadFavorites } from '#helpers';
import Breadcumbs from '../Components/Breadcumbs.vue';
import Favorites from '../Components/Favorites.vue';
import Footer from '../Components/Footer.vue';
import { Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
defineProps({ props: Object });

const loadFavorite = ref([]);

const fav = async (id, name, slug) => {
    await toggleFavorite(id, name, slug);
    loadFavorite.value = loadFavorites();
}
const showButton = ref(false);

const handleScroll = () => {
    const scrollPosition = window.scrollY + window.innerHeight;
    const pageHeight = document.documentElement.scrollHeight;

    // Adjust the threshold as needed, e.g., 100 for 100px from the bottom
    if (pageHeight - scrollPosition < 100) {
        showButton.value = true;
    } else {
        showButton.value = false;
    }
};
onMounted(async () => {
    loadFavorite.value = loadFavorites();
    window.addEventListener('scroll', handleScroll);
});
</script>
