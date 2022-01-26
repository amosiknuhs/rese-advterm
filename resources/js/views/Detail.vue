<template>
    <div class="detail-content">
        <div class="shop-detail">
            <p class="shop-name">{{ shopDetail.name }}</p>
            <div class="shop-img">
                <img :src="shopDetail.img_url" alt="" />
            </div>
            <div class="star">
                <star-rating
                    :rating="averageRate"
                    :increment="0.01"
                    :read-only="true"
                    :star-size="20"
                >
                </star-rating>
                <p class="review-count">（{{ arr.length }}件）</p>
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
        <validation-observer v-slot="{ invalid }" class="reserve-form">
            <form @submit.prevent="createRsv">
                <div class="reserve-content">
                    <p class="form-title">予約</p>
                    <validation-provider
                        rules="selectRequired"
                        v-slot="{ errors }"
                        class="reserve-date"
                    >
                        <input
                            name="来店日"
                            type="date"
                            :min="minDate"
                            v-model="date"
                        />
                        <span
                            class="error-message"
                            v-if="dateMessage && !errors[0]"
                            >{{ dateMessage[0] }}</span
                        >
                        <span class="error-message">{{ errors[0] }}</span>
                    </validation-provider>
                    <validation-provider
                        rules="selectRequired"
                        v-slot="{ errors }"
                        class="reserve-time"
                    >
                        <select v-model="time" name="時間">
                            <option disabled selected value>
                                ーーー 予約時間を選択してください ーーー
                            </option>
                            <option value="11:00">11:00</option>
                            <option value="11:30">11:30</option>
                            <option value="12:00">12:00</option>
                            <option value="12:30">12:30</option>
                            <option value="13:00">13:00</option>
                            <option value="13:30">13:30</option>
                            <option value="14:00">14:00</option>
                            <option value="14:30">14:30</option>
                            <option value="15:00">15:00</option>
                            <option value="17:00">17:00</option>
                            <option value="17:30">17:30</option>
                            <option value="18:00">18:00</option>
                            <option value="18:30">18:30</option>
                            <option value="19:00">19:00</option>
                            <option value="19:30">19:30</option>
                            <option value="20:00">20:00</option>
                            <option value="20:30">20:30</option>
                            <option value="21:00">21:00</option>
                            <option value="21:30">21:30</option>
                            <option value="22:00">22:00</option>
                            <option value="22:30">22:30</option>
                        </select>
                        <span
                            class="error-message"
                            v-if="timeMessage && !errors[0]"
                            >{{ timeMessage[0] }}</span
                        >
                        <span class="error-message">{{ errors[0] }}</span>
                    </validation-provider>
                    <validation-provider
                        rules="selectRequired"
                        v-slot="{ errors }"
                        class="reserve-number"
                    >
                        <select v-model="number" name="人数">
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
                        <span
                            class="error-message"
                            v-if="numMessage && !errors[0]"
                            >{{ numMessage[0] }}</span
                        >
                        <span class="error-message">{{ errors[0] }}</span>
                    </validation-provider>
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
                    <button type="submit" :disabled="invalid">予約する</button>
                </div>
            </form>
        </validation-observer>
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
            arr: [],
            minDate: "",
        };
    },
    computed: {
        numUnit: function () {
            if (this.number != "") {
                return this.number + "人";
            }
        },
        averageRate: function () {
            if (this.arr.length == 0) {
                return 0;
            } else {
                let sum = 0;
                this.arr.forEach(function (value) {
                    sum += value;
                });
                return (
                    Math.round((sum / this.arr.length) * Math.pow(10, 2)) /
                    Math.pow(10, 2)
                );
            }
        },
    },
    methods: {
        async getShopDetail() {
            await axios.get("/api/detail/" + this.id).then((response) => {
                this.shopDetail = response.data;
                this.arr = this.shopDetail.evaluations.map(
                    (star) => star["rating"]
                );
            });
        },
        async createRsv() {
            await axios
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
                    if (err.response.status == 422) {
                        this.dateMessage = err.response.data.errors.date;
                        this.timeMessage = err.response.data.errors.time;
                        this.numMessage = err.response.data.errors.number;
                    }
                });
        },
        setMinDate() {
            let today = new Date();
            let year = today.getFullYear();
            let month = today.getMonth() + 1;
            let day = today.getDate();
            let toTwoDigits = function (num, digit) {
                num += "";
                if (num.length < digit) {
                    num = "0" + num;
                }
                return num;
            };
            let yyyy = toTwoDigits(year, 4);
            let mm = toTwoDigits(month, 2);
            let dd = toTwoDigits(day, 2);
            let ymd = yyyy + "-" + mm + "-" + dd;
            this.minDate = ymd;
        },
    },
    mounted() {
        this.setMinDate();
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
    margin: 20px 0;
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
.reserve-footer {
    display: flex;
    justify-content: center;
    align-items: center;
}
.reserve-footer button {
    border: none;
    background-color: #003cff;
    color: #ffffff;
    height: 65px;
    cursor: pointer;
    font-size: 18px;
    padding: 7px 40px;
    border-radius: 5px;
}
.reserve-footer button:disabled {
    cursor: default;
    background-color: #cfcfcf;
    color: #999999;
}
.error-message {
    vertical-align: middle;
    display: inline-block;
    height: 40px;
    color: #fff;
}
.star {
    display: flex;
    align-items: center;
    margin: 20px 0;
}
.review-count {
    color: #999;
}
</style>
