<?php
namespace app\admin\controller;

use app\BaseController;
use think\facade\View;

class Index extends BaseController
{
    public function index()
    {
        return View::fetch();
    }

    public function hello($name = 'ThinkPHP6')
    {
        $redis = new \Redis();
        $redis->connect('127.0.0.1',6379);
        $redis->auth('123456');
        $redis->set('name','test');
        $redis->set('description','just for test');
        echo 1;
    }

    public function welcome(){
        return view();
    }
}
