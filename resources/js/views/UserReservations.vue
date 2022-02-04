<template>
    <div>
        <div class="reserve-content">
            <table class="reserve-table">
                <tr>
                    <th>予約番号</th>
                    <th>予約者名</th>
                    <th>来店日</th>
                    <th>来店時間</th>
                    <th>来店人数</th>
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
                </tr>
            </table>
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
.reserve-content {
    display: flex;
    justify-content: center;
}
.reserve-table {
    width: 100%;
    text-align: center;
}
.reserve-table th {
    background-color: #552fff;
    color: #fff;
    padding: 20px 0;
}
.reserve-table td {
    border-bottom: 1px solid #d1d5db;
    padding: 20px 0;
}
</style>
