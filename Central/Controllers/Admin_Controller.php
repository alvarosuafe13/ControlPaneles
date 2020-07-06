<?php

require_once('Models/AdminSession_Model.php');



class AdminController{
	
	public static function logout(){

		$adminSession = new AdminSession();
		$adminSession->closeSession();

		//header('location: http://localhost/dashboard/server/Login/controllers/logout.php');
		header('location: http://34.70.183.119/Login/controllers/logout.php');


	}

}




?>