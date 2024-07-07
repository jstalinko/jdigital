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
                    <h1 class="text-2xl montserrat font-bold">{{ props.order.status.toUpperCase() }}</h1>
                    <div>
                        <small class="text-sm text-gray-500 mt-3">Invoice Date: {{ new
                            Date(invDate).toLocaleDateString('en-GB') }}</small><br>
                        <small class="text-sm text-gray-500">Due Date: {{ new
                            Date(dueDate).toLocaleDateString('en-GB')}}</small>
                    </div>

                </div>
                <div class="p-4">
                    <p class="mt-3">Metode Pembayaran:</p>
                    <h1 class="text-2xl montserrat font-bold">
                        {{ props.order.payment_method_name }}
                    </h1>
                    <p class="mt-3">Tujuan Pembayaran:</p>
                    <div v-html="paymenteDestination()"></div>
                    <p class="mt-3">Petunjuk Pembayaran:</p>
                    <Accordion :items="JSON.parse(props.order.payment_instructions)" />
                </div>
            </div>


        </div>
        <br>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import Accordion from '../Components/Accordion.vue';
const propz = defineProps({ props: Object });

const createdDate = propz.props.order.created_at;
let currentDate = new Date(createdDate);
let due = new Date(new Date(currentDate).setDate(currentDate.getDate() + 1)).toISOString();
const dueDate = ref(due);
const invDate = ref(createdDate);


const paymenteDestination = (target) => {
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


</script>