<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2018/4/21
 * Time: 20:46
 */

namespace App\Extension\WxSdk;

use App\Exceptions\GeneralException;

class GetAuth
{
    private $appId;
    private $appSecret;

    public function __construct($appId, $appSecret)
    {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
    }

    public function getCode($redirecturl)
    {
        $oauth2_code = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $this->appId . "&redirect_uri=" . urlencode($redirecturl) . "&response_type=code&scope=snsapi_userinfo&state=0#wechat_redirect";
        return redirect($oauth2_code);
    }

    public static function test()
    {
        return redirect('http://www.baidu.com');
    }

    public function getUserInfo($code)
    {

        $get_access_token_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=" . $this->appId . "&secret=" . $this->appSecret . "&code=" . $code . "&grant_type=authorization_code";
        $json_result = $this->getCach($get_access_token_url);
        $arr_result = json_decode($json_result, true);
        if(!isset($arr_result['access_token']))
        {
            throw new GeneralException('授权异常');
        }
        $access_token = $arr_result['access_token'];
        $open_id = $arr_result['openid'];

        //获取用户基本信息的接口url
        $get_user_info_url = "https://api.weixin.qq.com/sns/userinfo?access_token=" . $access_token . "&openid=" . $open_id;
        $userinfo_json = $this->getCach($get_user_info_url);
        $userinfo_arr = json_decode($userinfo_json, true);
        return $userinfo_arr;
    }


    /**
     * post方式提交数据
     *
     * @param $url
     * @param $data
     *
     * @return object 返回提交后返回的json对象数据
     */
    function postMessage($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE
                                                 5.01 ; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $info = curl_exec($ch);                               //将执行返回的数据保存到临时变量
        if (curl_errno($ch)) {                                //判断数据在执行过程中是否有错误
            echo 'Errno' . curl_error($ch);

        }
        curl_close($ch);
        return $info;
    }


    /**
     * get方式获取数据 , 通过curl
     *
     * @param $url
     *
     * @return object 返回获取json对象数据
     */
    function getCach($url)
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1)
                                           AppleWebKit/537.11 ( KHTML , like Geko ) Chrome/23.0.1271.1 Safari/537.11');
        $res = curl_exec($ch);
        $rescode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $res;

    }

    /**
     * get方式获取数据
     *
     * @param $url
     *
     * @return object 返回读取的数据
     */
    function getFileGetContent($url)
    {
        $result = file_get_contents($url);
        return $result;
    }

    /**
     * 格式输出调试信息
     *
     */
    function p($arr)
    {
        var_dump($arr);
    }
}