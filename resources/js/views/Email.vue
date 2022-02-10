<template>
    <div>
        <div class="list-header">
            <p class="list-title">Eメール送信</p>
        </div>
        <validation-observer ref="observer" v-slot="{ invalid }">
            <div class="email-form">
                <form @submit.prevent="sendEmail">
                    <validation-provider
                        rules="selectRequired"
                        v-slot="{ errors }"
                        mode="lazy"
                    >
                        <label for="user_email">宛先：</label>
                        <select
                            name="宛先"
                            id="user_email"
                            v-model="user_email"
                        >
                            <optgroup label="ユーザー">
                                <option
                                    v-for="(user, index) in userList"
                                    :key="index"
                                    :value="user.email"
                                >
                                    {{ user.name }}
                                </option>
                            </optgroup>
                            <optgroup label="店舗オーナー">
                                <option
                                    v-for="(owner, index) in ownerList"
                                    :key="index"
                                    :value="owner.email"
                                >
                                    {{ owner.name }}
                                </option>
                            </optgroup>
                        </select>
                        <div class="error">
                            <span
                                class="error-message"
                                v-if="userEmailMessage && !errors[0]"
                                >{{ userEmailMessage[0] }}</span
                            >
                            <span class="error-message">{{ errors[0] }}</span>
                        </div>
                    </validation-provider>
                    <validation-provider
                        rules="required|max:50"
                        v-slot="{ errors }"
                        mode="eager"
                    >
                        <label for="subject">件名：</label>
                        <input
                            type="text"
                            name="件名"
                            id="subject"
                            v-model="subject"
                        />
                        <div class="error">
                            <span
                                class="error-message"
                                v-if="subjectMessage && !errors[0]"
                                >{{ subjectMessage[0] }}</span
                            >
                            <span class="error-message">{{ errors[0] }}</span>
                        </div>
                    </validation-provider>
                    <validation-provider
                        rules="required"
                        v-slot="{ errors }"
                        mode="eager"
                    >
                        <label for="content">本文：</label>
                        <textarea
                            name="本文"
                            id="content"
                            v-model="content"
                        ></textarea>
                        <div class="error">
                            <span
                                class="error-message"
                                v-if="contentMessage && !errors[0]"
                                >{{ contentMessage[0] }}</span
                            >
                            <span class="error-message">{{ errors[0] }}</span>
                        </div>
                    </validation-provider>
                    <button type="submit" :disabled="invalid">送信</button>
                </form>
            </div>
        </validation-observer>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            user_email: "",
            subject: "",
            content: "",
            userEmailMessage: "",
            subjectMessage: "",
            contentMessage: "",
            userList: "",
            ownerList: "",
        };
    },
    methods: {
        async sendEmail() {
            this.$router.push("/rese/admin/email/complete");
            await axios
                .post("/api/email", {
                    user_email: this.user_email,
                    subject: this.subject,
                    content: this.content,
                })
                .catch((err) => {
                    this.userEmailMessage = err.response.data.errors.user_email;
                    this.subjectMessage = err.response.data.errors.subject;
                    this.contentMessage = err.response.data.errors.content;
                });
        },
        async getUserList() {
            await axios.get("/api/user-list").then((response) => {
                this.userList = response.data;
            });
        },
        async getOwnerList() {
            await axios.get("/api/owner-list").then((response) => {
                this.ownerList = response.data;
            });
        },
    },
    mounted() {
        this.getUserList();
        this.getOwnerList();
    },
    beforeRouteUpdate(to, from, next) {
        if (from.name == "email-dialog") {
            this.user_email = "";
            this.subject = "";
            this.content = "";
            // フォームをクリアした時にVeeValidateが発火しないように制御
            this.$refs.observer.reset();
            next();
        }
        next();
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
.email-form label {
    color: #9a2fff;
    font-weight: bold;
}
.email-form select,
.email-form input {
    width: 94%;
    height: 35px;
    margin-left: 10px;
    border: none;
    outline: 0;
    border-bottom: 1px solid #d1d5db;
}
.email-form textarea {
    height: 100px;
    width: 94%;
    vertical-align: top;
    outline: 0;
    border: 1px solid #d1d5db;
    resize: none;
    margin-left: 10px;
    border-radius: 5px;
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
.error {
    height: 20px;
}
.error-message {
    color: red;
    display: inline-block;
    padding-left: 65px;
}
</style>
