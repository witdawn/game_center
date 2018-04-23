<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>一起来答题</title>
    <link rel="stylesheet" href="../screen/css/indexPC.css?201804222309">
</head>
<body>
<div class="actIndex">
        <div class="indexPC1">
            <img src="./imgs/indexPC1.png" alt="">
        </div>
        <div class="indexPC2">
            <div class="ip">
                <div class="acMain acl">
                    <img src="./imgs/indexPC2.png" alt="">
                </div>
                <dvi class="actMain acm" style="flex-grow: 2;">
                    <div class="acmd">
                        <a style="display:block;margin:30px auto;cursor:pointer;" class="beginAnswer rules">游戏规则</a>
                        <select id="round_num" class="selectNum">
                            <option value="1">第一轮</option>
                            <option value="2">第二轮</option>
                            <option value="3">第三轮</option>
                        </select>
                        <a id="start_game" style="display:block;margin:30px auto;cursor:pointer;" class="beginAnswer">开始答题</a>
                    </div>
                </dvi>
                <div class="acMain acr">
                    <img src="./imgs/indexPC3.png" alt="">
                </div>
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
            <span>
                这里是游戏规则
            </span>
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
        $('.rules').click(function(){
            $('.boxShadow3').show();
        })
        $('.invb-cha').click(function(){
            $('.boxShadow3').hide();
        })
            
        $("#round_num").val({{$active->question_round}})
        $("#start_game").click(function () {
            var round_num = $("#round_num").val();
            var url = "{{route('change_round')}}";
            $.ajax({
                url: url,
                type: 'post',
                data: {
                    'round_num': round_num,
                },
                success: function (returnData) {
                    if(returnData.code===200){
                        window.location.href="{{route('screen_question')}}";
                    }
                }
            });
        })
    })
</script>
</body>
</html>