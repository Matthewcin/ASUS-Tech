<?php
require_once 'models/auth.model.php';
require_once 'views/auth.view.php';

class authController{
    private $model;
    private $view;

    function __construct(){
        $this->model = new authModel;
        $this->view = new authView;
    }
function Login(){
    $title = "Iniciar Sesión";
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Intentar autenticar al usuario
        if ($this->model->getLogin($username, $password)) {
            $_SESSION['logged'] = true;
            $_SESSION['role'] = $this->model->getRole($username)["role"];
            $_SESSION['user'] = $username;
            // Redirigir al dashboard o al home después de un login exitoso
            header("Location: dashboard");
            exit(); // Importante para detener el flujo
        } else {
            $this->view->showLogin();
            $this->view->showError("Nombre de usuario o contraseña incorrectos.");
        }
    } else {
        $this->view->showLogin();  // Muestra la vista de login
    }
    
    if (!empty($_SESSION['mensaje'])) { // Si en La Session existe un Mensaje
        $this->view->showMsg($_SESSION['mensaje']); // Mostra el Mensaje del Register
        unset($_SESSION['mensaje']); // Evita que se muestre de nuevo (Borrarlo)
    }
}

    function Register(){
    $title = "Registrarse";
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Validaciones básicas
        if (empty($username) || empty($password)) {
            $this->view->showRegister();
            $this->view->showError("Por favor, complete todos los campos.");
            return; // Sale de la función si hay un error
        }

        // Verificar si el usuario ya existe
        if ($this->model->verificarUsuarioExiste($username)) {
            $this->view->showRegister();
            $this->view->showError("Este nombre de usuario ya está en uso.");
            return;
        }

        // Llamamos al modelo para registrar al usuario
        $this->model->getRegister($username, $password);

        // Se guarda en la sesion el mensaje de que el $username registrado es.. X Usuario. luego se muestra en el Login
        $_SESSION['mensaje'] = "El usuario $username ha sido registrado exitosamente.";


        // Redirigir al login
        header("Location: login");
        exit();
    } else {
        $this->view->showRegister();
    }
}

    function logout(){
        session_unset(); // Limpia el archivo de Sesion
        session_destroy(); // Borra el Archivo de sesion para que luego haya uno completamente nuevo
        header("Location: login");
        exit();
    }

    function verificarSesion() {
    if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true) {
        header("Location: " . BASE_URL . "login");
        exit();
    }
}

    function dashboard(){
    $user = $_SESSION['user'];
    $role = $_SESSION['role'];
    $this->view->dashboard($user,$role);
}

    /*function mostrar_formulario_categorias() {
        $this->view->mostrarFormularioCategorias();
    }*/

    /*function agregarCategorias() {
        $categoria = $_POST['categoria'];
        $descripcion = $_POST['descripcion'];

        if(empty($_POST['categoria']) || empty($_POST['descripcion'])) {
            $this->view->mostrarErrores("faltan datos obligatororios");
            die();
        }

        $this->model->agregarCategorias($categoria,$descripcion);

        header("location: " . BASE_URL . "dashboard");
    }*/
}
?>