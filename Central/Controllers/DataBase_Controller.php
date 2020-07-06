<?php


class DataBaseController{


    public function __construct()
    {


    }
    
    public static function connection(){
        //$host = '192.168.181.1';
        $host = '34.70.183.119';
        $user = 'u716496248_alvar';
        $db = 'u716496248_alvar';
        $pass = 'alvaro';

        $mysql = "mysql:host=".$host.";dbname=".$db.";port=3306";

        try {
            $mbd = new PDO($mysql, $user, $pass);
            return $mbd ;

            }catch(PDOException $e){
                $info = array('Msg' => 1);// Error de conexion con la BD
                echo "Error:". $e->getMessage();
                echo json_encode($info,JSON_NUMERIC_CHECK);
                exit;
            }
        

    }



}



?>



