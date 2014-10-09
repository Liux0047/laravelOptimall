<!DOCTYPE html>
<html>
<head>
    <title>目光之城有问必答</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width">
</head>
<body>
    <p>
        亲爱的 {{ $nickname }}：
    </p>
    <p>
        感谢您提出的疑问，我们已经做出了答复
    </p>
    <p>
        您的问题：<br>
        {{{ $question }}}
    </p>
    <p>
        我们的答复：<br>
        {{{ $answer }}}
    </p>
    <p>
        更多信息，请参见 <a href="{{ action('InfoController@getAboutShoppings') }}">frequently asked questions</a>.
    </p>
    <p>
        谢谢，<br>
        目光之城客户服务
    </p>
</body>
</html>