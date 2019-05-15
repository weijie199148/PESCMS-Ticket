<div class=" am-padding-xs am-padding-top-0">
    <div class="am-panel am-panel-default">
        <div class="am-panel-bd">
            <div class="am-cf">
                <div class="am-fl am-cf">
                    <?php if (!empty($_GET['back_url'])): ?>
                        <a href="<?= base64_decode($_GET['back_url']) ?>" class="am-margin-right-xs am-text-danger"><i
                                    class="am-icon-reply"></i>返回</a>
                    <?php endif; ?>
                    <strong class="am-text-primary am-text-lg"><a href="<?= $label->url(GROUP .'-' . MODULE . '-' . ACTION); ?>"><?= $title; ?></a>
                    </strong> /
                    <small>列表</small>
                </div>
            </div>
            <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed am-no-layout">
            <ul data-am-widget="gallery" class="am-gallery am-avg-sm-2 am-avg-md-3 am-avg-lg-4 am-gallery-default">
                <li>
                    <div class="am-gallery-item am-text-center">
                        <a href="javascript:;">
                            <img src="http://s.amazeui.org/media/i/demos/bing-1.jpg" class="test"  alt=""/>
                            <h3 class="am-gallery-title">
                                邮件模板1
                            </h3>
                            <div class="am-gallery-desc">

                            </div>
                        </a>
                    </div>
                </li>
            </ul>

        </div>
    </div>
</div>