<!doctype html>
<html lang="es">

<link rel="stylesheet" href="style/estilo.css" type="text/css">

<head>
  <!-- Lo que está en el head va al navegador y no lo ve el usuario -->
  <title> mediFore </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="consulta de medicina interna">

</head>

  <img src="img/logo.png" style="width: 500px; margin-left: 35%;" id="imagenLogo">

  <h3>mediFore: medicina interna</h1>
  <h4>Consulta médica</h2>

  <nav> <ul>
      <li>
        <a class="nav-link" href="inicio.php">Inicio </a>
      </li>
      <li>
        <a class="nav-link" href="personalMedico.php">Datos personales médico</a>
      </li>
      <li>
        <a class="nav-link" href="medicosPaciente.php">Datos médicos pacientes</a>
      </li>
      <li>
        <a class="nav-link" href="personalPaciente.php">Datos personales pacientes</a>
      </li>
      <li>
        <a class="nav-link" href="informes.php">Informes</a>
      </li>
      <li>
        <a class="nav-link" href="calendario.php">Calendario</a>
      </li>
    </ul> </nav>

  <div class = "boton-logout">
    <a href = "logout.php">Cerrar sesión</a>
  </div>


  <?php include "piedepagina.php"?> 