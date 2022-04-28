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


    /**
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\DataNotFoundException
     */
    public function config(): string
    {
        $result=hut_conf('type2.name2');
        halt($result);
    }
    public function request()
    {
        var_dump($this->request->buildToken());
    }
}