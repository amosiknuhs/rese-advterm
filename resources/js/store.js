import Vue from "vue";
import Vuex from "vuex";
import createPersistedState from "vuex-persistedstate";

Vue.use(Vuex);

// const initialState = {
//     isLogin: false,
// };

export default new Vuex.Store({
    // state: initialState,
    state: {
        isLogin: false,
    },
    getters: {},
    mutations: {
        setLogin(state) {
            state.isLogin = true;
        },
        setLogout(state) {
            state.isLogin = false;
        },
    },
    plugins: [createPersistedState()],
});
