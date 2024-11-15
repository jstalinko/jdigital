<template>
  <div v-if="showAlert" class="fixed bottom-0 inset-x-0 pb-2 sm:pb-5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="p-3 rounded-lg bg-yellow-400 border-4 border-black shadow-neobrutal">
        <div class="flex items-center justify-between flex-wrap">
          <!-- Icon and Text -->
          <div class="w-0 flex-1 flex items-center">
            <span class="flex p-2 rounded-lg bg-yellow-500 border-2 border-black shadow-neobrutal">
              <svg
                class="h-6 w-6 text-black"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M12 8v4l3 3m1-7a9 9 0 11-6.14 2.73L9 13m5-1a5 5 0 11-4.14-2.73L9 9"
                />
              </svg>
            </span>
            <p class="ml-3 font-bold text-black truncate montserrat">
              <span class="md:hidden">Kami menggunakan cookies untuk pengalaman lebih baik.</span>
              <span class="hidden md:inline">Kami menggunakan cookies untuk meningkatkan pengalaman Anda.</span>
            </p>
          </div>

          <!-- Accept Button -->
          <div class="order-3 mt-2 flex-shrink-0 w-full sm:order-2 sm:mt-0 sm:w-auto">
            <button
              @click="acceptCookies"
              class="flex items-center justify-center px-4 py-2 text-sm font-bold bg-white border-4 border-black shadow-neobrutal rounded-lg hover:bg-gray-100"
            >
              Terima
            </button>
          </div>

          <!-- Close Button -->
          <div class="order-2 flex-shrink-0 sm:order-3 sm:ml-2">
            <button
              @click="closeAlert"
              type="button"
              class="flex p-2 rounded-lg bg-yellow-500 border-2 border-black shadow-neobrutal hover:bg-yellow-600"
            >
              <span class="sr-only">Tutup</span>
              <svg
                class="h-6 w-6 text-black"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M6 18L18 6M6 6l12 12"
                />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";

const showAlert = ref(true);

const closeAlert = () => {
  showAlert.value = false;
};

const acceptCookies = () => {
  localStorage.setItem("jd_cookieAccepted", "true");
  showAlert.value = false;
};

onMounted(() => {
  if (localStorage.getItem("jd_cookieAccepted")) {
    showAlert.value = false;
  }
});
</script>

<style>
/* Neobrutalist shadow effect */
.shadow-neobrutal {
  box-shadow: 6px 6px 0 0 black;
}
.shadow-neobrutal:hover {
  box-shadow: 2px 2px 0 0 black;
}

</style>
