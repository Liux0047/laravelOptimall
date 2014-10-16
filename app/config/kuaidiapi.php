<?php

return array(
    /*
     * Shipping query API config
     * http://www.kuaidiapi.cn/
     */
    'url' => 'http://www.kuaidiapi.cn/rest/',

    'uid' => '20260',

    'key' => '0fa30346a0aa44d59d1bb392d994a72a',

    'statusDescription' => array(
        '-1' => '待查询、在批量查询中才会出现的状态,指提交后还没有进行任何更新的单号',
        '0' => '查询异常',
        '1' => '暂无记录、单号没有任何跟踪记录',
        '2' => '在途中',
        '3' => '派送中',
        '4' => '已签收',
        '5' => '拒收、用户拒签',
        '6' => '疑难件、以为某些原因无法进行派送',
        '7' => '无效单',
        '8' => '超时单',
        '9' => '签收失败',

    ),

);