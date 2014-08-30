<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>订单 {{ $orderNumber }} 提交成功</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>
        <p>
            亲爱的顾客，您好！
        </p>
        <p>
            恭喜您已经在目光之城订购成功，订单号： {{ $orderNumber }}。
        </p>
        <p>
            您可以在 <a href="{{ action('MemberAccountController@getShoppingHistory') }}">我的目光之城</a> 中查看订单详情，如需修改订单请及时联系我们。
        </p>
        <p>
            如果您有任何疑问欢迎查询帮助中心，或者电话联系我们。
        </p>
        <p>
            谢谢，<br>
            目光之城客户服务
        </p>
        <hr>
        <h4>
            您的订单 {{ $orderNumber }}
            <small>(提交于 {{ $created_at }})</small>
        </h4>
        <table>
            <thead>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>收件人：</td>
                    <td>{{ $recipient_name }}</td>
                </tr>
                <tr>
                    <td>配送地址：</td>
                    <td>{{ $receive_address }}</td>
                </tr>
                <tr>
                    <td>联系方式：</td>
                    <td>{{ $receive_phone }}</td>
                </tr>
                <tr>
                    <td>支付方式：</td>
                    <td>支付宝</td>
                </tr>
                <tr>
                    <td>总额:</td>
                    <td>{{ $net_amount }}元 <small>(含{{ $discount_amount }} 元折扣)</small></td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
