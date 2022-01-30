<template>
    <div class="modal">
        <div class="modal-content">
            <div class="modal-content-inner">
                <div class="header">
                    <p>予約の変更</p>
                    <button class="back" @click="$router.go(-1)"></button>
                </div>
                <div class="content">
                    <div class="date">
                        <label for="date">日付：</label>
                        <input
                            id="date"
                            type="date"
                            :min="minDate"
                            v-model="date"
                        />
                    </div>
                    <div class="time">
                        <label for="time">時間：</label>
                        <select id="time" v-model="time">
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
                    </div>
                    <div class="number">
                        <label for="number">人数：</label>
                        <select id="number" v-model="number">
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
                    </div>
                    <div class="footer">
                        <button class="change" @click="updateReserve">
                            変更
                        </button>
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
            id: this.$route.params.reserve_id,
            date: this.$route.params.reserve_date,
            minDate: "",
            time: "",
            number: this.$route.params.reserve_number,
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
    },
    methods: {
        async updateReserve() {
            await axios
                .post("/api/change", {
                    id: this.id,
                    date: this.date,
                    time: this.time,
                    number: this.number,
                })
                .then((response) => {
                    this.$router.push("/mypage/reservation/dialog");
                });
        },
        setToday() {
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
        jsonTime() {
            let setTime = this.$route.params.reserve_time;
            let tenHour = parseInt(setTime.substring(11, 12), 10);
            let oneHour = parseInt(setTime.substring(12, 13), 10);
            let min = setTime.substring(14, 16);
            if (tenHour == 0) {
                this.time = oneHour + 9 + ":" + min;
            } else {
                this.time = oneHour + 19 + ":" + min;
            }
        },
    },
    mounted() {
        this.setToday();
        this.jsonTime();
    },
};
</script>

<style scoped>
.modal {
    position: fixed;
    left: 0%;
    top: 0%;
    height: 100vh;
    width: 100vw;
    background-color: rgba(0, 0, 0, 0.3);
    z-index: 5;
}
.modal-content {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
}
.modal-content-inner {
    border-radius: 10px;
    overflow: hidden;
    background-color: white;
    width: 600px;
    box-shadow: 2px 2px 10px gray;
}
.header {
    display: flex;
    justify-content: space-between;
    background-color: #2f60ff;
    color: #fff;
    height: 60px;
    line-height: 60px;
    padding-left: 30px;
    font-size: 20px;
}
.content {
    height: 300px;
    padding: 30px;
}
.content label {
    display: inline-block;
    line-height: 40px;
    vertical-align: top;
    color: #2f60ff;
    font-weight: bold;
}
.date input,
.time select,
.number select {
    display: inline-block;
    width: 87%;
    height: 40px;
    margin-bottom: 20px;
    border: none;
    outline: 0;
    border-bottom: 1px solid #d1d5db;
}
.footer {
    display: flex;
    justify-content: center;
    margin-top: 15px;
}
.back {
    display: inline-block;
    padding: 0;
    border: none;
    background: transparent;
    cursor: pointer;
    height: 30px;
    width: 30px;
    background-repeat: no-repeat;
    background-image: url("/img/delete.svg");
    margin: auto 20px;
}
.change {
    border: none;
    background-color: #2f60ff;
    color: #ffffff;
    padding: 7px 20px;
    border-radius: 5px;
    cursor: pointer;
    width: 120px;
}
</style>
