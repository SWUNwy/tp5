<?php
namespace app\wx\controller;

use think\Controller;
/**
 * Description of Index
 *
 * @author Administrator
 */
class Index extends Controller {

    // 开发者ID
    private $appId = "";
    //开发者秘钥
    private $encodingAESKey = "";
    //Token
    private $token = "yrui";

    public function __initialize($appId, $encodingAESKey, $token) {
        $this->appId = $appId;
        $this->encodingAESKey = $encodingAESKey;
        $this->token = $token;
    }
    
    public function index() {
        $echoStr     = $_GET["echostr"];
        $nonce       = $_GET['nonce'];
        $signature   = $_GET['signature'];
        $timestamp   = $_GET['timestamp'];
        $token       = $this->token;
//        p($token);
//        die();
        $tmpArr = array($token, $timestamp, $nonce);

        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if ($tmpStr == $signature) {
            echo $echoStr;
            exit;
//            return ture;
        } else {
            $this->responseMsg();
        }
    }

    public function responseMsg() {
        //1.获取到微信推送过来post数据（xml格式）
        $postStr = $GLOBALS['HTTP_RAW_POST_DATA'];
        //2.处理消息类型，并设置回复类型和内容
        if (!empty($postStr)) {
            $postObj = simplexml_load_string($postStr,'SimpleXMLElement','LIBXML_NOCDATA');
            $fromUserName = $postObj->FromUserName;
        }
        // $postObj = simplexml_load_string($postArr);
        // if (strtolower($postObj->MsgType) == 'event') {
        //     //如果是关注 subscribe 事件
        //     if (strtolower($postObj->Event == 'subscribe')) {
        //         //回复用户消息(纯文本格式)	
        //         $toUser = $postObj->FromUserName;
        //         $fromUser = $postObj->ToUserName;
        //         $time = date('Y-m-d H:i:s');
        //         $msgType = 'text';
        //         // $content  = '欢迎你的关注！'.$postObj->FromUserName.'————'.'微信用户openid'.$postObj->ToUserName;
        //         $content = '欢迎你的关注！';
        //         $template = "<xml>
        //                     <ToUserName><![CDATA[%s]]></ToUserName>
        //                     <FromUserName><![CDATA[%s]]></FromUserName>
        //                     <CreateTime>%s</CreateTime>
        //                     <MsgType><![CDATA[%s]]></MsgType>
        //                     <Content><![CDATA[%s]]></Content>
        //                     </xml>";
        //         $info = sprintf($template, $toUser, $fromUser, $time, $msgType, $content);
        //         echo $info;
        //     }
        // }
        // //用户发送tuwen1关键字的时候，回复一个单图文
        // if (strtolower($postObj->MsgType) == 'text' && trim($postObj->Content) == '图文') {
        //     //数组中查询数据
        //     $arr = array(
        //         array(
        //             'title' => '慕课',
        //             'description' => "imooc is very cool",
        //             'picUrl' => 'http://www.imooc.com/static/img/common/logo.png',
        //             'url' => 'http://www.imooc.com',
        //         ),
        //         array(
        //             'title' => '百度',
        //             'description' => "hao123 is very cool",
        //             'picUrl' => 'https://www.baidu.com/img/bdlogo.png',
        //             'url' => 'http://www.百度.com',
        //         ),
        //         array(
        //             'title' => '腾讯qq',
        //             'description' => "qq is very cool",
        //             'picUrl' => 'http://www.imooc.com/static/img/common/logo.png',
        //             'url' => 'http://www.qq.com',
        //         ),
        //     );
        //     //实例化模型
        //     $indexModel = new \Home\Model\IndexModel;
        //     $indexModel->reponseMsg($postObj, $arr);
        //     //注意：进行多图文发送时，子图文个数不能超过10个
        // } else {
        //     switch (trim($postObj->Content)) {
        //         case 1:
        //             $content = '您输入的数字是1';
        //             break;
        //         case 2:
        //             $content = '您输入的数字是2';
        //             break;
        //         case 3:
        //             $content = '您输入的数字是3';
        //             break;
        //         case 4:
        //             $content = "<a href='http://www.imooc.com'>慕课</a>";
        //             break;
        //         case '5':
        //             $content = 'Test';
        //             break;
        //         case '英文':
        //             $content = 'imooc is ok';
        //             break;
        //         default:
        //             $content = '再试试其他的？比如1-5？';
        //             break;
        //         //a79124c4594c2e5a0799a39ea8f64c87
        //     }
        //     //实例化模型
        //     // $indexModel = new IndexModel;
        //     // $indexModel->reponseText($postObj,$content);
        //     $template = "<xml>
        //                 <ToUserName><![CDATA[%s]]></ToUserName>
        //                 <FromUserName><![CDATA[%s]]></FromUserName>
        //                 <CreateTime>%s</CreateTime>
        //                 <MsgType><![CDATA[%s]]></MsgType>
        //                 <Content><![CDATA[%s]]></Content>
        //                 </xml>";
        //     //注意模板中的中括号 不能少 也不能多
        //     $fromUser = $postObj->ToUserName;
        //     $toUser = $postObj->FromUserName;
        //     $time = time();
        //     // $content  = 'hello';
        //     $msgType = 'text';
        //     echo sprintf($template, $toUser, $fromUser, $time, $msgType, $content);
        // }
    }

}
