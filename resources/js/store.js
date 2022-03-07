import Vue from "vue";
import Vuex from "vuex";
import createPersistedState from "vuex-persistedstate";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        isLogin: false,
        isLoading: false,
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
        setLoading(state) {
            state.isLoading = true;
        },
        outLoading(state) {
            state.isLoading = false;
        },
    },
    plugins: [createPersistedState()],
});
