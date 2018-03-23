<?php

$config = [
    'components' => [
        /** ------ 后台操作日志 ------ **/
        'actionlog' => [
            'class' => 'wayfiretech\netos\common\models\sys\ActionLog',
        ],
        'qr' => [
            'class' => '\Da\QrCode\Component\QrCodeComponent',
            // ... you can configure more properties of the component here
        ]
    ],
    'modules' => [
        /* 系统模块 */
        'sys' => [
            'class' => 'wayfiretech\netos\backend\modules\sys\Module',
        ],
        /* 微信模块 */
        'wechat' => [
            'class' => 'wayfiretech\netos\backend\modules\wechat\Module',
        ],
    ],
];

return $config;
