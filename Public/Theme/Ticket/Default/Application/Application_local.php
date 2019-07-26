<div class=" am-padding-xs am-padding-top-0">
    <div class="am-panel am-panel-default">
        <div class="am-panel-bd">
            <div class="am-cf">
                <div class="am-fl am-cf">
                    <ol class="am-breadcrumb am-breadcrumb-slash am-margin-0 am-padding-0">
                        <li>
                            <strong class="am-text-default am-text-lg"><a class="am-link-muted" href="<?= $label->url(GROUP .'-' . MODULE . '-index'); ?>">应用商店</a>
                            </strong>
                        </li>
                        <li>
                            <strong class="am-text-primary am-text-lg"><a href="<?= $label->url(GROUP .'-' . MODULE . '-' . ACTION); ?>"><?= $title ?></a>
                            </strong>
                        </li>
                    </ol>
                </div>
            </div>
            <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed" />
            <div id="app-list">
                <table class="am-table am-table-striped am-table-hover am-table-centered">

                    <?php if(empty($list)): ?>
                    <tr>
                        <td>
                            本地暂无安装任何应用。
                        </td>
                    </tr>
                    <?php else: ?>
                        <tr>
                            <th>插件名称</th>
                            <th>版本</th>
                            <th>作者</th>
                            <th>描述</th>
                            <th>操作</th>
                        </tr>
                        <?php foreach($list as $key => $value): ?>
                        <tr>
                            <td>
                                <?= $value['info']['name']  ?>
                                <span class="am-badge am-radius"><?= $value['info']['status'] == 'enabled' ? '启用中' : '未启用' ?>
                                </span>
                            </td>
                            <td><?= $value['info']['version'] ?></td>
                            <td>
                                <a href="<?= $value['info']['website'] ?>" target="_blank"><?= $value['info']['author'] ?></a>
                            </td>
                            <td><?= $value['info']['content'] ?></td>
                            <td>
                                <?php if($value['info']['status'] == 'enabled'): ?>
                                <a href="<?= $label->url(GROUP.'-Application-Init', ['n' => $value['index'], 'f' => 'disabled']) ?>" class="am-badge am-badge-secondary am-radius ajax-click">禁用</a>
                                <?php else: ?>
                                <a href="<?= $label->url(GROUP.'-Application-Init', ['n' => $value['index'], 'f' => 'enabled']) ?>" class="am-badge am-badge-secondary am-radius ajax-click">启用</a>
                                <?php endif; ?>

                                <?php if($value['info']['option'] == 1): ?>
                                <a href="<?= $label->url(GROUP.'-Application-Init', ['n' => $value['index'], 'f' => 'option']) ?>" class="am-badge am-badge-warning am-radius">配置</a>
                                <?php endif; ?>

                                <a href="javascript:;" class="am-badge am-badge-warning am-radius ajax-click ajax-dialog check-update am-hide" msg="请确保已备份本插件，更新过程存在出错的可能" name="<?= $value['info']['name'] ?>" version="<?= $value['info']['version'] ?>">有可用更新</a>

                                <a href="<?= $label->url(GROUP.'-Application-Init', ['n' => $value['index'], 'f' => 'remove']) ?>" class="am-badge am-badge-danger am-radius ajax-click ajax-dialog" msg="您确定要此删除插件吗?">删除</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('.check-update').each(function(){
            var dom = $(this)
            var name = dom.attr('name');
            var version = dom.attr('version');
            $.ajax({
                url: "http://www.pc.com/?g=Api&m=Application&a=download&check=1&name="+name+"&check_version="+version,
                type: "GET",
                dataType:'JSON',
                success: function (data) {
                    if(data.status == 200){
                        dom.removeClass('am-hide');
                    }
                },
                error:function(obj){
                    var d = dialog({
                        title: '提示',
                        content: '检查插件更新时出错'
                    })
                    d.showModal();
                }
            })

        })
    })
</script>