<template>
    <div class="done-content">
        <div class="done-message">
            <p>ご予約ありがとうございます</p>
            <router-link v-bind:to="{ name: 'home' }" class="backHome"
                >HOMEへ戻る</router-link
            >
        </div>
    </div>
</template>

<style scoped>
.done-content {
    height: 80vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
.done-message {
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
.done-message p {
    font-size: 25px;
}
.backHome {
    text-decoration: none;
    background-color: #2f60ff;
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}
</style>
