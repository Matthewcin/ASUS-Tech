<?php
class authView{
    function showLogin(){
        include 'templates/header.phtml';
        include 'templates/iniciarSesion.phtml';
    }
    
    function showRegister(){
        include 'templates/header.phtml';
        include 'templates/registrarse.phtml';
    }

    function showMsg($msg){
        echo '<p style="color: green; font-weight: bold;">' .$msg. '</p>';
    }

    function showError($error){
        echo '<p style="color: red; font-weight: bold;">' .$error. '</p>';
    }

    function dashboard($user,$role){
        include 'templates/header.phtml';
        include 'templates/dashboard.phtml';
    }

    function mostrarErrores($msg) {
    echo "<h1> ERROR : </h1>";
    echo "<h2> $msg </h2>";
    }

    function mostrarFormularioCategorias() {
        include 'templates/formulario.agregarCategorias.phtml';
    }
}
?>