<?php
namespace App\HttpController;
use EasySwoole\Http\AbstractInterface\Controller;
use App\Utility\Pool\MysqlPool;
use EasySwoole\Mysqli\Mysqli;
use EasySwoole\EasySwoole\Config;
use EasySwoole\Mysqli\Config as myConfig;
class Index extends Controller{
    function index()
    {
        $conf = new myConfig(Config::getInstance()->getConf('MYSQL'));
        $db = new Mysqli($conf);
        $data = $db->get('member');//获取一个表的数据
        //var_dump($data);
        $this->response()->write(json_encode($data));
        /* $this->response()->write('hello');
        $db = MysqlPool::defer();  
        var_dump($db); */
        // TODO: Implement index() method.
    }


}