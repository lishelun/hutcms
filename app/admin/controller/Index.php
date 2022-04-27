<?php

declare (strict_types=1);

namespace app\admin\controller;

use hutphp\Controller;

/**
 * 首页
 * @auth true
 * @login true
 */
class Index extends Controller
{
    /**
     * 后台首页
     *
     * @auth true
     * @return void
     */
    public function index()
    {
        return $this->success('ok');
    }

    /**
     * 测试
     * @auth true
     * @return void
     */
    public function test()
    {
        return $this->success('test');
    }
}