<?php
/* @var $this yii\web\View */
$this->title = $conf['title'];
$this->metaTags = [
    '<meta name="keywords" content="'.$conf['keywords'].'">',
    '<meta name="description" content="'.$conf['description'].'">',
]
?>
<h1><?=$conf['head']?></h1>
<div class="site-index">
    <div class="body-content">
        <div class="list-group">
            <?php foreach($conf['intro'] as $tool):?>
            <a href="<?=$tool['url']?>" class="list-group-item">
                <h4 class="list-group-item-heading"><?=$tool['head']?></h4>
                <p class="list-group-item-text"><?=$tool['title']?></p>
            </a>
            <?php endforeach;?>
        </div>
    </div>
</div>
