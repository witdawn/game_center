<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- import CSS -->
    <link rel="stylesheet" href="../css/element_ui_2.3.7_index.css">
</head>
<body>
<div id="app">
    <h1 style="margin-left: 45%">
        <span>第{{$round}}轮获奖名单</span>
    </h1>
    <div style="width:80%;margin:10px auto;">
        <el-button type="primary" onclick="javascript :history.back(-1)">返回</el-button>
    </div>
    <el-table
            :data="tableData"
            border
            style="width:80%;margin:0 auto;">
        <el-table-column
                prop="nickname"
                label="姓名">
        </el-table-column>
        <el-table-column
                prop="phone"
                label="电话">
        </el-table-column>
    </el-table>
</div>
</body>
<script src="../js/vue.js"></script>
<script src="../js/element_ui_2.3.7_index.js"></script>
<script src="../js/axios.min.js"></script>
<script>
    var url = '{{route("get_winners")}}';
    var round = '{{$round}}'

    getQuestions();

    function getQuestions() {
        axios({
            methods: 'get',
            url: url,
            params: {
                round_number: round
            }
        }).then(function (res) {
            showData(res.data.data)
        })
    }

    function showData(data) {
        new Vue({
            el: '#app',
            data: function () {
                return {
                    dialogVisible: false,
                    form: {
                        nickname: '',
                        phone: '',
                    },
                    tableData: data
                }
            },
        });
    }

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