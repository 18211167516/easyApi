<?php

namespace App\Model;
use App\Utility\Pool\MysqlPool;
use App\Utility\Pool\MysqlObject;
use EasySwoole\Component\Pool\PoolManager;
/**
 * model写法2,通过构造函数和析构函数去获取/回收连接
 * Class BaseModel
 * @package App\Model
 */
class BaseModel
{
    private $db;
    function __construct()
    {
        $this->db = PoolManager::getInstance()->getPool(MysqlPool::class)->getObj();
    }
    protected function getDb():MysqlObject
    {
        return $this->db;
    }
    function getDbConnection():MysqlObject
    {
        return $this->db;
    }
    public function __destruct()
    {
        PoolManager::getInstance()->getPool(MysqlPool::class)->recycleObj($this->getDb());
        // TODO: Implement __destruct() method.
    }
}