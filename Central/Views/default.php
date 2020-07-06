<!DOCTYPE html>
<html lang="es">
<head>
    <title>Panel De Control</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
    <link rel="stylesheet"  href="lib/bootstrap-4.4.1-dist/css/bootstrap.min.css">
    
 	<script src="lib/jquery-3.4.1.js"></script>

 	<script src="lib/ckeditor/ckeditor.js"></script>
 	<script src="lib/ckeditor/samples/js/sample.js"></script>
 	<link rel="stylesheet" href="lib/ckeditor/samples/css/samples.css">
 	<link rel="stylesheet" href="lib/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">
 	<meta name="viewport" content="width=device-width,initial-scale=1">
    <script src="lib/sweetalert.min.js"></script>

    <!-- <script src="Js/jquery_functions.js"></script> -->
    <!--<link rel="stylesheet" href="css/estilos.css">-->

    <link rel="stylesheet" href="css/estilos.css?v=<?php echo time(); ?>" />
    <script src="Js/jquery_functions.js?v=<?php echo time(); ?>"></script>
</head>

<body>

<div id="header" class="container-fluid">
	<h1 id="titulo"  ><a style="text-decoration:none;color:white" href="index.php?controller=Screens&amp;action=show">  PANEL DE CONTROL</a>
      <button class="btn btn-default" id="logoutButton" onclick="location.href='index.php?controller=Admin&amp;action=logout'">Cerrar sesión</button> 
  </h1>

</div>
	<?php require_once('routes.php'); ?>
</body>
</html>
