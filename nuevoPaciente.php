<?php
    require_once "/opt/lampp/phpmyadmin/vendor/autoload.php";
    include ("conexiondb.php");

    $loader = new \Twig\Loader\FilesystemLoader('/opt/lampp/htdocs/TFG/templates');
    $twig = new \Twig\Environment($loader);

    session_start();

    $sql = new modeloBD;
    $errores= array();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $paciente['dni'] = $_POST["dni"];
          $paciente['nombre'] = $_POST["nombre"];
          $paciente['apellidos'] = $_POST["apellidos"];
          $paciente['compañia'] = $_POST["compañia"];
          $paciente['fecha'] = $_POST["fecha"];
          $paciente['direccion'] = $_POST["direccion"];
          $paciente['telefono'] = $_POST["telefono"];
          $error = false;
          if(strlen($paciente['telefono']) != 9){
            array_push($errores, "El teléfono debe tener una longitud de 9 caracteres");
            $error = true;
          }
          if(strlen($paciente['dni']) != 9){
            array_push($errores, "El DNI debe tener una longitud de 9 caracteres");
            $error = true;
          }
          if(!$error){
            $res = $sql->addPaciente($paciente);
            if ($res['error']){
                array_push($errores, $res['descripcion']);
                echo $twig->render('nuevoPaciente.html', ['errores' => $errores]);
                exit();
            }
            else{
                $_SESSION['dni'] = $_POST['dni'];
                header("Location: inicio.php");
            }
          }
          else{
            echo $twig->render('nuevoPaciente.html', ['errores' => $errores]);
            exit();    
          }
      }
      else{
          echo $twig->render('nuevoPaciente.html');
      }
?>