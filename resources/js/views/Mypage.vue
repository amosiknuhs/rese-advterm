<template>
    <div class="mypage-content">
        <p class="user-name">{{ user.name }}さん</p>
        <div class="mypage-title">
            <router-link
                v-bind:to="{ name: 'reservation' }"
                class="reserve-title"
                :class="{ active: isActive }"
                @click.native="tabSwitchRsv"
                >予約状況</router-link
            >
            <router-link
                v-bind:to="{ name: 'favorite' }"
                class="favorite-title"
                :class="{ active: !isActive }"
                @click.native="tabSwitchFav"
                >お気に入り店舗</router-link
            >
        </div>
        <router-view class="user-content"></router-view>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            user: "",
            isActive: true,
        };
    },
    methods: {
        async getUserData() {
            await axios.get("/api/user").then((response) => {
                this.user = response.data;
            });
        },
        tabSwitchRsv() {
            this.isActive = true;
        },
        tabSwitchFav() {
            this.isActive = false;
        },
    },
    mounted() {
        this.getUserData();
    },
};
</script>

<style scoped>
.user-name {
    font-size: 30px;
    font-weight: bold;
    margin: 20px 0;
}
.user-content {
    background-color: #fff;
    border-radius: 0 0 10px 10px;
    padding: 50px 0;
}
.mypage-title {
    display: flex;
}
.reserve-title,
.favorite-title {
    display: inline-block;
    text-decoration: none;
    width: 50%;
    font-size: 25px;
    font-weight: bold;
    line-height: 70px;
    background-color: #afafaf;
    color: #fff;
    padding-left: 30px;
}
.reserve-title {
    border-radius: 10px 0 0 0;
}
.favorite-title {
    border-radius: 0 10px 0 0;
}
.active {
    background-color: #2f60ff;
}
/* ------ スマートフォンデザイン ------ */
@media screen and (max-width: 480px) {
    .mypage-title > * {
        font-size: 1.2rem;
    }
}
</style>
