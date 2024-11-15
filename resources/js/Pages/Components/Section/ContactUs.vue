<template>
  <div id="contactSection">
    <section class="bg-pink-100 dark:bg-black py-12">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <p class="text-4xl font-extrabold text-black dark:text-white montserrat">
            Hubungi Kami
          </p>
          <p class="mt-4 max-w-2xl text-xl text-gray-700 dark:text-gray-300 mx-auto">
            Kami siap membantu Anda. Silakan isi formulir di bawah ini untuk menghubungi kami.
          </p>
        </div>
        <div class="mt-10">
          <form class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8" @submit.prevent="handleContactSubmit">
            <div>
              <label for="first_name" class="block text-lg font-bold text-black dark:text-white">
                Nama Depan
              </label>
              <input
                type="text"
                id="first_name"
                name="first_name"
                autocomplete="given-name"
                class="w-full py-3 px-4 border-4 border-black dark:border-white bg-transparent text-black dark:text-white focus:outline-none focus:ring-4 focus:ring-blue-500"
                v-model="firstName"
              />
            </div>
            <div>
              <label for="last_name" class="block text-lg font-bold text-black dark:text-white">
                Nama Belakang
              </label>
              <input
                type="text"
                id="last_name"
                name="last_name"
                autocomplete="family-name"
                class="w-full py-3 px-4 border-4 border-black dark:border-white bg-transparent text-black dark:text-white focus:outline-none focus:ring-4 focus:ring-blue-500"
                v-model="lastName"
              />
            </div>
            <div class="sm:col-span-2">
              <label for="email" class="block text-lg font-bold text-black dark:text-white">
                Email
              </label>
              <input
                id="email"
                name="email"
                type="email"
                autocomplete="email"
                class="w-full py-3 px-4 border-4 border-black dark:border-white bg-transparent text-black dark:text-white focus:outline-none focus:ring-4 focus:ring-blue-500"
                v-model="email"
              />
            </div>
            <div class="sm:col-span-2">
              <label for="phone" class="block text-lg font-bold text-black dark:text-white">
                No. HP
              </label>
              <input
                id="phone"
                name="phone"
                type="tel"
                class="w-full py-3 px-4 border-4 border-black dark:border-white bg-transparent text-black dark:text-white focus:outline-none focus:ring-4 focus:ring-blue-500"
                v-model="phone"
              />
            </div>
            <div class="sm:col-span-2">
              <label for="subject" class="block text-lg font-bold text-black dark:text-white">
                Subjek
              </label>
              <input
                type="text"
                id="subject"
                name="subject"
                class="w-full py-3 px-4 border-4 border-black dark:border-white bg-transparent text-black dark:text-white focus:outline-none focus:ring-4 focus:ring-blue-500"
                v-model="subject"
              />
            </div>
            <div class="sm:col-span-2">
              <label for="message" class="block text-lg font-bold text-black dark:text-white">
                Pesan
              </label>
              <textarea
                id="message"
                name="message"
                rows="4"
                class="w-full py-3 px-4 border-4 border-black dark:border-white bg-transparent text-black dark:text-white focus:outline-none focus:ring-4 focus:ring-blue-500"
                v-model="message"
              ></textarea>
            </div>
            <div class="sm:col-span-2">
              <button
                @click="handleContactSubmit"
                type="submit"
                class="w-full py-3 px-6 bg-blue-500 text-white font-bold border-4 border-black dark:border-white hover:bg-blue-600 transition-all shadow-neobrutal"
              >
                Kirim Pesan
              </button>
            </div>
          </form>
        </div>
      </div>
    </section>
    <Toast :show="toastConfig.show" :message="toastConfig.message" :type="toastConfig.type" />
  </div>
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
  toastConfig.value.message = msg;
  toastConfig.value.type = type;

  setTimeout(dismiss, 5000);
};
const dismiss = () => (toastConfig.value.show = false);

const handleContactSubmit = async () => {
  const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  let response = await fetch('/api/contact', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': token,
    },
    body: JSON.stringify({
      phone: phone.value,
      email: email.value,
      fullname: firstName.value + ' ' + lastName.value,
      subject: subject.value,
      message: message.value,
    }),
  }).then((res) => res.json());

  if (response.success) {
    showToast(response.msg, 'success');
  } else {
    let fails = response.fails;
    Object.keys(fails).forEach((field) => {
      fails[field].forEach((error) => {
        showToast(error, 'error');
      });
    });
  }
};
</script>

<style scoped>
label {
  text-transform: uppercase;
}

button {
  transition: transform 0.3s ease, background-color 0.3s ease;
}

button:hover {
  transform: scale(1.02);
}
</style>
