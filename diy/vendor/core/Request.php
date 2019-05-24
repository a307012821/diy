<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/15
 * Time: 14:57
 */
namespace diy\core;

class request extends Base {

    static private $instance;

    public $_server ;

    public function __construct(){
        parent::__construct();
        $this->_server = $_SERVER;
    }

    /**
     * @return request
     * 请求实例（单例模式）
     */
    static public function getInstance(){
        if(!self::$instance instanceof self){
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @return array
     * 获取请求头
     */
    public function getHeader(){
        $headers = array();
        foreach ($this->_server as $key => $value) {
            if ('HTTP_' == substr($key, 0, 5)) {
                $headers[str_replace('_', '-', substr($key, 5))] = $value;
            }
        }
        if (isset($_SERVER['PHP_AUTH_DIGEST'])) {
            $header['AUTHORIZATION'] = $_SERVER['PHP_AUTH_DIGEST'];
        } elseif (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
            $header['AUTHORIZATION'] = base64_encode($_SERVER['PHP_AUTH_USER'] . ':' . $_SERVER['PHP_AUTH_PW']);
        }
        if (isset($_SERVER['CONTENT_LENGTH'])) {
            $header['CONTENT-LENGTH'] = $_SERVER['CONTENT_LENGTH'];
        }
        if (isset($_SERVER['CONTENT_TYPE'])) {
            $header['CONTENT-TYPE'] = $_SERVER['CONTENT_TYPE'];
        }
        return $headers;
    }

    /**
     * @param array $request
     * @param string $name
     * @param string $default
     * @return array|mixed|string
     * 获取请求参数
     */
    public function getRequestParams($request = [], $name = "" , $default = ""){
        if(!empty($name)){
            return !empty($request[$name]) ? $request[$name] : $default;
        }
        return !empty($request) ? $request : $default;
    }

    /**
     * @param $name
     * @param string $default
     * @return string
     * 获取get参数
     */
    public function get($name = "", $default = ""){
        return $this->getRequestParams($_GET , $name , $default);
    }

    /**
     * @param $name
     * @param string $default
     * @return string
     * 获取post参数
     */
    public function post($name = "", $default = ""){
        return $this->getRequestParams($_POST, $name , $default);
    }




}