<?php

declare (strict_types = 1);

namespace app\web\controller;

use hutphp\Controller;

class Test extends Controller
{
    public function index()
    {
        return time();
    }

    public function table()
    {

    }

    public function config(): string
    {
        $result = hut_conf('type2.name2');
        halt($result);
    }

    public function request()
    {
        var_dump($this->request->buildToken());
    }

    public function log()
    {
        dump(hut_log('test' , '这是一个log测试'));
    }

    public function data()
    {
        $data = [1 , 2 , 3 , 4 , 2 , '554'];
        dump(hut_data('test2' , $data));
        dump(hut_data('test2'));
    }
}