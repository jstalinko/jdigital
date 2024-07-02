// router/index.js
import { createRouter, createWebHistory } from 'vue-router';
import Home from './Pages/justorange-default.vue'; // Sesuaikan path ke komponen Home

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
  },
  // Tambahkan rute lain di sini jika diperlukan
];

const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior(to, from, savedPosition) {
    if (to.hash) {
      return {
        el: to.hash,
        behavior: 'smooth',
      };
    } else if (savedPosition) {
      return savedPosition;
    } else {
      return { top: 0 };
    }
  },
});

export default router;
