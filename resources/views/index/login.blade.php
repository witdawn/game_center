<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登录</title>
    <link rel="stylesheet" href="../screen/css/indexPC.css">
</head>
<body>
<div class="actIndex">
    <div id="login">
        <h1>Login</h1>
        <form method="post" id="login_form">
            <input type="text" required="required" placeholder="用户名" name="username"/>
            <input type="password" required="required" placeholder="密码" name="password"/>
            <div class="clearfix">
                <input type="text" style="width:60%;float:left;" required="required" placeholder="验证码" name="captcha">
                <a style="float:left;height: 38px;margin-left: 10px;"><img src="{{route('captcha')}}" alt="" style="height: 38px;border-radius: 3px;" onclick=(this.src="{{route('captcha')}}?"+Math.random())></a>
            </div>
            <button class="but" id="login_btn" type="button">登录</button>
        </form>
    </div>
</div>
<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="../screen/js/screen.js"></script>
<script>
    $("#login_btn").click(function () {
        var url = "{{route('login')}}";
        $.ajax({
            url: url,
            type: 'post',
            data: $("#login_form").serialize(),
            success: function (returnData) {
                if(returnData.code===200){
                    window.location.href="{{route('index')}}";
                }else {
                    alert(returnData.msg);
                }
            }
        });
    })
</script>
</body>
</html>