<template>
    <div class="modal">
        <div class="modal-content">
            <div class="modal-content-inner">
                <p v-if="processType == 'change'">予約を変更しました</p>
                <p v-else-if="processType == 'evaluation'">
                    評価を投稿しました
                </p>
                <p v-else-if="processType == 'cancel'">
                    予約をキャンセルしました
                </p>
                <router-link v-bind:to="{ name: 'reservation' }">
                    <button class="back">戻る</button>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        processType: {
            type: String,
            default: "",
        },
    },
    data: function () {
        return {};
    },
    methods: {},
    mounted() {},
};
</script>

<style scoped>
.modal {
    position: fixed;
    left: 0%;
    top: 0%;
    height: 100vh;
    width: 100vw;
    background-color: rgba(0, 0, 0, 0.3);
    z-index: 5;
}
.modal-content {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
}
.modal-content-inner {
    border: 5px solid #2f60ff;
    border-radius: 10px;
    overflow: hidden;
    background-color: white;
    width: 600px;
    box-shadow: 2px 2px 10px gray;
    height: 200px;
    display: flex;
    flex-flow: column;
    justify-content: center;
    gap: 30px 0;
}
.modal-content-inner > * {
    margin: 0 auto;
}
.modal-content-inner p {
    font-size: 20px;
    font-weight: bold;
}
.back {
    border: none;
    background-color: #2f60ff;
    color: #ffffff;
    padding: 7px 20px;
    border-radius: 5px;
    cursor: pointer;
}
</style>
