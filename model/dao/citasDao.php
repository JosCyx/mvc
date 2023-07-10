<?php
//autor:Miño Figueroa Bryan
require_once "config/Conexion.php";
require_once "model/dto/citasDto.php";
class citasDao
{
    private $con;
    static private $getAll = "SELECT * FROM citas";
    static private $create = "INSERT INTO citas (duenio, nmascotas,edad, celular, fecha) VALUES ( :duenio, :nmascotas,:edad, :celular, :fecha)";
    static private $update = "UPDATE citas SET duenio =:duenio, nmascotas =:nmascotas,edad =:edad, celular =:celular,fecha =:fecha WHERE id =:id";
    static private $getById = "SELECT * FROM citas WHERE  id= :id";
    static private $delete = "DELETE FROM citas WHERE id = :id";

    public function __construct()
    {
        $this->con = Conexion::getConexion();
    }

    public function getById($id)
    {
        $stmt = $this->con->prepare(citasDao::$getById);
        $data = ["id" => $id];
        $stmt->execute($data);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function selectAll($para) {
        $getByduenio ="SELECT * FROM citas WHERE UPPER(duenio) LIKE UPPER('%".$para."%') OR duenio = '".$para."'";
        //Comando JS para mostrar el valor de la variable $getByduenio
        //alert("getByduenio: "+$getByduenio);
        $stmt = $this->con->prepare($getByduenio);
        //$data = ['duenio'=>'%' . $para . '%'];
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
        $stmt = $this->con->prepare(citasDao::$delete);
        $data = ["id" => $id];
        return $stmt->execute($data);
    }

    
    public function update($citas){
        try {
            // bind parameters
            $stmt = $this->con->prepare(citasDao::$update);
            $data = [
                'id' =>  $citas->getid(),
                'duenio' =>  $citas->getduenio(),
                'nmascotas' =>  $citas->getnmascotas(),
                'edad' =>  $citas->getedad(),
                'celular' =>  $citas->getcelular(),
                'fecha' =>  $citas->getfecha()
            ];
            // execute
            $stmt->execute($data);
            // verificar si se actualizó alguna fila
            if ($stmt->rowCount() <= 0) {
                return false;
            }
        } catch(Exception $e){
            // proporcionar una respuesta de error más precisa
            throw new Exception('Error al actualizar el cliente: ' . $e->getMessage());
        }
        return true;       
    }


    public function getAll()
    {
        $stmt = $this->con->prepare(citasDao::$getAll);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert(citasDto $citas)
    {
        try {
            $stmt = $this->con->prepare(citasDao::$create);
            $data = [
                "duenio" => $citas->getduenio(),
                "nmascotas" => $citas->getnmascotas(),
                "edad" => $citas->getedad(),
                "celular" => $citas->getcelular(),
                "fecha" => $citas->getfecha(),
            ];
            $stmt->execute($data);
            return ($stmt->rowCount() > 0);
        } catch (Exception $e) {
            $e->getMessage();
            return false;
        }
    }

}
?>