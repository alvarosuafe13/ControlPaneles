<?php

require_once("Controllers/DataBase_Controller.php");


class AdminSession{

    public function __construct(){
        session_start();
        $this->db=DataBaseController::connection();

    }

    public function setCurrentAdmin($admin){
        $_SESSION['adminSession'] = $admin;
        $_SESSION["timeout"] = time();
    }

    public function getCurrentAdmin(){
        return $_SESSION['adminSession'];
    }

    public function closeSession(){
        session_unset();
        session_destroy();
    }



    public function deleteAdmin($codEvento){
        $stmt = $this->db->prepare("DELETE FROM ADMIN WHERE codEvento=?");
        if ($stmt->execute(array($codEvento)) === TRUE){
            $info['Msg'] = 3;
        }
        else{
            $info['Msg'] = 4;

        }

        $stmt=null;
         
        return  $info;
    }
}

?>