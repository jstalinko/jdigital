<template>
    <div class="mt-5">
        <h2 class="text-3xl font-bold mb-6 montserrat text-black border-b-4 border-black pb-2">Pilih Metode Pembayaran</h2>
        <div class="grid gap-4 grid-cols-2 lg:grid-cols-3 m-2">
            <div
                v-for="channel in channels"
                :key="channel.code"
                @click="selectPayment(channel)"
                :class="{
                    'border-4 border-blue-500 bg-yellow-300 shadow-neobrutal': selectedPayment?.code === channel.code,
                    'cursor-pointer p-4 bg-white dark:bg-gray-900 text-black dark:text-white border-4 border-black shadow-neobrutal rounded-md': true
                }"
                class="transition-transform duration-200 transform hover:scale-105"
            >
                <img :src="channel.icon_url" :alt="channel.name" class="h-12 mx-auto mb-3 " />
                <h3 class="text-center font-bold text-lg text-black dark:text-white">{{ channel.name }}</h3>
                <p class="text-center text-gray-700 dark:text-gray-200">
                    Biaya: {{ formatCurrency(calculateFee(price, channel.fee_merchant, channel.fee_customer)) }}
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { calculateFee, formatCurrency } from '#helpers';

const emit = defineEmits(['PaymentSelected']);
defineProps({ channels: Object, price: Number });

const selectedPayment = ref(null);

const selectPayment = (channel) => {
    selectedPayment.value = channel;
    emit('PaymentSelected', selectedPayment.value);
};
</script>

<style scoped>
.shadow-neobrutal {
    box-shadow: 8px 8px 0px 0px #000;
}
</style>
