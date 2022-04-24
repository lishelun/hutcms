<?php

declare (strict_types=1);

namespace app\web\controller;

use hutphp\Controller;

class Index extends Controller
{
    public function index(){
        return 'web xdd'.time();
    }
}