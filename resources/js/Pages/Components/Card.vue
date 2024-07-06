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
            <div v-else>
                {{ Footer }}
               
            </div>

        </div>
    </div>
</template>

<script setup>
defineProps({ textHeader: String, textContent: String, Footer: String|Object|Array });
</script>