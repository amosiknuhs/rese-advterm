import Router from "vue-router";
import store from "./store";
// views
import NotFound from "./views/NotFound.vue";
import Home from "./views/Home.vue";
import Detail from "./views/Detail.vue";
import Login from "./views/Login.vue";
import Register from "./views/Register.vue";
import Mypage from "./views/Mypage.vue";
import Thanks from "./views/Thanks.vue";
import ThanksMailVerify from "./views/ThanksMailVerify.vue";
import VerifyNotice from "./views/VerifyNotice.vue";
import Done from "./views/Done.vue";
import PaymentSuccess from "./views/PaymentSuccess.vue";
import PaymentCancel from "./views/PaymentCancel.vue";
import Owner from "./views/Owner.vue";
import Admin from "./views/Admin.vue";
// components
import ConfirmReserve from "./components/ConfirmReserve.vue";
import UserLogin from "./components/UserLogin.vue";
import OwnerLogin from "./components/OwnerLogin.vue";
import AdminLogin from "./components/AdminLogin.vue";
import Reservation from "./components/Reservation.vue";
import Favorite from "./components/Favorite.vue";
import UserReservations from "./components/UserReservations.vue";
import OwnerShop from "./components/OwnerShop.vue";
import OwnerList from "./components/OwnerList.vue";
import OwnerRegisterDialog from "./components/OwnerRegisterDialog.vue";
import UserList from "./components/UserList.vue";
import ShopList from "./components/ShopList.vue";
import Email from "./components/Email.vue";
// modals
import ChangeReserve from "./modals/ChangeReserve.vue";
import Evaluation from "./modals/Evaluation.vue";
import ConfirmPayment from "./modals/ConfirmPayment.vue";
import Cancel from "./modals/Cancel.vue";
import MypageDialog from "./modals/MypageDialog.vue";
import ReserveCode from "./modals/ReserveCode.vue";
import OwnerShopEdit from "./modals/OwnerShopEdit.vue";
import ShopImageEdit from "./modals/ShopImageEdit.vue";
import OwnerDialog from "./modals/OwnerDialog.vue";
import OwnerRegister from "./modals/OwnerRegister.vue";
import EmailDialog from "./modals/EmailDialog.vue";

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
                            path: "confirm-payment",
                            name: "confirm-payment",
                            component: ConfirmPayment,
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
                        {
                            path: "reserve-code",
                            name: "reserve-code",
                            component: ReserveCode,
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
            path: "/rese/verify-notice",
            name: "verify-notice",
            component: VerifyNotice,
        },
        {
            path: "/rese/done",
            name: "done",
            component: Done,
        },
        {
            path: "/rese/payment-success",
            name: "payment-success",
            component: PaymentSuccess,
        },
        {
            path: "/rese/payment-cancel",
            name: "payment-cancel",
            component: PaymentCancel,
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
                            path: "image",
                            name: "image-edit",
                            component: ShopImageEdit,
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
