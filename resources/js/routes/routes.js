import { createRouter, createWebHistory } from 'vue-router';

import Shop from '@/Pages/Shops/ShopList.vue';
import DashBoard from '@/Pages/Dashboard.vue';

const routes = [
  {
    path: '/',
    name: 'Dashboard',
    component: DashBoard,
  },
  {
    path: '/shop',
    name: 'Shop',
    component: Shop,
  },
];
const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
