<template>
    <div class="modal">
        <div class="modal-content">
            <div class="modal-content-inner">
                <p>この予約をキャンセルしてよろしいですか？</p>
                <div class="footer">
                    <button @click="cancelRsv(reserve_id)">はい</button>
                    <button @click="$router.go(-1)">いいえ</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            reserve_id: this.$route.params.reserve_id,
        };
    },
    methods: {
        async cancelRsv(reserveId) {
            await axios.post("/api/cancel", { reserveId }).then((response) => {
                this.$router.push("/mypage/dialog");
            });
        },
    },
};
</script>

<style scoped>
.modal {
    position: fixed;
    left: 0%;
    top: 0%;
    height: 100vh;
    width: 100vw;
    background-color: rgba(0, 0, 0, 0.3);
    z-index: 5;
}
.modal-content {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
}
.modal-content-inner {
    border: 5px solid #2f60ff;
    border-radius: 10px;
    overflow: hidden;
    background-color: white;
    width: 600px;
    box-shadow: 2px 2px 10px gray;
    height: 200px;
    display: flex;
    flex-flow: column;
    justify-content: center;
    gap: 30px 0;
}
.modal-content-inner > * {
    margin: 0 auto;
}
.modal-content-inner p {
    font-size: 20px;
    font-weight: bold;
    color: red;
}
.footer button {
    border: none;
    background-color: #2f60ff;
    color: #ffffff;
    padding: 7px 20px;
    border-radius: 5px;
    cursor: pointer;
    width: 80px;
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
