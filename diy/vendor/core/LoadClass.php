<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/15
 * Time: 18:08
 */
namespace diy\core;


/**
 * Class LoadClass
 * @package diy\core
 */
class LoadClass extends Base {

    /**
     * @param $assembly
     * @param bool $init_status
     * @return mixed
     * ["class" => "","config" => []]
     */
     static public function builder($assembly , $init_status = false){
         if(!is_object($assembly["class"])){
             $class = $assembly["class"];
             $class = new $class($init_status ? (!empty($assembly["config"]) ? $assembly["config"] : "" ) : "");
         }else{
             $class = $assembly["class"];
         }
         return self::setAttr($class,!empty($assembly["config"]) ? $assembly["config"] : []);
     }

    /**
     * @param $obj
     * @param $config
     * @return mixed
     * 设置属性
     */
     static public function setAttr($obj,$config = []){
         foreach ($config as $name => $value){
             $obj->$name = $value;
         }
         return $obj;
     }
}