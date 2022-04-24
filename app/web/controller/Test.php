<?php

declare (strict_types=1);

namespace app\web\controller;

use hutphp\Controller;
use hutphp\helper\TableHelper;

class Test extends Controller
{
    public function create()
    {
        $table=TableHelper::instance()->init(dbtbpre().'test');
//        $result=$table->createTable('id',false,'int',255);


//        $result=$table->changeColumn('test_var1650734207','name_change','varchar',20,false,'abb',false,false,'是一个注22','id');
//        $result=$table->removeColumn('testfield1650733452');
//        $result=$table->clearTable();
        $result=$table->addIndex(['tag'],'');
        $result=$table->addIndex(['tag','ings']);
        $result=$table->removeIndex(['tag']);
        $result=$table->removeIndex(['tag','ings']);

        var_dump($result);
        die;
    }
}