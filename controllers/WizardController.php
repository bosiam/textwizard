<?php

namespace app\controllers;

use app\models\Wizard;
use Curl\Curl;
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
    public function actionCommonRender($type='serialize',$view='index')
    {
        $this->layout = 'textwizard';
        $config = Wizard::getCodeType($type);
        return $this->render($view,['conf' => $config]);
    }
    public function actionIndex()
    {
        $type = Yii::$app->request->post('type');
        if($type)
        {
            $output = Wizard::getCommonContent($type,'serialize');
            var_export($output);
            exit;
        }
        else
        {
            return $this->actionCommonRender();
        }
    }
    public function actionJson()
    {
        return $this->actionCommonRender('json');
    }
    public function actionMsgpack()
    {
        $type = Yii::$app->request->post('type');
        if($type)
        {
            $output = Wizard::getCommonContent($type,'msgpack');
            var_export($output);
            exit;
        }
        else
        {
            return $this->actionCommonRender('msgpack','msgpack');
        }
    }
	public function actionTest()
	{
		echo 'haha';
	}

}
