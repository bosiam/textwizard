<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class Wizard extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;

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
                'url' => '',
                'title' =>'在线编码|json编码|json解码|json_encode|json_decode',
                'keywords' => '',
                'enlabel' => '',
                'delabel' => '',
            ],
            'serialize' => [
                'label' => 'serialize序列化',
                'url' => '',
                'title' => '在线序列化|serialize序列化|unserialize反序列化|serialize|unserialize',
                'keywords' =>'',
                'enlabel' => 'serialize序列化',
                'delabel' => 'unserialize反序列化',
            ],
            'msgpack' => [
                'label' => 'msgpack序列化',
                'url' => '',
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


}
