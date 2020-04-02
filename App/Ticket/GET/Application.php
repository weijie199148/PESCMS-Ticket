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
        $plugin = $this->getPluginList();

        $this->assign('installed', json_encode(empty($plugin) ? [] :array_keys($plugin)));
        $this->assign('title', '应用商店');
        $this->layout();
    }

    /**
     * 本地插件
     */
    public function local(){
        $this->assign('list', $this->getPluginList());
        $this->assign('title', '本地应用');
        $this->layout();
    }

    /**
     * 获取插件列表
     * @return mixed
     */
    private function getPluginList(){
        $pluginPath = PES_CORE.'Plugin/';

        $handler = opendir($pluginPath);
        while (($filename = readdir($handler)) !== false) {
            if ($filename != "." && $filename != ".." && is_dir($pluginPath.$filename) ) {

                $pluginConfigFile = $pluginPath.$filename.'/plugin.ini';

                if(is_file($pluginConfigFile) === false){
                    continue;
                }

                $config = parse_ini_file($pluginConfigFile, true);

                $plugin[$config['plugin']['name']] = [
                    'name' => $filename,
                    'index' => "{$filename}-Init",
                    'info' => $config['plugin']
                ];
            }
        }
        closedir($handler);

        return $plugin;

    }

    /**
     * 应用安装
     */
    public function install(){
        $plugin = $this->isP('name', '请提交您要安装的应用');

        $fileName = \Model\Extra::getOnlyNumber().'.zip';

        $patchSave = APP_PATH.'Temp/'.$fileName;

        $getFile = (new \Expand\cURL())->init("http://www.pc.com/?g=Api&m=Application&a=download&name={$plugin}", [], [
            CURLOPT_HTTPHEADER => [
                'X-Requested-With: XMLHttpRequest',
                'Content-Type: application/json; charset=utf-8',
                'Accept: application/json',
            ]
        ]);


        if(empty($getFile)){
            $this->error('获取应用出错');
        }

        $json = json_decode($getFile, true);
        if(!empty($json)){
            $this->error($json['msg']);
        }

        $download = fopen($patchSave, 'w');
        fwrite($download, $getFile);
        fclose($download);

        if(is_file($patchSave) == false){
            $this->error('下载插件失败');
        }

        (new \Expand\zip()) ->unzip($patchSave);

        unlink($patchSave);

        $this->success('应用安装完毕');

    }

}