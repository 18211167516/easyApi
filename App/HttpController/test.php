<?php

namespace App\HttpController;
use EasySwoole\EasySwoole\Trigger;
use EasySwoole\Http\AbstractInterface\Controller;
use EasySwoole\Component\Pool\PoolManager;
use App\Utility\Pool\MysqlPool;
use App\Model\BaseModel4;
class Test extends Base
{
    function index()
    {
        $model = new BaseModel();
        /* $db = PoolManager::getInstance()->getPool(MysqlPool::class);
        var_dump($db); */
        $db = $model->getDbConnection();
        $data = $db->get('member');
        //$this->response()->write(json_encode($data));
        // TODO: Implement index() method.

    }
    function user()
    {
        //记录输出错误
        Trigger::getInstance()->error('test error');
        $this->response()->write('user');
    }
}