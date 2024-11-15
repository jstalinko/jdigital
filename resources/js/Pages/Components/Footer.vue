<template>
  <footer class="bg-white dark:bg-black py-12 border-t-4 border-black dark:border-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-black dark:text-white">
        <!-- About Us Section -->
        <div class="border-4 border-black dark:border-white p-4 bg-yellow-100 shadow-neobrutal">
          <h3 class="text-xl font-bold uppercase tracking-wider">Tentang Kami</h3>
          <p class="mt-4 text-base">
            Javaradigital adalah perusahaan terkemuka di industri digital dan pengembangan perangkat lunak. Kami berdedikasi untuk memberikan solusi digital terbaik dan membantu bisnis Anda tumbuh di era digital.
          </p>
        </div>

        <!-- Services Section -->
        <div class="border-4 border-black dark:border-white p-4 bg-blue-100 shadow-neobrutal">
          <h3 class="text-xl font-bold uppercase tracking-wider">Layanan Kami</h3>
          <ul class="mt-4 space-y-2">
            <li><a href="https://wa.me/6285643307507" class="hover:underline text-blue-600 dark:text-blue-400">Pengembangan Web</a></li>
            <li><a href="https://wa.me/6285643307507" class="hover:underline text-blue-600 dark:text-blue-400">Pengembangan Aplikasi Mobile</a></li>
            <li><a href="https://wa.me/6285643307507" class="hover:underline text-blue-600 dark:text-blue-400">Pemasaran Digital</a></li>
            <li><a href="https://wa.me/6285643307507" class="hover:underline text-blue-600 dark:text-blue-400">Konsultasi TI</a></li>
            <li><a href="https://wa.me/6285643307507" class="hover:underline text-blue-600 dark:text-blue-400">Pengembangan Perangkat Lunak Kustom</a></li>
            <li><a href="https://wa.me/6285643307507" class="hover:underline text-blue-600 dark:text-blue-400">Pemeliharaan dan Dukungan</a></li>
          </ul>
        </div>

        <!-- Contact Section -->
        <div class="border-4 border-black dark:border-white p-4 bg-red-100 shadow-neobrutal">
          <h3 class="text-xl font-bold uppercase tracking-wider">Kontak Kami</h3>
          <ul class="mt-4 space-y-2">
            <li>
              <span class="block font-bold">Instagram:</span>
              <p class="text-base">@javaradigital</p>
            </li>
            <li>
              <span class="block font-bold">Telepon:</span>
              <p class="text-base">+6285-6433-07507</p>
            </li>
            <li>
              <span class="block font-bold">Email:</span>
              <p class="text-base">jstdigitalgroup@gmail.com</p>
            </li>
          </ul>
        </div>
      </div>
      <div class="mt-12 border-t-4 border-black dark:border-white pt-8">
        <p class="text-base text-center">
          &copy; {{ new Date().getFullYear() }} JavaraDigital - PT. Jepara Solusi Teknologi
        </p>
      </div>
    </div>
  </footer>
</template>

<style scoped>
a {
  font-weight: bold;
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}
</style>
