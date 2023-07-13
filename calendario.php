<?php
  require_once "/opt/lampp/phpmyadmin/vendor/autoload.php";
  include ("conexiondb.php");

  $loader = new \Twig\Loader\FilesystemLoader('/opt/lampp/htdocs/TFG/templates');
  $twig = new \Twig\Environment($loader);
  
  session_start();

  $sql = new modeloBD;

  $paciente_activo = $_SESSION['dni'];
  $fecha = $sql->getFecha($paciente_activo);

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $paciente['dni'] = $paciente_activo;
        $paciente['dia'] = $_POST["dia"];
        $paciente['hora'] = $_POST["hora"];
        $paciente['minuto'] = $_POST["minuto"];
        $res = $sql->addCita($paciente);
        $error=null;
        if ($res){
            $error = "Esa cita está ocupada, seleccione otra";
            echo $twig-> render('calendario.html', ['error' => $error]);
        }
        else{
            header("Location: inicio.php");
        }

  }
  else{
    echo $twig->render('calendario.html', ['error' => $error, 'fecha' => $fecha]);
  }
?>