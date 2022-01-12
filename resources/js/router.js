import Router from "vue-router";
import NotFound from "./views/NotFound.vue";
import Home from "./views/Home.vue";
import Detail from "./views/Detail.vue";
import Login from "./views/Login.vue";
import Register from "./views/Register.vue";
import Mypage from "./views/Mypage.vue";
import Thanks from "./views/Thanks.vue";
import Done from "./views/Done.vue";

const router = new Router({
    mode: "history",
    routes: [
        {
            path: "*",
            name: "notfound",
            component: NotFound,
        },
        {
            path: "/",
            name: "home",
            component: Home,
        },
        {
            path: "/detail/:shop_id",
            name: "detail",
            component: Detail,
        },
        {
            path: "/login",
            name: "login",
            component: Login,
            meta: { guestOnly: true },
        },
        {
            path: "/register",
            name: "register",
            component: Register,
            meta: { guestOnly: true },
        },
        {
            path: "/mypage",
            name: "mypage",
            component: Mypage,
            meta: { authOnly: true },
        },
        {
            path: "/thanks",
            name: "thanks",
            component: Thanks,
        },
        {
            path: "/done",
            name: "done",
            component: Done,
        },
    ],
});

function isLoggedIn() {
    return localStorage.getItem("auth");
}

router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.authOnly)) {
        if (!isLoggedIn()) {
            next("/login");
        } else {
            next();
        }
    } else if (to.matched.some((record) => record.meta.guestOnly)) {
        if (isLoggedIn()) {
            next("/mypage");
        } else {
            next();
        }
    } else {
        next();
    }
});

export default router;
