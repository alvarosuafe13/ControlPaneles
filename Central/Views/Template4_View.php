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

        
        <input id="title_template4"  placeholder="Título de la lista" type="text" maxlength="50"  name="title">  <h1 style="display: inline">:</h1>


       <div id="div_text_template4_1"> <h2 id="h2_template4_1" class="h2_template4">1- </h2>
            <input class="text_template4" maxlength="80" type="text" style=" font-family: Georgia, 'Times New Roman', serif;" name="textInputs[]">  
            <a href="javascript:void(0);" class="add_button" title="Añadir Campo"><img src="icons/add.png"/></a>
            <br>
        </div>



       

    </div>

             <?php $i = 0; foreach ($pantallas as $codPantalla => $pantalla) {
                    #Se contruye un string que se usara en el campo name del checkbox para referirse a un array cuya clace es el codPantalla
                    $checkboxName = "pantallasSeleccionadas[".$codPantalla."]";

                ?>
            <input type="hidden" name="<?php echo $checkboxName; ?>" value="<?php echo $pantalla;?>" >

             <?php } ?>

             <input type="hidden" name="template" value="<?php echo $template;?>" >

    <div id="template_buttons">
    <input class="btn btn-primary" type="submit" formaction="index.php?controller=Screens&amp;action=refresh" value="Hacer Cambios">
    <input class="btn btn-primary" type="submit" formaction="index.php?controller=Screens&amp;action=show" value="Volver">
    </div>

</form>
