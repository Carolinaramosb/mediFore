<?php
  require_once "/opt/lampp/phpmyadmin/vendor/autoload.php";
  include ("conexiondb.php");

  $loader = new \Twig\Loader\FilesystemLoader('/opt/lampp/htdocs/TFG/templates');
  $twig = new \Twig\Environment($loader);
  
  session_start();

  $sql = new modeloBD;

  $paciente_activo = $_SESSION['dni'];

  $datos_paciente=$sql->getPaciente($paciente_activo);
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $paciente['dni'] = $paciente_activo;
        $paciente['compañia'] = $_POST['compañia'];
        $paciente['direccion'] = $_POST['direccion'];
        $paciente['telefono'] = $_POST['telefono'];
        $sql->editPaciente($paciente);
        header("Location: inicio.php");
  }
  else{
    echo $twig->render('editarPaciente.html', ['paciente' => $datos_paciente]);
  }
?>