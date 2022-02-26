<template>
    <div>
        <div class="desktop">
            <div v-if="isLogin">
                <div v-if="isRole == 'user'" class="rese-header" id="user">
                    <div class="header-content">
                        <router-link
                            v-bind:to="{ name: 'home' }"
                            class="header-title"
                            >Rese</router-link
                        >
                        <div class="nav-block">
                            <router-link
                                v-bind:to="{ name: 'home' }"
                                class="nav-link"
                                >HOME</router-link
                            >
                            <router-link
                                v-bind:to="{ name: 'reservation' }"
                                class="nav-link"
                                >Mypage</router-link
                            >
                            <p class="nav-link logout" @click="logout()">
                                Logout
                            </p>
                        </div>
                    </div>
                </div>
                <div v-if="isRole == 'owner'" class="rese-header" id="owner">
                    <div class="header-content">
                        <div class="header-title">Rese</div>
                        <div class="nav-block">
                            <router-link
                                v-bind:to="{ name: 'user-reservations' }"
                                class="nav-link"
                                >Reservation</router-link
                            >
                            <router-link
                                v-bind:to="{ name: 'owner-shop' }"
                                class="nav-link"
                                >ShopData</router-link
                            >
                            <p class="nav-link logout" @click="logout()">
                                Logout
                            </p>
                        </div>
                    </div>
                </div>
                <div v-if="isRole == 'admin'" class="rese-header" id="admin">
                    <div class="header-content">
                        <div class="header-title">Rese</div>
                        <div class="nav-block">
                            <router-link
                                v-bind:to="{ name: 'user-list' }"
                                class="nav-link"
                                >UserList</router-link
                            >
                            <router-link
                                v-bind:to="{ name: 'shop-list' }"
                                class="nav-link"
                                >ShopList</router-link
                            >
                            <router-link
                                v-bind:to="{ name: 'owner-list' }"
                                class="nav-link"
                                >OwnerList</router-link
                            >
                            <router-link
                                v-bind:to="{ name: 'email' }"
                                class="nav-link"
                                >Email</router-link
                            >
                            <p class="nav-link logout" @click="logout()">
                                Logout
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else-if="!isLogin" class="rese-header">
                <div class="header-content">
                    <router-link
                        v-bind:to="{ name: 'home' }"
                        class="header-title"
                        >Rese</router-link
                    >
                    <div class="nav-block">
                        <router-link
                            v-bind:to="{ name: 'home' }"
                            class="nav-link"
                            >HOME</router-link
                        >
                        <router-link
                            v-bind:to="{ name: 'register' }"
                            class="nav-link"
                            >Register</router-link
                        >
                        <router-link
                            v-bind:to="{ name: 'user-login' }"
                            class="nav-link"
                            >Login</router-link
                        >
                    </div>
                </div>
            </div>
        </div>
        <div class="mobile">
            <div v-if="isLogin">
                <div v-if="isRole == 'user'" class="rese-header" id="user">
                    <div class="header-content">
                        <router-link
                            v-bind:to="{ name: 'home' }"
                            class="header-title"
                            >Rese</router-link
                        >
                        <slide-menu
                            noOverlay
                            right
                            width="250"
                            :closeOnNavigation="true"
                        >
                            <router-link
                                v-bind:to="{ name: 'home' }"
                                class="nav-link"
                                >HOME</router-link
                            >
                            <router-link
                                v-bind:to="{ name: 'reservation' }"
                                class="nav-link"
                                >Mypage</router-link
                            >
                            <p class="nav-link logout" @click="logout()">
                                Logout
                            </p>
                        </slide-menu>
                    </div>
                </div>
                <div v-if="isRole == 'owner'" class="rese-header" id="owner">
                    <div class="header-content">
                        <div class="header-title">Rese</div>
                        <slide-menu
                            noOverlay
                            right
                            width="250"
                            :closeOnNavigation="true"
                        >
                            <router-link
                                v-bind:to="{ name: 'user-reservations' }"
                                class="nav-link"
                                >Reservation</router-link
                            >
                            <router-link
                                v-bind:to="{ name: 'owner-shop' }"
                                class="nav-link"
                                >ShopData</router-link
                            >
                            <p class="nav-link logout" @click="logout()">
                                Logout
                            </p>
                        </slide-menu>
                    </div>
                </div>
                <div v-if="isRole == 'admin'" class="rese-header" id="admin">
                    <div class="header-content">
                        <div class="header-title">Rese</div>
                        <slide-menu
                            noOverlay
                            right
                            width="250"
                            :closeOnNavigation="true"
                        >
                            <router-link
                                v-bind:to="{ name: 'user-list' }"
                                class="nav-link"
                                >UserList</router-link
                            >
                            <router-link
                                v-bind:to="{ name: 'shop-list' }"
                                class="nav-link"
                                >ShopList</router-link
                            >
                            <router-link
                                v-bind:to="{ name: 'owner-list' }"
                                class="nav-link"
                                >OwnerList</router-link
                            >
                            <router-link
                                v-bind:to="{ name: 'email' }"
                                class="nav-link"
                                >Email</router-link
                            >
                            <p class="nav-link logout" @click="logout()">
                                Logout
                            </p>
                        </slide-menu>
                    </div>
                </div>
            </div>
            <div v-else-if="!isLogin" class="rese-header">
                <div class="header-content">
                    <router-link
                        v-bind:to="{ name: 'home' }"
                        class="header-title"
                        >Rese</router-link
                    >
                    <slide-menu
                        noOverlay
                        right
                        width="250"
                        :closeOnNavigation="true"
                    >
                        <router-link
                            v-bind:to="{ name: 'home' }"
                            class="nav-link"
                            >HOME</router-link
                        >
                        <router-link
                            v-bind:to="{ name: 'register' }"
                            class="nav-link"
                            >Register</router-link
                        >
                        <router-link
                            v-bind:to="{ name: 'user-login' }"
                            class="nav-link"
                            >Login</router-link
                        >
                    </slide-menu>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {};
    },
    computed: {
        isLogin() {
            return this.$store.state.isLogin;
        },
        isRole() {
            return this.$store.state.role;
        },
    },
    methods: {
        async logout() {
            await axios.post("/api/logout").then((response) => {
                this.setLogout();
                this.$router.push("/rese/login/user-login");
            });
        },
        setLogout() {
            this.$store.commit("setLogout");
        },
    },
};
</script>

<style scoped>
.rese-header {
    position: fixed;
    height: 70px;
    width: 100%;
    top: 0;
    left: 0;
    background-color: #2f60ff;
    box-shadow: 0px 2px 4px gray;
}
.rese-header#user {
    background-color: #2f60ff;
}
.rese-header#owner {
    background-color: #552fff;
}
.rese-header#admin {
    background-color: #9a2fff;
}
.header-content {
    height: 100%;
    max-width: 1260px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
}
.header-title {
    color: #afafaf;
    font-weight: bold;
    font-size: 35px;
    height: 35px;
    margin: auto 0;
    text-decoration: none;
}
.header-title::before {
    content: "";
    background-image: url("/img/mainlogo.svg");
    display: inline-block;
    height: 35px;
    width: 35px;
    margin-right: 10px;
    vertical-align: top;
    background-size: contain;
}
.nav-block {
    height: 25px;
    margin: auto 0;
    display: flex;
    justify-content: flex-end;
    gap: 50px;
}
.nav-link {
    display: inline-block;
    text-decoration: none;
    color: #fff;
    font-size: 25px;
    font-weight: bold;
}
.logout {
    cursor: pointer;
}
.mobile {
    display: none;
}
@media screen and (max-width: 1260px) {
    .header-content {
        padding: 0 40px;
    }
}
/* ------- レスポンシブデザイン -------- */
@media screen and (max-width: 768px) {
    .header-content {
        max-width: 700px;
        padding: 0;
    }
    .desktop {
        display: none;
    }
    .mobile {
        display: block;
    }
    .header-title {
        padding-left: 10px;
    }
}
/* ------- メニューデザイン調整 ------- */
>>> .bm-menu {
    background-color: #afafaf;
}
>>> .bm-burger-button {
    top: 20px;
}
>>> .bm-burger-bars {
    background-color: #afafaf;
}
>>> .bm-cross {
    background-color: #fff;
    height: 25px !important;
    width: 5px !important;
}
>>> .cross-style {
    right: 190px !important;
    top: 22px;
}
</style>
