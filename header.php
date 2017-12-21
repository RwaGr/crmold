<title><?php echo $title; ?></title>
  <meta charset="utf-8">
  <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0' >
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- <link rel="icon" href="<?php// echo $homeurl; ?>images/<?php// echo $favicon; ?>" type="image/x-icon">-->

<!-- font-awesome-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<!--font awesome-->

<!-- bs cdn -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<!-- bs cdn-->

<!-- charts-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<!-- charts-->

<!-- Jquery -->
<script src="http://code.jquery.com/jquery.js"></script>
<!-- Jquery -->

<!-- fonts by google  -->
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<!-- fonts by google -->


<!-- Getting the data to validate -->
<?php

date_default_timezone_set('America/Santiago');
setlocale(LC_TIME, 'es_ES', 'Spanish_Spain', 'Spanish');  
define("CHARSET", "iso-8859-1");

require_once 'config.php';
require_once 'function.php';
$alm = new pdv_var();
$model = new consulta();



if ((isset($_GET['user'])) || (isset($_GET['password'])) || (isset($_GET['data']))  || (isset($_GET['token'])) ) { //if4
    

} else { //if4

/*redirect a home si esta alguna session activa, setear variables*/
if (((isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]") != $homeurl) { //if1

if (!isset($_SESSION["session"])) { //if2
    echo '<script type="text/javascript">location.href = "'.$homeurl.'";</script>';
} else { //if2

    //check if the vars of the url and session are set
    if ((isset($_GET['activeuser'])) && (isset($_SESSION['key'])) && (isset($_GET['rol'])) ) { //if3

/*a partir de aqui accede en una sesión*/
$alm = $model->getdatabyid($_GET['activeuser']);

//$key1 = $_GET['key'];
$rol1 = $_GET['rol'];
$key1 = $_SESSION['key'] ;


if($alm->__GET('rol')==1){
$rol2 = "ADMIN";
} else {
$rol2 = "USER";
}

//CHECK THE KEY, ACTIVEUSER, and ROL
if (($key1 != $alm->__GET('key')) || ($rol1 != $rol2)) {
        //Redirect a home porque la key es diferente o el rol
        /*session_unset(); 
        session_destroy();      */
        echo '<script type="text/javascript">location.href = "'.$homeurl.'?token=notvalid&loc=1";</script>';   
    }
    

$session ="?activeuser=".$alm->__GET('id')."&rol=".$rol2."";

    } else { //if3

        // redirect a home porque no estan seteadas las variables principales
        /* session_unset(); 
		session_destroy(); */
        echo '<script type="text/javascript">location.href = "'.$homeurl.'?token=notvalid&loc=2";</script>';

} //if3

} //if2

} //if1

} //if4

//checking if there is any error


/*
if ((isset($_GET['user'])) || (isset($_GET['password'])) || (isset($_GET['data']))  || (isset($_GET['token'])) ) {

} else {
*/

 //Get data from the id
//if (((isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]") != $homeurl) {

//checking if the settings exist in the url
//   if ((isset($_GET['activeuser'])) && (isset($_GET['key'])) && (isset($_GET['rol'])) ) :
/*if ((isset($_GET['activeuser'])) && (isset($_SESSION['key'])) && (isset($_GET['rol'])) ) {

          $alm = $model->getdatabyid($_GET['activeuser']);
        
//$key1 = $_GET['key'];
$rol1 = $_GET['rol'];
$key1 = $_SESSION['key'] ;


if($alm->__GET('rol')==1){
$rol2 = "ADMIN";
} else {
$rol2 = "USER";
}

//CHECK THE KEY, ACTIVEUSER, and ROL
if (($key1 != $alm->__GET('key')) || ($rol1 != $rol2)){

		echo '<script type="text/javascript">location.href = "'.$homeurl.'?token=notvalid&loc=1";</script>';
      
}

    //settings url

    $session ="?activeuser=".$alm->__GET('id')."&rol=".$rol2."";


} else {
        
        echo '<script type="text/javascript">location.href = "'.$homeurl.'?token=notvalid&loc=2&key='.$_SESSION['key'].'";</script>';

}*/
        
//}

//}

?>

<!-- vars made input -->

<div style="display:none;">
<input type="text"  id="activeuser" name="activeuser" value="<?php echo $alm->__GET('name'); ?>"/>
<input type="text"  id="lastname" name="lastname" value="<?php echo $alm->__GET('lastname'); ?>"/>
<input type="text"  id="email" name="email" value="<?php echo $alm->__GET('email'); ?>"/>
<input type="text"  id="key" name="key" value="<?php echo $alm->__GET('key'); ?>"/>
<input type="text"  id="rol" name="rol" value="<?php echo $alm->__GET('rol') == 1 ? 'ADMIN' : 'USER'; ?>"/>
</div>


<?php
    $cadena = $alm->__GET('name'); 
$parte = explode(" ",$cadena); 

?>


<!-- main_NAV -->

<?php if(basename($_SERVER['PHP_SELF']) != "index.php") { ?>

<div  id="header">

<table id="logo_ciao">
<tr>
<td>
<div class="row"><a class="navbar-brand" href="<?php echo $homeurl."pages/home".$session;?>"><img src="<?php echo $homeurl;?>/images/<?php echo $logo;?>" alt="<?php echo $title;?>" id="logo"> </a>
</td>



<td id="column_title">


<p id="pdv_title">Plan de Ventas </p>
<p id="subtitle_crm">CRM</p>


</td>

</tr>
</table>

<div class="nav-768" >
<nav class="navbar navbar-default" id="main_nav">
  <div class="container-fluid">

  <div class="navbar-header">
  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar3">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
  </button>
  <a class="navbar-brand" id="collapse_logo" style="display:none;" href="<?php echo $homeurl."pages/home".$session;?>"><img src="<?php echo $homeurl;?>/images/<?php echo $logo;?>" alt="<?php echo $title;?>" id="logo_768">
        </a>
</div>


    <div id="navbar3" class="navbar-collapse collapse" >
    <ul class="nav navbar-nav" id="height768" style="text-align:center; width:100%; " >


   <style>
       @media screen and (min-width:100px) and (max-width:768px){
    #mynet{display:none;}
       }
    </style>



   





    <?php if(basename($_SERVER['PHP_SELF']) == "report.php") { ?>
               
        <!-- 768 -->
        <li class="active" style="float:right;" ><a id="text-a" href="<?php echo $homeurl; ?>pages/report<?php echo $session; ?>"><i class="fa fa-file-text-o" aria-hidden="true"></i><br>Reportes</a></li>

        <!-- 768 -->

                <!-- mas de 768 -->
 <!--  <li id="mynet"  class="active" style="max-height: 60px; float:right;">
        <div class="dropdown"  id="text-a"  style="width:100%; height:60px !important;     background-image: -webkit-linear-gradient(top,#dedede 0,#dfdfdf 100%);">
        <a id="text-a" class="active" href="<?php echo $homeurl; ?>pages/report<?php echo $session; ?>"><i class="fa fa-file-text-o" aria-hidden="true" style="padding-bottom:5px; padding-top:14px;"></i><br>Reportes<i class="fa fa-caret-down" aria-hidden="true"></i></a>
        <div class="dropdown-content" style="text-align:left; min-width:130px; right: 0px; top: 61px;">
        <a id="text-a" style=" max-width:130px; "  href="#">Ventas</a>
        <a id="text-a" style=" max-width:130px; "  href="#">Cotizaciones</a>
        <a id="text-a" style=" max-width:130px; "  href="#">Campañas</a>
        <a id="text-a" style=" max-width:130px; "  href="#">Prospectos</a>
        <a id="text-a" style=" max-width:130px; "  href="#">Contactos</a>
        <a id="text-a" style=" max-width:130px; "  href="#">Empresas</a>

  </div>
  </div>
        </li>-->
      
                <!-- mas de 768 -->


        <?php }else{ ?>     
                <!-- 768 -->
        <li style=" float:right;" ><a id="text-a" href="<?php echo $homeurl; ?>pages/report<?php echo $session; ?>"><i class="fa fa-file-text-o" aria-hidden="true"></i><br>Reportes</a></li>
                <!-- 768 -->

                <!-- mas de 768 -->
              <!--  <li id="mynet" style="max-height: 60px; float:right;">
        <div class="dropdown"  id="text-a"  style="height:60px !important;">
        <a id="text-a"  href="<?php// echo $homeurl; ?>pages/report<?php//echo $session; ?>"><i class="fa fa-file-text-o" aria-hidden="true" style="padding-bottom:5px; padding-top:14px;"></i><br>Reportes<i class="fa fa-caret-down" aria-hidden="true"></i>
</a>
        <div class="dropdown-content"  style=" text-align:left; min-width:130px; right: -35px; top: 60px;">
        <a id="text-a" style=" max-width:130px; "  href="#">Ventas</a>
        <a id="text-a" style=" max-width:130px; "  href="#">Cotizaciones</a>
        <a id="text-a" style=" max-width:130px; "  href="#">Campañas</a>
        <a id="text-a" style=" max-width:130px; "  href="#">Prospectos</a>
        <a id="text-a" style=" max-width:130px; "  href="#">Contactos</a>
        <a id="text-a" style=" max-width:130px; "  href="#">Empresas</a>
  </div>
  </div>
        </li>-->
   <!-- mas de 768 -->

                <?php } ?>

    


 
            
                <?php if(basename($_SERVER['PHP_SELF']) == "campaigns.php") { ?>
                <li class="active" style="float:right;" ><a id="text-a" href="<?php echo $homeurl; ?>pages/campaigns<?php echo $session; ?>"><i class="fa fa-cart-plus" aria-hidden="true"></i><br>Campañas</a></li>
    <?php }else{ ?>
                <li style="float:right;"><a id="text-a" href="<?php echo $homeurl; ?>pages/campaigns<?php echo $session; ?>"><i class="fa fa-cart-plus" aria-hidden="true"></i><br>Campañas</a></li>
    <?php } ?>



    <?php if(basename($_SERVER['PHP_SELF']) == "sales.php") { ?>
                <li style="float:right;" class="active" ><a id="text-a" href="<?php echo $homeurl; ?>pages/sales<?php echo $session; ?>"><i class="fa fa-handshake-o" aria-hidden="true"></i><br>Ventas</a></li>
    <?php }else{ ?>
                <li style="float:right;"><a id="text-a" href="<?php echo $homeurl; ?>pages/sales<?php echo $session; ?>"><i class="fa fa-handshake-o" aria-hidden="true"></i><br>Ventas</a></li>
    <?php } ?>

                


    <?php if(basename($_SERVER['PHP_SELF']) == "opportunities.php") { ?>   
               
        <!-- 768 -->
        <li class="active"  style="float:right;" ><a id="text-a" href="<?php echo $homeurl; ?>pages/opportunities<?php echo $session; ?>"><i class="fa fa-search" aria-hidden="true"></i><br>Oportunidades</a></li>
   <!-- 768 -->


   
                <!-- mas de 768 -->
  <!-- <li id="mynet" class="active" style="max-height: 60px; float:right;">
        <div class="dropdown"  id="text-a"  style="width:100%; height:60px !important;     background-image: -webkit-linear-gradient(top,#dedede 0,#dfdfdf 100%);">
        <a id="text-a" class="active" href="<?php// echo $homeurl; ?>pages/opportunities<?php// echo $session; ?>"><i class="fa fa-search" aria-hidden="true" style="padding-bottom:5px; padding-top:14px;"></i><br>Oportunidades<i class="fa fa-caret-down" aria-hidden="true"></i></a>
        <div class="dropdown-content" style="text-align:left; min-width:130px; right: 0px; top: 61px;">
    <a id="text-a" style=" max-width:130px; "  href="#">Prospectos</a>
    <a id="text-a" style=" max-width:130px; "  href="#">Cotizaciones</a>
 

  </div>
  </div>
        </li>-->
      
                <!-- mas de 768 -->


        <?php }else{ ?>     
                <!-- 768 -->
        <li style="float:right;"><a id="text-a" href="<?php echo $homeurl; ?>pages/opportunities<?php echo $session; ?>"><i class="fa fa-search" aria-hidden="true"></i><br>Oportunidades</a></li>
                <!-- 768 -->

                <!-- mas de 768 -->
          <!--      <li  id="mynet" style="max-height: 60px; float:right;">
        <div class="dropdown"  id="text-a"  style="height:60px !important;">
        <a id="text-a"  href="<?php// echo $homeurl; ?>pages/opportunities<?php //echo $session; ?>"><i class="fa fa-search" aria-hidden="true" style="padding-bottom:5px; padding-top:14px;"></i><br>Oportunidades <i class="fa fa-caret-down" aria-hidden="true"></i>
</a>
        <div class="dropdown-content"  style="text-align:left; min-width:130px; right: -10px; top: 60px;">
        <a id="text-a" style=" max-width:130px; "  href="#">Prospectos</a>
        <a id="text-a" style=" max-width:130px; "  href="#">Cotizaciones</a>
  </div>
  </div>
        </li>-->
   <!-- mas de 768 -->

                <?php } ?>

<?php if(basename($_SERVER['PHP_SELF']) == "products.php") { ?>
      <li style="float:right;" class="active"><a id="text-a" href="<?php echo $homeurl;?>pages/products<?php echo $session; ?>"><i class="fa fa-cube" aria-hidden="true"></i><br>Productos</a></li>
    <?php }else{ ?>
        <li style="float:right;"><a id="text-a" href="<?php echo $homeurl;?>pages/products<?php echo $session; ?>"><i class="fa fa-cube" aria-hidden="true"></i><br>Productos</a></li>
    <?php } ?>
    

                <?php if(basename($_SERVER['PHP_SELF']) == "company.php") { ?>
        <li style="float:right;" class="active" ><a id="text-a" href="<?php echo $homeurl; ?>pages/company<?php echo $session; ?>"><i class="fa fa-building-o" aria-hidden="true"></i><br>Empresas</a></li>
    <?php }else{ ?>
        <li style="float:right;"><a id="text-a" href="<?php echo $homeurl; ?>pages/company<?php echo $session; ?>"><i class="fa fa-building-o" aria-hidden="true"></i><br>Empresas</a></li>
    <?php } ?>

    <?php if(basename($_SERVER['PHP_SELF']) == "contacts.php") { ?>
        <li style="float:right;" class="active" ><a id="text-a" href="<?php echo $homeurl; ?>pages/contacts<?php echo $session; ?>"><i class="fa fa-address-book-o" aria-hidden="true"></i> <br>Contactos</a></li>
    <?php }else{ ?>
        <li style="float:right;"><a id="text-a" href="<?php echo $homeurl; ?>pages/contacts<?php echo $session; ?>"><i class="fa fa-address-book-o" aria-hidden="true"></i> <br>Contactos</a></li>
    <?php } ?>



                <?php if(basename($_SERVER['PHP_SELF']) == "local.php") { ?>

        <li class="active" style=" float:right;" ><a id="text-a" href="<?php echo $homeurl;?>pages/local<?php echo $session; ?>"><i class="fa fa-sitemap" aria-hidden="true"></i><br>Mi red </a> </li>

  <!-- <li id="mynet" class="active" style="max-height: 60px; float:right;">
        <div class="dropdown"  id="text-a"  style="width:100%; height:60px !important;     background-image: -webkit-linear-gradient(top,#dedede 0,#dfdfdf 100%);">
        <a id="text-a" class="active" href="<?php// echo $homeurl; ?>pages/local<?php// echo $session; ?>"><i class="fa fa-sitemap" aria-hidden="true" style="padding-bottom:5px; padding-top:14px;"></i><br>Mi red <i class="fa fa-caret-down" aria-hidden="true"></i></a>
        <div class="dropdown-content" style="text-align:left; min-width:130px; right: 0px; top: 61px;">
    <a id="text-a" style=" max-width:130px; "  href="#">Tareas</a>
    <a id="text-a" style=" max-width:130px; "  href="#">Alertas</a>
    <a id="text-a" style=" max-width:130px; "  href="#">Departamentos</a>
  </div>
  </div>
        </li>-->
      

    <?php } else { ?>


        <li style="float:right;" ><a id="text-a" href="<?php echo $homeurl;?>pages/local<?php echo $session; ?>"><i class="fa fa-sitemap" aria-hidden="true"></i><br>Mi red  </a></li>


   <!--     <li id="mynet" style="max-height: 60px;  float:right;">
        <div class="dropdown"  id="text-a"  style="height:60px !important;">
        <a id="text-a"  href="<?php// echo $homeurl; ?>pages/local<?php // echo $session; ?>"><i class="fa fa-sitemap" aria-hidden="true" style="padding-bottom:5px; padding-top:14px;"></i><br>Mi red <i class="fa fa-caret-down" aria-hidden="true"></i>
</a>
        <div class="dropdown-content"  style="text-align:left; min-width:130px; right: -40px; top: 60px;">
        <a id="text-a" style=" max-width:130px; "  href="#">Tareas</a>
        <a id="text-a" style=" max-width:130px; "  href="#">Alertas</a>
        <a id="text-a" style=" max-width:130px; "  href="#">Departamentos</a>
  </div>
  </div>
        </li>
       -->

    <?php } ?>





    <?php if(basename($_SERVER['PHP_SELF']) == "home.php") { ?>
      <li style="float:right;" class="active"><a id="text-a" href="<?php echo $homeurl;?>pages/home<?php echo $session; ?>"><i class="fa fa-home" aria-hidden="true"></i><br>Principal</a></li>
    <?php }else{ ?>
        <li style="float:right;"><a id="text-a" href="<?php echo $homeurl;?>pages/home<?php echo $session; ?>"><i class="fa fa-home" aria-hidden="true"></i><br>Principal</a></li>
    <?php } ?>




<!-- dropdown profile > 768 -->

<div style="display:none;" class="dropdown" id="drop_profile" style="padding-top: 10px; text-align:center;">



<div id="profileimg_nav">
    <?php if (!empty($alm->__GET('user_img'))) :?>
<img src="<?php echo $homeurl;?>images/<?php echo $alm->__GET('user_img'); ?>?<?php echo $alm->__GET('id'); ?>" id="profileimg_img">
    <?php else:?>
<img src="<?php echo $homeurl;?>images/default/default.png" id="profileimg_img">
    <?php endif; ?>
</div>




    <a id="text-a" href="<?php echo $homeurl;?>profile<?php echo $session; ?>"><button class="btn btn-secondary" id="text-a" ><?php echo $parte[0]; ?> </button></a>
  <button class="btn btn-secondary dropdown-toggle dropdown-toggle-split"><span class="caret"></span></button>
  <div class="dropdown-content" style="text-align:left;">
    <a id="text-a"  href="<?php echo $homeurl;?>profile<?php echo $session; ?>"><i class="fa fa-user" style="margin-right:5px;" aria-hidden="true"></i>      Ver perfil</a>
    <a id="text-a"  href="<?php echo $homeurl;?>source/logout<?php echo $session;?>"><i class="fa fa-power-off" style="margin-right:5px;" aria-hidden="true"></i>      Salir</a>
  </div>

</div>



<!-- button profile media < 768 -->

<li style="float:right; display:none;" id="profile768" ><a href="<?php echo $homeurl; ?>profile<?php echo $session; ?>">
<?php if (!empty($alm->__GET('user_img'))) :?>
<img src="<?php echo $homeurl;?>images/<?php echo $alm->__GET('user_img'); ?>?<?php echo $alm->__GET('id'); ?>" style="    max-width: 20px;  max-height: 20px;  border-radius: 20px; height: 100% !important;">
    <?php else:?>
<img src="<?php echo $homeurl;?>images/default/default.png" style="width: 20px; border-radius: 30px; ">
    <?php endif; ?>




<br> <?php echo $parte[0];?></a></li> 
    


    </ul>
</div>

  </div>
</nav>
</div>
</div>

<?php } ?>

<!-- main_NAV -->



