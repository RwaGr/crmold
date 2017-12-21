<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>


<link rel="icon" href="../../<?php echo $_SESSION['install_page'];?>/images/favicon.png" type="image/x-icon">

<div  id="header">

<link rel="stylesheet" href="../../<?php echo $_SESSION['install_page'];?>/css/style.css">



<?php
require_once '../../'.$_SESSION['install_page'].'/config.php';
require_once '../../'.$_SESSION['install_page'].'/header.php';
?>

</div>


<?php

if (isset($_POST['submitupdate'])) {
    
  //echo '<script> alert("GETTING IT'.$_POST['companynameupdate'].'"); </script> ';    

    // starts here the img uploading


    if($_POST['contact_img_old2'] != $_FILES["imgInp2"]["name"]){

      if (!empty($_FILES["imgInp2"]["name"])) {

        if (!empty($_POST['contact_img_old2'])) {
          if (file_exists("../../".$_SESSION['install_page']."/images/companies/".$_POST['contact_img_old2'])) {
            
          unlink("../../".$_SESSION['install_page']."/images/companies/".$_POST['contact_img_old2']);         
          }
        } else {
          if (!empty($_POST['contact_img_old3'])) {
            if (file_exists("../../".$_SESSION['install_page']."/images/companies/".$_POST['contact_img_old3'])) {
              
            unlink("../../".$_SESSION['install_page']."/images/companies/".$_POST['contact_img_old3']);  
            }       
          } 
        }

$target_dir1 = "../../".$_SESSION['install_page']."/images/companies/";
$target_file1 = $target_dir1 . basename($_FILES["imgInp2"]["name"]);


  if(!empty(trim($_POST['contact_img_old2']))){
    if (file_exists("../../".$_SESSION['install_page']."/images/companies/".$_POST['contact_img_old2'])) {
      
  unlink("../../".$_SESSION['install_page']."/images/companies/".$_POST['contact_img_old2']);
    }
  }



  $cadena = $_POST['companynameupdate'];
  
  $cadena = mb_strtolower($cadena);
  
  $patrones = array();
  $patrones[0] = '/ñ/';
  $patrones[1] = '/ó/';
  $patrones[2] = '/á/';
  $patrones[3] = '/é/';
  $patrones[4] = '/í/';
  $patrones[5] = '/ú/';
 

  $sustituciones = array();
  $sustituciones[5] = 'n';
  $sustituciones[4] = 'o';
  $sustituciones[3] = 'a';
  $sustituciones[2] = 'e';
  $sustituciones[1] = 'i';
  $sustituciones[0] = 'u';

 /* echo preg_replace($patrones, $sustituciones, $cadena)."<br>";*/



$uploadOk = 1;
$key4 = date("Hi");
$imageFileType1 = pathinfo($target_file1,PATHINFO_EXTENSION);
$target_file = $target_dir1 .preg_replace($patrones, $sustituciones, $cadena).$key4.".".$imageFileType1;
$imgtouploadcontact1 = preg_replace($patrones, $sustituciones, $cadena).$key4.".".$imageFileType1;

if (file_exists($target_file)) {
 //   echo "Sorry, file already exists.";
  $uploadOk = 1;}
// Check file size
if ($_FILES["imgInp2"]["size"] > 2000000) {
    echo '<script> alert("Max. 2MB");</script>'; 
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType1 != "jpg" && $imageFileType1 != "png" && $imageFileType1 != "jpeg"
&& $imageFileType1 != "gif" && $imageFileType1 != "JPG" && $imageFileType1 != "PNG" && $imageFileType1 != "JPEG" && $imageFileType1 != "GIF"){
    echo '<script> alert("Solamente se permiten archivos JPG, JPEG, PNG y GIF'.$imageFileType1.'-'.$target_file1.'");</script>';
    $uploadOk = 2;
}
// Archivo demasiado pesado
if ($uploadOk == 0) {
    echo '<script> alert("El archivo es demasiado pesado...");</script>';
 // Archivo diferente formato   
} elseif($uploadOk == 2) {
// Carga del archivo
} elseif($uploadOk == 1) {
    if (move_uploaded_file($_FILES["imgInp2"]["tmp_name"], $target_file)) {
      //   echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";



    } else {
      // Error al cargar archivo
        echo '<script> alert("No se ha podido cargar la imagen...");</script>';
        
      }
    }

  } else {


    $imgtouploadcontact1 = $_POST['contact_img_old2'];
    
  }

} else {

  if (!empty($_POST['contact_img_old3'])) {
    if (file_exists("../../".$_SESSION['install_page']."/images/companies/".$_POST['contact_img_old3'])) {
      
    unlink("../../".$_SESSION['install_page']."/images/companies/".$_POST['contact_img_old3']); 
    }        
  } 

  $imgtouploadcontact1 = $_POST['contact_img_old2'];

}



//end of the img uploading



  $alm->__SET('companyname', $_POST['companynameupdate']);
  $alm->__SET('industry', $_POST['companyindustryupdate']);
  $alm->__SET('rf', $_POST['companyrfupdate']);
  $alm->__SET('quant', $_POST['companyemployeesupdate']);
  $alm->__SET('notes', $_POST['companynotesupdate']);
  $alm->__SET('responsable', $_POST['companyresponsableupdate']);
  $alm->__SET('address', $_POST['companyaddressupdate']);
  $alm->__SET('companyimg', $imgtouploadcontact1);
  $alm->__SET('website', $_POST['companyurlupdate']);
  $alm->__SET('companyidvar', trim($_POST['companyidupdate']));


$model->updatecompany($alm);


}





if (isset($_POST['addcompany'])) {

  //check that the fields are not empty
  if (!empty(trim($_POST['nombreempresa']))) {
    
  $almrc = $model->getcompaniescount($_POST['nombreempresa']);
  
    if($almrc->__GET('rowcount') > 0) { 

    echo '<script> alert("La empresa '.$_POST['nombreempresa'].' existe"); </script> ';

    echo '<script type="text/javascript">location.href = "'.$homeurl.'pages/company'.$session.'&action=new";</script>';
  

    } else {

if (!empty(trim($_POST['rfcompany']))){

      $almrf = $model->checkrut($_POST['rfcompany']);
      
        if($almrf->__GET('rowcount') > 0) { 
      
    echo '<script> alert("El RUT '.$_POST['rfcompany'].' pertenece a la empresa '.$almrf->__GET('name').'"); </script> ';
          

    echo '<script type="text/javascript">location.href = "'.$homeurl.'pages/company'.$session.'&action=new";</script>';
    



        } else {
// se trabaja aqui
  //  echo '<script> alert("NO existe1"); </script> ';


  if (empty($_POST['industry']) || empty($_POST['employees']) || empty($_POST['inputid'])) {

    echo '<script> alert("Debe rellenar todos los campos"); </script> ';    

    echo '<script type="text/javascript">location.href = "'.$homeurl.'pages/company'.$session.'&action=new";</script>';
    

  } else {

    $stop = 1;
    
  }

        }

    } else {
// Se trabaja aqui
   //   echo '<script> alert("NO existe2"); </script> ';
   if (empty($_POST['industry']) || empty($_POST['employees']) || empty($_POST['inputid'])) {
    
        echo '<script> alert("Debe rellenar todos los campos"); </script> ';    
    
        echo '<script type="text/javascript">location.href = "'.$homeurl.'pages/company'.$session.'&action=new";</script>';
        

      } else {
    
        $stop = 1;
        
      }


    }

  }


} else {

  echo '<script> alert("Debe rellenar todos los campos"); </script> ';

  echo '<script type="text/javascript">location.href = "'.$homeurl.'pages/company'.$session.'&action=new";</script>';
  

}

} //fin  addcompany



if (isset($stop)){

  if ($stop == 1){
   
  
 
    $datenow = date('Y-m-d', time());

if (trim($_POST['website']) == "http://") {

  $websitetoinsert = "S/I";

} else {

  $websitetoinsert = $_POST['website'];

}



// starts here the img uploading
$target_dir = "../../".$_SESSION['install_page']."/images/companies/";
$target_file1 = $target_dir . basename($_FILES["imgInp"]["name"]);

if(!empty(basename($_FILES["imgInp"]["name"]))){


  $cadena = $_POST['nombreempresa'].$_POST['rfcompany'];
  
  $cadena = mb_strtolower($cadena);
  
  $patrones = array();
  $patrones[0] = '/ñ/';
  $patrones[1] = '/ó/';
  $patrones[2] = '/á/';
  $patrones[3] = '/é/';
  $patrones[4] = '/í/';
  $patrones[5] = '/ú/';
 

  $sustituciones = array();
  $sustituciones[5] = 'n';
  $sustituciones[4] = 'o';
  $sustituciones[3] = 'a';
  $sustituciones[2] = 'e';
  $sustituciones[1] = 'i';
  $sustituciones[0] = 'u';

 /* echo preg_replace($patrones, $sustituciones, $cadena)."<br>";*/


$uploadOk = 1;
$key2 = date("Hi");
$imageFileType1 = pathinfo($target_file1,PATHINFO_EXTENSION);
$target_file = $target_dir .preg_replace($patrones, $sustituciones, $cadena).$key2.".".$imageFileType1;
$imgtouploadcontact = preg_replace($patrones, $sustituciones, $cadena).$key2.".".$imageFileType1;

if (file_exists($target_file)) {
 //   echo "Sorry, file already exists.";
  $uploadOk = 1;}
// Check file size
if ($_FILES["imgInp"]["size"] > 2000000) {
    echo '<script> alert("Max. 2MB");</script>'; 
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType1 != "jpg" && $imageFileType1 != "png" && $imageFileType1 != "jpeg"
&& $imageFileType1 != "gif" && $imageFileType1 != "JPG" && $imageFileType1 != "PNG" && $imageFileType1 != "JPEG" && $imageFileType1 != "GIF"){
    echo '<script> alert("Solamente se permiten archivos JPG, JPEG, PNG y GIF'.$imageFileType1.'-'.$target_file1.'");</script>';
    $uploadOk = 2;
}
// Archivo demasiado pesado
if ($uploadOk == 0) {
    echo '<script> alert("El archivo es demasiado pesado...");</script>';
 // Archivo diferente formato   
} elseif($uploadOk == 2) {
// Carga del archivo
} elseif($uploadOk == 1) {
    if (move_uploaded_file($_FILES["imgInp"]["tmp_name"], $target_file)) {
      //   echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
      // Error al cargar archivo
        echo "No se ha podido cargar la imagen..."; }}

    } else { $imgtouploadcontact =""; }

//end of the img uploading



  $alm->__SET('name', $_POST['nombreempresa']);
  $alm->__SET('industry', $_POST['industry']);
  $alm->__SET('currency', $_POST['currency']);
  $alm->__SET('rf', $_POST['rfcompany']);
  $alm->__SET('quant', $_POST['employees']);
  $alm->__SET('notes', $_POST['companynotes']);
  $alm->__SET('address', $_POST['address']);
  $alm->__SET('responsable', $_POST['inputid']);


  $alm->__SET('addedby', $_GET['activeuser']);
  $alm->__SET('addeddate', $datenow);
  $alm->__SET('companyimg', $imgtouploadcontact);
  $alm->__SET('website', $_POST['website']);
  
  $model->addcompany($alm);




 // echo '<script> alert("AQUI SE TRABAJA"); </script> ';
  
  }

}

  


if (isset($_POST['deletecompany'])) {

if (isset($_POST['deletethisid'])) {

$todelete = $_POST['deletethisid'];

$imgtodelete = $_POST['companyimgtodelete'];

$i456 = 0;

foreach ($todelete as $now) {

 //  echo '<script> alert("'.$now.'---'.$imgtodelete[$i456].'"); </script> ';
   
   
   if(!empty($imgtodelete[$i456])) {
    if (file_exists("../../".$_SESSION['install_page']."/images/companies/".$imgtodelete[$i456])) {
      
    unlink("../../".$_SESSION['install_page']."/images/companies/".$imgtodelete[$i456]);    

   }
  }
   $model->deletecompany(trim($now)); 
   
  $i456++;

}

}

}

?>



<style>


.modal-content{
    border-radius:0px !important;
}

@media screen and (min-width:100px) and (max-width:768px) {


.modal-backdrop {

    z-index: 0 !important;

}

}

</style>



<!--ORDENAR TABLAS-->
<script type="text/javascript" src="../../<?php echo $_SESSION['install_page'];?>/js/jquery.tablesorter.min.js"></script>
<!--ORDENAR TABLAS-->




</head>


<body>


<div id="profile_cont" class="container" style="margin: 0px; padding: 0px; width: 100%; ">
<div class="row">
  <div  id="sidebar_div" class="col-sm-3">
   
  <!-- including sidebar from templates-->
<?php require_once '../../'.$_SESSION['install_page'].'/template/sidebar.php'; ?>




  </div>

  <div class="col-sm-9" >



<!-- CONTENIDO A PARTIR DE AQUI hacia abajo-->
<div class="row" style="padding:10px;">
        <div class="col-sm-12" id="marginmas768">
            <div class="tab-content">



            <!-- comienza 1er tab hacia abajo -->

<br>

     <!-- nuevo desde aqui abajo -->
            
     <?php if(isset($_GET['action'])) { ?>
  
  <?php if(($_GET['action'])=="new") { ?>
   
    <div class="tab-pane fade in active" id="new">
    
   <?php } else { ?>

    <div class="tab-pane fade in " id="new">
    
    <?php } ?>

<?php } else { ?>

  <div class="tab-pane fade in " id="new">
  
<?php } ?>
            
<style>
#company_form{
background-image: linear-gradient(to bottom,#ffffff 0,#f5f5f5 100%);
color: #88898c;
    font-size: 14px;
}
</style>





<div class="container col-md-12" >



<div class="crm-offer-title" style="padding-left:5%;">
Agregar nueva empresa
</div>


    <form class="well form-horizontal" action="<?php echo $homeurl; ?>pages/company<?php echo $session; ?>&action=add" method="post"  id="company_form" enctype="multipart/form-data">
<fieldset>

<div class="row">


<div class="col-md-6">
<strong> Datos empresariales </strong> 
<br><br>




<!-- Text input-->

<div class="form-group" id="divtoshow" >
  <div class="col-md-12 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="fa fa-building fa-lg"></i></span>
  <input id="empresasearch1"   name="nombreempresa" placeholder="Nombre de empresa" class="form-control" autocomplete="off"  type="text" onkeyup=" this.value = this.value.toUpperCase();">

    </div>
  </div>
</div>


<div class="form-group">
  <div class="col-md-12 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon">R.U.T</span>
  <input  name="rfcompany" placeholder="Indique rut de la empresa" class="form-control"  type="text">
    </div>
  </div>
</div>

<!-- Text input-->

<div class="form-group">
  <div class="col-md-12 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon">URL</span>
  <input  name="website" placeholder="Sitio web" value="http://" class="form-control" id="website" type="url">
    </div>
  </div>
</div>



<div class="col-md-12" style="text-align:right;">
<div class="checkbox">
   <input type="checkbox" style="margin: 0 0 px !important;" value="" id="norut" />Sin sitio web
    </div>

<br>

</div>



<div id="newcompany">

<!-- Text input-->


<!-- Text input-->
  <div class="form-group"> 
    <div class="col-md-12 selectContainer">
    <div class="input-group" style="    width: 100%;">
        <span class="input-group-addon" style="width:80px; font-size:12px;">Industria</span>
    <select id="industry" name="industry" class="form-control selectpicker">
      <option value="">Seleccionar</option>
      <option value="Informatica">Informatica</option>
      <option value="Servicios bancarios">Servicios bancarios</option>
      <option value="Manufacturación">Manufacturación</option>
      <option value="Consultoría">Consultoría</option>
      <option value="Servicios bancarios">Finanzas</option>
      <option value="Administración">Administración</option>
      <option value="Encomiendas">Encomiendas</option>
      <option value="Entretenimiento">Entretenimiento</option>
      <option value="Inversiones">Inversiones</option>
      <option value="Ventas">Ventas</option>
      <option value="Sin fines de lucro">Sin fines de lucro</option>
      <option value="Otro">Otro</option>
    </select>
  </div>
</div>
</div>





<!-- Text input-->


<div class="form-group" style="display:none;"> 
    <div class="col-md-12 selectContainer"  >
    <div class="input-group" style="    width: 100%;">
        <span class="input-group-addon" style="width:80px; font-size:12px;">Moneda</span>
    <select id="currency" name="currency" class="form-control selectpicker">
      <option value="">Seleccionar</option>
      <option value="USA">Dolar USA</option>
      <option value="EURO">EURO</option>
      <option value="CHI" selected>PESO CHILENO</option>
      <option value="ARG">PESO ARGENTINO</option>
    </select>
  </div>
</div>
</div>




<!-- Text input-->


  <div class="form-group"> 
    <div class="col-md-12 selectContainer">
    <div class="input-group" style="    width: 100%;">
        <span class="input-group-addon" style="width:80px; font-size:12px;">Empleados</span>
    <select id="employees" name="employees" class="form-control selectpicker">
      <option value="">Seleccionar</option>
      <option value="9">Menos de 9</option>
      <option value="1019">Entre 10 y 19</option>
      <option value="2049">Entre 20 y 49</option>
      <option value="mas50">Mas de 50</option>
    </select>
  </div>
</div>
</div>




<!-- Text input-->

<div class="form-group">
  <div class="col-md-12 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="fa fa-map-marker fa-lg"></i></span>
  <input  name="address" placeholder="Dirección" class="form-control"  type="text">
    </div>
  </div>
</div>




<div class="form-group">
  <div class="col-md-12 inputGroupContainer">
  <div class="input-group"  style="    width: 100%;">
  <span class="input-group-addon" style="width:80px; font-size:12px;">Responsable:</span>
  <input id="responsable" name="responsable" placeholder="Escriba para buscar" class="form-control" onkeyup="myFunction()"  autocomplete="off" type="text">
  <div class="col-sm-10" style="display:none;"><input type="text" class="form-control" maxlength="50"  id="inputid" name="inputid" ></div>
    </div>
  </div>
</div>





<div id="divcontent">


<!-- Text input-->
<div class="form-group">
    <div class="col-md-12 inputGroupContainer">
    Escriba una breve descripción o nota de la empresa:
    
    
  <textarea  name="companynotes" id="companynotes" class="form-control"  rows="5" maxlegth="250" style="height: auto !important;"></textarea>

  
  </div>
</div>
</div> <!--divcontent -->







<!-- table with data -->
         

<div class="panel-body" id="tablediv1" style="display:none; ">


<table class="table table-striped" id="myTable" style="width:100%;  min-height: 150px;">
  
    <?php foreach($model->selectall() as $r): ?>
                        <tr style="width:100%; min-height:15px; height:15px;">
                            <td style="display:none;" id="<?php echo $r->__GET('id'); ?>-1"> <?php echo $r->__GET('id'); ?></td>
                            <td style="width:100%;     padding:0px;"><a id="<?php echo $r->__GET('id'); ?>" href="#" onclick="myFunction<?php echo $r->__GET('id'); ?>()"><?php echo $r->__GET('name'); echo " "; echo $r->__GET('lastname');?></a></td>
                        </tr>

                        <?php

echo '<script>
function myFunction'.$r->__GET('id').'() {
 
 document.getElementById("responsable").value = document.getElementById("'.$r->__GET('id').'").innerHTML;
 document.getElementById("inputid").value = document.getElementById("'.$r->__GET('id').'-1").innerHTML;

        document.getElementById("divcontent").style.display = "block";
        document.getElementById("tablediv1").style.display = "none";

}
</script>';
?>


    <?php endforeach; ?>


    <tr id='noresult' style="display:none;"><td>No hay resultados<td></tr>

</table>


</div>


<script>

/* checking the table */
function myFunction() {

    if (document.getElementById("responsable").value == "") {
        
        document.getElementById("divcontent").style.display = "block";
        document.getElementById("tablediv1").style.display = "none";
        document.getElementById("inputid").value = "";
        
        } else {
        
        document.getElementById("divcontent").style.display = "none";
        document.getElementById("tablediv1").style.display = "block";
        
        }

  var input, filter, table, tr, td, i;
  input = document.getElementById("responsable");
  filter = input.value.toUpperCase();
  table = document.getElementById("tablediv1");
  tr = table.getElementsByTagName("tr");
  
 var control = 0;
 var controlength = (tr.length );
  
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";


        
      } else {
        tr[i].style.display = "none";

control = control + 1;


if (control < controlength) {
    
    document.getElementById("noresult").style.display = "none";

} else {
    document.getElementById("noresult").style.display = "block";

}

      }
    }       
  } 



}
</script>


<!-- table with data -->











</div> <!-- newcompany -->





</div> <!-- col-md-4 -->




<div class="col-md-6" >
<strong> Imagen o logo de la empresa </strong> 
<br><br>

<a href="##" id="clickingimg"   alt="click para cambiar imagen"/>
<div id="imgdiv" class="imgdiv" >
    <img id="imgcontact" class="imgrounded" src="../../<?php echo $_SESSION['install_page'];?>/images/default/company-default.png" />
</div>
<br>
</a>
  <input style="display:none;"  type="file" name="imgInp" id="imgInp" class="form-control">

<!--
  <input type="file" class="form-control" name="fileToUpload" id="fileToUpload" required>-->





<!-- Button -->
<div class="form-group">
  <label class="col-md-12 control-label"></label>
  <div class="col-md-12"><br>
  <button type="button" class="btn btn-warning pull-left" onclick="clear1();" >Cancelar<span style="padding-left:5px;" class="fa fa-trash fa-lg"></span></button>

    <button type="submit" name="addcompany" class="btn btn-success pull-right" >Guardar<span style="padding-left:5px;" class="fa fa-check fa-lg"></span></button>
  </div>
</div>




</div> <!-- col-md-6 -->


</div> <!-- row -->



</fieldset>
</form>

    </div><!-- /.container -->



<script>

function clear1() {
document.getElementById("company_form").reset();

/*CLEAR THE PREVIEW*/
document.getElementById("imgInp").value ="";
$('#imgcontact').attr('src','../../<?php echo $_SESSION['install_page'];?>/images/default/company-default.png');

$('#website').attr('readonly', false);


}

/* LOAD IMAGE PREVIEW */
$('#clickingimg').click(function(){
    $("#imgInp").click();
})

function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imgcontact').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp").change(function(){
    readURL(this);
});



/* FUNCTION DE SIN NUMERO*/
$(function(){
 $('#norut').click(function(){
var valnum = $('#website').val();

if(valnum == "S/I"){

$('#website').attr('readonly', false);
$('#website').val("http://");

} else {
$('#website').attr('readonly', true);
$('#website').val("S/I");
}

});
});
/* FUNCION SIN NUMERO */




</script>













            <!-- nuevo desde aqui arriba -->
                      
            
            </div>






          <!-- Termina 1er tab hacia arriba -->

          <!-- comienza 2do tab hacia abajo -->



          <?php if(isset($_GET['action'])) { ?>
  <?php if ((($_GET['action'])=="viewall") || (($_GET['action'])=="add")) { ?>
    <div class="tab-pane fade in active" id="viewall">
    <?php } else { ?>
    <div class="tab-pane fade in" id="viewall">
    <?php } ?>
<?php } else { ?>
  <div class="tab-pane fade in active" id="viewall">
  <?php } ?>


  <?php if (isset($_GET['action'])) { ?>
  
  <?php if ($_GET['action']=="add") { ?>

 <div class="alert alert-success">
 <i class="fa fa-check-circle fa-lg" style="margin-right:10px;"></i>  <strong>La empresa se ha agregado satisfactoriamente</strong> 
</div>

  <?php } ?>

<?php } ?>



<?php if (isset($_GET['update'])) { ?>
  
  <?php if ($_GET['update']=="submitted") { ?>

 <div class="alert alert-success">
 <i class="fa fa-check-circle fa-lg" style="margin-right:10px;"></i>  <strong>La empresa se ha actualizado satisfactoriamente</strong> 
</div>

  <?php } ?>

<?php } ?>


<?php if (isset($_GET['deleted'])) { ?>
  
  <?php if (isset($_POST['deletethisid'])) { ?>

 <div class="alert alert-success">
 <i class="fa fa-check-circle fa-lg" style="margin-right:10px;"></i>  <strong>La empresa se ha eliminado satisfactoriamente</strong> 
</div>

  <?php } ?>

<?php } ?>



<form action ="<?php echo $homeurl;?>pages/company<?php echo $session;?>&action=viewall&deleted=success" method="post" id="formtosubmit" enctype="multipart/form-data">
            
    <div class="col-md-6" style="text-align:right;">
            
            <div class="form-group" style="width:100%">
              <div class="col-md-12 inputGroupContainer">
              <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-search"></i></span>
              <input  name="inputcompany" id="inputcompany" placeholder="Buscar empresa por nombre o R.U.T" onkeyup="search();" class="form-control" autocomplete="off" type="text">
                </div>
              </div>
            </div>
            

            <?php echo'<script>
function search() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("inputcompany");
  filter = input.value.toUpperCase();
  table = document.getElementById("table_company");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2]; 

    if (td) {';?>

    <?php if ($_GET['rol']=='ADMIN') {

      echo'
if(input.value=="") {
      document.getElementById("maincheckdiv").style.display = "block";
} else {
  document.getElementById("maincheckdiv").style.display = "none";

}'; }?>

<?php echo' if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";


      } else {

        tr[i].style.display = "none";

      }
    }       
  }
}
</script>';?>



    </div>

<style>


.table-bordered{
  border: 0px solid #ddd;
}


</style>

<script>
$(document).ready(function() 
    { 
        $("#table_company").tablesorter(); 
    } 
);
</script>



<div class="panel-body col-md-12" id="tablediv_contacts" >

<table id="table_company" class="table table-bordered" cellspacing="0" style=" border-collapse: collapse; width:100%;">


  <thead id="head_contacttable">
  <tr>
  <th style="text-align:center; max-width: 80px; min-width: 70px;  width: 80px; ">ID <i class="fa fa-chevron-down " style="  cursor:pointer;  float: right;" aria-hidden="true"></i></th>
    <th style="min-width:200px; max-width: 280px;" colspan=2>Empresa <i class="fa fa-chevron-down " style="  cursor:pointer;  float: right;" aria-hidden="true"></i></th>

    <th style="min-width:150px;">Dirección <i class="fa fa-chevron-down " style="  cursor:pointer;  float: right;" aria-hidden="true"></i></th>
    <th style="text-align:center; max-width: 100px; min-width: 100px; ">Acción <i class="fa fa-chevron-down " style="  cursor:pointer;  float: right;" aria-hidden="true"></i></th>
  </tr>
  </thead>


  <tbody>
  

  <?php foreach($model->getcompanies() as $r): ?>

  <tr class="tr-table">
                    <td  class="td-table" style="text-align:center;"><?php echo $r->__GET('id'); ?> <input class="check123" type="checkbox" name="deletethisid[]" id="check1<?php echo $r->__GET('id'); ?>" value="<?php echo $r->__GET('id'); ?>" /><input  id="check2<?php echo $r->__GET('id'); ?>"  type="checkbox" value="<?php echo $r->__GET('companyimg'); ?>" style="display:none;" name="companyimgtodelete[]"/></td>
<td  class="td-table" style="text-align:center; width: 60px; ">
<div style="float:left; width: 30px; max-width: 60px;">
                    <div  class="imgdiv30" style="margin-bottom: 15px;" >
<?php if ($r->__GET('companyimg') == "") { ?>
<img class="imgrounded30"  src="<?php echo $homeurl;?>images/default/company-default.png" />                     
<?php } else { ?>
  <img  class="imgrounded30" style="" src="<?php echo $homeurl;?>images/companies/<?php echo $r->__GET('companyimg');?>" />
<?php } ?>
               </div>     
               </div>                  
</td>


                    <td  class="td-table">
                    <div class="row">
                   

                 
                  <a href="#" data-toggle="modal" data-target="#myModal<?php echo $r->__GET('id');?>" ><?php echo $r->__GET('name');?></a><br><p style="font-size:11px;">R.U.T: <?php echo $r->__GET('rf');?></p>
                    </div> <!--row-->                    
                    </td>                                                      
                    <td  class="td-table"><?php echo $r->__GET('address'); ?></td>
                    <td  class="td-table" style="text-align:center;"><a href="../../<?php echo $_SESSION['install_page'];?>/source/output.php?t=pdf&name=<?php echo $r->__GET('name'); ?>&id=<?php echo $r->__GET('id'); ?>&from=company"><i class="fa fa-file-pdf-o fa-lg"></i></a>  | <a href="##" data-toggle="tooltip" data-placement="right" title='Enviar ficha de la empresa por correo electrónico'><i class="fa fa-envelope-o fa-lg"></i></a></td>
                  
               


            </tr>



          <script>
          
          
$('#check1<?php echo $r->__GET('id'); ?>').change(function() {

if (document.getElementById("check2<?php echo $r->__GET('id'); ?>").checked == true) {

  $('#check2<?php echo $r->__GET('id'); ?>').prop('checked', false);

} else {

  $('#check2<?php echo $r->__GET('id'); ?>').prop('checked', true);

}

});

          
          </script>  

 <!-- Modal -->
 <div class="modal fade" id="myModal<?php echo $r->__GET('id');?>" role="dialog"  >
    <div class="modal-dialog" id="model-company" style=" max-width:700px; margin-bottom: 70px;  width: 100% !important;">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Perfil de <?php echo $r->__GET('name');?>
            
          <?php if (($_GET['rol']=="ADMIN")) { ?> 
            <a  <a style="   margin-left:20px;" class="acalend " type="button" href="company<?php echo $session; ?>&action=update&idcompany=<?php echo $r->__GET('id');?>"  style="margin-left:10px;" >Editar <i class="fa fa-edit"></i></a>
          <?php } ?> 
        </h4>


        </div>
        <div class="modal-body">



        <div class="row">
<div class="col-md-12">

<div class="col-sm-4">
<div id="imgdiv" class="imgdiv" style="margin-bottom: 15px;" >

<?php if ($r->__GET('companyimg') == "") { ?>

<img class="imgrounded"  src="../../<?php echo $_SESSION['install_page'];?>/images/default/company-default.png" />

<?php } else { ?>


  <?php
$imagen1 = "../../".$_SESSION['install_page']."/images/companies/".$r->__GET('companyimg');
list($ancho, $alto, $tipo, $atributos) = getimagesize($imagen1);
$margin = (150-(150*$alto)/$ancho)/2;
?>


<div class="imgdiv">
<?php if ($ancho > $alto) { ?>

    <img src="<?php echo $imagen1;?>" style="margin-top:<?php echo $margin;?>px;" class="imgroundedhor" >

<?php } else { ?>

    <img src="<?php echo $imagen1;?>" class="imgrounded" >

<?php } ?>
</div>


<?php } ?>

</div>
</div> <!-- col md -4 -->

<div class="col-md-8">


<div class="form-group" style="margin-bottom: 0px !important;">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
  <div class="input-group">
  <span class="input-group-addon"><i class="fa fa-building fa-lg"></i></span>
  <input  name="companyname" class="form-control" value="<?php echo $r->__GET('name');?>"  type="text" readonly>
    </div>
  </div>
</div>

<div class="form-group" style="margin-bottom: 0px !important;">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
  <div class="input-group">
  <span class="input-group-addon"><strong>R.U.T</strong></span>
  <input  name="companyrf" class="form-control" value="<?php echo $r->__GET('rf');?>"  type="text" readonly>
    </div>
  </div>
</div>


<div class="form-group" style="margin-bottom: 0px !important;">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
  <div class="input-group">
  <span class="input-group-addon"><strong>URL</strong></span>
  <input  name="companyurkl" class="form-control" value="<?php echo $r->__GET('website');?>"  type="text" readonly>
    </div>
  </div>
</div>



<div class="form-group" style="margin-bottom: 0px !important;">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
  <div class="input-group">
  <span class="input-group-addon"><strong>Industria</strong></span>
  <input  name="companyindustry" class="form-control" value="<?php echo $r->__GET('industry');?>"  type="text" readonly>
    </div>
  </div>
</div>

<div class="form-group" style="margin-bottom: 0px !important;">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
  <div class="input-group">
  <span class="input-group-addon"><strong>Empleados</strong></span>
  
  <?php if (trim($r->__GET('quant')) == "9") {?>

  <input  name="companyemployees" class="form-control" value="Menos de 9"  type="text" readonly>

  <?php } elseif (trim($r->__GET('quant')) == "1019") { ?>

    <input  name="companyemployees" class="form-control" value="Entre 10 y 19"  type="text" readonly>

    <?php } elseif (trim($r->__GET('quant')) == "2049") { ?>

    <input  name="companyemployees" class="form-control" value="Entre 20 y 49"  type="text" readonly>

    <?php } elseif (trim($r->__GET('quant')) == "mas50") { ?>

    <input  name="companyemployees" class="form-control" value="Mas de 50"  type="text" readonly>

    <?php } ?>


    </div>
  </div>
</div>


<div class="form-group" style="margin-bottom: 0px !important;">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
  <div class="input-group">
  <span class="input-group-addon"><i class="fa fa-address-card fa-lg"></i></span>
  <input  name="companyaddress" class="form-control" value="<?php echo $r->__GET('address');?>"  type="text" readonly>
    </div>
  </div>
</div>

<?php   $almname = $model->getusername(trim($r->__GET('responsable')));  ?>

     


<div class="form-group" style="margin-bottom: 0px !important;">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
  <div class="input-group">
  <span class="input-group-addon"><strong>Responsable</strong></span>
  <input  name="companyresponsable" class="form-control" value="<?php echo $almname->__GET('name')." ".$almname->__GET('lastname');?>"  type="text" readonly>
    </div>
  </div>
</div>


<div class="form-group">
    <div class="col-md-12 inputGroupContainer">
    <strong> Notas:</strong>
  <textarea  name="companynotes" style="height: auto !important;" id="companynotes" class="form-control"  rows="5" maxlegth="250" readonly><?php echo $r->__GET('notes');?></textarea>
<br>
<br>
  </div>
</div>



</div> <!-- col-md-8 -->






</div> <!-- col-md-12 -->

      </div>
        <div class="modal-footer">


        <div class="col-sm-2" style="float:left; text-align:center;">
       <a href="../../<?php echo $_SESSION['install_page'];?>/source/output.php?t=pdf&name=<?php echo $r->__GET('name'); ?>&id=<?php echo $r->__GET('id'); ?>&from=company"><i class="fa fa-file-pdf-o fa-lg"></i><br> Exportar</a></td>

</div>



        <?php   $almname = $model->getusername(trim($r->__GET('addedby')));  ?>


<p style="font-size:11px;">Empresa agregada por <?php echo $almname->__GET('name')." ".$almname->__GET('lastname'); ?> el <?php echo $r->__GET('addeddate'); ?> </p>

        </div>
      </div>
    
    </div> <!-- modal dialog -->
    </div> <!-- modal fade -->


<?php endforeach; ?>

  </tbody>
</table>

</div>



<?php if ($_GET['rol']=='ADMIN') { ?>

<div class="panel-footer col-sm-12">

<div class="row">
<div class="col-sm-6" style="margin-top:5px;" >
<div id="maincheckdiv">
<input type="checkbox" id="maincheck1"/> Seleccionar todo
</div>
</div>
<div class="col-sm-6" >


<input style="display:none;" type="text" value="ok" name="deletecompany" />
<button type="button" class="btn btn-danger pull-right" name="deletecontact" style="margin-left: 5px;" onclick="confirmalert()" ><i class="fa fa-trash"></i> Eliminar</button> 

</div>
</div>


<script>
$('#maincheck1').click(function() {
    $(this.form.elements).filter(':checkbox').prop('checked', this.checked);
});

function confirmalert() {
    var txt;
    var r = confirm("Si continua eliminará tambien a los contactos pertenecientes a esta empresa, ¿Desea continuar?");
    if (r == true) {

        txt = "Borrar";
        $('#formtosubmit').submit();

    } else {
        txt = "NO";
    }
  

}
</script>





</div>

<?php } ?>


    
</form>


</div>


<!-- Termina 2do tab hacia arriba -->

     <!-- comienza 3er tab hacia abajo -->

    <!-- nuevo desde aqui abajo -->
            
  
<?php if(isset($_GET['action'])){ ?>

  <?php if($_GET['action'] == "update"){ ?>

  <div class="tab-pane fade in active" id="update">

  <?php } else { ?>

    <div class="tab-pane fade in " id="update">


  <?php } ?>

<?php } else { ?>

  <div class="tab-pane fade in " id="update">

<?php } ?>



                <div class="list-group">
                   



<!-- aqui empieza editar -->

<form action="<?php echo $homeurl;?>pages/company<?php echo $session;?>&action=viewall&update=submitted" method="post" enctype="multipart/form-data" >





<br>
<br>

<div class="row">
<div class="col-sm-12"  style="padding-left: 5%;   padding-bottom: 5%; height:100vh;">

<div class="col-sm-4">

<strong>Imagen de la empresa</strong>
<br>
<br>

<div id="imgdiv" class="imgdiv" style="margin-bottom: 15px;" >

<?php if ($r->__GET('companyimg') == "") { ?>

<img class="imgrounded" id="companyimgshow"   src="../../<?php echo $_SESSION['install_page'];?>/images/default/company-default.png" />

<?php } else { ?>


  <?php
$imagen1 = "../../".$_SESSION['install_page']."/images/companies/".$r->__GET('companyimg');
list($ancho, $alto, $tipo, $atributos) = getimagesize($imagen1);
$margin = (150-(150*$alto)/$ancho)/2;
?>


<div class="imgdiv">
<?php if ($ancho > $alto) { ?>

    <img src="<?php echo $imagen1;?>" id="companyimgshow"  style="margin-top:<?php echo $margin;?>px;" class="imgroundedhor" >

<?php } else { ?>

    <img src="<?php echo $imagen1;?>" id="companyimgshow"  class="imgrounded" >

<?php } ?>
</div>

<?php } ?>

</div>
<div style="text-align:center; margin-bottom:10px;">
<a href="#" onclick="quitar();">Quitar imagen</a>
</div>


<div class="col-md-12" id="changeimg<?php echo $r->__GET('id');?>" >
<br>
<input  type="file" name="imgInp2" value="<?php echo $r->__GET('companyimg');?>" id="imgInp1" class="form-control">

<input style="display:none;" type="text"  name="contact_img_old2" id="contact_img_old" value="<?php echo $r->__GET('companyimg');?>" />
<input style="display:none;" type="text"  name="contact_img_old3" id="contact_img_old" value="<?php echo $r->__GET('companyimg');?>" />

</div>

<br>
<br>
<br>

</div> <!-- col-sm-4 -->

<div class="col-sm-8" style=" max-width: 600px; height: 100vh;    ">
<strong>Datos de la empresa</strong>
<br>
<br>

<div class="form-group" style="margin-bottom: 0px !important;">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
  <div class="input-group">
  <span class="input-group-addon"><i class="fa fa-building fa-lg"></i></span>
  <?php if (isset($_GET['idcompany'])) {?>
  <input style="display:none;"  name="companyidupdate" class="form-control" value="<?php echo $_GET['idcompany']; ?>"  type="text" >
  <?php } ?>
  <input  name="companynameupdate" class="form-control" value="<?php echo $r->__GET('name');?>"  type="text" onkeyup=" this.value = this.value.toUpperCase();">
    </div>
  </div>
</div>

<div class="form-group" style="margin-bottom: 0px !important;">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
  <div class="input-group">
  <span class="input-group-addon">R.U.T</span>
  <input  name="companyrfupdate" class="form-control" value="<?php echo $r->__GET('rf');?>"  type="text" >
    </div>
  </div>
</div>


<div class="form-group" style="margin-bottom: 0px !important;">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
  <div class="input-group">
  <span class="input-group-addon">URL</span>
  <input  name="companyurlupdate" id="companyurlupdate" class="form-control" value="<?php echo $r->__GET('website');?>"  type="text" <?php echo $r->__GET('website') ==  'S/I'? 'readonly' : ''; ?>>
    </div>
  </div>
</div>

<div class="col-md-12" style="text-align:right;">
<div class="checkbox">
   <input type="checkbox" style="margin: 0 0 px !important;" value="" id="norutupdate" <?php echo $r->__GET('website') ==  'S/I'? 'checked' : ''; ?>/>Sin sitio web
    </div>

<br>
<br>

</div>

<!-- Text input-->
<div class="form-group"> 
    <div class="col-md-12 selectContainer" style="margin-bottom: 10px;">
    <div class="input-group" style="    width: 100%;">
        <span class="input-group-addon" style="width:80px; font-size:12px;">Industria</span>
    <select id="industry" name="companyindustryupdate" class="form-control selectpicker">
      <option value="" <?php echo $r->__GET('industry') ==  ''? 'selected' : ''; ?>>Seleccionar</option>
      <option value="Informatica" <?php echo $r->__GET('industry') ==  'Informatica'? 'selected' : ''; ?>>Informatica</option>
      <option value="Manufacturación" <?php echo $r->__GET('industry') ==  "Manufacturación" ? 'selected' : ''; ?>>Manufacturación</option>
      <option value="Consultoría" <?php echo $r->__GET('industry') ==  "Consultoría" ? 'selected' : ''; ?>>Consultoría</option>
      <option value="Servicios bancarios" <?php echo $r->__GET('industry') ==  "Servicios bancarios" ? 'selected' : ''; ?>>Finanzas</option>
      <option value="Administración" <?php echo $r->__GET('industry') ==  "Administración" ? 'selected' : ''; ?>>Administración</option>
      <option value="Encomiendas" <?php echo $r->__GET('industry') ==  "Encomiendas" ? 'selected' : ''; ?>>Encomiendas</option>
      <option value="Entretenimiento" <?php echo $r->__GET('industry') ==  "Entretenimiento" ? 'selected' : ''; ?>>Entretenimiento</option>
      <option value="Inversiones" <?php echo $r->__GET('industry') ==  "Inversiones" ? 'selected' : ''; ?>>Inversiones</option>
      <option value="Ventas" <?php echo $r->__GET('industry') ==  "Ventas" ? 'selected' : ''; ?>>Ventas</option>
      <option value="Sin fines de lucro" <?php echo $r->__GET('industry') ==  "Sin fines de lucro" ? 'selected' : ''; ?>>Sin fines de lucro</option>
      <option value="Otro" <?php echo $r->__GET('industry') ==  "Otro" ? 'selected' : ''; ?>>Otro</option>
    </select>
  </div>
</div>
</div>


<div class="form-group"> 
    <div class="col-md-12 selectContainer" style="margin-bottom: 10px;">
    <div class="input-group" style="    width: 100%;">
        <span class="input-group-addon" style="width:80px; font-size:12px;">Empleados</span>
    <select id="companyemployeesupdate" name="companyemployeesupdate" class="form-control selectpicker">
      <option value="" <?php echo $r->__GET('quant') ==  "" ? 'selected' : ''; ?>>Seleccionar</option>
      <option value="9" <?php echo $r->__GET('quant') ==  "9" ? 'selected' : ''; ?>>Menos de 9</option>
      <option value="1019" <?php echo $r->__GET('quant') ==  "1019" ? 'selected' : ''; ?>>Entre 10 y 19</option>
      <option value="2049" <?php echo $r->__GET('quant') ==  "2049" ? 'selected' : ''; ?>>Entre 20 y 49</option>
      <option value="mas50" <?php echo $r->__GET('quant') ==  "mas50" ? 'selected' : ''; ?>>Mas de 50</option>
    </select>
  </div>
</div>
</div>


<div class="form-group" style="margin-bottom: 0px !important;">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
  <div class="input-group">
  <span class="input-group-addon"><i class="fa fa-map-marker fa-lg"></i></span>
  <input  name="companyaddressupdate" class="form-control" value="<?php echo $r->__GET('address');?>"  type="text">
    </div>
  </div>
</div>


<div class="form-group">
    <div class="col-md-12 inputGroupContainer">
   <strong> Notas: </strong><br><br>
  <textarea  name="companynotesupdate" style="height: auto !important;" id="companynotes" class="form-control"  rows="5" maxlegth="250" ><?php echo $r->__GET('notes');?></textarea>
<br>
<br>
  </div>
</div>


<?php   $almname = $model->getusername(trim($r->__GET('responsable')));  

$selectedcontact = $almname->__GET('name')." ".$almname->__GET('lastname');?>

<div class="form-group" style="margin-bottom: 0px !important;">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
  <div class="input-group">
  <span class="input-group-addon">Responsable</span>
  <select name="companyresponsableupdate" id="companyresponsableupdate" class="form-control selectpicker"  required>
      <option value="" >Seleccionar</option >  

<?php foreach($model->selectall() as $r): ?>
    <?php if($selectedcontact == $r->__GET('name')." ".$r->__GET('lastname')) { ?>

      <option value="<?php echo $r->__GET('id'); ?>" selected><?php echo $r->__GET('name'); echo " "; echo $r->__GET('lastname');?></option>

    <?php } else { ?>  

  <option value="<?php echo $r->__GET('id'); ?>"><?php echo $r->__GET('name'); echo " "; echo $r->__GET('lastname');?></option>
  
    <?php } ?>
<?php endforeach; ?>

</select>
      </div>
  </div>
</div>




<button type="submit" name="submitupdate" value="ok" id="submit" class="btn btn-success pull-right" >Actualizar<span style="padding-left:5px;" class="fa fa-check fa-lg"></span></button>
<a type="button" href="<?php echo $homeurl; ?>pages/company<?php echo $session; ?>" style="margin-right:10px;" id="cancelbutton" class="btn btn-danger pull-right" >Cancelar<span style="padding-left:5px;" class="fa fa-window-close fa-lg"></span></a>





<script>

$(function(){
 $('#norutupdate').click(function(){
var valnum = $('#companyurlupdate').val();

if(valnum == "S/I"){

$('#companyurlupdate').attr('readonly', false);
$('#companyurlupdate').val("http://");

} else {
$('#companyurlupdate').attr('readonly', true);
$('#companyurlupdate').val("S/I");
}

});
});
/* FUNCION SIN NUMERO */




/* LOAD IMAGE PREVIEW */
function quitar(){
  document.getElementById("imgInp1").value ="";
  document.getElementById("contact_img_old").value ="";
$('#companyimgshow').attr('src','../../<?php echo $_SESSION['install_page'];?>/images/default/company-default.png');
$('#companyimgshow').attr('class', 'imgrounded');
$('#companyimgshow').css('margin-top',0);


}


function readURL1(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#companyimgshow').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp1").change(function(){
    readURL1(this);
});

</script>


</div> <!-- col-sm-8 -->

</div> <!-- col-sm-12-->
</div> <!-- ROW -->


</form>


<!-- termina editar arriba -->




                </div>
            </div>
          <!-- Termina 3er tab hacia arriba -->



          <div class="row" style="margin-bottom: 100px;">

<p></p>
</div>





            </div>
        </div>
    </div>





<!-- CONTENIDO HASTA AQUI hacia ARRIBA -->

</div>
</div>
</div>








</body>




<?php
require_once '../../'.$_SESSION['install_page'].'/template/footer.php';
?>





</html>