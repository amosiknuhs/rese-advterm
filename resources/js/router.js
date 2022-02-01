import Router from "vue-router";
import store from "./store";
import NotFound from "./views/NotFound.vue";
import Home from "./views/Home.vue";
import Detail from "./views/Detail.vue";
import Login from "./views/Login.vue";
import Register from "./views/Register.vue";
import Mypage from "./views/Mypage.vue";
import Thanks from "./views/Thanks.vue";
import Done from "./views/Done.vue";
import ChangeReserve from "./views/ChangeReserve.vue";
import Evaluation from "./views/Evaluation.vue";
import MypageDialog from "./views/MypageDialog.vue";
import Cancel from "./views/Cancel.vue";
import Reservation from "./views/Reservation.vue";
import Favorite from "./views/Favorite.vue";
import userLogin from "./views/userLogin.vue";
import ownerLogin from "./views/ownerLogin.vue";
import adminLogin from "./views/adminLogin.vue";
import ConfirmReserve from "./views/ConfirmReserve.vue";

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
            children: [
                {
                    path: "confirm-reserve",
                    name: "confirm-reserve",
                    component: ConfirmReserve,
                },
            ],
        },
        {
            path: "/login",
            name: "login",
            component: Login,
            meta: { guestOnly: true },
            children: [
                {
                    path: "user",
                    name: "user",
                    component: userLogin,
                },
                {
                    path: "owner",
                    name: "owner",
                    component: ownerLogin,
                },
                {
                    path: "admin",
                    name: "admin",
                    component: adminLogin,
                },
            ],
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
            children: [
                {
                    path: "reservation",
                    name: "reservation",
                    component: Reservation,
                    children: [
                        {
                            path: "change-reserve",
                            name: "change-reserve",
                            component: ChangeReserve,
                        },
                        {
                            path: "evaluation",
                            name: "evaluation",
                            component: Evaluation,
                        },
                        {
                            path: "cancel",
                            name: "cancel",
                            component: Cancel,
                        },
                        {
                            path: "dialog",
                            name: "dialog",
                            component: MypageDialog,
                        },
                    ],
                },
                {
                    path: "favorite",
                    name: "favorite",
                    component: Favorite,
                },
            ],
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
    // 画面遷移時のスクロール位置制御
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition;
        } else if (to.name == "detail") {
            return { x: 0, y: 0 };
        }
    },
});

function isLoggedIn() {
    return store.state.isLogin;
}

router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.authOnly)) {
        if (!isLoggedIn()) {
            next("/login/user");
        } else {
            next();
        }
    } else if (to.matched.some((record) => record.meta.guestOnly)) {
        if (isLoggedIn()) {
            next("/mypage/reservation");
        } else {
            next();
        }
    } else {
        next();
    }
});

export default router;
