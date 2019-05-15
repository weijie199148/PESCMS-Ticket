<?php
namespace Plugin\MailTemplate;
use \Core\Plugin\PluginController,
    \Core\Plugin\PluginImplements;

class Init extends PluginController implements PluginImplements {

    /**
     * 插件选项
     * @return mixed|void
     */
    public function option() {
        // TODO: Implement option() method.
    }


    /**
     * 启用插件
     * @return mixed|void
     */
    public function enabled() {
        (new \Core\Plugin\Plugin())->updateConfig($this, 'enabled')->register("\\Plugin\\MailTemplate\\index", [
            'addButton' => [
                'index' => 'TicketMail_templateindex',
            ],
        ]);
        $this->success('插件启用成功');
    }

    /**
     * 禁用插件
     * @return mixed|void
     */
    public function disabled() {
        (new \Core\Plugin\Plugin())->updateConfig($this, 'disabled')->unRegister('\\Plugin\\MailTemplate\\index');
        $this->success('插件禁用成功');
    }

    /**
     * 删除插件
     * @return mixed|void
     */
    public function remove(){
        $plugin = new \Core\Plugin\Plugin();
        $removeFile = $plugin->remove($this);
        if($removeFile !== true){
            $this->error("移除插件时出错! {$removeFile['msg']}");
        }

        $plugin->unRegister($this);

        $this->success('插件已被删除');
    }

}