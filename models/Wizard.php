<?php

namespace app\models;

use Yii;
use yii\base\Model;
use Curl\Zebra_cURL;

/**
 * ContactForm is the model behind the contact form.
 */
class Wizard extends Model
{
    const REQUEST_URL_TIMEOUT = 15;

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
                'keywords' => '',
                'enlabel' => 'json_encode编码',
                'delabel' => 'json_decode解码',
            ],
            'serialize' => [
                'label' => 'serialize序列化',
                'url' => Yii::$app->urlManager->createUrl('wizard/index'),
                'title' => '在线序列化|serialize序列化|unserialize反序列化|serialize|unserialize',
                'keywords' =>'',
                'enlabel' => 'serialize序列化',
                'delabel' => 'unserialize反序列化',
            ],
            'msgpack' => [
                'label' => 'msgpack序列化',
                'url' => Yii::$app->urlManager->createUrl('wizard/msgpack'),
                'title' => '在线序列化|msgpack_pack序列化|msgpack_unpack反序列化|msgpack_pack|msgpack_unpack',
                'keywords' =>'',
                'enlabel' => 'msgpack_pack序列化',
                'delabel' => 'msgpack_unpack反序列化',
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
    public static function getCommonContent($type,$action)
    {
        $text = Yii::$app->request->post('text');
        if($text)
        {
            if($type === 'content_from_url')
            {
                $curl = new Zebra_cURL();
				$curl->threads = Wizard::REQUEST_URL_TIMEOUT;
                $text = $curl->get($text);
            }
            $side = Yii::$app->request->post('side');
            $conf = self::codeFuncConf();
            if(($func = $conf[$action][$side]))
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
        }
        return $text;
    }
    public static function codeFuncConf()
    {
        $conf = [
            'index' => ['en'=>'serialize','de'=>'unserialize'],
            'msgpack' => ['en'=>'msgpack_pack','de'=>'msgpack_unpack'],
            'json' => ['en'=>'json_encode','de'=>'json_decode'],
        ];
		return $conf;
    }


}
