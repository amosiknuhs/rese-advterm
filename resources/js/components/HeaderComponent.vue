<template>
    <div>
        <div class="rese-header">
            <router-link v-bind:to="{ name: 'home' }" class="header-title"
                >Rese</router-link
            >
            <!-- <div v-if="isLogin" class="nav-block">
                <router-link v-bind:to="{ name: 'home' }" class="nav-link"
                    >HOME</router-link
                >
                <p class="nav-link logout" @click="logout()">Logout</p>
                <router-link v-bind:to="{ name: 'mypage' }" class="nav-link"
                    >Mypage</router-link
                >
            </div>
            <div v-else-if="!isLogin" class="nav-block">
                <router-link v-bind:to="{ name: 'home' }" class="nav-link"
                    >HOME</router-link
                >
                <router-link v-bind:to="{ name: 'register' }" class="nav-link"
                    >Register</router-link
                >
                <router-link v-bind:to="{ name: 'login' }" class="nav-link"
                    >Login</router-link
                >
            </div> -->

            <div class="nav-block">
                <router-link v-bind:to="{ name: 'home' }" class="nav-link"
                    >HOME</router-link
                >
                <p class="nav-link logout" @click="logout()">Logout</p>
                <router-link v-bind:to="{ name: 'mypage' }" class="nav-link"
                    >Mypage</router-link
                >
                <router-link v-bind:to="{ name: 'home' }" class="nav-link"
                    >HOME</router-link
                >
                <router-link v-bind:to="{ name: 'register' }" class="nav-link"
                    >Register</router-link
                >
                <router-link v-bind:to="{ name: 'login' }" class="nav-link"
                    >Login</router-link
                >
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            // isLogin: "",
        };
    },
    computed: {
        count() {
            return this.$store.state.count;
        },
        isLogin() {
            return localStorage.getItem("auth");
            // return this.$store.state.isLogin;
        },
    },
    methods: {
        // getAuth() {
        //     this.isLogin = localStorage.getItem("auth");
        // },
        async logout() {
            await axios.post("/api/logout").then((response) => {
                localStorage.removeItem("auth");
                // this.setLogout();
                this.$router.push("/login");
            });
        },
        setLogout() {
            this.$store.commit("setLogout");
        },
    },
    // mounted() {
    //     this.getAuth();
    // },
    beforeRouteEnter(to, from, next) {
        console.log("beforeRouteEnter");
        next();
    },
    beforeRouteUpdate(to, from, next) {
        console.log("beforeRouteUpdate");
        next();
    },
    beforeRouteLeave(to, from, next) {
        console.log("beforeRouteLeave");
        next();
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
    justify-content: space-between;
    box-shadow: 0px 2px 4px gray;
}
.header-title {
    color: #afafaf;
    font-weight: bold;
    font-size: 35px;
    font-family: "Hiragino Sans", "ヒラギノ角ゴシック";
    /* display: block; */
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
    font-family: "Hiragino Sans", "ヒラギノ角ゴシック";
}
.logout {
    cursor: pointer;
}
</style>
