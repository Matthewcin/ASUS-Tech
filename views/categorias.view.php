<?php
class categoriasView{
    function selectorCategorias($categorias){
        include 'templates/categorias.phtml';
    }

    function errores($msg) {
        echo '<h1> error </h1>';
        echo $msg;
    }

    function mostrarFormularioCategorias() {
    include 'templates/formulario.agregarCategorias.phtml';
    }

    function mostrarFormularioActualizarCategorias($categoria) {
        include 'templates/formulario.actualizarCategorias.phtml';
    }

    function mostrarComputadorasPorCategorias($categorias,$computadoras) {
        include 'templates/header.phtml';
        include 'templates/detalleCategorias.phtml';
    }
}
?>