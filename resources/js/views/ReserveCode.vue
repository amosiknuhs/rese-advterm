<template>
    <div class="modal" :class="fadeAnimation">
        <div class="modal-content" :class="zoomAnimation">
            <div class="modal-content-inner">
                <div class="header">
                    <p>予約情報読み込み</p>
                    <button class="back" @click="leaveWithAnimation"></button>
                </div>
                <div class="content">
                    <qrcode :value="qrCode" :options="{ width: 200 }"></qrcode>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            name: this.$route.params.reserve_name,
            date: this.$route.params.reserve_date,
            time: "",
            number: this.$route.params.reserve_number,
            fadeAnimation: "animate__animated animate__fadeIn",
            zoomAnimation: "animate__animated animate__zoomIn",
        };
    },
    computed: {
        qrCode: function () {
            return (
                "予約者名：" +
                this.name +
                "予約日：" +
                this.date +
                "予約時間：" +
                this.time +
                "予約人数：" +
                this.number
            );
        },
    },
    methods: {
        jsonTime() {
            let setTime = this.$route.params.reserve_time;
            let tenHour = parseInt(setTime.substring(11, 12), 10);
            let oneHour = parseInt(setTime.substring(12, 13), 10);
            let min = setTime.substring(14, 16);
            if (tenHour == 0) {
                this.time = oneHour + 9 + ":" + min;
            } else {
                this.time = oneHour + 19 + ":" + min;
            }
        },
        leaveWithAnimation() {
            this.fadeAnimation = "animate__animated animate__fadeOut";
            this.zoomAnimation = "animate__animated animate__zoomOut";
            setTimeout(() => {
                this.$router.go(-1);
            }, 300);
        },
    },
    mounted() {
        this.jsonTime();
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
    border-radius: 10px;
    overflow: hidden;
    background-color: white;
    width: 600px;
    box-shadow: 2px 2px 10px gray;
}
.header {
    display: flex;
    justify-content: space-between;
    background-color: #2f60ff;
    color: #fff;
    height: 60px;
    line-height: 60px;
    padding-left: 30px;
    font-size: 20px;
}
.content {
    height: 250px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.back {
    display: inline-block;
    padding: 0;
    border: none;
    background: transparent;
    cursor: pointer;
    height: 30px;
    width: 30px;
    background-repeat: no-repeat;
    background-image: url("/img/delete.svg");
    margin: auto 20px;
}
/* ------ スマートフォンデザイン ------ */
@media screen and (max-width: 480px) {
    .date input,
    .time select,
    .number select {
        width: 75%;
    }
}
</style>
