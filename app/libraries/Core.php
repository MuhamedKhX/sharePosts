<?php

/*
 * App Core Class
 * Creates URL & Load Core Controller
 * URL FORMAT - /Controller/method/params
 * */

class Core
{
    protected $CurrentController = 'Pages';
    protected $CurrentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->getUrl();


        if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php'))
        {

            $this->CurrentController = ucwords($url[0]);
            unset($url[0]);

            $this->requireController($url);
        } else if(empty($url))
        {
            $CurrentController = 'Pages';
            $this->requireController($url);
        }
        else
        {
            die("Controller dos not found");
        }

    }

    public function requireController($url)
    {
        //require Controller
        require_once '../app/controllers/' . $this->CurrentController . '.php';

        //init the Controller
        $this->CurrentController = new $this->CurrentController;

        //set currentMethod
        if(isset($url[1]))
        {
            if(method_exists($this->CurrentController, $url[1]))
            {
                $this->CurrentMethod = $url[1];
                unset($url[1]);
            }
        }

        //set params
        $this->params = $url ? array_values($url) : [];

        //call the function and send params
        call_user_func_array([$this->CurrentController, $this->CurrentMethod], $this->params);
    }

    public function getUrl()
    {
        if(isset($_GET['url']))
        {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}