<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- import CSS -->
    <link rel="stylesheet" href="../css/element_ui_2.3.7_index.css">
</head>
<body>
<div id="app">
    <el-dialog
            title="提示"
            :visible.sync="dialogVisible"
            width="60%">
        <el-form ref="form" :model="form" label-width="80px">
            <el-form-item label="活动名称" style="width:85%;">
                <el-input type="textarea" :row3="3" v-model="form.title"></el-input>
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
    </div>
    <el-table
            :data="tableData"
            border
            style="width:80%;margin:0 auto;">
        <el-table-column
                prop="title"
                label="活动名称">
        </el-table-column>
        <el-table-column
                prop="max_question_round"
                label="活动轮数">
        </el-table-column>
        <el-table-column
                prop="max_question_count"
                label="每轮题目数">
        </el-table-column>
        <el-table-column
                prop="start_at"
                label="开始时间">
        </el-table-column>
        <el-table-column
                prop="end_at"
                label="过期时间">
        </el-table-column>
        <el-table-column
                label="操作">
            <template scope="scope">
                <el-button type="primary">删除</el-button>
            </template>
        </el-table-column>
    </el-table>
</div>
</body>
<!-- import Vue before Element -->
<script src="../js/vue.js"></script>
<!-- import JavaScript -->
<script src="../js/element_ui_2.3.7_index.js"></script>
<script src="../js/axios.min.js"></script>
<script>
    var url='{{route("get_activities")}}';

    function getActivities(){
        axios({
            methods:'get',
            url:url,
        }).then(function(res){
            showData(res.data.data)
        })
    }
    function showData(data) {
        new Vue({
            el: '#app',
            data: function() {
                return {
                    dialogVisible: false,
                    form: {
                        title:'',
                        start_at:'',
                        end_at:'',
                        max_question_round:'',
                        max_question_count:''

                    },
                    tableData: data
                }
            },
        });
    }
    getActivities();

</script>
<style>
    body{
        margin:0;
        padding:0;
    }
    .radio-group label{
        width:100%;
        margin:10px 0;
    }
    .el-radio+.el-radio {
        margin-left: 0px;
    }
</style>
</html>