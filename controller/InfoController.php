<?php

class InfoController
{

    public function __construct()
    {
    }

    public function index()
    {
        if (empty($_SESSION[ID_ROLE]) || $_SESSION[ID_ROLE] != '1') {
            require_once VINFO . 'php';
        }
    }
}