<?php
/* @var $this yii\web\View */
$this->title = $conf['title'];
?>
<h1><?=$conf['head']?></h1>
<div class="site-index">
            <div class="bs-callout bs-callout-info">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#paste_direct" role="tab" data-toggle="tab">直接粘贴</a></li>
                    <!--<li role="presentation"><a href="#url_direct" role="tab" data-toggle="tab">URL</a></li>-->
                    <li role="presentation"><a href="#file_direct" role="tab" data-toggle="tab">文件上传</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="paste_direct">
                        <textarea id="RawJson" class="content_holder" name="content"  placeholder="请将原始数据粘贴到此(支持URL抓取)" rows="10" cols="80" style="width: 100%"></textarea>
                    </div>
                    <!--
                    <div role="tabpanel" class="tab-pane" id="url_direct">
                        <input id="content_from_url" type="text" class="content_holder" name="url" style="width: 500px" value="http://">
                    </div>-->
                    <div role="tabpanel" class="tab-pane" id="file_direct">
                        <input type="file" id="content_from_file" class="content_holder" name="ufile">
                    </div>
                </div>
            </div>
            <div class="bs-callout bs-callout-info">
                <button class="btn btn-primary" type="button" onclick="enclick('<?=$conf['url']?>','de','<?=$conf['execs']?>');"><?=$conf['delabel']?></button>
                <button class="btn btn-primary" type="button" onclick="enclick('<?=$conf['url']?>','en','<?=$conf['execs']?>');"><?=$conf['enlabel']?></button>
                <div id="ControlsRow">
                  <span id="TabSizeHolder">
                    tab size:
                    <select onchange="TabSizeChanged()" id="TabSize">
                        <option value="1">1</option>
                        <option selected="true" value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>
                  </span>
                    <label for="QuoteKeys">
                        <input type="checkbox" checked="true" onclick="QuoteKeysClicked()" id="QuoteKeys">
                        Keys in Quotes
                    </label>&nbsp;
                    <a onclick="SelectAllClicked()" href="javascript:void(0);">select all</a>
                    &nbsp;
                          <span id="CollapsibleViewHolder">
                              <label for="CollapsibleView">
                                  <input type="checkbox" checked="true" onclick="CollapsibleViewClicked()" id="CollapsibleView">
                                  Collapsible View
                              </label>
                          </span>
                          <span id="CollapsibleViewDetail">
                            <a onclick="ExpandAllClicked()" href="javascript:void(0);">expand all</a>
                            <a onclick="CollapseAllClicked()" href="javascript:void(0);">collapse all</a>
                            <a onclick="CollapseLevel(3)" href="javascript:void(0);">level 2+</a>
                            <a onclick="CollapseLevel(4)" href="javascript:void(0);">level 3+</a>
                            <a onclick="CollapseLevel(5)" href="javascript:void(0);">level 4+</a>
                            <!--<a onclick="CollapseLevel(6)" href="javascript:void(0);">level 5+</a>
                            <a onclick="CollapseLevel(7)" href="javascript:void(0);">level 6+</a>
                            <a onclick="CollapseLevel(8)" href="javascript:void(0);">level 7+</a>
                            <a onclick="CollapseLevel(9)" href="javascript:void(0);">level 8+</a>-->
                          </span>
                </div>
            </div>
            <!--<div class="bs-callout bs-callout-info" id="result_output">-->
                <div role="alert" class="alert alert-success" id="success_result_output_alert" style="display: none">
                        <!--<p class="pull-right">
                        <a href="#" >另存为</a>
                        <a href="#">复制到粘贴板</a>
                        </p>-->
                </div>
                <div role="alert" class="alert alert-danger" id="fail_result_output_alert" style="display: none">
                </div>
                <div class="Canvas" id="Canvas"></div>
            <!--</div>-->
    <div class="body-content">
        <!--json编码解码
        base64_encode编码解码
        msgpack编码解码
        url编码解码-->
    </div>
</div>
