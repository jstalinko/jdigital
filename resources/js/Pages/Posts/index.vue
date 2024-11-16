<template>
    <div>
        <Title :title="'Semua Postingan'"/>
        <Navbar />

        <div class=" mx-auto">
            <div class="mt-10">
                <Breadcumbs
                    :breadcrumbs="[{ label: 'Beranda', href: '/' }, { label: 'Semua Postingan', href: '/posts' }]" />

                <div class="mt-5 mb-5">
                    <div class="max-w-7xl mx-auto mt-5">
        <h3 class="text-3xl text-center montserrat font-bold text-black border-b-4 border-black pb-2 mb-5">
            Cari Postingan
        </h3>
        <form @submit.prevent="handleSearch" class="bg-yellow-200 border-4 border-black shadow-neobrutal p-5 ">
            <div class="flex items-center gap-3">
                <input
                    v-model="searchQuery"
                    type="text"
                    placeholder="Search..."
                    class="appearance-none border-4 border-black w-full text-black dark:text-white p-3 focus:outline-none focus:ring-2 focus:ring-black"
                />
                <button
                    type="submit"
                    @click="handleSearch"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold border-4 border-black p-3 shadow-neobrutal"
                >
                    <i class="mdi mdi-magnify"></i> 
                </button>
            </div>
        </form>
    </div>


                    <div class="mt-5 ">
                        <div class="flex flex-row justify-center gap-2 flex-wrap mb-5">

                            
                            <div
            class="bg-yellow-500 border-black border-4 rounded-lg text-black px-4 py-2 w-full text-center"
            v-show="props.search !== undefined"
          >
            <i class="mdi mdi-magnify"></i> Hasil pencarian: 
            <span class="font-bold underline">{{ props.search }}</span>
          </div>
                            
                                <Link class="bg-blue-500 p-2 px-4 shadow-neobrutal text-white border-2 border-black hover:bg-blue-600'"
                                    v-for="(tag, index) in displayedTags" :key="index"
                                    :href="'/post/search?query=' + tag">
                                {{ tag }}
                                </Link>    
                                
                            
                        </div>
                        <div class="flex justify-center mt-2">
                            <button v-if="props.tags.length > 10" @click="toggleShowAll"
                                    class="bg-gray-500 p-2 px-4  text-white shadow-sm hover:bg-gray-600 mt-2 shadow-neobrutal border-2 border-black">
                                    {{ showAll ? 'Show Less' : 'Show More' }}
                                </button>
                        </div>
                       
                        <Post :posts="props.posts" :viewAll="true" class="mt-5 mb-10"/>
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
import Title from '../Components/Section/Title.vue';
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