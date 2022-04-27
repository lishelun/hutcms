<?php

declare (strict_types = 1);

namespace hutcms;

use think\Db;
use think\App;
use think\Request;
use think\Container;

class Core
{
    protected App     $app;
    protected Request $request;
    protected Db      $db;

    public function __construct(App $app)
    {
        $this->app     = $app;
        $this->request = $app->request;
        $this->db      = $app->db;
    }


    public function instance(...$params)
    {
        Container::getInstance()->make(static::class , $params);
    }


}

?>