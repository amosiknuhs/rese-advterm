<template>
    <div>
        <div class="favorite-content">
            <div
                class="favorite-card"
                v-for="(favorite, index) in favorites"
                :key="index"
            >
                <div class="card-img">
                    <img :src="favorite.shop.img_url" alt="" />
                </div>
                <div class="card-content">
                    <p class="shop-name">{{ favorite.shop.name }}</p>
                    <div class="tag">
                        <span class="area-tag"
                            >#{{ favorite.shop.area.name }}</span
                        >
                        <span class="genre-tag"
                            >#{{ favorite.shop.genre.name }}</span
                        >
                    </div>
                    <div class="star">
                        <star-rating
                            :rating="favorite.shop.star"
                            :increment="0.01"
                            :read-only="true"
                            :star-size="15"
                        >
                        </star-rating>
                        <p class="review-count">
                            （{{ favorite.shop.reviewCount }}件）
                        </p>
                    </div>
                    <div class="card-footer">
                        <router-link
                            v-bind:to="{
                                name: 'detail',
                                params: { shop_id: favorite.shop_id },
                            }"
                        >
                            <button class="detail">詳しく見る</button>
                        </router-link>
                        <button
                            type="submit"
                            class="favorite"
                            @click="changeFav(1, favorite.shop_id)"
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
            favorites: [],
        };
    },
    methods: {
        async getFavorites() {
            await axios.get("/api/mypage/favorites").then((response) => {
                for (let i in response.data) {
                    let shop = response.data[i].shop;
                    let arr = shop.evaluations.map((star) => star["rating"]);
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
                this.favorites = response.data;
            });
        },
        async changeFav(isFavorite, shopId) {
            await axios
                .post("/api/favorite", { isFavorite, shopId })
                .then((response) => {
                    this.getFavorites();
                });
        },
    },
    mounted() {
        this.getFavorites();
    },
};
</script>

<style scoped>
.favorite-content {
    display: flex;
    flex-wrap: wrap;
    gap: 20px 20px;
}
.favorite-card {
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
    border: none;
    background-color: #2f60ff;
    color: #ffffff;
    padding: 7px 20px;
    border-radius: 5px;
    cursor: pointer;
}
.favorite {
    display: inline-block;
    padding: 0;
    border: none;
    background: transparent;
    cursor: pointer;
    width: 35px;
    background-image: url("/img/heart-pink.svg");
    background-repeat: no-repeat;
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
    .favorite-card {
        width: 45%;
    }
}
/* ------ スマートフォンデザイン ------ */
@media screen and (max-width: 480px) {
    .favorite-card {
        width: 95%;
        height: 230px;
    }
    .card-img {
        height: 40%;
    }
    .card-content {
        padding: 10px;
    }
    .tag {
        margin: 5px 0;
    }
    .star {
        margin: 5px 0;
    }
    .card-footer {
        margin-top: 10px;
    }
}
</style>
