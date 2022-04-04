<template>
    <div class="modal" :class="fadeAnimation">
        <div class="modal-content" :class="zoomAnimation">
            <div class="modal-content-inner">
                <div class="header">
                    <p>店舗詳細の編集</p>
                    <button class="back" @click="leaveWithAnimation"></button>
                </div>
                <div class="shop-content">
                    <div class="name">
                        <label for="name">店名　　：</label>
                        <input id="name" type="text" v-model="name" />
                    </div>
                    <div class="content">
                        <label for="content">店舗説明：</label>
                        <textarea id="content" v-model="content"></textarea>
                    </div>
                    <div class="area">
                        <label for="area">エリア　：</label>
                        <select id="area" v-model="area">
                            <option value="1">東京都</option>
                            <option value="2">大阪府</option>
                            <option value="3">福岡県</option>
                        </select>
                    </div>
                    <div class="genre">
                        <label for="genre">ジャンル：</label>
                        <select id="genre" v-model="genre">
                            <option value="1">寿司</option>
                            <option value="2">焼肉</option>
                            <option value="3">居酒屋</option>
                            <option value="4">イタリアン</option>
                            <option value="5">ラーメン</option>
                        </select>
                    </div>
                    <div class="footer">
                        <button class="change" @click="updateReserve">
                            変更
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        shopId: {
            type: Number,
        },
    },
    data: function () {
        return {
            name: this.$route.params.shop_name,
            content: this.$route.params.shop_content,
            area: this.$route.params.shop_area,
            genre: this.$route.params.shop_genre,
            fadeAnimation: "animate__animated animate__fadeIn",
            zoomAnimation: "animate__animated animate__zoomIn",
        };
    },
    methods: {
        async updateReserve() {
            this.$store.commit("setLoading");
            await axios
                .post("/api/shop/edit", {
                    id: this.shopId,
                    name: this.name,
                    content: this.content,
                    area_id: this.area,
                    genre_id: this.genre,
                })
                .then((response) => {
                    this.$store.commit("outLoading");
                    this.$router.push("/rese/owner/shop/complete");
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
    border-radius: 10px;
    overflow: hidden;
    background-color: white;
    width: 600px;
    box-shadow: 2px 2px 10px gray;
}
.header {
    display: flex;
    justify-content: space-between;
    background-color: #552fff;
    color: #fff;
    height: 60px;
    line-height: 60px;
    padding-left: 30px;
    font-size: 20px;
}
.shop-content {
    padding: 30px;
}
.shop-content label {
    display: inline-block;
    line-height: 40px;
    vertical-align: top;
    color: #552fff;
    font-weight: bold;
}
.name input,
.area select,
.genre select {
    display: inline-block;
    width: 80%;
    height: 40px;
    margin-bottom: 20px;
    border: none;
    outline: 0;
    border-bottom: 1px solid #d1d5db;
}
.content textarea {
    resize: none;
    display: inline-block;
    width: 80%;
    height: 80px;
    margin-bottom: 20px;
    border: none;
    outline: 0;
    border-bottom: 1px solid #d1d5db;
}
.footer {
    display: flex;
    justify-content: center;
    margin-top: 15px;
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
    background-color: #552fff;
    color: #ffffff;
    padding: 7px 20px;
    border-radius: 5px;
    cursor: pointer;
    width: 120px;
}
/* ------ スマートフォンデザイン ------ */
@media screen and (max-width: 480px) {
    .name input,
    .area select,
    .genre select,
    .content textarea {
        width: 68%;
    }
    .content textarea {
        border-radius: 0;
    }
}
</style>
