<?php
/* @var $this yii\web\View */
$this->title = $conf['title'];
$link = Yii::$app->urlManager->createUrl($conf['link']);
?>
<div class="site-index">
            <div class="bs-callout bs-callout-info">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation"><a href="#url_direct" role="tab" data-toggle="tab">URL</a></li>
                    <li role="presentation"><a href="#file_direct" role="tab" data-toggle="tab">文件上传</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane" id="url_direct">
                        <input id="content_from_url" type="text" class="content_holder" name="url" style="width: 500px" value="http://">
                    </div>
                    <div role="tabpanel" class="tab-pane" id="file_direct">
                        <input type="file" id="content_from_file" class="content_holder" name="ufile">
                    </div>
                </div>
            </div>
            <div class="bs-callout bs-callout-info">
                <button class="btn btn-primary" type="button" onclick="enclick('<?=$link?>');"><?=$conf['enlabel']?></button>
                <button class="btn btn-primary" type="button"><?=$conf['delabel']?></button>
            </div>
            <div class="bs-callout bs-callout-info" id="result_output">
                <textarea id="output_direct" rows="10" cols="80" style="width: 100%"></textarea>
            </div>
    <div class="body-content">
        <!--json编码解码
        base64_encode编码解码
        msgpack编码解码
        url编码解码-->
    </div>
</div>
