<template>
    <div class="rese-header">
        <div class="header-content">
            <router-link v-bind:to="{ name: 'home' }" class="header-title"
                >Rese</router-link
            >
            <p class="nav-link logout" @click="logout()">Logout</p>

            <div v-if="isLogin" class="nav-block">
                <router-link v-bind:to="{ name: 'home' }" class="nav-link"
                    >HOME</router-link
                >
                <router-link
                    v-bind:to="{ name: 'reservation' }"
                    class="nav-link"
                    >Mypage</router-link
                >
                <p class="nav-link logout" @click="logout()">Logout</p>
            </div>
            <div v-else-if="!isLogin" class="nav-block">
                <router-link v-bind:to="{ name: 'home' }" class="nav-link"
                    >HOME</router-link
                >
                <router-link v-bind:to="{ name: 'register' }" class="nav-link"
                    >Register</router-link
                >
                <router-link v-bind:to="{ name: 'user' }" class="nav-link"
                    >Login</router-link
                >
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
    },
    methods: {
        async logout() {
            await axios.post("/api/logout").then((response) => {
                this.setLogout();
                this.$router.push("/login/user");
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
    font-family: "Hiragino Sans", "ヒラギノ角ゴシック";
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
