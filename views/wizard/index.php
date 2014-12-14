<?php
/* @var $this yii\web\View */
$this->title = '在线|json编码|json解码|json_encode|json_decode';
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
                        <textarea id="form_data_direct" name="content"  rows="10" cols="80" style="width: 100%">
                        </textarea>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">
                        <input type="text" name="url" style="width: 500px" value="http://">
                    </div>
                    <div role="tabpanel" class="tab-pane" id="messages">
                        <input type="file" name="ufile">
                    </div>
                </div>
            </div>
            <div class="bs-callout bs-callout-info">
                <button class="btn btn-primary" type="button">json编码</button>
                <button class="btn btn-primary" type="button">json解码</button>
            </div>
            <div class="bs-callout bs-callout-info">
                <textarea id="form_data_direct" name="data[direct]"  rows="10" cols="80" style="width: 100%">
                </textarea>
            </div>
    <div class="body-content">
        <!--json编码解码
        base64_encode编码解码
        msgpack编码解码
        url编码解码-->
    </div>
</div>
