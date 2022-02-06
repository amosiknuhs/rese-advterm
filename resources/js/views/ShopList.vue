<template>
    <div>
        <div class="list-header">
            <p class="list-title">飲食店リスト</p>
            <!-- <router-link
                v-bind:to="{
                    name: 'shop-register',
                }"
                class="shop-register"
            >
                <button>飲食店新規登録</button>
            </router-link> -->
        </div>
        <table class="shops-table">
            <colgroup span="1" class="shop-id"></colgroup>
            <colgroup span="1" class="shop-name"></colgroup>
            <colgroup span="1" class="shop-area"></colgroup>
            <colgroup span="1" class="shop-genre"></colgroup>
            <colgroup span="1" class="shop-content"></colgroup>
            <tr>
                <th>飲食店ID</th>
                <th>店名</th>
                <th>エリア</th>
                <th>ジャンル</th>
                <th>店舗説明</th>
            </tr>
            <tr class="" v-for="(shop, index) in shops" :key="index">
                <td>{{ shop.id }}</td>
                <td>{{ shop.name }}</td>
                <td>{{ shop.area.name }}</td>
                <td>{{ shop.genre.name }}</td>
                <td class="content">{{ shop.content }}</td>
            </tr>
        </table>
        <router-view></router-view>
    </div>
</template>
<script>
export default {
    data: function () {
        return {
            shops: "",
        };
    },
    methods: {
        async getShopList() {
            await axios.get("/api/shop-list").then((response) => {
                this.shops = response.data;
            });
        },
    },
    mounted() {
        this.getShopList();
    },
    // beforeRouteUpdate(to, from, next) {
    //     if (from.name == "admin-dialog") {
    //         this.getShopList();
    //         next();
    //     }
    //     next();
    // },
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
.shop-register button {
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

.shops-table {
    width: 100%;
    text-align: center;
    background-color: #fff;
    border-radius: 0 0 10px 10px;
    overflow: hidden;
}
.shops-table th {
    background-color: #afafaf;
    color: #fff;
    padding: 20px 0;
}
.shops-table td {
    padding: 20px 0;
}
.shops-table tr:not(:last-of-type) {
    border-bottom: 1px solid #d1d5db;
}
.shop-id {
    width: 10%;
}
.shop-name {
    width: 15%;
}
.shop-area {
    width: 15%;
}
.shop-genre {
    width: 15%;
}
.shop-content {
    width: 45%;
}
.content {
    display: block;
    width: 500px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin: 0 auto;
}
</style>
