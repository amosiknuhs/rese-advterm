<template>
    <div>
        <div class="login-title">AdminLogin</div>
        <validation-observer v-slot="{ invalid }">
            <div class="login-form">
                <form @submit.prevent="adminLogin">
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
                    <p class="login-error">{{ loginMessage[0] }}</p>
                    <div class="login-form-footer">
                        <form @submit.prevent="guestAdminLogin">
                            <button type="submit">ゲストログイン</button>
                        </form>
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
        adminLogin() {
            axios.get("/sanctum/csrf-cookie").then((response) => {
                axios
                    .post("/api/admin/login", {
                        email: this.email,
                        password: this.password,
                    })
                    .then((response) => {
                        this.setLogin();
                        this.$router.push("/rese/admin/owner-list");
                    })
                    .catch((err) => {
                        this.emailMessage = err.response.data.errors.email;
                        this.passMessage = err.response.data.errors.password;
                        this.loginMessage =
                            err.response.data.errors.login_error;
                    });
            });
        },
        guestAdminLogin() {
            axios.get("/sanctum/csrf-cookie").then((response) => {
                axios
                    .post("/api/admin/login", {
                        email: "admin@admin.com",
                        password: "password",
                    })
                    .then((response) => {
                        this.setLogin();
                        this.$router.push("/rese/admin/owner-list");
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
            this.$store.commit("setRole", "admin");
        },
    },
};
</script>

<style scoped>
.login-title {
    height: 80px;
    background-color: #9a2fff;
    font-size: 25px;
    font-weight: bold;
    color: #ffffff;
    display: flex;
    align-items: center;
    padding-left: 30px;
    text-decoration: none;
}
.login-form {
    padding: 20px 40px 30px;
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
    justify-content: flex-end;
    gap: 10px;
}
.login-form-footer button {
    display: inline-block;
    border: none;
    background-color: #9a2fff;
    color: #ffffff;
    padding: 7px 20px;
    border-radius: 5px;
    cursor: pointer;
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
.login-error {
    height: 20px;
    color: red;
}
</style>
