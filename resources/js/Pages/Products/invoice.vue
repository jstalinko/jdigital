<template>
    <div class="bg-gray-200 min-h-screen">
        <br>
        <div
            class="container min-h-screen max-w-screen-lg bg-white mx-auto border-2 rounded border-gray-300 shadow-sm px-6 py-6">

            <div class="grid grid-cols-2 divide-x ">
                <div class="p-4">
                    <img src="/logo.png" class="w-60 object-cover">
                    <p class="mt-3">Invoice ID :</p>
                    <h1 class="text-2xl montserrat font-bold">#{{ props.order.invoice }}</h1>
                    <p class="mt-2">Status :</p>
                    <div v-html="statusUi(props.order.status)"></div>
                    <div>
                        <small class="text-sm text-gray-500 mt-3">Invoice Date: {{ new
                            Date(invDate).toLocaleDateString('en-GB') }}</small><br>
                        <small class="text-sm text-gray-500">Due Date: {{ new
                            Date(dueDate).toLocaleDateString('en-GB') }}</small>
                    </div>

                </div>
                <div class="p-4">
                    <p class="mt-3">Metode Pembayaran:</p>
                    <h1 class="text-2xl montserrat font-bold">
                        {{ props.order.payment_method_name }}
                    </h1>
                    <p class="mt-3">Tujuan Pembayaran:</p>
                    <div v-html="paymenteDestination()"></div>
                    <p class="mt-3">Total Bayar:</p>
                    <b class="font-bold text-xl">{{ formatCurrency(props.order.total) }}</b>
                    <p class="mt-3">Petunjuk Pembayaran:</p>
                    <Accordion :items="JSON.parse(props.order.payment_instructions)" />
                </div>
            </div>


            <div class="border-2 rounded mt-5">
                <div class="bg-gray-100 p-3 rounded">
                    <h3 class="text-md">Invoice Items</h3>
                </div>
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2">Items</th>
                            <th class="py-2">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2">
                                {{ props.order.product.name }}
                            </td>
                            <td class="py-2">
                                {{ formatCurrency(props.order.product.price) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="mb-4 mt-4 p-4">
                    <h2 class="text-xl font-semibold">Summary</h2>
                    <p class="mb-2"><strong>Subtotal:</strong> {{ formatCurrency(props.order.product.price) }}</p>
                    <p class="mb-2"><strong>Biaya Merchant:</strong> {{ formatCurrency(props.order.fee) }}</p>
                    <p class="mb-2"><strong>Total:</strong> <span class="font-bold text-md animate-pulse">
                            {{ formatCurrency(props.order.total) }}</span> </p>
                </div>
            </div>

            <div class="flex items-center justify-center mt-10 gap-2">
                <button class="bg-gray-500 text-white p-2 rounded" @click="handlePrint">
                    <i class="mdi mdi-printer"></i> Print
                </button>
                <button class="bg-red-500 text-white p-2 rounded" @click="refresh">
                    <i class="mdi mdi-refresh"></i> Refresh
                </button>
            </div>

        </div>
        <br>
    </div>
</template>

<script setup>
import { ref,onMounted } from 'vue';
import Accordion from '../Components/Accordion.vue';
import { formatCurrency } from '#helpers';
const propz = defineProps({ props: Object });

const createdDate = propz.props.order.created_at;
let currentDate = new Date(createdDate);
let due = new Date(new Date(currentDate).setDate(currentDate.getDate() + 1)).toISOString();
const dueDate = ref(due);
const invDate = ref(createdDate);


const paymenteDestination = () => {
    let dest = propz.props.order.payment_destination;
    if (dest.match(/^http/)) {
        if (dest.match(/qr/)) {
            return '<img src="' + dest + '">';
        } else {
            return '<a href="' + dest + '">';
        }
    } else {
        return '<div class="bg-gray-500 text-white p-2 rounded text-xl text-center hover:bg-gray-600 hover:cursor-pointer">' + dest + ' <i class="mdi mdi-content-copy"></i> </div>';
    }
}

const handlePrint = () => {
    window.print();
}
const refresh = () => {
    window.location.reload();
}
const statusUi = (status) => {
    if(status == 'unpaid' || status == 'cancelled')
    {
        return '<h1 class="text-2xl montserrat font-bold text-red-500">'+status.toUpperCase()+'</h1>';
    }else if(status == 'paid')
    {
        return '<h1 class="text-2xl montserrat font-bold text-green-500">'+status.toUpperCase()+'</h1>';
    }else{
        return '<h1 class="text-2xl montserrat font-bold text-gray-500">'+status.toUpperCase()+'</h1>';
    }
}

onMounted(()=>{
    setTimeout(() => window.location.reload(),60000);
});


</script>

<style scoped>
table {
    border-collapse: collapse;
    width: 100%;
}

th,
td {
    text-align: left;
    padding: 8px;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f4f4f4;
}
</style>