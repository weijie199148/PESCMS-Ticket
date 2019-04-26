<?php
namespace Plugin\Hello;
use \Core\Plugin\PluginController,
    \Core\Plugin\PluginImplements;

class Hello extends PluginController implements PluginImplements {

    public function index(){
        $list = \Model\Content::listContent([
            'table' => 'option'
        ]);
        $this->view('index');
    }

    public function ccc(){
        echo 'hello';
    }

    public function option() {
        // TODO: Implement option() method.
    }

    /**
     * 注册事件
     */
    public function register() {
        (new \Core\Plugin())->registerButton('index');
        (new \Core\Plugin())->registerButton('ccc');
    }

    public function enabled() {
        // TODO: Implement enabled() method.
    }

    public function disabled() {
        // TODO: Implement disabled() method.
    }

}