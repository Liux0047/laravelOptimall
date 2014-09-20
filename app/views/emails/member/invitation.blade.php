<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <title>您的好友邀请了你去逛逛目光之城</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width">
    <style>
    body {
        width: 700px;
        height: 1100px;
    }
    #poster-container {
        position: relative;
    }
    #poster-container img {
        width: 684px;
        height: 1017px;
    }
    #poster-container #text-area{
        position: absolute;
        width: 60%;
        right: 25%;
        top: 60%;
        text-align:left;
    }
    #poster-container #text-area h1 {

    }
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
        color: #ffffff !important;
        background-color: #e99002;
        border-color: #d08002;
        text-decoration: none;
    }
    .btn {
        padding: 8px 12px;
    }
    </style>
</head>
<body>
    <div id="poster-container">
        <img src="{{ $message->embed('images/ambassador/invitation.jpg') }}">
        <div id="text-area">
            <h1>您被邀请了</h1>
            <h4>
                您的好友{{ $nickname or '' }} 邀请了你去逛逛
                <a href="{{ URL::to('/') }}">目光之城</a>
            </h4>
            <h4>
                <a href="{{ URL::to('/') }}" class="btn btn-warning">
                    现在就去看看
                </a>
            </h4>
            @if(isset($invitatonCode))
            <h4>
                *请在注册时使用他（她）的邀请码:
                <strong>{{ $invitatonCode }}</strong>
            </h4>
            <h4>
                即可购物卷: {{ $couponCode or '' }} <br>                
                并立刻享受 {{ $discount }}% 的优惠吧
            </h4>
            @endif
        </div>
    </div>
</body>
</html>