<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>光荣榜</title>
    <link rel="stylesheet" href="../screen/css/indexPC.css">
</head>
<body>
<div class="actIndex">
    <div class="acHead">
        <a href=""><img src="imgs/indexPC41.png" alt=""></a>
        <div class="finalPeople">
            <a style="color:#f6ce40;border:1px solid #f6ce40;">通关人数：{{count($winners)}}人</a>
        </div>
    </div>
    <div class="acPeople">
        @foreach($winners as $winner)
            <div class="acp">
                <a href=""><img src="{{$winner->headimg}}" alt=""></a>
                <p>{{$winner->nickname}}</p>
            </div>
        @endforeach
    </div>
    <div class="backIndex">
        <a href="{{route('q_index')}}" style="margin:30px auto;cursor:pointer;text-align:center;" class="beginAnswer">返回首页</a>
    </div>
</div>
<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="../screen/js/screen.js"></script>
<script>
    $('.beginAnswer').click(function(){
        window.location.href="{{route('q_index')}}";
    });
    function keydown(e) {
        var e = e || event;
        var currKey = e.keyCode || e.which || e.charCode;
        if ((currKey > 7 && currKey < 14) || (currKey > 31 && currKey < 47)) {
            switch (currKey) {
                case 37:        //左 返回首页
                    $('.beginAnswer').click();
                    break;
                case 38:        //上 返回首页
                    $('.beginAnswer').click();
                    break;
                case 39:        //右 返回首页
                    $('.beginAnswer').click();
                    break;
                case 40:        //下  返回首页
                    $('.beginAnswer').click();
                    break;
                default:

                    break;
            }
        }
    }
    document.onkeydown = keydown;
</script>
</body>
</html>
