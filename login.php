<?php
    require_once "/opt/lampp/phpmyadmin/vendor/autoload.php";
    include ("conexiondb.php");
  
    $loader = new \Twig\Loader\FilesystemLoader('/opt/lampp/htdocs/TFG/templates');
    $twig = new \Twig\Environment($loader);

    //Creamos instancia de conexión a BD
    $sql = new modeloBD;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $cargo = $sql->getCargo($username);
        $res = $sql->loginUser($username, $password);
        if ($res['exito']) {    // Si ha iniciado sesión satisfactoriamente se guardan los datos en la sesión
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['cargo'] = $cargo;
            header("Location: loginPaciente.php");
        }
        else{
            $error = "Usuario o contraseña incorrectos.";
            echo $twig->render('login.html', ['error' => $error]);
        }
    }
    else{
        echo $twig->render('login.html', []);
    }
?>