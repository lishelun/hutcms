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

use think\Service;

class Boot extends Service
{
    public function register()
    {
        define('HUTCMS_PATH' , root_path() . 'hutcms' . DIRECTORY_SEPARATOR);
        include HUTCMS_PATH . 'common.php';
        $this->app->lang->load(HUTCMS_PATH . '/lang/zh-cn.php', 'zh-cn');
        $this->app->lang->load(HUTCMS_PATH . '/lang/en-us.php', 'en-us');
    }

    public function boot()
    {

    }
}