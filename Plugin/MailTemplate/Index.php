<?php
namespace Plugin\MailTemplate;
use \Core\Plugin\PluginController;

class Index extends PluginController{

    public function index(){
        $this->view('index');
    }

    /**
     * 列出可选择的邮件模板
     */
    public function show(){

        $this->assign('title', '邮件模板列表');
        $this->viewLayout('show');
    }

}