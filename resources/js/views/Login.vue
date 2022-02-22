<template>
    <div class="login-content">
        <div class="login-box">
            <div class="role-tab">
                <router-link
                    v-bind:to="{ name: 'user-login' }"
                    class="userLogin"
                    >ユーザー</router-link
                >
                <router-link
                    v-bind:to="{ name: 'owner-login' }"
                    class="ownerLogin"
                    >店舗オーナー</router-link
                >
                <router-link
                    v-bind:to="{ name: 'admin-login' }"
                    class="adminLogin"
                    >管理者</router-link
                >
            </div>
            <router-view></router-view>
        </div>
    </div>
</template>
<style scoped>
.login-content {
    height: 80vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
.login-box {
    background-color: #ffffff;
    box-shadow: 2px 2px 4px gray;
    border-radius: 5px;
    width: 500px;
    overflow: hidden;
}
.role-tab {
    height: 30px;
    font-size: 0;
}
.role-tab * {
    font-size: 16px;
    display: inline-block;
    text-decoration: none;
    color: #fff;
    height: 30px;
    line-height: 30px;
    text-align: center;
    width: calc(100% / 3);
    margin: 0;
}
.userLogin {
    background-color: #2f60ff;
}
.ownerLogin {
    background-color: #552fff;
}
.adminLogin {
    background-color: #9a2fff;
}
</style>
