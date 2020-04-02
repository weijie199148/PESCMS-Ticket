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

        $config = $this->loadConfig($this);
        $config['plugin']['status'] = 'enabled';

        (new \Core\Plugin\Plugin())->updateConfig($this, $config)->register("\\Plugin\\MailTemplate\\index", [
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

        $config = $this->loadConfig($this);
        $config['plugin']['status'] = 'disabled';

        (new \Core\Plugin\Plugin())->updateConfig($this, $config)->unRegister('\\Plugin\\MailTemplate\\index');
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

    /**
     * 升级插件
     * @return mixed|void
     */
    public function upgrade(){
    }

}