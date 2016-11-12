<?php
/**
 * Created by PhpStorm.
 * User: haiye_000
 * Date: 12-Nov-16
 * Time: 8:55 PM
 */

namespace frontend\controllers;


class Curl
{
    public function curl($url,$type,$key=null) {
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec ($ch);
        curl_close($ch);
        return $result;
    }
}