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
        $this->assign('title', '应用商店');
        $this->layout();
    }

    /**
     * 本地插件
     */
    public function local(){
        $pluginPath = PES_CORE.'Plugin/';

        $handler = opendir($pluginPath);
        while (($filename = readdir($handler)) !== false) {
            if ($filename != "." && $filename != ".." && is_dir($pluginPath.$filename) ) {

                $pluginConfigFile = $pluginPath.$filename.'/plugin.ini';

                if(is_file($pluginConfigFile) === false){
                    continue;
                }

                $config = parse_ini_file($pluginConfigFile, true);
                $plugin[$filename] = [
                    'name' => $filename,
                    'index' => "{$filename}-Init",
                    'info' => $config['plugin']
                ];
            }
        }
        closedir($handler);


        $this->assign('list', $plugin);
        $this->assign('title', '本地应用');
        $this->layout();
    }

}