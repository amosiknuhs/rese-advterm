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

/* ----------トランジション---------- */
.fade-enter {
    /* 現れる時の最初の状態 */
    opacity: 0;
}
.fade-enter-active {
    /* 現れる時のトランジションの状態 */
    transition: opacity 0.3s;
}
.fade-enter-to {
    /* 現れる時の最後の状態 */
    opacity: 1;
}
.fade-leave {
    /* 消える時の最初の状態 */
    opacity: 1;
}
.fade-leave-active {
    /* 消える時のトランジションの状態 */
    transition: opacity 0.3s;
}
.fade-leave-to {
    /* 消える時の最後の状態 */
    opacity: 0;
}

.bounce-enter-active {
    animation: bounce-in 0.5s;
}
.bounce-leave-active {
    animation: bounce-in 0.5s reverse;
}
@keyframes bounce-in {
    0% {
        transform: scale(0);
    }
    50% {
        transform: scale(1.5);
    }
    100% {
        transform: scale(1);
    }
}
</style>
