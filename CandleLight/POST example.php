<?php
/**
 * Created by PhpStorm.
 * User: Oualid
 * Date: 8/06/2015
 * Time: 16:04
 */

$apiKey = "test";
$sig = hash_hmac("sha256", "first-name=oualid&last-name=yousfi&country=belgie&email=oualid%40yousfi.com&password=oualid", $apiKey);

$url = "http://localhost:8080/CandleLight/api/users";
$data = array('first-name' => 'oualid', 'last-name' => 'yousfi', 'country' => 'belgie',
    'email' => 'oualid@yousfi.com', 'password' => 'oualid', 'user-email' => 'test@test.com', 'signature' => $sig);

$options = array('http' => array(
    'header' => 'Content-type: application/x-www-form-urlencoded',
    'method' => 'POST',
    'content' => http_build_query($data)));

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

print_r($result);