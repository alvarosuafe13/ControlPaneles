
<?php if($infoEvento['Msg'] == 3) {?>


    <form id="wizard" name="choose_screen" method="post" autocomplete="off" action="index.php?controller=Screens&amp;action=choose">
        
        <fieldset>
            <div class="step1-header">
                <table >
                    
                        <tr>
                            <th>Nombre Pantalla</th>
                            <th>Ip</th>
                            <th>Código</th>
                            <th>Acción</th>
                            <th> <button id="checkAll" class="btn btn-light" type="button"> Seleccionar</button></th>
                           
                        </tr>
                    
                </table>
            </div>


            <div  id="step1-body" class="table-responsive">
            <table class="table" >
                <tbody>


                    <?php $i = 0; foreach ($pantallas as $codPantalla => $pantalla) {
                        #Se contruye un string que se usara en el campo name del checkbox para referirse a un array cuya clace es el codPantalla
                        $checkboxName = "pantallasSeleccionadas[".$codPantalla."]";

                        $idCheckbox = "screen".$i;
                        $i++;?>
                <tr>
                    <td><?php echo $pantalla[1] ;?></td>
                    <td><?php echo $pantalla[0] ; ?></td>
                    <td><?php echo $codPantalla; ?></td>
                    <td>
                      <li >

                        <a  href="Views/screenContent_View.php?codPantalla=<?php echo $codPantalla; ?>">
                          <img src="icons/eye.png" title="Ver" width="64px" height="64px">
                        </a>
                        <a  href="index.php?controller=Screens&amp;action=blank&amp;codPantalla=<?php echo $codPantalla; ?>&amp;ipPantalla=<?php echo $pantalla[0] ;  ?>"   >
                          <img src="icons/blank.png" title="Limpiar" width="32px" height="32px">
                        </a>

                        <?php if($codPantalla == 'R0'){ ?>

                          <a class="PowerOffServerScreen"  name="deleteScreen"  value="<?php echo $pantalla[0]; ?>"  >
                          <img src="icons/poweroff.png" title="Apagar" width="32px" height="32px">
                          </a>

                        <?php } else{?>

                          <a class="PowerOffScreen"  name="deleteScreen"  value="<?php echo $pantalla[0]; ?>"  >
                          <img src="icons/poweroff.png" title="Apagar" width="32px" height="32px">
                          </a>

                        <?php } ?>

                      </li>
                    </td>

                    <td>

                        <input id="<?php echo $idCheckbox; ?>"  class="screens" type="checkbox"  name="<?php echo $checkboxName; ?>" value="<?php echo $pantalla[0];?>" >    <label  for="<?php echo $idCheckbox; ?>"></label>

                    </td>
                </tr>

                    <?php } ?>
                </tbody>
            </table>
            </div>
                    
     <!-- <button type="button" id="deleteEvent" title="Eliminar el evento" class="btn btn-danger">Eliminar</button> -->

      <button type="button" id="next1" class="btn btn-primary" value="Siguiente" >Siguiente</button>


        </fieldset>
        
        <fieldset>
            <div class="step2-header">
                <table cellpadding="0" cellspacing="0" border="0">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Selecciona una plantilla</th>
                        <th></th>

                        </th>
                    </thead>
                </table>
            </div>
            <div class="step2-body">

                <div id="grid">
                  <div class="template" id="template1">
                    <h1>Título en el centro</h1>
                  </div>
                  <div class="template" id="template2">
                    <h1>Título y texto</h1>
                  </div>

                  <div class="template" id="template3">
                    <h1>Título e imagen</h1>
                  </div>
                  <div class="template" id="template4" >
                    <h1>Lista dinámica</h1></div>
                  <div class="template" id="template5" >
                    <h1>Estilo libre</h1></div>
                </div>
                
            </div>
            <button type="button" id="previous" class="btn btn-primary" value="Anterior" >Anterior</button>

            
        </fieldset>

    </form>
        




<style type="text/css">
  #wizard fieldset:not(:first-of-type) {
    display: none;
  }
  </style>


    <?php
}elseif ($infoEvento['Msg'] == 4) { ?>
  <div class="step1-header">
      <table cellpadding="0" cellspacing="0" border="0">
          <thead>
              <tr>
                  <th>Nombre Pantalla</th>
                  <th>Ip</th>
                  <th>Acción</th>
                  <th>Selecionar</th>
              </tr>
                  <th></th>
                  <th></th>
                   <th></th>
              </tr>
          </thead>
      </table>
  </div>
  <div  class="step1-body">
    <table cellpadding="0" cellspacing="0" border="0">
        <tbody>

        </tbody>
      </table>
    </div>



 <?php
}else {
        echo "Algo ha ido mal";
}
?>