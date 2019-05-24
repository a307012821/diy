<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/15
 * Time: 11:42
 */
namespace app\controllers;

use diy\core\Assembly;
use diy\core\Controller;

class Test extends Controller{

    public function Index(){
        echo $this->getControllerName();
    }

    public function Test(){
//        $obj = Assembly::$app->test;
//        echo $obj->age;
//        echo "<pre>";
//        print_r($obj);
        $obj = Assembly::$app->test->run();
        return json_encode(["name"=>"aa","age"=>18,""]);
    }
}