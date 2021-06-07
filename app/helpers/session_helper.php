<?php
session_start();

function flash($name = '', $msg = '', $class = 'alert alert-success')
{
    if(!empty($name))
    {
        if(!empty($msg) && empty($_SESSION['name']))
        {
            if(!empty($_SESSION['name']))
                unset($_SESSION['name']);

            if(!empty($_SESSION[$name . '_Class']))
                unset($_SESSION[$name . '_Class']);


            $_SESSION['name'] = $msg;
            $_SESSION[$name . '_Class'] = $class;
        }
        elseif (empty($msg) && !empty($_SESSION['name']))
        {
            $class = !empty($_SESSION[$name . '_Class']) ? $_SESSION[$name . '_Class'] : '';
            echo '<div class="' . $class .'" id="msg-flash">'. $_SESSION['name'] .'</div>';
            unset($_SESSION['name']);
            unset($_SESSION[$name . '_Class']);

        }
    }
}

 function isSignedIn()
{
    if(isset($_SESSION['user_id']))
    {
        return true;
    }
    else
    {
        return false;
    }
}
