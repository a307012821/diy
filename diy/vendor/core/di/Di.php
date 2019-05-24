<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/24
 * Time: 13:50
 */
namespace diy\core\di;

use diy\core\DiyException;

class Di{

    protected $_service = [];

    public function set($name , $definition){
        $this->service[$name] = $definition;
    }
    
    
    public function get($name){
        if (isset($this->_service[$name])) {
            $definition = $this->service[$name];
        }else {
            throw new \Exception("Service '" . $name . "' wasn't found in the dependency injection container");
        }
        if (is_object($definition)) {
            $instance = call_user_func($definition);
        }
        // 如果实现了DiAwareInterface这个接口，自动注入
        if (is_object($instance)) {
            if ($instance instanceof  DiAwareInterface) {
                $instance->setDI($this);
            }
        }
        return $instance;
    }

    
}