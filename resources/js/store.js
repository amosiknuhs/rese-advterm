import Vue from "vue";
import Vuex from "vuex";
import createPersistedState from "vuex-persistedstate";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        isLogin: false,
        role: "",
    },
    getters: {},
    mutations: {
        setLogin(state) {
            state.isLogin = true;
        },
        setLogout(state) {
            state.isLogin = false;
            state.role = "";
        },
        setRole(state, role) {
            state.role = role;
        },
    },
    plugins: [createPersistedState()],
});
