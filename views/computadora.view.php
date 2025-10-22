<?php 

class taskView {

    function Home($computadoras,$categorias){
        include 'templates/header.phtml';
        include 'templates/home.phtml';
        include 'templates/categorias.phtml';
    }

    function mostrarComputadorasCarrusel($computadoras) {
        include 'templates/carrusel.phtml';
    }

    function mostrarTodasComputadoras($computadorax) {
        include 'templates/header.phtml';
        include 'templates/computadoras.phtml';
    }

    function mostrarComputadorasID($computadora) {
        include 'templates/header.phtml';
        include 'templates/detallesComputadoras.phtml';
    }

    function mostrarFormularioComputadorax() {
    include 'templates/formulario.agregarComputadoras.phtml';
    }

    function mostrarFormularioComputadoras($computadora) {
        include 'templates/formulario.actualizarComputadoras.phtml';
    }

    function mostrarError($msg) {
        echo '<h1> error </h1>';
        echo $msg;
    }
}