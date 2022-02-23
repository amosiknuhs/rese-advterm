<template>
    <div>
        <div class="list-header">
            <p class="list-title">飲食店リスト</p>
        </div>
        <div class="desktop">
            <table class="shops-table">
                <colgroup span="1" class="shop-id"></colgroup>
                <colgroup span="1" class="shop-name"></colgroup>
                <colgroup span="1" class="shop-area"></colgroup>
                <colgroup span="1" class="shop-genre"></colgroup>
                <colgroup span="1" class="shop-content"></colgroup>
                <tr>
                    <th>ID</th>
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
        </div>
        <div class="mobile">
            <table
                class="shops-table"
                v-for="(shop, index) in shops"
                :key="index"
            >
                <colgroup span="1" class="title"></colgroup>
                <colgroup span="1" class="desc"></colgroup>
                <tr>
                    <th>ID</th>
                    <td>{{ shop.id }}</td>
                </tr>
                <tr>
                    <th>店名</th>
                    <td>{{ shop.name }}</td>
                </tr>
                <tr>
                    <th>エリア</th>
                    <td>{{ shop.area.name }}</td>
                </tr>
                <tr>
                    <th>ジャンル</th>
                    <td>{{ shop.genre.name }}</td>
                </tr>
                <tr>
                    <th>店舗説明</th>
                    <td class="content">{{ shop.content }}</td>
                </tr>
            </table>
        </div>
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
.mobile {
    display: none;
}
/* ------- タブレットデザイン -------- */
@media screen and (max-width: 768px) {
    .content {
        display: block;
        width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin: 0 auto;
    }
}
/* ------ スマートフォンデザイン ------ */
@media screen and (max-width: 480px) {
    .desktop {
        display: none;
    }
    .mobile {
        display: initial;
    }
    .shops-table th,
    .shops-table td {
        padding: 10px 0;
    }
    .title {
        width: 25%;
    }
    .desc {
        width: 75%;
    }
    .content {
        width: 250px;
    }
    .shops-table:not(:last-of-type) {
        border-radius: 0;
    }
    .shops-table tr:not(:last-of-type) {
        border-bottom: none;
    }
    .shops-table:not(:last-of-type) {
        border-bottom: 1px solid #d1d5db;
    }
}
</style>
