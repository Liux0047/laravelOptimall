<?php

/**
 * Description of AlipayController
 *
 * @author Allen
 */
class AlipayController extends BaseController {
    /*     *
     * 支付宝接口公用函数
     * 详细：该类是请求、通知返回两个文件所调用的公用函数核心处理文件
     * 版本：3.3
     * 日期：2012-07-19
     * 说明：
     * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
     * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。
     */

    /**
     * 支付宝网关地址（新）
     */
    private $alipay_gateway_new = 'https://mapi.alipay.com/gateway.do?';

    public function postSubmitOrder() {

        $items = OrderLineItem::ofMember(Auth::id())->get();
        if (count($items) == 0) {
            return Redirect::to('/');
        }

        $cartController = new ShoppingCartController();
        //必填
        $price = $cartController->getNetPrice();

        //clear the coupon and record the usage
        $couponController = new CouponController();
        $couponId = $couponController->recordCouponUsage();

        $address = new Address;
        $address->recipient_name = Input::get('recipient_name', '');
        $address->receive_address = Input::get('receive_address', '');
        $address->receive_zip = Input::get('receive_zip', '');
        $address->receive_phone = Input::get('receive_phone', '');

        $orderController = new OrderController();
        $order = $orderController->insertOrder($items, "Alipay", $price, $address, $couponId);

        if (!isset($order->order_id)) {
            die("Order not created");
        }
        $tradeNumber = $this->generateTradeNumber($order->order_id);

        //send email
        $params['orderNumber'] = $tradeNumber;
        $params['created_at'] = (new DateTime($order->created_at))->format('Y-m-d H:i:s');
        $params['recipient_name'] = $order->recipient_name;
        $params['receive_address'] = $order->receive_address;
        $params['receive_phone'] = $order->receive_phone;
        $params['net_amount'] = $cartController->getNetPrice();
        $params['discount_amount'] = $cartController->getTotalDiscount();
        Mail::queue('emails.order.confirm-order', $params, function($message) {
            $message->to(Auth::user()->email)->subject('订单提交成功');
        });

        return $this->generateAlipayPage($tradeNumber, $price, $address);
    }

    public function postReSubmitPayment() {
        if (!Input::has('order_id')) {
            return Redirect::to('/');
        }
        $orderId = Input::get('order_id');
        $order = PlacedOrder::find($orderId);
        $price = $order->total_transaction_amount;
        $tradeNumber = $this->generateTradeNumber($orderId);
        $address = new Address;
        $address->recipient_name = $order->recipient_name;
        $address->receive_zip = $order->receive_zip;
        $address->receive_phone = $order->receive_phone;
        $address->receive_address = $order->receive_address;

        return $this->generateAlipayPage($tradeNumber, $price, $address);
    }

    public function getNotfity() {
        
    }

    public function getReturn() {
        
    }

    /*
     * transform an order ID into Alipay trade number
     */

    private function generateTradeNumber($orderId) {
        return 'CN' . str_pad($orderId, Config::get('optimall.orderCodeLength'), "0", STR_PAD_LEFT);
    }

    /*
     * generate a HTML form and submit with params
     */

    private function generateAlipayPage($tradeNumber, $price, $address) {
        /*         * ************************请求参数************************* */
        //支付类型
        $payment_type = "1";
        //必填，不能修改
        //服务器异步通知页面路径
        $notify_url = action('AlipayController@getNotify');
        //需http://格式的完整路径，不能加?id=123这类自定义参数
        //页面跳转同步通知页面路径
        $return_url = action('AlipayController@getReturn');
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
        //卖家支付宝帐户
        $seller_email = '13861383782';
        //必填
        //商户订单号
        $out_trade_no = $tradeNumber;
        //商户网站订单系统中唯一订单号，必填
        //订单名称
        $subject = "订单号 - " . $out_trade_no;
        //必填
        //商品数量
        $quantity = "1";
        //必填，建议默认为1，不改变值，把一次交易看成是一次下订单而非购买一件商品
        //物流费用
        $logistics_fee = "0.00";
        //必填，即运费
        //物流类型
        $logistics_type = "EXPRESS";
        //必填，三个值可选：EXPRESS（快递）、POST（平邮）、EMS（EMS）
        //物流支付方式
        $logistics_payment = "SELLER_PAY";
        //必填，两个值可选：SELLER_PAY（卖家承担运费）、BUYER_PAY（买家承担运费）
        //订单描述
        $body = Input::get('item_names');
        //商品展示地址
        $show_url = NULL;
        //需以http://开头的完整路径，如：http://www.xxx.com/myorder.html

        /*         * ********************************************************* */

        //构造要请求的参数数组，无需改动
        $parameter = array(
            "service" => "create_partner_trade_by_buyer",
            "partner" => trim(Config::get('alipay.partner')),
            "payment_type" => $payment_type,
            "notify_url" => $notify_url,
            "return_url" => $return_url,
            "seller_email" => $seller_email,
            "out_trade_no" => $out_trade_no,
            "subject" => $subject,
            "price" => $price,
            "quantity" => $quantity,
            "logistics_fee" => $logistics_fee,
            "logistics_type" => $logistics_type,
            "logistics_payment" => $logistics_payment,
            "body" => $body,
            "show_url" => $show_url,
            "receive_name" => $address->recipient_name,
            "receive_address" => $address->receive_address,
            "receive_zip" => $address->receive_zip,
            "receive_phone" => $address->receive_phone,
            "receive_mobile" => $address->receive_phone,
            "_input_charset" => trim(strtolower(Config::get('alipay.input_charset')))
        );

        //建立请求
        $html_text = $this->buildRequestForm($parameter, "get");
        return View::make('pages.alipay-submit', array('html_text' => $html_text));
    }

    /**
     * 生成签名结果
     * @param $para_sort 已排序要签名的数组
     * return 签名结果字符串
     */
    private function buildRequestMysign($para_sort) {
        //把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
        $prestr = $this->createLinkstring($para_sort);

        $mysign = "";
        switch (strtoupper(trim(Config::get('alipay.sign_type')))) {
            case "MD5" :
                $mysign = $this->md5Sign($prestr, Config::get('alipay.key'));
                break;
            default :
                $mysign = "";
        }

        return $mysign;
    }

    /**
     * 生成要请求给支付宝的参数数组
     * @param $para_temp 请求前的参数数组
     * @return 要请求的参数数组
     */
    private function buildRequestPara($para_temp) {
        //除去待签名参数数组中的空值和签名参数
        $para_filter = $this->paraFilter($para_temp);

        //对待签名参数数组排序
        $para_sort = $this->argSort($para_filter);

        //生成签名结果
        $mysign = $this->buildRequestMysign($para_sort);

        //签名结果与签名方式加入请求提交参数组中
        $para_sort['sign'] = $mysign;
        $para_sort['sign_type'] = strtoupper(trim(Config::get('alipay.sign_type')));

        return $para_sort;
    }

    /**
     * 生成要请求给支付宝的参数数组
     * @param $para_temp 请求前的参数数组
     * @return 要请求的参数数组字符串
     */
    private function buildRequestParaToString($para_temp) {
        //待请求参数数组
        $para = $this->buildRequestPara($para_temp);

        //把参数组中所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串，并对字符串做urlencode编码
        $request_data = createLinkstringUrlencode($para);

        return $request_data;
    }

    /**
     * 建立请求，以表单HTML形式构造（默认）
     * @param $para_temp 请求参数数组
     * @param $method 提交方式。两个值可选：post、get
     * @param $button_name 确认按钮显示文字
     * @return 提交表单HTML文本
     */
    private function buildRequestForm($para_temp, $method) {
        //待请求参数数组
        $para = $this->buildRequestPara($para_temp);

        $sHtml = "<form id='alipaysubmit' name='alipaysubmit' action='" . $this->alipay_gateway_new . "_input_charset=" . trim(strtolower(Config::get('alipay.input_charset'))) . "' method='" . $method . "'>";
        while (list ($key, $val) = each($para)) {
            $sHtml.= "<input type='hidden' name='" . $key . "' value='" . $val . "'/>";
        }

        //submit按钮控件请不要含有name属性
        $sHtml = $sHtml . "</form>";

        $sHtml = $sHtml . "<script>document.forms['alipaysubmit'].submit();</script>";

        return $sHtml;
    }

    /**
     * 建立请求，以模拟远程HTTP的POST请求方式构造并获取支付宝的处理结果
     * @param $para_temp 请求参数数组
     * @return 支付宝处理结果
     */
    private function buildRequestHttp($para_temp) {
        $sResult = '';

        //待请求参数数组字符串
        $request_data = $this->buildRequestPara($para_temp);

        //远程获取数据
        $sResult = getHttpResponsePOST($this->alipay_gateway_new, Config::get('alipay.cacert'), $request_data, trim(strtolower(Config::get('alipay.input_charset'))));

        return $sResult;
    }

    /**
     * 建立请求，以模拟远程HTTP的POST请求方式构造并获取支付宝的处理结果，带文件上传功能
     * @param $para_temp 请求参数数组
     * @param $file_para_name 文件类型的参数名
     * @param $file_name 文件完整绝对路径
     * @return 支付宝返回处理结果
     */
    private function buildRequestHttpInFile($para_temp, $file_para_name, $file_name) {

        //待请求参数数组
        $para = $this->buildRequestPara($para_temp);
        $para[$file_para_name] = "@" . $file_name;

        //远程获取数据
        $sResult = getHttpResponsePOST($this->alipay_gateway_new, Config::get('alipay.cacert'), $para, trim(strtolower(Config::get('alipay.input_charset'))));

        return $sResult;
    }

    /**
     * 用于防钓鱼，调用接口query_timestamp来获取时间戳的处理函数
     * 注意：该功能PHP5环境及以上支持，因此必须服务器、本地电脑中装有支持DOMDocument、SSL的PHP配置环境。建议本地调试时使用PHP开发软件
     * return 时间戳字符串
     */
    private function query_timestamp() {
        $url = $this->alipay_gateway_new . "service=query_timestamp&partner=" . trim(strtolower(Config::get('alipay.partner'))) . "&_input_charset=" . trim(strtolower(Config::get('alipay.input_charset')));
        $encrypt_key = "";

        $doc = new DOMDocument();
        $doc->load($url);
        $itemEncrypt_key = $doc->getElementsByTagName("encrypt_key");
        $encrypt_key = $itemEncrypt_key->item(0)->nodeValue;

        return $encrypt_key;
    }

    /**
     * 把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
     * @param $para 需要拼接的数组
     * return 拼接完成以后的字符串
     */
    private function createLinkstring($para) {
        $arg = "";
        while (list ($key, $val) = each($para)) {
            $arg.=$key . "=" . $val . "&";
        }
        //去掉最后一个&字符
        $arg = substr($arg, 0, count($arg) - 2);

        //如果存在转义字符，那么去掉转义
        if (get_magic_quotes_gpc()) {
            $arg = stripslashes($arg);
        }

        return $arg;
    }

    /**
     * 把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串，并对字符串做urlencode编码
     * @param $para 需要拼接的数组
     * return 拼接完成以后的字符串
     */
    private function createLinkstringUrlencode($para) {
        $arg = "";
        while (list ($key, $val) = each($para)) {
            $arg.=$key . "=" . urlencode($val) . "&";
        }
        //去掉最后一个&字符
        $arg = substr($arg, 0, count($arg) - 2);

        //如果存在转义字符，那么去掉转义
        if (get_magic_quotes_gpc()) {
            $arg = stripslashes($arg);
        }

        return $arg;
    }

    /**
     * 除去数组中的空值和签名参数
     * @param $para 签名参数组
     * return 去掉空值与签名参数后的新签名参数组
     */
    private function paraFilter($para) {
        $para_filter = array();
        while (list ($key, $val) = each($para)) {
            if ($key == "sign" || $key == "sign_type" || $val == "")
                continue;
            else
                $para_filter[$key] = $para[$key];
        }
        return $para_filter;
    }

    /**
     * 对数组排序
     * @param $para 排序前的数组
     * return 排序后的数组
     */
    private function argSort($para) {
        ksort($para);
        reset($para);
        return $para;
    }

    /**
     * 写日志，方便测试（看网站需求，也可以改成把记录存入数据库）
     * 注意：服务器需要开通fopen配置
     * @param $word 要写入日志里的文本内容 默认值：空值
     */
    private function logResult($word = '') {
        $fp = fopen("log.txt", "a");
        flock($fp, LOCK_EX);
        fwrite($fp, "执行日期：" . strftime("%Y%m%d%H%M%S", time()) . "\n" . $word . "\n");
        flock($fp, LOCK_UN);
        fclose($fp);
    }

    /**
     * 远程获取数据，POST模式
     * 注意：
     * 1.使用Crul需要修改服务器中php.ini文件的设置，找到php_curl.dll去掉前面的";"就行了
     * 2.文件夹中cacert.pem是SSL证书请保证其路径有效，目前默认路径是：getcwd().'\\cacert.pem'
     * @param $url 指定URL完整路径地址
     * @param $cacert_url 指定当前工作目录绝对路径
     * @param $para 请求的数据
     * @param $input_charset 编码格式。默认值：空值
     * return 远程输出的数据
     */
    private function getHttpResponsePOST($url, $cacert_url, $para, $input_charset = '') {

        if (trim($input_charset) != '') {
            $url = $url . "_input_charset=" . $input_charset;
        }
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true); //SSL证书认证
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); //严格认证
        curl_setopt($curl, CURLOPT_CAINFO, $cacert_url); //证书地址
        curl_setopt($curl, CURLOPT_HEADER, 0); // 过滤HTTP头
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 显示输出结果
        curl_setopt($curl, CURLOPT_POST, true); // post传输数据
        curl_setopt($curl, CURLOPT_POSTFIELDS, $para); // post传输数据
        $responseText = curl_exec($curl);
        //var_dump( curl_error($curl) );//如果执行curl过程中出现异常，可打开此开关，以便查看异常内容
        curl_close($curl);

        return $responseText;
    }

    /**
     * 远程获取数据，GET模式
     * 注意：
     * 1.使用Crul需要修改服务器中php.ini文件的设置，找到php_curl.dll去掉前面的";"就行了
     * 2.文件夹中cacert.pem是SSL证书请保证其路径有效，目前默认路径是：getcwd().'\\cacert.pem'
     * @param $url 指定URL完整路径地址
     * @param $cacert_url 指定当前工作目录绝对路径
     * return 远程输出的数据
     */
    private function getHttpResponseGET($url, $cacert_url) {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, 0); // 过滤HTTP头
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 显示输出结果
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true); //SSL证书认证
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); //严格认证
        curl_setopt($curl, CURLOPT_CAINFO, $cacert_url); //证书地址
        $responseText = curl_exec($curl);
        //var_dump( curl_error($curl) );//如果执行curl过程中出现异常，可打开此开关，以便查看异常内容
        curl_close($curl);

        return $responseText;
    }

    /**
     * 实现多种字符编码方式
     * @param $input 需要编码的字符串
     * @param $_output_charset 输出的编码格式
     * @param $_input_charset 输入的编码格式
     * return 编码后的字符串
     */
    private function charsetEncode($input, $_output_charset, $_input_charset) {
        $output = "";
        if (!isset($_output_charset))
            $_output_charset = $_input_charset;
        if ($_input_charset == $_output_charset || $input == null) {
            $output = $input;
        } elseif (function_exists("mb_convert_encoding")) {
            $output = mb_convert_encoding($input, $_output_charset, $_input_charset);
        } elseif (function_exists("iconv")) {
            $output = iconv($_input_charset, $_output_charset, $input);
        } else
            die("sorry, you have no libs support for charset change.");
        return $output;
    }

    /**
     * 实现多种字符解码方式
     * @param $input 需要解码的字符串
     * @param $_output_charset 输出的解码格式
     * @param $_input_charset 输入的解码格式
     * return 解码后的字符串
     */
    private function charsetDecode($input, $_input_charset, $_output_charset) {
        $output = "";
        if (!isset($_input_charset))
            $_input_charset = $_input_charset;
        if ($_input_charset == $_output_charset || $input == null) {
            $output = $input;
        } elseif (function_exists("mb_convert_encoding")) {
            $output = mb_convert_encoding($input, $_output_charset, $_input_charset);
        } elseif (function_exists("iconv")) {
            $output = iconv($_input_charset, $_output_charset, $input);
        } else
            die("sorry, you have no libs support for charset changes.");
        return $output;
    }

    /**
     * 签名字符串
     * @param $prestr 需要签名的字符串
     * @param $key 私钥
     * return 签名结果
     */
    private function md5Sign($prestr, $key) {
        $prestr = $prestr . $key;
        return md5($prestr);
    }

    /**
     * 验证签名
     * @param $prestr 需要签名的字符串
     * @param $sign 签名结果
     * @param $key 私钥
     * return 签名结果
     */
    private function md5Verify($prestr, $sign, $key) {
        $prestr = $prestr . $key;
        $mysgin = md5($prestr);

        if ($mysgin == $sign) {
            return true;
        } else {
            return false;
        }
    }

}