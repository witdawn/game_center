<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<div>
    <div>
        <span>移动端测试</span>
    </div>
    <div>
        <p>前台页面</p>
        <ul id="line">

        </ul>
    </div>
</div>
</body>
<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
    var wsServer = 'ws://my.witdawn.com:9501/';
    var user_id = "{{$user->id}}";
    var active_id = "{{$active->id}}";
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
            addLine("连接成功");
        };

        websocket.onclose = function (evt) {
            websocket.send(JSON.stringify({
                action: 'user_logout',
                content: {
                    'active_id': active_id,
                    'user_id': user_id,
                },
            }));
            addLine("Disconnected");
        };

        websocket.onmessage = function (evt) {
            data = evt.data;
            console.log(evt);
            if (data) {
                data = $.parseJSON(data);
                console.log(data);
                addLine(data.question);
            }

        };

        websocket.onerror = function (evt, e) {
            addLine('Error occured: ' + evt.data);
        };
    };

    function addLine(data) {
        $("#line").append("<li>" + data + "</li>");
    }
</script>
</html>