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
    public function actionCommonRender($type='serialize',$view='text')
    {
        $config = Wizard::getCodeType($type);
        return $this->render($view,['conf' => $config]);
    }
    public function actionIndex()
    {
        $conf = Wizard::genIndexInfo();
        return $this->render('index',['conf'=>$conf]);
    }
    public function actionSerialize()
    {
        if($this->_isSubmit())
        {
            $this->w('serialize');
        }
        else
        {
            return $this->actionCommonRender('serialize');
        }
    }
    public function actionJson()
    {
        if($this->_isSubmit())
        {
            $this->w('json');
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
            $this->w('msgpack');
        }
        else
        {
            return $this->actionCommonRender('msgpack');
        }
    }
    public function actionUrlencode()
    {
        if($this->_isSubmit())
        {
            $this->w('urlencode');
        }
        else
        {
            return $this->actionCommonRender('urlencode');
        }
    }
    public function actionBase64()
    {
        if($this->_isSubmit())
        {
            $this->w('base64');
        }
        else
        {
            return $this->actionCommonRender('base64');
        }
    }
    public function w($action)
    {
        $ret = Wizard::getCommonContent($action);
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
