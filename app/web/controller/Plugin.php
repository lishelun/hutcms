<?php

declare (strict_types = 1);

namespace app\web\controller;

use think\helper\Str;

class Plugin
{
    /**
     * @throws \Exception
     */
    public function exec($name)
    {
        $name=Str::studly($name);
        $classname="\\hutcms\\plugin\\".$name;
        if(class_exists($classname)){
            $plugin=app()->make($classname);
            if(method_exists($plugin,'main')){
                return $plugin->main();
            }
        }
        throw new \Exception('Plugin Error');
    }
}