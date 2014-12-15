<?php

namespace app\controllers;

use app\models\Wizard;
use Yii;
use yii\console\Response;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class WizardController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    public function actionIndex()
    {
        if(isset($_POST['text']))
        {
            $text = $_POST['text'];
            $output = (unserialize($text));
            var_export($output);
            exit;
        }
        else
        {
            $type = 'serialize';
            $this->layout = 'textwizard';
            $config = Wizard::getCodeType($type);
            return $this->render('index',['conf' => $config]);
        }
    }

}
