<?php

require_once("./WeiChat.php");
require_once("./Curl.php");

ini_set("display_errors", "On");

main();

function main()
{
    // $xingzuo = xingzuo();
    // $yunshi = $xingzuo['fortunetext']['all'];
    // $zhishu = '爱情指数'.$xingzuo['index']['health'].'工作指数'.$xingzuo['index']['discuss'];
    $birthDays = getBirthDays();
    $week = getWeek();
    $weather = getWeather();
	$love = getTogetherDays();
    // var_dump($xingzuo); die();
    ///$userList = [
    //    '11111111111111111111111',//wxid
   // ];
   $user = Levi_WeiChat::getUserList();
    $userList = $user['data']['openid'];

    foreach ($userList as $touser) {
        send($touser, $weather, $birthDays, $week, $love);
    }

}

function send($touser, $weather, $birthDays, $week, $love)
{
    $content = [
        'touser' => $touser,
        'template_id' => 'qDPrkqaRkqLD1c-g_hGg7h7a_U5-c1Gr8l4bC1RU_00',//模板ID
        'topcolor' => '#FF0000',
        'data' => [
            'date' => [
                'value' => date('Y年n月j日'),
                 'color' => '#ff0060'
            ],
			'week' => [
                'value' => '星期'.$week,
                 'color' => '#ff0060'
            ],
            'province' => [
                'value' => $weather['info']['data'],
                 'color' => '#ff55ff'
            ],
            'city' => [
                'value' => $weather['city'],
                'color' => '#ff0060',
            ],
            'weather' => [
                'value' => $weather['info']['type'],
                'color' => '#ff0060'
            ],
            'high' => [
                'value' => $weather['info']['high'],
                'color' => '#4d79ff',
            ],
            'low' => [
                'value' => $weather['info']['low'],
                'color' => '#4d79ff',
            ],
            'tip' => [
                'value' => $weather['info']['tip'],
                'color' => '#0011ff',
            ],
            'shengri' => [
                'value' => $birthDays,
                 'color' => '#ff0060'
            ],
            'xingzuo' => [
                'value' => '[话]'.hua(),
                 'color' => '#C70085'
            ],
            'love' => [
                'value' => $yunshi,
                 'color' => '#0085cc'
            ]
        ],
    ];
    $res = Levi_WeiChat::sendTemplateMessage(json_encode($content));
    var_dump($res);
}

function getWeek()
{
    $w = date('w');
    $week = array(
        "0" => "日",
        "1" => "一",
        "2" => "二",
        "3" => "三",
        "4" => "四",
        "5" => "五",
        "6" => "六"
    );
    return $week[$w];
}

function getBirthDays()
{
    $date1 = date_create("2023-1-1");//下一个阳历生日
    $date2 = date_create(date('Y-m-d'));
    $interval = date_diff($date2,$date1);
    return $interval->format('%a');
}

function getTogetherDays()
{
    $earlier = new DateTime("2022-07-01");//在一起的阳历时间
    $later = new DateTime(date('Y-m-d'));
    $diff = $later->diff($earlier)->format("%a");
    return $diff + 1;
}

function getWeather()
{
    $getWeather = Util_Curl::httpGet('https://api.vvhan.com/api/weather', ['city' => '北京']);
    return $getWeather;
}

function hua()
{
    $hua= Util_Curl::httpGet('https://api.vvhan.com/api/love', ['type' => 'json']);
    return $hua['ishan'];
}
