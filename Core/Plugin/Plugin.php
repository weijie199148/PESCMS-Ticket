<?php

namespace Core\Plugin;

class Plugin{

    /**
     * 执行的方法
     */
    public function addonsButton(){
        $json = json_decode(file_get_contents(PES_CORE.'plugin.json'), true);
        foreach($json as $key => $item){
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
        $this->writePluginJson($class, $action);
    }

    /**
     * 移除插件
     */
    public function remove($class){
        $this->writePluginJson($class);
    }

    /**
     * 写入插件json
     * @param $class 插件命名空间
     * @param array $action 注册插件事件 | 空则表示删除
     */
    private function writePluginJson($class, $action = array()){
        $pluginJsonFile = PES_CORE.'plugin.json';
        $pluginJson = json_decode(file_get_contents($pluginJsonFile), true);

        if(empty($action)){
            unset($pluginJson["\\".get_class($class)]);
        }else{
            $pluginJson["\\".get_class($class)] = $action;
        }

        $fopen = fopen($pluginJsonFile, 'w+');
        fwrite($fopen, json_encode($pluginJson, JSON_PRETTY_PRINT));
        fclose($fopen);
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