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

    public static function codeType()
    {
        $conf = [
            'json' =>[
                'label' => 'json编码',
                'url' => Yii::$app->urlManager->createUrl('wizard/json'),
                'title' =>'在线编码|json编码|json解码|json_encode|json_decode',
                'head' => 'json格式在线解析',
                'description' =>'好用的在线json解析工具|快速json格式解析|json编码|json解码|json_encode|json_decode',
                'keywords' => '在线、json_encode、json_decode、编码解码',
                'second' => ['direction'=>'en','label'=>'json_encode编码'],
                'first' => ['direction'=>'de','label'=>'json_decode解码'],
                'execs' => 'json'
            ],
            'serialize' => [
                'label' => 'serialize序列化',
                'url' => Yii::$app->urlManager->createUrl('wizard/serialize'),
                'title' => '在线序列化|serialize序列化|unserialize反序列化|serialize|unserialize',
                'description' => '好用的在线序列化工具|serialize序列化|unserialize反序列化|serialize|unserialize',
                'head' => 'serialize在线序列化',
                'keywords' =>'在线序列化、serialize、unserialize',
                'second' => ['direction'=>'en','label'=>'serialize序列化'],
                'first' => ['direction'=>'de','label'=>'unserialize反序列化'],
                'execs' => 'serialize'
            ],
            'msgpack' => [
                'label' => 'msgpack序列化',
                'url' => Yii::$app->urlManager->createUrl('wizard/msgpack'),
                'title' => '在线序列化|msgpack_pack序列化|msgpack_unpack反序列化|msgpack_pack|msgpack_unpack',
                'head' => 'msgapck在线序列化',
                'keywords' =>'在线序列化、msgpack_pack序列化、msgpack_unpack反序列化',
                'description' => '好用的在线序列化工具|msgpack格式快速解析|msgpack_pack序列化|msgpack_unpack反序列化|msgpack_pack|msgpack_unpack',
                'second' => ['direction'=>'en','label'=>'msgpack_pack序列化'],
                'first' => ['direction'=>'de','label'=>'msgpack_unpack反序列化'],
                'execs' => 'msgpack'
            ],
            'urlencode' => [
                'label' => 'URL编码',
                'url' => Yii::$app->urlManager->createUrl('wizard/urlencode'),
                'title' => '在线URL编码、解码|url编码|url解码|urlencode|urldecode',
                'head' => 'url在线编码解码',
                'keywords' =>'URL在线编码解码、urldecode、urlencode',
                'description' => '好用的URL在线编码解码、urldecode、urlencode',
                'first' => ['direction'=>'en','label'=>'URL编码'],
                'second' => ['direction'=>'de','label'=>'URL解码'],
                'execs' => 'urlencode',
                'is_Urlfetch' => 0,
            ],
            'base64' => [
                'label' => 'base64编码',
                'url' => Yii::$app->urlManager->createUrl('wizard/base64'),
                'title' => '在线base64编码、解码|base64编码|base64解码|base64_encode|base64_decode',
                'head' => 'base64在线编码解码',
                'keywords' =>'base64在线编码解码、base64_decode、base64_encode',
                'description' => '好用的base64在线编码解码、base64_decode、base64_encode',
                'first' => ['direction'=>'en','label'=>'base64编码'],
                'second' => ['direction'=>'de','label'=>'base64解码'],
                'execs' => 'base64',
                'is_Urlfetch' => 0,
            ]
        ];
        return $conf;
    }
    public static function getCodeType($type='json')
    {
        $types = self::codeType();
        return isset($types[$type]) ? $types[$type] : $types['default'];
    }
    public static function getMenuLabels()
    {
        $labels = [];
        foreach(self::codeType() as $conf)
        {
            $labels[] = $conf;
        }
        return $labels;
    }
    public static function getCommonContent($action)
    {
        $text = Yii::$app->request->post('text');
        if($text)
        {
            $conf = self::getCodeType($action);
            if(!isset($conf['is_Urlfetch']) && preg_match('/^http:\/\//',$text))
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
            'urlencode' => ['en'=>'urlencode','de'=>'urldecode'],
            'base64' => ['en'=>'base64_encode','de'=>'base64_decode'],
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
                self::$msg = '输入数据不合法！';
                self::$errorMsg = $e->getName();
                $text = '';
            }
        }
       return $text;
    }
    public static function genIndexInfo()
    {
        $tools = self::codeType();
        $keywords = '';
        $description = '';
        foreach($tools as $t)
        {
            $keywords .= '|'.$t['keywords'];
            $description .= ','.$t['description'];
        }
        return [
            'title' => '编码助手|textwizard.cn - 最好用的在线文本编码、解码、解析、序列化工具',
            'keywords' => trim($keywords,'|'),
            'description' => trim($description,','),
            'head' => '工具大全',
            'intro' => $tools,
        ];
    }
    /**
     * XML编码
     * @param mixed $data 数据
     * @param string $root 根节点名
     * @param string $item 数字索引的子节点名
     * @param string $attr 根节点属性
     * @param string $id   数字索引子节点key转换的属性名
     * @param string $encoding 数据编码
     * @return string
     */
    public static function xml_encode($data, $root='think', $item='item', $attr='', $id='id', $encoding='utf-8') {
        if(is_array($attr)){
            $_attr = array();
            foreach ($attr as $key => $value) {
                $_attr[] = "{$key}=\"{$value}\"";
            }
            $attr = implode(' ', $_attr);
        }
        $attr   = trim($attr);
        $attr   = empty($attr) ? '' : " {$attr}";
        $xml    = "<?xml version=\"1.0\" encoding=\"{$encoding}\"?>";
        $xml   .= "<{$root}{$attr}>";
        $xml   .= self::data_to_xml($data, $item, $id);
        $xml   .= "</{$root}>";
        return $xml;
    }
    /**
     * 数据XML编码
     * @param mixed  $data 数据
     * @param string $item 数字索引时的节点名称
     * @param string $id   数字索引key转换为的属性名
     * @return string
     */
    public static function data_to_xml($data, $item='item', $id='id') {
        $xml = $attr = '';
        foreach ($data as $key => $val) {
            if(is_numeric($key)){
                $id && $attr = " {$id}=\"{$key}\"";
                $key  = $item;
            }
            $xml    .=  "<{$key}{$attr}>";
            $xml    .=  (is_array($val) || is_object($val)) ? self::data_to_xml($val, $item, $id) : $val;
            $xml    .=  "</{$key}>";
        }
        return $xml;
    }
}
