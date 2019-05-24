<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/15
 * Time: 10:32
 */
define("ROOT_PATH" , __DIR__);
require_once (__DIR__ . "/vendor/autoload.php");
require_once (__DIR__ . "/vendor/core/Init.php");

$config = array_merge(
    require_once ("./config/base.php")
);

$init = new \diy\core\Init($config);
$init->build();
