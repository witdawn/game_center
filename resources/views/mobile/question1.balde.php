<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>答题详情</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,minimum-scale=1.0, maximum-scale=1.0,user-scalable=no">
	<link rel="stylesheet" href="mobile/css/indexMobile.css">
</head>
<body>
	<div class="actIndex1">
		<div class="indexMobile1">
			<a href=""><img src="mobile/imgs/logo.png" alt=""></a>
			<div class="quesMain">
				<div class="quesCir">
					<div class="quesCir1">1</div>
				</div>
				<div class="quesCont">
					<p>1.三个人，竖着站成一排。有五个帽子，三个蓝色，两个红色，每人带一个，各自不准看自己的颜色。然后问第一个人带的什么颜色的帽子，他说不知道，然后又问第二个人带的什么颜色的帽子，同样说不知道，又问第三个人带的是什么颜色的帽子，他说我知道。问第三个人带的是什么色帽子? （第一个人站在排的最后,他可以看见前二个人的帽子的颜色)</p>
				</div>
				<div class="quesItems">
					<div>A.蓝色</div>
					<div class="quesRight">B.红色</div>
					<div>C.黄色</div>
					<div>D.紫色</div>
				</div>
				<div class="nextQues">
					<a href="">公布答案</a>
					<a href="">进入下一题</a>
				</div>
			</div>
		</div>
	</div>
	<script src="mobile/jquery.js"></script>
	<!-- 答题正确弹框 -->
	<div class="boxShadow boxShadow1">
		<div class="boxBomb">
			<div class="boxBoom">
				<img src="mobile/imgs/right.png" alt="">
				<h1>恭喜您，答对了！</h1>
				<a href="" class="nextAnswer">点击进入下一题</a>
				<div class="invb-cha cha2" onclick="$('.accountBomb').hide();">
	                <div class="invCha">
	                    <em class="invc1"></em><em class="invc2"></em>
	                </div>
	            </div>
			</div>
		</div>
	</div>
	<!-- 答题错误弹框 -->
	<div class="boxShadow boxShadow2">
		<div class="boxBomb">
			<div class="boxBoom">
				<img src="mobile/imgs/error.png" alt="">
				<h1>很遗憾，答错了~_~</h1>
				<a href="" class="nextAnswer">点击结束游戏</a>
				<div class="invb-cha cha3" onclick="$('.accountBomb').hide();">
	                <div class="invCha">
	                    <em class="invc1"></em><em class="invc2"></em>
	                </div>
	            </div>
			</div>
		</div>
	</div>
	<script>
	    $(function(){
	    	$('.boxShadow1').hide();
	    	$('.boxShadow2').hide();
	    	$('.cha2').click(function(){
	    		$('.boxShadow1').hide();
	    	})
	    	$('.cha3').click(function(){
	    		$('.boxShadow2').hide();
	    	})

	    })
	</script>
</body>
</html>