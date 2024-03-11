<?php
class MessageController extends Controller
{
 
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (Session::userIsLoggedIn()) {
            $this->View->render("messager/index", array(
                
            ));
        }
    }
}