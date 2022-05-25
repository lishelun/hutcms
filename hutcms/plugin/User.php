<?php

declare (strict_types = 1);

namespace hutcms\plugin;

use hutphp\Controller;

class User extends Controller
{
    public function main()
    {
        return input('name');
    }
}