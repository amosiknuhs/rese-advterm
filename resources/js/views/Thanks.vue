<template>
    <div class="thanks-content">
        <form class="thanks-message">
            <p>会員登録ありがとうございます</p>
            <router-link v-bind:to="{ name: 'login' }" class="toLogin"
                >ログインする</router-link
            >
        </form>
    </div>
</template>

<style scoped>
.thanks-content {
    display: flex;
    justify-content: center;
}
.thanks-message {
    background-color: #ffffff;
    box-shadow: 2px 2px 4px gray;
    border-radius: 5px;
    width: 500px;
    height: 350px;
    display: flex;
    align-items: center;
    flex-flow: column;
    justify-content: center;
    gap: 50px;
}
.thanks-message p {
    font-size: 25px;
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
</style>
