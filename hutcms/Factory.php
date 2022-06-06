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

use think\Container;

abstract class Factory
{
    public static function instance($newInstance = false , ...$params): static
    {
        return app()->make(static::class , $params , $newInstance);
    }
}