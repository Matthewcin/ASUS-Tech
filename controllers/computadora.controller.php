<?php 
require_once 'models/computadora.model.php';
require_once 'views/computadora.view.php';

class taskController {
    private $model;
    private $extendmodel;
    private $view;

    function __construct() {
        $this->model = new taskModel;
        $this->extendmodel = new categoriasModel;
        $this->view = new taskView;
    }

      public function mostrarHome() {
        $computadoras = $this->model->obtenerComputadoras();
        $categorias = $this->extendmodel->mostrarCategorias();
        
        $this->view->Home($computadoras,$categorias);

        $this->view->mostrarComputadorasCarrusel($computadoras);
        
    }

      public function vistaComputadoras() {
        $computadorax = $this->model->obtenerComputadoras();

        $this->view->mostrarTodasComputadoras($computadorax);
      }

      public function obteneComputadoras($id) {
        $computadora = $this->model->obtenerComputadorasID($id);

        $this->view->mostrarComputadorasID($computadora);
    }

    function mostrarFormularioComputadoras() {  
    $this->view->mostrarFormularioComputadorax();
    }

        function agregarComputadorasC() {
        $modelo = $_POST['modelo'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $gama = $_POST['gama'];
        $imagen = $_POST['imagen'];


        if (empty($_POST['modelo']) || empty($_POST['descripcion']) || empty($_POST['precio']) || empty($_POST['gama']) || empty($_POST['imagen'])) {
            $this->view->mostrarError("faltan datos obligatorios");
            die();
        }

        $this->model->agregarComputadoras($modelo,$descripcion,$precio,$gama,$imagen);

        header("location: " . BASE_URL . "dashboard");
    }

    function eliminarComputadora($id) {
      $this->model->eliminarComputadorax($id);
      header("location: " . BASE_URL . "computadoras");
    }

    function formularioActualizar($id) {
      $computadora = $this->model->obtenerComputadorasID($id);

      $this->view->mostrarFormularioComputadoras($computadora);
    }

    function actualizarComputadora($id) {
        $modelo = $_POST['modelo'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $gama = $_POST['gama'];
        $imagen = $_FILES['imagen']['name'];

        // si el usuario pone nueva URL, la usamos; si no, mantenemos la anterior
         $imagen = !empty($_POST['imagen']) ? $_POST['imagen'] : $_POST['img_actual'];

         if (empty($_POST['modelo']) || empty($_POST['descripcion']) || empty($_POST['precio']) || empty($_POST['gama'])) {
            $this->view->mostrarError("faltan datos obligatorios");
            die();
        }

        $this->model->actualizarComputadorax($id,$modelo,$descripcion,$precio,$gama,$imagen);

        header("location: " . BASE_URL . "computadoras");
    }
}   