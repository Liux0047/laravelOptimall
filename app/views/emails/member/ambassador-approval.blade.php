<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <title>恭喜您成为目光之星</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width">
    <style>
    .btn {
        display: inline-block;
        margin-bottom: 0;
        font-weight: normal;
        text-align: center;
        vertical-align: middle;
        cursor: pointer;
        background-image: none;
        border: 1px solid transparent;
        white-space: nowrap;
        padding: 8px 12px;
        font-size: 15px;
        line-height: 1.42857143;
        border-radius: 0;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
    .btn-warning {
        color: #ffffff;
        background-color: #e99002;
        border-color: #d08002;
    }
    .btn {
        padding: 8px 12px;
    }
    </style>
</head>
<body>
    <p>
        亲爱的 {{ $nickname }}，
    </p>
    <p>
        恭喜您成为目光之星！
    </p>
    <p>
        您可以在我的目光之城边栏<a href="{{ action('MemberAccountController@getAmbassadorPanel') }}">目光之星</a>中查看详细信息 。
    </p>
    <p>
        迫不及待了？那么就开始目光之旅吧！
    </p>
    <p>
        目光之城
    </p>
</body>

</html>