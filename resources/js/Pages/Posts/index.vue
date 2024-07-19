<template>
    <div>
        <Navbar />

        <div class="container mx-auto">
            <div class="mt-10">
                <Breadcumbs
                    :breadcrumbs="[{ label: 'Beranda', href: '/' }, { label: 'Semua Postingan', href: '/posts' }]" />

                <div class="mt-5 mb-5">
                    <h3 class="text-2xl text-center montserrat font-bold">Cari Postingan</h3>
                    <form @submit.prevent="handleSearch">
                        <div class="flex items-center  border-b-2 border-gray-200 py-2">
                            <input v-model="searchQuery" type="text" placeholder="Search..."
                                class="appearance-none bg-transparent border-none w-full text-gray-700 dark:text-gray-100 mr-3 py-1 px-2 leading-tight focus:outline-none">
                            <button type="submit" @click="handleSearch"
                                class="flex-shrink-0 bg-blue-500 hover:bg-blue-700 border-blue-500 hover:border-blue-700 text-sm border-4 text-white py-1 px-2 rounded">
                                <i class="mdi mdi-magnify"></i> Cari
                            </button>
                        </div>
                    </form>

                    <div class="mt-5 ">
                        <div class="flex flex-row justify-center gap-2 flex-wrap mb-5">

                            <div class="bg-blue-500 rounded text-white p-4 px-4 w-full m-4 text-md montserrat"
                                v-show="props.search !== undefined">
                                <i class="mdi mdi-magnify"></i> Hasil pencarian : <span class="font-bold underline">
                                    {{ props.search }}</span>
                            </div>
                            
                                <Link class="bg-blue-500 p-2 px-4 rounded-full text-white shadow-sm hover:bg-blue-600'"
                                    v-for="(tag, index) in displayedTags" :key="index"
                                    :href="'/post/search?query=' + tag">
                                {{ tag }}
                                </Link>    
                                
                            
                        </div>
                        <div class="flex justify-center mt-2">
                            <button v-if="props.tags.length > 10" @click="toggleShowAll"
                                    class="bg-gray-500 p-2 px-4 rounded-full text-white shadow-sm hover:bg-gray-600 mt-2 ">
                                    {{ showAll ? 'Show Less' : 'Show More' }}
                                </button>
                        </div>
                       
                        <Post :posts="props.posts" :viewAll="true" />
                        <br><br>
                    </div>
                </div>
            </div>
        </div>

        <Footer />
    </div>

</template>

<script setup>
import Breadcumbs from '../Components/Breadcumbs.vue';
import Navbar from '../Components/Navbar.vue';
import Post from '../Components/Section/PostSection.vue';
import Footer from '../Components/Footer.vue';
import { ref, computed } from 'vue';
import { Link, router } from '@inertiajs/vue3';
const searchQuery = ref('');
const propz = defineProps({ props: Object });

const showAll = ref(false);

const displayedTags = computed(() => {
    return showAll.value ? propz.props.tags : propz.props.tags.slice(0, 10);
});

const toggleShowAll = () => {
    showAll.value = !showAll.value;
};

const handleSearch = async () => {
    router.visit('/post/search?query=' + searchQuery.value, { preserveScroll: true });
}
</script>