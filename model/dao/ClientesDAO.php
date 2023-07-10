<?php
//autor:LOOR LALAMA JANEOR OSCAR
require_once 'config/Conexion.php';

class ClientesDAO {
    private $cln;

    public function __construct() {
        $this->cln = Conexion::getConexion();
    }

    public function selectAll($parametro) {
        // sql de la sentencia
      $sql = "SELECT * FROM clientes  where id > 0 and 
      nombre like :b1 or rol like :b2";
      $stmt = $this->cln->prepare($sql);
      // preparar la sentencia
      $clnlike = '%' . $parametro . '%';
      $data = array('b1' => $clnlike,'b2' => $clnlike );
      // ejecutar la sentencia
      $stmt->execute($data);
      //recuperar  resultados
      $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
      //retornar resultados
      return $resultados;
  }

  public function selectOne($id) { // buscar un producto por su id
    $sql = "select * from clientes where ".
    "id=:id";
    // preparar la sentencia
    $stmt = $this->cln->prepare($sql);
    $data = ['id' => $id];
    // ejecutar la sentencia
    $stmt->execute($data);
    // recuperar los datos (en caso de select)
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);// fetch retorna el primer registro
    // retornar resultados
    return $cliente;
}

    public function insert($clien){
        try{

            $sql = "SELECT MAX(id) as max_id FROM clientes";
            $sentencia = $this->cln->prepare($sql);
            $sentencia->execute();
            $max_id = $sentencia->fetch()['max_id'];
            $next_id = $max_id + 1;

        //sentencia sql
        $sql = "INSERT INTO clientes (id, nombre,  apellido, telefono, 
        correo_electronico, rol) VALUES 
        (:id, :nom, :ape, :tel, :corr, :rol)";

        //bind parameters
        $sentencia = $this->cln->prepare($sql);
        $data = [
        'id' => $next_id,
        'nom' =>  $clien->getNombre(),
        'ape' =>  $clien->getApellido(),
        'tel' =>  $clien->getTelefono(),
        'corr' =>  $clien->getCorreoElectronico(),
        'rol' =>  $clien->getRol()
        ];
        //execute
        $sentencia->execute($data);
        //retornar resultados, 
        if ($sentencia->rowCount() <= 0) {// verificar si se inserto 
        //rowCount permite obtner el numero de filas afectadas
           return false;
        }
    }catch(Exception $e){
        echo $e->getMessage();
        return false;
    }
        return true;
    }

    public function update($clien){
        try {
            // prepare
            $sql = "UPDATE clientes SET nombre=:nom, telefono=:tel, correo_electronico=:corr, rol=:rol WHERE id=:id";
            // bind parameters
            $sentencia = $this->cln->prepare($sql);
            $data = [
                'id' =>  $clien->getId(),
                'nom' =>  $clien->getNombre(),
                'tel' =>  $clien->getTelefono(),
                'corr' =>  $clien->getCorreoElectronico(),
                'rol' =>  $clien->getRol()
            ];
            // execute
            $sentencia->execute($data);
            // verificar si se actualizó alguna fila
            if ($sentencia->rowCount() <= 0) {
                return false;
            }
        } catch(Exception $e){
            // proporcionar una respuesta de error más precisa
            throw new Exception('Error al actualizar el cliente: ' . $e->getMessage());
        }
        return true;       
    }

   public function delete($clien){
   try{
        //prepare
        $sql = "DELETE FROM clientes WHERE nombre=:nombre or id=:id";
        //bind parameters
        $sentencia = $this->cln->prepare($sql);
        $data = [
            'id' => $clien->getId(),
            'nombre' => $clien->getNombre()     
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

