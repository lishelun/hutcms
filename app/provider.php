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

use app\ExceptionHandle;
//use app\Request;

// 容器Provider定义文件
return [
//    'think\Request'          => Request::class,
    'think\exception\Handle' => ExceptionHandle::class,
];
