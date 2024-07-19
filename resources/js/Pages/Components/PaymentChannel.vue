<template>
    <div class="mt-5">
        <h2 class="text-2xl font-bold mb-4 montserrat">Pilih Metode Pembayaran</h2>
        <div class="grid gap-4 grid-cols-2  lg:grid-cols-3 m-2">
            <div v-for="channel in channels" :key="channel.code" @click="selectPayment(channel)" :class="{
                'border-2 border-blue-500 bg-gray-200 dark:bg-gray-800': selectedPayment?.code === channel.code,
                'cursor-pointer p-4 bg-white dark:bg-transparent dark:text-gray-100 dark:border-2 shadow-md rounded-md': true
            }">
                <img :src="channel.icon_url" :alt="channel.name" class="h-12 mx-auto mb-2" />
                <h3 class="text-center font-semibold">{{ channel.name }}</h3>
                <p class="text-center text-gray-500 dark:text-gray-100">Biaya: {{ formatCurrency(calculateFee(price,channel.fee_merchant,channel.fee_customer)) }}</p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import {calculateFee,formatCurrency} from '#helpers';
const emit = defineEmits(['PaymentSelected']);
defineProps({ channels: Object , price: Number });

const selectedPayment = ref(null);

const selectPayment = (channel) => {
    selectedPayment.value = channel;
    //console.log('Selected payment channel:', selectedPayment.value);
    emit('PaymentSelected', selectedPayment.value);
};

</script>

<style scoped>
/* Tambahkan gaya khusus jika diperlukan */
</style>