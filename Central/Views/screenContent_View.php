<head>
  
      <link rel="stylesheet"  href="../lib/bootstrap-4.4.1-dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="../css/screenContentView.css?v=<?php echo time(); ?>" />

</head>


    <form  autocomplete="off">
        


            <div  id="bodyScreen" >

              <?php 
              $codPantalla = $_GET['codPantalla'];
              require_once("../Raspberries/".$codPantalla.".php");
               ?>
            </div>
                    

      <footer  style="width:100%; margin-left: 0px;"  >


      <div id="template_buttons">
      <input  class="btn btn-primary" type="submit" formaction="../index.php?" value="Volver">
      </div>




    </form>
        


