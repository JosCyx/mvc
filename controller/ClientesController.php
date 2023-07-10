<?php
//autor:LOOR LALAMA JANEOR OSCAR
require_once 'model/dao/ClientesDAO.php';
require_once 'model/dto/Cliente.php';

class ClientesController {
    private $cliente;
 
    public function __construct() {
        $this->cliente = new ClientesDAO();
    }

    
    // funciones del controlador
    public function index() {
     
        //comunica con el modelo (enviar datos o obtener datos)
        $resultados = $this->cliente->selectAll("");
        // comunicarnos a la vista
        $titulo="Buscar clientes";
        require_once VCLIENTES.'list.php';
      
        
      }
  
      public function search(){
        // lectura de parametros enviados
        $parametro = (!empty($_POST["b"]))?htmlentities($_POST["b"]):"";
       //comunica con el modelo (enviar datos o obtener datos)
        $resultados = $this->cliente->selectAll($parametro);
       // comunicarnos a la vista
       $titulo="Buscar clientes";
       require_once VCLIENTES.'list.php';
      }
  
      // muestra el formulario de nuevo producto
      public function view_new(){
            //comunicarse con el modelo
            $resultados = $this->cliente->selectAll("");
  
            // comunicarse con la vista
            $titulo="Nuevo cliente";
            require_once VCLIENTES.'nuevo.php';
  
      }
  
      // lee datos del formulario de nuevo producto y lo inserta en la bdd (llamando al ClientesDAOo)
      public function new() {
        //cuando la solicitud es por post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // leer parametros
            $clien = new Cliente();
            $clien->setId(htmlentities($_POST['id']));
            $clien->setNombre(htmlentities($_POST['nombre']));
            $clien->setApellido(htmlentities($_POST['apellido']));
            $clien->setRol(htmlentities($_POST['rol']));
            $clien->setCorreoElectronico(htmlentities($_POST['correo']));
            $clien->setTelefono(htmlentities($_POST['telefono']));
    
            // actualizar el cliente
            $exito = $this->cliente->insert($clien);
    
            // establecer un mensaje y color de acuerdo al éxito de la actualización
            if ($exito) {
                $msj = 'Cliente guardado exitosamente';
                $color = 'primary';
            } else {
                $msj = "No se pudo realizar el guardado";
                $color = "danger";
            }
    
            // almacenar el mensaje y color en la sesión para su posterior visualización
            if(!isset($_SESSION)) { session_start(); }
            $_SESSION['mensaje'] = $msj;
            $_SESSION['color'] = $color;
    
            // redirigir al usuario a la página de detalle del cliente actualizado
            header('Location:index.php?c=clientes&f=index&id=');
        }
    }
    
    public function delete(){
        //leer parametros
        $clien = new Cliente();
        $clien->setId(htmlentities($_REQUEST['id']));
        $clien->setNombre('nombre');
    
        //comunicando con el modelo
        $exito = $this->cliente->delete($clien);
        $msj = 'Cliente eliminado exitosamente';
        $color = 'primary';
        if (!$exito) {
            $msj = "No se pudo eliminar el cliente";
            $color = "danger";
        }
    
        if(!isset($_SESSION)){ session_start();};
        $_SESSION['mensaje'] = $msj;
        $_SESSION['color'] = $color;
        //llamar a la vista
        header('Location:index.php?c=clientes&f=index');
    }
  
  
     // muestra el formulario de editar producto
     public function view_edit(){
       //leer parametro
       $id= $_REQUEST['id']; // verificar, limpiar
       //comunicarse con el ClientesDAOo de clientes
      $clien = $this->cliente->selectOne($id);
  
      // comunicarse con la vista
      $titulo="Editar cliente";
      require_once VCLIENTES.'edit.php';
  
    }
  
     // lee datos del formulario de editar producto y lo actualiza en la bdd (llamando al ClientesDAOo)
     public function edit(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // leer parametros
            $clien = new Cliente();
            $clien->setId(htmlentities($_POST['id']));
            $clien->setNombre(htmlentities($_POST['nombre']));
            $clien->setRol(htmlentities($_POST['rol']));
            $clien->setCorreoElectronico(htmlentities($_POST['correo']));
            $clien->setTelefono(htmlentities($_POST['telefono']));
    
            // actualizar el cliente
            $exito = $this->cliente->update($clien);
    
            // establecer un mensaje y color de acuerdo al éxito de la actualización
            if ($exito) {
                $msj = 'Cliente actualizado exitosamente';
                $color = 'primary';
            } else {
                $msj = "No se pudo realizar la actualizacion";
                $color = "danger";
            }
    
            // almacenar el mensaje y color en la sesión para su posterior visualización
            if(!isset($_SESSION)) { session_start(); }
            $_SESSION['mensaje'] = $msj;
            $_SESSION['color'] = $color;
    
            // redirigir al usuario a la página de detalle del cliente actualizado
            header('Location:index.php?c=clientes&f=index');
        }
    }
    
  }

?>

