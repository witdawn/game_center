<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2018/4/21
 * Time: 20:46
 */

namespace App\Extension\WxSdk;

class WxCompanyAuth
{
    private $corpid;
    private $corpsecret;
    private $agent_id;

    public function __construct($corpid, $corpsecret,$agent_id)
    {
        $this->corpid = $corpid;
        $this->corpsecret = $corpsecret;
        $this->agent_id = $agent_id;
    }

    public function getCode($redirect_url)
    {
        $oauth2_code = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $this->corpid . "&redirect_uri=" . urlencode($redirect_url) . "&response_type=code&scope=snsapi_privateinfo&agentid=".$this->agent_id."&state=0#wechat_redirect";
        return redirect($oauth2_code);
    }


    public function getUserInfo($code)
    {
        $access_token = $this->getAccessToken();
        //获取用户基本信息的接口url
        $get_user_info_url = "https://qyapi.weixin.qq.com/cgi-bin/user/getuserinfo?access_token=" . $access_token . "&code=" . $code;
        $userinfo_json = $this->getCach($get_user_info_url);
        $userinfo_arr = json_decode($userinfo_json, true);
        $user_ticket = $userinfo_arr['user_ticket'];
        var_dump($access_token);
        echo '</br>';
        var_dump($user_ticket);
        echo '</br>';
        $user_ticket_url = "https://qyapi.weixin.qq.com/cgi-bin/user/getuserdetail?access_token=" . $access_token;
        $res = $this->postMessage($user_ticket_url, http_build_query(['user_ticket' => $user_ticket]));
        $res=json_decode($res,true);
        dd($res);
        $result['nickname']=$res['name'];
        $result['headimgurl']=$res['avatar'];
        $result['name']=$res['name'];
        $result['openid']=$res['name'].$res['userid'];
        $result['phone']=$res['mobile'];
        $result['sex']=$res['gender'];
        return $result;

    }

    public function getAccessToken()
    {
        $key = 'company_access_token' . $this->corpid;
        $token = cache($key);
        if (!$token) {
            $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=" . $this->corpid . "&corpsecret=" . $this->corpsecret;
            $json_result = $this->getCach($url);
            $arr_result = json_decode($json_result,true);
            $token=$arr_result['access_token'];
            cache([$key => $token], 60);
        }
        return $token;
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

}