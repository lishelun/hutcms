<?php

declare (strict_types=1);

namespace app\web\controller;

class Info
{
    public function read($id)
    {
        echo $id.'time'.time();
    }
}