require('./bootstrap');

import * as Vue from 'vue';
import * as VueRouter from 'vue-router';
import AppComponent from "./components/AppComponent.vue";
import CartComponent from "./components/CartComponent.vue";
import AdminDashboardComponent from "./components/AdminDashboardComponent.vue";

import mitt from 'mitt';
const emitter = mitt();

const routes = [
    { path: '/', component: AppComponent },
    { path: '/cart', component: CartComponent },
    { path: '/admin', component: AdminDashboardComponent }
]

const router = VueRouter.createRouter({
    history: VueRouter.createWebHistory(),
    routes,
})

const app = Vue.createApp({ AppComponent });
app.config.globalProperties.emitter = emitter;
app.use(router);
app.mount("#app");