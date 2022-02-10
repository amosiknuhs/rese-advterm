import Router from "vue-router";
import store from "./store";
import NotFound from "./views/NotFound.vue";
import Home from "./views/Home.vue";
import Detail from "./views/Detail.vue";
import Login from "./views/Login.vue";
import Register from "./views/Register.vue";
import Mypage from "./views/Mypage.vue";
import Thanks from "./views/Thanks.vue";
import ThanksMailVerify from "./views/ThanksMailVerify.vue";
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
import UserReservations from "./views/UserReservations.vue";
import OwnerShop from "./views/OwnerShop.vue";
import OwnerShopEdit from "./views/OwnerShopEdit.vue";
import OwnerDialog from "./views/OwnerDialog.vue";
import Admin from "./views/Admin.vue";
import OwnerList from "./views/OwnerList.vue";
import UserList from "./views/UserList.vue";
import ShopList from "./views/ShopList.vue";
import OwnerRegister from "./views/OwnerRegister.vue";
import OwnerRegisterDialog from "./views/OwnerRegisterDialog.vue";
import ShopRegister from "./views/ShopRegister.vue";
import Email from "./views/Email.vue";
import EmailDialog from "./views/EmailDialog.vue";

const router = new Router({
    mode: "history",
    routes: [
        {
            path: "*",
            name: "notfound",
            component: NotFound,
        },
        {
            path: "/rese/home",
            name: "home",
            component: Home,
        },
        {
            path: "/rese/detail/:shop_id",
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
            path: "/rese/login",
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
            path: "/rese/register",
            name: "register",
            component: Register,
            meta: { guestOnly: true },
        },
        {
            path: "/rese/mypage",
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
            path: "/rese/thanks",
            name: "thanks",
            component: Thanks,
        },
        {
            path: "/rese/thanks-mail-verify",
            name: "thanks-mail-verify",
            component: ThanksMailVerify,
        },
        {
            path: "/rese/done",
            name: "done",
            component: Done,
        },
        {
            path: "/rese/owner",
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
                    path: "shop",
                    name: "owner-shop",
                    component: OwnerShop,
                    children: [
                        {
                            path: "edit",
                            name: "shop-edit",
                            component: OwnerShopEdit,
                        },
                        {
                            path: "complete",
                            name: "owner-dialog",
                            component: OwnerDialog,
                        },
                    ],
                },
            ],
        },
        {
            path: "/rese/admin",
            name: "admin",
            component: Admin,
            meta: { adminOnly: true },
            children: [
                {
                    path: "owner-list",
                    name: "owner-list",
                    component: OwnerList,
                    children: [
                        {
                            path: "owner-register",
                            name: "owner-register",
                            component: OwnerRegister,
                        },
                        {
                            path: "complete",
                            name: "owner-register-dialog",
                            component: OwnerRegisterDialog,
                        },
                    ],
                },
                {
                    path: "user-list",
                    name: "user-list",
                    component: UserList,
                },
                {
                    path: "shop-list",
                    name: "shop-list",
                    component: ShopList,
                    children: [
                        {
                            path: "shop-register",
                            name: "shop-register",
                            component: ShopRegister,
                        },
                    ],
                },
                {
                    path: "email",
                    name: "email",
                    component: Email,
                    children: [
                        {
                            path: "complete",
                            name: "email-dialog",
                            component: EmailDialog,
                        },
                    ],
                },
            ],
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
            next("/rese/login/user-login");
        } else {
            next();
        }
    } else if (to.matched.some((record) => record.meta.guestOnly)) {
        if (isLoggedIn()) {
            next("/rese/mypage/reservation");
        } else {
            next();
        }
    } else {
        next();
    }
});

export default router;
