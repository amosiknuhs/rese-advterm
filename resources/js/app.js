require("./bootstrap");

import Vue from "vue";
import VueRouter from "vue-router";
import router from "./router";
import HeaderComponent from "./components/HeaderComponent.vue";

window.Vue = Vue;

// vue-routerを使う宣言
Vue.use(VueRouter);

// HeaderComponentをグローバル登録している
Vue.component("header-component", HeaderComponent);

const app = new Vue({
    el: "#app",
    router: router,
});
