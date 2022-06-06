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

namespace hutcms;

class Plugin
{
    /**
     * @throws \Exception
     */
    public static function make($pluginName , ...$params): object
    {
        $pluginClassName="\\hutcms\\plugin\\".$pluginName."\\Main";
        if(class_exists($pluginClassName)){
            return app()->make($pluginClassName , $params );
        }
        throw new \Exception("Plugin not exists");

    }
}