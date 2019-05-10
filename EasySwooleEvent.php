<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/5/28
 * Time: 下午6:33
 */

namespace EasySwoole\EasySwoole;


use EasySwoole\Component\Pool\PoolManager;
use EasySwoole\EasySwoole\Swoole\EventRegister;
use EasySwoole\EasySwoole\AbstractInterface\Event;
use EasySwoole\Http\Request;
use EasySwoole\Http\Response;
use App\Process\Process;
use App\Process\Task;
use EasySwoole\EasySwoole\Crontab\Crontab;
use App\Crontab\TaskOne;
use EasySwoole\EasySwoole\Config;
use App\Utility\Pool\MysqlPool;
class EasySwooleEvent implements Event
{

    public static function initialize()
    {
        // TODO: Implement initialize() method.
        date_default_timezone_set('Asia/Shanghai');
        //加载batabase.php
        $database_file = EASYSWOOLE_ROOT.'/App/Conf/database.php';
        Config::getInstance()->loadFile($database_file,true);//合并数据库配置
    }

    public static function mainServerCreate(EventRegister $register)
    {
        // TODO: Implement mainServerCreate() method.
        $myProcess = new Process("ProcessBai",time(),false,2,true);
        ServerManager::getInstance()->getSwooleServer()->addProcess($myProcess->getProcess());
         // 开始一个定时任务计划 
        Crontab::getInstance()->addTask(TaskOne::class);
        $register->add($register::onWorkerStart, function (\swoole_server $server, int $workerId) {
            if ($server->taskworker == false) {
                //每个worker进程都预创建连接
                PoolManager::getInstance()->getPool(MysqlPool::class)->preLoad(10);//最小创建数量
            }
        });
        //ServerManager::getInstance()->getSwooleServer()->addProcess((new Task('processTest'))->getProcess());
    }

    public static function onRequest(Request $request, Response $response): bool
    {
        // TODO: Implement onRequest() method.
        return true;
    }

    public static function afterRequest(Request $request, Response $response): void
    {
        // TODO: Implement afterAction() method.
    }
}