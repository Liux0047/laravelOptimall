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
    table tr td {
        padding: 0px;
        font-size: 0px;
        vertical-align: middle;
    }
    </style>
</head>
<body>
    <table align="center" border="0" cellspacing="0" cellpadding="0" style="border-spacing: 0px;">
        <tr>
            <td colspan="3" style="height:474px; width: 570px; ">
                <img src="{{ $message->embed('images/ambassador/email/invitation-1.jpg') }}">
            </td>
        </tr>
        <tr>
            <td style="height:327px; width: 58px; ">
                <img src="{{ $message->embed('images/ambassador/email/invitation-2.jpg') }}">
            </td>
            <td>
                <div style="position: relative;padding-left:10%;text-align:left;font-size: 14px;font-family: Helvetica,Arial,sans-serif;">
                    <p><strong>您被邀请了!</strong></p>
                    <p>
                        您的好友{{ $nickname or '' }}邀请了你
                        <br>去逛逛
                        <a href="{{ URL::to('/') }}">目光之城</a> - <small>最IN的正品潮流眼镜商城</small>
                    </p>
                    <p>
                        <a href="{{ URL::to('/') }}" style="display: inline-block;margin-bottom: 0;font-weight: normal;text-align: center;vertical-align: middle;cursor: pointer;border: 1px solid transparent;white-space: nowrap;padding: 8px 12px;font-size: 15px;line-height: 1.42857143;border-radius: 0;color: #ffffff !important;background-color: #e99002;border-color: #d08002;text-decoration: none;padding: 8px 12px; ">
                            现在就去看看
                        </a>
                    </p>
                    @if(isset($invitatonCode))
                    <p>
                        *请在注册时使用他（她）的邀请码: <br>
                        <strong style="color: #2f88cc">{{ $invitatonCode }}</strong>
                    </p>
                    <p>
                        即刻获得购物卷: <span style="color: #2f88cc">{{ $couponCode or '' }} </span>
                        <br>                
                        并立刻享受 <span style="color: #2f88cc">{{ $discount }}% </span>的优惠
                    </p>
                    @endif
                </div>
            </td>
            <td style="height:327px; width: 230px; ">
                <img src="{{ $message->embed('images/ambassador/email/invitation-4.jpg') }}">
            </td>
        </tr>
        <tr>
            <td colspan="3" style="height:46px; width: 570px; ">
                <img src="{{ $message->embed('images/ambassador/email/invitation-5.jpg') }}">
            </td>
        </tr>
    </table>


</body>
</html>