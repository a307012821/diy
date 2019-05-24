<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/24
 * Time: 14:05
 */
namespace diy\core\cache;

use wechat\Base;

interface CacheInterface{
    
    public function set($name , $value, $time = "");
    
    public function get($name);
    
    public function delete($name);
}

