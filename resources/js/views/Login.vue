<template>
    <div class="login-content">
        <div class="login-box">
            <div class="login-title">
                <p>Login</p>
            </div>
            <div class="login-form">
                <form @submit.prevent="login">
                    <div class="email-form">
                        <input
                            type="text"
                            v-model="email"
                            placeholder="Email"
                        />
                    </div>
                    <div class="email-error">
                        <span class="error-message"></span>
                    </div>
                    <div class="pass-form">
                        <input
                            type="password"
                            v-model="password"
                            placeholder="Password"
                        />
                    </div>
                    <div class="pass-error">
                        <span class="error-message"></span>
                    </div>
                    <div class="login-form-footer">
                        <p></p>
                        <button type="submit">ログイン</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            email: "",
            password: "",
        };
    },
    methods: {
        login() {
            axios.get("/sanctum/csrf-cookie").then((response) => {
                axios
                    .post("/api/login", {
                        email: this.email,
                        password: this.password,
                    })
                    .then((response) => {
                        console.log(response);
                        localStorage.setItem("auth", "true");
                        this.$router.push("/mypage");
                    });
            });
        },
    },
};
</script>

<style scoped>
.login-content {
    height: 80vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
.login-box {
    background-color: #ffffff;
    box-shadow: 2px 2px 4px gray;
    border-radius: 5px;
    width: 500px;
    height: 300px;
    overflow: hidden;
}
.login-title {
    height: 80px;
    background-color: #2f60ff;
    font-size: 25px;
    font-weight: bold;
    color: #ffffff;
    display: flex;
    align-items: center;
    padding-left: 30px;
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
.login-form-footer p {
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
.email-error,
.pass-error {
    height: 20px;
}
/* .error-message {
    color: red;
    display: inline-block;
    padding-left: 50px;
} */
</style>
