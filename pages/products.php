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



//if (isset($_POST['deletecategory'])){

  


  if (isset($_POST['datelethiscat'])){


  //  echo '<script> alert("GOTIN");</script>';  
    
    
$cate = $_POST['datelethiscat'];

foreach ($cate as $delete) {

  if(trim($delete) != "0"){

    $alm->__SET('productcategory', "0");
    $alm->__SET('catid', $delete);
    $model->productcatto0($alm);
    
    $model->deletecategory($delete); 
    
 //echo '<script> alert("'.$delete.'");</script>';  
  } 
  
}

  }
//}

if (isset($_POST['addcategory'])){

if(isset($_POST['catidtouptade'])){

//update category here


$alm->__SET('catname', $_POST['categoryname']);
$alm->__SET('catdescrip', $_POST['categorydescription']);
$alm->__SET('catid', $_POST['catidtouptade']);
$model->updatecategory($alm);

//echo '<script type="text/javascript">location.href = "'.$homeurl.'pages/products'.$session.'&action=newcategory";</script>';


} else {

  if(!empty($_POST['categoryname'])){
  
  $alm->__SET('catname', $_POST['categoryname']);
  $alm->__SET('catdescrip', $_POST['categorydescription']);
  $alm->__SET('cattype', '0');
  $alm->__SET('catparent', '0');
  
  $model->addcategory($alm);

  }


}

}




if(isset($_POST['addproduct'])){

 // echo '<script> alert("OK");</script>';



// starts here the img uploading
$target_dir = "../../".$_SESSION['install_page']."/images/products/";
$target_file1 = $target_dir . basename($_FILES["imgInp"]["name"]);

if(!empty(basename($_FILES["imgInp"]["name"]))){


  $cadena = $_POST['productname'];
  
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

 /* echo preg_replace($patrones, $sustituciones, $cadena)."<br>";

  echo $cadena;*/


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



  $alm->__SET('productname', $_POST['productname']);
  $alm->__SET('productstatus', '1');
  $alm->__SET('productquantity', $_POST['productquantity']);
  $alm->__SET('producthas_quant', $_POST['productinventary1']);
  $alm->__SET('productprice', $_POST['productprice2']);
  $alm->__SET('productunit', $_POST['productunit']);
  $alm->__SET('productdescription', $_POST['productsdescription']);
  $alm->__SET('productimg', $imgtouploadcontact);
  $alm->__SET('productassignto', '');
  $alm->__SET('productcategory', $_POST['productcategory']);
  $alm->__SET('critical_quant', trim($_POST['critical_quant2']));
  
  $model->addproduct($alm);

	
}




if(isset($_POST['submitupdateproduct'])){

//echo '<script> alert("'.$_POST['productnameupdate'].'-'.$_POST['productpriceupdate'].'-'.$_POST['productquantityupdate'].'-'.$_POST['productinventary1update'].'-'.$_POST['productunitupdate'].'-'.$_POST['productsdescriptionupdate'].'"); </script>';


// starts here the img uploading


if($_POST['contact_img_old2'] != $_FILES["imgInp2"]["name"]){
  
        if (!empty($_FILES["imgInp2"]["name"])) {
  
          if (!empty($_POST['contact_img_old2'])) {

            if (file_exists("../../".$_SESSION['install_page']."/images/products/".$_POST['contact_img_old2'])) {
              
            unlink("../../".$_SESSION['install_page']."/images/products/".$_POST['contact_img_old2']);       
            
            }
          } else {
            if (!empty($_POST['contact_img_old3'])) {
              if (file_exists("../../".$_SESSION['install_page']."/images/products/".$_POST['contact_img_old3'])) {
                
              unlink("../../".$_SESSION['install_page']."/images/products/".$_POST['contact_img_old3']);   
              }      
            } 
          }
  
  $target_dir1 = "../../".$_SESSION['install_page']."/images/products/";
  $target_file1 = $target_dir1 . basename($_FILES["imgInp2"]["name"]);
  
  
    if(!empty(trim($_POST['contact_img_old2']))){
      if (file_exists("../../".$_SESSION['install_page']."/images/products/".$_POST['contact_img_old2'])) {
        
    unlink("../../".$_SESSION['install_page']."/images/products/".$_POST['contact_img_old2']);
    }
  }  
  $uploadOk = 1;
  $key4 = date("Hi");



  $cadena = $_POST['productnameupdate'];
  
  $cadena = mb_strtolower($cadena);
  
 // echo $cadena."<br>";
  
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
  
  
  //echo preg_replace($patrones, $sustituciones, $cadena);



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
      if (file_exists("../../".$_SESSION['install_page']."/images/products/".$_POST['contact_img_old3'])) {
        
      unlink("../../".$_SESSION['install_page']."/images/products/".$_POST['contact_img_old3']);         
    } 
  }
  
    $imgtouploadcontact1 = $_POST['contact_img_old2'];
  
  }
  
  
  
  //end of the img uploading



$alm->__SET('productname', $_POST['productnameupdate']);
$alm->__SET('productstatus', '1');
$alm->__SET('productquantity', $_POST['productquantityupdate']);
$alm->__SET('producthas_quant', $_POST['productinventary1update']);
$alm->__SET('productprice', $_POST['productprice1update']);
$alm->__SET('productunit', $_POST['productunitupdate']);
$alm->__SET('productdescription', $_POST['productsdescriptionupdate']);
$alm->__SET('productimg', $imgtouploadcontact1);
$alm->__SET('productassignto', '');
$alm->__SET('productcategory', $_POST['productcategoryupdate']);
$alm->__SET('id', trim($_POST['productidupdate']));
$alm->__SET('critical_quant', trim($_POST['critical_quantupdate']));



$model->updateproduct($alm);



}

?>


<?php 

if (isset($_POST['deletethisid'])) {

$todelete = $_POST['deletethisid'];

$imgproducttodelete =  $_POST['productimgtodelete'];

$i5 = 0;


foreach ($todelete as $now) {

 //   echo '<script> alert("'.$now.'-'.$imgproducttodelete[$i5].'"); </script> ';
    

if (!empty(trim($imgproducttodelete[$i5]))){

  if (file_exists("../../".$_SESSION['install_page']."/images/products/".$imgproducttodelete[$i5])) {
    
  unlink("../../".$_SESSION['install_page']."/images/products/".$imgproducttodelete[$i5]);         
  
  }
}

    $model->deleteproduct($now); 

    $i5++;

$deleted = true;

}

}


?>



<style>

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


<div id="profile_cont" class="container" style="margin: 0px; padding: 0px; width: 100%;">
<div class="row">
  <div  id="sidebar_div" class="col-sm-3">
   
  <!-- including sidebar from templates-->
<?php require_once '../../'.$_SESSION['install_page'].'/template/sidebar.php'; ?>




  </div>

  <div class="col-sm-9">



<!-- CONTENIDO A PARTIR DE AQUI hacia abajo-->
<div class="row" style="padding:10px;">
        <div class="col-sm-12" id="marginmas768">
            <div class="tab-content">

<br>

            <!-- comienza 1er tab hacia abajo -->


            <?php if(isset($_GET['action'])) { ?>
  <?php if(($_GET['action'])=="new") { ?>
    <div class="tab-pane fade in active" id="new">
    <?php } else { ?>
    <div class="tab-pane fade in " id="new">
    <?php } ?>
<?php } else { ?>
  <div class="tab-pane fade in " id="new">
  <?php } ?>       

<!-- empieza nuevo abajo-->





           
<style>
#company_form{
background-image: linear-gradient(to bottom,#ffffff 0,#f5f5f5 100%);
color: #88898c;
    font-size: 14px;
}
</style>





<div class="container col-md-12" >



<div class="crm-offer-title" style="padding-left:5%;">
Agregar nuevo producto
</div>


    <form class="well form-horizontal" action="<?php echo $homeurl; ?>pages/products<?php echo $session; ?>&action=add" method="post"  id="company_form" enctype="multipart/form-data">
<fieldset>

<div class="row">


<div class="col-md-7">
<strong> Datos del producto </strong> 
<br><br>




<!-- Text input-->


<div class="form-group" style="margin-bottom: 0px !important;">
<div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
<div class="input-group">
<span class="input-group-addon">Producto</span>
<input  name="productname" class="form-control" type="text" maxlength="50" required>  
  </div>
</div>
</div>



<div class="form-group">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom:10px;">
  <div class="col-md-12" >
  <div class="checkbox">
 <input type="checkbox" value="1" name="productinventary" id="noinventary2"/>¿Maneja inventario?
 <input type="text" style="display:none;" name="productinventary1" id="noinventary3" value="0"/>
  </div>
</div>

<br>
<br>

  <div class="input-group">
      <span class="input-group-addon">Cantidad</span>
      <input  name="productquantity" id="productquantity2"  class="form-control"  type="number" value="0" readonly>
      </div>
      
</div>
</div>


<div class="form-group" style="margin-bottom: 0px !important;">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
  <div class="input-group">
  <span class="input-group-addon">Cantidad critica</span>
  <input  name="critical_quant2" id="critical_quant2" class="form-control" value="0"  type="number" readonly>
    </div>
  </div>
</div>




<div class="form-group" style="margin-bottom: 0px !important;">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
  <div class="input-group">
  <span class="input-group-addon">Precio</span>
  <input   name="productprice2" id="productprice2"  class="form-control" onKeypress="if (event.keyCode < 47 || event.keyCode > 57) event.returnValue = false;"  type="text" required>

    </div>
  </div>
</div>


<div class="form-group"> 
    <div class="col-md-12 selectContainer" style="margin-bottom:20px;">
    <div class="input-group">
        <span class="input-group-addon" style="width:39px;">Unidad de medida:</span>
    <select name="productunit" class="form-control selectpicker" required>
      <option value="">Seleccionar</option>
      <option value="Kg" >Kg</option>
      <option value="Gr" >Gr</option>
      <option value="metro(s)" >metro(s)</option>
      <option value="litro(s)" >litro(s)</option>
      <option value="onza(s)" >onza(s)</option>
      <option value="Otra" >Otra</option>
      <option value="NA" >No Aplica</option>


    </select>
  </div>
</div>
</div>



<div class="form-group">
    <div class="col-md-12 inputGroupContainer">
    <strong>Descripción:</strong>
    <br>
    <br>  <textarea  name="productsdescription" style="height: auto !important;"  class="form-control"  rows="5" maxlegth="250" ></textarea>
<br>
<br>
  </div>
</div>

<br>
<br>


</div> <!-- col-md-4 -->




<div class="col-md-5" >

<strong>Categoria del producto</strong>
<br>
<br>


<div class="form-group"> 
    <div class="col-md-12 selectContainer" style="margin-bottom:20px;">
    <div class="input-group" style="width: 100%;">
        <span class="input-group-addon" style="width:39px;">Categoria</span>
    <select name="productcategory" class="form-control selectpicker" required>
      <option value="">Seleccionar</option>
     
<?php foreach($model->getcategories() as $rcat): ?>
                    
                    <option value="<?php echo $rcat->__GET('catid'); ?>" ><?php echo $rcat->__GET('catname'); ?></option>

<?php endforeach; ?>
    
    </select>
  </div>
</div>
</div>




<strong> Imagen del producto </strong> 
<br><br>

<a href="##" id="clickingimg"   alt="click para cambiar imagen"/>
<div id="imgdiv" class="imgdiv" >
    <img id="imgcontact" class="imgrounded" src="../../<?php echo $_SESSION['install_page'];?>/images/default/default-product.png" />
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

    <button type="submit" name="addproduct" class="btn btn-success pull-right" >Guardar<span style="padding-left:5px;" class="fa fa-check fa-lg"></span></button>
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
$('#imgcontact').attr('src','../../'.$_SESSION['install_page'].'/images/default/default-product.png');



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




/* FUNCION SIN NUMERO */




</script>





            <!-- nuevo desde aqui arriba -->






<!-- termina nuevo arriba -->
   




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
 <i class="fa fa-check-circle fa-lg" style="margin-right:10px;"></i>  <strong>El producto se ha agregado satisfactoriamente</strong> 
</div>

  <?php } ?>

<?php } ?>

            <?php if (isset($_GET['update'])) { ?>
  
  <?php if ($_GET['update']=="submitted") { ?>

 <div class="alert alert-success">
 <i class="fa fa-check-circle fa-lg" style="margin-right:10px;"></i>  <strong>El producto se ha actualizado satisfactoriamente</strong> 
</div>

  <?php } ?>

<?php } ?>


<?php if (isset($deleted)) { ?>
  
 <div class="alert alert-success">
 <i class="fa fa-check-circle fa-lg" style="margin-right:10px;"></i>  <strong>El producto se ha eliminado satisfactoriamente</strong> 
</div>

<?php } ?>

<form action ="<?php echo $homeurl;?>pages/products<?php echo $session;?>" method="post" enctype="multipart/form-data">
            
    <div class="col-md-6" style="text-align:right;">
            
            <div class="form-group" style="width:100%">
              <div class="col-md-12 inputGroupContainer">
              <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-search"></i></span>
              <input  name="inputcompany" id="inputcompany" placeholder="Buscar por producto o categoria" onkeyup="search();" class="form-control"  type="text">
                </div>
              </div>
            </div>
            

    </div>

<?php echo '<script>function search() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("inputcompany");
  filter = input.value.toUpperCase();
  table = document.getElementById("table_company");
  tr = table.getElementsByTagName("tr");';?>




<?php if ($_GET['rol']=='ADMIN') {
echo'if(input.value=="") {
        document.getElementById("maincheckdiv").style.display = "block";
  } else {
    document.getElementById("maincheckdiv").style.display = "none";
  }'; }?>

  <?php echo '
for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
    td1 = tr[i].getElementsByTagName("td")[2]; 



    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
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


}</script>';?>







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
    <th style="min-width:200px; max-width: 280px;" colspan=2>Producto <i class="fa fa-chevron-down " style="  cursor:pointer;  float: right;" aria-hidden="true"></i></th>

    <th style="min-width:150px;">Categoría <i class="fa fa-chevron-down " style="  cursor:pointer;  float: right;" aria-hidden="true"></i></th>
    <th style="text-align:center; max-width: 100px; min-width: 100px; ">Acción <i class="fa fa-chevron-down " style="  cursor:pointer;  float: right;" aria-hidden="true"></i></th>
  </tr>
  </thead>



  <tbody>
  

  <?php foreach($model->getproducts() as $rproduct): ?>

            <tr class="tr-table">
            

            <td class="td-table" style="text-align:center;"><?php echo $rproduct->__GET('productid'); ?> <input class="check123" type="checkbox" name="deletethisid[]" id="check1<?php echo $rproduct->__GET('productid'); ?>" value="<?php echo $rproduct->__GET('productid'); ?>" /><input style="display:none;" id="check2<?php echo $rproduct->__GET('productid'); ?>"  type="checkbox" value="<?php echo $rproduct->__GET('productimg'); ?>"  name="productimgtodelete[]"/></td>

<td class="td-table" style="width:60px; text-align:center;">                                     
<div style=" width: 30px; max-width: 60px;">
<div id="imgdiv30" class="imgdiv30" style="margin-bottom: 15px;" >
<?php if ($rproduct->__GET('productimg') == "") { ?>
<img id="contact_img30" class="imgrounded30" src="../../<?php echo $_SESSION['install_page'];?>/images/default/default-product.png" />
<?php } else { ?>
  <img id="contact_img30" class="imgrounded30" src="../../<?php echo $_SESSION['install_page'];?>/images/products/<?php echo $rproduct->__GET('productimg');?>" />
<?php } ?>
</div>     
</div>     
</td>
               
               <td class="td-table">
               <div class="row">
                    <a href="#" data-toggle="modal" data-target="#modal<?php echo $rproduct->__GET('productid'); ?>"><?php echo $rproduct->__GET('productname');?></a><br><p style="font-size:11px;">Cantidad:
                      
                  
                    <?php if($rproduct->__GET('producthas_quant')== 0){ ?>
                No maneja inventario
                    <?php }else { ?>

                      <?php if($rproduct->__GET('productquantity') <= $rproduct->__GET('critical_quant')){ ?>

                    <span style="color: #ca3b37; font-weight: 900;"><?php echo $rproduct->__GET('productquantity');?> unidades</span>

                      <?php } else { ?>

                        <?php if($rproduct->__GET('productquantity') == 1){ ?>

                      <?php echo $rproduct->__GET('productquantity');?> unidad

                        <?php } else { ?>

                         <?php echo $rproduct->__GET('productquantity');?> unidades

                        <?php } ?>


                      <?php } ?>

                    <?php } ?>

                  
                  
                  </p>
                
               

                    </div> <!--row-->   
                
                
                </td>

                


      
                    <td class="td-table"><?php echo  $rproduct->__GET('productcategory');?></td>

                    <td style="display:none;" class="td-table"><a href="#" data-toggle="modal" data-target="#modal<?php echo $rproduct->__GET('productid'); ?>">Ver detalle</a></td>
                    

                    <td class="td-table" style="text-align:center;">


                    <a href="../../<?php echo $_SESSION['install_page'];?>/source/output.php?t=pdf&name=<?php echo $rproduct->__GET('productname'); ?>&id=<?php echo $rproduct->__GET('productid'); ?>"><i class="fa fa-file-pdf-o fa-lg"></i></a> | <a href="##" data-toggle="tooltip" data-placement="right" title='Enviar ficha del producto por correo electrónico'><i class="fa fa-envelope-o fa-lg"></i></a>



                    </td>



            </tr>


            <script>
          
          
$('#check1<?php echo $rproduct->__GET('productid'); ?>').change(function() {

if (document.getElementById("check2<?php echo $rproduct->__GET('productid'); ?>").checked == true) {

  $('#check2<?php echo $rproduct->__GET('productid'); ?>').prop('checked', false);

} else {

  $('#check2<?php echo $rproduct->__GET('productid'); ?>').prop('checked', true);

}

});

          
          </script>  



 <!-- Modal -->
 <div class="modal fade" id="modal<?php echo $rproduct->__GET('productid'); ?>" role="dialog"  >
    <div class="modal-dialog" id="model-company" style=" max-width:700px; margin-bottom: 70px; width: 100% !important;">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nombre del producto: <strong><?php echo $rproduct->__GET('productname'); ?></strong> 
  
          <?php if (($_GET['rol']=="ADMIN")) { ?> 
            <a style="   margin-left:20px;" class="acalend " type="button" href="products<?php echo $session; ?>&action=update&idproduct=<?php echo $rproduct->__GET('productid');?>"  style="margin-left:10px;" >Editar <i class="fa fa-edit"></i></a>
          <?php } ?>
          

           </h4>


        </div>
        <div class="modal-body">
        <div class="row">
<div class="col-md-12">
<div class="col-md-4">

<div id="imgdiv" class="imgdiv" style="margin-bottom: 15px;" >

<?php if ($rproduct->__GET('productimg') == "") { ?>

<img class="imgrounded"  src="../../<?php echo $_SESSION['install_page'];?>/images/default/default-product.png" />

<?php } else { ?>

  <?php
$imagen1 = "../../".$_SESSION['install_page']."/images/products/".$rproduct->__GET('productimg');
list($ancho, $alto, $tipo, $atributos) = getimagesize($imagen1);
$margin = (150-(150*$alto)/$ancho)/2;
?>


<div class="imgdiv">
<?php if ($ancho > $alto) { ?>

    <img  src="<?php echo $imagen1;?>" style="margin-top:<?php echo $margin;?>px;" class="imgroundedhor" >

<?php } else { ?>

    <img  src="<?php echo $imagen1;?>" class="imgrounded" >

<?php } ?>
</div>


<?php } ?>

</div>


</div> <!-- col md -4 -->



<div class="col-md-8">



<div class="form-group" style="margin-bottom: 0px !important;">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
  <div class="input-group">
  <span class="input-group-addon"><strong>Producto</strong></span>
  <input  name="productname" class="form-control" value="<?php echo $rproduct->__GET('productname');?>"  type="text" readonly>
    </div>
  </div>
</div>


<div class="form-group" style="margin-bottom: 0px !important;">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
  <div class="input-group">
  <span class="input-group-addon"><strong>Categoria</strong></span>
  <input  name="productcategory" class="form-control" value="<?php echo $rproduct->__GET('productcategory');?>"  type="text" readonly>
    </div>
  </div>
</div>

<div class="form-group" style="margin-bottom: 0px !important;">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
  <div class="input-group">
  <span class="input-group-addon"><strong>Maneja inventario</strong></span>
  <input  name="productinventary" class="form-control" value="<?php echo $rproduct->__GET('producthas_quant') == 1 ? 'Si' : 'No';?>"  type="text" readonly>
    </div>
  </div>
</div>

<?php if ($rproduct->__GET('producthas_quant') == 1) { ?>
<div class="form-group" style="margin-bottom: 0px !important;">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
  <div class="input-group">
  <span class="input-group-addon"><strong>Cantidad</strong></span>
  <input  name="productquantity" class="form-control" value="<?php echo $rproduct->__GET('productquantity');?>"  type="text" readonly>
    </div>
  </div>
</div>
<?php } ?>


<?php if ($rproduct->__GET('producthas_quant') == 1) { ?>
<div class="form-group" style="margin-bottom: 0px !important;">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
  <div class="input-group">
  <span class="input-group-addon"><strong>Cantidad critica</strong></span>
  <input  name="critical_quant" class="form-control" value="<?php echo $rproduct->__GET('critical_quant');?>"  type="text" readonly>
    </div>
  </div>
</div>
<?php } ?>



<?php 


$number = $rproduct->__GET('productprice');



?>

<div class="form-group" style="margin-bottom: 0px !important;">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
  <div class="input-group">
  <span class="input-group-addon"><strong>Precio</strong></span>
  <input  name="productprice" class="form-control" value="$ <?php echo number_format($number, 0,',','.');?>"  type="text" readonly>
    </div>
  </div>
</div>


<?php if ($rproduct->__GET('productunit') != "NA") { ?>

<div class="form-group" style="margin-bottom: 0px !important;">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
  <div class="input-group">
  <span class="input-group-addon"><strong>Unidad de medida</strong></span>
  <input  name="productunit" class="form-control" value="<?php echo $rproduct->__GET('productunit');?>"  type="text" readonly>
    </div>
  </div>
</div>
<?php } ?>

<div class="form-group">
    <div class="col-md-12 inputGroupContainer">
    <strong>Descripción:</strong>
  <textarea  name="productsdescription" style="height: auto !important;"  class="form-control"  rows="5" maxlegth="250" readonly><?php echo $rproduct->__GET('productdescription');?></textarea>
<br>
<br>
  </div>
</div>




</div> <!-- col md -8 -->




</div> <!-- col-md-12 -->

      </div>
        <div class="modal-footer">


<div class="col-sm-2" style="float:left; text-align:center;">
        <a href="../../<?php echo $_SESSION['install_page'];?>/source/output.php?t=pdf&name=<?php echo $rproduct->__GET('productname'); ?>&id=<?php echo $rproduct->__GET('productid'); ?>"><i class="fa fa-file-pdf-o fa-lg"></i><br> Exportar </a>
</div>


<div class="col-sm-10">

      <?php  if(!empty(trim($rproduct->__GET('productassignto')))){ ?>
      <?php  $almname = $model->getusername(trim($rproduct->__GET('productassignto')));  ?>

<p style="font-size:11px;">Este producto se ha asignado a  <?php echo $almname->__GET('name')." ".$almname->__GET('lastname'); ?></p>

      <?php } else { ?>

        <p style="font-size:11px;">Este producto no ha sido asignado a ningun ejecutivo</p>


<?php } ?>

</div>
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
<input type="checkbox" id="maincheck1" /> Seleccionar todo <div class="tooltip">  AQUI <span class="tooltiptext">Tooltip text</span> </div>
</div>
</div>
<div class="col-sm-6" >

<input style="display:none;" type="text" value="ok" name="deletecompany" />
<button type="submit" class="btn btn-danger pull-right" name="deletecontact" style="margin-left: 5px;" ><i class="fa fa-trash"></i> Eliminar</button> 

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




</div>
<!-- Termina 2do tab hacia arriba -->

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

          <!--empieza editar hacia abajo -->
<form action="<?php echo $homeurl;?>pages/products<?php echo $session;?>&action=viewall&update=submitted" method="post" enctype="multipart/form-data" >

<div class="row">

<div class="col-sm-12">


<div class="col-sm-4">

<strong>Imagen del producto</strong>
<br>
<br>

<div id="imgdiv" class="imgdiv" style="margin-bottom: 15px;" >

<?php if ($rproduct->__GET('productimg') == "") { ?>

<img class="imgrounded" id="companyimgshow" src="../../<?php echo $_SESSION['install_page'];?>/images/default/default-product.png" />

<?php } else { ?>

  <?php
$imagen1 = "../../".$_SESSION['install_page']."/images/products/".$rproduct->__GET('productimg');
list($ancho, $alto, $tipo, $atributos) = getimagesize($imagen1);
$margin = (150-(150*$alto)/$ancho)/2;
?>


<div class="imgdiv">
<?php if ($ancho > $alto) { ?>

    <img id="companyimgshow"  src="<?php echo $imagen1;?>" style="margin-top:<?php echo $margin;?>px;" class="imgroundedhor" >

<?php } else { ?>

    <img id="companyimgshow"  src="<?php echo $imagen1;?>" class="imgrounded" >

<?php } ?>
</div>


<?php } ?>


</div>

<div style="text-align:center; margin-bottom:10px;">
<a href="#" onclick="quitar();">Quitar imagen</a>
</div>


<div class="col-md-12" id="changeimg<?php echo $rproduct->__GET('productid');?>" >
<br>
<input  type="file" name="imgInp2" value="<?php echo $rproduct->__GET('productimg');?>" id="imgInp1" class="form-control">

<input style="display:none;" type="text"  name="contact_img_old2" id="contact_img_old" value="<?php echo $rproduct->__GET('productimg');?>" />
<input style="display:none;" type="text"  name="contact_img_old3" id="contact_img_old" value="<?php echo $rproduct->__GET('productimg');?>" />

<br>
<br>
<br>


</div>


</div> <!-- col sm -4 -->



<div class="col-sm-8" style=" max-width: 600px; height: 100vh;    ">


<strong>Datos del producto</strong>
<br>
<br>

<!--AQUI-->

<div class="form-group" style="margin-bottom: 0px !important;">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
  <div class="input-group">
  <span class="input-group-addon">Producto</span>
  <input  name="productnameupdate" class="form-control" maxlength="50" value="<?php echo $rproduct->__GET('productname');?>"  type="text" required>
<?php if(isset($_GET['idproduct'])) { ?>
  <input  name="productidupdate" style="display:none;"  class="form-control" value="<?php echo $_GET['idproduct'];?>"  type="text" required>
<?php } ?>
    </div>
  </div>
</div>


<div class="form-group">
    <div class="col-md-12 inputGroupContainer" style="margin-bottom:10px;">
    <div class="col-md-12" >
    <div class="checkbox">
   <input type="checkbox" value="1" name="productinventary" id="noinventary" <?php echo $rproduct->__GET('producthas_quant') == 1 ? 'checked' : '';?>/>¿Maneja inventario?
   <input type="text" style="display:none;" name="productinventary1update" id="noinventary1" value="<?php echo $rproduct->__GET('producthas_quant');?>"/>
    </div>
</div>

<br>
<br>

    <div class="input-group">
        <span class="input-group-addon">Cantidad</span>
        <input  name="productquantityupdate" id="productquantity"  class="form-control" value="<?php echo $rproduct->__GET('productquantity');?>"  type="number" <?php echo $rproduct->__GET('producthas_quant') == 1 ? 'required' : 'readonly';?>>
        </div>
        
  </div>
</div>




<div class="form-group" style="margin-bottom: 0px !important;">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
  <div class="input-group">
  <span class="input-group-addon">Cantidad critica</span>
  <input  name="critical_quantupdate" id="critical_quantupdate" class="form-control" value="<?php echo $rproduct->__GET('critical_quant');?>"  type="number" required>
    </div>
  </div>
</div>





<?php 

$number = $rproduct->__GET('productprice');

?>

<div class="form-group" style="margin-bottom: 0px !important;">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
  <div class="input-group">
  <span class="input-group-addon">Precio</span>
  <input  name="productpriceupdate" id="productprice"  class="form-control" value="$ <?php echo number_format($number, 0,',','.');?>" onKeypress="if (event.keyCode < 47 || event.keyCode > 57) event.returnValue = false;"  type="text" required>
  <input style="display:none;"  name="productprice1update" id="productprice1"  class="form-control" value="<?php echo $rproduct->__GET('productprice');?>" onKeypress="if (event.keyCode < 46 || event.keyCode > 57) event.returnValue = false;"  type="text" required>

    </div>
  </div>
</div>


<div class="form-group"> 
    <div class="col-md-12 selectContainer" style="margin-bottom:20px;">
    <div class="input-group">
        <span class="input-group-addon" style="width:39px;">Unidad de medida:</span>
    <select name="productunitupdate" class="form-control selectpicker" required>
      <option value="">Seleccionar</option>
      <option value="Kg" <?php echo $rproduct->__GET('productunit') == 'Kg'? 'selected' : '';?>>Kg</option>
      <option value="Gr" <?php echo $rproduct->__GET('productunit') == 'Gr'? 'selected' : '';?>>Gr</option>
      <option value="metro(s)" <?php echo $rproduct->__GET('productunit') == 'metro(s)'? 'selected' : '';?>>metro(s)</option>
      <option value="litro(s)" <?php echo $rproduct->__GET('productunit') == 'litro(s)'? 'selected' : '';?>>litro(s)</option>
      <option value="onza(s)" <?php echo $rproduct->__GET('productunit') == 'onza(s)'? 'selected' : '';?>>onza(s)</option>
      <option value="Otra" <?php echo $rproduct->__GET('productunit') == 'Otra'? 'selected' : '';?>>Otra</option>
      <option value="NA" <?php echo $rproduct->__GET('productunit') == 'NA'? 'selected' : '';?>>No Aplica</option>


    </select>
  </div>
</div>
</div>
  

<div class="form-group"> 
    <div class="col-md-12 selectContainer" style="margin-bottom:20px;">
    <div class="input-group" style="width: 100%;">
        <span class="input-group-addon" style="width:39px;">Categoria</span>
    <select name="productcategoryupdate" class="form-control selectpicker" required>
      <option value="">Seleccionar</option>
     
<?php foreach($model->getcategories() as $rcat): ?>
            <tr>
        <?php if (trim($rcat->__GET('catname')) == trim($rproduct->__GET('productcategory')) ) { ?>

          <option value="<?php echo $rcat->__GET('catid'); ?>" selected><?php echo $rcat->__GET('catname'); ?></option>
        
        <?php } else { ?>

          <option value="<?php echo $rcat->__GET('catid'); ?>" ><?php echo $rcat->__GET('catname'); ?></option>

        <?php } ?>
<?php endforeach; ?>
    
    </select>
  </div>
</div>
</div>



<div class="form-group">
    <div class="col-md-12 inputGroupContainer">
    <strong>Descripción:</strong>
    <br>
    <br>  <textarea  name="productsdescriptionupdate"  maxlength="250" style="height: auto !important;"  class="form-control"  rows="5" maxlegth="250" ><?php echo $rproduct->__GET('productdescription');?></textarea>
<br>
<br>
  </div>
</div>

<br>
<br>

<button type="submit" name="submitupdateproduct" value="ok" id="submit" class="btn btn-success pull-right" >Actualizar<span style="padding-left:5px;" class="fa fa-check fa-lg"></span></button>
<a type="button" href="<?php echo $homeurl; ?>pages/products<?php echo $session; ?>" style="margin-right:10px;" id="cancelbutton" class="btn btn-danger pull-right" >Cancelar<span style="padding-left:5px;" class="fa fa-window-close fa-lg"></span></a>



</div> <!-- col sm -8 -->


<?php echo '<script>


$(function(){
  $("#productprice").blur(function(){
 
 var control = $("#productprice").val();
 
 if(control == ""){
 $("#productprice").val("$ '.number_format($number, 0,',','.').'");
 $("#productprice1").val("'.$rproduct->__GET('productprice').'");

 } else {

  document.getElementById("productprice1").value = document.getElementById("productprice").value;
  

 }
 
 });
 });

</script>'; ?>


<script>

productprice
$(function(){
 $('#productprice').click(function(){
$('#productprice').val('');
});
});



/* FUNCTION DE SIN NUMERO*/
$(function(){
 $('#noinventary').click(function(){

  if (document.getElementById("noinventary").checked == true) {
    
$('#productquantity').attr('required', true);
$('#productquantity').attr('readonly', false);
$('#productquantity').val('');


$('#critical_quantupdate').attr('required', true);
$('#critical_quantupdate').attr('readonly', false);
$('#critical_quantupdate').val('');

$('#noinventary1').val('1');


}else{

$('#productquantity').attr('readonly', true);
$('#productquantity').attr('required', false);
$('#productquantity').val('0');


$('#critical_quantupdate').attr('required', false);
$('#critical_quantupdate').attr('readonly', true);
$('#critical_quantupdate').val('0');

$('#noinventary1').val('0');




}
});
});
/* FUNCION SIN NUMERO */


/* FUNCTION DE SIN NUMERO*/
$(function(){
 $('#noinventary2').click(function(){

  if (document.getElementById("noinventary2").checked == true) {
    
$('#productquantity2').attr('required', true);
$('#productquantity2').attr('readonly', false);
$('#productquantity2').val('');
$('#critical_quant2').attr('required', true);
$('#critical_quant2').attr('readonly', false);
$('#critical_quant2').val('');
$('#noinventary3').val('1');


}else{

$('#productquantity2').attr('readonly', true);
$('#productquantity2').attr('required', false);
$('#productquantity2').val('0');
$('#critical_quant2').attr('required', false);
$('#critical_quant2').attr('readonly', true);
$('#critical_quant2').val('0');
$('#noinventary3').val('0');

}
});
});
/* FUNCION SIN NUMERO */



/* LOAD IMAGE PREVIEW */
function quitar(){
  document.getElementById("imgInp1").value ="";
  document.getElementById("contact_img_old").value ="";
$('#companyimgshow').attr('src','../../<?php echo $_SESSION['install_page'];?>/images/default/default-product.png');
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



</div> <!-- col sm 12 -->
</div> <!-- row -->
</form>


          <!--termina editar hacia arriba -->        




                </div>
            </div>
          <!-- Termina 3er tab hacia arriba -->





          <?php if(isset($_GET['action'])) { ?>
  <?php if(($_GET['action'])=="newcategory") { ?>
    <div class="tab-pane fade in active" id="newcategory">
    <?php } else { ?>
    <div class="tab-pane fade in " id="newcategory">
    <?php } ?>
<?php } else { ?>
  <div class="tab-pane fade in " id="newcategory">
  <?php } ?>       


  <div class="container col-md-12"  style="width: 100% !important;" >



<div class="crm-offer-title" style="padding-top: 3px; padding-left:10px;">
<b>Detalle de categorias</b>
</div>


    <div class="well form-horizontal" style="background-image: linear-gradient(to bottom,#ffffff 0,#f5f5f5 100%);">
<fieldset>

<div class="col-md-6" style="padding-top:10px; padding-bottom:10px;">

<form action="" method="post" id="formtosubmit" >

<strong>Categorias existentes</strong>

<div class="panel-body col-md-12" id="tablediv_contacts" >

<table id="table_company" class="table table-bordered" cellspacing="0" style=" border-collapse: collapse; width:100%;">
<thead id="head_contacttable">
  <tr>
  <th  style="text-align:center; min-width: 50px;">ID</th>
    <th style="min-width: 150px;">Nombre</th>
    <th>Descripción</th>
 
  </tr>
  </thead>
  <tbody>

  <?php foreach($model->getcategories() as $rcat): ?>
            <tr>
             
                    <td><div><?php echo $rcat->__GET('catid'); ?><input type="checkbox" name="datelethiscat[]" style="    margin-left: 3px;" value="<?php echo $rcat->__GET('catid'); ?>" <?php echo $rcat->__GET('catid') == 0 ? "disabled" : ''; ?>/></div></td>
                    <td><a href="<?php echo $homeurl."pages/products".$session."&action=newcategory&catid=".$rcat->__GET('catid'); ?>" <?php echo $rcat->__GET('catid') == 0 ? 'style="display:none;' : ''; ?> data-toggle="tooltip" title="Editar categoria"><i class="fa fa-edit"></i></a> <?php echo $rcat->__GET('catname'); ?> </td>
                    <td><?php echo $rcat->__GET('catdescrip'); ?></td>

</tr>
<?php endforeach; ?>


  </tbody>
  </table>
  </div>


  <div class="col-md-12" style="    margin: 10px 0px;
    text-align: right;">

<button type="button" class="btn btn-danger" name="deletecategory" onclick="confirmalert();">Eliminar <i class="fa fa-trash"></i></button>

</div><!--col-md-12-->

</form>

</div>

<div class="col-md-6"  style="padding-top:10px; padding-bottom:10px;">


<strong>Agregar nueva categoria</strong>
<br>
<br>

<form action="<?php echo $homeurl.'pages/products'.$session.'&action=newcategory';?>" method="post" >


<?php if (isset($_GET['catid']) ){ ?>
  

  
<?php foreach($model->getcatbyid($_GET['catid']) as $r): ?>
		
<div class="form-group" style="margin-bottom: 0px !important;">
<div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
<div class="input-group">
<span class="input-group-addon"><strong>Nombre</strong></span>
<input  name="categoryname" class="form-control" type="text" value="<?php echo	$r->__GET('catname'); ?>" maxlength="50" required autofocus>  
  <input style="display:none;" name="catidtouptade" value="<?php echo	$_GET['catid']; ?>" />
  </div>
</div>
</div>


<div class="form-group">
    <div class="col-md-12 inputGroupContainer">
    <strong>Descripción:</strong>
  <textarea  name="categorydescription" style="height: auto !important;"  class="form-control"  rows="5" maxlegth="250" ><?php echo	$r->__GET('catdescrip'); ?></textarea>
<br>
<br>
  </div>
</div>



<?php endforeach; ?>
		
<?php } else { ?>

<div class="form-group" style="margin-bottom: 0px !important;">
<div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;">
<div class="input-group">
<span class="input-group-addon"><strong>Nombre</strong></span>
<input  name="categoryname" class="form-control" type="text" maxlength="50" required>  
  </div>
</div>
</div>



<div class="form-group">
    <div class="col-md-12 inputGroupContainer">
    <strong>Descripción:</strong>
  <textarea  name="categorydescription" style="height: auto !important;"  class="form-control"  rows="5" maxlegth="250" ></textarea>
<br>
<br>
  </div>
</div>

<?php } ?>


<button type="submit" style="float:right;" name="addcategory" class="btn btn-success">Guardar <i class="fa fa-check"></i></button>


</form>




</div> <!--col-md-6-->


<script>
function confirmalert() {
    var txt;
    var r = confirm('Los productos pertenecientes a las categorias seleccionadas serán cambiados a "Sin categoria", ¿Desea continuar?');
    if (r == true) {

        txt = "Borrar";
        $('#formtosubmit').submit();

    } else {
        txt = "NO";
    }
}
</script>




</fieldset>
</div>

</div>

</div>
<!-- empieza nuevo abajo-->




<!--empieza seleccionar categorias abajo -->


<?php if(isset($_GET['action'])) { ?>
  <?php if(($_GET['action'])=="selectcategory") { ?>
    <div class="tab-pane fade in active" id="selectcategory">
    <?php } else { ?>
    <div class="tab-pane fade in " id="selectcategory">
    <?php } ?>
<?php } else { ?>
  <div class="tab-pane fade in " id="selectcategory">
  <?php } ?>       

<?php if (isset($_GET['response'])) { ?>
  <div class="alert alert-danger alert-dismissable">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong><i style="margin-right:10px;" class="fa fa-exclamation-triangle" aria-hidden="true"></i> Debe seleccionar una categoria</strong> 
</div>
<?php } ?>
  <div class="container col-md-12"  style="width: 100% !important;" >



<div class="crm-offer-title" style="padding-top: 3px; padding-left:10px;">
<b>Seleccionar categoria a exportar</b>
</div>


    <div class="well form-horizontal" style="background-image: linear-gradient(to bottom,#ffffff 0,#f5f5f5 100%);">
<fieldset>

<div class="col-md-12" style="    padding-left: 0px;
    padding-right: 0px; padding-top:10px; padding-bottom:10px;">

<form action="<?php echo $homeurl; ?>source/output.php?t=pdf&from=cat&name=catalogo de productos por categoria" method="post"  >

<strong>Categorias en uso</strong>

<div class="panel-body col-md-12" id="tablediv_contacts" >

<table id="table_company" class="table table-bordered" cellspacing="0" style=" border-collapse: collapse; width:100%;">
<thead id="head_contacttable">
  <tr>
  <th  style="text-align:center; min-width: 50px;">ID</th>
    <th style="min-width: 150px;">Nombre</th>
    <th>Descripción</th>
 
  </tr>
  </thead>
  <tbody>


  <?php foreach($model->getcategoriesinuse() as $rcat): ?>
            <tr>
             
                    <td><div><?php echo $rcat->__GET('catid'); ?><input type="checkbox" class="foo" name="exportthiscat[]" style="    margin-left: 3px;" value="<?php echo $rcat->__GET('catid'); ?>" /></div></td>
                    <td> <?php echo $rcat->__GET('catname'); ?> </td>
                    <td><?php echo $rcat->__GET('catdescrip'); ?></td>

</tr>
<?php endforeach; ?>




  </tbody>
  </table>
  </div>



  <div class="panel-footer col-sm-12">

<div class="row">
<div class="col-sm-6" style="margin-top:5px;" >


</div>
<div class="col-sm-6" style="text-align:right;">

<input type="text" value="<?php echo $session;?>" style="display:none;" name="session" />
<button type="submit" class="btn btn-default" name="exportcategory" ><i style="color: #ca0000; width: auto; margin-left: 5px; margin-right: 10px; padding-top: 7px;" class="fa fa-file-pdf-o fa-2x fa1"></i>Exportar</button>

</div>
</div>

<?php if(isset($_GET['action'])) { ?>
  <?php if(($_GET['action'])=="selectcategory") { ?>

<script>


$("input:checkbox").on('click', function() {
  var $box = $(this);
  if ($box.is(":checked")) {
  
    var group = "input:checkbox[name='" + $box.attr("name") + "']";

    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});

</script>

  <?php } } ?>


</form>

</div>






</fieldset>
</div>

</div>

</div>



<!-- termina seleccionar categorias arriba -->



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