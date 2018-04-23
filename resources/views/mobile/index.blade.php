<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>开始答题</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,minimum-scale=1.0, maximum-scale=1.0,user-scalable=no">
	<link rel="stylesheet" href="../mobile/css/indexMobile.css?201804222345">
</head>
<body>
	<div class="actIndex">
		<div class="indexMobile1">
			<a href=""><img style="width:60%;margin:0 auto;" src="../mobile/imgs/logo.png" alt=""></a>
			<a style="margin-top:40px;" href=""><img style="width:100%;" src="../mobile/imgs/letou1.png" alt=""></a>
			<a class="acStart rules" style="margin-top:80px;margin-bottom:20px;">游戏规则</a>
			<a class="acStart" href="{{route('mobile_question')}}">开始游戏</a>
		</div>
	</div>
	<!-- 游戏规则弹框 -->
	<div class="boxShadow boxShadow3">
		<div class="boxBomb">
			<div class="boxBoom">
				<h2 style="margin:0;">游戏规则</h2>
				<div class="invb-cha cha1" onclick="$('.accountBomb').hide();">
	                <div class="invCha">
	                    <em class="invc1">
						</em><em class="invc2">
						</em>
	                </div>
	            </div>
				<span>
					这里是游戏规则
				</span>
			</div>
		</div>
	</div>
	<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="../mobile/js/mobile.js"></script>
	<script>
	    $(function(){
	    	// $('.boxShadow3').hide();
	    	$('.rules').click(function(){
	    		$('.boxShadow3').show();
	    	})
	    	$('.invb-cha').click(function(){
	    		$('.boxShadow3').hide();
	    	})
	    })
	</script>
</body>
</html>