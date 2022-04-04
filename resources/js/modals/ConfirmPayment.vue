<template>
    <div class="modal" :class="fadeAnimation">
        <div class="modal-content" :class="zoomAnimation">
            <div class="modal-content-inner">
                <div class="header">
                    <p>支払い内容の確認</p>
                </div>
                <div class="content" v-show="toPayment">
                    <div class="reserve-content">
                        <div>
                            <span>店名：</span>
                            <span>{{ shop_name }}</span>
                        </div>
                        <div>
                            <span>コース名：</span>
                            <span class="course-name"
                                >宴会コース（1名：3,000円）</span
                            >
                        </div>
                        <div>
                            <span>人数：</span>
                            <span>{{ numUnit }}</span>
                        </div>
                        <div>
                            <span>料金：</span>
                            <span>{{ amount }}円</span>
                        </div>
                    </div>
                    <div class="footer">
                        <button class="change" @click="leaveWithAnimation">
                            戻る
                        </button>
                        <button class="change" @click="stripePayment">
                            支払う
                        </button>
                    </div>
                </div>
                <div class="toPayment" v-show="!toPayment">
                    <p>支払い画面に遷移しています…</p>
                </div>
                <stripe-checkout
                    ref="checkoutRef"
                    :pk="public_Key"
                    :session-id="sessionId"
                />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            toPayment: true,
            shop_name: this.$route.params.shop_name,
            number: this.$route.params.reserve_number,
            amount: this.$route.params.reserve_number * 3000,
            fadeAnimation: "animate__animated animate__fadeIn",
            zoomAnimation: "animate__animated animate__zoomIn",
            public_Key: process.env.MIX_STRIPE_PUBLIC_KEY,
            sessionId: "",
            loading: false,
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
        async stripePayment() {
            this.toPayment = false;
            await axios
                .post("/api/checkout", {
                    shop_name: this.shop_name,
                    number: this.number,
                    amount: this.amount,
                })
                .then((response) => {
                    this.sessionId = response.data.session.id;
                    this.$refs.checkoutRef.redirectToCheckout();
                })
                .catch((err) => {
                    this.$router.push("notfound");
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
.toPayment {
    font-size: 30px;
    font-weight: bold;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 200px;
}
/* ------ スマートフォンデザイン ------ */
@media screen and (max-width: 480px) {
    .reserve-content span:last-of-type {
        width: initial;
    }
    .course-name {
        font-size: 14px;
    }
}
</style>
