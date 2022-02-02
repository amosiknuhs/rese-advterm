<template>
    <div class="modal" :class="fadeAnimation">
        <div class="modal-content" :class="zoomAnimation">
            <div class="modal-content-inner">
                <div class="header">
                    <p>予約内容の確認</p>
                </div>
                <div class="content">
                    <div class="reserve-content">
                        <div>
                            <span>店名：</span>
                            <span>{{ shop_name }}</span>
                        </div>
                        <div>
                            <span>日付：</span>
                            <span id="reserveDate">{{ date }}</span>
                        </div>
                        <div>
                            <span>時間：</span>
                            <span id="reserveTime">{{ time }}</span>
                        </div>
                        <div>
                            <span>人数：</span>
                            <span id="reserveNumber">
                                {{ numUnit }}
                            </span>
                        </div>
                    </div>
                    <div class="footer">
                        <button class="change" @click="leaveWithAnimation">
                            修正する
                        </button>
                        <button class="change" @click="createRsv">
                            予約する
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            id: this.$route.params.shop_id,
            shop_name: this.$route.params.shop_name,
            date: this.$route.params.date,
            time: this.$route.params.time,
            number: this.$route.params.number,
            fadeAnimation: "animate__animated animate__fadeIn",
            zoomAnimation: "animate__animated animate__zoomIn",
        };
    },
    computed: {
        numUnit: function () {
            if (this.number != undefined) {
                return this.number + "人";
            }
        },
    },
    methods: {
        async createRsv() {
            await axios
                .post("/api/reserve", {
                    shop_id: this.id,
                    date: this.date,
                    time: this.time,
                    number: this.number,
                })
                .then((response) => {
                    this.$router.push("/done");
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
    z-index: 5;
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
    background-color: #2f60ff;
    color: #fff;
    height: 60px;
    line-height: 60px;
    padding-left: 30px;
    font-size: 20px;
}
.content {
    height: 300px;
    padding: 30px;
}
.reserve-content {
    width: 100%;
}
.reserve-content div {
    height: 30px;
    border-bottom: 1px solid #d1d5db;
    margin-bottom: 10px;
}
.reserve-content span {
    display: inline-block;
}
.reserve-content span:first-of-type {
    color: #2f60ff;
    font-weight: bold;
}
.reserve-content span:last-of-type {
    text-align: center;
    width: 80%;
}
.footer {
    display: flex;
    justify-content: center;
    gap: 0 20px;
    margin-top: 30px;
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
.change {
    border: none;
    background-color: #2f60ff;
    color: #ffffff;
    padding: 7px 20px;
    border-radius: 5px;
    cursor: pointer;
    width: 120px;
}
</style>
