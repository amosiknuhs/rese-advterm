<template>
    <div class="modal" :class="fadeAnimation">
        <div class="modal-content" :class="zoomAnimation">
            <div class="modal-content-inner">
                <div class="header">
                    <p>店舗画像の変更</p>
                    <button class="back" @click="leaveWithAnimation"></button>
                </div>
                <div class="shop-content">
                    <div class="image">
                        <label for="image"
                            >画像を選択
                            <input
                                accept="image/*"
                                id="image"
                                type="file"
                                @change="imageSelected"
                            />
                        </label>
                        <p v-if="fileName !== ''">{{ fileName }}</p>
                        <p v-else>画像が選択されていません</p>
                    </div>
                    <p class="error-message">
                        {{ fileMessage[0] }}
                    </p>
                    <div class="footer">
                        <button class="change" @click="imageUpload">
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
            imageInfo: "",
            fileName: "",
            fileMessage: "",
            fadeAnimation: "animate__animated animate__fadeIn",
            zoomAnimation: "animate__animated animate__zoomIn",
        };
    },
    methods: {
        imageSelected(event) {
            if (event.target.files[0] == undefined) {
                this.imageInfo = "";
                this.fileName = "";
            } else {
                this.imageInfo = event.target.files[0];
                this.fileName = event.target.files[0].name;
            }
        },
        imageUpload() {
            // const formData = new FormData();
            // formData.append("file", this.imageInfo);
            // formData.append("shop_id", this.shopId);
            // this.$store.commit("setLoading");
            // axios
            //     .post("/api/image-upload", formData)
            //     .then((response) => {
            //         this.$store.commit("outLoading");
            //         this.$router.push("/rese/owner/shop/complete");
            //     })
            //     .catch((err) => {
            //         this.$store.commit("outLoading");
            //         this.fileMessage = err.response.data.errors.file;
            //     });
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
.image {
    width: 80%;
    margin: 0 auto;
    border-bottom: 1px solid #d1d5db;
    display: flex;
}
.image label {
    display: block;
    min-width: 120px;
    padding: 10px 20px;
    color: #ffffff;
    background-color: #552fff;
    cursor: pointer;
}
.image input {
    display: none;
}
.image p {
    display: block;
    height: 36px;
    line-height: 36px;
    margin-left: 10px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.footer {
    display: flex;
    justify-content: center;
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
.change:disabled {
    cursor: default;
    background-color: #cfcfcf;
    color: #999999;
}
.error-message {
    height: 20px;
    color: red;
    text-align: center;
}
/* ------ スマートフォンデザイン ------ */
@media screen and (max-width: 480px) {
    .image label {
        min-width: 90px;
        padding: 10px 10px;
    }
    .image {
        width: 100%;
        font-size: 14px;
    }
}
</style>
