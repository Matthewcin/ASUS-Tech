<?php
require_once 'models/categorias.model.php';
require_once 'views/categorias.view.php';

class categoriasController{
    private $model;
    private $view;

    function __construct(){
        $this->model = new categoriasModel;
        $this->view = new categoriasView;
    }

    function showCategorias(){
        $categorias = $this->model->mostrarCategorias();
        $this->view->selectorCategorias($categorias);
    }

    function mostrar_formulario_categorias() {
    $this->view->mostrarFormularioCategorias();
    }
    
    function agregarCategorias() {
    $categoria = $_POST['categoria'];
    $descripcion = $_POST['descripcion'];

    if(empty($_POST['categoria']) || empty($_POST['descripcion'])) {
      $this->view->errores("faltan datos obligatororios");
      die();
      }

      $this->model->agregarCategorias($categoria,$descripcion);

      header("location: " . BASE_URL . "dashboard");
    }

    function mostrarFormularioActualizar($id) {
        $categoria = $this->model->obtenerCategoriaPorId($id);

        $this->view->mostrarFormularioActualizarCategorias($categoria);
    }

    function actualizarCategorias($id) {
      $categoria = $_POST['categoria'];
      $descripcion = $_POST['descripcion'];

      if(empty($_POST['categoria']) || empty($_POST['descripcion'])) {
        $this->view->errores("faltan datos obligatorios");
      }

      $this->model->actualizarCategoria($categoria,$descripcion,$id);

      header("location: " . BASE_URL . "home");
      exit();
    }

    function mostrarCategoriasId($id) {
      $categorias = $this->model->obtenerCategoriaPorId($id);
      $computadoras = $this->model->obtenerComputadorasPorCategoria($id);
      $this->view->mostrarComputadorasPorCategorias($categorias,$computadoras);
    }

    function borrarCategoriaId($id){
      $categoria = $this->model->borrarCategoria($id);
      header("location: " . BASE_URL . "home");
      exit();
    }
}
?>