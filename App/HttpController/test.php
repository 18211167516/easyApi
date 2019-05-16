<?php

namespace App\HttpController;
use EasySwoole\EasySwoole\Trigger;
use EasySwoole\Http\AbstractInterface\Controller;
use EasySwoole\Component\Pool\PoolManager;
use App\Utility\Pool\MysqlPool;
use App\Model\Mysql;
use App\Model\Redis;
use App\Utility\Pool\RedisPool;
class Test extends Base
{
    function index()
    {
        $model = new Mysql();
        /* $db = PoolManager::getInstance()->getPool(MysqlPool::class)->getObj();
        var_dump($db); */
        $db = $model->getDbConnection();
        $data = $db->get('member');
        //$this->response()->write(json_encode($data));
        // TODO: Implement index() method.

    }

    function getRedis(){
        $redis = PoolManager::getInstance()->getPool(RedisPool::class)->getObj();
        $a = $redis->get('test');
        if(empty($a)){
            $redis->set('test', 'aaa');
        }
        $this->response()->write(json_encode($a));
        var_dump($a);
    }

    function getRedis2(){
        $redis = new Redis();
        $cn = $redis->getDbConnection();
        $a = $cn->get('test');
        $this->response()->write($a);
    }

    function user()
    {
        //记录输出错误
        Trigger::getInstance()->error('test error');
        $this->response()->write('user');
    }
}