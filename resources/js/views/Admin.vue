<template>
    <div class="mypage-content">
        <p class="admin-name">{{ admin.name }}用ページ</p>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            admin: "",
        };
    },
    methods: {
        async getAdminData() {
            await axios
                .get("/api/admin")
                .then((response) => {
                    this.admin = response.data;
                })
                .catch((err) => {
                    this.$store.commit("outLoading");
                });
        },
    },
    mounted() {
        this.getAdminData();
    },
};
</script>

<style scoped>
.admin-name {
    font-size: 30px;
    font-weight: bold;
    margin: 20px 0;
}
</style>
