<?php

namespace App\HttpController;
use EasySwoole\EasySwoole\Trigger;
use EasySwoole\Http\AbstractInterface\Controller;
class Test extends Controller
{
    function index()
    {
        $this->response()->write('test index');
        // TODO: Implement index() method.

    }
    function user()
    {
        //记录输出错误
        Trigger::getInstance()->error('test error');
        $this->response()->write('user');
    }
}