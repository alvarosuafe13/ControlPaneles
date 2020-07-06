
<?php

require_once("Controllers/DataBase_Controller.php");
class ScreensModel{
    private $db;
    private $screens;
    private $codEvento;
 
    public function __construct($codEvento){
        $this->db=DataBaseController::connection();
        $this->codEvento=$codEvento;
    }


    public function getScreens(){
         
        $stmt = $this->db->prepare("SELECT codPantalla,ipPantalla,nomPantalla FROM PANTALLA WHERE codEvento = ?");
        $stmt->execute(array($this->codEvento));
        $pantallas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(count($pantallas) >0) {

            $info = array('codEvento' => $this->codEvento);
            $info['Msg'] = 3;
            foreach ($pantallas as $pantalla) {
                $info['Pantallas'][$pantalla["codPantalla"]] = [$pantalla["ipPantalla"] , $pantalla["nomPantalla"]];
            }

        } else {//No existen pantallas registradas para ese evento
            $info = array('Msg' => 4);

        }


        $stmt=null;
        $pantallas = $info;

        return  $pantallas;
    }

    public function deleteScreen($ipPantalla){
        $stmt = $this->db->prepare("DELETE FROM PANTALLA WHERE ipPantalla=? AND codEvento=?");
        if ($stmt->execute(array($ipPantalla , $this->codEvento)) === TRUE){
            $info['Msg'] = 3;
        }
        else{
            $info['Msg'] = 4;

        }

        $stmt=null;
         
        return  $info;

    }

    public function deleteEvent(){
        $stmt = $this->db->prepare("DELETE FROM PANTALLA WHERE codEvento=?");
        if ($stmt->execute(array($this->codEvento)) === TRUE){
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
