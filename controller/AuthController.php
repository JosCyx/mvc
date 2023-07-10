<?php
require_once 'model/dao/UserDao.php';
require_once 'model/dto/UserDto.php';
require_once 'model/dto/LoginDTO.php';
require_once 'model/dto/RoleDto.php';
class AuthController
{
    private $model;

    public function __construct()
    {
        $this->model = new UserDao();
    }

    public function index(){
        require_once VAUTH . 'login.php';
    }

    public function login(){
        if (!$_SERVER['REQUEST_METHOD'] == 'POST') {
            return;
        }
        $login = new LoginDTO();

        $login->setEmail(htmlentities($_POST['email']));
        $login->setPassword(htmlentities($_POST['password']));

        $user = $this->model->login($login);

        if ($user) {
            session_start();
            $_SESSION[NAME_USER] = $user["firstname"];
            $_SESSION[ID_USER] = $user["id"];
            $_SESSION[ID_ROLE] = $user["id_role"];
            header("Location:index.php");
        } else {
            header("Location:index.php?c=auth&f=index");
        }

    }

    public function register(){
        require_once VAUTH . 'register.php';
    }


    public function logout(){
        session_destroy();
        header("Location: index.php");
    }
    
    
    public function createUser(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new UserDto();
            $user->setUsername(htmlentities($_POST['username']));
            $user->setFirstName(htmlentities($_POST['firstname']));
            $user->setLastname(htmlentities($_POST['lastname']));
            $user->setEmail(htmlentities($_POST['email']));
            $user->setPassword(htmlentities($_POST['password']));
            $user->setEnable(1);
            $user->setIdRole(2);
            $exito = $this->model->createUser($user);

            $msj = 'Registrado exitoso!';
            $color = 'primary';
            if (!$exito) {
                $msj = "No se pudo realizar el guardado";
                $color = "danger";
            }else{
                $_SESSION[NAME_USER] = $user->getFirstname();
                $_SESSION[ID_ROLE] = $user->getIdRole();
            }
            if (!isset($_SESSION)) {
                session_start();
            };
            $_SESSION['mensaje'] = $msj;
            $_SESSION['color'] = $color;
            //llamar a la vista
            header('Location:index.php');
            
            
        }
        
    }
}