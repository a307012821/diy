<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/16
 * Time: 13:50
 */
namespace diy\core;

class Assembly extends Base{

    static public $app;

    static public function build(){
        self::$app = new \stdClass();
        $assembly = Config::get("assembly");
        foreach ($assembly as $key => $value){
            self::$app->$key = LoadClass::builder($value);
        }
    }

}