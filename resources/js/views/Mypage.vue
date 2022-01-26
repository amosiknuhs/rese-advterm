<template>
    <div class="mypage-content">
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
        <div class="user-content">
            <div class="reserve-content">
                <div
                    class="reserve-card"
                    v-for="(reserve, index) in reserves"
                    :key="index"
                >
                    <div class="reserve-header">
                        <p class="reserve-name">予約{{ index + 1 }}</p>
                    </div>
                    <div class="reserve-confirm">
                        <div class="rsvCard-img">
                            <img :src="reserve.shop.img_url" alt="" />
                        </div>
                        <div class="reserve-detail">
                            <p>店名　　：{{ reserve.shop.name }}</p>
                            <p>来店日　：{{ reserve.date }}</p>
                            <p>来店時間：{{ reserve.time | jsonTime }}</p>
                            <p>来店人数：{{ reserve.number | numUnit }}</p>
                        </div>
                        <div class="reserve-button">
                            <router-link
                                v-bind:to="{
                                    name: 'change-reserve',
                                    params: {
                                        reserve_id: reserve.id,
                                        reserve_date: reserve.date,
                                        reserve_time: reserve.time,
                                        reserve_number: reserve.number,
                                    },
                                }"
                            >
                                <button class="change">変更</button>
                            </router-link>
                            <router-link
                                v-bind:to="{
                                    name: 'evaluation',
                                    params: { shop_id: reserve.shop.id },
                                }"
                            >
                                <button class="evaluation">評価</button>
                            </router-link>
                            <router-link
                                v-bind:to="{
                                    name: 'cancel-dialog',
                                    params: { reserve_id: reserve.id },
                                }"
                            >
                                <button class="cancel">キャンセル</button>
                            </router-link>

                            <!-- <button
                                class="cancel"
                                @click="cancelRsv(reserve.id)"
                            >
                                キャンセル
                            </button> -->
                        </div>
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
        <!-- <transition
            enter-active-class="animate__animated animate__zoomIn"
            leave-active-class="animate__animated animate__zoomOut"
            duration="600"
        >
        </transition> -->
        <transition name="bounce"> </transition>
        <router-view :process-type="processType"></router-view>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            user: "",
            reserves: [],
            favorites: [],
            processType: "",
        };
    },
    filters: {
        jsonTime: function (value) {
            let tenHour = parseInt(value.substring(11, 12), 10);
            let oneHour = parseInt(value.substring(12, 13), 10);
            let min = value.substring(14, 16);
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
        async getUserData() {
            await axios.get("/api/user").then((response) => {
                this.user = response.data;
            });
        },
        async getReserves() {
            await axios.get("/api/mypage/reserves").then((response) => {
                this.reserves = response.data;
            });
        },
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
        async cancelRsv(reserveId) {
            await axios.post("/api/cancel", { reserveId }).then((response) => {
                this.getReserves();
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
        this.getUserData();
        this.getReserves();
        this.getFavorites();
    },
    beforeRouteUpdate(to, from, next) {
        if (from.name == "change-reserve") {
            this.processType = "change";
            next();
        } else if (from.name == "evaluation") {
            this.processType = "evaluation";
            next();
        } else if (from.name == "cancel-dialog") {
            this.processType = "cancel";
            next();
        } else if (from.name == "dialog") {
            this.getReserves();
            this.getFavorites();
        }
        next();
    },
};
</script>

<style scoped>
.user-name {
    font-size: 30px;
    font-weight: bold;
}
.user-content {
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
    width: 100%;
    background-color: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 2px 2px 4px gray;
}
.reserve-header {
    background-color: #2f60ff;
    display: flex;
    justify-content: space-between;
    height: 70px;
    padding: 20px;
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
.reserve-confirm {
    display: flex;
    gap: 0 30px;
}
.rsvCard-img {
    width: 250px;
    height: 230px;
    overflow: hidden;
}
.rsvCard-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.reserve-detail {
    padding: 30px 0;
}
.reserve-detail p {
    margin-bottom: 20px;
}
.reserve-button {
    width: 150px;
    margin-left: auto;
    display: flex;
    flex-flow: column;
    justify-content: center;
    gap: 10px 0;
}
.change,
.evaluation {
    border: none;
    background-color: #2f60ff;
    color: #ffffff;
    padding: 7px 20px;
    border-radius: 5px;
    cursor: pointer;
    width: 120px;
    margin-right: 30px;
}
.cancel {
    border: none;
    background-color: red;
    color: #ffffff;
    padding: 7px 20px;
    border-radius: 5px;
    cursor: pointer;
    width: 120px;
    margin-right: 30px;
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
/* ----------トランジション---------- */
.fade-enter {
    /* 現れる時の最初の状態 */
    opacity: 0;
}
.fade-enter-active {
    /* 現れる時のトランジションの状態 */
    transition: opacity 0.3s;
}
.fade-enter-to {
    /* 現れる時の最後の状態 */
    opacity: 1;
}
.fade-leave {
    /* 消える時の最初の状態 */
    opacity: 1;
}
.fade-leave-active {
    /* 消える時のトランジションの状態 */
    transition: opacity 0.3s;
}
.fade-leave-to {
    /* 消える時の最後の状態 */
    opacity: 0;
}

.bounce-enter-active {
    animation: bounce-in 0.5s;
}
.bounce-leave-active {
    animation: bounce-in 0.5s reverse;
}
@keyframes bounce-in {
    0% {
        transform: scale(0);
    }
    50% {
        transform: scale(1.5);
    }
    100% {
        transform: scale(1);
    }
}
</style>
