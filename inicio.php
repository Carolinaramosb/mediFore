<?php 

    require_once "/opt/lampp/phpmyadmin/vendor/autoload.php";
    include ("conexiondb.php");

    $loader = new \Twig\Loader\FilesystemLoader('/opt/lampp/htdocs/TFG/templates');
    $twig = new \Twig\Environment($loader);

    session_start();

    $sql = new modeloBD;

    $cargo = $_SESSION['cargo'];

    echo $twig->render('inicio.html',['cargo' => $cargo]);

?>