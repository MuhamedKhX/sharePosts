<?php

//Load Config
require_once("config/config.php");

//Load Libraries

spl_autoload_register(function ($ClassName)
{
    require_once('libraries/'. $ClassName .'.php');
});