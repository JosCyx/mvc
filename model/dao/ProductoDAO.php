<?php
//autor: Moreno Bravo Jose
require_once 'config/Conexion.php';

class ProductoDAO {
    private $pdr;

    static private $getAll = "select * from productos";

    public function __construct() {
        $this->pdr = Conexion::getConexion();
    }

    public function getAll()
    {
        $stmt = $this->pdr->prepare(ProductoDAO::$getAll);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectAll($parametro) {
        $sql = "SELECT * FROM productos  where id > 0 and 
        nombre like :b1 or codigo like :b2";
        $stmt = $this->pdr->prepare($sql);
        $clnlike = '%' . $parametro . '%';
        $data = array('b1' => $clnlike,'b2' => $clnlike );
        $stmt->execute($data);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;
    }

    public function selectOne($id) {
        $sql = "select * from productos where ".
        "id=:id";
        $stmt = $this->pdr->prepare($sql);
        $data = ['id' => $id];
        $stmt->execute($data);
        $producto1 = $stmt->fetch(PDO::FETCH_ASSOC);
        return $producto1;
    }

    public function insert($prod){
        try{

            $sql = "SELECT MAX(id) as max_id FROM productos";
            $sentencia = $this->pdr->prepare($sql);
            $sentencia->execute();
            $max_id = $sentencia->fetch()['max_id'];
            $next_id = $max_id + 1;

            
            $sql = "INSERT INTO productos (id, codigo,  nombre, descripcion, 
            valor, disponibilidad) VALUES 
            (:id, :cod, :nom, :descp, :val, :disp)";

            
            $sentencia = $this->pdr->prepare($sql);
            $data = [
            'id' => $next_id,
            'cod' =>  $prod->getCodigo(),
            'nom' =>  $prod->getNombre(),
            'descp' =>  $prod->getDescripcion(),
            'val' =>  $prod->getValor(),
            'disp' => $prod->getDisponibilidad()
            ];
            
            $sentencia->execute($data);

            
            if ($sentencia->rowCount() <= 0) {
            return false;
            }
        }catch(Exception $e){
            echo $e->getMessage();
            return false;
        }
        return true;
    }

    public function update($prod){
        try {
            
            $sql = "UPDATE productos SET codigo=:cod, nombre=:nom, descripcion=:descp, valor=:val, disponibilidad=:disp WHERE id=:id";
            
            $sentencia = $this->pdr->prepare($sql);
            $data = [
                'id' =>  $prod->getId(),
                'cod' =>  $prod->getCodigo(),
                'nom' =>  $prod->getNombre(),
                'descp' =>  $prod->getDescripcion(),
                'val' =>  $prod->getValor(),
                'disp' => $prod->getDisponibilidad()
            ];
            
            $sentencia->execute($data);
            
            if ($sentencia->rowCount() <= 0) {
                return false;
            }
        } catch(Exception $e){
            throw new Exception('Error al actualizar el producto: ' . $e->getMessage());
        }
        return true;       
    }

    public function delete($prod){
        try{ 
            $sql = "DELETE FROM productos WHERE nombre=:nombre or id=:id";
            $sentencia = $this->pdr->prepare($sql);
            $data = [
                'id' => $prod->getId(),
                'nombre' => $prod->getNombre()     
            ];
                
            $sentencia->execute($data);
                
            if ($sentencia->rowCount() <= 0) {
                return false;
            }
        } catch(Exception $e){
            echo $e->getMessage();
            return false;
        }
        return true;
    }
    
}?>

