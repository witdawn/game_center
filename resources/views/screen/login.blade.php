<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>一起来答题</title>
	<link rel="stylesheet" href="../screen/css/indexPC.css">
</head>
<body>
	<div class="actIndex">
		<div class="indexPC1">
			<img src="./imgs/indexPC1.png" alt="">
		</div>
		<div id="login">  
	        <h1>Login</h1>  
	        <form method="post">  
	            <input type="text" required="required" placeholder="用户名" name="u"></input>  
	            <input type="password" required="required" placeholder="密码" name="p"></input>  
	            <div class="clearfix">
	            	<input type="text" style="width:60%;float:left;" required="required" placeholder="验证码" name="p">
		            <a style="float:left;height: 38px;margin-left: 10px;"><img src="./imgs/captcha.png" alt="" style="height: 38px;border-radius: 3px;"></a>
	            </div>
	            <button class="but" type="submit">登录</button>  
	        </form>  
	    </div>  
	</div>
	<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="../screen/js/screen.js"></script>
</body>
</html>