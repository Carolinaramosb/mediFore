<?php
  require_once "/opt/lampp/phpmyadmin/vendor/autoload.php";
  include ("conexiondb.php");

  $loader = new \Twig\Loader\FilesystemLoader('/opt/lampp/htdocs/TFG/templates');
  $twig = new \Twig\Environment($loader);
  
  session_start();

  $sql = new modeloBD;

  $paciente_activo = $_SESSION['dni'];
  $datos_paciente=$sql->getMedicacion($paciente_activo);

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $paciente['dni'] = $paciente_activo;
    $paciente['complementaria'] = $_POST["complementaria"];
    $paciente['diagnostico'] = $_POST["diagnostico"];
    $paciente['dieta'] = $_POST["dieta"];
    $paciente['medicina'] = $_POST["medicina"];
    $paciente['dosis'] = $_POST["dosis"];
    $sql->editMedicacion($paciente);
    header("Location: medicoPaciente.php");
  }
  else{
    echo $twig->render('medicacion.html', ['paciente' => $datos_paciente]);
  }
?>