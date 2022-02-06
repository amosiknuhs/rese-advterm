<template>
    <div>
        <div class="list-header">
            <p class="list-title">Eメール送信</p>
        </div>
        <validation-observer v-slot="{ invalid }">
            <div class="email-form">
                <form @submit.prevent="emailUser">
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
                            <span class="error-message">{{ errors[0] }}</span>
                        </div>
                    </validation-provider>
                    <validation-provider
                        rules="required|email|max:128"
                        v-slot="{ errors }"
                        class="email-to"
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
                    <button type="submit" :disabled="invalid">登録</button>
                </form>
            </div>
        </validation-observer>
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
        emailUser() {
            axios
                .post("/api/email", {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                })
                .then((response) => {
                    this.$router.push("/thanks");
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
.list-header {
    height: 70px;
    width: 100%;
    background-color: #9a2fff;
    border-radius: 10px 10px 0 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-right: 30px;
}
.list-title {
    text-decoration: none;
    font-size: 25px;
    font-weight: bold;
    line-height: 70px;
    color: #fff;
    padding-left: 30px;
}
.email-form {
    padding: 20px 40px;
    background-color: #fff;
    border-radius: 0 0 10px 10px;
    overflow: hidden;
}
.email-form input {
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
.email-to::before {
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
.email-form button {
    display: block;
    border: none;
    background-color: #9a2fff;
    color: #ffffff;
    padding: 7px 20px;
    border-radius: 5px;
    cursor: pointer;
    margin: 15px 0 0 auto;
}
.email-form button:disabled {
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
