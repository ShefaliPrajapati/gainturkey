<?php
require_once('twexchange.php');
 
$consumerKey = 'Zk1pgYeaPGFhGDzZRQbvAw';
$consumerKeySecret = 'qqEV5dx1NfXFkDwxdwj5mx7F2zY5Jcjm6xnjtplmlUA';
$accessToken = '395839017-A1lVlw1uWXwDnzPFQuOBGGypMxYHLP3nrEICkyIs';
$accessTokenSecret = 'uOv1g3ecYJkA7AnLfEfUX1TzeogG0aNxhhAtM2oaTY86r';
 
$settings = array(
  'oauth_access_token' => $accessToken,
  'oauth_access_token_secret' => $accessTokenSecret,
  'consumer_key' => $consumerKey,
  'consumer_secret' => $consumerKeySecret
);
 
$i = 0;
$cursor = -1;
 
do {
  $url = 'https://api.twitter.com/1.1/direct_messages/new.format';
//  $url = 'https://api.twitter.com/1.1/followers/list.json';
  $getfield = '?screen_name=vinu_api&text=Hey%2C%20still%20ok%20for%20dinner%20tonight%3F';
//  $getfield = '?cursor='.$cursor.'&screen_name=vinumsc&skip_status=true&include_user_entities=false';
  $requestMethod = 'POST';
//  $requestMethod = 'GET';
  $twitter = new TwitterAPIExchange($settings);
  $response = $twitter->setGetfield($getfield)
                      ->buildOauth($url, $requestMethod)
                      ->performRequest();
 
  $response = json_decode($response, true);
  echo "<pre>";print_r($response);die;
 
  if (!empty($response["errors"])) {
  	$errors = $response["errors"];
    foreach($errors as $error){
      $code = $error['code'];
      $msg = $error['message'];
      echo "<br><br>Error " . $code . ": " . $msg;
    }
    $cursor = 0;
  }
  else {
    $users = $response['users'];
    foreach($users as $user){
      $thumb = $user['profile_image_url'];
      $url = $user['screen_name'];   
      $name = $user['name'];
      echo "<a title='" . $name . "' href='http://www.twitter.com/" . $url . "'>" . "<img src='" . $thumb . "' /></a>";
      $i++;
    }
    $cursor = $response["next_cursor"];
  }
}
while ( $cursor != 0 );
 
if (!empty($users)) {
  echo '<br><br>Total: ' . $i;
}
 
?>