<?php
declare (strict_types = 1);

namespace app\index\controller;

use think\cache\driver\Memcached;
use think\facade\Db;

class Index
{
    public function index()
    {
        return '您好！这是一个[index]示例应用';
    }

    public function buy(){
        //模拟订单完成
        $inventory = Db::name('goods')->where(['id'=>1])->value('inventory');
        if($inventory >=1){
            $res = Db::name('goods')->where(['id'=>1])
                ->dec('inventory')
                ->update();
            if($res){
                echo '购买成功！';
            }else{
                echo "购买失败！";
            }
        }else{
            echo '没有库存了！';
        }
    }

    public function seckill(){
        //模拟秒杀
        $inventory = 100; //库存
        $redis = new \Redis();
        $redis->connect('127.0.0.1',6379);
        $redis->auth('123456');
        $redis->select(1);
        for($i =0; $i<1000; $i++){
            $len = $redis->lLen('buy_user');
            if($len<$inventory){
                $user_id = 'user_'.$i;
                $redis->lPush('buy_user',$user_id);
            }else{
                echo '没有库存了';
                die;
            }
        }
    }

    public function kill_status(){
        //秒杀状态
        $user_id = 10;
        $redis = new \Redis();
        $redis->connect('127.0.0.1',6379);
        $redis->auth('123456');
        $redis->select(1);
        $len = $redis->lLen('buy_user');
        if($len>0){
            if($redis->lGet('user_'.$user_id)){
                echo '恭喜您已经秒杀到商品';
            }else{
                echo '很遗憾您的手速慢了！';
            }
        }
    }

    public function test(){
        //php面试题
        /*$str = '3,3,4,5,6,7,7';
        $arr = explode(',',$str);
        $min = min($arr);
        $max = max($arr);
        echo "最小值为：".$min."<br/>";
        echo "最大值为：".$max."<br/>";
        foreach ($arr as $key => $val){
            if($val == $min || $val==$max){
                unset($arr[$key]);
            }
        }
        echo "剩余个数：".count($arr);*/

        $str = "173,182,178,183,175";
        $arr = explode(',',$str);
        sort($arr);
        $arr2 = [];
        foreach ($arr as $key => $val){
            if($key  < count($arr)-1){
                $arr2[] = $arr[$key+1] - $arr[$key];
            }
        }
        if(count(array_unique($arr2))==1){
            echo "最高的两位：".$arr[3].'&'.$arr[4];
        }else{
            $arr2 = array_flip($arr2);
            ksort($arr2);
            $arr3 = array_values($arr2);
            $min = $arr3[0];
            echo "身高差最小的两位：".$arr[$min].'&'.$arr[$min+1];
        }
    }
}
