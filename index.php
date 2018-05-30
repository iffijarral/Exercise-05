<?php

//Defining
require_once __DIR__.'/vendor/autoload.php';
const CLIENT_ID = 'Your-Client_ID';
const CLIENT_SECRET = 'Your-Client_Secret';
const API_KEY = 'Your-API_Key';
const REDIRECT_URL = 'Your-Redirect_URL';

session_start();

// Initialization
$client = new Google_Client();
$client->setClientId(CLIENT_ID);
$client->setClientSecret(CLIENT_SECRET);
$client->setRedirectUri(REDIRECT_URL);
$client->setScopes(array(
'https://www.googleapis.com/auth/plus.me',
'https://www.googleapis.com/auth/plus.login' 
));

$plus = new Google_Service_Plus($client);

if(isset($_GET['code'])) {
	
	$client->authenticate($_GET['code']);
	
	$_SESSION['access_token'] = $client->getAccessToken();
	
	$redirect = 'http://'.$_server['HTTP_HOST'].$_SERVER['PHP_SELF'];
	
	header('Location:'.filter_var(REDIRECT_URL, FILTER_SANITIZE_URL));
}

if(isset($_SESSION['access_token']) && $_SESSION['access_token']) {
	
	header('Location: public/index.php');

} else {
	$authUrl = $client->createAuthUrl();
}
?>
<!-- HTML code with Embedded php -->
<div>
	<?php 
	
	if(isset($authUrl)){
		echo "<a class='login' href='".$authUrl."'><img src = 'signin_button.png' height='50px' /></a>";		
	} 
	
	?>
	
</div>	
