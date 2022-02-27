<template>
    <div>
        <div class="list-header">
            <p class="list-title">店舗情報</p>
            <router-link v-bind:to="{ name: 'image-edit' }">
                <button>店舗画像変更</button>
            </router-link>
        </div>
        <div class="shop-img">
            <img :src="shopData.img_url" alt="" />
        </div>
        <div class="shop-edit">
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
        </div>
        <router-link
            v-bind:to="{
                name: 'shop-edit',
                params: {
                    shop_name: shopData.name,
                    shop_content: shopData.content,
                    shop_area: shopData.area.id,
                    shop_genre: shopData.genre.id,
                },
            }"
            class="footer"
        >
            <button>編集</button>
        </router-link>
        <router-view :shop-id="shopData.id"></router-view>
    </div>
</template>

<script>
export default {
    props: {
        shopData: {
            type: Object,
        },
    },
};
</script>

<style scoped>
.list-header {
    height: 70px;
    width: 100%;
    background-color: #552fff;
    border-radius: 10px 10px 0 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-right: 30px;
}
.list-header button {
    border: none;
    background-color: #fff;
    color: #552fff;
    font-weight: bold;
    font-size: 15px;
    padding: 8px 15px;
    border-radius: 5px;
    cursor: pointer;
    width: 120px;
}

.list-title {
    text-decoration: none;
    font-size: 25px;
    font-weight: bold;
    line-height: 70px;
    color: #fff;
    padding-left: 30px;
}
.shop-edit > div:not(.shop-img, .shop-genre, .footer) {
    padding: 30px 50px;
    border-bottom: 1px solid #d1d5db;
}
.shop-genre {
    padding: 30px 50px;
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
.shop-content > p {
    padding-bottom: 10px;
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
/* ------ スマートフォンデザイン ------ */
@media screen and (max-width: 480px) {
    .shop-edit > div > p:first-of-type {
        width: 30%;
    }
    .shop-img {
        height: 200px;
    }
}
</style>
