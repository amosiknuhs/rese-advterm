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
import { StripeCheckout } from "@vue-stripe/vue-stripe";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";

Vue.config.productionTip = false;

window.Vue = Vue;

Vue.use(VueRouter);
Vue.use(AnimateCss);

Vue.component("header-component", HeaderComponent);
Vue.component("star-rating", StarRating);
Vue.component("slide-menu", Slide);
Vue.component("stripe-checkout", StripeCheckout);
Vue.component(VueQrcode.name, VueQrcode);
Vue.component("loading-overlay", Loading);

// エラーハンドリング共通化;
axios.interceptors.response.use(
    (response) => {
        return response;
    },
    (error) => {
        if (error.response.status == 401) {
            store.commit("setLogout");
            store.commit("outLoading");
            router.push("/rese/login/user-login");
        } else if (
            error.response.status == 403 &&
            error.response.data.message == "Your email address is not verified."
        ) {
            store.commit("outLoading");
            router.push("/rese/verify-notice");
        }
        return Promise.reject(error);
    }
);

const app = new Vue({
    el: "#app",
    router: router,
    store: store,
});
