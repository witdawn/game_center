<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>答题赢大奖</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1,minimum-scale=1.0, maximum-scale=1.0,user-scalable=no">
    <link rel="stylesheet" href="../mobile/css/indexMobile.css?201804222345">
</head>
<body>
<div class="actIndex">
    <div class="indexMobile1">
        <a href=""><img style="width:60%;margin:0 auto;" src="../mobile/imgs/logo1.png" alt=""></a>
        <!-- 加载动画 -->
        <div id="loading" class="loading1">
            <span>正在接入,请稍候…</span>
        </div>
        <!-- 答题详情 -->
        <div class="quesMain" style="display:none;" id="questions">
            <div class="quesCir">
                <div class="game_time">
                    <div class="hold">
                    <div class="pie pie1" style="transform: rotate(156.6deg);"></div>
                    </div>
                    <div class="hold">
                    <div class="pie pie2"></div>
                    </div>
                    <div class="bg"> </div>
                    <div class="quesCir1 time" id="left_seccond"></div>
                </div>
            </div>
            <div class="quesCont">
                <p id="question"></p>
            </div>
            <div class="quesItems" id="options">
            </div>
        </div>
        <!-- 耐心等待题目开放 -->
<!--         <div class="waitLoad2" id="wait_question">
            <div class="loading">
                <div class="load">
                    <a><img src="../mobile/imgs/bao1.png" alt=""></a>
                    <p id="wait_title">请耐心等待题目开放……</p>
                </div>
            </div>
        </div> -->
        <!-- 等待下一题开发弹出层 -->
        <div class="waitLoad1" id="wait_question" style="display: none" >
            <div class="loading">
                <div class="load">
                    <div class="loadMain">
                        <img style="width:30%;margin-bottom:20px;" src="../mobile/imgs/waitingIcon.png" alt="">
                        <a>请耐心等待</a>
                        <a>题目即将开放<a>
                    </div>
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
            <a class="nextAnswer">等待进入下一题…</a>
            <!-- <div class="invb-cha cha2" onclick="$('.boxShadow1').hide();">
                <div class="invCha">
                    <em class="invc1"></em><em class="invc2"></em>
                </div>
            </div> -->
        </div>
    </div>
</div>
<!-- 答题错误弹框 -->
<div class="boxShadow boxShadow2" style="display: none">
    <div class="boxBomb">
        <div class="boxBoom">
            <img src="../mobile/imgs/error.png" alt="">
            <h1>很遗憾，答错了</h1>
            <a class="nextGame">期待下一次机会</a>
            <!-- <div class="invb-cha cha3" onclick="$('.boxShadow2').hide();">
                <div class="invCha">
                    <em class="invc1"></em><em class="invc2"></em>
                </div>
            </div> -->
        </div>
    </div>
</div>
<!-- 闯关成功弹框 -->
<div class="boxShadow boxShadow4" style="display: none">
    <div class="boxBomb">
        <div class="boxBoom">
            <img src="../mobile/imgs/bao.png" alt="">
            <h1 style="margin:30px 0;">恭喜你，闯关成功</h1>
            <!-- <a href="" class="nextAnswer">点击结束游戏</a> -->
            <!-- <a class="nextGame" style="border:none;box-shadow:transparent;">期待下一次机会</a> -->
            <!-- <div class="invb-cha cha3" onclick="$('.accountBomb').hide();">
                <div class="invCha">
                    <em class="invc1"></em><em class="invc2"></em>
                </div>
            </div> -->
        </div>
    </div>
</div>
<script>
    var wsServer = 'ws://my.witdawn.com:9501/';
    var connected=false;
    var game_status = 0;
    var left_timer;
    var left_timer1;
    var user_id = "88";
    var active_id = "1";
    {{--var user_id = "{{$user->id}}";--}}
    {{--var active_id = "{{$active->id}}";--}}
    var question_id = 0;


    var i = 0;
    var j = 0;
    var count = 0;
    var MM = 0;
    var SS = 15;  // 秒 90s
    var MS = 0;
    var totle = (MM+1)*600;
    var d = 180*(MM+1);

    var gameTime =15;
    //count down
    var showTime = function(){
        totle = totle - 1;
        if (totle == 0) {
            clearInterval(left_timer);
            clearInterval(left_timer1);
            $(".pie2").css("-o-transform", "rotate(" + d + "deg)");
            $(".pie2").css("-moz-transform", "rotate(" + d + "deg)");
            $(".pie2").css("-webkit-transform", "rotate(" + d + "deg)");
        } else {
            if (totle > 0 && MS > 0) {
                MS = MS - 1;
                if (MS < 10) {
                    MS =MS
                };
            };
            if (MS == 0 && SS > 0) {
                MS = 10;
                SS = SS - 1;
                if (SS < 10) {
                    SS =  SS
                };
            };
            if (SS == 0 && MM > 0) {
                SS = 60;
                MM = MM - 1;
                if (MM < 10) {
                    MM =  MM
                };
            };
        };
        $(".time").html(SS + "s");
    };

    var start1 = function(){
        //i = i + 0.6;
        i = i + 360/((gameTime)*10);  //旋转的角度  90s 为 0.4  60s为0.6
        console.log(i);
        count = count + 1;
        if(count <= (gameTime/2*10)){  // 一半的角度  90s 为 450
            $(".pie1").css("backgroundColor", "#21B5F2");
            $(".pie1").css("-o-transform","rotate(" + i + "deg)");
            $(".pie1").css("-moz-transform","rotate(" + i + "deg)");
            $(".pie1").css("-webkit-transform","rotate(" + i + "deg)");
        }else{
            $(".pie2").css("backgroundColor", "#21B5F2");
            $(".pie2").css("-o-transform","rotate(" + i + "deg)");
            $(".pie2").css("-moz-transform","rotate(" + i + "deg)");
            $(".pie2").css("-webkit-transform","rotate(" + i + "deg)");
        }
    };

    var countDown = function() {
        //80*80px 时间进度条
        i = 0;
        j = 0;
        count = 0;
        MM = 0;
        SS = gameTime;
        MS = 0;
        totle = (MM + 1) * gameTime * 10;
        d = 180 * (MM + 1);
        MM = "0" + MM;
        left_timer = setInterval("showTime()", 100);
        left_timer1 = setInterval("start1()", 100);
    }


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
            $("#loading").hide();
            $("#wait_question").show();
            connected=true;
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
                    clearInterval(left_timer1);
                    $('.boxShadow1').fadeIn(300).delay(3000).fadeOut(300);
                    $("#wait_question").show();
                    $("#questions").hide();
                    // $("#wait_title").html("请耐心等待下一题，请勿刷新或离开页面，否则自动弃权");
                    //显示等待下一题通知 告知勿刷新
                } else if (returnData.type === 4) {
                    //回答错误
                    clearInterval(left_timer);
                    clearInterval(left_timer1);
                    $('.boxShadow2').fadeIn(300);

                } else if (returnData.type === 2) {
                    var options = returnData.options;
                    var title = returnData.title;
                    question_id = returnData.id;

                    $("#wait_question").hide();
                    $("#question").text(title);
                    $("#options").html('');
                    $.each(options, function (i) {
                        $("#options").append("<div class='options' style='cursor: pointer' data-title='" + i + "'>" + options[i] + "</div>");
                    });

                    $("#questions").show();
                    countDown();
                    start1();
                    // var left_time = 10;
                    // left_timer = setInterval(function () {
                    //     console.log(left_time);
                    //     if (left_time > 0) {
                    //         $("#left_seccond").html(left_time);
                    //         left_time--;
                    //     } else {
                    //         sendAnswer(0);
                    //         clearInterval(left_timer);
                    //         $("#questions").hide();
                    //     }
                    // }, 1000);
                } else if (returnData.type === 88) {
                    alert('本轮游戏已经开始，下一轮请抓好机会');
                } else if (returnData.type === 666) {
                    //闯关成功
                    clearInterval(left_timer);
                    clearInterval(left_timer1);
                    game_status = 1;
                    // alert("恭喜你，闯关成功");
                    $('.boxShadow4').fadeIn(300).delay(3000).fadeOut(300);
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

        setTimeout(function(){
            if(!connected){
                window.location.reload()
            }
        },5000);
    };
    //关闭页面时 退出登录
    $(window).unload(function () {
        if (game_status === 0) {
            websocket.send(JSON.stringify({
                action: 'user_logout',
                content: {
                    'active_id': active_id,
                    'user_id': user_id,
                },
            }));
        }

    });
</script>
</body>
</html>