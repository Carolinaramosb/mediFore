<?php
  require_once "/opt/lampp/phpmyadmin/vendor/autoload.php";
  include ("conexiondb.php");

  $loader = new \Twig\Loader\FilesystemLoader('/opt/lampp/htdocs/TFG/templates');
  $twig = new \Twig\Environment($loader);
  
  session_start();

  $sql = new modeloBD;

  $medico_activo = $_SESSION['username'];

  $datos_medico=$sql->getMedico($medico_activo);
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $medico['username'] = $medico_activo;
        $medico['telefono'] = $_POST['telefono'];
        $medico['direccion'] = $_POST['direccion'];
        $medico['especialidad'] = $_POST['especialidad'];
        $error = false;
        if(strlen($medico['telefono']) != 9){
          array_push($errores, "El teléfono debe tener una longitud de 9 caracteres");
          $error = true;
        }
        if(!$error){
          $sql->editMedico($medico);
          header("Location: personalMedico.php");
        }
        else{
          echo $twig->render('editarMedico.html', ['errores' => $errores]);
          exit();    
        }
  }
  else{
    echo $twig->render('editarMedico.html', ['medico' => $datos_medico]);
  }
?>
