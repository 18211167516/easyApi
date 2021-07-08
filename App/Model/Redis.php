<?php

namespace App\Model;
use App\Utility\Pool\RedisPool;
use App\Utility\Pool\RedisObject;
use EasySwoole\Component\Pool\PoolManager;
/**
 * model写法2,通过构造函数和析构函数去获取/回收连接
 * Class BaseModel
 * @package App\Model
 */
class Redis
{
    private $db;
    function __construct()
    {
        $this->db = PoolManager::getInstance()->getPool(RedisPool::class)->getObj();
    }
    protected function getDb():RedisObject
    {
        return $this->db;
    }
    function getDbConnection():RedisObject
    {
        return $this->db;
    }
    public function __destruct()
    {
        PoolManager::getInstance()->getPool(RedisPool::class)->recycleObj($this->getDb());
        // TODO: Implement __destruct() method.
    }
}