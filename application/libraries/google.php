<?php

require_once "google/Google_Client.php";
require_once "google/contrib/Google_Oauth2Service.php";
class Google extends Google_Client{
    var $oauth;
    public function __construct($config = array()) {
        parent::__construct($config);
        //$this->oauth = new Google_Oauth2Service($this);
    }
}