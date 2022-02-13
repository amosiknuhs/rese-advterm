<template>
    <div>
        <div class="list-header">
            <p class="list-title">ユーザーリスト</p>
            <!-- <router-link
                v-bind:to="{
                    name: 'owner-register',
                }"
                class="owner-register"
            >
                <button>ユーザー新規登録</button>
            </router-link> -->
        </div>
        <table class="user-table">
            <colgroup span="1" class="user-id"></colgroup>
            <colgroup span="1" class="user-name"></colgroup>
            <colgroup span="1" class="user-email"></colgroup>
            <colgroup span="1" class="user-button"></colgroup>
            <tr>
                <th>ID</th>
                <th>名前</th>
                <th>メールアドレス</th>
                <th></th>
            </tr>
            <tr class="" v-for="(user, index) in users" :key="index">
                <td>{{ user.id }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>削除ボタン</td>
            </tr>
        </table>
        <router-view></router-view>
    </div>
</template>
<script>
export default {
    data: function () {
        return {
            users: "",
        };
    },
    methods: {
        async getUserList() {
            await axios.get("/api/user-list").then((response) => {
                this.users = response.data;
            });
        },
    },
    mounted() {
        this.getUserList();
    },
    beforeRouteUpdate(to, from, next) {
        if (from.name == "admin-dialog") {
            this.getUserList();
            next();
        }
        next();
    },
};
</script>
<style scoped>
.list-header {
    height: 70px;
    width: 100%;
    background-color: #9a2fff;
    border-radius: 10px 10px 0 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-right: 30px;
}
.list-header > * {
    display: inline-block;
}
.owner-register button {
    border: none;
    background-color: #fff;
    color: #9a2fff;
    font-weight: bold;
    font-size: 15px;
    padding: 10px 30px;
    border-radius: 5px;
    cursor: pointer;
    width: 180px;
}
.list-title {
    text-decoration: none;
    font-size: 25px;
    font-weight: bold;
    line-height: 70px;
    color: #fff;
    padding-left: 30px;
}
.user-table {
    width: 100%;
    text-align: center;
    background-color: #fff;
    border-radius: 0 0 10px 10px;
    overflow: hidden;
}
.user-table th {
    background-color: #afafaf;
    color: #fff;
    padding: 20px 0;
}
.user-table td {
    padding: 20px 0;
}
.user-table tr:not(:last-of-type) {
    border-bottom: 1px solid #d1d5db;
}
.user-id {
    width: 10%;
}
.user-name {
    width: 30%;
}
.user-email {
    width: 30%;
}
.user-button {
    width: 30%;
}
</style>
