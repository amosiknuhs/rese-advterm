<template>
    <div>
        <div class="reserve-content">
            <div
                class="reserve-card"
                v-for="(reserve, index) in reserves"
                :key="index"
            >
                <div class="reserve-header">
                    <p class="reserve-name">予約{{ index + 1 }}</p>
                    <router-link
                        v-bind:to="{
                            name: 'reserve-code',
                            params: {
                                reserve_name: reserve.user.name,
                                reserve_date: reserve.date,
                                reserve_time: reserve.time,
                                reserve_number: reserve.number,
                            },
                        }"
                        class="reserve-code"
                    >
                        <button>QRコード</button>
                    </router-link>
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
                                name: 'cancel',
                                params: { reserve_id: reserve.id },
                            }"
                        >
                            <button class="cancel">キャンセル</button>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
        <router-view :process-type="processType"></router-view>
    </div>
</template>
<script>
export default {
    data: function () {
        return {
            reserves: [],
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
        async getReserves() {
            await axios.get("/api/mypage/reserves").then((response) => {
                this.reserves = response.data;
            });
        },
        async cancelRsv(reserveId) {
            await axios.post("/api/cancel", { reserveId }).then((response) => {
                this.getReserves();
            });
        },
    },
    mounted() {
        this.getReserves();
    },
    beforeRouteUpdate(to, from, next) {
        if (from.name == "change-reserve") {
            this.processType = "change";
            next();
        } else if (from.name == "evaluation") {
            this.processType = "evaluation";
            next();
        } else if (from.name == "cancel") {
            this.processType = "cancel";
            next();
        } else if (from.name == "dialog") {
            this.getReserves();
        }
        next();
    },
};
</script>
<style scoped>
.reserve-content {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 30px 0;
}
.reserve-card {
    height: 300px;
    width: 80%;
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
    width: 35%;
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
.reserve-code button {
    border: none;
    background-color: #fff;
    font-weight: bold;
    padding: 5px 0;
    border-radius: 5px;
    cursor: pointer;
    width: 100px;
    display: none;
}
/* ------- タブレットデザイン -------- */
@media screen and (max-width: 768px) {
    .reserve-button {
        width: 100px;
        margin-left: 0;
    }
    .reserve-button button {
        width: 100px;
        padding: 7px 10px;
        margin-right: 10px;
    }
    .reserve-code button {
        display: inline-block;
    }
}
/* ------ スマートフォンデザイン ------ */
@media screen and (max-width: 480px) {
    .reserve-card {
        width: 95%;
        height: 280px;
    }
    .reserve-header {
        padding: 10px;
        height: 50px;
    }
    .reserve-name::before {
        height: 30px;
        width: 30px;
        vertical-align: top;
    }
    .reserve-confirm {
        display: block;
    }
    .rsvCard-img {
        width: 100%;
        height: 80px;
    }
    .reserve-detail {
        padding: 10px;
    }
    .reserve-detail p {
        margin-bottom: 5px;
    }
    .reserve-button {
        flex-flow: initial;
        width: 100%;
    }
    .reserve-button button {
        display: inline-block;
        width: 80px;
    }
    .cancel {
        font-size: 12px;
    }
}
</style>
