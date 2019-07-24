<?php
namespace App\HttpController;
use App\HttpController\AdminBase;
use App\Utility\Pool\MysqlPool;
use EasySwoole\Mysqli\Mysqli;
use EasySwoole\EasySwoole\Config;
use EasySwoole\Mysqli\Config as myConfig;
use EasySwoole\Template\Render;
class Index extends AdminBase{
    function index()
    {
        $conf = new myConfig(Config::getInstance()->getConf('MYSQL'));
        $db = new Mysqli($conf);
        $data = $db->get('member');//获取一个表的数据
        //var_dump($data);
        //$this->response()->write(json_encode($data));
        $this->render('index.html',['user'=>'aaaaa','time'=>time()]);
        /* $this->response()->write(Render::getInstance()->render('index.html',[
            'user'=>'easyswoole',
            'time'=>time()
        ])); */
        /* $this->response()->write('hello');
        $db = MysqlPool::defer();  
        var_dump($db); */
        // TODO: Implement index() method.
    }


}