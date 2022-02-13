<template>
    <div class="thanks-content">
        <form class="thanks-message">
            <p>本会員登録をお願いいたします</p>
            <div>
                <span
                    >ご入力いただいたメールアドレスに、"メールアドレスの確認"メールを送信しております。</span
                >
                <span
                    >ログインした上で、メール本文中の"メールアドレスの確認"のリンクをクリックし、</span
                >
                <span>アカウントの本登録を完了してください。</span>
            </div>
            <router-link v-bind:to="{ name: 'user-login' }" class="toLogin"
                >ログインする</router-link
            >
        </form>
    </div>
</template>

<style scoped>
.thanks-content {
    height: 80vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
.thanks-message {
    background-color: #ffffff;
    box-shadow: 2px 2px 4px gray;
    border-radius: 5px;
    width: 700px;
    height: 350px;
    display: flex;
    align-items: center;
    flex-flow: column;
    justify-content: center;
}
.thanks-message div {
    align-items: left;
}
.thanks-message p {
    font-size: 25px;
    margin-bottom: 40px;
}
.thanks-message span {
    display: block;
    width: 100%;
}
.thanks-message span:last-of-type {
    margin-bottom: 40px;
}
.toLogin {
    text-decoration: none;
    background-color: #2f60ff;
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}
/* ------ スマートフォンデザイン ------ */
@media screen and (max-width: 480px) {
    .thanks-message {
        padding: 0 10px;
    }
}
</style>
