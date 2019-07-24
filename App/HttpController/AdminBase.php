<?php
namespace App\HttpController;

use EasySwoole\Http\AbstractInterface\Controller;
use EasySwoole\Template\Render;
use EasySwoole\EasySwoole\Trigger;
class AdminBase extends Controller{
    private $view;
    public function __construct()
    {
        parent::__construct();
        $this->view = Render::getInstance();
    }

    function index()
    {
    }

    protected function render(string $tpl,array  $assign){
        $this->response()->write($this->view->render($tpl,$assign));
    }

    protected function onRequest(?string $action): ?bool
    {
        //模拟拦截
        //当没有传code的时候则拦截
        /* if (empty($this->request()->getRequestParam('code'))) {
            $this->writeJson(Status::CODE_BAD_REQUEST, ['errorCode' => 1, 'data' => []], 'code不存在');
            return false;
        } */
        return true;
    }
    protected function onException(\Throwable $throwable): void
    {
        //拦截错误进日志,使控制器继续运行
        Trigger::getInstance()->throwable($throwable);
        $this->response()->write($throwable->getMessage());
        //$this->writeJson(Status::CODE_INTERNAL_SERVER_ERROR, null, $throwable->getMessage());
    } 

    protected function afterAction(?string $actionName): void
    {
        $this->view->restartWorker();
    }


    protected function actionNotFound(?string $action): void
    {
        //$this->response()->withStatus(Status::CODE_NOT_FOUND);
        $this->response()->write('action not found');
    }
}