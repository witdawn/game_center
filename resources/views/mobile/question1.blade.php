<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>答题详情</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1,minimum-scale=1.0, maximum-scale=1.0,user-scalable=no">
    <link rel="stylesheet" href="../mobile/css/indexMobile.css">
</head>
<body>
<div class="actIndex1">
    <div class="indexMobile1">
        <a href=""><img src="../mobile/imgs/logo.png" alt=""></a>
        <div class="quesMain">
            <div class="quesCir">
                <div class="quesCir1">1</div>
            </div>
            <div class="quesCont">
                <p id="question"></p>
            </div>
            <div class="quesItems" id="options">
            </div>
        </div>
    </div>
</div>
<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>

<!-- 答题正确弹框 -->
<div class="boxShadow boxShadow1" style="display: none">
    <div class="boxBomb">
        <div class="boxBoom">
            <img src="../mobile/imgs/right.png" alt="">
            <h1>恭喜您，答对了！</h1>
            <div class="invb-cha cha2" onclick="$('.accountBomb').hide();">
                <div class="invCha">
                    <em class="invc1"></em><em class="invc2"></em>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 答题错误弹框 -->
<div class="boxShadow boxShadow2"  style="display: none">
    <div class="boxBomb">
        <div class="boxBoom">
            <img src="../mobile/imgs/error.png" alt="">
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
    var wsServer = 'ws://my.witdawn.com:9501/';

    var user_id = "{{$user->id}}";
    var active_id = "{{$active->id}}";
    var question_id = 0;

    var websocket = new WebSocket(wsServer);
    window.onload = function () {
        websocket.onopen = function (evt) {
            websocket.send(JSON.stringify({
                action: 'user_login',
                content: {
                    'active_id': active_id,
                    'user_id': user_id,
                }
            }));
            console.log('connected')
        };

        websocket.onclose = function (evt) {
            websocket.send(JSON.stringify({
                action: 'user_logout',
                content: {
                    'active_id': active_id,
                    'user_id': user_id,
                },
            }));
        };

        websocket.onmessage = function (evt) {
            if (evt.data) {
                var returnData = $.parseJSON(evt.data).data;
                console.log(returnData);
                if (returnData.type === 3) {
                    //回答正确
                    alert('回答正确');
                } else if (returnData.type === 4) {
                    //回答错误
                    alert('错误');
                } else if (returnData.type === 2) {
                    var options = returnData.options;
                    var title = returnData.title;
                    question_id = returnData.id;
                    $("#question").text(title);
                    $("#options").html('');
                    $.each(options, function (i) {
                        $("#options").append("<div class='options' data-title='" + i + "'>" + options[i] + "</div>");
                    });
                }

            }
        };

        websocket.onerror = function (evt, e) {
            console.log('Error occured:');
        };

        $(document).on('click', '.options', function () {
            var answer = parseInt($(this).data('title')) + 1;
//            alert(answer);
            sendAnswer(answer);
        });

        function sendAnswer(answer) {
            websocket.send(JSON.stringify({
                action: 'user_answer',
                content: {
                    'active_id': active_id,
                    'user_id': user_id,
                    'question_id': question_id,
                    'answer': answer,
                },
            }));
        }
    };

    $(window).unload(function () {
        websocket.send(JSON.stringify({
            action: 'user_logout',
            content: {
                'active_id': active_id,
                'user_id': user_id,
            },
        }));
    });
</script>
</body>
</html>