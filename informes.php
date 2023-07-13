<?php 

    require_once "/opt/lampp/phpmyadmin/vendor/autoload.php";
    include ("conexiondb.php");

    $loader = new \Twig\Loader\FilesystemLoader('/opt/lampp/htdocs/TFG/templates');
    $twig = new \Twig\Environment($loader);

    session_start();

    $sql = new modeloBD;
    $dni = $_SESSION['dni'];
    $medico = $_SESSION['username'];

    $paciente = $sql->getPaciente($dni);
    $medico = $sql->getMedico($medico);
    $anamnesis = $sql->getAnamnesis($dni);
    $revision = $sql->getRevision($dni);
    $complementaria = $sql->getMedicacion($dni);

    echo $twig->render('informes.html', ['paciente' => $paciente, 'medico' => $medico, 
    'anamnesis' => $anamnesis, 'revision'=> $revision, 'complementaria'=> $complementaria]);
            
?>