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

declare (strict_types = 1);

namespace hutcms;

use think\Db;
use think\App;
use think\Request;
use think\Container;

class Core
{
    const VERSION = '0.0.1';
    protected App     $app;
    protected Request $request;
    protected Db      $db;

    public function __construct(App $app)
    {
        $this->app     = $app;
        $this->request = $app->request;
        $this->db      = $app->db;
    }

    public static function version(): string
    {
        return static::VERSION;
    }


    public static function instance(...$params):static
    {
       return  Container::getInstance()->make(static::class , $params);
    }
}

?>