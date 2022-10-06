<?php

require_once("./Curl.php");

class Levi_WeiChat
{
    const APPID = 'wx7c7062e237c4eb65';
    const APPSECRET = '477ad1a6c01364f93eb16f72553ab527';

    const URL_LIST = array(
        'getAccessToken' => 'https://api.weixin.qq.com/cgi-bin/token',
        'getUserList'   => 'https://api.weixin.qq.com/cgi-bin/user/get',
        'sendTemplateMessage' => 'https://api.weixin.qq.com/cgi-bin/message/template/send',
    );

    public static function getAccessToken()
    {
        $params = [
            'grant_type' => 'client_credential',
            'appid' => self::APPID,
            'secret' => self::APPSECRET,
        ];

        $accessTokenInfo = Util_Curl::httpGet(self::URL_LIST['getAccessToken'], $params);

        return $accessTokenInfo['access_token'];
    }

    public static function getUserList($nextOpenId = '')
    {
        $params = [
            'access_token' => self::getAccessToken(),
        ];
        $userList = Util_Curl::httpGet(self::URL_LIST['getUserList'], $params);

        return $userList;
    }

    public static function sendTemplateMessage($content)
    {
        return Util_Curl::httpPost(self::URL_LIST['sendTemplateMessage'] . '?access_token=' . self::getAccessToken(), $content);
    }


}