<?php

require_once 'config/config.php';
class FrontController {
    public function ruteo()
    {
        session_start();

        if (!isset($_SESSION[NAME_USER]) || !isset($_SESSION[ID_ROLE])) {
            $controlador =  AUTH_CONTROLLER ;
        }else{
            $controlador = (!empty($_REQUEST['c'])) ? htmlentities($_REQUEST['c']) : HOME_CONTROLLER;
        }
        $controlador = ucwords(strtolower($controlador)) . "Controller";


        $funcion = (!empty($_REQUEST['f'])) ? htmlentities($_REQUEST['f']) : FUNCION_PRINCIPAL;


        require_once 'controller/' . $controlador . '.php';
        $cont = new  $controlador();
        $cont->$funcion();
    }

}
?>