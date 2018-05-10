<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- import CSS -->
    <link rel="stylesheet" href="../css/element_ui_2.3.7_index.css">
</head>
<body>
<div id="app">
    <el-table
            :data="tableData"
            border
            style="width:80%;margin:0 auto;">
        <el-table-column
                prop="round"
                label="轮数">
        </el-table-column>
        <el-table-column
                label="操作">
            <template scope="scope">
                <el-button type="primary" onclick="javascript :history.back(-1)">返回</el-button>
                <el-button @click="setting(scope.row)" type="primary">设置</el-button>
                <el-button type="primary" @click="winners(scope.row)">查看获奖名单</el-button>
            </template>
        </el-table-column>
    </el-table>
</div>
</body>
<script src="../js/vue.js"></script>
<script src="../js/element_ui_2.3.7_index.js"></script>
<script src="../js/axios.min.js"></script>
<script>
    new Vue({
        el: '#app',
        data: function () {
            return {
                dialogVisible: false,
                tableData: []
            }
        },
        methods: {
            showdata: function () {
                var _this = this;
                var max = parseInt('{{$max_round}}');
                var rounds = [];
                for (var i = 0; i < max; i++) {
                    rounds[i]={
                        round: i + 1
                    } ;
                }
                _this.tableData=rounds;
            },
            setting: function (row) {
                console.info(row);
                window.location.href="{{route('questions_manager')}}?r="+row.round
            },
            winners: function (row) {
                window.location.href="{{route('winner_list')}}?r="+row.round
            },
        },
        created() {
            this.showdata();
        }
    });
</script>
<style>
    body {
        margin: 0;
        padding: 0;
    }

    .radio-group label {
        width: 100%;
        margin: 10px 0;
    }

    .el-radio + .el-radio {
        margin-left: 0px;
    }
</style>
</html>