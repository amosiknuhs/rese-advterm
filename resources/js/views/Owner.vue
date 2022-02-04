<template>
    <div class="mypage-content">
        <p class="owner-name">{{ owner.name }}さん</p>
        <div class="mypage-title">
            <router-link
                v-bind:to="{ name: 'user-reservations' }"
                class="reserve-title"
                :class="{ active: isActive }"
                @click.native="tabSwitchRsv"
                >予約一覧</router-link
            >
            <router-link
                v-bind:to="{ name: 'owner-shop' }"
                class="shopInfo-title"
                :class="{ active: !isActive }"
                @click.native="tabSwitchShop"
                >店舗情報編集</router-link
            >
        </div>
        <router-view
            v-if="show"
            class="owner-content"
            :shop-data="owner.shop"
        ></router-view>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            owner: "",
            isActive: true,
            show: false,
        };
    },
    methods: {
        async getOwnerData() {
            await axios.get("/api/owner").then((response) => {
                this.owner = response.data;
            });
        },
        tabSwitchRsv() {
            this.isActive = true;
        },
        tabSwitchShop() {
            this.isActive = false;
        },
    },
    mounted() {
        this.getOwnerData();
    },
    beforeUpdate() {
        this.show = true;
    },
};
</script>

<style scoped>
.owner-name {
    font-size: 30px;
    font-weight: bold;
    margin: 20px 0;
}
.owner-content {
    background-color: #fff;
    border-radius: 0 0 10px 10px;
}
.mypage-title {
    display: flex;
}
.reserve-title,
.shopInfo-title {
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
.shopInfo-title {
    border-radius: 0 10px 0 0;
}
.active {
    background-color: #552fff;
}
</style>
