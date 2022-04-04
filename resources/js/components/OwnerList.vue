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
        <div class="desktop">
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
                    <td><button>オーナー詳細</button></td>
                </tr>
            </table>
        </div>
        <div class="mobile">
            <table
                class="owners-table"
                v-for="(owner, index) in owners"
                :key="index"
            >
                <colgroup span="1" class="title"></colgroup>
                <colgroup span="1" class="content"></colgroup>
                <tr>
                    <th>ID</th>
                    <td>{{ owner.id }}</td>
                </tr>
                <tr>
                    <th>名前</th>
                    <td>{{ owner.name }}</td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td>{{ owner.email }}</td>
                </tr>
                <tr>
                    <th>店舗名</th>
                    <td>{{ owner.shop.name }}</td>
                </tr>
                <tr>
                    <th></th>
                    <td><button>オーナー詳細</button></td>
                </tr>
            </table>
        </div>
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
            this.$store.commit("setLoading");
            await axios
                .get("/api/owner-list")
                .then((response) => {
                    this.$store.commit("outLoading");
                    this.owners = response.data;
                })
                .catch((err) => {
                    this.$store.commit("outLoading");
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
.owners-table button {
    display: inline-block;
    border: none;
    /* cursor: pointer;
    background-color: #9a2fff;
    color: #ffffff; */
    background-color: #cfcfcf;
    color: #999999;
    padding: 7px 20px;
    border-radius: 5px;
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
.mobile {
    display: none;
}
/* ------ スマートフォンデザイン ------ */
@media screen and (max-width: 480px) {
    .list-header {
        padding-right: 20px;
    }
    .owner-register button {
        width: 100px;
        padding: 0 15px;
    }
    .desktop {
        display: none;
    }
    .mobile {
        display: initial;
    }
    .owners-table th,
    .owners-table td {
        padding: 10px 0;
    }
    .title {
        width: 35%;
    }
    .content {
        width: 65%;
    }
    .owners-table:not(:last-of-type) {
        border-radius: 0;
    }
    .owners-table tr:not(:last-of-type) {
        border-bottom: none;
    }
    .owners-table:not(:last-of-type) {
        border-bottom: 1px solid #d1d5db;
    }
    .owners-table button {
        margin: 5px 0;
    }
}
@media screen and (max-width: 400px) {
    .list-title {
        font-size: 15px;
    }
}
</style>
