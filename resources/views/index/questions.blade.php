<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- import CSS -->
    <link rel="stylesheet" href="../css/element_ui_2.3.7_index.css">
</head>
<body>
<h1 style="margin-left: 45%">
    <span>第{{$round}}轮题目列表</span>
</h1>
<div id="app">
    <el-dialog
            title="提示"
            :visible.sync="dialogVisible"
            width="60%">
        <el-form ref="form" :model="form" label-width="80px">
            <el-form-item label="题目名称" style="width:85%;">
                <el-input type="textarea" :row3="3" v-model="form.name"></el-input>
            </el-form-item>
            <el-form-item label="选项" style="width:80%;">
                <el-radio-group v-model="form.item" class="radio-group">
                    <el-radio label="1">
                        <el-input type="textarea" :row3="3" v-model="form.ite"></el-input>
                    </el-radio>
                    <el-radio label="0">
                        <el-input type="textarea" :row3="3" v-model="form.ite"></el-input>
                    </el-radio>
                    <el-radio label="2">
                        <el-input type="textarea" :row3="3" v-model="form.ite"></el-input>
                    </el-radio>
                    <el-radio label="3">
                        <el-input type="textarea" :row3="3" v-model="form.ite"></el-input>
                    </el-radio>
                </el-radio-group>
            </el-form-item>
            <el-form-item label="分值" style="width:85%;">
                <el-input v-model="form.score"></el-input>
            </el-form-item>
            <!--         <el-form-item>
                        <el-button type="primary" @click="submitForm('form')">立即创建</el-button>
                        <el-button>取消</el-button>
                    </el-form-item> -->
        </el-form>
        <span slot="footer" class="dialog-footer">
        <el-button @click="dialogVisible = false">取 消</el-button>
        <el-button type="primary" @click="submitForm('form')">确 定</el-button>
      </span>
    </el-dialog>
    <div style="width:80%;margin:10px auto;">
        <el-button @click="dialogVisible = true" type="primary">添加</el-button>
        <el-button type="primary" onclick="clearall()" >清空</el-button>
        <el-button type="primary"><a href="{{route('winner_list',['r'=>$round])}}">查看获胜名单</a></el-button>
    </div>

    <el-table
            :data="tableData"
            border
            style="width:80%;margin:0 auto;">
        <el-table-column
                prop="display_order"
                label="题号">
        </el-table-column>
        <el-table-column
                prop="title"
                label="题目内容">
        </el-table-column>
        <el-table-column
                prop="answer"
                label="正确答案">
        </el-table-column>
    </el-table>
</div>
</body>
<script src="../js/vue.js"></script>
<script src="../js/element_ui_2.3.7_index.js"></script>
<script src="../js/axios.min.js"></script>
<script>
    var url = '{{route("get_questions")}}';
    var clear_all='{{route("delete_questions")}}';
    var add_url='{{route("add_questions")}}';
    var round = '{{$round}}'

    getQuestions();

    function getQuestions() {
        axios({
            methods: 'get',
            url: url,
            params: {
                qr: round
            }
        }).then(function (res) {
            showData(res.data.data)
        })
    }

    function clearall() {
        axios({
            methods: 'get',
            url: clear_all,
            params: {
                qr: round
            }
        }).then(function (res) {
            alert('操作成功');
            getQuestions();
        })
    }

    function showData(data) {
        new Vue({
            el: '#app',
            data: function () {
                return {
                    dialogVisible: false,
                    form: {
                        title: '',
                        answer: '',
                        display_order: ''
                    },
                    tableData: data
                }
            },
        });
    }

    function addQuestion() {
        axios({
            methods: 'post',
            url: add_url,
            params: {
                qr: round
            }
        }).then(function (res) {
            showData(res.data.data)
        })
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