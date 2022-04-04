<template>
    <div>
        <div class="list-header">
            <p class="list-title">ユーザーリスト</p>
        </div>
        <div class="desktop">
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
                    <td><button>ユーザー詳細</button></td>
                </tr>
            </table>
        </div>
        <div class="mobile">
            <table
                class="user-table"
                v-for="(user, index) in users"
                :key="index"
            >
                <colgroup span="1" class="title"></colgroup>
                <colgroup span="1" class="content"></colgroup>
                <tr>
                    <th>ID</th>
                    <td>{{ user.id }}</td>
                </tr>
                <tr>
                    <th>名前</th>
                    <td>{{ user.name }}</td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td>{{ user.email }}</td>
                </tr>
                <tr>
                    <th></th>
                    <td><button>ユーザー詳細</button></td>
                </tr>
            </table>
        </div>
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
            this.$store.commit("setLoading");
            await axios
                .get("/api/user-list")
                .then((response) => {
                    this.$store.commit("outLoading");
                    this.users = response.data;
                })
                .catch((err) => {
                    this.$store.commit("outLoading");
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
.user-table button {
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
.mobile {
    display: none;
}
/* ------ スマートフォンデザイン ------ */
@media screen and (max-width: 480px) {
    .desktop {
        display: none;
    }
    .mobile {
        display: initial;
    }
    .user-table th,
    .user-table td {
        padding: 10px 0;
    }
    .title {
        width: 35%;
    }
    .content {
        width: 65%;
    }
    .user-table:not(:last-of-type) {
        border-radius: 0;
    }
    .user-table tr:not(:last-of-type) {
        border-bottom: none;
    }
    .user-table:not(:last-of-type) {
        border-bottom: 1px solid #d1d5db;
    }
    .user-table button {
        margin: 5px 0;
    }
}
</style>
