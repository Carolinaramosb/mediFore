<?php 
    

    require_once "/opt/lampp/phpmyadmin/vendor/autoload.php";
    include ("conexiondb.php");

    $loader = new \Twig\Loader\FilesystemLoader('/opt/lampp/htdocs/TFG/templates');
    $twig = new \Twig\Environment($loader);

    session_start();
    $usuario = $_SESSION['username'];

    $sql = new modeloBD;

    $medico = $sql->getMedico($usuario);

    echo $twig->render('personalMedico.html', ['personalMedico' => $medico]);
            

?>