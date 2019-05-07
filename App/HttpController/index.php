<?php
namespace App\HttpController;
use EasySwoole\Http\AbstractInterface\Controller;

class Index extends Controller{
    function index()
    {
        $this->response()->write('hello');
        // TODO: Implement index() method.
    }


}