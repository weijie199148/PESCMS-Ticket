<?php

namespace App\Ticket\GET;

/**
 * 应用商店
 */
class Application extends \Core\Controller\Controller {

    /**
     * 应用商店列表
     */
    public function index(){
        $this->layout();
    }

    public function plugin(){
        $name = $this->isG('n', '请提交插件名称');
        $func = $this->isG('f', '请提交插件要调用的方法');
        (new \Plugin\Hello\Hello())->$func();
    }

}