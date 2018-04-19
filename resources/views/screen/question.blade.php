<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>答题详情</title>
	<link rel="stylesheet" href="css/indexPC.css">
</head>
<body>
	<div class="actIndex">
		<div class="acHead">
			<p class="preMain">
				目前剩余人数：<span id="left_number"></span>人
			</p>
			<div class="finalPeople">
				<a id="round_number">第{{$active->question_round}}轮</a>
			</div>
		</div>
		<div class="quesMain clearfix">
			<h1 class="qmt">选择题</h1>
			<p class='qmturn' id="process">1/12</p>
			<div class="quesCont" id="question">
			</div>
			<div class="quesItems" id="options">
			</div>
			<div class="nextQues">
				<a id="show_answer">公布答案</a>
				<a id="next_question">进入下一题</a>
			</div>
		</div>
	</div>
	<script src="js/jquery.js"></script>
	<script>
        var active_id = "{{$active->id}}";
        var question_num = "{{$active->question_index}}";
        var question_round = "{{$active->question_round}}";
        var answer=0;
        $("#round_number").html("第"+question_round+"轮");
        $("#process").text(question_num+"/12");

        var wsServer = 'ws://my.witdawn.com:9501/';
        var websocket = new WebSocket(wsServer);
        function get_question() {
            websocket.send(JSON.stringify({
                action: 'send_question',
                content: {
                    'active_id': active_id,
                    'round_num': question_round,
                    'num': question_num,
                }
            }));
        }
        window.onload = function () {
            websocket.onopen = function (evt) {
                websocket.send(JSON.stringify({
                    action: 'admin_login',
                    content: {
                        'active_id': active_id,
                        'round_num': question_round,
                    }
                }));
                get_question();

            };

            websocket.onclose = function (evt) {
                console.log('失去连接');
            };

            websocket.onmessage = function (evt) {
                if (evt.data) {
                    var returnData=$.parseJSON(evt.data);
                    var res=returnData.data;
                    console.log(res);
                    if(res.type===1){
                        $("#left_number").text(res.count);
                    }else if(res.type===2){
                        var options=res.options;
                        var title=res.title;
                        answer=res.answer;
						$("#question").text(title);
						$("#options").html('');
                        $("#process").text(question_num+"/12");
                        $.each(options,function(i){
                            $("#options").append("<div class='options'>" + options[i] + "</div>");
                        });
                        question_num=parseInt(res.display_order)+1;
                        if(question_num>12){
                            $("#next_question").html('查看光荣榜');
						}
                    }

                }
            };
            websocket.onerror = function (evt, e) {
                console.log('Error occured: ' + evt.data);
            };
        };

        $("#next_question").click(function () {
            if(question_num>12){
                window.location.href="{{route('winners')}}";
			}else{
                get_question();
            }
        });
        $("#show_answer").click(function(){
            if(answer>0){
                $(".options").eq(answer-1).addClass('quesRight');
            }
		})

	</script>
</body>
</html>