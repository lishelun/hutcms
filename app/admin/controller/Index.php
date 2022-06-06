<?php
/*
 *  +----------------------------------------------------------------------
 *  | HUTCMS
 *  +----------------------------------------------------------------------
 *  | Copyright (c) 2022 http://hutcms.com All rights reserved.
 *  +----------------------------------------------------------------------
 *  | Licensed ( https://mit-license.org )
 *  +----------------------------------------------------------------------
 *  | Author: lishelun <lishelun@qq.com>
 *  +----------------------------------------------------------------------
 */

declare (strict_types=1);

namespace app\admin\controller;

use hutphp\Controller;

/**
 * 首页
 */
class Index extends Controller
{
    /**
     * 后台首页
     *
     * @return void
     */
    public function index()
    {
        $this->fetch();
    }
}