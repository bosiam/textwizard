<?php
/* @var $this yii\web\View */
$this->title = $conf['title'];
?>
<h1><?=$conf['label']?></h1>
<div class="site-index">
            <div class="bs-callout bs-callout-info">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#paste_direct" role="tab" data-toggle="tab">直接粘贴</a></li>
                    <li role="presentation"><a href="#url_direct" role="tab" data-toggle="tab">URL</a></li>
                    <li role="presentation"><a href="#file_direct" role="tab" data-toggle="tab">文件上传</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="paste_direct">
                        <textarea id="content_paste_direct" class="content_holder" name="content"  rows="10" cols="80" style="width: 100%"></textarea>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="url_direct">
                        <input id="content_from_url" type="text" class="content_holder" name="url" style="width: 500px" value="http://">
                    </div>
                    <div role="tabpanel" class="tab-pane" id="file_direct">
                        <input type="file" id="content_from_file" class="content_holder" name="ufile">
                    </div>
                </div>
            </div>
            <div class="bs-callout bs-callout-info">
                <button class="btn btn-primary" type="button" onclick="enclick('<?=$conf['url']?>','en');"><?=$conf['enlabel']?></button>
                <button class="btn btn-primary" type="button" onclick="enclick('<?=$conf['url']?>','de');"><?=$conf['delabel']?></button>
            </div>
            <div class="bs-callout bs-callout-info" id="result_output">
                <div role="alert" class="alert alert-success" id="success_result_output_alert" style="display: none">
                    <strong>Well done!</strong> You successfully read this important alert message.
                        <!--<p class="pull-right">
                        <a href="#" >另存为</a>
                        <a href="#">复制到粘贴板</a>
                        </p>-->
                </div>
                <div role="alert" class="alert alert-danger" id="fail_result_output_alert" style="display: none">
                    <strong>Oh snap!</strong> Change a few things up and try submitting again.
                </div>
                <pre>
                <div id="output_direct">
                </div>
                </pre>
            </div>
    <div class="body-content">
        <!--json编码解码
        base64_encode编码解码
        msgpack编码解码
        url编码解码-->
    </div>
</div>
