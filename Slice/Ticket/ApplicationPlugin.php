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
        $name = $this->isG('n', '请提交插件名称');
        $func = $this->isG('f', '请提交插件要调用的方法');
        $plugin = "\Plugin\\{$name}";

        (new $plugin)->$func();
        exit;
    }

    public function after() {

    }

}