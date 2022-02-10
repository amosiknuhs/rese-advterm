<template>
    <div class="modal" :class="fadeAnimation">
        <div class="modal-content" :class="zoomAnimation">
            <div class="modal-content-inner">
                <div class="header">
                    <p>オーナー新規登録</p>
                    <button class="back" @click="leaveWithAnimation"></button>
                </div>
                <validation-observer v-slot="{ invalid }">
                    <div class="register-form">
                        <form @submit.prevent="registerOwner">
                            <validation-provider
                                rules="required|max:128"
                                v-slot="{ errors }"
                                class="name-form"
                                mode="eager"
                            >
                                <input
                                    name="氏名"
                                    type="text"
                                    v-model="name"
                                    placeholder="Username"
                                />
                                <div class="name-error">
                                    <span
                                        class="error-message"
                                        v-if="nameMessage && !errors[0]"
                                        >{{ nameMessage[0] }}</span
                                    >
                                    <span class="error-message">{{
                                        errors[0]
                                    }}</span>
                                </div>
                            </validation-provider>
                            <validation-provider
                                rules="required|email|max:128"
                                v-slot="{ errors }"
                                class="email-form"
                                mode="eager"
                            >
                                <input
                                    name="メールアドレス"
                                    type="text"
                                    v-model="email"
                                    placeholder="Email"
                                />
                                <div class="email-error">
                                    <span
                                        class="error-message"
                                        v-if="emailMessage && !errors[0]"
                                        >{{ emailMessage[0] }}</span
                                    >
                                    <span class="error-message">{{
                                        errors[0]
                                    }}</span>
                                </div>
                            </validation-provider>
                            <validation-provider
                                rules="required|alpha_num|min:8|max:128"
                                v-slot="{ errors }"
                                class="pass-form"
                                mode="eager"
                            >
                                <input
                                    name="パスワード"
                                    type="password"
                                    v-model="password"
                                    placeholder="Password"
                                />
                                <div class="pass-error">
                                    <span
                                        class="error-message"
                                        v-if="passMessage && !errors[0]"
                                        >{{ passMessage[0] }}</span
                                    >
                                    <span class="error-message">{{
                                        errors[0]
                                    }}</span>
                                </div>
                            </validation-provider>
                            <validation-provider
                                rules="selectRequired"
                                v-slot="{ errors }"
                                class="shop-form"
                                mode="eager"
                            >
                                <select name="店舗" v-model="shop_id">
                                    <option disabled selected value>
                                        オーナー店舗を選択してください
                                    </option>
                                    <option
                                        v-for="(shop, index) in shopList"
                                        :key="index"
                                        :value="shop.id"
                                    >
                                        {{ shop.name }}
                                    </option>
                                </select>
                                <div class="pass-error">
                                    <span
                                        class="error-message"
                                        v-if="shopMessage && !errors[0]"
                                        >{{ shopMessage[0] }}</span
                                    >
                                    <span class="error-message">{{
                                        errors[0]
                                    }}</span>
                                </div>
                            </validation-provider>
                            <button type="submit" :disabled="invalid">
                                登録
                            </button>
                        </form>
                    </div>
                </validation-observer>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            name: "",
            email: "",
            password: "",
            shop_id: "",
            shopList: "",
            nameMessage: "",
            emailMessage: "",
            passMessage: "",
            shopMessage: "",
            fadeAnimation: "animate__animated animate__fadeIn",
            zoomAnimation: "animate__animated animate__zoomIn",
        };
    },
    methods: {
        registerOwner() {
            axios
                .post("/api/owner-register", {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    shop_id: this.shop_id,
                })
                .then((response) => {
                    this.$router.push("/rese/admin/owner-list/complete");
                })
                .catch((err) => {
                    this.nameMessage = err.response.data.errors.name;
                    this.emailMessage = err.response.data.errors.email;
                    this.passMessage = err.response.data.errors.password;
                    this.shopMessage = err.response.data.errors.shop_id;
                });
        },
        async getShopList() {
            await axios.get("/api/").then((response) => {
                this.shopList = response.data;
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
    mounted() {
        this.getShopList();
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
    background-color: #9a2fff;
    color: #fff;
    height: 60px;
    line-height: 60px;
    padding-left: 30px;
    font-size: 20px;
    font-weight: bold;
}
.register-form {
    padding: 20px 40px;
}
.register-form input,
.register-form select {
    width: 89%;
    height: 35px;
    margin-left: 10px;
    border: none;
    outline: 0;
    border-bottom: 1px solid #d1d5db;
}
.name-form::before {
    content: "";
    background-image: url("/img/person.svg");
    display: inline-block;
    height: 35px;
    width: 35px;
    vertical-align: middle;
    background-size: contain;
}
.email-form::before {
    content: "";
    background-image: url("/img/email.svg");
    display: inline-block;
    height: 35px;
    width: 35px;
    vertical-align: middle;
    background-size: contain;
}
.pass-form::before {
    content: "";
    background-image: url("/img/lock.svg");
    display: inline-block;
    height: 35px;
    width: 35px;
    vertical-align: middle;
    background-size: contain;
}
.shop-form::before {
    content: "";
    background-image: url("/img/shop.svg");
    display: inline-block;
    height: 35px;
    width: 35px;
    vertical-align: middle;
    background-size: contain;
}
.register-form button {
    display: block;
    border: none;
    background-color: #9a2fff;
    color: #ffffff;
    padding: 7px 20px;
    border-radius: 5px;
    cursor: pointer;
    margin: 15px 0 0 auto;
}
.register-form button:disabled {
    cursor: default;
    background-color: #cfcfcf;
    color: #999999;
}
.name-error,
.email-error,
.pass-error {
    height: 20px;
}
.error-message {
    color: red;
    display: inline-block;
    padding-left: 50px;
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
</style>
