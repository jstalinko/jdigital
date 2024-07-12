<template>
  <div id="contactSection">
    <section class="bg-gray-100 py-12">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">

          <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
            Hubungi Kami
          </p>
          <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
            Kami siap membantu Anda. Silakan isi formulir di bawah ini untuk menghubungi kami.
          </p>
        </div>
        <div class="mt-10">
          <form class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8" @submit.prevent="handleContactSubmit">
            <div>
              <label for="first_name" class="block text-sm font-medium text-gray-700">Nama Depan</label>
              <div class="mt-1">
                <input type="text" id="first_name" name="first_name" autocomplete="given-name"
                  class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"
                  v-model="firstName">
              </div>
            </div>
            <div>
              <label for="last_name" class="block text-sm font-medium text-gray-700">Nama Belakang</label>
              <div class="mt-1">
                <input type="text" id="last_name" name="last_name" autocomplete="family-name"
                  class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"
                  v-model="lastName">
              </div>
            </div>
            <div class="sm:col-span-2">
              <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
              <div class="mt-1">
                <input id="email" name="email" type="email" autocomplete="email"
                  class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"
                  v-model="email">
              </div>
            </div>
            <div class="sm:col-span-2">
              <label for="phone" class="block text-sm font-medium text-gray-700">No. HP</label>
              <div class="mt-1">
                <input id="phone" name="phone" type="tel"
                  class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"
                  v-model="phone">
              </div>
            </div>
            <div class="sm:col-span-2">
              <label for="subject" class="block text-sm font-medium text-gray-700">Subjek</label>
              <div class="mt-1">
                <input type="text" id="subject" name="subject"
                  class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"
                  v-model="subject">
              </div>
            </div>
            <div class="sm:col-span-2">
              <label for="message" class="block text-sm font-medium text-gray-700">Pesan</label>
              <div class="mt-1">
                <textarea id="message" name="message" rows="4"
                  class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"
                  v-model="message"></textarea>
              </div>
            </div>
            <div class="sm:col-span-2">
              <button @click="handleContactSubmit" type="submit"
                class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Kirim Pesan
              </button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
  <Toast :show="toastConfig.show" :message="toastConfig.message" :type="toastConfig.type" />

</template>
<script setup>
import Toast from '../../Components/Toast.vue';

import { ref } from 'vue';
const firstName = ref('');
const lastName = ref('');
const email = ref('');
const phone = ref('');
const subject = ref('');
const message = ref('');
const toastConfig = ref({});
const showToast = (msg, type) => {
  toastConfig.value.show = true;
  toastConfig.value.message = msg
  toastConfig.value.type = type;

  setTimeout(dismiss, 5000);
};
const dismiss = () => toastConfig.value.show = false;

const handleContactSubmit = async () => {
  const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  let response = await fetch('/api/contact', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': token
    },
    body: JSON.stringify({
      phone: phone.value,
      email: email.value,
      fullname: firstName.value + ' ' + lastName.value,
      subject: subject.value,
      message: message.value
    })
  }).then(res => res.json());

  if (response.success) {
    showToast(response.msg, 'success');
  } else {
    let fails = response.fails
    // Parse and show each error as a toast
    Object.keys(fails).forEach(field => {
      fails[field].forEach(error => {
        showToast(error, 'error');
      });
    });
  }
};



</script>