<?php

namespace Core\Plugin;

class Plugin{

    /**
     * 执行的方法
     */
    public function addonsButton(){
        $json = json_decode(file_get_contents(PES_CORE.'plugin.json'), true);
        foreach($json as $key => $item){
            $key = "\Plugin{$key}";
            if(!$this->checkPluginFile(explode("\\", $key))){
                continue;
            }
            $obj[$key] = new $key();
            foreach ($item['button'] as $action => $auth){
                if(strcmp($auth, GROUP.MODULE.ACTION) !== 0){
                    return false;
                }
                $obj[$key]->$action();
            }
        }
    }

    /**
     * 生成要执行的JSON
     */
    public function register($class, $action){
        $pluginJson = json_decode(file_get_contents(PES_CORE.'plugin.json'), true);

        $pluginJson["\\".get_class($class)] = $action;

        echo '<pre>';
        print_r($pluginJson);
        print_r(get_class($class));
        echo '</pre>';
        echo '<br/>';
        exit;

    }

    /**
     * 验证插件是否存在
     * @param $file
     * @return bool
     */
    private function checkPluginFile($file){
        return is_file(PES_CORE.implode('/', $file).'.php');
    }
}