<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>答题赢大奖</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1,minimum-scale=1.0, maximum-scale=1.0,user-scalable=no">
    <link rel="stylesheet" href="../mobile/css/indexMobile.css">
</head>
<body>
<div class="actIndex1">
    <div class="indexMobile1">
        <a href=""><img src="../mobile/imgs/logo.png" alt=""></a>
        <!-- 加载动画 -->
        <div id="loading" class="loading1">
            <span>正在接入,请稍候…</span>
        </div>
        <!-- 答题详情 -->
        <div class="quesMain" style="display:none;" id="questions">
            <div class="quesCir">
                <div class="quesCir1" id="left_seccond"></div>
            </div>
            <div class="quesCont">
                <p id="question"></p>
            </div>
            <div class="quesItems" id="options">
            </div>
        </div>
        <!-- 耐心等待题目开放 -->
        <div class="waitLoad2" id="wait_question">
            <div class="loading">
                <div class="load">
                    <a><img src="../mobile/imgs/bao1.png" alt=""></a>
                    <p id="wait_title">请耐心等待题目开放……</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="../mobile/js/mobile.js"></script>

<!-- 答题正确弹框 -->
<div class="boxShadow boxShadow1" style="display: none">
    <div class="boxBomb">
        <div class="boxBoom">
            <img src="../mobile/imgs/right.png" alt="">
            <h1>恭喜您，答对了！</h1>
            <div class="invb-cha cha2" onclick="$('.boxShadow1').hide();">
                <div class="invCha">
                    <em class="invc1"></em><em class="invc2"></em>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 答题错误弹框 -->
<div class="boxShadow boxShadow2" style="display: none">
    <div class="boxBomb">
        <div class="boxBoom">
            <img src="../mobile/imgs/error.png" alt="">
            <h1>很遗憾，答错了~_~</h1>
            <a href="" class="nextAnswer">点击结束游戏</a>
            <div class="invb-cha cha3" onclick="$('.boxShadow2').hide();">
                <div class="invCha">
                    <em class="invc1"></em><em class="invc2"></em>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var wsServer = 'ws://my.witdawn.com:9501/';

            {{--var user_id = "{{$user->id}}";--}}
            {{--var active_id = "{{$active->id}}";--}}
    var user_id = 45;
    var active_id = 1;
    var question_id = 0;

    var websocket = new WebSocket(wsServer);
    window.onload = function () {
        var left_timer;
        websocket.onopen = function (evt) {
            websocket.send(JSON.stringify({
                action: 'user_login',
                content: {
                    'active_id': active_id,
                    'user_id': user_id,
                }
            }));
            $("#loading").hide();
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
                if (returnData.type === 3) {
                    //回答正确
                    clearInterval(left_timer);
                    $('.boxShadow1').show();
                    $("#wait_question").show();
                    $("#questions").hide();
                    $("#wait_title").html("请耐心等待下一题，请勿刷新或离开页面，否则自动弃权");
                    //显示等待下一题通知 告知勿刷新
                } else if (returnData.type === 4) {
                    //回答错误
                    clearInterval(left_timer);
                    $('.boxShadow2').show();

                } else if (returnData.type === 2) {
                    var options = returnData.options;
                    var title = returnData.title;
                    question_id = returnData.id;

                    $("#wait_question").hide();
                    $("#question").text(title);
                    $("#options").html('');
                    $.each(options, function (i) {
                        $("#options").append("<div class='options' data-title='" + i + "'>" + options[i] + "</div>");
                    });

                    $("#questions").show();
                    var left_time = 10;
                    left_timer = setInterval(function () {
                        console.log(left_time);
                        if (left_time > 0) {
                            $("#left_seccond").html(left_time);
                            left_time--;
                        } else {
                            sendAnswer(0);
                            clearInterval(left_timer);
                            $("#questions").hide();
                        }
                    }, 1000);
                } else if (returnData.type === 88) {
                    alert('本轮游戏已经开始，下一轮请抓好机会');
                } else if (returnData.type === 666) {
                    //闯关成功
                    clearInterval(left_timer);
                    alert("恭喜你，闯关成功");
                }

            }
        };

        websocket.onerror = function (evt, e) {
            console.log('Error occured:');
        };

        $(document).on('click', '.options', function () {
            var answer = parseInt($(this).data('title')) + 1;
            //关闭倒计时
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
    //关闭页面时 退出登录
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