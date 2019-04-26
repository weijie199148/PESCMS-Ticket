<?php

namespace Core\Plugin;

/**
 * 插件接口
 * Interface PluginImplements
 * @package Core\Plugin
 */
interface PluginImplements{

    /**
     * 插件默认入口
     * @return mixed
     */
    public function index();

    /**
     * 插件配置选项
     * @return mixed
     */
    public function option();

    /**
     * 注册插件需要注册那些方法
     * @return mixed
     */
    public function register();

    /**
     * 启用插件
     * @return mixed
     */
    public function enabled();

    /**
     * 关闭插件
     * @return mixed
     */
    public function disabled();

}