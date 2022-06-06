<?php
/*
 *  +----------------------------------------------------------------------
 *  | HUTCMS
 *  +----------------------------------------------------------------------
 *  | Copyright (c) 2006-2022 http://hutcms.com All rights reserved.
 *  +----------------------------------------------------------------------
 *  | Licensed ( https://mit-license.org )
 *  +----------------------------------------------------------------------
 *  | Author: lishelun <lishelun@qq.com>
 *  +----------------------------------------------------------------------
 */

// [ 应用入口文件 ]
namespace think;

require __DIR__ . '/../vendor/autoload.php';
// 执行HTTP应用并响应
$http = (new App())->http;
$http->name('admin');
$response = $http->run();
$response->send();
$http->end($response);
