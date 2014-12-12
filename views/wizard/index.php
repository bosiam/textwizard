<?php
/* @var $this yii\web\View */
$this->title = 'MY SITE';
?>
<div class="site-index">

    <div class="panel panel-default">
        <div class="panel-heading">
            a PHP parser
        </div>
        <div class="panel-body">
            <form>
                <textarea id="form_data_direct" name="data[direct]"  rows="10" cols="80" style="width: 100%">
                </textarea>
                <h2>
                    <a href=""><span class="label label-info">json解码</span></a>
                </h2>
                <!--<input type="radio" name="type" value="json">json解码
                <input type="radio" name="type" value="base64">-->
            </form>
            <textarea id="form_data_direct" name="data[direct]"  rows="10" cols="80" style="width: 100%">
            </textarea>
        </div>
    </div>
    <div class="body-content">
        <!--json编码解码
        base64_encode编码解码
        msgpack编码解码
        url编码解码-->
    </div>
</div>
