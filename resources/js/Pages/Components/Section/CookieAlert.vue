<template>
    <div v-if="showAlert" class="fixed bottom-0 inset-x-0 pb-2 sm:pb-5">
      <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="p-2 rounded-lg bg-indigo-600 shadow-lg sm:p-3">
          <div class="flex items-center justify-between flex-wrap">
            <div class="w-0 flex-1 flex items-center">
              <span class="flex p-2 rounded-lg bg-indigo-800">
                <!-- Icon -->
                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m1-7a9 9 0 11-6.14 2.73L9 13m5-1a5 5 0 11-4.14-2.73L9 9"></path>
                </svg>
              </span>
              <p class="ml-3 font-medium text-white truncate">
                <span class="md:hidden">Kami menggunakan cookies untuk meningkatkan pengalaman Anda.</span>
                <span class="hidden md:inline">Kami menggunakan cookies untuk meningkatkan pengalaman Anda. </span>
              </p>
            </div>
            <div class="order-3 mt-2 flex-shrink-0 w-full sm:order-2 sm:mt-0 sm:w-auto">
              <button @click="acceptCookies" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-600 bg-white hover:bg-indigo-50">
                Terima
              </button>
            </div>
            <div class="order-2 flex-shrink-0 sm:order-3 sm:ml-2">
              <button @click="closeAlert" type="button" class="-mr-1 flex p-2 rounded-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-white sm:-mr-2">
                <span class="sr-only">Tutup</span>
                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>

<script setup>
import { ref, onMounted } from 'vue';

const showAlert = ref(true);

const closeAlert = () => {
  showAlert.value = false;
};

const acceptCookies = () => {
  // Logika untuk menyetujui penggunaan cookies, misalnya menyimpan persetujuan di localStorage
  localStorage.setItem('jd_cookieAccepted', 'true');
  showAlert.value = false;
};

onMounted(() => {
  // Cek jika pengguna sudah menyetujui cookies sebelumnya
  if (localStorage.getItem('jd_cookieAccepted')) {
    showAlert.value = false;
  }
});
</script>