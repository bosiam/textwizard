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
                'brandLabel' => '编码助手|textwizard.cn',
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
                        'url' =>'/wizard/index',
                        'items' => \app\models\Wizard::getMenuLabels(),
                    ],
                    //['label' => '字符集表', 'url' => ['/charset/index']],
                    //['label' => '在线程序执行', 'url' => ['/program/index']],
                    //['label' => '文档转换', 'url' => ['/docConvert/index']],
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
        <div class="container" style="line-height: 0px;padding-top: 5px">
            <p style="margin: 0px">
                © 2014-2015 textwizard.cn 版权所有 ICP证：京ICP备15000031号
            </p>
        </div>
    </footer>
    <div class="scroll-top-wrapper ">
        <span class="scroll-top-inner">
            <i class="fa fa-2x fa-arrow-circle-up">︿</i>
        </span>
    </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
