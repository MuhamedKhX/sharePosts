<?php




class Pages extends Controller
{

    public function __construct()
    {
        //init function
    }

    public function index()
    {
        $this->view('pages/Home');
    }

    public function about()
    {
        $this->view('pages/about');
    }

}