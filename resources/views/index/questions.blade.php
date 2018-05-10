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
                <el-input type="textarea" :row3="3" v-model="form.title"></el-input>
            </el-form-item>
            <el-form-item label="选项" style="width:80%;">
                <el-radio-group v-model="form.answer" class="radio-group">
                    <el-radio label="1">
                        A: <el-input type="textarea" :row3="3" v-model="form.options[0]"></el-input>
                    </el-radio>
                    <el-radio label="2">
                        B: <el-input type="textarea" :row3="3" v-model="form.options[1]"></el-input>
                    </el-radio>
                    <el-radio label="3">
                        C: <el-input type="textarea" :row3="3" v-model="form.options[2]"></el-input>
                    </el-radio>
                    <el-radio label="4">
                        D: <el-input type="textarea" :row3="3" v-model="form.options[3]"></el-input>
                    </el-radio>
                </el-radio-group>
            </el-form-item>
            <el-form-item label="题号" style="width:85%;">
                <el-input v-model="form.display_order"></el-input>
            </el-form-item>
            <el-form-item label="分值" style="width:85%;">
                <el-input v-model="form.score"></el-input>
            </el-form-item>

            <el-form-item label="轮数" style="width:85%;">
                <el-input v-model="form.round_number"></el-input>
            </el-form-item>
            <!--         <el-form-item>
                        <el-button type="primary" @click="submitForm('form')">立即创建</el-button>
                        <el-button>取消</el-button>
                    </el-form-item> -->
        </el-form>
        <span slot="footer" class="dialog-footer">
        <el-button @click="closeDialog">取 消</el-button>
        <el-button type="primary" @click="addQuestion">确 定</el-button>
      </span>
    </el-dialog>
    <div style="width:80%;margin:10px auto;">
        <el-button @click="showDialog" type="primary">添加</el-button>
        <el-button type="primary" @click="clearall">清空</el-button>
        <span style="margin-left: 70%">
            <el-button type="primary" onclick="javascript :history.back(-1)">返回</el-button>
        </span>

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
        <el-table-column
                label="操作">
            <template scope="scope">
                <el-button @click="editQuestion(scope.$index,scope.row)" type="primary">编辑</el-button>
                <el-button type="primary" @click="deleteQuestion(scope.$index,scope.row)">删除</el-button>
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
                form: {
                    title: '',
                    answer: '',
                    display_order: '',
                    round_number: '{{$round}}',
                    options: [],
                },
                tableData: []
            }
        },
        methods: {
            getQuestions: function () {
                var _self = this;
                axios({
                    methods: 'get',
                    url: '{{route("get_questions")}}',
                    params: {
                        round_number: '{{$round}}'
                    }
                }).then(function (res) {
                    _self.tableData = res.data.data;
                })
            },
            clearall: function () {
                var _this = this;
                axios({
                    methods: 'get',
                    url: '{{route("cleanup_questions")}}',
                    params: {
                        round_number: '{{$round}}'
                    }
                }).then(function (res) {
                    _this.tableData = [];
                })
            },
            addQuestion: function () {
                var _this = this;
                axios.post('{{route("add_question")}}', _this.form).then(function (res) {
                    _this.tableData = res.data.data;
                    _this.closeDialog();
                })
            },

            deleteQuestion: function (index, row) {
                var _this = this;
                axios.post('{{route("delete_question")}}', {
                    id:row.id
                }).then(function (res) {
                    _this.tableData = res.data.data;
                })
            },
            editQuestion: function (index, row) {
                var _this = this;
                _this.dialogVisible = true;
                _this.form = row;
            },
            closeDialog: function () {
                var _this = this;
                _this.dialogVisible = false;
                _this.form = {
                    title: '',
                    answer: '',
                    display_order: '',
                    round_number: '{{$round}}',
                    options: [],
                }
            },
            showDialog: function () {
                var _this = this;
                _this.dialogVisible = true;
                _this.form = {
                    title: '',
                    answer: '',
                    display_order: '',
                    round_number: '{{$round}}',
                    options: [],
                }
            },

        },
        created() {
            this.getQuestions();
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