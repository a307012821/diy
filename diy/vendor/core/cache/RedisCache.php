<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/24
 * Time: 14:12
 */
namespace diy\core\cache;


class RedisCache implements CacheInterface{

    public $host;

    public $user;

    public $password;

    public $port = "3960";

    public $redis;

    public function redisInstance(){
        if(!isset($this->redis)){
            $this->redis = new \Redis();
            $this->redis->connect($this->host,$this->port);
        }
        return $this->redis;
    }

    public function get($name){
        // TODO: Implement get() method.
        return $this->redisInstance()->get($name);
    }


    public function set($name, $value, $time = "")
    {
        // TODO: Implement set() method.
        return $this->redisInstance()->set($name, $value,$time);
    }

    public function delete($name)
    {
        // TODO: Implement delete() method.
        $this->redisInstance()->del($name);
    }

}