<template>
    <div class="modal" :class="fadeAnimation">
        <div class="modal-content" :class="zoomAnimation">
            <div class="modal-content-inner">
                <div class="header">
                    <p>評価</p>
                    <button class="back" @click="leaveWithAnimation"></button>
                </div>
                <div class="content">
                    <star-rating v-model="rating" :increment="0.1">
                    </star-rating>
                    <textarea
                        v-model="comment"
                        cols="50"
                        rows="5"
                        maxlength="140"
                        placeholder="口コミ本文を入力してください（140文字以内）"
                    ></textarea>
                    <span class="error-message" v-if="errorMessage">{{
                        errorMessage[0]
                    }}</span>
                    <button class="evaluate" @click="createEvaluation">
                        評価を投稿する
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            rating: 0,
            comment: "",
            shop_id: this.$route.params.shop_id,
            errorMessage: "",
            fadeAnimation: "animate__animated animate__fadeIn",
            zoomAnimation: "animate__animated animate__zoomIn",
        };
    },
    methods: {
        async createEvaluation() {
            await axios
                .post("/api/evaluate", {
                    shop_id: this.shop_id,
                    rating: this.rating,
                    comment: this.comment,
                })
                .then((response) => {
                    this.$router.push("/rese/mypage/reservation/dialog");
                })
                .catch((err) => {
                    this.errorMessage = err.response.data.errors.comment;
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
    display: flex;
    justify-content: space-between;
    background-color: #2f60ff;
    color: #fff;
    height: 60px;
    line-height: 60px;
    padding-left: 30px;
    font-size: 20px;
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
.content {
    height: 300px;
    display: flex;
    flex-flow: column;
    justify-content: center;
    gap: 20px 0;
}
.content > * {
    margin: 0 auto;
}
.content textarea {
    resize: none;
}
.evaluate {
    display: block;
    border: none;
    background-color: #2f60ff;
    color: #ffffff;
    padding: 7px 20px;
    border-radius: 5px;
    cursor: pointer;
    width: 150px;
}
>>> .vue-star-rating-rating-text {
    display: inline-block;
    width: 15px;
}
.error-message {
    color: red;
    display: inline-block;
}
</style>
