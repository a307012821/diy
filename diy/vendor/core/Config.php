<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/15
 * Time: 15:50
 */
namespace diy\core;

class Config extends Base {

    static $config;

    /**
     * @param $config
     * 初始化配置文件信息
     */
    static public function init($config){
        self::$config = $config;
    }

    /**
     * @param string $key
     * @return mixed
     * 获取配置文件数据
     */
    static function get($key = ""){
        return !empty($key) ? self::$config[$key] : self::$config;
    }


}