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
import UserLogin from "./views/UserLogin.vue";
import OwnerLogin from "./views/OwnerLogin.vue";
import AdminLogin from "./views/AdminLogin.vue";
import ConfirmReserve from "./views/ConfirmReserve.vue";
import Owner from "./views/Owner.vue";
import Admin from "./views/Admin.vue";
import UserReservations from "./views/UserReservations.vue";
import OwnerShop from "./views/OwnerShop.vue";

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
                    path: "user-login",
                    name: "user-login",
                    component: UserLogin,
                },
                {
                    path: "owner-login",
                    name: "owner-login",
                    component: OwnerLogin,
                },
                {
                    path: "admin-login",
                    name: "admin-login",
                    component: AdminLogin,
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
        {
            path: "/owner",
            name: "owner",
            component: Owner,
            meta: { ownerOnly: true },
            children: [
                {
                    path: "user-reservations",
                    name: "user-reservations",
                    component: UserReservations,
                },
                {
                    path: "owner-shop",
                    name: "owner-shop",
                    component: OwnerShop,
                },
            ],
        },
        {
            path: "/admin",
            name: "admin",
            component: Admin,
            meta: { adminOnly: true },
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
            next("/login/user-login");
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
