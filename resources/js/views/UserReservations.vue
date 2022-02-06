<template>
    <div>
        <div class="list-header">
            <p class="list-title">予約一覧</p>
        </div>
        <div class="reserve-content">
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
                    <td>ボタン置く</td>
                </tr>
            </table>
        </div>
        <div v-if="shopData.reservations.length == 0" class="noReserve">
            ※現在予約はありません
        </div>
        <!-- <router-view :process-type="processType"></router-view> -->
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
</style>
