<?php

namespace Core\Plugin;

class Plugin{

    /**
     * 插件按钮事件
     */
    public function button($type, $arguments){
        $json = json_decode(file_get_contents(PES_CORE.'plugin.json'), true);
        if(empty($json) && !is_array($json)){
            return false;
        }
        foreach($json as $key => $item){
            if(!$this->checkPluginFile(explode("\\", $key)) || empty($item[$type]) ){
                continue;
            }
            $obj[$key] = new $key();
            foreach ($item[$type] as $action => $auth){
                if(strcmp($auth, GROUP.MODULE.ACTION) !== 0){
                    return false;
                }
                $obj[$key]->$action($arguments);
            }
        }
    }

    /**
     * 注册插件
     */
    public function register($class, $action){
        $this->writePluginJson($class, $action);
    }

    /**
     * 注销插件
     */
    public function unRegister($class){
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
     * 更新配置文件
     * @param $obj
     * @param $status
     * @return $this 连贯操作进行插件事件注册和注销
     * @todo 暂时只能更新状态，未来看需求补充优化更新配置信息
     */
    public function updateConfig($obj, $status){
        $pluginConfigFile = $obj->pluginPath['plugin'].'/plugin.ini';

        $config = parse_ini_file($pluginConfigFile, true);

        $config['plugin']['status'] = $status;

        $fopen = fopen($pluginConfigFile, 'w+');

        foreach ($config as $name => $item){
            fwrite($fopen, "[{$name}]\n");
            foreach ($item as $key => $value){
                fwrite($fopen, "{$key} = {$value}\n");
            }
        }
        fclose($fopen);

        return $this;
    }


    public function remove($obj){
        $pluginConfigFile = $obj->pluginPath['plugin'].'/plugin.ini';
        $config = parse_ini_file($pluginConfigFile, true);

        $removePluginController = \Model\Extra::clearDirAllFile($obj->pluginPath['plugin'], $obj->pluginPath['plugin']);

        if($removePluginController['status'] == 0){
            return $removePluginController;
        }

        $removePluginView = \Model\Extra::clearDirAllFile($obj->pluginPath['view'], $obj->pluginPath['view']);
        if($removePluginView['status'] == 0){
            return $removePluginView;
        }

        return true;
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