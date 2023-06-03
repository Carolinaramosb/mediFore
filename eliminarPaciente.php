<?php 

    require_once "/opt/lampp/phpmyadmin/vendor/autoload.php";
    include ("conexiondb.php");

    $loader = new \Twig\Loader\FilesystemLoader('/opt/lampp/htdocs/TFG/templates');
    $twig = new \Twig\Environment($loader);


    session_start();
    $sql = new modeloBD;

    $paciente_activo = $_SESSION['dni'];
 
    
    $sql->eliminarPaciente($paciente_activo);
    header("Location: loginPaciente.php");

?>