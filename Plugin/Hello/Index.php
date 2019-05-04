<?php
namespace Plugin\Hello;
use \Core\Plugin\PluginController,
    \Core\Plugin\PluginImplements;

class Index extends PluginController implements PluginImplements {

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
     * 启用插件
     * @return mixed|void
     */
    public function enabled() {
        (new \Core\Plugin\Plugin())->updateConfig($this, 'enabled')->register($this, [
            'button' => [
                'index' => 'TicketTicket_modelindex',
                'ccc' => 'TicketTicket_modelindex',
            ]
        ]);
        $this->success('插件启用成功');
    }

    /**
     * 禁用插件
     * @return mixed|void
     */
    public function disabled() {
        (new \Core\Plugin\Plugin())->updateConfig($this, 'disabled')->unRegister($this);
        $this->success('插件禁用成功');
    }

    /**
     * 删除插件
     * @return mixed|void
     */
    public function remove(){
        $this->success('插件已被删除');
    }

}