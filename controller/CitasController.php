<?php
//autor:Miño Figueroa Bryan Ignacio
require_once 'model/dao/citasDao.php';
require_once 'model/dto/citasDto.php';
class CitasController
{
    private $model;
    private $nmascotas;
    public function __construct()
    {
        $this->model = new citasDao();
    }

    public function index()
    {
        $this->model=new citasDao();
        $rescitas = $this->model->getAll();
        $nmascotas = $this->nmascotas;
        if (empty($_SESSION[ID_ROLE]) || $_SESSION[ID_ROLE] == '2') {
            require_once VCITAS . 'list.php';
        }else{
            require_once VCITAS . 'list.admin.php';
        }
    }

    public function newcitas()
    {
        $nmascotas = $this->nmascotas;
        require_once VCITAS . 'new.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $citas = new citasDto();
            $citas->setduenio(htmlentities($_POST['duenio']));
            $citas->setnmascotas(htmlentities($_POST['nmascotas']));
            $citas->setedad(htmlentities($_POST['edad']));
            $citas->setcelular(htmlentities($_POST['celular']));
            $citas->setfecha(htmlentities($_POST['fecha']));
            $exito = $this->model->insert($citas);
            $msj = 'cita guardada exitosamente';
            $color = 'primary';
            if (!$exito) {
                $msj = "No se pudo realizar el guardado";
                $color = "danger";
            }
            if (!isset($_SESSION)) {
                session_start();
            };
            $_SESSION['mensaje'] = $msj;
            $_SESSION['color'] = $color;
            //llamar a la vista
            header('Location:index.php?c=citas&f=index');
        }
    }

    public function searchAjax() {
        $para = (!empty($_GET["b"]))?htmlentities($_GET["b"]):"";
        echo json_encode($this->model->selectAll($para));
    }

    public function editcitas ()
    {

        $id = $_GET['id'];
        $nmascotas = $this->nmascotas;
        $citas = $this->model->getById($id);
        require_once VCITAS.'edit.php';

    }

    public function deletecitas(){
        $id = $_GET['id'];
        $exito = $this->model->delete($id);
        $msj = 'citas eliminada exitosamente';
        $color = 'primary';
        if (!$exito) {
            $msj = "No se pudo realizar la eliminación";
            $color = "danger";
        }
        if (!isset($_SESSION)) {
            session_start();
        };
        $_SESSION['mensaje'] = $msj;
        $_SESSION['color'] = $color;
        //llamar a la vista
        header('Location:index.php?c=citas&f=index');
    }

    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $citas = new citasDto();
            $citas->setid(htmlentities($_POST['id']));
            $citas->setduenio(htmlentities($_POST['duenio']));
            $citas->setnmascotas(htmlentities($_POST['nmascotas']));
            $citas->setedad(htmlentities($_POST['edad']));
            $citas->setcelular(htmlentities($_POST['celular']));
            $citas->setfecha(htmlentities($_POST['fecha']));
            $exito = $this->model->update($citas);
            $msj = 'Cita Actualizada exitosamente';
            $color = 'primary';
            if (!$exito) {
                $msj = "No se actualizo su cita";
                $color = "danger";
            }
            if (!isset($_SESSION)) {
                session_start();
            };
            $_SESSION['mensaje'] = $msj;
            $_SESSION['color'] = $color;
            header('Location:index.php?c=citas&f=index');
        }
    }

}
?>
