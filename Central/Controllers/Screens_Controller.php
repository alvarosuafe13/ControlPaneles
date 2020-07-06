<?php

require_once("Models/Screens_Model.php");
require_once("Models/AdminSession_Model.php");
require_once("Controllers/Admin_Controller.php");


class ScreensController
{

    public function __construct()
    {
    }

    public function show()
    {

        //Usaremos el archivos que contiene datos de configuracion para obtener el codigo del evento actual
       /* $file = file_get_contents("/home/pi/Pantalla/evento.json");
        $json = json_decode($file, true);

        $codEvento = "CodEvento=".$json['CodEvento'];

        //$url = "http://192.168.181.1/dashboard/server/PDO/recuperarpantallas.php";
        $url = "http://192.168.181.1/dashboard/server/PDO/recuperarpantallas.php";


        $ch = curl_init($url);

        // Establecer un tiempo de espera
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

        // Establecer NOBODY en true para hacer una solicitud tipo HEAD
        curl_setopt($ch, CURLOPT_NOBODY, true);
        // Permitir seguir redireccionamientos
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        // Recibir la respuesta como string, no output
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


        $data = curl_exec($ch);

        // Obtener el código de respuesta
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);


        // Aceptar solo respuesta 200 (Ok), 301 (redirección permanente) o 302 (redirección temporal)
        $accepted_response = array(200, 301, 302);


        if (in_array($httpcode, $accepted_response)) {

            // definimos la URL a la que hacemos la petición(AQUÍ SE HARÁ LA PETICIÓN AL SERVER DE JAVI)
            // curl_setopt($conexion_curl, CURLOPT_URL, "http://192.168.0.14/dashboard/server/PDO/recuperarpantallas.php");
            // indicamos el tipo de petición: POST
            curl_setopt($ch, CURLOPT_POST, TRUE);
            // definimos cada uno de los parámetros
            curl_setopt($ch, CURLOPT_POSTFIELDS, $codEvento);

            // recibimos la respuesta y la guardamos en una variable
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //con CURLOPT_RETURNTRANSFER se indica que en caso de ser true devuelva el resultado
            $info_pantallas_evento = curl_exec($ch);

            // cerramos la sesión cURL
            curl_close($ch);

            $array_info = json_decode($info_pantallas_evento, true);
            if($array_info["Msg"]==3){
                $pantallas = $array_info['Pantallas'];
            }



            //var_dump($pantallas);

            require_once("Views/Screens_View.php");

        } else {
            echo "Ha habido un error al obtener las pantallas del servidor";
        }*/



        $file = file_get_contents("/home/pi/Pantalla/evento.json");
        $json = json_decode($file, true);

        $codEvento = $json['CodEvento'];
        // header("Content-Type:application/json");

        $screens = new ScreensModel($codEvento);



        $infoEvento = $screens->getScreens();
            if($infoEvento["Msg"]==3){



                $pantallas = $infoEvento['Pantallas'];
            }


        /*$mbd = $dbs->connection();
        $stmt = $mbd->prepare("SELECT CodPantalla,IpPantalla,NomPantalla FROM PANTALLAS WHERE CodEvento = ?");
        $stmt->execute(array($codEvento));
        $pantallas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(count($pantallas) >0) {

            $info = array('CodEvento' => $codEvento);
            $info['Msg'] = 3;
            foreach ($pantallas as $pantalla) {
                $info['Pantallas'][$pantalla["CodPantalla"]] = [$pantalla["IpPantalla"] , $pantalla["NomPantalla"]];
            }

        } else {//No existen pantallas registradas para ese evento
            $info = array('Msg' => 4);

        }



        $mbd = null;
       // $pantallas = json_encode($info,JSON_NUMERIC_CHECK);
        $array_info = json_decode($info, true);
        if($array_info["Msg"]==3){
            $pantallas = $array_info['Pantallas'];
        }*/
        require_once("Views/Screens_View.php");



        /*
                // abrimos la sesión cURL
                $conexion_curl = curl_init();

                // definimos la URL a la que hacemos la petición(AQUÍ SE HARÁ LA PETICIÓN AL SERVER DE JAVI)
                curl_setopt($conexion_curl, CURLOPT_URL, "http://192.168.0.14/dashboard/server/PDO/recuperarpantallas.php");
                // indicamos el tipo de petición: POST
                curl_setopt($conexion_curl, CURLOPT_POST, TRUE);
                // definimos cada uno de los parámetros
                curl_setopt($conexion_curl, CURLOPT_POSTFIELDS, "CodEvento=AAAAAA2019");

                // recibimos la respuesta y la guardamos en una variable
                curl_setopt($conexion_curl, CURLOPT_RETURNTRANSFER, true);
                $info_pantallas_evento = curl_exec ($conexion_curl);

                // cerramos la sesión cURL
                curl_close ($conexion_curl);

                $array_info = json_decode($info_pantallas_evento, true);
                $pantallas = $array_info['Pantallas'];

                //var_dump($pantallas);
                /*
                exec("/usr/bin/python3 /var/www/html/prueba.py", $salida);
                $array = json_decode($salida);

                var_dump($salida);
                var_dump($array);*/

        // require_once("Views/Screens_View.php");
    }

    public function showScreen(){

        
        
    }

    public function delete(){
        $file = file_get_contents("/home/pi/Pantalla/evento.json");
        $json = json_decode($file, true);

        $codEvento = $json['CodEvento'];
        // header("Content-Type:application/json");

        $screens = new ScreensModel($codEvento);
        $screens->deleteEvent();

        $this->show();
        //require_once("Views/Screens_View.php");


    }


    //Devuelve el contenido de la plantilla que hemos selecionado
    private function readTemplate($template){
        $plantilla = "./Templates/". $template .".php";
        $leer = fopen($plantilla, 'r+');
        $data = fread($leer, filesize($plantilla));
        fclose($leer);

        return $data;
    }

    //Anhade el titulo a la plantilla que se encuentra en una variable temporal
    private function changeTitle($title, $emptyTemplate){
        $patron = '/<\/h1>/';
        $formato = $title.'</h1>';
        $final = preg_replace($patron, $formato, $emptyTemplate);

        return $final;
    }

    //Anhade el texto de un texarea a la plantilla que se encuentra en una variable temporal
    private function changeParagraph($text, $emptyTemplate){
        $patron = '/<\/p1>/';
        $formato = $text.'</p1>';
        $final = preg_replace($patron, $formato, $emptyTemplate);

        return $final;
    }


    private function writeScreenTemplate($codPantalla, $newTemplate){
        $url = "./Raspberries/" . $codPantalla . ".php";
        $file = fopen($url, "w");
        fwrite($file, $newTemplate);
        fclose($file);


    }


    //Se mueve la imagen selecionada a un directorio de la central y se anhade el tag <img> al codigo
    private function moveImage($newTemplate){
        $upload_dir = 'Images/';
        //$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION); 
        //$image_name = 'Images/'. $_FILES['image']['name'];
        $_FILES['image']['name'] = 'template3_image';
        $nombre_tmp =  $_FILES['image']['tmp_name'];
        $uploaded_image = $upload_dir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $uploaded_image);
            $patron = '/<\/h1>/';
            $formato ='</h1> <img id="template3-img" src="../Images/template3_image" >';
            $final = preg_replace($patron, $formato, $newTemplate);
            return $final;
        
    }

    private function addDynamicInputs($textInputs, $emptyTemplate){
        $patron = '/<\/p1>/';
        $i = 1;
        $formato="";
        foreach ($textInputs as $input) {
            $formato = $formato."<h2 class='h2_template5'>".$i."- ".$input."</h2><br>";
            $i++;
        }

        $formato = $formato.'</p1>';
        $final = preg_replace($patron, $formato, $emptyTemplate);

        return $final;
    }


    public function refresh()
    {
        if (isset($_POST["pantallasSeleccionadas"])) {
            $pantallas = $_POST["pantallasSeleccionadas"];
            $template = $_POST["template"];

            foreach ($pantallas as $codPantalla => $ipPantalla) {


                switch ($template) {
                    case 'template1':
                        $title = $_POST["title"];

                        //Se almacena en una variable en contenido de la plantilla
                        $emptyTemplate = $this->readTemplate($template);
                        //Se inseta un titulo en la variable que contiene la plantilla base
                        $newTemplate = $this->changeTitle($title,$emptyTemplate);
                        //Se escribe el contenido final en el fichero que muestra las raspberrie en el navegador
                        $writtenTemplate = $this->writeScreenTemplate($codPantalla, $newTemplate);

                        break;
                    case 'template2':
                        $title = $_POST["title"];
                        $text = $_POST["text"];

                        $emptyTemplate = $this->readTemplate($template);
                        $newTemplate = $this->changeTitle($title,$emptyTemplate);
                        $newTemplate = $this->changeParagraph($text,$newTemplate);
                        $writtenTemplate = $this->writeScreenTemplate($codPantalla, $newTemplate);

                        //echo $text;
                        break;

                    case 'template3':
                        $title = $_POST["title"];

                        $emptyTemplate = $this->readTemplate($template);
                        $newTemplate = $this->changeTitle($title,$emptyTemplate);
                
                        if($_FILES["image"]["name"]) {
                            $newTemplate = $this->moveImage($newTemplate);
                        } 

                        $writtenTemplate = $this->writeScreenTemplate($codPantalla, $newTemplate);


                        //echo $_FILES['image']['name'];
                        //echo $title;

                       
                        break;
                    case 'template4':
                        
                        $textInputs = $_POST["textInputs"];
                        if($_POST["title"] != ""){
                            $title = $_POST["title"].":";
                        }
                        $title = $_POST["title"];

                
                        $emptyTemplate = $this->readTemplate($template);
                        $newTemplate = $this->changeTitle($title,$emptyTemplate);
                        $newTemplate = $this->addDynamicInputs($textInputs,$newTemplate);
                        $writtenTemplate = $this->writeScreenTemplate($codPantalla, $newTemplate);

                        break;

                    case 'template5':
                        
                        $text = $_POST["text"];

                        $emptyTemplate = $this->readTemplate($template);
                        $newTemplate = $this->changeParagraph($text,$emptyTemplate);
                        $writtenTemplate = $this->writeScreenTemplate($codPantalla, $newTemplate);

                        break;


                    default:
                        # code...
                        break;
                }

                $this->refreshScreen($ipPantalla);

                }


            }

            sleep(0.5);

            // header('Location: ./index.php');

        }

    private function refreshScreen($ipPantalla){
        //Luego de hacer los cambios en los fichero que son mostrados en las pantallas de las rasbperries se refresca 
        //el navegador de dichas raspberries para actualizar con el nuevo contenido
        //sleep(0.5);
        $con = ssh2_connect($ipPantalla, 22);

        ssh2_auth_password($con, "pi", "alvaro");

        ssh2_exec($con, "/bin/sh /home/pi/Pantalla/refresh.sh");
        ssh2_disconnect ( $con) ;
        $this->show();

    }


    // Apaga el panel selecionado
    public function powerOff(){
        $ipPantalla = $_GET["ipPantalla"];

        $file = file_get_contents("/home/pi/Pantalla/evento.json");
        $json = json_decode($file, true);

        $codEvento = $json['CodEvento'];

        $screens = new ScreensModel($codEvento);
        $screens->deleteScreen($ipPantalla);



        $con = ssh2_connect($ipPantalla, 22);

        ssh2_auth_password($con, "pi", "alvaro");

        ssh2_exec($con, "sudo poweroff");
        ssh2_disconnect ( $con) ;

        $this->show();

    }


        // Apaga el panel Central que es el servidor, se hace diferencia porque al apagar el central la página web deja de funcionar y se necesita cerrar sesion y volver al login, además se apagan el resto de pantallas
     public function powerOffServer(){


        //ip del servidor
        $ipServer = $_GET["ipPantalla"];

        //Se obtiene el codigo del evento del fichero json
        $file = file_get_contents("/home/pi/Pantalla/evento.json");
        $json = json_decode($file, true);
        $codEvento = $json['CodEvento'];

        $screens = new ScreensModel($codEvento);
        $admin = new AdminSession();


        $infoEvento = $screens->getScreens();

        $pantallas = $infoEvento['Pantallas'];


        //Se borran todas las pantallas del evento pues se va a apagar el servidor
        $screens->deleteEvent();

        //Se borra el administrador del evento
        $admin->deleteAdmin($codEvento);


        //En este bucle se apagan todos los paneles menos el central que tiene el servidor pues debe de apagarse de último
        foreach ($pantallas as $codPantalla => $pantalla) {

            if($pantalla[0] != $ipServer){
                $ssh = ssh2_connect($pantalla[0], 22);

                ssh2_auth_password($ssh, "pi", "alvaro");

                ssh2_exec($ssh, "sudo poweroff");
                ssh2_disconnect ( $ssh) ;

            }



        }

        AdminController::logout();
        //Se apaga el panel con el servidor
        $con = ssh2_connect($ipServer, 22);

        ssh2_auth_password($con, "pi", "alvaro");

        ssh2_exec($con, "sudo /home/pi/Pantalla/apagar.sh");

        ssh2_disconnect ( $con) ;




    }

/*
    public function showContentScreem(){
        $codEvento = $_GET['codPantalla'];

        http_redirect('/Views/screenContent_View.php', array("codEvento" => $codEvento), true, HTTP_REDIRECT_PERM);
        //require_once('./Views/screenContent_View.php');


    }
*/
    public function blank(){
        $codPantalla = $_GET["codPantalla"];
        $ipPantalla = $_GET["ipPantalla"];
        $template = "template0.php";
        $emptyTemplate = $this->readTemplate("template0");
        $writtenTemplate = $this->writeScreenTemplate($codPantalla, $emptyTemplate);
        $this->refreshScreen($ipPantalla);
    }   

    private function readRaspberryScreen($raspberryScreen){
        $plantilla = "./Raspberries/". $raspberryScreen .".php";
        $leer = fopen($plantilla, 'r+');
        $data = fread($leer, filesize($plantilla));
        fclose($leer);

        return $data;
    }

    private function readTemplate5AuxView(){
        $template5View = "./Views/Template5_AuxView.php";
        $leer = fopen($template5View, 'r+');
        $data = fread($leer, filesize($template5View));
        fclose($leer);

        return $data;
    }

    private function addBody($currentScreem, $template5View){
        $patron = '/<div contenteditable="true">/';
        $formato = '<div contenteditable="true">'.$currentScreem;
        $html = preg_replace($patron, $formato, $template5View);
        $this-> writeTemplate5View($html);

    }

    private function writeTemplate5View($html){
        $route = "./Views/Template5_View.php";
        $file = fopen($route, "w");
        fwrite($file, $html);
        fclose($file);
    }

    public function choose(){

        $templateName = $_POST["templateName"];
        $pantallas = $_POST["pantallasSeleccionadas"];

        switch($templateName){
            case "template1":
                require_once("Views/Template1_View.php");
                break;

            case "template2":
                require_once("Views/Template2_View.php");
                break;

            case "template3":
                require_once("Views/Template3_View.php");
                break;
            case "template4":
                require_once("Views/Template4_View.php");
                break;
            case "template5":
                //Se trata de en caso de solo seleccionar una pantalla mostrar su contenido en el textarea
                if(count($pantallas) === 1){
                    $raspberryScreen = key($pantallas);
                    $template5View = $this->readTemplate5AuxView();
                    $currentScreem = $this->readRaspberryScreen($raspberryScreen);
                    $this->addBody($currentScreem, $template5View);
                }
                else{
                    $template5View = $this->readTemplate5AuxView();
                    $this->writeTemplate5View($template5View);
                }
                require_once("Views/Template5_View.php");
                break;
            case "template6":


                //$template = 
               // $currentScreem = readTemplate()
                require_once("Views/Template6_View.php");
                break;
            default:
                break;
        }


    }



    }



?>



