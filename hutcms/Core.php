<?php

declare (strict_types=1);

namespace hutcms;

use think\App;
use think\Container;
use think\Db;
use think\Request;

class Core
{
    protected App $app;
    protected Request $request;
    protected Db $db;

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->request = $app->request;
        $this->db = $app->db;
    }


    public function instance(...$params)
    {
        Container::getInstance()->make(static::class , $params);
    }


}
?>