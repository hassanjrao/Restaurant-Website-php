<?php

require_once 'vendor/autoload.php';

if (!session_id())
{
    session_start();
}

// Call Facebook API

$facebook = new \Facebook\Facebook([
  'app_id'      => '799817377458281',
  'app_secret'     => '6c1be575e7f535374078accab0e1be87',
  'default_graph_version'  => 'v5.7.0'
]);

?>