<?php

declare (strict_types=1);

namespace app\admin\controller;

use hutphp\Controller;

class User extends Controller
{
    public function login()
    {
        $this->success("ok",['token'=>md5(strval(time())),'id'=>'id','name'=>'admin','role'=>'','auth'=>'auth']);
    }
}