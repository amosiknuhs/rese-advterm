import Vue from "vue";
import Vuex from "vuex";
import createPersistedState from "vuex-persistedstate";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        isLogin: false,
    },
    getters: {},
    mutations: {
        setLogin(state) {
            state.isLogin = true;
        },
        setLogout() {
            state.isLogin = false;
        },
    },
    plugins: [
        createPersistedState({
            key: "auth",
            paths: ["isLogin"],
        }),
    ],
});
