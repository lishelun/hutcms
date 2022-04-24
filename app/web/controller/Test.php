<?php

declare (strict_types=1);

namespace app\web\controller;

use hutphp\Controller;
use hutphp\helper\TableHelper;

class Test extends Controller
{
    public function index()
    {
        return time();
    }
    public function table(){
        $res=true;
//        $table=TableHelper::instance()->setTable(dbtbpre().'tabletest');
//        $res=$table->addIndex(['tag'],'','fulltext');

        $this->success('test',[$res]);
    }
}