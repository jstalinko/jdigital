<template>
    <Navbar />
    <div class="container mx-auto mt-5">
        <Breadcumbs
            :breadcrumbs="[{ label: 'Beranda', href: '/' }, { label: 'Product', href: '/posts' }, { label: props.product.category.name, href: '/categories' }, { label: props.product.name, href: '?' }]" />

        <div class="mt-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex justify-center">
                    <div>
                    <img :src="props.product.image" class="object-cover rounded max-w-full h-auto">
                     
                     <h3 class="font-bold text-2xl montserrat mt-5">{{ props.product.name }}</h3>

                    <ul class="mt-2 p-3">
                        <li class="p-2 border-b-2 flex justify-between"><span><i class="mdi mdi-tag"></i> Kategori
                                :</span> <span>{{ props?.product?.category?.name }}</span> </li>
                        <li class="p-2 border-b-2 flex justify-between"><span><i class="mdi mdi-cash"></i> Harga
                                :</span> <span class="font-bold ">{{ formatCurrency(props?.product?.price) }}</span></li>
                        <li class="p-2 border-b-2 flex justify-between"><span><i class="mdi mdi-eye"></i> Dilihat
                                :</span> <span>10x</span></li>
                        <li class="p-2 border-b-2 flex justify-between"><span><i class="mdi mdi-cart-outline"></i>
                                Terjual :</span> <span>10x</span></li>
                        <li class="p-2 border-b-2 flex justify-between"><span><i class="mdi mdi-update"></i> Update
                                :</span> <span>{{ new Date(props?.product?.updated_at).toDateString() }}</span></li>
                        <li class="p-2 border-b-2 flex justify-between"><span><i class="mdi mdi-calendar"></i> Publish
                                :</span> <span>{{ new Date(props?.product?.created_at).toDateString() }}</span></li>
                    </ul>
                     <br><br>
                    </div>
                </div>
                <div>
                    <PaymentChannel :channels="props.paymentChannel.data" :price="props.product.price" @payment-selected="handlePaymentSelected"/>

                    <h3 class="font-bold text-2xl montserrat mt-4"> Payment Detail </h3>
                    <ul class="mt-2 p-3">
                        <li class="p-2 border-b-2 flex justify-between">
                            <span>@ Harga :</span> <span class="font-bold">{{ formatCurrency(props?.product?.price) }}</span>
                        </li>
                        <li class="p-2 border-b-2 flex justify-between" v-if="selectedPayment">
                            <span>@ Metode Bayar :</span><span class="font-bold">{{ selectedPayment.name }}</span>
                        </li>
                        <li class="p-2 border-b-2 flex justify-between" v-if="selectedPayment">
                            <span >@ Biaya Merchant :</span><span class="font-bold">{{ formatCurrency(calculateFee(props.product.price,selectedPayment.fee_merchant,selectedPayment.fee_customer)) }}</span>
                        </li>
                        <li class="p-2 border-b-2 flex justify-between" v-if="selectedPayment">
                            <span>@ Total Bayar :</span><span class="font-bold">{{ formatCurrency(props.product.price + calculateFee(props.product.price,selectedPayment.fee_merchant,selectedPayment.fee_customer)) }}</span>
                        </li>
                    </ul>
                    <div class="flex items-center">
                        <Link :href="'/product/checkout/' + props.product.slug"
                            class="bg-blue-500 text-white hover:bg-blue-600 rounded p-2 w-full text-center"><i
                            class="mdi mdi-cart"></i> Checkout !</Link>
                    </div>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import Navbar from '../Components/Navbar.vue';
import Breadcumbs from '../Components/Breadcumbs.vue';
import PaymentChannel from '../Components/PaymentChannel.vue';
import {formatCurrency,calculateFee} from '#helpers';
import {Link} from '@inertiajs/vue3';
import {ref} from 'vue';
const propz = defineProps({ props: Object });

const totalBayar = ref(0);
const totalFee = ref(0);
const methodBayarCode = ref('');
const methodBayarName = ref('');
const selectedPayment = ref(null);


const handlePaymentSelected = (payment) => {
  selectedPayment.value = payment;
  totalBayar.value = propz.props.product.price + calculateFee(propz.props.product.price , payment.fee_merchant,payment.fee_customer);
  totalFee.value = calculateFee(propz.props.product.price , payment.fee_merchant , payment.fee_customer);
  methodBayarCode.value = payment.code;
  methodBayarName.value = payment.name;
};
</script>