<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>答题详情</title>
    <link rel="stylesheet" href="../screen/css/indexPC.css">
</head>
<body>
<div class="actIndex">
    <div class="acHead">
        <p class="preMain">
            目前人数：<span id="left_number">0</span>人
        </p>
        <div class="finalPeople">
            <a id="round_number">第{{$active->question_round}}轮</a>
        </div>
    </div>
    <div class="quesMain1 clearfix">
        <img src="./imgs/codePC.png" alt="">
        <a style="display:block;margin:30px auto;cursor:pointer;" class="beginAnswer" id="begin_game">开始答题</a>
    </div>
    <div class="quesMain clearfix" style="display: none">
        <p class='qmturn' id="process" style="display: none"></p>
        <div class="quesCont" id="question">
        </div>
        <div class="quesItems" id="options">
        </div>
        <div class="nextQues">
            <a id="show_answer">公布答案</a>
            <a id="next_question">下一题</a>
        </div>
    </div>
</div>
<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="../screen/js/screen.js"></script>
<script>
    var active_id = "{{$active->id}}";
    var question_num = "{{$active->question_index}}";
    var question_round = "{{$active->question_round}}";
    var answer = 0;
    $("#round_number").html("第" + question_round + "轮");

    var wsServer = 'ws://my.witdawn.com:9501/';
    var websocket = new WebSocket(wsServer);
    window.onload = function () {
        websocket.onopen = function (evt) {
            websocket.send(JSON.stringify({
                action: 'admin_login',
                content: {
                    'active_id': active_id,
                    'round_num': question_round,
                }
            }));
            if (question_num != 1) {
                $("#show_answer").show();
                get_question();
            }
        };

        websocket.onclose = function (evt) {
            console.log('失去连接');
        };

        websocket.onmessage = function (evt) {
            if (evt.data) {
                var returnData = $.parseJSON(evt.data).data;
                if (returnData.type === 1) {
                    $("#left_number").text(returnData.count);
                } else if (returnData.type === 2) {
                    var options = returnData.options;
                    var title = returnData.title;
                    answer = returnData.answer;
                    $("#question").text(title);
                    $("#options").html('');
                    $("#process").text(question_num + "/12");
                    $.each(options, function (i) {
                        $("#options").append("<div class='options'>" + options[i] + "</div>");
                    });
                    question_num = parseInt(returnData.display_order) + 1;
                    if (question_num > 12) {
                        $("#next_question").html('查看光荣榜');
                    }
                }

            }
        };
        websocket.onerror = function (evt, e) {
            console.log('Error occured: ' + evt.data);
        };

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

        $('.beginAnswer').click(function () {
            $('.quesMain1').hide();
            $('.quesMain').show();
            get_question();
        })

        $("#next_question").click(function () {
            if (question_num > 12) {
                window.location.href = "{{route('winners')}}";
            } else {
                get_question();
            }
        });

        $("#show_answer").click(function () {
            if (answer > 0) {
                $(".options").eq(answer - 1).addClass('quesRight');
            }
        })
    };
</script>
</body>
</html>