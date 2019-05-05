<?php
/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 * @core version 2.6
 * @version 1.0
 */


namespace Slice\Ticket;

/**
 * 插件切片
 * Class ApplicationPlugin
 * @package Slice\Ticket
 */
class ApplicationPlugin extends \Core\Slice\Slice{

    public function before() {

        $pluginName = $this->isG('n', '请提交插件名称');
        $pluginFunc = $this->isG('f', '请提交插件名称');

        /**
         * 插件初始化入口需要后台账号才运行访问
         */
        if(GROUP != 'Ticket' && explode('\\', $pluginName)[1] == 'Init'){
            $this->_404();
        }

        $plugin = "\Plugin\\{$pluginName}";
        (new $plugin)->{$pluginFunc}();
        exit;
    }

    public function after() {

    }

}