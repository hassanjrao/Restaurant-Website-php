<?php

//start session on web page

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('283916112555-00mhima8spdbsv1t2dmule7h4flac4sa.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('qO8TCCXhncLw-QolVRWvfmGZ');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/woopyzz/g-callback.php');

/// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');


// facebook

// Call Facebook API

$facebook = new \Facebook\Facebook([
    'app_id'      => '799817377458281',
    'app_secret'     => '6c1be575e7f535374078accab0e1be87',
    'default_graph_version'  => 'v2.0'
]);

?>
<!-- Close your php here  -->