$facebook = new \Facebook\Facebook([
  'app_id'      => '1261569467548769',
  'app_secret'     => '6f80e50dcd6a2cf5ed52e940ca3c4aa7',
  'default_graph_version'  => 'v2.10'
]);

$facebook_output ='';
$facebook_helper = $facebook->getRedirectLoginHelper();
if (isset($_GET['state'])) {
    $facebook_helper->getPersistentDataHandler()->set('state', $_GET['state']);
}

if(isset($_GET['code'])){
  if(isset($_SESSION['access_token'])){
    $access_token = $_SESSION['access_token'];
  }else{
    $access_token = $facebook_helper->getAccessToken();

    $_SESSION['access_token'] = $access_token;

    $facebook->setDefaultAccessToken($_SESSION['access_token']);
  }

  $_SESSION['user_id'] = '';
  $_SESSION['user_name'] = '';
  $_SESSION['user_email_address'] = '';
  $_SESSION['user_image'] = '';

  $graph_response = $facebook->get("/me?fields=name,email", $access_token);

  $facebook_user_info = $graph_response->getGraphUser();

  if(!empty($facebook_user_info['id'])){
    $_SESSION['user_image'] = 'http://graph.facebook.com/'.$facebook_user_info['id'].'/picture';
  }

  if(!empty($facebook_user_info['name'])){
    $_SESSION['user_name'] = $facebook_user_info['name'];
  }

  if(!empty($facebook_user_info['email'])){
    $_SESSION['user_email_address'] = $facebook_user_info['email'];
  }
}else{
  // Get login url
  $facebook_permissions = ['email']; // Optional permissions
  $facebook_login_url = $facebook_helper->getLoginUrl('https://dreamabroadbd.com/login', $facebook_permissions);
}

if(!isset($facebook_login_url))
{
  echo "<pre>";
  print_r($_SESSION['access_token']);
  echo "</pre>";

}
