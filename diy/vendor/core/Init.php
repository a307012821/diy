<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/15
 * Time: 10:38
 */
namespace diy\core;

class Init{

    protected $config = [];

    protected $base_path = "" ;

    protected $vendor_path = "";

    /**
     * Init constructor.
     * @param array $config
     * 初始化
     */
    public function __construct($config = []){
        $this->base_path = dirname(dirname(__DIR__)) . "\\";
        $this->vendor_path = dirname(__DIR__) . "\\";
        $this->config = $config;
    }

    /**
     * 构建方法
     */
    public function build(){
        spl_autoload_register([$this,"__autoload"]);
        Config::init($this->config);
        Assembly::build();
        $c_name = ucfirst($_GET["c"]);
        $a_name = ucfirst($_GET["a"] ?: "index");
        $controller_namespace = "\\app\\controllers\\" . $c_name;
        $controller = new $controller_namespace;
        $controller->init($a_name);
    }

    /**
     * @param $name
     * 自动加载方法
     */
    public function __autoload($name){
        $base_container = $this->config["resource_path"];
        $class_arr = explode("\\",$name);
        if(!empty($class_arr[0]) && in_array($class_arr[0], $base_container)){
            $file = $this->base_path. $name . ".php";
        }elseif (!empty($class_arr[0]) && $class_arr[0] == "diy"){
            unset($class_arr[0]);
            $file = $this->vendor_path . implode("\\",$class_arr) . ".php";
        }else{
            $file = $this->vendor_path . $name . ".php";
        }
        if(file_exists($file)){
            require_once $file;
        }
    }

}