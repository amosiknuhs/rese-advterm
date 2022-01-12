<template>
    <div>
        <form class="search-box">
            <select v-model="search.area_id">
                <option value="">All area</option>
                <option value="1">東京都</option>
                <option value="2">大阪府</option>
                <option value="3">福岡県</option>
            </select>
            <select v-model="search.genre_id">
                <option value="">All genre</option>
                <option value="1">寿司</option>
                <option value="2">焼肉</option>
                <option value="3">居酒屋</option>
                <option value="4">イタリアン</option>
                <option value="5">ラーメン</option>
            </select>
            <input v-model="search.name" type="text" placeholder="Search …" />
            <span class="search-submit"></span>
        </form>
        <div class="shop-list">
            <div
                class="card"
                v-for="(shop, index) in filteredShops"
                :key="index"
            >
                <div class="card-img">
                    <img :src="shop.img_url" alt="" />
                </div>
                <div class="card-content">
                    <p class="shop-name">{{ shop.name }}</p>
                    <div class="tag">
                        <span class="area-tag">#{{ shop.area.name }}</span>
                        <span class="genre-tag">#{{ shop.genre.name }}</span>
                    </div>
                    <div class="card-footer">
                        <router-link
                            v-bind:to="{
                                name: 'detail',
                                params: { shop_id: shop.id },
                            }"
                        >
                            <button class="detail">詳しく見る</button>
                        </router-link>
                        <button
                            type="submit"
                            :class="
                                shop.favorites.length !== 0
                                    ? 'favorite'
                                    : 'unfavorite'
                            "
                            @click="changeFav(shop.favorites.length, shop.id)"
                        ></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            shops: [],
            search: {
                area_id: "",
                genre_id: "",
                name: "",
            },
        };
    },
    methods: {
        getShops() {
            axios.get("/api/").then((response) => {
                this.shops = response.data;
                console.log(response.data);
            });
        },
        changeFav(isFavorite, shopId) {
            axios
                .post("/api/favorite", { isFavorite, shopId })
                .then((response) => {
                    this.getShops();
                });
        },
    },
    computed: {
        // リアルタイム検索機能
        filteredShops: function () {
            var shops = [];
            for (var i in this.shops) {
                var shop = this.shops[i];
                if (this.search.area_id == "") {
                    if (this.search.genre_id == "") {
                        if (shop.name.indexOf(this.search.name) !== -1) {
                            shops.push(shop);
                        }
                    } else if (
                        this.search.genre_id.indexOf(shop.genre_id) !== -1 &&
                        shop.name.indexOf(this.search.name) !== -1
                    ) {
                        shops.push(shop);
                    }
                } else if (this.search.genre_id == "") {
                    if (
                        this.search.area_id.indexOf(shop.area_id) !== -1 &&
                        shop.name.indexOf(this.search.name) !== -1
                    ) {
                        shops.push(shop);
                    }
                } else {
                    if (
                        this.search.area_id.indexOf(shop.area_id) !== -1 &&
                        this.search.genre_id.indexOf(shop.genre_id) !== -1 &&
                        shop.name.indexOf(this.search.name) !== -1
                    ) {
                        shops.push(shop);
                    }
                }
            }
            return shops;
        },
    },
    mounted() {
        this.getShops();
    },
};
</script>

<style scoped>
/* ---------- 検索ボックス ---------- */

.search-box {
    height: 55px;
    width: 780px;
    background-color: #ffffff;
    box-shadow: 2px 2px 4px gray;
    border-radius: 5px;
    overflow: hidden;
    margin-bottom: 50px;
    padding: 10px 0;
}
.search-box * {
    display: inline-block;
    border: none;
    outline: 0;
    font-size: 16px;
}
.search-box select {
    height: 100%;
    width: 150px;
    padding-left: 10px;
}
.search-box select:nth-of-type(2) {
    border-left: 1px solid #dfdfdf;
}
.search-box input {
    height: 100%;
    width: 400px;
    border-left: 1px solid #dfdfdf;
    padding-left: 10px;
    border-right: 1px solid #dfdfdf;
}
.search-submit {
    content: "";
    background-image: url("/img/search.svg");
    vertical-align: middle;
    height: 30px;
    width: 30px;
    margin-left: 15px;
}

/* ---------- 飲食店一覧表示 ---------- */

.shop-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
    gap: 40px 40px;
}
.card {
    background-color: #ffffff;
    width: 370px;
    height: 340px;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 2px 2px 4px gray;
}
.card-img {
    width: 100%;
    height: 50%;
}
.card-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.card-content {
    padding: 20px;
}
.shop-name {
    margin: 5px 0;
    font-size: 22px;
    font-weight: bold;
}
.tag {
    margin: 10px 0;
    font-size: small;
}
.card-footer {
    margin-top: 40px;
    display: flex;
    justify-content: space-between;
}
.detail {
    display: inline-block;
    border: none;
    background-color: #2f60ff;
    color: #ffffff;
    padding: 7px 20px;
    border-radius: 5px;
    cursor: pointer;
}
.unfavorite,
.favorite {
    display: inline-block;
    padding: 0;
    border: none;
    background: transparent;
    cursor: pointer;
    width: 35px;
    background-repeat: no-repeat;
}
.unfavorite {
    background-image: url("/img/heart-gray.svg");
}
.favorite {
    background-image: url("/img/heart-pink.svg");
}
</style>
