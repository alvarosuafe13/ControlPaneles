<?php 

$template = $_POST["templateName"];
$pantallas = $_POST["pantallasSeleccionadas"];



?>


<div class="step3-header">
    <table cellpadding="0" cellspacing="0" border="0">
        <thead>
        <tr>
            <th></th>
            <th>Rellena los campos</th>
            <th></th>

            </th>
        </thead>
    </table>
</div>

<form id="change_screen" name="change_screen" method="post" autocomplete="off">
    <div class="step3-body">

        
            <input id="title_template1"  placeholder="Escribe un título:" type="text" maxlength="70"  name="title">  
             <?php $i = 0; foreach ($pantallas as $codPantalla => $pantalla) {
                    #Se contruye un string que se usara en el campo name del checkbox para referirse a un array cuya clace es el codPantalla
                    $checkboxName = "pantallasSeleccionadas[".$codPantalla."]";

                ?>
            <input type="hidden" name="<?php echo $checkboxName; ?>" value="<?php echo $pantalla;?>" >

             <?php } ?>

             <input type="hidden" name="template" value="<?php echo $template;?>" >
        

    </div >
    <div id="template_buttons">
    <input  class="btn btn-primary" type="submit" formaction="index.php?controller=Screens&amp;action=refresh" value="Hacer Cambios">
    <input  class="btn btn-primary" type="submit" formaction="index.php?controller=Screens&amp;action=show" value="Volver">
    </div>
</form>
