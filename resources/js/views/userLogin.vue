<template>
    <div>
        <div class="login-title">UserLogin</div>
        <validation-observer v-slot="{ invalid }">
            <div class="login-form">
                <form @submit.prevent="userLogin">
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
                            <span class="error-message">{{ errors[0] }}</span>
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
                            <span class="error-message">{{ errors[0] }}</span>
                        </div>
                    </validation-provider>
                    <div class="login-form-footer">
                        <span v-if="loginMessage">{{ loginMessage[0] }}</span>
                        <button type="submit" :disabled="invalid">
                            ログイン
                        </button>
                    </div>
                </form>
            </div>
        </validation-observer>
    </div>
</template>
<script>
export default {
    data: function () {
        return {
            email: "",
            password: "",
            emailMessage: "",
            passMessage: "",
            loginMessage: "",
        };
    },
    methods: {
        userLogin() {
            axios.get("/sanctum/csrf-cookie").then((response) => {
                axios
                    .post("/api/user/login", {
                        email: this.email,
                        password: this.password,
                    })
                    .then((response) => {
                        this.setLogin();
                        this.$router.push("/mypage/reservation");
                    })
                    .catch((err) => {
                        this.emailMessage = err.response.data.errors.email;
                        this.passMessage = err.response.data.errors.password;
                        this.loginMessage =
                            err.response.data.errors.login_error;
                    });
            });
        },
        setLogin() {
            this.$store.commit("setLogin");
            this.$store.commit("setRole", "user");
        },
    },
};
</script>

<style scoped>
.login-title {
    height: 80px;
    background-color: #2f60ff;
    font-size: 25px;
    font-weight: bold;
    color: #ffffff;
    display: flex;
    align-items: center;
    padding-left: 30px;
    text-decoration: none;
}
.login-form {
    padding: 20px 40px;
}
.login-form input {
    width: 89%;
    height: 35px;
    margin-left: 10px;
    border: none;
    outline: 0;
    border-bottom: 1px solid #d1d5db;
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
.login-form-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 15px;
}
.login-form-footer span {
    display: inline-block;
    color: red;
}
.login-form-footer button {
    display: inline-block;
    border: none;
    background-color: #2f60ff;
    color: #ffffff;
    padding: 7px 20px;
    border-radius: 5px;
    cursor: pointer;
    margin-left: auto;
}
.login-form-footer button:disabled {
    cursor: default;
    background-color: #cfcfcf;
    color: #999999;
}
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
