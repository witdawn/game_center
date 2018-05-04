<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>一起来答题</title>
    <link rel="stylesheet" href="../screen/css/indexPC.css?201805040958">
</head>
<body>
<div class="actIndex">
    <div class="indexPC2">
        <div class="ip">
            <div class="acMain acl" style="margin-left:">
                <img src="./imgs/indexPC21.png" alt="">
            </div>
            <dvi class="actMain acm" style="flex-grow: 6;">
                <div class="acmd">
                    <a style="display:block;margin:30px auto;cursor:pointer;" class="beginAnswer rules">游戏规则</a>
                    <a id="start_game" style="display:block;margin:30px auto;cursor:pointer;"
                       class="beginAnswer">开始答题</a>
                </div>
            </dvi>
            <div class="acMain acr">
                <img src="./imgs/indexPC31.png" alt="">
            </div>
        </div>
    </div>
</div>
<!-- 游戏规则弹框 -->
<div class="boxShadow boxShadow3">
    <div class="boxBomb">
        <div class="boxBoom">
            <h2 style="margin:0;color:#E10A21;">游戏规则</h2>
            <div class="invb-cha cha1" onclick="$('.accountBomb').hide();">
                <div class="invCha">
                    <em class="invc1"></em><em class="invc2"></em>
                </div>
            </div>
            <div style="padding:20px 50px;box-sizing: border-box;text-align: left;">
                <p>参与须知</p>
                <p>1.郑太大乐透为现场实时网络直播答题。</p>
                <p>2.每轮10题，每题限时15秒。</p>
                <p>3.超时或回答错误一次即被淘汰。</p>
                <p>4.全部答对即可瓜分万元现金大奖。</p>
                <p>5.答题中请勿刷新或关闭页面，认真听从主持人引导。</p>
                <p>6.因个人手机或信号问题产生延迟纯属个人问题，与系统无关。</p>
            </div>
           <!--  <span>
                这里是游戏规则
            </span> -->
        </div>
    </div>
</div>
<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="../screen/js/screen.js"></script>
<script>
    $(function () {
        var h = document.documentElement.clientHeight || document.body.clientHeight;
        var h1 = $('.indexPC1').height();
        $('.indexPC2').height(h - h1);
        $('.boxShadow3').hide();
        $('.rules').click(function () {
            $('.boxShadow3').show();
        })
        $('.cha1').click(function () {
            $('.boxShadow3').hide();
        })
        $("#round_num").val({{$active->question_round}})
        $("#start_game").click(function () {
            // var round_num = $("#round_num").val();
            var round_num = 0;
            var url = "{{route('change_round')}}";
            $.ajax({
                url: url,
                type: 'post',
                data: {
                    'round_num': round_num,
                },
                success: function (returnData) {
                    if (returnData.code === 200) {
                        window.location.href = "{{route('screen_question')}}";
                    }
                }
            });
        });

        function keydown(e) {
            var e = e || event;
            var currKey = e.keyCode || e.which || e.charCode;
            if ((currKey > 7 && currKey < 14) || (currKey > 31 && currKey < 47)) {
                switch (currKey) {
                    case 37:        //左
                        $('.cha1').click();
                        break;
                    case 38:        //上
                        $('.rules').click();
                        break;
                    case 40:        //下
                        $("#start_game").click();
                        break;
                    default:

                        break;
                }
            }
        }

        document.onkeydown = keydown;
    })
</script>
</body>
</html>