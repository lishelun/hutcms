<?php

declare (strict_types=1);

namespace app\web\controller;

use hutphp\Controller;

class Test extends Controller
{
    public function index()
    {
        return time();
    }
}