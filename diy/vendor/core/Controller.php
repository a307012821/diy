<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/15
 * Time: 11:00
 */
namespace diy\core;

/**
 * Class Controller
 * @package diy\core
 * 构建controller生命周期
 */
class Controller extends Base {

    /**
     * @var string
     * 方法名,例如 Index
     */
    public $action_name = "";

    public $controller_name = "";

    public function __construct(){
        parent::__construct();
    }

    /**
     * @return string
     * 获取控制器的名称
     */
    public function getControllerName(){
        if(empty($this->controller_name)){
            $result =  explode("controllers\\",$this->get_class_name());
            $this->controller_name = end($result);;
        }
        return $this->controller_name;
    }

    /**
     * @param $action_name
     * @throws \Exception
     * 初始化
     */
    public function init($action_name){
        $this->action_name = $action_name;
        $this->controller_name = $this->getControllerName();
        $this->before();
        $this->excelAction();
        $this->after();
    }

    /**
     * @throws DiyException
     * 执行方法
     */
    public function excelAction(){
        $action = $this->action_name;
        if(!method_exists($this,$action)){
            throw new DiyException("action name : [$action()], Methods do not exist");
        }
        $result = $this->$action();
        if(!empty($result) && is_string($result)){
            echo $result;
        }else{
            print_r($result);
        }
    }


    public function before(){
        //todo 方法开始执行前
    }

    public function after(){
        //todo 方法执行结束操作
    }


    /**
     * @return string
     * 获取类名称
     */
    public function get_class_name(){
        return get_class($this);
    }


    /**
     * @param $view
     * @param array $data
     * 模板渲染
     */
    public function display($view , $data = []){
        $arr = explode("controllers\\",$this->get_class_name());
        $this->action = strtolower(end($arr));
        $view = $arr[0] . "views\\" . $this->action ."\\" . $view . ".php";
        foreach ($data as $key => $v){
            $$key = $v;
        }
        require_once ROOT_PATH . "\\" . $view;
    }


    /**
     * @return request
     * 请求
     */
    public function request(){
        return Request::getInstance();
    }


}