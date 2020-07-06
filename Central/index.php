<?php

include_once('Models/AdminSession_Model.php');

if(isset($_SERVER["HTTP_REFERER"])){
$server = $_SERVER["HTTP_REFERER"];
}





/*if (strpos($server, '34.70.183.119/Login') == false AND $aux === true) {
	header('location: http://34.70.183.119/Login/controllers/logout.php');
	die();
}*/

if(!isset($adminSession) ){
	$adminSession = new AdminSession();
}





if(isset($_SESSION['adminSession'])){
	if (isset($_GET['controller'])&&isset($_GET['action'])) {
	    $controller=$_GET['controller'];
	    $action=$_GET['action'];
	} else {
	    $controller='Screens';
	    $action='show';
	}
}

else{
	if (strpos($server, '34.70.183.119/Login') == false) {
	header('location: http://34.70.183.119/Login/index.php?error=3');
	die();
	}

	if(isset($_GET['codEvento'])){
	$codEventoClient = $_GET['codEvento'];
	    $file = file_get_contents("/home/pi/Pantalla/evento.json");
	    $json = json_decode($file, true);

	    $codEventoServer = $json['CodEvento'];

	    if($codEventoServer != $codEventoClient){
			header('location: http://34.70.183.119/Login/index.php?error=1');
			die();
	    }

	}else{
		header('location: http://34.70.183.119/Login/index.php?error=2');
		die();

	}

	if(isset($_GET['admin'])){
		$admin = $_GET['admin'];
		$adminSession->setCurrentAdmin($admin);

		if (isset($_GET['controller'])&&isset($_GET['action'])) {
		    $controller=$_GET['controller'];
		    $action=$_GET['action'];
		} else {
		    $controller='Screens';
		    $action='show';
		}

	}
	else{

		header('location: http://34.70.183.119/Login/controllers/logout.php');

	}



}



$inactividad = 900;

if(isset($_SESSION["timeout"])){
    $sessionTTL = time() - $_SESSION["timeout"];
    if($sessionTTL > $inactividad){
    $adminSession->closeSession();
	header('location: http://34.70.183.119/Login/controllers/logout.php');

    }
}
$_SESSION["timeout"] = time();

require_once('Views/default.php');
?>
