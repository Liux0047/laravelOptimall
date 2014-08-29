<!DOCTYPE html>
<html lang='zh-Hans'>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />        
    </head>
    <body>
        <h2>重置您的密码</h2>
        <div>
            <p>
                亲爱的顾客：
            </p>
            <p>
                您好！我们最近收到了您重置密码的请求。您可以通过点击下面的链接地址设置新密码。
            </p>
            <p>
                <a href="{{ URL::to('password/reset', array($token)) }}">重置密码</a>
            </p>
            <p>
                该链接将会在 {{ Config::get('auth.reminder.expire', 60) }} 分钟后失效
            </p>
            <p>
                谢谢，<br>
                目光之城客户服务
            </p>
        </div>
    </body>
</html>
