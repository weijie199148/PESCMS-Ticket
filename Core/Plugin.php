<?php

namespace Core;

class Plugin{

    /**
     * 执行的方法
     */
    public function addonsButton(){
        $json = json_decode(file_get_contents(PES_CORE.'plugin.json'), true);
        foreach($json as $key => $item){
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
    public function registerButton(){

    }
}