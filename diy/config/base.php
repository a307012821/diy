<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/15
 * Time: 10:48
 */
$db = require_once ("db.php");

return [
    //应用名称
    "app_name"      => "app name",

    //资源目录如需要在根目录添加php文件夹，需在这里进行设置
    "resource_path" => ["app","common"],

    "db"            => $db,

    //组件配置
    "assembly" =>[
        "test" => [
            "class"  => "common\models\Test",
            "config" => [
                "name" => "jack",
                "age"  => 18,
                "sex"  => "man"
            ]
        ],
        //缓存组件
        "cache" => [
            "class" => "diy\core\cache\RedisCache",
            "config"=>[
                "host" =>"localhost",
                "port" => 3690
            ]
        ]
    ]

];