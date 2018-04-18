<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>一起来答题</title>
	<link rel="stylesheet" href="screen/css/indexPC.css">
</head>
<body>
	<div class="actIndex">
		<div class="indexPC1">
			<img src="screen/imgs/indexPC1.png" alt="">
		</div>
		<div class="indexPC2">
			<div class="acMain acl">
				<img src="screen/imgs/indexPC2.png" alt="">
			</div>
			<dvi class="actMain acm">
				<div class="acmd">
					<img src="screen/imgs/codePC.png" alt="">
					<a style="display:block;margin:30px auto;cursor:pointer;" class="beginAnswer rules">游戏规则</a>
					<a style="display:block;margin:30px auto;cursor:pointer;" class="beginAnswer">开始答题</a>
				</div>
			</dvi>
			<div class="acMain acr">
				<img src="screen/imgs/indexPC3.png" alt="">
			</div>
		</div>
	</div>
	<!-- 游戏规则弹框 -->
	<div class="boxShadow boxShadow3">
		<div class="boxBomb">
			<div class="boxBoom">
				<h2 style="margin:0;">游戏规则</h2>
				<div class="invb-cha cha1" onclick="$('.accountBomb').hide();">
	                <div class="invCha">
	                    <em class="invc1"></em><em class="invc2"></em>
	                </div>
	            </div>
			</div>
		</div>
	</div>
	<script src="screen/js/jquery.js"></script>
	<script>
	    $(function(){
	    	$('.boxShadow3').hide();
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