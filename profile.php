<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>


<link rel="icon" href="images/favicon.png" type="image/x-icon">
<link rel="stylesheet" href="css/style.css">

<?php
require_once 'config.php';
require_once 'header.php';
?>


<style>

.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    border-top: 0px solid #ffffff;
}


@media screen and (max-width:1077px){
    .sidebar-nav{
        min-width: 60px;
        width: 100%;
    }  

  }
 /* NAVBAR responsive */

 @media screen and (min-width:769px){
  
#padding10 {
  padding-left:10%;
}

#paddingnec {
  padding-left:5%;
}


  }


</style>
</head>


<body>





<div id="profile_cont" class="container" style="margin: 0px; padding: 0px; width: 100%;">
<div class="row" id="rowmain">
  <!-- SIDEBAR -->
  <div  id="sidebar_div" class="col-sm-3">
  
  <?php require_once 'template/sidebar.php'; ?>


    </div>
 <!-- SIDEBAR -->


<!-- webside content -->
  <div class="col-sm-9">

<br>

<?php 
if(isset($_GET['upload'])){

if ($_GET['upload']=="error"){ ?>

<div class="alert alert-danger alert-dismissable fade in" style="    margin: 10px 5%; text-align: center;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <i class="fa fa-exclamation-circle" style="margin-right: 5px;">      </i><strong>Ha ocurrido un error durante la carga de su imagen</strong>.
  </div>

<?php } ?>

<?php if ($_GET['upload']=="success"){ ?>

<div class="alert alert-success alert-dismissable fade in" style="    margin: 10px 5%; text-align: center;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <i class="fa fa-check" style="margin-right: 5px;">      </i><strong>Su imagen ha sido actualizada</strong>
  </div>

<?php } 
}?>




<div class="card1 col-sm-12" style="     background-color: #fff !important; !important; padding: 0;">
<div class="crm-offer-title">
<h2 style="text-align:center;     margin-top: 0px;">Perfil de <?php echo $alm->__GET('name') == "" ? 'USUARIO' : $alm->__GET('name'); ?> <a class="acalend " href="<?php echo $homeurl."edit-profile".$session;?>"><i style="margin-left:10px;" class="fa fa-pencil-square-o"></i></a></h2>
</div>

<br>
<br>
  <div class=" col-sm-4" id="padding10" >

  <div id="img_profile_div" class="imgdiv">
  <?php if (!empty($alm->__GET('user_img'))) :?>
<img src="<?php echo $homeurl;?>images/<?php echo $alm->__GET('user_img'); ?>?<?php echo $alm->__GET('id'); ?>" id="img_profile" class="imgrounded" name="img_profile"  alt="Avatar">
    <?php else:?>
<img src="<?php echo $homeurl;?>images/default/default.png" class="imgrounded" id="img_profile"  alt="Avatar" >
    <?php endif; ?>
</div><br>



<br>

<div id="table_font" style=" margin-bottom:30px">
<h2  style="text-align:center;"> Descripción </h2>
<br>
<p>
<?php echo $alm->__GET('description') != '' ? $alm->__GET('description') : 'El usuario no ha establecido descripción' ; ?>
</p>
</div>


</div>




  <div class="container1 col-sm-8" style="padding-bottom:20%;">

  
 
<h2 style="text-align:center;"> Datos personales </h2>


<div class="table-responsive" id="paddingnec" >  
    <table class="table table-sm" id="table_font">
  <thead >
  </thead>
   
  <tbody>
    <tr >
      <td><strong><i class="fa fa-user" style="margin-right:10px;">  </i> Nombre: </strong>
      <?php echo $alm->__GET('name') == "" ? 'S/I' : $alm->__GET('name'); ?> <?php echo $alm->__GET('lastname') == "" ? 'S/I' : $alm->__GET('lastname'); ?></td>

    </tr>



    <tr>
  <td><strong><i class="fa fa-male" style="margin-right:10px;"> </i> Sexo: </strong>
    <?php echo $alm->__GET('sex') == "1" ? 'Hombre' : 'Mujer'; ?>
 </td>
  </tr>

    <tr>
    <td><strong style="margin-right:10px;"><i class="fa fa-id-card" style="margin-right:10px;"> </i> R.U.T:  </strong>
     <?php echo $alm->__GET('rut') == "" ? 'S/I' : $alm->__GET('rut'); ?></td>
    </tr>


    <tr>
  <td><strong><i class="fa fa-birthday-cake" style="margin-right:10px;">  </i> Cumpleaños:</strong>
     <?php echo $alm->__GET('fec_nac') != "" ?  $alm->__GET('fec_nac') : "" ; ?></td>
  </tr>




    <tr>
    <td><strong><i class="fa fa-envelope" style="margin-right:10px;"> </i> Correo electrónico:</strong>
   <?php echo $alm->__GET('email'); ?></td>
    </tr>
    <td><strong><i class="fa fa-phone" style="margin-right:10px;"> </i> Teléfono:</strong>
  <?php echo $alm->__GET('phone') == "" ? 'S/I' : $alm->__GET('phone'); ?></td>
  </tr>
   
  </tbody>
</table>


<br>



</div>


<h2 style="text-align:center;">Datos empresariales</h2>
<br>

<div class="table-responsive" id="paddingnec">  
    <table class="table table-sm" id="table_font">
  <thead >
  </thead>
   
  <tbody>
<tr>
    <td><strong><i class="fa fa-building" style="margin-right:10px;">  </i> Departamento:</strong>
   <?php echo $alm->__GET('department')  == "" ? 'S/I' : $alm->__GET('department'); ?></td>
    </tr>

    <tr>
    <td><strong><i class="fa fa fa-black-tie" style="margin-right:10px;">  </i> Cargo:</strong>
      <?php echo $alm->__GET('cargo')  == "" ? 'S/I' : $alm->__GET('cargo'); ?></td>
    </tr>


    <tr>
    <td><strong><i class="fa fa-user-secret" style="margin-right:10px;"> </i> Tipo de usuario:</strong>
      <?php echo $alm->__GET('rol') == 1 ? 'Administrador' : 'Usuario'; ?></td>

    </tr>

    <tr>
    <td><strong><i class="fa fa-money" style="margin-right:10px;"> </i> Comisión por venta mensual:</strong>
      <?php echo $alm->__GET('commission'); ?> %</td>

    </tr>


    </tbody>
</table>
 </div>


 


</div>


<div class="row" style="margin-bottom: 60px;">
<p></p>
</div>


</div>
</div>

</div>




<!-- webside content -->



        


</body>





<?php
require_once 'template/footer.php';
?>





</html>