<?php
namespace  hutcms\service;

use think\Request;
use think\Route;
use think\Service;

class HutcmsService extends  Service{
    public function register()
    {
        include_once __DIR__.'/../'."common.php";
//        echo HUTCMS_PATH;
    }
    public function boot()
    {

    }
}