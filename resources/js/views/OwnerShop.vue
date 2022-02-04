<template>
    <div class="shop-edit">
        <div class="shop-img">
            <img :src="shopData.img_url" alt="" />
        </div>
        <div class="shop-name">
            <p>店名</p>
            <p>{{ shopData.name }}</p>
        </div>
        <div class="shop-content">
            <p>店舗説明</p>
            <p>{{ shopData.content }}</p>
        </div>
        <div class="shop-area">
            <p>エリア</p>
            <p>{{ shopData.area.name }}</p>
        </div>
        <div class="shop-genre">
            <p>ジャンル</p>
            <p>{{ shopData.genre.name }}</p>
        </div>
        <div class="footer">
            <button>編集</button>
        </div>
        <!-- <router-view></router-view> -->
    </div>
</template>

<script>
export default {
    props: {
        shopData: {
            type: Object,
        },
    },
    mounted() {
        console.log(this.shopData);
    },
};
</script>

<style scoped>
.shop-edit {
}
.shop-edit > div:not(.shop-img, .shop-genre, .footer) {
    padding: 30px 0;
    border-bottom: 1px solid #d1d5db;
}
.shop-genre {
    padding: 30px 0;
}
.shop-edit > div > p:first-of-type {
    font-weight: bold;
    width: 20%;
}
.shop-edit > div > p {
    display: inline-block;
}
.shop-img {
    width: 100%;
    height: 300px;
}
.shop-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.footer {
    display: flex;
    justify-content: center;
}
.footer button {
    border: none;
    background-color: #552fff;
    color: #ffffff;
    cursor: pointer;
    padding: 10px 0;
    width: 100%;
    border-radius: 0 0 10px 10px;
}
</style>
