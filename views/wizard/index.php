<?php
/* @var $this yii\web\View */
$this->title = $conf['title'];
$link = Yii::$app->urlManager->createUrl('wizard/index');
?>
<div class="site-index">
            <div class="bs-callout bs-callout-info">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" role="tab" data-toggle="tab">直接粘贴</a></li>
                    <li role="presentation"><a href="#profile" role="tab" data-toggle="tab">URL</a></li>
                    <li role="presentation"><a href="#messages" role="tab" data-toggle="tab">文件上传</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <textarea id="content_paste_direct" class="content_holder" name="content"  rows="10" cols="80" style="width: 100%"></textarea>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">
                        <input id="content_from_url" type="text" class="content_holder" name="url" style="width: 500px" value="http://">
                    </div>
                    <div role="tabpanel" class="tab-pane" id="messages">
                        <input type="file" id="content_from_file" class="content_holder" name="ufile">
                    </div>
                </div>
            </div>
            <div class="bs-callout bs-callout-info">
                <button class="btn btn-primary" type="button" onclick="enclick('<?=$link?>');"><?=$conf['enlabel']?></button>
                <button class="btn btn-primary" type="button"><?=$conf['delabel']?></button>
            </div>
            <div class="bs-callout bs-callout-info">
                <div role="alert" class="alert alert-success">
                    <strong>Well done!</strong> You successfully read this important alert message.
                    <span style="text-decoration: underline">
                        <a href="#" >另存为</a>
                        <a href="#">复制到粘贴板</a>
                    </span>
                </div>
                <textarea id="output_direct" rows="10" cols="80" style="width: 100%"></textarea>
            </div>
    <div class="body-content">
        <!--json编码解码
        base64_encode编码解码
        msgpack编码解码
        url编码解码-->
    </div>
</div>
