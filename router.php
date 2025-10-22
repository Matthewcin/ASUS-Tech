<?php
session_start();
require_once 'controllers/computadora.controller.php';
require_once 'controllers/auth.controller.php';
require_once 'controllers/categorias.controller.php';
// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'home'; // accion por defecto si no se envia ninguna
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);
$controller = new taskController;
$authController = new authController;
$categoriaController = new categoriasController;

switch ($params[0]) {
    case 'home':
    $controller->mostrarHome();
    break;
    case 'categoria':
    $id = $params[1];
    $categoriaController->mostrarCategoriasId($id);
    break;
    case'login':
    $authController->login();
    break;
    case'registrarse':
    $authController->register();
    break;
    case 'dashboard':
    $authController->verificarSesion();
    $authController->dashboard();
    break;
    case 'logout':
    $authController->logout();
    break;
    case 'computadoras':
    $controller->vistaComputadoras();
    break;
    case 'mostrar_detalle':
    $id = $params[1];
    $controller->obteneComputadoras($id);
    break;
    case 'mostrar_formulario_computadoras':
    $authController->verificarSesion();
    $controller->mostrarFormularioComputadoras();
    break;
    case 'mostrar_formulario_categorias':
    $authController->verificarSesion();
    $categoriaController->mostrar_formulario_categorias();
    break;
    case 'agregarCategorias':
    $authController->verificarSesion();
    $categoriaController->agregarCategorias();
    break;
    case 'agregarComputadoras':
    $authController->verificarSesion();
    $controller->agregarComputadorasC();
    break;
    case 'elimarComputadoras':
    $id = $params[1];
    $authController->verificarSesion();
    $controller->eliminarComputadora($id);
    break;
    case 'mostrarFormularioActualizarComputadoras':
    $id = $params[1];
    $authController->verificarSesion();
    $controller->formularioActualizar($id);
    break;
    case 'actualizarComputadoras':
    $id = $params[1];
    $authController->verificarSesion();
    $controller->actualizarComputadora($id);
    break;
    case 'mostrarFormularioActualizarCategorias';
    $id = $params[1];
    $authController->verificarSesion();
    $categoriaController->mostrarFormularioActualizar($id);
    break;
    case 'actualizarCategorias';
    $id = $params[1];
    $authController->verificarSesion();
    $categoriaController->actualizarCategorias($id);
    break;
    case 'eliminarCategorias':
    $id = $params[1];
    $authController->verificarSesion();
    $categoriaController->borrarCategoriaId($id);
    break;
    default:
    echo "404 page not found...";
    break;
    }