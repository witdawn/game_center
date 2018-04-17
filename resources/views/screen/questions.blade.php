<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<div>
    <div>
        <p>后台页面</p>
        <sapn id="online"></sapn>
        <span>第</span>
        <select id="round">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select><span>轮</span>
        <span id="game_start">开始</span>
        <div id="game_content">
            <div>
                <span id="title"></span>
                <ul id="line">

                </ul>
            </div>
            <span id="ft">下一题</span>
        </div>
    </div>
</div>
</body>
<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
    var active_id = "{{$active->id}}";
    var question_num = "{{$active->question_index}}";
    var question_round = "{{$active->question_round}}";
    $("#round").val(question_round);

    var wsServer = 'ws://my.witdawn.com:9501/';
    var websocket = new WebSocket(wsServer);
    window.onload = function () {
        websocket.onopen = function (evt) {
            console.log('连接成功');
            var round_num = $("#round").val();
            websocket.send(JSON.stringify({
                action: 'admin_login',
                content: {
                    'active_id': active_id,
                    'round_num': round_num,
                }
            }));

        };

        websocket.onclose = function (evt) {
            console.log('失去连接');
        };

        websocket.onmessage = function (evt) {
            if (evt.data) {
                var res=$.parseJSON(evt.data);
                console.log(res);
                if(res.type===1){
                    $("#online").text('在线人数' + res.count);
                }else if(res.type===2){
                    var options=res.options;
                    var title=res.title;
                    question_num=res.display_order;
                    console.log('title='+title);
                    console.log('num='+question_num);
                    $.each(options,function(i){
                        console.log('options:'+options[i]);
                    });
                }

            }
        };
        websocket.onerror = function (evt, e) {
            console.log('Error occured: ' + evt.data);
        };
    };

    $("#ft").click(function () {
        var round_num = $("#round").val();
        websocket.send(JSON.stringify({
            action: 'send_question',
            content: {
                'active_id': active_id,
                'round_num': round_num,
                'num': question_num,
            }
        }));
        console.log("发题成功");
    });
</script>
</html>