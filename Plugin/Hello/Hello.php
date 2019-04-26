<?php
namespace Plugin\Hello;

class Hello extends \Plugin\Plugin{

    public function index(){
        echo 'ddd';
        exit;
        $this->viewLayout(__DIR__, 'index');
    }

    public function ccc(){
        echo 'hello';
    }

    public function option() {
        // TODO: Implement option() method.
    }

    public function register() {
        (new \Core\Plugin())->registerButton('index');
        (new \Core\Plugin())->registerButton('ccc');
    }

}