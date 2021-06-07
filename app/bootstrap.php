<?php

//Load Config
require_once("config/config.php");

//Load helper
require_once('helpers/url_helper.php');
require_once('helpers/session_helper.php');

//Load User model to use static methods
require_once 'models/User.php';

//Load Libraries

spl_autoload_register(function ($ClassName)
{
    require_once('libraries/'. $ClassName .'.php');
});


