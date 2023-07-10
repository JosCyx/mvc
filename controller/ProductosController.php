<?php
//autor: Moreno Bravo Jose
require_once 'model/dao/ProductoDAO.php';
require_once 'model/dto/ProductoDTO.php';

class ProductosController {
    private $model;
    private $producto;
 
    public function __construct() {
        $this->producto = new ProductoDAO();
    }

    
    public function index() {

        $this->model=new ProductoDAO();
        $resultados = $this->model->getAll();
        $producto = $this->producto;
        if (empty($_SESSION[ID_ROLE]) || $_SESSION[ID_ROLE] == '2') {
            require_once VPRODUCTO . 'user.php';
        }else{
            require_once VPRODUCTO . 'list.php';
        }
      
        
    }
  
    public function search(){
        $busq = $_POST["b"];
        
        $parametro = (!empty($busq))?htmlentities($busq):"";
       
        $resultados = $this->producto->selectAll($parametro);
        
        $titulo="Resultado de busqueda";
        require_once VPRODUCTO.'list.php';
    }
  
    public function searchAjax() {
        $parametro = (!empty($_GET["b"]))?htmlentities($_GET["b"]):"";
        echo json_encode($this->producto->selectAll($parametro));
    }
      
    public function view_new(){
            
        $resultados = $this->producto->selectAll("");
  
        $titulo="Nuevo producto";
        require_once VPRODUCTO.'nuevo.php';
  
    }
  
      
    public function new() {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $prod = new Producto();
            $prod->setId(htmlentities($_POST['id']));
            $prod->setCodigo(htmlentities($_POST['codigo']));
            $prod->setNombre(htmlentities($_POST['nombre']));
            $prod->setDescripcion(htmlentities($_POST['descripcion']));
            $prod->setValor(htmlentities($_POST['valor']));
            $prod->setDisponibilidad(htmlentities($_POST['disp']));
    
            
            $good = $this->producto->insert($prod);
    
            
            if ($good) {
                $msj = 'Producto guardado exitosamente.';
                $color = 'primary';
            } else {
                $msj = "No se pudo realizar el guardado.";
                $color = "danger";
            }
    
            
            if(!isset($_SESSION)) { 
                session_start(); 
            }

            $_SESSION['mensaje'] = $msj;
            $_SESSION['color'] = $color;
    
            
            header('Location:index.php?c=productos&f=index&id=');
        }
    }
    
    public function delete(){
        
        $prod = new Producto();
        $prod->setId(htmlentities($_REQUEST['id']));
        $prod->setNombre('nombre');
    
        
        $exito = $this->producto->delete($prod);
        $msj = 'Producto eliminado exitosamente.';
        $color = 'primary';
        if (!$exito) {
            $msj = "No se pudo eliminar el producto.";
            $color = "danger";
        }
    
        if (!isset($_SESSION)){ 
            session_start();
        }

        $_SESSION['mensaje'] = $msj;
        $_SESSION['color'] = $color;
        
        header('Location:index.php?c=productos&f=index');
    }
  
  
     
    public function view_edit(){
       
        $id= $_REQUEST['id'];
        $prod = $this->producto->selectOne($id);
  
      
        $titulo="Editar productos";
        require_once VPRODUCTO.'edit.php';
  
    }
  
     
    public function edit(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $prod = new Producto();
            $prod->setId(htmlentities($_POST['id']));
            $prod->setCodigo(htmlentities($_POST['codigo']));
            $prod->setNombre(htmlentities($_POST['nombre']));
            $prod->setDescripcion(htmlentities($_POST['descripcion']));
            $prod->setValor(htmlentities($_POST['valor']));
            $prod->setDisponibilidad(htmlentities($_POST['disp']));
    
            
            $exito = $this->producto->update($prod);
    
            
            if ($exito) {
                $msj = 'Cliente actualizado exitosamente';
                $color = 'primary';
            } else {
                $msj = "No se pudo realizar la actualizacion";
                $color = "danger";
            }
    
            
            if(!isset($_SESSION)) { session_start(); }
            $_SESSION['mensaje'] = $msj;
            $_SESSION['color'] = $color;
    
            
            header('Location:index.php?c=productos&f=index');
        }
    }
    
}?>

