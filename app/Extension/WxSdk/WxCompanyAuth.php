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

    public function __construct($corpid, $corpsecret, $agent_id)
    {
        $this->corpid = $corpid;
        $this->corpsecret = $corpsecret;
        $this->agent_id = $agent_id;
    }

    public function getCode($redirect_url)
    {
        $oauth2_code = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $this->corpid . "&redirect_uri=" . urlencode($redirect_url) . "&response_type=code&scope=snsapi_privateinfo&agentid=" . $this->agent_id . "&state=0#wechat_redirect";
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
        $user_ticket_url = "https://qyapi.weixin.qq.com/cgi-bin/user/getuserdetail?access_token=" . $access_token;
        $args['user_ticket'] = $user_ticket;
        $res = $this->postMessage($user_ticket_url, $args);
        $res = json_decode($res, true);
        dd($res);
        $result['nickname'] = $res['name'];
        $result['headimgurl'] = $res['avatar'];
        $result['name'] = $res['name'];
        $result['openid'] = $res['name'] . $res['userid'];
        $result['phone'] = $res['mobile'];
        $result['sex'] = $res['gender'];
        return $result;

    }

    public function getAccessToken()
    {
        $key = 'company_access_token' . $this->corpid;
        $token = cache($key);
        if (!$token) {
            $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=" . $this->corpid . "&corpsecret=" . $this->corpsecret;
            $json_result = $this->getCach($url);
            $arr_result = json_decode($json_result, true);
            $token = $arr_result['access_token'];
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
        $post_data = self::Array2Json($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
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

    static public function Array2Json($arr)
    {
        $parts = array();
        $is_list = false;
        $keys = array_keys($arr);
        $max_length = count($arr) - 1;
        if (($keys [0] === 0) && ($keys [$max_length] === $max_length)) {
            $is_list = true;
            for ($i = 0; $i < count($keys); $i++) {
                if ($i != $keys [$i]) {
                    $is_list = false;
                    break;
                }
            }
        }
        foreach ($arr as $key => $value) {
            if (is_array($value)) {
                if ($is_list)
                    $parts [] = self::array2Json($value);
                else
                    $parts [] = '"' . $key . '":' . self::array2Json($value);
            } else {
                $str = '';
                if (!$is_list)
                    $str = '"' . $key . '":';
                if (!is_string($value) && is_numeric($value) && $value < 2000000000)
                    $str .= $value;
                elseif ($value === false)
                    $str .= 'false';
                elseif ($value === true)
                    $str .= 'true';
                else
                    $str .= '"' . addcslashes($value, "\\\"\n\r\t/") . '"';
                $parts[] = $str;
            }
        }
        $json = implode(',', $parts);
        if ($is_list)
            return '[' . $json . ']';
        return '{' . $json . '}';
    }

}