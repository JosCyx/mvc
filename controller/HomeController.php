<?php
class HomeController
{

    public function __construct()
    {
    }

    public function index()
    {
        if (empty($_SESSION[ID_ROLE]) || $_SESSION[ID_ROLE] == '1') {
            require_once VHOME . '.admin.php';
        }else if(empty($_SESSION[ID_ROLE]) || $_SESSION[ID_ROLE] == '2'){
            require_once VHOME . 'View.php';
        }else{
            require_once VHOME . 'vet.php';
        }
    }
}