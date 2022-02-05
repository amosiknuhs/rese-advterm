<template>
    <div class="mypage-content">
        <p class="owner-name">{{ owner.name }}用ページ</p>
        <router-view
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
        };
    },
    methods: {
        async getOwnerData() {
            await axios.get("/api/owner").then((response) => {
                this.owner = response.data;
            });
        },
    },
    mounted() {
        this.getOwnerData();
    },
    beforeRouteUpdate(to, from, next) {
        if (from.name == "owner-dialog") {
            this.getOwnerData();
            next();
        }
        next();
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
</style>
