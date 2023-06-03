<?php 

    require_once "/opt/lampp/phpmyadmin/vendor/autoload.php";
    include ("conexiondb.php");

    $loader = new \Twig\Loader\FilesystemLoader('/opt/lampp/htdocs/TFG/templates');
    $twig = new \Twig\Environment($loader);


    session_start();
    //$usuarioLogeado['username'] = $_SESSION['username'];
    //$usuarioLogeado['cargo'] = $_SESSION['cargo'];
    $paciente_activo = $_SESSION['dni'];
    
    // Evitamos consultas inválidas
    //if ($paciente =! null){
        $sql = new modelobd;
        // Borramos producto y redirigimos a la portada
        //if ($usuarioLogeado['cargo'] != 'medico'){      // Si es gestor de sitio o superusuario
            $sql->eliminarPaciente($paciente_activo);
            header("Location: loginPaciente.php");
        //}
        //else{
        //    echo $twig->render('noAutorizado.html',[]);
        //}
    //}else{
      //  echo $twig->render('error.html',[]);
    //}
?>