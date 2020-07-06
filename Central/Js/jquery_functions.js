$(document).ready(function() {


   
    //Se asisgna el el estado uncheck al boton
    $("#checkAll").attr("data-type", "uncheck");



    //Al ir seleccionando las pantallas se pone su checkbox correspondiente en el estado "check"
    $(".screens").click(function() {
        $("#checkAll").attr("data-type", "uncheck");
        var divs = document.getElementsByClassName("screens");
        if($(this).attr("data-type") === "check"){
            $(this).attr("data-type", "uncheck");
        }else{
            $(this).attr("data-type", "check");
        }

        let allCheck = 0;
        let count = document.getElementsByClassName("screens").length;

        //Se necesita comprobar siempre si todas los checkbox han sido seleccionados
        //En caso de que se hayan seleccionado todos se pondra el valor del boton también como "check"
        //Ademas si todos estan seleccionados cambiara el nombre del boton
        for(i = 0; i < count; i++){
            id = "#screen"+i;
            if($(id).attr("data-type") === "check"){
                allCheck = allCheck +1;
            }
        }

        if(allCheck === count){
            $("#checkAll").html("Borrar");
        }
        else{
            $("#checkAll").html("Seleccionar");
        }
    });




    //Al pulsar el botón se seleccionaran todos los checkbox
    //En caso de estar todos ya seleccionados se reseteran al estado "uncheck"
    $("#checkAll").click(function() {
        let allCheck = 0;
        let count = document.getElementsByClassName("screens").length;

        for(i = 0; i < count; i++){
            id = "#screen"+i;
            if($(id).attr("data-type") === "check"){
                allCheck = allCheck +1;
            }
        }

        if(allCheck === count){
            $("#checkAll").attr("data-type", "check");
        }

        if ($("#checkAll").attr("data-type") === "uncheck") {
            $(".screens").prop("checked", true);
            $("#checkAll").attr("data-type", "check");

            $("#checkAll").html("Borrar");
            for(i = 0; i < count; i++){
                id = "#screen"+i;
                $(id).attr("data-type", "check");
            }

        } else {
            $("#checkAll").html("Seleccionar");
            $(".screens").prop("checked", false);
            $("#checkAll").attr("data-type", "uncheck");
            for(i = 0; i < count; i++){
                id = "#screen"+i;
                $(id).attr("data-type", "uncheck");

            }
        }
    });



    var actual = 1,pasoActual,siguientePaso,pasos;
    
    pasos = $("fieldset").length;
    
    $("#next1").click(function(){
        let someCheck = false;
        let count = document.getElementsByClassName("screens").length;

        for(i = 0; i < count; i++){
            id = "#screen"+i;
            if($(id).attr("data-type") === "check"){
                someCheck = true;
            }
        }

        if(someCheck == true){
            pasoActual = $(this).parent();
            siguientePaso = $(this).parent().next();
            siguientePaso.show();
            pasoActual.hide();
        }
        else{
            swal("Debes seleccionar alguna pantalla ","", "error");
        }
    });

    $("#deleteEvent").click(function() {

    swal("Esto borrará toda la BD para este evento", {
      buttons: {
        catch: {
          text: "Borrar de todos modos",
          value: "catch",
        } ,
        cancel: "Cancelar"
     },
    })
    .then((value) => {
      switch (value) {
     
        case "catch":
          const form = document.createElement('form');
          form.method = "post";
          form.action = "index.php?controller=Screens&action=delete";
          document.body.appendChild(form);
          swal("Eliminado!", "Se ha eliminado este evento de la Bade de Datos!", "success", {
          buttons: {
                catch: {
                  text: "OK",
                  value: "ok",
                } 
             },
            })
            .then((value) => {
              switch (value) {
             
                case "ok":
                  form.submit();
                  break;
             
                default:
                  form.submit();

              }
            });
          break;
     
        default:
      }
    });

    });

    $(".PowerOffScreen").click(function() {
              
        swal({title:"¡¡Atención!!",
          text:"Esto apagará y borrará el panel de la Base de Datos", 
          icon: "warning",
          buttons: {
            catch: {
              text: "Apagar y Borrar de todos modos",
              value: "catch",
            } ,
            cancel: "Cancelar"
         },
        })
        .then((value) => {
          switch (value) {
         
            case "catch":
              const form = document.createElement('form');

              var value = $(this).attr("value");
              //console.log(value);
              form.method = "post";
              form.action = "index.php?controller=Screens&action=powerOff&ipPantalla="+value;
              document.body.appendChild(form);
             
              swal("Borrado y Eliminado!", "Se ha Apagado y Eliminado el Panel!", "success", {
              buttons: {
                    catch: {
                      text: "OK",
                      value: "ok",
                    } 
                 },
                })
                .then((value) => {
                  switch (value) {
                 
                    case "ok":
                        form.submit();
                        break;
                 
                    default:
                         form.submit();
                      

                  }
                });
              break;
         
            default:
          }
        });

    });



    //funcion muy parecida a la anterior y redundante pero necesaria pues si se desea apagar el panel central que contiene el servidor
    //el resto de paneles deben de ser apagados tambien y borrados de la base de datos pues la aplicación web dejará de estar disponible
    $(".PowerOffServerScreen").click(function() {
              
        swal({
          title:"¡¡Atención!!",
          text:"Estás intentando apagar el PANEL CENTRAL!! \n\n Esta acción apagará el resto de paneles también!!" , 
          icon: "warning",
          buttons: {
            catch: {
              text: "Apagar de todos modos",
              value: "catch",
            } ,
            cancel: "Cancelar"
         },
         dangerMode: true,
        })
        .then((value) => {
          switch (value) {
         
            case "catch":
              const form = document.createElement('form');

              var value = $(this).attr("value");
              console.log(value);
              form.method = "post";
              form.action = "index.php?controller=Screens&action=powerOffServer&ipPantalla="+value;
              document.body.appendChild(form);
             
              swal("Borrado y Eliminado!", "Se ha Apagado y Eliminado el Panel!", "success", {
              buttons: {
                    catch: {
                      text: "OK",
                      value: "ok",
                    } 
                 },
                })
                .then((value) => {
                  switch (value) {
                 
                    case "ok":
                        form.submit();
                        break;
                 
                    default:
                         form.submit();
                      

                  }
                });
              break;
         
            default:
          }
        });

    });


    $("#previous").click(function(){
        pasoActual = $(this).parent();
        siguientePaso = $(this).parent().prev();
        siguientePaso.show();
        pasoActual.hide();
    });

    $(".template").click(function(){
        var template = $(this).attr("id");
        console.log(template);
        const hiddenField = document.createElement('input');
        hiddenField.type = 'hidden';
        hiddenField.name = 'templateName';
        hiddenField.value = template;
        this.appendChild(hiddenField);
        document.getElementById("wizard").submit();


    });

    

    /***CONTROL DE LA TEMPLATE3 QUE REQUIERE SELECCIONAR UNA IMAGEN***/
    //Perimite seleccionar una imagen del equipo y mostrarla al momento en el formulario
    $("#my-file").change(function () {
            if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('img').remove();
                $('.step3-body').append('<img id="image_template3" src="'+e.target.result+'"/>');
            }
            reader.readAsDataURL(this.files[0]);
        }

    });

/*
        $(".template").click(function(){
        var tempaltesArray = ["#template1-form","#template2-form","#template3-form","#template4-form","#template5-form"];
        pasoActual = $(this).parent().parent().parent();
        siguientePaso = $(this).parent().parent().parent().next();
        var selectedTemplate = "#"+$(this).attr('id')+"-form";      
        removeItemFromArr(tempaltesArray, selectedTemplate)    

        for(var i in tempaltesArray){
            $(tempaltesArray[i]).hide();
        }
    
        siguientePaso.show();
        pasoActual.hide();      
    });*/



   
   /* function removeItemFromArr ( arr, item ) {
        var i = arr.indexOf( item );
     
        if ( i !== -1 ) {
            arr.splice( i, 1 );
        }
    }*/




    /***CONTROL DE LA LISTA DINÁMICA EN TEMPLATE4***/
    //Permite ir agregando campos numerados a la lista y si se borra uno se mantiene el orde de los numeros
    var maxField = 7; 
    var x = 1; 
   
    $('.add_button').click(function(){
      
        if(x < maxField){ 
             
            x++;
           $('.step3-body').append('<div><h2 class="h2_template4">'+x+'- </h2><input class="text_template4" maxlength="80" type="text" style=" font-family: Georgia, "Times New Roman", serif;" name="textInputs[]"><a href="javascript:void(0);" class="remove_button" title="Borrar Campo"><img src="icons/remove.png"/></a><br></div>');
        }
    });
    
   
    $('.step3-body').on('click', '.remove_button', function(e){
        e.preventDefault();      
        x--; 
        inputText = $('#div_text_template4_1');
        $(this).parent('div').remove(); 

        for(i=2 ; i<=x ; i++ ){
            var next=".next()"
            
            inputText.next().children("h2").text(i+"- ");  
            inputText = $(inputText).next();  
        }
        
    });



});