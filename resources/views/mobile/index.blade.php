<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>开始答题</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,minimum-scale=1.0, maximum-scale=1.0,user-scalable=no">
	<link rel="stylesheet" href="../mobile/css/indexMobile.css?201805040958">
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
				<h2 style="margin:0;color:#E1041B;">游戏规则</h2>
				<div class="invb-cha cha1" style="right:-6%;top:-85%;">
	                <div class="invCha">
	                    <em class="invc1">
						</em><em class="invc2">
						</em>
	                </div>
	            </div>
				<div style="padding:20px 40px;box-sizing: border-box;text-align: left;">
	                <p>参与须知</p>
	                <p>1.郑太大乐透为现场实时网络直播答题。</p>
	                <p>2.每轮10题，每题限时15秒。</p>
	                <p>3.超时或回答错误一次即被淘汰。</p>
	                <p>4.全部答对即可瓜分万元现金大奖。</p>
	                <p>5.答题中请勿刷新或关闭页面，认真听从主持人引导。</p>
	                <p>6.因个人手机或信号问题产生延迟纯属个人问题，与系统无关。</p>
	            </div>	            
				<!-- <span>
					这里是游戏规则
				</span> -->
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