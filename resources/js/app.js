require("./bootstrap");

import Vue from "vue";
import VueRouter from "vue-router";
import router from "./router";
import store from "./store";
import axios from "axios";
import HeaderComponent from "./components/HeaderComponent.vue";
import StarRating from "vue-star-rating";
import "./plugins/veevalidate";

// import AnimateCss from "animate.css";

Vue.config.productionTip = false;

window.Vue = Vue;

Vue.use(VueRouter);
// Vue.use(AnimateCss);

Vue.component("header-component", HeaderComponent);
Vue.component("star-rating", StarRating);

// エラーハンドリング共通化;
axios.interceptors.response.use(
    (response) => {
        return response;
    },
    (error) => {
        if (error.response.status == 401) {
            localStorage.removeItem("auth");
            router.push("/login");
        }
        return Promise.reject(error);
    }
);

const app = new Vue({
    el: "#app",
    router: router,
    store: store,
});
