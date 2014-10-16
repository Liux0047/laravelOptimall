<?php

/* *
 * 配置文件
 * 版本：3.3
 * 日期：2012-07-19
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

 * 提示：如何获取安全校验码和合作身份者id
 * 1.用您的签约支付宝账号登录支付宝网站(www.alipay.com)
 * 2.点击“商家服务”(https://b.alipay.com/order/myorder.htm)
 * 3.点击“查询合作者身份(pid)”、“查询安全校验码(key)”

 * 安全校验码查看时，输入支付密码后，页面呈灰色的现象，怎么办？
 * 解决方法：
 * 1、检查浏览器配置，不让浏览器做弹框屏蔽设置
 * 2、更换浏览器或电脑，重新登录查询。
 */

//↓↓↓↓↓↓↓↓↓↓请在这里配置您的基本信息↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓

return array(

    //合作身份者id，以2088开头的16位纯数字
    'partner' => '2088611146364530',

    //安全检验码，以数字和字母组成的32位字符
    'key' => 'dwsmt7lowddbigw5vdso2mnyl5rcvvnk',

    //seller's email, alipay account
    'seller_email' => 'mgzcecommerce@163.com',

    //签名方式 不需修改
    'sign_type' => 'MD5',

    //字符编码格式 目前支持 gbk 或 utf-8
    'input_charset' => 'utf-8',

    //ca证书路径地址，用于curl中ssl校验
    //请保证cacert.pem文件在当前文件夹目录中
    'cacert' => public_path() . DIRECTORY_SEPARATOR . 'cacert.pem',

    //访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
    'transport' => 'https',

    // default bank for direct pay
    'payment_banks' => array(
        "BOCB2C" => "中国银行",
        "ICBCB2C" => "中国工商银行",
        "CMB" => "招商银行",
        "CCB" => "中国建设银行",
        "ABC" => "中国农业银行",
        "SPDB" => "上海浦东发展银行",
        "CIB" => "兴业银行",
        "GDB" => "广发银行",
        "FDB" => "富滇银行",
        "CITIC" => "中信银行",
        "HZCBB2C" => "杭州银行",
        "SHBANK" => "上海银行",
        "NBBANK" => "宁波银行",
        "SPABANK" => "平安银行",
        "POSTGC" => "中国邮政储蓄银行",
        "abc1003" => "Visa",
        "abc1004" => "Master",

    ),
);
