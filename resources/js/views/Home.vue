<template>
    <div class="home-content">
        <div class="search-box">
            <div class="input-area">
                <select v-model="search.area_id" class="search-area">
                    <option value="">All area</option>
                    <option value="1">東京都</option>
                    <option value="2">大阪府</option>
                    <option value="3">福岡県</option>
                </select>
                <select v-model="search.genre_id" class="search-genre">
                    <option value="">All genre</option>
                    <option value="1">寿司</option>
                    <option value="2">焼肉</option>
                    <option value="3">居酒屋</option>
                    <option value="4">イタリアン</option>
                    <option value="5">ラーメン</option>
                </select>
                <div class="img-container">
                    <span class="search-img"></span>
                </div>
                <input
                    v-model="search.name"
                    type="text"
                    class="search-name"
                    placeholder="Shop name"
                />
            </div>
            <button class="search-reset" @click="searchReset">RESET</button>
        </div>
        <div class="shop-list">
            <div
                class="card"
                v-for="(shop, index) in filteredShops"
                :key="index"
            >
                <router-link
                    v-bind:to="{
                        name: 'detail',
                        params: { shop_id: shop.id },
                    }"
                >
                    <div class="card-img">
                        <img :src="shop.img_url" alt="" />
                    </div>
                </router-link>
                <div class="card-content">
                    <p class="shop-name">{{ shop.name }}</p>
                    <div class="tag">
                        <span class="area-tag">#{{ shop.area.name }}</span>
                        <span class="genre-tag">#{{ shop.genre.name }}</span>
                    </div>
                    <div class="star">
                        <star-rating
                            :rating="shop.star"
                            :increment="0.01"
                            :read-only="true"
                            :star-size="15"
                        >
                        </star-rating>
                        <p class="review-count">（{{ shop.reviewCount }}件）</p>
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
    filters: {},
    methods: {
        async getShops() {
            await axios.get("/api/home").then((response) => {
                for (let i in response.data) {
                    let shop = response.data[i];
                    let arr = shop.evaluations.map((star) =>
                        parseFloat(star["rating"])
                    );
                    if (arr.length == 0) {
                        shop["star"] = 0;
                        shop["reviewCount"] = 0;
                    } else {
                        let sum = 0;
                        arr.forEach(function (value) {
                            sum += value;
                        });
                        shop["star"] =
                            Math.round((sum / arr.length) * Math.pow(10, 2)) /
                            Math.pow(10, 2);
                        shop["reviewCount"] = arr.length;
                    }
                }
                this.shops = response.data;
            });
        },
        changeFav(isFavorite, shopId) {
            axios
                .post("/api/favorite", { isFavorite, shopId })
                .then((response) => {
                    this.getShops();
                });
        },
        searchReset() {
            this.search.area_id = "";
            this.search.genre_id = "";
            this.search.name = "";
        },
    },
    computed: {
        // リアルタイム検索機能
        filteredShops: function () {
            let shops = [];
            for (let i in this.shops) {
                let shop = this.shops[i];
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
    margin-bottom: 30px;
    display: flex;
    justify-content: space-between;
}
.search-box * {
    display: inline-block;
    border: none;
    outline: 0;
    font-size: 17px;
}
.input-area {
    width: 100%;
    padding: 5px;
}
.search-area,
.search-genre {
    height: 100%;
    width: 20%;
}
.search-genre {
    border-left: 1px solid #dfdfdf;
    padding: 0 5px;
}
.img-container {
    height: 100%;
    width: 30px;
    padding: 0 5px;
    border-left: 1px solid #dfdfdf;
}
.search-img {
    background-image: url("/img/search.svg");
    background-position: center;
    vertical-align: middle;
    height: 100%;
    width: 30px;
    background-repeat: no-repeat;
}
.search-name {
    height: 100%;
    width: 52%;
    padding: 0;
    margin-left: 5px;
}
.search-reset {
    height: 100%;
    width: 12%;
    padding: 0;
    background-color: #2f60ff;
    color: #fff;
    cursor: pointer;
}
/* ---------- 飲食店一覧表示 ---------- */
.shop-list {
    display: flex;
    flex-wrap: wrap;
    gap: 20px 20px;
}
.card {
    background-color: #ffffff;
    width: 300px;
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
    margin-top: 20px;
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
.star {
    display: flex;
    align-items: center;
    margin: 10px 0;
}
.review-count {
    color: #999;
    font-size: 14px;
}
>>> .vue-star-rating-rating-text {
    font-size: 14px;
}
/* ------- タブレットデザイン -------- */
@media screen and (max-width: 768px) {
    .search-box {
        max-width: 100%;
    }
    .search-name {
        width: 40vw;
    }
    .card {
        width: 48.5%;
    }
}
/* ------ スマートフォンデザイン ------ */
@media screen and (max-width: 480px) {
    .search-area {
        width: 30%;
    }
    .search-genre {
        width: 30%;
    }
    .search-name {
        width: 30%;
        border-left: 1px solid #dfdfdf;
        padding-left: 10px;
        font-size: 13px;
    }
    .img-container {
        display: none;
    }
    .card {
        width: 100%;
    }
    .search-reset {
        font-size: 15px;
        width: 18%;
    }
}
</style>
