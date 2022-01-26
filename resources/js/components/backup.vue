<template>
    <div>
        <div class="drawer-bg" id="drawer-bg"></div>
        <div class="rese-header">
            <div class="menu" id="menu" @click="openDrawer">
                <span class="menu__line--top"></span>
                <span class="menu__line--middle"></span>
                <span class="menu__line--bottom"></span>
            </div>
            <div class="header-title">Rese</div>
            <nav class="header-nav" id="header-nav" @click="closeDrawer">
                <div class="header-nav-top"></div>
                <ul v-if="isLogin == 'true'">
                    <li>
                        <router-link
                            v-bind:to="{ name: 'home' }"
                            class="nav-link"
                            >HOME</router-link
                        >
                    </li>
                    <li>
                        <span class="nav-link logout" @click="logout()"
                            >Logout</span
                        >
                    </li>
                    <li>
                        <router-link
                            v-bind:to="{ name: 'mypage' }"
                            class="nav-link"
                            >Mypage</router-link
                        >
                    </li>
                </ul>
                <ul v-else>
                    <li>
                        <router-link
                            v-bind:to="{ name: 'home' }"
                            class="nav-link"
                            >HOME</router-link
                        >
                    </li>
                    <li>
                        <router-link
                            v-bind:to="{ name: 'register' }"
                            class="nav-link"
                            >Register</router-link
                        >
                    </li>
                    <li>
                        <router-link
                            v-bind:to="{ name: 'login' }"
                            class="nav-link"
                            >Login</router-link
                        >
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            isLogin: "",
        };
    },
    methods: {
        openDrawer: function () {
            document.getElementById("menu").classList.toggle("open");
            document.getElementById("header-nav").classList.toggle("in");
            this.isLogin = localStorage.getItem("auth");
        },
        closeDrawer: function (e) {
            if (e.target.tagName == "A" || e.target.tagName == "SPAN") {
                document.getElementById("menu").classList.toggle("open");
                document.getElementById("header-nav").classList.toggle("in");
                this.isLogin = localStorage.getItem("auth");
            }
        },
        async logout() {
            await axios.post("/api/logout").then((response) => {
                localStorage.removeItem("auth");
                this.$router.push("/login");
            });
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
    padding: 0 100px;
    background-color: #2f60ff;
    display: flex;
}
.header-title {
    color: #afafaf;
    font-weight: bold;
    font-size: 30px;
    font-family: "Hiragino Sans", "ヒラギノ角ゴシック";
    display: block;
    height: 30px;
    margin: auto 20px;
}

/* ----------メニューウィンドウ部分 ---------- */
.header-nav-top {
    height: 70px;
    background-color: #2f60ff;
}
.header-nav {
    position: absolute;
    height: 100vh;
    width: 30%;
    left: -30%;
    background-color: #ffffff;
    transition: 0.5s;
    text-align: center;
    z-index: 1;
}
.header-nav ul {
    padding-top: 80px;
}
.header-nav ul li {
    list-style-type: none;
    padding: 30px 0;
    margin: 0 50px;
    border-bottom: 1px solid #2f60ff;
}
.nav-link {
    display: inline-block;
    text-decoration: none;
    color: #2f60ff;
    font-size: 30px;
    font-weight: bold;
}
.logout {
    cursor: pointer;
}
.menu {
    background-color: #afafaf;
    border-radius: 5px;
    /* box-shadow: 2px 2px 4px gray; */
    display: block;
    width: 40px;
    height: 40px;
    margin: auto 0;
    cursor: pointer;
    position: relative;
    /* top: 30px; */
    z-index: 2;
}
.menu__line--top,
.menu__line--middle,
.menu__line--bottom {
    display: inline-block;
    height: 2px;
    background-color: #ffffff;
    position: absolute;
    transition: 0.5s;
}
.menu__line--top {
    width: 30%;
    top: 10px;
    left: 10px;
}
.menu__line--middle {
    width: 50%;
    top: 19px;
    left: 10px;
}
.menu__line--bottom {
    width: 20%;
    bottom: 10px;
    left: 10px;
}
.menu.open span:nth-of-type(1) {
    width: 50%;
    top: 19px;
    transform: rotate(45deg);
}
.menu.open span:nth-of-type(2) {
    opacity: 0;
}
.menu.open span:nth-of-type(3) {
    width: 50%;
    top: 19px;
    transform: rotate(-45deg);
}
.in {
    transform: translateX(100%);
}

/* ----------メニュー背景部分 ---------- */
.drawer-bg {
    /* position: fixed;
    left: 0%;
    top: 0%;
    height: 100vh;
    width: 100vw;
    background-color: rgba(0, 0, 0, 0.3); */
}
</style>
