<div class=" am-padding-xs am-padding-top-0">
    <div class="am-panel am-panel-default">
        <div class="am-panel-bd">
            <div class="am-cf">
                <div class="am-fl am-cf">
                    <strong class="am-text-primary am-text-lg"><a href="javascript:;"><?= $title; ?></a>
                    </strong> /
                    <small>列表</small>
                </div>
            </div>
            <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed am-no-layout">
            <ul data-am-widget="gallery" class="am-gallery am-avg-sm-2 am-avg-md-3 am-avg-lg-4 am-gallery-default">
                <?php foreach($list as $key => $value): ?>
                <li>
                    <div class="am-gallery-item am-text-center">
                        <a href="<?= $label->pluginUrl(['n' => 'MailTemplate-Index', 'f' => 'demo', 'name' => $key]) ?>" target="_blank">
                            <img src="/Plugin/MailTemplate/assets/i/<?= $key ?>.jpg" class="am-img-thumbnail"  alt=""/>
                        </a>
                        <div class="am-gallery-desc am-margin-top">
                            <label class="am-radio-inline">
                                <input type="radio" name="template" value="<?= $key ?>" <?= $config['template']['current'] == $key ? 'checked="checked"' : '' ?> data-am-ucheck><?= $value ?>
                            </label>
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>

        </div>
    </div>
</div>
<script>
    $(function(){
        $('input[name=template]').on('click', function(){
            var template = $(this).val();
            $.ajaxsubmit({
                url:'<?= $label->pluginUrl(['n' => 'MailTemplate-Index', 'f' => 'update']) ?>',
                data: {
                    template:template
                }
            }, function(){
                
            });
        })
    })
</script>