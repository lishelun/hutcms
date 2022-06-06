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

use hutcms\Core;
use hutphp\Controller;

class Tpl extends Controller
{
    public function home()
    {
        $this->version=Core::version();
        $this->fetch();
    }

    public function layout()
    {
        $this->fetch();
    }
    public function fail()
    {
        $this->fetch();
    }
    public function empty()
    {
        $this->fetch();
    }

    public function about()
    {
        $this->fetch();
    }

    public function more()
    {
        $this->fetch();
    }
    public function theme()
    {
        $this->fetch();
    }
}