<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/15
 * Time: 10:59
 */
namespace app\controllers;

use diy\core\Config;
use diy\core\Controller;
use diy\core\LoadClass;
use malkusch\lock\mutex\FlockMutex;
use malkusch\lock\mutex\PHPRedisMutex;
use TencentAi\App;
use think\Image;
use ZipStream\Option\Archive;
use ZipStream\ZipStream;

class Index extends Controller {

    public function Index(){
       $get = $this->request()->get();
       echo "<pre>";
//       print_r($get);
//        print_r(Config::get());
//        print_r(getcwd());
//        $obj = LoadClass::builder([
//            "class" => "common\models\Test",
//            "config" =>[
//                "name" =>"jack",
//                "age"  => 18,
//                "sex"  => "man"
//            ]
//        ]);
//        $obj->run();
       $this->display("index",["name"=>"李四22266","age"=>18,"sex"=>"男"]);
    }

    /**
     * 语音测试
     */
    public function Test(){
        $base = file_get_contents("./source/1546497539.amr");
        $base = base64_encode($base);
        $app = App::SpeechRecognition([
            "app_id"  => "2110973182",
            "app_key" => "k9knrdblMacuDW7R"
        ]);
        $result = $app->translate([
            'format'       => '3',
            'seq'          => '0',
            'end'          => '1',
            'session_id'   => 'test1',
            'speech_chunk' => $base,
            'source'       => 'zh',
            'target'       => 'zh',
        ]);
        echo "<pre>";
        print_r($result);die;
        $u_title ="以前科技有限公司";
        $title = "亿橙科技有限公司";
        similar_text($title,$u_title,$percent);
        echo $percent;die;
        if (mb_strlen($title) == mb_strlen($u_title) && $percent > 90) {
            echo "匹配成功";die;
        }
        echo "匹配失败";die;
    }



    public function Test2(){
//        $mutext = new PHPRedisMutex([],"key_name");
//        $mutext->synchronized(function (){
//            echo 111;
//        });

        $mutex = new FlockMutex(fopen(__FILE__,"r"));
        $result = $mutex->synchronized(function (){
            echo 2222;
            sleep(1);
            echo 5555;
            return 999;
        });
        echo "<pre>";
        var_dump($result);
        echo 667;
    }

    public $total_num = 2019;

    public $receive_num = 0;

    public $total_amount = 100000;

    public $receive_amount = 0;

    protected function receive(){
        $surplus_num = $this->total_num - $this->receive_num;
        $surplus_amount = $this->total_amount - $this->receive_amount;
        if ($surplus_amount <=0 || $surplus_num <=0){
            return 0;
        }
        if ($surplus_num == 1) {
            return $surplus_amount;
        }
        $max_amount = $surplus_amount - $surplus_num;

        $allow_max_amount = floor(($surplus_amount / $surplus_num) * 2);

        $max_amount = $max_amount > $allow_max_amount ? $allow_max_amount : $max_amount;

        return mt_rand(1,$max_amount > 0 ? $max_amount : 1);
    }

    public function Test3(){
//        总金额 1000   数量 100;
        echo "<pre>";
        for ($i = 0; $i < $this->total_num ; $i++){
            $receive_amount = $this->receive();
            $this->receive_num ++;
            $this->receive_amount += $receive_amount;
            echo $i . ":" . $receive_amount . "\n";
        }

        echo "总领取数" . $this->receive_amount;

    }


    public function Test4(){
        $time_interval_config["week"] = [
            1,2,3,6,7
        ];
        $week_arr = [];
        echo "<pre>";
        array_walk($time_interval_config["week"],function ($value, $key) use (&$week_arr) {
            $count = count($week_arr);
            if ($count == 0) {
                $week_arr[0][] = $value;
            }else {
                $second_arr_count = count($week_arr[$count - 1]);
                if (($week_arr[$count - 1][$second_arr_count - 1] + 1) == $value) {
                    $week_arr[$count - 1][] = $value;
                }else{
                    $week_arr[$count][] = $value;
                }
            }
        });

        print_r($week_arr);
    }


    public function Test5(){
        $week = [1,2,3,6,8];
        echo json_encode(["week" => $week]);
    }

    public function Json(){
        $data = [
            [
                "name" => "入口名称",
                "guide_lag" => "引导语",
                "href"   => "http://www.baidu.com"
            ],
            [
                "name" => "入口名称",
                "guide_lag" => "引导语",
                "href"   => "http://www.baidu.com"
            ]
        ];

        echo json_encode($data);die;
//        date_default_timezone_set("Asia/Shanghai");
////        $timstore = strtotime(date("2019-03-08 16:00:00"));
//        $begin_time = str_replace(":","","06:00");
//        $end_time = str_replace(":","","12:00");
//        $time = intval(date("Hi"));
//        if ($time > $begin_time && $time < $end_time){
//            echo 5;
//        }
//        echo $time;
        $data = json_encode([
            "week" => [0,1,2,3,4,5,6],
            "hour_field" => [
                [
                    "06:30",
                    "12:30"
                ],
                [
                    "15:30",
                    "18:30"
                ],
            ]
        ]);
        echo $data;
    }


    public function Test6(){
        $options = new Archive();
        $options->setSendHttpHeaders(true);

        $zip = new ZipStream('example.zip', $options);

        $zip->addFile('hello.txt', 'This is the contents of hello.txt');
        

        $zip->addFileFromPath('some_image.jpg', 'path/to/image.jpg');

        $fp = tmpfile();
        fwrite($fp, 'The quick brown fox jumped over the lazy dog.');
        rewind($fp);
        $zip->addFileFromStream('goodbye.txt', $fp);
        fclose($fp);
        $zip->finish();

    }

}