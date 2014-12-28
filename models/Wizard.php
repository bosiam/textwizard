<?php

namespace app\models;

use Curl\Curl;
use Yii;
use yii\base\ErrorException;
use yii\base\Model;
use Curl\Zebra_cURL;

/**
 * ContactForm is the model behind the contact form.
 */
class Wizard extends Model
{
    const REQUEST_URL_TIMEOUT = 30;

    /**
     * ajax调用时返回错误码
     * @var int
     */
    public static $statusCode = 0;
    /**
     * ajax调用时返回错误信息
     * @var string
     */
    public static $msg = 'Congratulations!';

    public static $errorMsg = '';

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    public static function CodeType()
    {
        $conf = [
            'json' =>[
                'label' => 'json编码',
                'url' => Yii::$app->urlManager->createUrl('wizard/json'),
                'title' =>'在线编码|json编码|json解码|json_encode|json_decode',
                'head' => 'json格式在线解析',
                'keywords' => '',
                'enlabel' => 'json_encode编码',
                'delabel' => 'json_decode解码',
                'execs' => 'json'
            ],
            'serialize' => [
                'label' => 'serialize序列化',
                'url' => Yii::$app->urlManager->createUrl('wizard/index'),
                'title' => '在线序列化|serialize序列化|unserialize反序列化|serialize|unserialize',
                'head' => 'serialize在线序列化',
                'keywords' =>'',
                'enlabel' => 'serialize序列化',
                'delabel' => 'unserialize反序列化',
                'execs' => 'serialize'
            ],
            'msgpack' => [
                'label' => 'msgpack序列化',
                'url' => Yii::$app->urlManager->createUrl('wizard/msgpack'),
                'title' => '在线序列化|msgpack_pack序列化|msgpack_unpack反序列化|msgpack_pack|msgpack_unpack',
                'head' => 'msgapck在线序列化',
                'keywords' =>'',
                'enlabel' => 'msgpack_pack序列化',
                'delabel' => 'msgpack_unpack反序列化',
                'execs' => 'msgpack'
            ]
        ];
        return $conf;
    }
    public static function getCodeType($type='json')
    {
        $types = self::CodeType();
        return isset($types[$type]) ? $types[$type] : $types['default'];
    }
    public static function getMenuLabels()
    {
        $labels = [];
        foreach(self::CodeType() as $conf)
        {
            $labels[] = $conf;
        }
        return $labels;
    }
    public static function getCommonContent()
    {
        $text = Yii::$app->request->post('text');
        if($text)
        {
            if(preg_match('/^http:\/\//',$text))
            {//通过URL获取数据
                $curl = new Curl();
                $curl->setOpt(CURLOPT_TIMEOUT,Wizard::REQUEST_URL_TIMEOUT);
                $curl->get($text);
                if($curl->curl_error)
                {//取出错误信息
                    $text = $curl->error_message;
                }
                else
                {//取原数据
                    $text = $curl->raw_response;
                }
            }
        }
        return $text;
    }
    public static function codeFuncConf()
    {
        $conf = [
            'serialize' => ['en'=>'serialize','de'=>'unserialize'],
            'msgpack' => ['en'=>'msgpack_pack','de'=>'msgpack_unpack'],
            'json' => ['en'=>'json_encode','de'=>'json_decode'],
        ];
		return $conf;
    }
    public static function contentHandle($text,$action)
    {
        $side = Yii::$app->request->post('side');
        $conf = self::codeFuncConf();
        if(($func = $conf[$action][$side]))
        {
            try
            {
                if($func === 'json_decode')
                {
                    $text =  call_user_func($func,$text,true);
                }
                else
                {
                    $text = call_user_func($func,$text);
                }
            }
            catch (ErrorException $e)
            {
                self::$statusCode = -1;
                self::$msg = '输入数据合法！';
                self::$errorMsg = $e->getName();
            }
        }
       return $text;
    }
}
