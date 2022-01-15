<template>
    <div class="login-content">
        <div class="login-box">
            <div class="login-title">
                <p>Register</p>
            </div>
            <div class="login-form">
                <form @submit.prevent="registerUser">
                    <div class="name-form">
                        <input
                            type="text"
                            v-model="name"
                            placeholder="Username"
                        />
                    </div>
                    <div class="name-error">
                        <span class="error-message" v-if="nameMessage">{{
                            nameMessage[0]
                        }}</span>
                    </div>
                    <div class="email-form">
                        <input
                            type="text"
                            v-model="email"
                            placeholder="Email"
                        />
                    </div>
                    <div class="email-error">
                        <span class="error-message" v-if="emailMessage">{{
                            emailMessage[0]
                        }}</span>
                    </div>
                    <div class="pass-form">
                        <input
                            type="password"
                            v-model="password"
                            placeholder="Password"
                        />
                    </div>
                    <div class="pass-error">
                        <span class="error-message" v-if="passMessage">{{
                            passMessage[0]
                        }}</span>
                    </div>
                    <button type="submit">登録</button>
                </form>
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
            nameMessage: "",
            emailMessage: "",
            passMessage: "",
        };
    },
    methods: {
        registerUser() {
            axios
                .post("/api/register", {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                })
                .then((response) => {
                    this.$router.push("/login");
                })
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
    height: 350px;
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
.login-form button {
    display: block;
    border: none;
    background-color: #2f60ff;
    color: #ffffff;
    padding: 7px 20px;
    border-radius: 5px;
    cursor: pointer;
    margin: 15px 0 0 auto;
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
