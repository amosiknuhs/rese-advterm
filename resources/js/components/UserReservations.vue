<template>
    <div>
        <div class="list-header">
            <p class="list-title">予約一覧</p>
        </div>
        <div class="reserve-content">
            <div class="desktop">
                <table class="reserve-table">
                    <colgroup span="1" class="reserve-id"></colgroup>
                    <colgroup span="1" class="reserve-name"></colgroup>
                    <colgroup span="1" class="reserve-date"></colgroup>
                    <colgroup span="1" class="reserve-time"></colgroup>
                    <colgroup span="1" class="reserve-number"></colgroup>
                    <colgroup span="1" class="reserve-button"></colgroup>
                    <tr>
                        <th>予約番号</th>
                        <th>予約者名</th>
                        <th>来店日</th>
                        <th>来店時間</th>
                        <th>来店人数</th>
                        <th></th>
                    </tr>
                    <tr
                        class=""
                        v-for="(reserve, index) in shopData.reservations"
                        :key="index"
                    >
                        <td>{{ reserve.id }}</td>
                        <td>{{ reserve.user.name }}</td>
                        <td>{{ reserve.date }}</td>
                        <td>{{ reserve.time | jsonTime }}</td>
                        <td>{{ reserve.number | numUnit }}</td>
                        <td><button>予約詳細</button></td>
                    </tr>
                </table>
            </div>
            <div class="mobile">
                <table
                    class="reserve-table"
                    v-for="(reserve, index) in shopData.reservations"
                    :key="index"
                >
                    <tr>
                        <th>予約番号</th>
                        <td>{{ reserve.id }}</td>
                    </tr>
                    <tr>
                        <th>予約者名</th>
                        <td>{{ reserve.user.name }}</td>
                    </tr>
                    <tr>
                        <th>来店日</th>
                        <td>{{ reserve.date }}</td>
                    </tr>
                    <tr>
                        <th>来店時間</th>
                        <td>{{ reserve.time | jsonTime }}</td>
                    </tr>
                    <tr>
                        <th>来店人数</th>
                        <td>{{ reserve.number | numUnit }}</td>
                    </tr>
                    <tr>
                        <th></th>
                        <td><button>予約詳細</button></td>
                    </tr>
                </table>
            </div>
        </div>
        <div v-if="shopData.reservations.length == 0" class="noReserve">
            ※現在予約はありません
        </div>
    </div>
</template>

<script>
export default {
    props: {
        shopData: {
            type: Object,
        },
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
};
</script>

<style scoped>
.list-header {
    height: 70px;
    width: 100%;
    background-color: #552fff;
    border-radius: 10px 10px 0 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-right: 30px;
}
.list-title {
    text-decoration: none;
    font-size: 25px;
    font-weight: bold;
    line-height: 70px;
    color: #fff;
    padding-left: 30px;
}
.reserve-content {
    display: flex;
    justify-content: center;
}
.desktop {
    width: 100%;
}
.reserve-table {
    width: 100%;
    text-align: center;
}
.reserve-table th {
    background-color: #afafaf;
    color: #fff;
    padding: 20px 0;
}
.reserve-table td:not(:last-of-type) {
    padding: 20px 0;
}
.reserve-table tr:not(:last-of-type) {
    border-bottom: 1px solid #d1d5db;
}
.reserve-table button {
    display: inline-block;
    border: none;
    background-color: #552fff;
    color: #ffffff;
    padding: 7px 20px;
    border-radius: 5px;
    cursor: pointer;
}
.noReserve {
    padding: 50px 30px;
}
.reserve-id {
    width: 10%;
}
.reserve-name {
    width: 20%;
}
.reserve-date {
    width: 20%;
}
.reserve-time {
    width: 15%;
}
.reserve-number {
    width: 15%;
}
.reserve-button {
    width: 20%;
}
.mobile {
    display: none;
}
/* ------ スマートフォンデザイン ------ */
@media screen and (max-width: 480px) {
    .desktop {
        display: none;
    }
    .mobile {
        display: initial;
    }
    .reserve-content {
        display: initial;
    }
    .reserve-table th {
        padding: 10px 0;
    }
    .reserve-table tr:not(:last-of-type) {
        border-bottom: none;
    }
    .reserve-table:not(:last-of-type) {
        border-bottom: 1px solid #d1d5db;
    }
    .reserve-table button {
        margin: 10px 0;
    }
}
</style>
