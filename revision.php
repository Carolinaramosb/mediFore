<?php
  require_once "/opt/lampp/phpmyadmin/vendor/autoload.php";
  include ("conexiondb.php");

  $loader = new \Twig\Loader\FilesystemLoader('/opt/lampp/htdocs/TFG/templates');
  $twig = new \Twig\Environment($loader);
  
  session_start();

  $sql = new modeloBD;

  $paciente_activo = $_SESSION['dni'];
  $datos_paciente=$sql->getRevision($paciente_activo);

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $paciente['dni'] = $paciente_activo;
        $paciente['evolucion'] = $_POST["evolucion"];
        $sql->editRevision($paciente);
        header("Location: medicoPaciente.php");
  }
  else{
    echo $twig->render('revision.html', ['paciente' => $datos_paciente]);
  }
?>