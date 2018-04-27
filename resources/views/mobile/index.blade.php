<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>开始答题</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,minimum-scale=1.0, maximum-scale=1.0,user-scalable=no">
	<link rel="stylesheet" href="../mobile/css/indexMobile.css?201804222345">
</head>
<body>
	<div class="actIndex actIndex1">
		<div class="indexMobile1">
			<a href=""><img style="width:60%;margin:0 auto;" src="../mobile/imgs/logo1.png" alt=""></a>
			<a class="mainImg"><img style="width:100%;" src="../mobile/imgs/letou2.png" alt=""></a>
			<div class="acBtn">
				<a class="acStart rules" style="margin-bottom:20px; cursor: pointer">游戏规则</a>
				<a class="acStart" href="{{route('mobile_question')}}">开始游戏</a>
			</div>
		</div>
	</div>
	<!-- 游戏规则弹框 -->
	<div class="boxShadow boxShadow3">
		<div class="boxBomb">
			<div class="boxBoom">
				<h2 style="margin:0;">游戏规则</h2>
				<div class="invb-cha cha1">
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
	<script>
	    $(function(){
	    	// $('.boxShadow3').hide();
	    	$('.rules').click(function(){
	    		$('.boxShadow3').show();
	    	})

	    	$('.cha1').click(function(){
	    		$('.boxShadow3').hide();
	    	})


	    })
	</script>
</body>
</html>