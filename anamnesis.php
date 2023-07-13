<?php
  require_once "/opt/lampp/phpmyadmin/vendor/autoload.php";
  include ("conexiondb.php");

  $loader = new \Twig\Loader\FilesystemLoader('/opt/lampp/htdocs/TFG/templates');
  $twig = new \Twig\Environment($loader);
  
  session_start();

  $sql = new modeloBD;

  $paciente_activo = $_SESSION['dni'];
  $datos_paciente=$sql->getAnamnesis($paciente_activo);

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $paciente['dni'] = $paciente_activo;
    $paciente['antecedentes'] = $_POST["antecedentes"];
    $paciente['enfermedad'] = $_POST["enfermedad"];
    $paciente['inspeccion'] = $_POST["inspeccion"];
    $paciente['cabezaCuello'] = $_POST["cabezaCuello"];
    $paciente['neurologica'] = $_POST["neurologica"];
    $paciente['aCardiaca'] = $_POST["aCardiaca"];
    $paciente['aRespiratoria'] = $_POST["aRespiratoria"];
    $paciente['abdomen'] = $_POST["abdomen"];
    $paciente['extremidades'] = $_POST["extremidades"];
    $paciente['tension'] = $_POST["tension"];
    $paciente['frecuencia'] = $_POST["frecuencia"];
    $sql->editDatosMedicos($paciente);
    header("Location: medicoPaciente.php");
  }
  else{
    echo $twig->render('anamnesis.html', ['paciente' => $datos_paciente]);
  }
?>