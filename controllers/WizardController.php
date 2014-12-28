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
    public $layout = 'textwizard';
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
        $config = Wizard::getCodeType($type);
        return $this->render($view,['conf' => $config]);
    }
    public function actionIndex()
    {
        if($this->_isSubmit())
        {
            $output = Wizard::getCommonContent();
            $this->w($output,'serialize');
        }
        else
        {
            return $this->actionCommonRender();
        }
    }
    public function actionJson()
    {
        if($this->_isSubmit())
        {
            $output = Wizard::getCommonContent();
            $this->w($output,'json');
        }
        else
        {
            return $this->actionCommonRender('json');
        }
    }
    public function actionMsgpack()
    {
        if($this->_isSubmit())
        {
            $output = Wizard::getCommonContent();
            $this->w($output,'msgpack');
        }
        else
        {
            return $this->actionCommonRender('msgpack');
        }
    }
	public function actionTest()
	{
        $a = new Curl();
        $b = $a->get('http://api.sina.cn/sinago/list.json?channel=news_toutiao&adid=b9c8c4bf3ff9e496fb409dac1e89bdae&p=1&wm=b207&from=6042195012&chwm=3022_0001&oldchwm=3022_0001&imei=863020014800696&uid=ee94b62b651df812');

		echo 'haha';
	}
    public function w($ret,$action)
    {
        $raw = Yii::$app->request->post('isRaw');
        if($raw >= 2)
        {//处理后的数据
            $ret = Wizard::contentHandle($ret,$action);
        }
        if(Wizard::$statusCode == 0 && $raw >= 3)
        {//json_encode
            $ret = json_encode($ret);
        }
        $ret = [
            'status' => Wizard::$statusCode,
            'msg' => Wizard::$msg,
            'data' => $ret,
        ];
        echo json_encode($ret);
        exit;
    }
    private function _isSubmit()
    {
        $side = Yii::$app->request->post('side');
        return $side ? true : false;
    }

}
