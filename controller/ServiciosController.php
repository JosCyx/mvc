
<?php
// autor: jose luis sellan
// ...
require_once 'model/dao/ServiciosDAO.php';
require_once 'model/dto/serviciosdto.php';

class ServiciosController {
    private $model;
    private $servicio;
 
    public function __construct() {
        $this->servicio = new ServiciosDAO();
    }

    // funciones del controlador
    /*public function index() {
     
        //comunica con el modelo (enviar datos o obtener datos)
        $resultados = $this->servicio->selectAll("");
        // comunicarnos a la vista
        $titulo="Buscar servicio";
        require_once VSERVICIOS.'list.php';
      }
      
      if (empty($_SESSION[ID_ROLE]) || $_SESSION[ID_ROLE] != '1') {
        require_once VSERVICIOS .'user.php' ;
    }else{
        require_once VSERVICIOS . 'list.php';
    }*/

    public function index() {

        $this->model=new ServiciosDAO();
        $resultados = $this->model->getAll();
        $servicio = $this->servicio;
        if (empty($_SESSION[ID_ROLE]) || $_SESSION[ID_ROLE] == '2') {
            require_once VSERVICIOS . 'user.php';
        }else{
            require_once VSERVICIOS . 'list.php';
        }
      
        
    }

      public function search(){
        // lectura de parametros enviados
        $parametro = (!empty($_POST["b"]))?htmlentities($_POST["b"]):"";
       //comunica con el modelo (enviar datos o obtener datos)
        $resultados = $this->servicio->selectAll($parametro);
       // comunicarnos a la vista
       $titulo="Buscar servicio";
       require_once VSERVICIOS.'list.php';
      }
  
      // muestra el formulario de nuevo producto
      public function view_new(){
        //comunicarse con el modelo
        $resultados = $this->servicio->selectAll("");

        // comunicarse con la vista
        $titulo="Nuevo servicio";
        require_once VSERVICIOS.'nuevo.php';
       }

       // lee datos del formulario de nuevo servicio y lo inserta en la bdd (llamando al ServicioDAO)
      public function new() {
        //cuando la solicitud es por post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // leer parametros
            $clien = new Servicios();
            $clien->setId(htmlentities($_POST['id']));
            $clien->setNombre(htmlentities($_POST['nombre']));
            $clien->setDescripcion(htmlentities($_POST['descripcion']));
            $clien->setPrecio(htmlentities($_POST['precio']));
            
    
            // actualizar el servicio
            $exito = $this->servicio->insert($clien);
    
            // establecer un mensaje y color de acuerdo al éxito de la actualización
            if ($exito) {
                $msj = 'servicio guardado exitosamente';
                $color = 'primary';
            } else {
                $msj = "No se pudo realizar el guardado";
                $color = "danger";
            }
    
            // almacenar el mensaje y color en la sesión para su posterior visualización
            if(!isset($_SESSION)) { session_start(); }
            $_SESSION['mensaje'] = $msj;
            $_SESSION['color'] = $color;
    
            // redirigir al usuario a la página de detalle del servicio actualizado
            header('Location:index.php?c=servicios&f=index&id=');
          }
    }

    public function delete(){
        //leer parametros
        $clien = new Servicios();
        $clien->setId(htmlentities($_REQUEST['id']));
        $clien->setNombre('nombre');
    
        //comunicando con el modelo
        $exito = $this->servicio->delete($clien);
        $msj = 'Servicio eliminado exitosamente';
        $color = 'primary';
        if (!$exito) {
            $msj = "No se pudo eliminar el Servicio";
            $color = "danger";
        }
    
        if(!isset($_SESSION)){ session_start();};
        $_SESSION['mensaje'] = $msj;
        $_SESSION['color'] = $color;
        //llamar a la vista
        header('Location:index.php?c=servicios&f=index');
    }

    // muestra el formulario de editar servicio
    public function view_edit(){
        //leer parametro
        $id= $_REQUEST['id']; // verificar, limpiar
        //comunicarse con el ServiciosDAOo de clientes
       $servicio = $this->servicio->selectOne($id);
   
       // comunicarse con la vista
       $titulo="Editar servicio";
       require_once VSERVICIOS.'edit.php';
   
     }

     // lee datos del formulario de editar servicios y lo actualiza en la bdd (llamando al ServiciosDAOo)
     public function edit(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // leer parametros
            $servicio = new Servicios();
            $servicio->setId(htmlentities($_POST['id']));
            $servicio->setNombre(htmlentities($_POST['nombre']));
            $servicio->setDescripcion(htmlentities($_POST['descripcion']));
            $servicio->setPrecio(htmlentities($_POST['precio']));
    
            // actualizar el cliente
            $exito = $this->servicio->update($servicio);
    
            // establecer un mensaje y color de acuerdo al éxito de la actualización
            if ($exito) {
                $msj = 'servicio actualizado exitosamente';
                $color = 'primary';
            } else {
                $msj = "No se pudo realizar la actualizacion";
                $color = "danger";
            }
    
            // almacenar el mensaje y color en la sesión para su posterior visualización
            if(!isset($_SESSION)) { session_start(); }
            $_SESSION['mensaje'] = $msj;
            $_SESSION['color'] = $color;
    
            // redirigir al usuario a la página de detalle del servicio actualizado
            header('Location:index.php?c=servicios&f=index');
        }
    }
    
  }

?>