<template>
    <div class="detail-content">
        <div class="shop-detail">
            <p class="shop-name">{{ shopDetail.name }}</p>
            <div class="shop-img">
                <img :src="shopDetail.img_url" alt="" />
            </div>
            <div class="tag">
                <span class="area-tag" v-if="shopDetail"
                    >#{{ shopDetail.area.name }}</span
                >
                <span class="genre-tag" v-if="shopDetail"
                    >#{{ shopDetail.genre.name }}</span
                >
            </div>
            <p class="shop-content">{{ shopDetail.content }}</p>
        </div>
        <form class="reserve-form" @submit.prevent="createRsv">
            <div class="reserve-content">
                <p class="form-title">予約</p>
                <div class="reserve-date">
                    <input type="date" v-model="date" />
                    <span class="error-message" v-if="dateMessage">{{
                        dateMessage[0]
                    }}</span>
                </div>
                <div class="reserve-time">
                    <select v-model="time">
                        <option disabled selected value>
                            ーーー 予約時間を選択してください ーーー
                        </option>
                        <option value="17:00">17:00</option>
                        <option value="18:00">18:00</option>
                        <option value="19:00">19:00</option>
                        <option value="20:00">20:00</option>
                        <option value="21:00">21:00</option>
                        <option value="22:00">22:00</option>
                    </select>
                    <span class="error-message" v-if="timeMessage">{{
                        timeMessage[0]
                    }}</span>
                </div>
                <div class="reserve-number">
                    <select v-model="number">
                        <option disabled selected value>
                            ーーー 予約人数を選択してください ーーー
                        </option>
                        <option value="1">1人</option>
                        <option value="2">2人</option>
                        <option value="3">3人</option>
                        <option value="4">4人</option>
                        <option value="5">5人</option>
                        <option value="6">6人</option>
                        <option value="7">7人</option>
                        <option value="8">8人</option>
                        <option value="9">9人</option>
                        <option value="10">10人</option>
                    </select>
                    <span class="error-message" v-if="numMessage">{{
                        numMessage[0]
                    }}</span>
                </div>
                <div class="reserve-confirm">
                    <table>
                        <tr>
                            <th>店名</th>
                            <td>{{ shopDetail.name }}</td>
                        </tr>
                        <tr>
                            <th>日付</th>
                            <td id="reserveDate">{{ date }}</td>
                        </tr>
                        <tr>
                            <th>時間</th>
                            <td id="reserveTime">{{ time }}</td>
                        </tr>
                        <tr>
                            <th>人数</th>
                            <td id="reserveNumber">
                                {{ numUnit }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="reserve-footer">
                <button type="submit">予約する</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            id: this.$route.params.shop_id,
            shopDetail: "",
            date: "",
            time: "",
            number: "",
            dateMessage: "",
            timeMessage: "",
            numMessage: "",
        };
    },
    computed: {
        numUnit: function () {
            if (this.number != "") {
                return this.number + "人";
            }
        },
    },
    methods: {
        getShopDetail() {
            axios.get("/api/detail/" + this.id).then((response) => {
                this.shopDetail = response.data;
            });
        },
        createRsv() {
            axios
                .post("/api/reserve", {
                    shop_id: this.id,
                    date: this.date,
                    time: this.time,
                    number: this.number,
                })
                .then((response) => {
                    this.$router.push("/done");
                })
                .catch((err) => {
                    if (err.response.data.message == "Unauthenticated.") {
                        this.$router.push("/login");
                    } else {
                        this.dateMessage = err.response.data.errors.date;
                        this.timeMessage = err.response.data.errors.time;
                        this.numMessage = err.response.data.errors.number;
                    }
                });
        },
        setToday() {
            var today = new Date();
            var year = today.getFullYear();
            var month = today.getMonth() + 1;
            var day = today.getDate();

            var toTwoDigits = function (num, digit) {
                num += "";
                if (num.length < digit) {
                    num = "0" + num;
                }
                return num;
            };

            var yyyy = toTwoDigits(year, 4);
            var mm = toTwoDigits(month, 2);
            var dd = toTwoDigits(day, 2);
            var ymd = yyyy + "-" + mm + "-" + dd;

            this.date = ymd;
        },
    },
    mounted() {
        this.setToday();
        this.getShopDetail();
    },
};
</script>

<style scoped>
.detail-content {
    display: flex;
    gap: 0 8%;
    height: 80vh;
    width: 100%;
}

/* ----------shop---------- */

.shop-detail {
    height: 800px;
    width: 50%;
}
.shop-name {
    margin: 30px 0;
    font-size: 30px;
    font-weight: bold;
}
.shop-img {
    width: 100%;
    height: 60%;
}
.shop-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.tag {
    margin: 30px 0;
}
.shop-content {
    font-size: 18px;
    line-height: 35px;
}

/* ----------reserve---------- */

.reserve-form {
    height: 800px;
    width: 50%;
    background-color: #2f60ff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 2px 2px 4px gray;
}
.reserve-content {
    padding: 50px 40px;
    height: 92%;
}
.reserve-date,
.reserve-time,
.reserve-number {
}
.reserve-date input,
.reserve-time select,
.reserve-number select {
    display: inline-block;
    width: 50%;
    height: 40px;
    border: none;
    border-radius: 5px;
    margin-bottom: 20px;
}
.form-title {
    font-size: 30px;
    font-weight: bold;
    color: #ffffff;
    margin-bottom: 50px;
}
.reserve-confirm {
    height: 250px;
    width: 100%;
    background-color: #6f91ff;
    border-radius: 10px;
    padding: 40px 40px;
    margin-top: 30px;
}
.reserve-confirm table {
    color: #ffffff;
    width: 50%;
    height: 100%;
    text-align: left;
}
.reserve-footer button {
    border: none;
    background-color: #003cff;
    color: #ffffff;
    height: 65px;
    width: 100%;
    cursor: pointer;
    font-size: 18px;
}
.error-message {
    vertical-align: middle;
    display: inline-block;
    height: 40px;
    color: #fff;
}
</style>
