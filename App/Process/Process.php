<?php
namespace App\Process;
use App\Task\ProcessTest;
use EasySwoole\Component\Process\AbstractProcess;
use EasySwoole\EasySwoole\Logger;
use EasySwoole\EasySwoole\Swoole\Task\TaskManager;


class Process extends AbstractProcess{
    /* public function run($arg)
    {
        // TODO: Implement run() method.
        Logger::getInstance()->console($this->getProcessName()." start");
    } */

    public function run($arg)
    {
        echo "自定义进程开启\n";
// 直接投递闭包
        TaskManager::processAsync(function () {
            echo "自定义进程 异步任务执行中 \n";
        });
        // 投递任务类
        $taskClass = new ProcessTest('task data');
        TaskManager::processAsync($taskClass);
        // TODO: Implement run() method.
    }

    /* public function write(){
        $this->addTick(2*1000,function(){
            $this->getProcess()->write('123456');
        });
    } */

    public function onShutDown()
    {
        Logger::getInstance()->console($this->getProcessName()." end ");
        // TODO: Implement onShutDown() method.
    }

    public function onReceive(string $str)
    {
        Logger::getInstance()->console($this->getProcessName()." get ".$str);
        // TODO: Implement onReceive() method.
    }
}