<?php 
    include ("cabecera.php");

    require_once "/opt/lampp/phpmyadmin/vendor/autoload.php";
    include ("conexiondb.php");

    $loader = new \Twig\Loader\FilesystemLoader('/opt/lampp/htdocs/TFG/templates');
    $twig = new \Twig\Environment($loader);

    session_start();

    $sql = new modeloBD;

    if (isset($_GET['dni'])){
        $_SESSION['dni']=$_GET['dni'];
    }

    $paciente = $sql->getPaciente($_SESSION['dni']);

    echo $twig->render('personalPacientes.html', ['personalPaciente' => $paciente]);
            
include ("piedepagina.php");
?>