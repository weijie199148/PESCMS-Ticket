<?php
namespace Plugin\Hello;
use \Core\Plugin\PluginController;

class Index extends PluginController{

    public function index(){
        $this->view('index');
    }

}