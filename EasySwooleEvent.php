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
        //$myProcess = new Process("ProcessBai",time(),false,2,true);
        //ServerManager::getInstance()->getSwooleServer()->addProcess($myProcess->getProcess());

        $rpcConfig = new \EasySwoole\Rpc\Config();
        $rpcConfig->setSerializeType(1);
        //注册服务名称
        $rpcConfig->setServiceName('ser1');

        $rpc1 = new \EasySwoole\Rpc\Rpc($rpcConfig);
        //注册响应方法
        $rpc1->registerAction('call1', function (\EasySwoole\Rpc\Request $request, \EasySwoole\Rpc\Response $response) {
            //获取请求参数
            var_dump($request->getArg());
            //设置返回给客户端信息
            $response->setMessage('response');
        });
        //监听/广播 rpc 自定义进程对象
        $autoFindProcess = $rpc1->autoFindProcess('es_rpc_process_1');
        //增加自定义进程去监听/广播服务
        ServerManager::getInstance()->getSwooleServer()->addProcess($autoFindProcess->getProcess());
        //起一个子服务去运行rpc
        ServerManager::getInstance()->addServer('rpc1',9504);
        $rpc1->attachToServer(ServerManager::getInstance()->getSwooleServer('rpc1'));
       /*  $subPort = ServerManager::getInstance()->getSwooleServer()->addListener('0.0.0.0',9504,SWOOLE_TCP);
        $subPort->on('receive',function (\swoole_server $server, int $fd, int $reactor_id, string $data){
            var_dump($data);
        }); */
         // 开始一个定时任务计划 
        //Crontab::getInstance()->addTask(TaskOne::class);
        /* $register->add($register::onWorkerStart, function (\swoole_server $server, int $workerId) {
            if ($server->taskworker == false) {
                //每个worker进程都预创建连接
                PoolManager::getInstance()->getPool(MysqlPool::class)->preLoad(10);//最小创建数量
            }
        }); */
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