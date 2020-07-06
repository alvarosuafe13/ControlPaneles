<?php

require_once("Controllers/DataBase_Controller.php");

class Users_Model{
    private $db;
    private $adminname;
    private $pass;


    public function __construct($codEvento){
        $this->db=DataBaseController::connection();
        $this->codEvento=$codEvento;
    }

    public function adminExistsEvent($admin, $pass){
    	$md5pass = md5($pass);
        $stmt = $this->db->prepare("SELECT * FROM ADMIN WHERE nombreAdmin = ? AND contraAdmin = ? AND codEvento = ?");
        $stmt->execute(array($admin, $pass, $this->codEvento));
    }

}






?>