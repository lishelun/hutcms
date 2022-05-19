<?php

declare (strict_types = 1);

namespace hutcms;

use think\Service;

class Boot extends Service
{
    public function register()
    {
        define('HUTCMS_PATH' , root_path() . 'hutcms' . DIRECTORY_SEPARATOR);
        include_once HUTCMS_PATH . 'common.php';
        $this->app->lang->load(HUTCMS_PATH . '/lang/zh-cn.php', 'zh-cn');
        $this->app->lang->load(HUTCMS_PATH . '/lang/en-us.php', 'en-us');
    }

    public function boot()
    {

    }
}