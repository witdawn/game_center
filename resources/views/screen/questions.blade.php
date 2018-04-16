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
        <span id="ft">发题</span>
        <ul id="line">

        </ul>
    </div>
</div>
</body>
<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
    var wsServer = 'ws://my.witdawn.com:9501/';
    var websocket = new WebSocket(wsServer);
    window.onload = function () {

        websocket.onopen = function (evt) {
            websocket.send(JSON.stringify({
                action: 'admin_login',
                content: {
                    'active_id': 1,
                }
            }));
            console.log(3333);
            addLine("连接成功");
        };

        websocket.onclose = function (evt) {
            addLine("Disconnected");
        };

        websocket.onmessage = function (evt) {
            console.log(evt);
            if(evt.data){
                $("#online").text('在线人数' + evt.data);
            }
        };

        websocket.onerror = function (evt, e) {
            addLine('Error occured: ' + evt.data);
        };
    };

    $("#ft").click(function(){
        websocket.send(JSON.stringify({
            action: 'send_question',
            content: {
                'active_id': 1,
                'q_id': 1,
            }
        }));
        console.log(111);
        addLine("发题成功");
    });

    function addLine(data) {
        $("#line").append("<li>" + data + "</li>");
    }
</script>
</html>