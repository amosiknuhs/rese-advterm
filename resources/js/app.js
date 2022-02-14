require("./bootstrap");

import Vue from "vue";
import VueRouter from "vue-router";
import router from "./router";
import store from "./store";
import axios from "axios";
import HeaderComponent from "./components/HeaderComponent.vue";
import StarRating from "vue-star-rating";
import "./plugins/veevalidate";
import AnimateCss from "animate.css";
import { Slide } from "vue-burger-menu";
import VueQrcode from "@chenfengyuan/vue-qrcode";

Vue.config.productionTip = false;

window.Vue = Vue;

Vue.use(VueRouter);
Vue.use(AnimateCss);

Vue.component("header-component", HeaderComponent);
Vue.component("star-rating", StarRating);
Vue.component("slide-menu", Slide);
Vue.component(VueQrcode.name, VueQrcode);

// エラーハンドリング共通化;
axios.interceptors.response.use(
    (response) => {
        return response;
    },
    (error) => {
        if (error.response.status == 401) {
            store.commit("setLogout");
            router.push("/rese/login/user-login");
        }
        return Promise.reject(error);
    }
);

const app = new Vue({
    el: "#app",
    router: router,
    store: store,
});
