<template>
    <div class="register-content">
        <div class="register-box">
            <div class="register-title">
                <p>Register</p>
            </div>
            <validation-observer v-slot="{ invalid }">
                <div class="register-form">
                    <form @submit.prevent="registerUser">
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
                        <button type="submit" :disabled="invalid">登録</button>
                    </form>
                </div>
            </validation-observer>
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
            nameMessage: "",
            emailMessage: "",
            passMessage: "",
        };
    },
    methods: {
        registerUser() {
            this.$router.push("/thanks");
            axios
                .post("/api/register", {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                })
                // .then((response) => {
                // })
                .catch((err) => {
                    this.nameMessage = err.response.data.errors.name;
                    this.emailMessage = err.response.data.errors.email;
                    this.passMessage = err.response.data.errors.password;
                });
        },
    },
};
</script>

<style scoped>
.register-content {
    height: 80vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
.register-box {
    background-color: #ffffff;
    box-shadow: 2px 2px 4px gray;
    border-radius: 5px;
    width: 500px;
    height: 350px;
    overflow: hidden;
}
.register-title {
    height: 80px;
    background-color: #2f60ff;
    font-size: 25px;
    font-weight: bold;
    color: #ffffff;
    display: flex;
    align-items: center;
    padding-left: 30px;
}
.register-form {
    padding: 20px 40px;
}
.register-form input {
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
.register-form button {
    display: block;
    border: none;
    background-color: #2f60ff;
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
</style>
