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

namespace hutcms\factory;

use hutcms\Factory;

class Plugin extends Factory
{
    /**
     * @throws \Exception
     */
    public static function make($pluginName , ...$params): static
    {
        $pluginClassName="\\hutcms\\plugin\\".$pluginName."\\Plugin";
        if(class_exists($pluginClassName)){
            return app()->make($pluginClassName , $params );
        }else{
            throw new \Exception("Plugin not exists");
        }
    }
}