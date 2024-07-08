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
                                    :</span> <span class="font-bold ">{{ formatCurrency(props?.product?.price) }}</span>
                            </li>
                            <li class="p-2 border-b-2 flex justify-between"><span><i class="mdi mdi-eye"></i> Dilihat
                                    :</span> <span>{{ props?.product?.views }}x</span></li>
                            <li class="p-2 border-b-2 flex justify-between"><span><i class="mdi mdi-cart-outline"></i>
                                    Terjual :</span> <span>{{ props?.product?.sold }}x</span></li>
                            <li class="p-2 border-b-2 flex justify-between"><span><i class="mdi mdi-update"></i> Update
                                    :</span> <span>{{ new Date(props?.product?.updated_at).toDateString() }}</span></li>
                            <li class="p-2 border-b-2 flex justify-between"><span><i class="mdi mdi-calendar"></i>
                                    Publish
                                    :</span> <span>{{ new Date(props?.product?.created_at).toDateString() }}</span></li>
                        </ul>
                        <br><br>
                    </div>
                </div>
                <div>
                    <PaymentChannel :channels="props.paymentChannel.data" :price="props.product.price"
                        @payment-selected="handlePaymentSelected" />

                    <h3 class="font-bold text-xl montserrat mt-4"> Payment Detail </h3>
                    <ul class="mt-2 p-3">
                        <li class="p-2 border-b-2 flex justify-between">
                            <span>@ Harga :</span> <span class="font-bold">{{ formatCurrency(props?.product?.price)
                                }}</span>
                        </li>
                        <li class="p-2 border-b-2 flex justify-between" v-if="selectedPayment">
                            <span>@ Metode Bayar :</span><span class="font-bold">{{ selectedPayment.name }}</span>
                        </li>
                        <li class="p-2 border-b-2 flex justify-between" v-if="selectedPayment">
                            <span>@ Biaya Merchant :</span><span class="font-bold">{{
                                formatCurrency(calculateFee(props.product.price, selectedPayment.fee_merchant,
                                    selectedPayment.fee_customer))
                                }}</span>
                        </li>
                        <li class="p-2 border-b-2 flex justify-between" v-if="selectedPayment">
                            <span>@ Total Bayar :</span><span class="font-bold">{{ formatCurrency(props.product.price +
                                calculateFee(props.product.price, selectedPayment.fee_merchant,
                                    selectedPayment.fee_customer))
                                }}</span>
                        </li>
                    </ul>
                    <div class="bg-red-400 text-white p-2 text-center rounded mt-2 mb-2"
                        v-if="props.userData.phone === '' && !guestCheckoutConfirmation">
                        Guest checkout tidak di anjurkan, kami menganjurkan anda membuat akun/login ke akun terlebih
                        dahulu sebelum checkout.
                        <br>
                        <button class="bg-red-600 rounded p-2" @click="continueCheckout">Lanjutkan saja</button>&nbsp;
                        <Link href="/dashboard/login" class="bg-blue-600 rounded p-2">Login dulu</Link>
                    </div>

                    <div class="flex justify-between" v-if="guestCheckoutConfirmation">
                        <b class="montserrat text-md mt-2">Nomer HP Anda :</b>
                        <input class="border-2 w-10/12 mt-2 mb-2 p-2 rounded" v-model="phone"
                            placeholder="masukan nomer hp / whatsapp anda" />
                    </div>
                    <div v-if="!guestCheckoutConfirmation && props.userData.phone !== ''">
                        <h3 class="font-bold text-xl montserrat mt-4"> Customer Detail </h3>
                        <ul class="mt-2 p-3">
                            <li class="p-2 border-b-2 flex justify-between">
                                <span>Nama :</span> <span class="font-bold">{{ props.userData.name }}</span>
                            </li>
                            <li class="p-2 border-b-2 flex justify-between">
                                <span>Email :</span> <span class="font-bold">{{ props.userData.email }}</span>
                            </li>
                            <li class="p-2 border-b-2 flex justify-between">
                                <span>Phone :</span> <span class="font-bold">{{ props.userData.phone }}</span>
                            </li>
                        </ul>
                    </div>

                    <button v-show="guestCheckoutConfirmation || props.userData.phone !== ''" @click="handleCheckout"
                        class="bg-blue-500 text-white hover:bg-blue-600 rounded p-2 w-full text-center"><i
                            class="mdi mdi-cart"></i> Checkout !</button>
                    <br><br>
                </div>
            </div>
        </div>

        <Toast :show="toastConfig.show" :message="toastConfig.message" :type="toastConfig.type" />

    </div>
</template>

<script setup>
import Navbar from '../Components/Navbar.vue';
import Breadcumbs from '../Components/Breadcumbs.vue';
import PaymentChannel from '../Components/PaymentChannel.vue';
import Toast from '../Components/Toast.vue';
import { formatCurrency, calculateFee } from '#helpers';
import { router, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
const propz = defineProps({ props: Object });

const totalBayar = ref(0);
const totalFee = ref(0);
const methodBayarCode = ref('');
const methodBayarName = ref('');
const selectedPayment = ref(null);
const phone = ref('');
const guestCheckoutConfirmation = ref(false);
const toastConfig = ref({});
const showToast = (msg, type) => {
    toastConfig.value.show = true;
    toastConfig.value.message = msg
    toastConfig.value.type = type;

    setTimeout(dismiss, 5000); // Automatically dismiss after 2 seconds
};
const dismiss = () => toastConfig.value.show = false;

const handlePaymentSelected = (payment) => {
    selectedPayment.value = payment;
    totalBayar.value = propz.props.product.price + calculateFee(propz.props.product.price, payment.fee_merchant, payment.fee_customer);
    totalFee.value = calculateFee(propz.props.product.price, payment.fee_merchant, payment.fee_customer);
    methodBayarCode.value = payment.code;
    methodBayarName.value = payment.name;
};

const continueCheckout = async () => {
    guestCheckoutConfirmation.value = true;
}

const handleCheckout = async () => {

    /** VALIDATE FORM CHECKOUT */
    if (methodBayarCode.value == '') {
        showToast('Pilih metode pembayaran terlebih dahulu!', 'error');
        return;
    } else if (selectedPayment.value == null) {
        showToast('Pilih metode pembayaran terlebih dahulu!', 'error');
        return;
    } else if (propz.props.userData.phone == '' && phone.value == '') {
        showToast('Isi nomer HP terlebih dahulu', 'error');
        return;
    }

    /////////////////////////////////

    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    //  console.log(token);
    let resp = await fetch('/api/create-order', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify({
            product_id: propz.props.product.id,
            methodCode: methodBayarCode.value,
            methodName: methodBayarName.value,
            phone: phone.value,
            amountTotal: totalBayar.value,
            fee: totalFee.value
        })
    }).then(res => res.json());
    if (resp.success) {
        //console.log(resp);
        //window.location.href = resp.redirect; 
        showToast('Sukses! anda akan di alihkan ke invoice ', 'success');
        router.visit(resp.redirect);
    } else {
        console.log(resp);
    }
}
</script>