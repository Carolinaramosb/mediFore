<?php
    require_once "/opt/lampp/phpmyadmin/vendor/autoload.php";
    include ("conexiondb.php");
  
    $loader = new \Twig\Loader\FilesystemLoader('/opt/lampp/htdocs/TFG/templates');
    $twig = new \Twig\Environment($loader);
    session_start();
    //Creamos instancia de conexión a BD
    $sql = new modeloBD;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dni = $_POST['dni'];
        $_SESSION['dni'] = $dni;
        header("Location: personalPaciente.php");
    }

    else{
        echo $twig->render('loginPaciente.html');
    }

?>