<?php




class Pages extends Controller
{

    public function __construct()
    {
        //init function
    }

    public function index()
    {
        $this->view('Home');
    }

}