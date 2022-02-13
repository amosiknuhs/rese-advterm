<template>
    <div>
        <p class="shop-name">{{ shopDetail.name }}</p>
        <hr />
        <div class="reserve-box">
            <validation-observer v-slot="{ invalid }">
                <div class="reserve-form">
                    <p class="form-title">ネット予約</p>
                    <div class="reserve-content">
                        <validation-provider
                            rules="selectRequired"
                            v-slot="{ errors }"
                            class="reserve-date"
                            tag="div"
                        >
                            <label for="date">来店日：</label>
                            <input
                                name="来店日"
                                id="date"
                                type="date"
                                :min="minDate"
                                v-model="date"
                            />
                            <div class="error-message">
                                <span>{{ errors[0] }}</span>
                                <span v-if="dateMessage && !errors[0]">{{
                                    dateMessage[0]
                                }}</span>
                            </div>
                        </validation-provider>
                        <validation-provider
                            rules="selectRequired"
                            v-slot="{ errors }"
                            class="reserve-time"
                            tag="div"
                        >
                            <label for="time">時間：</label>
                            <select v-model="time" name="時間" id="time">
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
                            <div class="error-message">
                                <span>{{ errors[0] }}</span>
                                <span v-if="timeMessage && !errors[0]">{{
                                    timeMessage[0]
                                }}</span>
                            </div>
                        </validation-provider>
                        <validation-provider
                            rules="selectRequired"
                            v-slot="{ errors }"
                            class="reserve-number"
                            tag="div"
                        >
                            <label for="number">人数：</label>
                            <select v-model="number" name="人数" id="number">
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
                            <div class="error-message">
                                <span>{{ errors[0] }}</span>
                                <span v-if="numMessage && !errors[0]">{{
                                    numMessage[0]
                                }}</span>
                            </div>
                        </validation-provider>
                    </div>
                    <router-link
                        v-bind:to="{
                            name: 'confirm-reserve',
                            params: {
                                shop_id: id,
                                shop_name: shopDetail.name,
                                date: date,
                                time: time,
                                number: number,
                            },
                        }"
                        class="reserve-footer"
                    >
                        <button :disabled="invalid">確認する</button>
                    </router-link>
                </div>
            </validation-observer>
        </div>
        <div class="detail-content">
            <div class="shop-detail">
                <h2>店舗詳細</h2>
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
                <hr />
                <h2>口コミ</h2>
                <div
                    class="evaluation-card"
                    v-for="(evaluation, index) in evaluations"
                    :key="index"
                >
                    <p>{{ evaluation.comment }}</p>
                    <star-rating
                        :rating="evaluation.rating"
                        :increment="0.01"
                        :read-only="true"
                        :star-size="20"
                    >
                    </star-rating>
                </div>
            </div>
            <div class="reserve-bar">
                <validation-observer v-slot="{ invalid }">
                    <div class="reserve-form">
                        <p class="form-title">ネット予約</p>
                        <div class="reserve-content">
                            <validation-provider
                                rules="selectRequired"
                                v-slot="{ errors }"
                                class="reserve-date"
                                tag="div"
                            >
                                <label for="date">来店日：</label>
                                <input
                                    name="来店日"
                                    id="date"
                                    type="date"
                                    :min="minDate"
                                    v-model="date"
                                />
                                <div class="error-message">
                                    <span>{{ errors[0] }}</span>
                                    <span v-if="dateMessage && !errors[0]">{{
                                        dateMessage[0]
                                    }}</span>
                                </div>
                            </validation-provider>
                            <validation-provider
                                rules="selectRequired"
                                v-slot="{ errors }"
                                class="reserve-time"
                                tag="div"
                            >
                                <label for="time">時間　：</label>
                                <select v-model="time" name="時間" id="time">
                                    <option disabled selected value>
                                        予約時間を選択してください
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
                                <div class="error-message">
                                    <span>{{ errors[0] }}</span>
                                    <span v-if="timeMessage && !errors[0]">{{
                                        timeMessage[0]
                                    }}</span>
                                </div>
                            </validation-provider>
                            <validation-provider
                                rules="selectRequired"
                                v-slot="{ errors }"
                                class="reserve-number"
                            >
                                <label for="number">人数　：</label>
                                <select
                                    v-model="number"
                                    name="人数"
                                    id="number"
                                    tag="div"
                                >
                                    <option disabled selected value>
                                        予約人数を選択してください
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
                                <div class="error-message">
                                    <span>{{ errors[0] }}</span>
                                    <span v-if="numMessage && !errors[0]">{{
                                        numMessage[0]
                                    }}</span>
                                </div>
                            </validation-provider>
                            <router-link
                                v-bind:to="{
                                    name: 'confirm-reserve',
                                    params: {
                                        shop_id: id,
                                        shop_name: shopDetail.name,
                                        date: date,
                                        time: time,
                                        number: number,
                                    },
                                }"
                                class="reserve-footer"
                            >
                                <button :disabled="invalid">確認する</button>
                            </router-link>
                        </div>
                    </div>
                </validation-observer>
            </div>
        </div>
        <router-view></router-view>
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
            evaluations: [],
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
                this.evaluations = response.data.evaluations;
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
                    this.$router.push("/rese/done");
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
    justify-content: space-between;
}
.shop-name {
    margin-bottom: 30px;
    height: 30px;
    font-size: 30px;
    font-weight: bold;
}

/* ----------shop-detail---------- */
.shop-detail {
    height: 2000px;
    width: 63%;
}
.shop-detail h2 {
    font-size: 20px;
    margin-bottom: 20px;
}
.shop-img {
    width: 100%;
    height: 500px;
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
.star {
    display: flex;
    align-items: center;
    margin: 20px 0;
}
.review-count {
    color: #999;
}
.evaluation-card {
    padding: 30px;
    background-color: #fff;
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 10px;
}
/* ----------reserve-form---------- */
.reserve-box {
    display: none;
}
.reserve-bar {
    height: 100%;
    width: 440px;
    position: sticky;
    top: 100px;
}
.reserve-form {
    background-color: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 2px 2px 4px gray;
}
.reserve-content {
    padding: 30px;
    height: 350px;
}
.form-title {
    font-size: 25px;
    font-weight: bold;
    color: #ffffff;
    background-color: #2f60ff;
    height: 60px;
    line-height: 60px;
    padding-left: 20px;
}
.reserve-content label {
    display: inline-block;
    line-height: 40px;
    vertical-align: middle;
    color: #2f60ff;
    font-weight: bold;
}
.reserve-date input,
.reserve-time select,
.reserve-number select {
    display: inline-block;
    width: 80%;
    height: 40px;
    border: none;
    outline: none;
    border-bottom: 1px solid #d1d5db;
}
.reserve-footer {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
    text-decoration: none;
}
.reserve-footer button {
    border: none;
    background-color: #003cff;
    color: #ffffff;
    cursor: pointer;
    padding: 10px 0;
    width: 100%;
    border-radius: 5px;
}
.reserve-footer button:disabled {
    cursor: default;
    background-color: #cfcfcf;
    color: #999999;
}
.error-message {
    height: 30px;
    color: red;
    margin-left: 70px;
}
/* ------- タブレットデザイン -------- */
@media screen and (max-width: 768px) {
    .form-title {
        font-size: 20px;
        font-weight: bold;
        color: #ffffff;
        background-color: #2f60ff;
        height: 40px;
        line-height: 40px;
        padding-left: 20px;
    }
    .reserve-bar {
        display: none;
    }
    .shop-detail {
        width: 100%;
    }
    .reserve-box {
        display: block;
        margin-bottom: 20px;
    }
    .reserve-content {
        padding: 10px;
        height: 60px;
    }
    .reserve-content label {
        line-height: 20px;
    }
    .reserve-date input,
    .reserve-time select,
    .reserve-number select {
        width: 100%;
        height: 20px;
    }
    .error-message {
        height: 20px;
        margin-left: 0px;
    }
    .reserve-date {
        display: inline-block;
        width: 40%;
    }
    .reserve-time,
    .reserve-number {
        display: inline-block;
        width: 28%;
    }
    .reserve-content {
        display: flex;
        justify-content: space-between;
    }
    .reserve-footer button {
        border-radius: 0 0 5px 5px;
        height: 40px;
    }
}
/* ------ スマートフォンデザイン ------ */
@media screen and (max-width: 480px) {
    .shop-img {
        height: 300px;
    }
    .error-message {
        font-size: 13px;
    }
}
</style>
