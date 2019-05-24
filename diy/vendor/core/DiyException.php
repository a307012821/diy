<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/16
 * Time: 17:09
 */
namespace diy\core;

class DiyException extends \Exception {

    //重定义构造器使第一个参数message变为必须被指定的属性
    public function __construct($message = "", $code = 0, \Throwable $previous = null){
        parent::__construct($message, $code, $previous);
    }

    //直接输出对象应用调用，重写父类中继承过来的方法，自定义字符串输出的样式
    public function __toString(){
        echo "<p style='font-size:20px;color: red;font-weight: bold'>".$this->message."<br>"."</p>";
    }

    //为这个异常自定义一个处理方法
    public function customFunction(){
        echo "按自定义的方法处理出现的这个类型的异常";
    }

}