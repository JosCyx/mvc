<?php
// autor: jose luis sellan
// ...
// dao data access object
require_once 'config/Conexion.php';

class ServiciosDAO {
    static private $getAll = "select * from servicios";
    private $cln;

    public function __construct() {
        $this->cln = Conexion::getConexion();
    }

    public function getAll()
    {
        $stmt = $this->cln->prepare(ServiciosDAO::$getAll);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectAll($parametro) {
        $sql = "SELECT * FROM servicios WHERE id > 0 AND 
        (nombre LIKE :b1 OR descripcion LIKE :b2)";
        $stmt = $this->cln->prepare($sql);
        $clnlike = '%' . $parametro . '%';
        $data = array('b1' => $clnlike, 'b2' => $clnlike);
        $stmt->execute($data);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;
    }

    public function selectOne($id) {
        $sql = "SELECT * FROM servicios WHERE id=:id";
        $stmt = $this->cln->prepare($sql);
        $data = ['id' => $id];
        $stmt->execute($data);
        $servicio1 = $stmt->fetch(PDO::FETCH_ASSOC);
        return $servicio1;
    }

    public function insert($servicio) {
        try {
            $sql = "SELECT MAX(id) as max_id FROM servicios";
            $sentencia = $this->cln->prepare($sql);
            $sentencia->execute();
            $max_id = $sentencia->fetch()['max_id'];
            $next_id = $max_id + 1;
            $sql = "INSERT INTO servicios (id, nombre, descripcion, precio) VALUES 
            (:id, :nom, :desc, :precio)";
            $sentencia = $this->cln->prepare($sql);
            $data = [
                'id' => $next_id,
                'nom' =>  $servicio->getNombre(),
                'desc' =>  $servicio->getDescripcion(),
                'precio' =>  $servicio->getPrecio()
            ];
            $sentencia->execute($data);
            if ($sentencia->rowCount() <= 0) {
                return false;
            }
        } catch(Exception $e) {
            echo $e->getMessage();
            return false;
        }
        return true;
    }

    public function update($servicio) {
        try {
            $sql = "UPDATE servicios SET nombre=:nom, descripcion=:descp, precio=:precio WHERE id=:id";
            $sentencia = $this->cln->prepare($sql);
            $data = [
                'id' =>  $servicio->getId(),
                'nom' =>  $servicio->getNombre(),
                'descp' =>  $servicio->getDescripcion(),
                'precio' =>  $servicio->getPrecio()
            ];
            $sentencia->execute($data);
            if ($sentencia->rowCount() <= 0) {
                return false;
            }
        } catch(Exception $e){
            throw new Exception('Error al actualizar el servicio: ' . $e->getMessage());
        }
        return true;
    }

    public function delete($serv) {
        try{
            $sql = "DELETE FROM servicios WHERE nombre=:nombre OR id=:id";
            $sentencia = $this->cln->prepare($sql);
            $data = [
                'id' => $serv->getId(),
                'nombre' => $serv->getNombre()     
            ];
            //execute
            $sentencia->execute($data);
            //retornar resultados
            if ($sentencia->rowCount() <= 0) {// verificar si se eliminó alguna fila
                return false;
            }
        } catch(Exception $e){
            echo $e->getMessage();
            return false;
        }
        return true;
    }
}

?>
