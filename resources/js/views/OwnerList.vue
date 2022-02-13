<template>
    <div>
        <div class="list-header">
            <p class="list-title">店舗オーナーリスト</p>
            <router-link
                v-bind:to="{
                    name: 'owner-register',
                }"
                class="owner-register"
            >
                <button>オーナー新規登録</button>
            </router-link>
        </div>
        <table class="owners-table">
            <colgroup span="1" class="owner-id"></colgroup>
            <colgroup span="1" class="owner-name"></colgroup>
            <colgroup span="1" class="owner-email"></colgroup>
            <colgroup span="1" class="owner-shop-name"></colgroup>
            <colgroup span="1" class="owner-button"></colgroup>
            <tr>
                <th>ID</th>
                <th>名前</th>
                <th>メールアドレス</th>
                <th>店舗名</th>
                <th></th>
            </tr>
            <tr class="" v-for="(owner, index) in owners" :key="index">
                <td>{{ owner.id }}</td>
                <td>{{ owner.name }}</td>
                <td>{{ owner.email }}</td>
                <td>{{ owner.shop.name }}</td>
                <td>削除・変更ボタン</td>
            </tr>
        </table>
        <router-view></router-view>
    </div>
</template>
<script>
export default {
    data: function () {
        return {
            owners: "",
        };
    },
    methods: {
        async getOwnerList() {
            await axios.get("/api/owner-list").then((response) => {
                this.owners = response.data;
            });
        },
    },
    mounted() {
        this.getOwnerList();
    },
    beforeRouteUpdate(to, from, next) {
        if (from.name == "owner-register-dialog") {
            this.getOwnerList();
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
.owners-table {
    width: 100%;
    text-align: center;
    background-color: #fff;
    border-radius: 0 0 10px 10px;
    overflow: hidden;
}
.owners-table th {
    background-color: #afafaf;
    color: #fff;
    padding: 20px 0;
}
.owners-table td {
    padding: 20px 0;
}
.owners-table tr:not(:last-of-type) {
    border-bottom: 1px solid #d1d5db;
}
.owner-id {
    width: 10%;
}
.owner-name {
    width: 20%;
}
.owner-email {
    width: 20%;
}
.owner-shop-name {
    width: 20%;
}
.owner-button {
    width: 30%;
}
</style>
