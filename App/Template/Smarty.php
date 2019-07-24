<?php

namespace App\Template;
use EasySwoole\Template\RenderInterface;
class Smarty implements RenderInterface
{
    protected $smarty;
    function __construct()
    {
        $this->smarty = new \Smarty();
        $this->smarty->setCompileDir(EASYSWOOLE_ROOT.'/Temp/compile_s/');
        $this->smarty->setCacheDir(EASYSWOOLE_ROOT.'/Temp/cache_s/');
        $this->smarty->setTemplateDir(EASYSWOOLE_ROOT.'/App/HttpController/Template');
    }
    public function render(string $template, array $data = [], array $options = []): ?string
    {
       foreach ($data as $key => $item){
           $this->smarty->assign($key,$item);
       }
       return $this->smarty->fetch($template);
    }

    public function display(string $template){
        return $this->smarty->display($template);
    }

    public function assign(string $key,$val):?string
    {
        $this->smarty->assign($key, $val);
    }

    public function afterRender(?string $result, string $template, array $data = [], array $options = [])
    {
    }
    public function onException(\Throwable $throwable): string
    {
        // TODO: Implement onException() method.
    }
}