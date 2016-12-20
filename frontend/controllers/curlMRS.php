<?php
/**
 * Created by PhpStorm.
 * User: haiye_000
 * Date: 12-Nov-16
 * Time: 8:55 PM
 */

namespace frontend\controllers;


class curlMRS
{
    public function get($url) {
        // Get cURL resource
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERPWD => "admin:Admin123",
            CURLOPT_HTTPHEADER, array('Content-Type:application/json'),
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ));
        // Send the request & save response to $resp
        $output = curl_exec($curl);
//        var_dump($curl); die();
        // Close request to clear up some resources
        curl_close($curl);
        return $output;
    }
    public function  create($person_data,$url){
        $person_curL = curl_init($url);
        curl_setopt($person_curL, CURLOPT_HTTPAUTH,CURLAUTH_BASIC);
        curl_setopt($person_curL, CURLOPT_USERPWD,"admin:Admin123");
//        curl_setopt($person_curL, CURLOPT_URL,$url);
        curl_setopt($person_curL, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($person_curL, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($person_curL, CURLOPT_POST,1);
        curl_setopt($person_curL, CURLOPT_POSTFIELDS,$person_data);
        $output   = curl_exec($person_curL);
        $status   = curl_getinfo($person_curL,CURLINFO_HTTP_CODE);
        curl_close($person_curL);
        return $status;
    }
    public function delete($url) {
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"DELETE");
        curl_setopt($ch, CURLOPT_USERPWD,"admin:Admin123");
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec ($ch);
        curl_close($ch);
        return $result;
    }
    public function curl_del($url, $json='')
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $result = json_decode($result);
        curl_close($ch);

        return $result;
    }


}