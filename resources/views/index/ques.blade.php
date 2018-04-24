<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <!-- import CSS -->
  <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
</head>
<body>
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
    </div>
  	<el-table
      :data="tableData"
      border
      style="width:80%;margin:0 auto;">
      <el-table-column
        prop="id"
        label="题号">
      </el-table-column>
      <el-table-column
        prop="content"
        label="题目内容">
      </el-table-column>
      <el-table-column
        prop="right_key"
        label="正确答案">
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
  <script src="https://unpkg.com/vue/dist/vue.js"></script>
  <!-- import JavaScript -->
  <script src="https://unpkg.com/element-ui/lib/index.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script>
    new Vue({
      el: '#app',
      data: function() {
        return {
          dialogVisible: false,
        	form: {
	            name:'',
	            item:'',
	            ite:'',
	            score:''

	        },
	        tableData: [{
            id: '1',
            content: '1+1=？',
            right_key: '2'
          }, {
            id: '2',
            content: '1+1=？',
            right_key: '2'
          }, {
            id: '3',
            content: '1+1=？',
            right_key: '2'
          }, {
            id: '4',
            content: '1+1=？',
            right_key: '2'
          }]
        }
      },
      methods:{
      	submitForm(formName) {
	        this.$refs[formName].validate((valid) => {
	          if (valid) {
	            axios({
                methods:'',
                url:'',
                params:this.form
              }).then(function(res){
                if(res.code == 200){


                }else{
                  alert(res.msg)
                }
              })
	          } else {
	            console.log('error submit!!');
	            return false;
	          }
	        });
	      }
      }
    })
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