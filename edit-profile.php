<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>


<link rel="icon" href="images/favicon.png" type="image/x-icon">


<div  id="header">

<link rel="stylesheet" href="css/style.css">


<?php
require_once 'config.php';
require_once 'header.php';


if(isset($_POST["submit"])) {
    

    $alm->__SET('name', $_POST['name']);
    $alm->__SET('lastname', $_POST['lastname']);
    $alm->__SET('sex', $_POST['sex']);
    $alm->__SET('rut', $_POST['rut']);
    $alm->__SET('email', $_POST['email']);
    $alm->__SET('phone', $_POST['phone']);



if (trim($_POST['rol']) == "Administrador"){
    $rol_number = "1"; 
    $alm->__SET('rol', $rol_number);
} else {
    $rol_number = "2"; 
    $alm->__SET('rol', $rol_number);
}
    



    $alm->__SET('fec_nac', $_POST['fec_nac']);
    $alm->__SET('department', $_POST['department']);
    $alm->__SET('cargo', $_POST['cargo']);
    $alm->__SET('description', $_POST['description']);
    $alm->__SET('id', $_GET['activeuser']);

    $model->update($alm);

    echo '<script type="text/javascript">location.href = "edit-profile'.$session.'&updated=true";</script>';
    


    }



?>

</div>

<style>
li {
    width: 11.11%;
    max-height: 36px;
     }


     .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    border-top: 0px solid #ffffff !important;
}

    </style>


</head>


<body>



<div id="profile_cont" class="container" style="margin: 0px; padding: 0px; width: 100%;">
<div class="row">
  <div  id="sidebar_div" class="col-sm-3">
   
  <!-- including sidebar from templates-->
<?php require_once 'template/sidebar.php'; ?>




  </div>

  <div class="col-sm-9">
<!-- webpage content -->

<br>


<?php if(isset($_GET['updated'])){?>

<div class="alert alert-success" style="margin-left: 3%;
    margin-right: 3%;">
<strong><i class="fa fa-check fa-lg"></i>  Los datos se han actualizado satisfactoriamente</strong> 
</div>
<?php }?>



<div class="row">
<div class="card1 col-md-12" style=" background-color: #fff !important; padding:0px;">
<div class="crm-offer-title">
<h2 style="text-align:center;     margin-top: 0px;">Editar perfil de <?php echo $alm->__GET('name') == "" ? 'USUARIO' : $alm->__GET('name'); ?></h2>
</div>

<br>
<br>



<form action="edit-profile<?php echo $session;?>" method="post">


<div class="col-md-4" style="text-align:center;">
<strong>Imagen de contacto</strong>
<br>
<br>
<div id="img_profile_div" class="imgdiv">
  <?php if (!empty($alm->__GET('user_img'))) :?>
<img src="<?php echo $homeurl;?>images/<?php echo $alm->__GET('user_img'); ?>?<?php echo $alm->__GET('id'); ?>" id="img_profile" class="imgrounded" name="img_profile"  alt="Avatar">
    <?php else:?>
<img src="<?php echo $homeurl;?>images/default/default.png" class="imgrounded" id="img_profile"  alt="Avatar" >
    <?php endif; ?>
</div><br>
<div style="text-align:center;"   id="table_font" >
<a href="#"  data-toggle="modal" data-target="#modal_img">Editar imagen</a> | <a href="source/upload.php<?php echo $session;?>&delete=<?php echo $alm->__GET('user_img'); ?>">Quitar imagen</a>
</div>

<br><br>


</div>


<div class="col-md-8"     style="padding-bottom: 5px;">
<strong>Datos personales</strong>

<div class="form-group">
  <div class="col-md-12 inputGroupContainer" style="margin-top:15px; margin-bottom:10px;">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input   name="name" placeholder="Nombres" class="form-control" value="<?php echo $alm->__GET('name') == "" ? 'S/I' : $alm->__GET('name'); ?>" type="text" required>
  <input  name="lastname" value="<?php echo $alm->__GET('lastname') == "" ? 'S/I' : $alm->__GET('lastname'); ?>" placeholder="Apellidos" class="form-control"  type="text" required>
    </div>
  </div>
</div>

<!-- Text input-->


  <div class="form-group"> 
    <div class="col-md-12 selectContainer" style="margin-bottom:10px;">
    <div class="input-group">
        <span class="input-group-addon" style="width:39px;"><i class="fa fa-male fa-lg" aria-hidden="true"></i></span>
    <select name="sex" class="form-control selectpicker" required>
    <option value="">Seleccionar</option>
    <option value="1" <?php echo $alm->__GET('sex') == 1 ? 'selected' : ''; ?>>Hombre</option>
    <option value="2" <?php echo $alm->__GET('sex') == 2 ? 'selected' : ''; ?>>Mujer</option>
    </select>
  </div>
</div>
</div>
  


<div class="form-group">
  <div class="col-md-12 inputGroupContainer" style=" margin-bottom:10px;">
  <div class="input-group">
  <span class="input-group-addon">R.U.T</span>
  <input type="text" class="form-control" name="rut" value="<?php echo $alm->__GET('rut') == "" ? 'S/I' : $alm->__GET('rut'); ?>">
  </div>
  </div>
</div>


<div class="form-group">
  <div class="col-md-12 inputGroupContainer" style=" margin-bottom:10px;">
  <div class="input-group">
  <span class="input-group-addon">Departamento</span>
  <input type="text" class="form-control" name="department" value="<?php echo $alm->__GET('department') == "" ? 'S/I' : $alm->__GET('department'); ?>" required>  </div>
  </div>
</div>


<div class="form-group">
  <div class="col-md-12 inputGroupContainer" style=" margin-bottom:10px;">
  <div class="input-group">
  <span class="input-group-addon">Cargo</span>
  <input type="text" class="form-control" name="cargo" value="<?php echo $alm->__GET('cargo') == "" ? 'S/I' : $alm->__GET('cargo'); ?>" required>  </div>
</div>
</div>

<div class="form-group">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom:10px;">
  <div class="input-group">
  <span class="input-group-addon">Tipo de usuario</span>
  <input type="text" class="form-control" name="rol" value="<?php echo $alm->__GET('rol') == 1 ? 'Administrador' : 'Usuario'; ?>"  / readonly></div>
  </div>
  </div>


  <div class="form-group">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom:10px;">
  <div class="input-group">
  <span class="input-group-addon">e-mail</span>
  <input type="text" class="form-control" name="email" value="<?php echo $alm->__GET('email') == "" ? 'S/I' : $alm->__GET('email'); ?>" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" required></div>
  </div>
  </div>

  <div class="form-group">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom:10px;">
  <div class="input-group">
  <span class="input-group-addon">Teléfono</span>
  <input type="text" class="form-control" name="phone" value="<?php echo $alm->__GET('phone') == "" ? 'S/I' : $alm->__GET('phone'); ?>" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required></div>
  </div>
  </div>



  <div class="form-group">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom:10px;">
  <div class="input-group">
  <span class="input-group-addon">Fecha de nacimiento</span>
  <input type="date" class="form-control" name="fec_nac" value="<?php echo $alm->__GET('fec_nac') != "" ?  $alm->__GET('fec_nac') : "" ; ?>">  </div>
  </div>  
  </div>


  <div class="form-group">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom:10px;">
  <div class="input-group">
  <span class="input-group-addon">Comisión por venta mensual</span>
  <input type="text" class="form-control" name="rol" value="<?php echo $alm->__GET('commission'); ?> %"  / disabled></div>
  </div>
  </div>




<!-- Text input-->
<div class="form-group">
    <div class="col-md-12 inputGroupContainer" style="margin-top:10px; margin-bottom:10px">
   <strong > Escribe una breve descripción o nota: </strong>
 <br>
 <br>
      <textarea class="form-control t-area" name="description"  maxlength="150"><?php echo $alm->__GET('description'); ?></textarea>

  </div>
</div>

<button type="submit" name="submit" style="float:right;" class="btn btn-success"><i class="fa fa-check"></i>Actualizar</button>



<br><br>


</div><!--col-md-7 -->





</form>





<div class="row" style="margin-bottom: 60px;">
<p></p>
</div>





  <!-- webpage content-->
  </div>
</div>
</div>



<div class="modal fade" id="modal_img">
<div class="modal-dialog" id="modal_prodile">
    <div class="modal-content">
       <form action="source/upload.php<?php echo $session;?>" method="post" enctype="multipart/form-data">

<input type="text" name="sesion" style="display:none;" value="<?php echo $session; ?>"/>


<input type="text" name="imgprofileto" style="display:none"; value="<?php echo $alm->__GET('user_img'); ?>" />


      <div class="modal-header" style="background-color: #5596e6;    color: #fff;">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Seleccionar imagen:</h4>
            </div>
            <div class="modal-body" style="text-align:center;">
                <div id="messages"></div>
              <input type="file" class="form-control" name="fileToUpload" id="fileToUpload" required>
</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                   <button type="submit" class="btn btn-success" name="submit">Cargar imagen</button>
            </div>
        </form>
    </div> <!-- modal content -->
</div> <!-- modal dialog -->
</div> <!-- modal_img -->



</body>






<?php
require_once 'template/footer.php';
?>











</html>