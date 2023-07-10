<?php

require_once 'config/Conexion.php';
require_once 'model/dto/LoginDTO.php';
//autor:Luis Byron Vargas Peñafiel

class UserDao
{
    private $con;
    private static $SELECT_ALL_USER = "SELECT * FROM users";
    private static $SELECT_ALL_ROLE = "SELECT * FROM roles";
    private static $GET_ONE_BY_ID = "SELECT * FROM users u WHERE u.id = :id";
    private static $LOGIN = "SELECT * FROM users u WHERE email = :email and password = :password";
    private static $CREATE_USER = "INSERT INTO users (username,firstname ,lastname, password, email, enabled, id_role) VALUES (:username,:firstname ,:lastname, :password, :email, :enable, :id_role) ";
    private static $UPDATE_USER = "UPDATE users SET username=:username, lastname=:lastname, password=:password, email=:email, enable=:email, id_role=:id_role)";

    public function __construct()
    {
        $this->con = Conexion::getConexion();
    }

    public function getAllUser()
    {
        $stmt = $this->con->prepare(UserDao::$SELECT_ALL_USER);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllRole()
    {
        $stmt = $this->con->prepare(UserDao::$SELECT_ALL_ROLE);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($id)
    {
        $stmt = $this->con->prepare(UserDao::$GET_ONE_BY_ID);
        $data = ["id" => $id];
        $stmt->execute($data);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser(UserDto $user)
    {
        try {
            $stmt = $this->con->prepare(UserDao::$CREATE_USER);
            $data = [
                "username" => $user->getUsername(),
                "firstname" => $user->getFirstname(),
                "lastname" => $user->getLastname(),
                "email" => $user->getEmail(),
                "password" => $user->getPassword(),
                "enable" => $user->getEnable(),
                "id_role" => $user->getIdRole(),
            ];
            $stmt->execute($data);
            return ($stmt->rowCount() > 0);
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function updateUser(UserDto $user)
    {
        try {
            $stmt = $this->con->prepare(UserDao::$UPDATE_USER);
            $data = [
                "id" => $user->getId(),
                "username" => $user->getUsername(),
                "firstname" => $user->getFirstname(),
                "lastname" => $user->getLastname(),
                "email" => $user->getEmail(),
                "password" => $user->getPassword(),
                "enable" => $user->getEnable(),
                "id_role" => $user->getIdRole(),
            ];
            $stmt->execute($data);
            return ($stmt->rowCount() > 0);
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }


    public function login(LoginDTO $loginDTO)
    {
        $stmt = $this->con->prepare(UserDao::$LOGIN);
        $data = [
            "email" => $loginDTO->getEmail(),
            "password" => $loginDTO->getPassword()];
        $stmt->execute($data);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
