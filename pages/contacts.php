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

/* update the contact */

if(isset($_GET['update'])){

  if(($_GET['update'])=="submitted"){
    
$updated_contact = "OK";

// starts here the img uploading
$target_dir1 = "../../".$_SESSION['install_page']."/images/contacts/";
$target_file1 = $target_dir1 . basename($_FILES["imgInp1"]["name"]);



if(!empty(basename($_FILES["imgInp1"]["name"]))){
  if(!empty(trim($_POST['contact_img_old1']))){
    if (file_exists("../../".$_SESSION['install_page']."/images/contacts/".$_POST['contact_img_old1'])) {
  unlink("../../".$_SESSION['install_page']."/images/contacts/".$_POST['contact_img_old1']);
    }
  }


  $cadena = $_POST['firstupdate'].$_POST['lastupdate'];
  
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
$key3 = date("Hi");
$imageFileType1 = pathinfo($target_file1,PATHINFO_EXTENSION);
$target_file = $target_dir1 .preg_replace($patrones, $sustituciones, $cadena).$key3.".".$imageFileType1;
$imgtouploadcontact1 = preg_replace($patrones, $sustituciones, $cadena).$key3.".".$imageFileType1;

if (file_exists($target_file)) {
 //   echo "Sorry, file already exists.";
  $uploadOk = 1;}
// Check file size
if ($_FILES["imgInp1"]["size"] > 2000000) {
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
    if (move_uploaded_file($_FILES["imgInp1"]["tmp_name"], $target_file)) {
      //   echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
      // Error al cargar archivo
        echo "No se ha podido cargar la imagen..."; }}

    } else { 
      
      $imgtouploadcontact1 =trim($_POST['contact_img_old']); 
    
      if(trim($imgtouploadcontact1)==""){
     

        if(!empty(trim($_POST['contact_img_old1']))){
          if (file_exists("../../".$_SESSION['install_page']."/images/contacts/".$_POST['contact_img_old1'])) {
            
        unlink("../../".$_SESSION['install_page']."/images/contacts/".$_POST['contact_img_old1']);
        }
      }
      }
    
    }



    $almcomp = $model->getcompanyid($_POST['companyupdate']);
    

//end of the img uploading

    $alm->__SET('namecontact', $_POST['firstupdate']);
    $alm->__SET('lastnamecontact', $_POST['lastupdate']);
    $alm->__SET('sexcontact', $_POST['sexupdate']);
    $alm->__SET('emailcontact', $_POST['emailupdate']);
    $alm->__SET('phonecontact', $_POST['phoneupdate']);
    $alm->__SET('birthdaycontact', $_POST['bdayupdate']);
    $alm->__SET('notescontact', $_POST['notesupdate']);
    $alm->__SET('companycontact', $almcomp->__GET('id'));
    $alm->__SET('chargecontact', $_POST['chargeupdate']);
    $alm->__SET('imgcontact', $imgtouploadcontact1);
    $alm->__SET('id', trim($_POST['idcontactinp']));

$model->updatecontact($alm);


if(isset($_POST['social1'])){

/*UPDATE OR DELETE SOCIAL starts*/
$socialname = $_POST['social'];
$socialcontent = $_POST['social1'];
$socialidvar = $_POST['social_idvar'];

$i1 = 0;

foreach ($socialname as $socialcolor) { 
  
if (empty($socialcontent[$i1])) {
  $model->deletesocial($socialidvar[$i1]); 
 
    // echo '<script>alert("'.$socialidvar[$i1].'-'.$socialcolor.'-'.$socialcontent[$i1].'");</script>';
} else {

  $alm->__SET('social_content', $socialcontent[$i1]);
  $alm->__SET('companycontact', $almcomp->__GET('id'));  
  $alm->__SET('id', $socialidvar[$i1]);

$model->updatesocial($alm);

}
  $i1++;
  }

}
/*UPDATE or delete SOCIAL ENDS*/


/*INSERT NEW SOCIAL starts*/
$socialname1 = $_POST['socialnew'];
$socialcontent1 = $_POST['socialnew1'];
$i2 = 0;

$almrcc = $model->getcontactscount(trim($_POST['emailupdate']));

foreach ($socialname1 as $socialcolor1) { 
  
  if ( (!empty($socialcolor1)) && (!empty($socialcontent1[$i2])) ) {

    $alm->__SET('social_content', $socialcontent1[$i2]);
    $alm->__SET('social_name', $socialcolor1);
    $alm->__SET('companycontact', $almcomp->__GET('id'));      
    $alm->__SET('contact_id_var', $almrcc->__GET('id'));
    
    $model->addsocial($alm);

    //  echo '<script>alert("'.$socialcolor1.'-'.$socialcontent1[$i2].'");</script>';
  }

  $i2++;

  }

/*UPDATE SOCIAL ENDS*/




  }

}

      // Delete contacts and social
if (isset($_POST['deletecontact'])) {
  
if(isset($_POST['deletethisid'])){

  $delete = $_POST['deletethisid'];
      
  $contactimgtodelete = $_POST['imgcontacttodelete'];

  $cont = 0 ;
  

      foreach ($delete as $contact){ 
        //  echo '<script>alert("'.$contact.'");</script>';

if(trim($contactimgtodelete[$cont])!=""){
  if (file_exists("../../".$_SESSION['install_page']."/images/contacts/".$contactimgtodelete[$cont])) {
    
        unlink("../../".$_SESSION['install_page']."/images/contacts/".$contactimgtodelete[$cont]);
  }
}   
          $model->deletecontact($contact); 


          $cont++;
      }
    }
  }
        

if (isset($_GET['action'])){

/*add new company and contact*/
if($_GET['action']=="add"){

/*aqui se propone trabajar 

if(!empty($_POST['nombreempresa1']){

  $almrc = $model->getcompaniescount(trim($_POST['nombreempresa1']));
  
    if($almrc->__GET('rowcount') > 0) { 




}



*/

$freno = 1;



  if (($_POST['cargo']=="") || ($_POST['email']=="") || ($_POST['first_name']=="") || ($_POST['last_name']=="") || ($_POST['sex']=="") ){ 

    echo '<script> alert("Debe rellenar todos los campos2'.$_POST['cargo'].'-'.$_POST['email'].'-'.$_POST['first_name'].'-'.$_POST['last_name'].'-'.$_POST['sex'].'"); </script>';
    
  } else {


   if (($_POST['nombreempresa']=="") && ($_POST['nombreempresa1']=="") ){

    echo '<script> alert("Debe rellenar todos los campos"); </script>';    

$freno = 0;

   } else {


  $almrcc = $model->getcontactscount(trim($_POST['email']));
  
    if($almrcc->__GET('rowcount') > 0) { 

      echo '<script> alert("Ya existe un usuario con este email: '.$_POST['email'].'"); </script>';

    } else {

    $almrc = $model->getcompaniescount($_POST['nombreempresa1']);
  
    if($almrc->__GET('rowcount') > 0) { 

//echo '<script> alert("La empresa ya existe'.$_POST['nombreempresa1'].'"); </script>';
  


// starts here the img uploading
$target_dir = "../../".$_SESSION['install_page']."/images/contacts/";
$target_file1 = $target_dir . basename($_FILES["imgInp"]["name"]);

if(!empty(basename($_FILES["imgInp"]["name"]))){

  $cadena = $_POST['first_name'].$_POST['last_name'];
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


$datenow = date('Y-m-d', time());


$alm->__SET('namecontact', $_POST['first_name']);
$alm->__SET('lastnamecontact', $_POST['last_name']);
$alm->__SET('sexcontact', $_POST['sex']);
$alm->__SET('emailcontact', $_POST['email']);
$alm->__SET('phonecontact', $_POST['contact_number']);
$alm->__SET('birthdaycontact', $_POST['bday']);
$alm->__SET('notescontact', $_POST['contactnotes']);
$alm->__SET('companycontact', trim($_POST['inputid1']));
$alm->__SET('chargecontact', $_POST['cargo']);
$alm->__SET('imgcontact', $imgtouploadcontact);
$alm->__SET('addedby', $_GET['activeuser']);
$alm->__SET('added_date', $datenow);

$model->addcontact($alm);

$stop = 1;


    } else {

     // echo '<script> alert("La empresa ya existe1'.$_POST['nombreempresa'].'"); </script>';
      

      /* PROBLEMA AQUI */

if (!empty($_POST['nombreempresa'])) {


  $almrc = $model->getcompaniescount($_POST['nombreempresa']);
  
    if($almrc->__GET('rowcount') > 0) { 

      echo '<script>alert("La empresa '.$_POST['nombreempresa'].' ya existe");</script>';
      
    } else {



if($freno != 0) {

if (empty($_POST['industry']) || empty($_POST['employees']) || empty($_POST['address'])){
  
  echo '<script>alert("Debe rellenar todos los datos de la nueva empresa");</script>';
  $stop = 0;
  

} else {

 
      $datenow = date('Y-m-d', time());


    $alm->__SET('name', $_POST['nombreempresa']);
    $alm->__SET('industry', $_POST['industry']);
    $alm->__SET('currency', $_POST['currency']);
    $alm->__SET('rf', $_POST['rfcompany']);
    $alm->__SET('quant', $_POST['employees']);
    $alm->__SET('notes', $_POST['companynotes']);
    $alm->__SET('address', $_POST['address']);
    $alm->__SET('responsable', trim($_POST['inputid']));
    $alm->__SET('addedby', $_GET['activeuser']);
    $alm->__SET('addeddate', $datenow);
    $alm->__SET('companyimg', '');
    $alm->__SET('website', 'S/I');
    
    $model->addcompany($alm);


// starts here the img uploading
$target_dir = "../../".$_SESSION['install_page']."/images/contacts/";
$target_file1 = $target_dir . basename($_FILES["imgInp"]["name"]);

if(!empty(basename($_FILES["imgInp"]["name"]))){


  $cadena = $_POST['first_name'].$_POST['last_name'];
  
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


$datenow = date('Y-m-d', time());


$almcomp = $model->getcompanyid($_POST['nombreempresa']);



    $alm->__SET('namecontact', $_POST['first_name']);
    $alm->__SET('lastnamecontact', $_POST['last_name']);
    $alm->__SET('sexcontact', $_POST['sex']);
    $alm->__SET('emailcontact', $_POST['email']);
    $alm->__SET('phonecontact', $_POST['contact_number']);
    $alm->__SET('birthdaycontact', $_POST['bday']);
    $alm->__SET('notescontact', $_POST['contactnotes']);
    $alm->__SET('companycontact', $almcomp->__GET('id'));
    $alm->__SET('chargecontact', $_POST['cargo']);
    $alm->__SET('imgcontact', $imgtouploadcontact);
    $alm->__SET('addedby', $_GET['activeuser']);
    $alm->__SET('added_date', $datenow);
    
    
    $model->addcontact($alm);

$stop = 1;

  }
}

  }

  } else {

$stop = 0;

echo '<script>alert("Debe rellenar los datos de la empresa a crear");</script>';


  }

    /*final problema antes } */

  }

/*ADD SOCIAL NETWORK*/

if ($stop != 0) {
  

if (isset($_POST['contacts'])){
  $name = $_POST['contacts'];
  $name1= $_POST['contacts1'];
  $i = 0;
  
  $almrcc = $model->getcontactscount(trim($_POST['email']));
  

  if (!empty(trim($_POST['nombreempresa']))) {
  $almcomp = $model->getcompanyid($_POST['nombreempresa']);
  } else {
  $almcomp = $model->getcompanyid($_POST['nombreempresa1']);
  }

  foreach ($name as $color) { 
  
    //  foreach ($name1 as $color1) { 
  
  if (($color == "") || ($name1[$i] == "")) {

  } else {
    
     /* $alm->__SET('contactemail', $_POST['email']);*/
      $alm->__SET('social_content', $name1[$i]);
      $alm->__SET('social_name', $color);
      $alm->__SET('companycontact', $almcomp->__GET('id'));        
      $alm->__SET('contact_id_var', $almrcc->__GET('id'));
      
      $model->addsocial($alm);
    }
      //  echo '<script>alert("'.$color.'-'.$name1[$i].'");</script>';
      //  break;
    //}
       
  $i++;
  
  }


  }

}

    //end social

   }
  }
  }


 } //action=add


}



?>

</div>


<!--ORDENAR TABLAS-->
<script type="text/javascript" src="../../<?php echo $_SESSION['install_page'];?>/js/jquery.tablesorter.min.js"></script>
<!--ORDENAR TABLAS-->




</head>

<style>




@media screen and (min-width:100px) and (max-width:768px) {


.modal-backdrop {

    z-index: 0 !important;

}

}

</style>

<body>

<div id="profile_cont" class="container" style="margin: 0px; width: 100%;">
<div class="row">
  <div  id="sidebar_div" class="col-sm-3" style="padding-left: 0px;">
  <!-- including sidebar from templates-->
<?php require_once '../../'.$_SESSION['install_page'].'/template/sidebar.php'; ?>
  </div>

  

  <div class="col-sm-9" >





<!-- CONTENIDO A PARTIR DE AQUI hacia abajo-->
    <div class="row" >
        <div class="col-sm-12" id="marginmas768">
            <div class="tab-content">

            <!-- comienza 1er tab hacia abajo -->

 
                        
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


#contact_form{
background-image: linear-gradient(to bottom,#ffffff 0,#f5f5f5 100%);
color: #88898c;
    font-size: 14px;
}

.panel-body
{
    background-color: #FFF;
    overflow-y: scroll;
    height: 150px;
  
}






</style>


<br>
<br>


<div class="container col-md-12" >

<div class="crm-offer-title" style="padding-left:5%;">
Agregar nuevo contacto
</div>


    <form class="well form-horizontal" action="<?php echo $homeurl; ?>pages/contacts<?php echo $session; ?>&action=add" method="post"  id="contact_form" enctype="multipart/form-data">
<fieldset>

<div class="row">


<div class="col-md-4" >

<strong> Datos personales </strong> 
<br><br>
<!-- Text input-->

<div class="form-group">
  <div class="col-md-12 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input  name="first_name" placeholder="Nombres" class="form-control"  type="text" required>
  <input name="last_name" placeholder="Apellidos" class="form-control"  type="text" required>
    </div>
  </div>
</div>

<!-- Text input-->


  <div class="form-group"> 
    <div class="col-md-12 selectContainer">
    <div class="input-group">
        <span class="input-group-addon" style="width:39px;"><i class="fa fa-male fa-lg" aria-hidden="true"></i></span>
    <select name="sex" class="form-control selectpicker" required>
      <option value="">Seleccionar</option>
      <option value="Hombre">Hombre</option>
      <option value="Mujer">Mujer</option>

    </select>
  </div>
</div>
</div>
  




<!-- Text input-->
       <div class="form-group">
    <div class="col-md-12 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
  <input name="email" placeholder="Correo electrónico" class="form-control"  type="email" required>
    </div>
  </div>
</div>


<!-- Text input-->
       



<div class="form-group">
    <div class="col-md-12 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
  <input id="contact_number" name="contact_number" autocomplete="off" placeholder="Telefono" class="form-control" type="text" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>   
    </div>

<div class="col-md-12" style="text-align:right;">
    <div class="checkbox">
   <input type="checkbox" value="00-00000000" id="nonumber" />Sin datos de telefono
    </div>
</div>

  </div>
</div>


<!-- Text input-->
<div class="form-group">
    <div class="col-md-12 inputGroupContainer">
    Fecha de cumpleaños:
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-birthday-cake fa-lg"></i></span>
  <input name="bday" placeholder="Fecha de cumpleaños" class="form-control"  type="date" >
    </div>
  </div>
</div>





<!-- Text input-->
<div class="form-group">
    <div class="col-md-12 inputGroupContainer">
    Escribe una breve descripción o nota:
    
    
  <textarea  name="contactnotes" style="height: auto !important;" id="contactnotes" class="form-control"  rows="5" maxlegth="250"></textarea>

  
  </div>
</div>



</div> <!-- col-md-4 -->






<div class="col-md-4">
<strong> Datos empresariales </strong> 
<br><br>




<!-- Text input-->

<div class="form-group" id="divtoshow" style="display:none;">
  <div class="col-md-12 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="fa fa-building fa-lg"></i></span>
  <input id="empresasearch1"   name="nombreempresa" placeholder="Nombre de empresa" class="form-control" autocomplete="off"  type="text" onkeyup=" this.value = this.value.toUpperCase();">

    </div>
  </div>
</div>


<div class="form-group" id="divtosearch">
  <div class="col-md-12 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="fa fa-search fa-lg"></i></span>
  <input id="empresasearch"  name="nombreempresa1" placeholder="Buscar empresa"  autocomplete="off" class="form-control" onkeyup="myFunction23()" type="text">

  <div class="col-sm-10" style="display:none;"><input type="text" class="form-control" maxlength="50"  id="inputid1" name="inputid1" ></div>
    </div>
  </div>
</div>


<!-- desde aqui  abajo -->


<div class="panel-body" id="tablediv" style="display:none; ">

        
<table class="table table-striped" id="myTable1" style="width:100%;  min-height: 150px;">
  
    <?php foreach($model->getcompanies() as $r): ?>
                        <tr style="width:100%; height: 15px;">
                            <td style="display:none;" id="<?php echo $r->__GET('id'); ?>-1"> <?php echo $r->__GET('id'); ?></td>
                            <td style="width:100%;    padding:0px;  "><a id="<?php echo $r->__GET('id'); ?>" href="#" onclick="myFunction<?php echo $r->__GET('id'); ?>()"><?php echo $r->__GET('name'); ?></a></td>
                        </tr>

                        <?php

echo '<script>
function myFunction'.$r->__GET('id').'() {
 
 document.getElementById("empresasearch").value = document.getElementById("'.$r->__GET('id').'").innerHTML;
 document.getElementById("inputid1").value = document.getElementById("'.$r->__GET('id').'-1").innerHTML;
 
 document.getElementById("empresasearch").focus();
        document.getElementById("tablediv").style.display = "none";

}
</script>';
?>


    <?php endforeach; ?>


    <tr id='noresult1' style="display:none;"><td>No hay resultados<td></tr>

</table>

</div>

<script>

/* checking the table */
function myFunction23() {

    if (document.getElementById("empresasearch").value == "") {
        
     
        document.getElementById("tablediv").style.display = "none";
        document.getElementById("inputid1").value = "";
        
        
        } else {
        
        document.getElementById("tablediv").style.display = "block";
        
        }

  var input, filter, table, tr, td, i;
  input = document.getElementById("empresasearch");
  filter = input.value.toUpperCase();
  table = document.getElementById("tablediv");
  tr1 = table.getElementsByTagName("tr");
  
 var control1 = 0;
 var controlength1 = (tr1.length - 1);
  
  for (i = 0; i < tr1.length; i++) {
    td = tr1[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr1[i].style.display = "";


        
      } else {
        tr1[i].style.display = "none";


control1 = control1 + 1;


if (control1 <= controlength1) {
    
    document.getElementById("noresult1").style.display = "none";

} else {
    document.getElementById("noresult1").style.display = "block";

}

      }
    }       
  } 



}
</script>






<!-- desde aqui arriba -->








<div class="form-group" style="text-align:right;">
  <label class="col-md-12 control-label"></label>
  <div class="col-md-12" style="font-size: 12px;">
  <a href="##" id="createcompany" style="padding-right: 10px;"  >Crear<span style="padding-left:5px;" class="fa fa-plus fa-lg"></span>      </a>

  <a href="##" id="selectcompany">Seleccionar de lista<span style="padding-left:5px;" class="fa fa-list fa-lg"></span></a>

  </div>
</div>

<script>



$(function(){
 $('#createcompany').click(function(){
$('#newcompany').show( "slow" );
$('#divtoshow').show( "slow" );
$('#divtosearch').hide( "slow" );
$('#tablediv').hide( "" );
$('#empresasearch').val( "" );
$('#inputid').val( "" );


});

});

$(function(){
 $('#selectcompany').click(function(){
$('#newcompany').hide( "slow" );
$('#divtoshow').hide( "slow" );
$('#divtosearch').show( "slow" );
$('#empresasearch1').val( "" );
$('#currency').val( "" );
$('#industry').val( "" );
$('#employees').val( "" );
$('#companynotes').val( "" );
$('#responsable').val( "" );
$('#tablediv1').hide( "" );
});
});



</script>




<!-- Text input-->

<div class="form-group">
  <div class="col-md-12 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="fa fa-black-tie fa-lg"></i></span>
  <input  name="cargo" placeholder="Cargo" class="form-control"  type="text" required>
    </div>
  </div>
</div>


<div id="newcompany" style="display:none">

<!-- Text input-->

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




<div class="col-md-4" >
<strong> Imagen de contacto </strong> 
<br><br>

<a href="##" id="clickingimg"   alt="click para cambiar imagen"/>
<div id="imgdiv" class="imgdiv" >
    <img id="imgcontact" class="imgrounded" src="../../<?php echo $_SESSION['install_page'];?>/images/default/default.png" />
</div>
<br>
</a>
  <input style="display:none;"  type="file" name="imgInp" id="imgInp" class="form-control">



<strong> Redes sociales </strong> <br>
<!-- Text input-->


<!--multiple fields -->
                <div class="contacts" >
                    <div class="form-group multiple-form-group input-group " style="margin:5%; max-width:90%;">
                        <div class="input-group-btn input-group-select">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <span class="concept">Seleccionar</span> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#facebook">Facebook</a></li>
                                <li><a href="#linkedin">Linkedin</a></li>
                                <li><a href="#twitter">Twitter</a></li>
                                <li><a href="#instagram">Instagram</a></li>
                                <li><a href="#skype">Skype</a></li>
                                <li><a href="#URL">Sitio web</a></li>
                            </ul>
                            <input type="hidden" class="input-group-select-val" name="contacts[]" >
                        </div>
                        <input type="text" name="contacts1[]" class="form-control">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-success btn-add">+</button>
                        </span>
                    </div>
                </div>

     

<!--multiple fields -->



<!-- Button -->
<div class="form-group">
  <label class="col-md-12 control-label"></label>
  <div class="col-md-12"><br>
  <button type="button" class="btn btn-warning pull-left" onclick="clear1();" >Cancelar<span style="padding-left:5px;" class="fa fa-trash fa-lg"></span></button>

    <button type="submit" class="btn btn-success pull-right" >Guardar<span style="padding-left:5px;" class="fa fa-check fa-lg"></span></button>
  </div>
</div>




</div> <!-- col-md-4 -->













</div> <!-- row -->



</fieldset>
</form>

    </div><!-- /.container -->



    <style>





</style>



<script>

function clear1() {
document.getElementById("contact_form").reset();

/*CLEAR THE PREVIEW*/
document.getElementById("imgInp").value ="";
$('#imgcontact').attr('src','../../<?php echo $_SESSION['install_page'];?>/images/default/default.png');
$('#imgcontact').attr('class', 'imgrounded');
$('#imgcontact').css('margin-top',0);


}



/* FUNCTION DE SIN NUMERO*/
$(function(){
 $('#nonumber').click(function(){
var valnum = $("#contact_number").val();
if (valnum != "00-000000") {
$('#contact_number').attr('readonly', true);
$('#contact_number').val("00-000000");
}else{
$('#contact_number').attr('readonly', false);
$('#contact_number').val("");
}
});
});
/* FUNCION SIN NUMERO */

/*Agregar social*/
(function ($) {
var count = 0;
    $(function () {
        var addFormGroup = function (event) {
if (count == 5) {
    alert("Ha agregado el limite de redes sociales por usuario");
}else{
            event.preventDefault();

            var $formGroup = $(this).closest('.form-group');
            var $multipleFormGroup = $formGroup.closest('.multiple-form-group');
            var $formGroupClone = $formGroup.clone();

            $(this)
                .toggleClass('btn-success btn-add btn-danger btn-remove')
                .html('–');

            $formGroupClone.find('input').val('');
            $formGroupClone.find('.concept').text('Seleccionar');
            $formGroupClone.insertAfter($formGroup);

            var $lastFormGroupLast = $multipleFormGroup.find('.form-group:last');
            if ($multipleFormGroup.data('max') <= countFormGroup($multipleFormGroup)) {
                $lastFormGroupLast.find('.btn-add').attr('disabled', true);
            }    
            count = count + 1;    
}
        };
        var removeFormGroup = function (event) {
            event.preventDefault();
            var $formGroup = $(this).closest('.form-group');
            var $multipleFormGroup = $formGroup.closest('.multiple-form-group');
            var $lastFormGroupLast = $multipleFormGroup.find('.form-group:last');
            if ($multipleFormGroup.data('max') >= countFormGroup($multipleFormGroup)) {
                $lastFormGroupLast.find('.btn-add').attr('disabled', false);
            }
            $formGroup.remove();
            count = count - 1;
        };
        var selectFormGroup = function (event) {
            event.preventDefault();
            var $selectGroup = $(this).closest('.input-group-select');
            var param = $(this).attr("href").replace("#","");
            var concept = $(this).text();
            $selectGroup.find('.concept').text(concept);
            $selectGroup.find('.input-group-select-val').val(param);

        }

        var countFormGroup = function ($form) {
            return $form.find('.form-group').length;
        };

        $(document).on('click', '.btn-add', addFormGroup);
        $(document).on('click', '.btn-remove', removeFormGroup);
        $(document).on('click', '.dropdown-menu a', selectFormGroup);

    });
})(jQuery);
/*Agregar social*/



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



</script>













            <!-- nuevo desde aqui arriba -->
                      
            
            </div>





          <!-- Termina 1er tab hacia arriba -->

          <!-- comienza 2do tab hacia abajo -->
<?php if(isset($_GET['action'])) { ?>
  
  <?php if ((($_GET['action'])=="viewall") || (($_GET['action'])=="add")) { ?>
   
     <div class="tab-pane fade in  active" id="viewall">

   <?php } else { ?>

    <div class="tab-pane fade in" id="viewall">

    <?php } ?>

<?php } else { ?>

   <div class="tab-pane fade in active" id="viewall">

<?php } ?>
                 <!--  <div class="list-group">-->
          <!-- AQUI EMPIEZA VIEW abajo -->

          <br>

<?php if (isset($updated_contact)){ ?>

 <div class="alert alert-success">
 <i class="fa fa-check fa-lg"></i>  <strong>El usuario se ha modificado satisfactoriamente</strong> 
</div>

<?php } ?>



<br>

<form action ="<?php echo $homeurl;?>pages/contacts<?php echo $session;?>" method="post" id="formtoupdate" enctype="multipart/form-data">

<div class="col-md-6" style="text-align:right;">

<div class="form-group" style="width:100%">
  <div class="col-md-12 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="fa fa-search"></i></span>
  <input  name="inputcontacts" id="inputcontacts" placeholder="Buscar contacto por nombre o empresa" onkeyup="search()" class="form-control" autocomplete="off" type="text">
    </div>
  </div>
</div>


<?php echo'<script>
function search() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("inputcontacts");
  filter = input.value.toUpperCase();
  table = document.getElementById("table_contacts");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2]; 
    td1 = tr[i].getElementsByTagName("td")[3]; 

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

        if (td1.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {


        tr[i].style.display = "none";
      }

      }
    }       
  }
}
</script>';?>


</div>




<br>


<style>




.table-bordered{
  border: 0px solid #ddd;
}

</style>

<script>
$(document).ready(function() 
    { 
        $("#table_contacts").tablesorter(); 
    } 
);
</script>



<div class="panel-body col-md-12" id="tablediv_contacts" >

<table id="table_contacts" class="table table-bordered" cellspacing="0" style=" border-collapse: collapse; width:100%;">


  <thead id="head_contacttable">
  <tr>
  <th style="text-align:center; max-width: 80px; min-width: 70px;  width: 80px; ">ID <i class="fa fa-chevron-down " style="  cursor:pointer;  float: right;" aria-hidden="true"></i></th>
    <th style="min-width:200px; max-width: 280px;" colspan=2>Nombre <i class="fa fa-chevron-down " style="  cursor:pointer;  float: right;" aria-hidden="true"></i></th>

    <th style="min-width:150px;">Empresa <i class="fa fa-chevron-down " style="  cursor:pointer;  float: right;" aria-hidden="true"></i></th>
    <th style="text-align:center; max-width: 100px; min-width: 100px; ">Acción <i class="fa fa-chevron-down " style="  cursor:pointer;  float: right;" aria-hidden="true"></i></th>
  </tr>
  </thead>



  <tbody>
  

  <?php foreach($model->getcontacts() as $r): ?>
            <tr class="tr-table">
                    <td class="td-table" style="text-align:center;"><?php echo $r->__GET('id'); ?> <input type="checkbox" name="deletethisid[]" id="check1<?php echo $r->__GET('id'); ?>" value="<?php echo $r->__GET('id'); ?>" /> <input style="display:none;" id="check2<?php echo $r->__GET('id'); ?>"  type="checkbox" value="<?php echo $r->__GET('imgcontact'); ?>" name="imgcontacttodelete[]"/></td>
                    
<td class="td-table" style="text-align:center; width: 60px;" >
<div style="float:left; width: 30px; max-width: 60px;">
                   
                    <div id="imgdiv30" class="imgdiv30" style="margin-bottom: 15px;" >

<?php if ($r->__GET('imgcontact') == "") { ?>

<img id="contact_img30" class="imgrounded30" src="../../<?php echo $_SESSION['install_page'];?>/images/default/default.png" />

<?php } else { ?>

  <img id="contact_img30" class="imgrounded30" src="../../<?php echo $_SESSION['install_page'];?>/images/contacts/<?php echo $r->__GET('imgcontact');?>" />

<?php } ?>

               </div>     
               </div>                    
</td>
                    
                    <td class="td-table">
                    
                    <div class="row">
                  

                  <div>  
                    <a href="#" data-toggle="modal" data-target="#modal<?php echo $r->__GET('id'); ?>"><?php echo $r->__GET('namecontact'); echo " "; echo $r->__GET('lastnamecontact');?></a><br> <p style="font-size: 11px;">Cargo: <?php echo $r->__GET('chargecontact'); ?></p>
                    
                    </div>

                    </div> <!--row-->
                    </td>
  
                      

                    
                    <td class="td-table"><?php echo $r->__GET('companycontact'); ?></td>
                    <td class="td-table" style="text-align:center;"><a href="../../<?php echo $_SESSION['install_page'];?>/source/output.php?t=pdf&name=<?php echo $r->__GET('namecontact').$r->__GET('lastnamecontact'); ?>&id=<?php echo $r->__GET('id'); ?>&from=contact"><i class="fa fa-file-pdf-o fa-lg" ></i></a>  | <a href="##" data-toggle="tooltip" data-placement="right" title='Enviar ficha del contacto por correo electrónico'><i class="fa fa-envelope-o fa-lg"></i></a></td>

                    <td style="display:none;" class="td-table"><?php echo $r->__GET('chargecontact'); ?></td>
                    <td style="display:none;" class="td-table"><a href="#" data-toggle="modal" data-target="#modal<?php echo $r->__GET('id'); ?>">Ver detalle</a></td>
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
       


<div class="modal fade" id="modal<?php echo $r->__GET('id'); ?>">
<div class="modal-dialog" id="model-contact" style=" max-width:700px;  width: 100% !important; margin-bottom: 70px;">
    <div class="modal-content">



        <div class="modal-header">
            <button  type="button" class="close" data-dismiss="modal" aria-hidden="true" >×</button>
            
       
            <h4 class="modal-title">Perfil de <?php echo $r->__GET('namecontact'); echo " "; echo $r->__GET('lastnamecontact'); echo " "; ?>  
            
    <?php if (($_GET['rol']=="ADMIN")) { ?> 
            <a  <a style="   margin-left:20px;" class="acalend " type="button" href="contacts<?php echo $session; ?>&action=update&idcontact=<?php echo $r->__GET('id');?>"  style="margin-left:10px;" id="edit-prof<?php echo $r->__GET('id');?>">Editar <i class="fa fa-edit"></i></a>
    <?php } ?>

        </h4>



        
          </div>
       
          <div class="modal-body">

<div class="row">
<div class="col-md-12">

<div class="col-sm-4">
<div id="imgdiv" class="imgdiv" style="margin-bottom: 15px;" >

<?php if ($r->__GET('imgcontact') == "") { ?>

<img id="contact_img" class="imgrounded" src="../../<?php echo $_SESSION['install_page'];?>/images/default/default.png" />

<?php } else { ?>


  <?php
$imagen1 = "../../".$_SESSION['install_page']."/images/contacts/".$r->__GET('imgcontact');
list($ancho, $alto, $tipo, $atributos) = getimagesize($imagen1);
$margin = (150-(150*$alto)/$ancho)/2;
?>


<div class="imgdiv">
<?php if ($ancho > $alto) { ?>

    <img id="contact_img" src="<?php echo $imagen1;?>" style="margin-top:<?php echo $margin;?>px;" class="imgroundedhor" >

<?php } else { ?>

    <img id="contact_img" src="<?php echo $imagen1;?>" class="imgrounded" >

<?php } ?>
</div>


<?php } ?>

</div>




<div class="col-md-12">

<strong >Redes Sociales</strong>
<br>
<br>


<?php


$emailtocheck = $r->__GET('id');
$controlvar = 0;


 foreach($model->getsocial($emailtocheck) as $rsn): ?>


<?php if(trim($rsn->__GET('social_content'))!="") { ?>


<?php if(trim($rsn->__GET('social_name'))=="URL"){ ?>


  <div class="form-group" style="margin-bottom: 0px !important; ">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;  padding-left: 0px;  padding-right: 0px;">
  <div class="input-group">
  <span class="input-group-addon"><strong><?php echo $rsn->__GET('social_name');?></strong></span>
  <input  name="<?php echo $rsn->__GET('social_name');?>" id="" class="form-control" value="<?php echo $rsn->__GET('social_content');?>"  type="text" readonly>
    </div>
  </div>
</div>


<?php ++$controlvar;?>

<?php } else { ?>

<div class="form-group" style="margin-bottom: 0px !important; ">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;  padding-left: 0px;  padding-right: 0px;">
  <div class="input-group">
  <span class="input-group-addon"><i class="fa fa-<?php echo $rsn->__GET('social_name');?> fa-lg"></i></span>
  <input style="display:none;"  name="social[]"  value="<?php echo $rsn->__GET('social_name');?>"  type="text" readonly>
  <input  name="social1[]" id="" class="form-control socialnet<?php echo $r->__GET('id');?>" value="<?php echo $rsn->__GET('social_content');?>"  type="text" readonly>
    </div>
  </div>
</div>


<?php ++$controlvar;?>

<?php } ?>

<?php } ?>

<?php endforeach; ?>



<?php if($controlvar == 0) { ?>

<p  style="line-height: 1;
    font-size: 12px;">No tiene redes sociales asociadas</p>
<br>
  <?php } ?>


  


</div> <!-- col-md-12 -->

</div> <!-- col-md-4 -->

<div class="col-sm-8">


<strong>Datos personales</strong>
<br>
<br>

<input type="text" style="display:none;" name="idcontacttoupdate" value="<?php echo $r->__GET('id');?>"/>


<div class="form-group" style="margin-bottom: 0px !important;">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input  name="first_name" placeholder="Nombres" class="form-control" value="<?php echo $r->__GET('namecontact');?>"  type="text" readonly>
  <input name="last_name"  placeholder="Apellidos" class="form-control"  value="<?php echo $r->__GET('lastnamecontact');?>" type="text" readonly>
    </div>
  </div>
</div>


<div class="form-group" style="margin-bottom: 0px !important;"> 
    <div class="col-md-12 selectContainer" style="margin-bottom: 10px;">
    <div class="input-group">
        <span class="input-group-addon" style="width:39px;"><i class="fa fa-male fa-lg" aria-hidden="true"></i></span>
        <input name="sexinput" placeholder="" class="form-control"  value="<?php echo $r->__GET('sexcontact'); ?>" type="text" readonly>

  </div>
</div>
</div>
  

<!-- Text input-->
       <div class="form-group" style="margin-bottom: 0px !important;">
    <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
  <input name="email"  placeholder="Correo electrónico" class="form-control" value="<?php echo $r->__GET('emailcontact');?>"  type="email" readonly>
    </div>
  </div>
</div>


<!-- Text input-->
       



<div class="form-group">
    <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
  <input   name="contact_number" placeholder="Telefono" class="form-control" value="<?php echo $r->__GET('phonecontact');?>" type="text" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" readonly>   
</div>
</div>
</div>



<!-- Text input-->
<div class="form-group">
    <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-birthday-cake fa-lg"></i></span>
  <input name="bday" placeholder="Fecha de cumpleaños" class="form-control"  type="text" value="<?php echo $r->__GET('birthdaycontact');?>" readonly>
    </div>
  </div>
</div>


<div class="form-group">
    <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
  <strong>  Descripción:</strong>
  <br>
  <br>
  <textarea  name="contactnotes"  style="height: auto !important;" id="contactnotes" class="form-control"  rows="5" maxlegth="250" readonly><?php echo $r->__GET('notescontact');?></textarea>
  </div>
</div>


<strong>  Datos empresariales</strong>
  <br>
  <br>




  <div class="form-group" style="margin-bottom: 0px !important;">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
  <div class="input-group">
  <span class="input-group-addon"><i class="fa fa-building fa-lg"></i></span>
 
  <input name="charge"  placeholder="Cargo" class="form-control"  value="<?php echo $r->__GET('chargecontact');?>" type="text" readonly>
    
  <input  name="companytxt"  placeholder="Empresa" class="form-control" value="<?php echo $r->__GET('companycontact');?>"  type="text" readonly>

</div>
</div>
</div>

  

</div> <!-- col-md-8 -->





</div>
</div>

<div class="modal-footer">


<div class="col-sm-2" style="float:left; text-align:center;">

        <a href="../../<?php echo $_SESSION['install_page'];?>/source/output.php?t=pdf&name=<?php echo $r->__GET('namecontact').$r->__GET('lastnamecontact'); ?>&id=<?php echo $r->__GET('id'); ?>&from=contact"><i class="fa fa-file-pdf-o fa-lg" ></i> <br> Exportar </a>
</div>
</div>

</div>





<!-- </form> -->

</div>
</div>
</div>



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

<button type="submit" class="btn btn-danger pull-right" name="deletecontact" style="margin-left: 5px;" ><i class="fa fa-trash"></i> Eliminar</button> 
<!--<a href="#" type="button" class="btn btn-info pull-right" name="edit_contact"  ><i class="fa fa-edit"></i> Editar</a> -->

</div>
</div>


<script>
$('#maincheck1').click(function() {

    $(this.form.elements).filter(':checkbox').prop('checked', this.checked);
});

</script>


</div>


<?php } ?>

</form>


          <!-- AQUI termina VIEW arriba -->
               <!--  </div>-->
            </div>
          <!-- Termina 2do tab hacia arriba -->

     <!-- comienza 3er tab hacia abajo -->
            <div class="tab-pane fade in" id="import">
                <div class="list-group">
                    <div class="list-group-item"> <span class="text-center">
                IMPORTAR
                    </div>
                </div>
            </div>
          <!-- Termina 3er tab hacia arriba -->

  <!-- comienza 3er tab hacia abajo -->

  <?php if(isset($_GET['action'])) { ?>
  
  <?php if(($_GET['action'])=="update") { ?>
   
    <div class="tab-pane fade in active" id="edit">

   <?php } else { ?>

    <div class="tab-pane fade in" id="edit">
    
    <?php } ?>

<?php } else { ?>

  <div class="tab-pane fade in" id="edit">

<?php } ?>


                <div class="list-group">
                   

<!-- aqui empieza editar -->

<form action="<?php echo $homeurl;?>pages/contacts<?php echo $session;?>&action=viewall&update=submitted" method="post" enctype="multipart/form-data" >

<br>
<br>

                <div class="row">
<div class="col-sm-12"  style="padding-left: 5%;   padding-bottom: 5%; height:100vh;">

<div class="col-sm-4">

<strong>Imagen del contacto</strong>
<br>
<br>


<div id="imgdiv" class="imgdiv" style="margin-bottom: 15px;" >

<?php if ($r->__GET('imgcontact') == "") { ?>

<img id="contact_img1" class="imgrounded" src="../../<?php echo $_SESSION['install_page'];?>/images/default/default.png" />

<?php } else { ?>


  <?php
$imagen1 = "../../".$_SESSION['install_page']."/images/contacts/".$r->__GET('imgcontact');
list($ancho, $alto, $tipo, $atributos) = getimagesize($imagen1);
$margin = (150-(150*$alto)/$ancho)/2;
?>


<div class="imgdiv">
<?php if ($ancho > $alto) { ?>

    <img id="contact_img1"  src="<?php echo $imagen1;?>" style="margin-top:<?php echo $margin;?>px;" class="imgroundedhor" >

<?php } else { ?>

    <img id="contact_img1"  src="<?php echo $imagen1;?>" class="imgrounded" >

<?php } ?>
</div>


<?php } ?>

</div>
<div style="text-align:center; margin-bottom:10px;">
<a href="#" onclick="quitar();">Quitar imagen</a>
</div>


<div class="col-md-12" id="changeimg<?php echo $r->__GET('id');?>" >
<input  type="file" name="imgInp1" value="<?php echo $r->__GET('imgcontact');?>" id="imgInp1" class="form-control">


<input  type="text" style="display:none;" name="contact_img_old" id="contact_img_old" value="<?php echo $r->__GET('imgcontact');?>" />
<input  type="text" style="display:none;" name="contact_img_old1" id="contact_img_old1" value="<?php echo $r->__GET('imgcontact');?>" />


<br>
</div>

<script>
/* LOAD IMAGE PREVIEW */
function quitar(){
  document.getElementById("imgInp1").value ="";
  document.getElementById("contact_img_old").value ="";
$('#contact_img1').attr('src','../../<?php echo $_SESSION['install_page'];?>/images/default/default.png');
$('#contact_img1').attr('class', 'imgrounded');
$('#contact_img1').css('margin-top',0);






}


function readURL1(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#contact_img1').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp1").change(function(){
    readURL1(this);
});

</script>

<div class="col-md-12">

<strong >Redes Sociales</strong>
<br>
<br>

<?php


$emailtocheck = $r->__GET('id');;
$controlvar = 0;


 foreach($model->getsocial($emailtocheck) as $rsn): ?>


<?php if(trim($rsn->__GET('social_content'))!="") { ?>


<?php if(trim($rsn->__GET('social_name'))=="URL"){ ?>


  <div class="form-group" style="margin-bottom: 0px !important; ">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;  padding-left: 0px;  padding-right: 0px;">
  <div class="input-group">
  <span class="input-group-addon"><strong><?php echo $rsn->__GET('social_name');?></strong></span>
  <input type="text" style="display:none;"  name="social_idvar[]" value="<?php echo $rsn->__GET('social_id');?>" />
  <input style="display:none;" type="text" name="social[]" value="<?php echo $rsn->__GET('social_name');?>" />
  <input  name="social1[]" id="" class="form-control" value="<?php echo $rsn->__GET('social_content');?>"  type="text" >
    </div>
  </div>
</div>


<?php ++$controlvar;?>

<?php } else { ?>

<div class="form-group" style="margin-bottom: 0px !important; ">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;  padding-left: 0px;  padding-right: 0px;">
  <div class="input-group">
  <span class="input-group-addon"><i class="fa fa-<?php echo $rsn->__GET('social_name');?> fa-lg"></i></span>
  <input type="text" style="display:none;" name="social_idvar[]" value="<?php echo $rsn->__GET('social_id');?>" />
  <input style="display:none;"  name="social[]"  value="<?php echo $rsn->__GET('social_name');?>"  type="text" readonly>
  <input  name="social1[]" id="" class="form-control socialnet<?php echo $r->__GET('id');?>" value="<?php echo $rsn->__GET('social_content');?>"  type="text">
    </div>
  </div>
</div>


<?php ++$controlvar;?>

<?php } ?>

<?php } ?>

<?php endforeach; ?>



<?php if($controlvar == 0) { ?>

<p  style="line-height: 1;
    font-size: 12px;">No tiene redes sociales asociadas</p>
<br>
  <?php } ?>




<!--multiple fields -->
<div class="contacts" id="addsocial<?php echo $r->__GET('id');?>" >

<p  style="line-height: 1;
    font-size: 10px;">NOTA: para eliminar una red social existente se debe borrar el contenido.</p>
<br>


                    <div class="form-group multiple-form-group input-group " style="margin-bottom:5px; max-width:100%;">
                        <div class="input-group-btn input-group-select">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="padding-left: 3px;
    padding-right: 3px;">
                                <span class="concept" style="font-size: 10px;">Seleccionar</span> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" style="font-size: 10px;" role="menu">
                                <li><a href="#facebook">Facebook</a></li>
                                <li><a href="#linkedin">Linkedin</a></li>
                                <li><a href="#twitter">Twitter</a></li>
                                <li><a href="#instagram">Instagram</a></li>
                                <li><a href="#skype">Skype</a></li>
                                <li><a href="#URL">Sitio web</a></li>
                            </ul>
                            <input type="hidden" class="input-group-select-val" name="socialnew[]" >
                        </div>
                        <input type="text" name="socialnew1[]" class="form-control">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-success btn-add">+</button>
                        </span>
                    </div>
                </div>

     
  


</div> <!-- col-md-12 -->

<br>
<br>
<br>

</div> <!-- col-md-4 -->

<div class="col-sm-8" style=" max-width: 600px; height: 100vh;    ">


<strong>Datos personales</strong>
<br>
<br>

<input type="text" style="display:none;" name="idcontacttoupdate" value="<?php echo $r->__GET('id');?>"/>


<div class="form-group" style="margin-bottom: 0px !important;">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input  name="firstupdate" id="firstupdate" placeholder="Nombres" class="form-control" value="<?php echo $r->__GET('namecontact');?>"  type="text" required>
  <input name="lastupdate" id="lastupdate" placeholder="Apellidos" class="form-control"  value="<?php echo $r->__GET('lastnamecontact');?>" type="text" required>
    </div>
  </div>
</div>


<div class="form-group" style="margin-bottom: 0px !important;"> 
    <div class="col-md-12 selectContainer" style="margin-bottom: 10px;">
    <div class="input-group">
        <span class="input-group-addon" style="width:39px;"><i class="fa fa-male fa-lg" aria-hidden="true"></i></span>
    <select name="sexupdate" id="sexupdate" class="form-control selectpicker" required>
      <option value="" readonly>Seleccionar</option >
      <option value="Hombre" <?php echo $r->__GET('sexcontact') == 'Hombre' ? 'selected' : ''; ?>>Hombre</option>
      <option value="Mujer" <?php echo $r->__GET('sexcontact') == 'Mujer' ? 'selected' : ''; ?> >Mujer</option>

    </select>
  </div>
</div>
</div>
  

<!-- Text input-->
       <div class="form-group" style="margin-bottom: 0px !important;">
    <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
  <input name="emailupdate" id="emailupdate" placeholder="Correo electrónico" class="form-control" value="<?php echo $r->__GET('emailcontact');?>"  type="email" required>
    </div>
  </div>
</div>


<!-- Text input-->
       



<div class="form-group">
    <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
  <input  id="phoneupdate" name="phoneupdate" placeholder="Telefono" class="form-control" value="<?php echo $r->__GET('phonecontact');?>" type="text" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>   
</div>
</div>
</div>

<?php
$datecontact = $r->__GET('birthdaycontact');

?>


<!-- Text input-->
<div class="form-group">
    <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-birthday-cake fa-lg"></i></span>
  <input name="bdayupdate" id="bdayupdate" placeholder="Fecha de cumpleaños" class="form-control"  type="date" value="<?php echo $datecontact;?>" >
    </div>
  </div>
</div>


<div class="form-group">
    <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
  <strong>  Descripción:</strong>
  <br>
  <br>
  <textarea  name="notesupdate" id="notesupdate" style="height: auto !important;" class="form-control"  rows="5" maxlegth="250" ><?php echo $r->__GET('notescontact');?></textarea>
  </div>
</div>


<strong>  Datos empresariales</strong>
  <br>
  <br>


  <div class="form-group" style="margin-bottom: 0px !important;">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
  <div class="input-group">
  <span class="input-group-addon"><i class="fa fa-building fa-lg"></i></span>
 
  <input name="chargeupdate" id="chargeupdate" placeholder="Cargo" class="form-control"  value="<?php echo $r->__GET('chargecontact');?>" type="text" required>
    
 
  <select name="companyupdate" id="companyupdate" class="form-control selectpicker"  required>
      <option value="" >Seleccionar</option >
     
<?php $companyofthecontact = $r->__GET('companycontact'); ?>

<?php foreach($model->getcompanies() as $r): ?>

<?php if ($companyofthecontact ==  $r->__GET('name')) { ?>

  <option value="<?php echo $r->__GET('name'); ?>" selected><?php echo $r->__GET('name'); ?> </option >

<?php } else { ?>

  <option value="<?php echo $r->__GET('name'); ?>"><?php echo $r->__GET('name'); ?> </option >

<?php } ?>

<?php endforeach; ?>
</select>



</div>
</div>
</div>

<?php if(isset($_GET['idcontact'])){?>

<input style="display:none;" type="text" id="idcontactinp" name="idcontactinp" value="<?php echo $_GET['idcontact'];?>" />

<?php } ?>


<button type="submit" name"buttonsubmit"  id="submitbutton" class="btn btn-success pull-right" >Actualizar<span style="padding-left:5px;" class="fa fa-check fa-lg"></span></button>
<a type="button" href="<?php echo $homeurl; ?>pages/contacts<?php echo $session; ?>" style="margin-right:10px;" id="cancelbutton" class="btn btn-danger pull-right" >Cancelar<span style="padding-left:5px;" class="fa fa-window-close fa-lg"></span></a>



</div> <!-- col-md-8 -->

</div>
</div>


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