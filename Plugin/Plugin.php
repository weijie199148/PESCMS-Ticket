<?php

namespace Plugin;

/**
 * 插件抽象层
 */
abstract class Plugin extends \Core\Controller\Controller {

    abstract public function register();

    /**
     * 插件至少需要拥有配置方法,但不一定需要显示
     * @return mixed
     */
    abstract public function option();

    protected function display($themeFile='') {
        echo '<b>Parse error:</b>禁止调用Plugin\Plugin::display()';
        exit;
    }

    protected function layout($themeFile = '', $layout = "layout") {
        echo '<b>Parse error:</b>禁止调用Plugin\Plugin::layout()';
        exit;
    }

    protected function view($dir, $file){
        /* 加载标签库 */
        $label = new \Expand\Label();

        if (!empty(\Core\Func\CoreFunc::$param)) {
            extract(\Core\Func\CoreFunc::$param, EXTR_OVERWRITE);
        }

        require "{$dir}/view/{$file}.php";
    }

    protected function viewLayout($dir, $file, $layout = 'layout'){
        /* 加载标签库 */
        $label = new \Expand\Label();

        if (!empty(\Core\Func\CoreFunc::$param)) {
            extract(\Core\Func\CoreFunc::$param, EXTR_OVERWRITE);
        }
        $file = "{$dir}/view/{$file}.php";
        require THEME_PATH."/{$layout}.php";
    }

}