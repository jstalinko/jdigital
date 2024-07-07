<template>
    <div class="max-w-sm rounded overflow-hidden shadow-lg bg-gray-100">
        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2 text-center border-b-2 p-2 montserrat">{{ textHeader }}</div>
            <p class="text-gray-700 text-base" v-if="textContent">
                {{ textContent }}
            </p>
        </div>
        <div class="px-6 pt-4 pb-2">
            <div v-if="typeof Footer === 'object'">
                <span
                    class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2 montserrat"
                    v-for="(fot, index) in Footer" :key="index">{{ fot }}</span>
            </div>
            <div v-else-if="typeof Footer === 'string' && Footer == 'sharer'">
                <div class="flex space-x-2 justify-center ">
                    <button @click="share('facebook')"
                        class="bg-blue-600 text-white py-2 px-4 rounded flex items-center space-x-2 hover:bg-blue-700">
                        <i class="mdi mdi-facebook" :class="iconClass"></i>
                    </button>
                    <button @click="share('twitter')"
                        class="bg-blue-400 text-white py-2 px-4 rounded flex items-center space-x-2 hover:bg-blue-500">
                        <i class="mdi mdi-twitter" :class="iconClass"></i>
                    </button>
                    <button @click="share('whatsapp')"
                        class="bg-green-500 text-white py-2 px-4 rounded flex items-center space-x-2 hover:bg-green-600">
                        <i class="mdi mdi-whatsapp" :class="iconClass"></i>
                    </button>
                    <button @click="share('linkedin')"
                        class="bg-blue-700 text-white py-2 px-4 rounded flex items-center space-x-2 hover:bg-blue-800">
                        <i class="mdi mdi-linkedin" :class="iconClass"></i>
                    </button>
                    <button @click="share('pinterest')"
                        class="bg-red-600 text-white py-2 px-4 rounded flex items-center space-x-2 hover:bg-red-700">
                        <i class="mdi mdi-pinterest" :class="iconClass"></i>
                    </button>
                    
                </div>

            </div>
            <div v-else>
                {{ Footer }}
            </div>

        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
const props = defineProps({ textHeader: String, textContent: String, Footer: String | Object | Array, url: String });



const iconClass = ref('text-xl')

const share = (platform) => {
    let shareUrl = ''
    const encodedUrl = encodeURIComponent(props.url)
    const encodedText = encodeURIComponent('Cek produk ini di javaradigital ! ')

    switch (platform) {
        case 'facebook':
            shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`
            break
        case 'twitter':
            shareUrl = `https://twitter.com/intent/tweet?url=${encodedUrl}&text=${encodedText}`
            break
        case 'whatsapp':
            shareUrl = `https://wa.me/?text=${encodedText}%20${encodedUrl}`
            break
    }

    window.open(shareUrl, '_blank')
}
</script>

<style scoped>
/* Tambahkan gaya khusus jika diperlukan */
</style>