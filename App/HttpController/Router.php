<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/8/15
 * Time: 上午10:39
 */
namespace App\HttpController;
use EasySwoole\Http\AbstractInterface\AbstractRouter;
use FastRoute\RouteCollector;
use EasySwoole\Http\Request;
use EasySwoole\Http\Response;
class Router extends AbstractRouter
{
    function initialize(RouteCollector $routeCollector)
    {
        $this->setGlobalMode(true);//全局模式
//        $this->setGlobalMode(false);
        $this->setMethodNotAllowCallBack(function (Request $request,Response $response){
            $response->write('Not Found Method');
        });
        $this->setRouterNotFoundCallBack(function (Request $request,Response $response){
            $response->write('Not Found Router');
        });
        // TODO: Implement initialize() method.
        $routeCollector->get('/user','/Test/user');
        $routeCollector->get('/test','/Test/index');
        $routeCollector->get('/redis','Test/getRedis');
        $routeCollector->get('/test/redis','Test/getRedis2');
        $routeCollector->get('/test/go','Test/gotest');
        $routeCollector->get('/', '/Index/index');
        /* $routeCollector->get('/aaa',function(Request $request,Response $response){
            $response->redirect('/user');
        }); */
    }

}