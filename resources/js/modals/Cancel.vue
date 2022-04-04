<template>
    <div class="modal" :class="fadeAnimation">
        <div class="modal-content" :class="zoomAnimation">
            <div class="modal-content-inner">
                <p>この予約をキャンセルしてよろしいですか？</p>
                <div class="footer">
                    <button @click="cancelRsv(reserve_id)">はい</button>
                    <button @click="leaveWithAnimation">いいえ</button>
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
            fadeAnimation: "animate__animated animate__fadeIn",
            zoomAnimation: "animate__animated animate__zoomIn",
        };
    },
    methods: {
        async cancelRsv(reserveId) {
            this.$store.commit("setLoading");
            await axios
                .post("/api/cancel", { reserveId })
                .then((response) => {
                    this.$store.commit("outLoading");
                    this.$router.push("/rese/mypage/reservation/dialog");
                })
                .catch((err) => {
                    this.$store.commit("outLoading");
                });
        },
        leaveWithAnimation() {
            this.fadeAnimation = "animate__animated animate__fadeOut";
            this.zoomAnimation = "animate__animated animate__zoomOut";
            setTimeout(() => {
                this.$router.go(-1);
            }, 300);
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
    animation-duration: 0.3s;
}
.modal-content {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
    animation-duration: 0.2s;
}
.animate__animated.animate__zoomOut {
    animation-duration: 0.5s;
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
/* ------ スマートフォンデザイン ------ */
@media screen and (max-width: 480px) {
    .modal-content-inner p {
        font-size: 18px;
    }
}
</style>
