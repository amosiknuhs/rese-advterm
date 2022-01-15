<template>
    <div>
        <p class="user-name">{{ user.name }}さん</p>
        <div class="mypage-title">
            <div class="reserve-title-container">
                <span class="reserve-title">予約状況</span>
                <span class="reserve-message"></span>
            </div>
            <div class="favorite-title-container">
                <span class="favorite-title">お気に入り店舗</span>
                <span class="favorite-message"></span>
            </div>
        </div>
        <div class="mypage-content">
            <div class="reserve-content">
                <div
                    class="reserve-card"
                    v-for="(reserve, index) in reserves"
                    :key="index"
                >
                    <div class="reserve-header">
                        <p class="reserve-name">予約{{ index + 1 }}</p>
                        <button
                            type="submit"
                            class="reserve-delete"
                            @click="cancelRsv(reserve.id)"
                        ></button>
                    </div>
                    <div class="reserve-confirm">
                        <div class="rsvCard-img">
                            <img :src="reserve.shop.img_url" alt="" />
                        </div>
                        <table>
                            <tr>
                                <th>店名</th>
                                <td>{{ reserve.shop.name }}</td>
                            </tr>
                            <tr>
                                <th>日付</th>
                                <td>{{ reserve.date }}</td>
                            </tr>
                            <tr>
                                <th>時間</th>
                                <td>{{ reserve.time | jsonTime }}</td>
                            </tr>
                            <tr>
                                <th>人数</th>
                                <td>{{ reserve.number | numUnit }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
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
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            user: "",
            reserves: [],
            favorites: [],
        };
    },
    filters: {
        jsonTime: function (value) {
            var tenHour = parseInt(value.substring(11, 12), 10);
            var oneHour = parseInt(value.substring(12, 13), 10);
            var min = value.substring(14, 16);
            if (tenHour == 0) {
                return oneHour + 9 + ":" + min;
            } else {
                return oneHour + 19 + ":" + min;
            }
        },
        numUnit: function (value) {
            return value + "人";
        },
    },
    methods: {
        getUserData() {
            axios.get("/api/user").then((response) => {
                this.user = response.data;
                console.log(response.data);
            });
        },
        getReserves() {
            axios.get("/api/mypage/reserves").then((response) => {
                this.reserves = response.data;
            });
        },
        getFavorites() {
            axios.get("/api/mypage/favorites").then((response) => {
                this.favorites = response.data;
            });
        },
        cancelRsv(reserveId) {
            axios.post("/api/cancel", { reserveId }).then((response) => {
                this.getReserves();
            });
        },
        changeFav(isFavorite, shopId) {
            axios
                .post("/api/favorite", { isFavorite, shopId })
                .then((response) => {
                    this.getFavorites();
                });
        },
    },
    mounted() {
        this.getUserData();
        this.getReserves();
        this.getFavorites();
    },
};
</script>

<style scoped>
.user-name {
    font-size: 30px;
    font-weight: bold;
}
.mypage-content {
    display: flex;
    gap: 0 8%;
    width: 100%;
}

/* ----------タイトル---------- */

.mypage-title {
    display: flex;
    gap: 0 8%;
    width: 100%;
}
.reserve-title-container {
    width: 45%;
}
.favorite-title-container {
    width: 55%;
}
.reserve-title,
.favorite-title {
    font-size: 25px;
    font-weight: bold;
    line-height: 100px;
}
.reserve-message,
.favorite-message {
    margin-left: 30px;
    font-weight: bold;
}

/* ----------予約状況---------- */

.reserve-content {
    height: 100%;
    width: 45%;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 30px 0;
}
.reserve-card {
    height: 300px;
    width: 85%;
    background-color: #2f60ff;
    border-radius: 10px;
    overflow: hidden;
    padding: 30px;
    box-shadow: 2px 2px 4px gray;
}
.reserve-header {
    display: flex;
    justify-content: space-between;
    height: 70px;
}
.reserve-name {
    color: #ffffff;
    font-size: 20px;
    line-height: 30px;
}
.reserve-name::before {
    content: "";
    background-image: url("/img/clock.svg");
    display: inline-block;
    height: 35px;
    width: 35px;
    vertical-align: middle;
    background-size: contain;
    margin-right: 50px;
}
.reserve-delete {
    display: inline-block;
    padding: 0;
    border: none;
    background: transparent;
    cursor: pointer;
    height: 30px;
    width: 30px;
    background-repeat: no-repeat;
    background-image: url("/img/delete.svg");
}
.reserve-confirm {
    display: flex;
    justify-content: space-between;
    /* gap: 0 50px; */
}
.rsvCard-img {
    width: 40%;
    height: 160px;
    border-radius: 10px;
    overflow: hidden;
}
.rsvCard-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.reserve-confirm table {
    color: #ffffff;
    width: 45%;
    text-align: left;
    font-size: 18px;
}

/* ----------お気に入り店舗---------- */

.favorite-content {
    height: 100%;
    width: 55%;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 30px 0;
}
.favorite-card {
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
</style>
