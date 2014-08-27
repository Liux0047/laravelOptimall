<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>恭喜您加入目光之城！请确认您的邮箱</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width">
    </head>
    <body>
        <p>
            亲爱的顾客：
        </p>
        <p>
            感谢您注册目光之城！我们诚挚地欢迎您的到来！ 
        </p>
        <p>
            您使用了 {{ $email }} 邮箱地址进行注册，为了给您提供更好的服务，请通过点击下面的链接确认这是您注册的邮箱。
        </p>
        <p>
            <a href="{{ $link }}">验证邮箱</a>
        </p>
        <p>
            希望您购物愉快！
        </p>
        <p>
            我为什么会收到这封邮件?<br>
            目光之城系统会自动发送确认邮件至顾客注册的邮箱地址。如果您没有注册，不用着急。您的地址在验证之前不会收到其他来自目光之城的邮件。

        </p>
        <p>
            更多信息，请参见 frequently asked questions.
        </p>
        <p>
            谢谢，<br>
            目光之城客户服务
        </p>
    </body>
</html>