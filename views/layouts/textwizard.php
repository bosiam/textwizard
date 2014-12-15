<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'textwizard.cn|文本巫',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav'],
                'items' => [
                    [
                        'label' => '编码解码',
                        'url' =>'/site/index',
                        'items' => [
                            ['label' => 'Level 1 - Dropdown A', 'url' => '#'],
                            '<li class="divider"></li>',
                            '<li class="dropdown-header">Dropdown Header</li>',
                            ['label' => 'Level 1 - Dropdown B', 'url' => '#'],
                        ],
                    ],
                    ['label' => '字符集表', 'url' => ['/site/about']],
                    ['options' => ['class'=>'dropdown'],'label' => '在线程序执行', 'url' => ['/site/contact']],
                    ['label' => '文档转换', 'url' => ['/site/about']],
                ],
            ]);
            NavBar::end();
        ?>

        <div class="container" style="width: 900px">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
