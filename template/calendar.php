<?php session_start(); ?>
<!DOCTYPE html>


<html>
<head>

<link rel="icon" href="../../<?php echo $_SESSION['install_page'];?>/images/favicon.png" type="image/x-icon">

<div  id="header">

<link rel="stylesheet" href="../../<?php echo $_SESSION['install_page'];?>/css/style.css">



<!-- chosen import-->
<link rel="stylesheet" href="../../<?php echo $_SESSION['install_page'];?>/source/chosen/docsupport/prism.css">
<link rel="stylesheet" href="../../<?php echo $_SESSION['install_page'];?>/source/chosen/chosen.css">
<!--chosen import -->



<?php
require_once '../../'.$_SESSION['install_page'].'/config.php';
require_once '../../'.$_SESSION['install_page'].'/header.php';
?>

</div>


<?php 

/*add event starts*/

if(isset($_POST['addeventbtn'])){

//if(!empty($_POST['tasktodo1']) && !empty($_POST['colors']) && !empty($_POST['taskasunto1'])  ){
    
   // echo '<script>alert("Tipo:'.$_POST['tasktodo1'].'----Prioridad:'.$_POST['colors'].'----Asunto:'.$_POST['taskasunto1'].'-----Fecha limite:'.$_POST['date_limitasunto1'].'-------Descripción:'.$_POST['taskdescription1'].'");</script>';
   
    /*Actividad personalizada*/
        if(isset($_POST['activitycustom']) && !empty($_POST['activitycustom'])){
        $customvar = $_POST['activitycustom'];
       // echo '<script>alert("'.$customvar.'");</script>'; 
         }else{ 
        $customvar = "Sin definir";  
      //  echo '<script>alert("'.$customvar.'");</script>'; 
         }

    /*Evento privado*/
        if(isset($_POST['isprivate'])){
        $privatevar = $_POST['isprivate'];
       //  echo '<script>alert("'.$privatevar.'");</script>';
        }else{
            $privatevar = "0";
           // echo '<script>alert("'.$privatevar.'");</script>';    
         }

         $alm->__SET('taskname', $_POST['taskasunto1']);
         $alm->__SET('taskdescrip', $_POST['taskdescription1']);
         $alm->__SET('taskdate',  date("Y-m-d", time()));
         $alm->__SET('tasklimitdate',   $_POST['date_limitasunto1']);
         $alm->__SET('tasktype', $_POST['tasktodo1']);
         $alm->__SET('taskasocprospect',  $_GET['activeuser']);
         $alm->__SET('isprivate',   $privatevar);
         $alm->__SET('customtask', $customvar);
         $alm->__SET('priority',  $_POST['colors']);
     
         $model->addtasksfromprospect($alm);


/*Get the event id */
         $almcuotes = $model->geteventid($_POST['date_limitasunto1']);
         $taskid123 = $almcuotes->__GET('taskid');

    /*invitados*/
    if(isset($_POST['inputToarray'])){
        $var = $_POST['inputToarray'];
        foreach ($var as $var1){ 


           $alm->__SET('id_user',   trim($var1));
           $alm->__SET('id_task', trim($taskid123));
           $alm->__SET('invitationdate',  $_POST['date_limitasunto1']);
                        
           $model->addguestsfromanevent($alm);            

     //       echo '<script>alert("'.$var1.'");</script>';  
        }
    }




//}
  

}

/*add event ends*/


?>


<!--css of the calendar-->

<style>


    option.red {color:#ff1100;}
    option.blue { color:#0aceff;}
    option.green { color:#00b307;}



* {box-sizing: border-box;}
ul {list-style-type: none;}
body {font-family: Verdana, sans-serif;}

#month {
    padding: 20px 25px;
    width: 100%;
    background: #f76b40;;
    text-align: center;

}

#month ul {
    margin: 0;
    padding: 0;
}

#month ul li {
    color: white;
    font-size: 20px;
    text-transform: uppercase;
    letter-spacing: 3px;
}

#month .prev {
    float: left;
    padding-top: 0px;
    cursor:pointer;
}

#month .next {
    float: right;
    padding-top: 0px;
    cursor:pointer;
}

#month .next:hover {
    color: #ff4106;
}

#month .prev:hover {
    color: #ff4106;
}


#weekdays {
    margin: 0;
    padding: 15px 0;
    background-color: #ddd;

}

#weekdays li {
    display: inline-block;
    width: 13.6%;
    min-width: 110px;
    color: #666;
    text-align: center;
}

#days {
    padding: 10px;
    background: #fff;
    margin: 0;

}

#days li {
    list-style-type: none;
    display: inline-block;
    width: 13.6%;
    min-width: 130px;
    text-align: right;
    margin-bottom: 5px;
    font-size: 12px;
    color: #777;
    height: 130px;
    border: 2px solid;
    padding: 5px;
    max-height: 130px !important;

}

#days li:hover {

    background-color: #ff9e80;
    color:#fff;
}



#days li .active {
    padding: 5px;
    background: #ff9e80;
    color: white !important
}

#maincalendar{
    min-width:955px;
  /*  max-width: 1000px;*/
 
    
}

.panel-body
{
    background-color: #FFF;
    overflow-x: scroll;
   /* max-width: 1000px;*/
    height:100%;

}



</style>


<!--css of the calendar-->


</head>


<body>


<div id="profile_cont" class="container" style="margin: 0px; padding: 0px; width: 100%;">
<div class="row">
  <div  id="sidebar_div" class="col-sm-3">
   
  <!-- including sidebar from templates-->
<?php require_once '../../'.$install_page.'/template/sidebar.php'; ?>

</div>
  <div class="col-sm-9" id="colsm9cal">

<!-- CONTENIDO A PARTIR DE AQUI hacia abajo-->
<div class="row" style="padding:10px;" id="rowofcal">
        <div class="col-sm-12" id="marginmas768">
            <div class="tab-content">

<br>

 


          <!-- comienza 2do tab hacia abajo -->
            <div class="tab-pane fade in active" id="viewall">
            
<!-- calendar begins down-->







<form action="" method="post" id="formcalendar">
<div id="primarydiv">


<?php
/*CALENDAR NEXT_PREV starts down*/
if (isset($_GET['inputaction'])){
    if ($_GET['inputaction']=="next"){


        $fecha = $_GET['inputcontrol']."-".date('01');
        $nuevafecha = strtotime ('+1 months' , strtotime ($fecha));

    }elseif ($_GET['inputaction']=="prev"){
        $fecha = $_GET['inputcontrol']."-".date('01');
        $nuevafecha = strtotime ('-1 months' , strtotime ($fecha));
    }
} else {
    $fecha = date('Y-m-01');
    $nuevafecha = strtotime ('+0 months' , strtotime ($fecha));
}
$nuevafecha = date ( 'd/m/Y' , $nuevafecha );
$date = DateTime::createFromFormat("d/m/Y", $nuevafecha);
	$week = 1;
	for($i=1;$i<=date('t',$date->getTimestamp());$i++) {
//gets the day of the week that starts
		$day_week = date('N', strtotime(date("Y-m",$date->getTimestamp()).'-'.$i));
	$calendar[$week][$day_week] = $i;
		if ($day_week == 7) { $week++; };
    }
 
 /*CALENDAR NEXT_PREV ends up*/
?>


<div class="panel-body" id="panelbod">

<div id="maincalendar">
<div class="month" id="month">      
  <ul>
            <li class="prev" id="prev" onclick="prevmonth();">&#10094;</li>
            <li class="next" id="next" onclick="nextmonth();">&#10095;</li>
  <span id="divcaltitle">


    <li style="    max-height: 100%; width: 100%;" id="liidcal">
    <?php echo utf8_encode(strtoupper(strftime("%B",$date->getTimestamp())));?>, <?php echo date("Y",$date->getTimestamp());?> 
    </li>

    </span>
  </ul>
</div>






<ul class="weekdays" id="weekdays">
  <li>Lunes</li>
  <li>Martes</li>
  <li>Miercoles</li>
  <li>Jueves</li>
  <li>Viernes</li>
  <li>Sabado</li>
  <li>Domingo</li>
</ul>

<ul class="days" id="days">  

<?php foreach ($calendar as $days) : ?>

<?php for ($i=1;$i<=7;$i++) : ?>

<?php if (isset($days[$i])) { ?>

    <?php
if($days[$i] < 10){
$fecha1 = date("Y-m",$date->getTimestamp())."-0".$days[$i];
}else{
$fecha1 = date("Y-m",$date->getTimestamp())."-".$days[$i]; 
}
$fecha2 = date('Y-m-d', time());

?>


<?php if ((date('d', time())==$days[$i]) && (date("Y-m",$date->getTimestamp())==date('Y-m', time()))) { ?>
    
<li > 
<?php if(($fecha1) >= ($fecha2)) {?>
<a href="##" style="float: left;" data-toggle="modal" data-target="#addevent<?php echo date("Y-m",$date->getTimestamp())."-".$days[$i];?>"> <i class="fa fa-plus fa-lg"></i> </a>
<?php } ?>
 <span  class="active">  <?php echo $days[$i]; ?> <span > 
 <br>


 <?php $controlevents = 0;?>

 <?php foreach($model->gettasksforthecalendar(date("Y-m",$date->getTimestamp())."-".$days[$i]) as $rprospects2): ?>
 
 <?php if (!empty(trim($rprospects2->__GET('taskid')))) { //if1 ?>

    <?php if ($controlevents < 3) { //if1 ?>

<?php if($rprospects2->__GET('priority')=="1") { ?>
    <div id="eventon" style="float: right;  background-color: #00b307; margin-top: 5px; padding:2px; width: 100%; text-align: left; height: 20px; font-size:10px; cursor:pointer;">
<?php } elseif($rprospects2->__GET('priority')=="2") { ?>
    <div id="eventon" style="float: right;  background-color: #0aceff; margin-top: 5px; padding:2px; width: 100%; text-align: left; height: 20px; font-size:10px; cursor:pointer;">
<?php } elseif($rprospects2->__GET('priority')=="3") { ?>
    <div id="eventon" style="float: right;  background-color: #ff1100; margin-top: 5px; padding:2px; width: 100%; text-align: left; height: 20px; font-size:10px; cursor:pointer;">
<?php } else { ?>
    <div id="eventon" style="float: right;  background-color: #e4d01d; margin-top: 5px; padding:2px; width: 100%; text-align: left; height: 20px; font-size:10px; cursor:pointer;">
<?php } ?>
<a data-toggle="tooltip" title="Evento: <?php echo $rprospects2->__GET('taskname');?>" style="color:#fff;"><?php echo $rprospects2->__GET('taskid');?>-<?php echo mb_substr($rprospects2->__GET('taskname'),0,10); ?>.. </a>
<div style="    float: right !important;margin-right: 2px; font-size: 11px;">
<a class="acalend" data-toggle="tooltip" title="Ver evento" style="margin-right:2px;"><i class="fa fa-eye" aria-hidden="true"></i></a>
<a class="acalend"><i class="fa fa-window-close" aria-hidden="true" data-toggle="tooltip" title="Eliminar evento"></i></a>
</div>
</div> <!--eventon -->


<?php $controlevents++;?>

    <?php } else { //if2

$cantofexc++;

    }//if2 ?> 

 <?php } //if1 ?> 

<?php endforeach;?>
 

<!-- tareas de prospectos -->
<?php foreach($model->gettasksfromprospect(date("Y-m",$date->getTimestamp())."-".$days[$i]) as $rprospects55): ?>       
    
<?php if (!empty(trim($rprospects55->__GET('taskid')))) { //if1 ?>    
<?php if ($controlevents < 3) { //if2 ?>

    <div id="eventon" style="float: right;  background-color: #e4d01d; margin-top: 5px; padding:2px; width: 100%; text-align: left; height: 20px; font-size:10px; cursor:pointer;" data-toggle="tooltip" title="<?php echo $rprospects55->__GET('tasktype');?>: <?php echo $rprospects55->__GET('taskname');?>">
    <a  style="color:#fff;">Prospecto:<?php echo mb_substr($rprospects55->__GET('namecontact')." ".$rprospects55->__GET('lastnamecontact'),0,8); ?>..</a>
    <div style="    float: right !important;margin-right: 2px; font-size: 11px;">
<a class="acalend" data-toggle="tooltip" title="Recordatorio" style="margin-right:2px;"><i class="fa fa-clock-o" aria-hidden="true"></i></a>
</div>
 </div> <!--eventon -->

 <?php $controlevents++;?>

    <?php } else { //if2

$cantofexc++;

    }//if2 ?> 
<?php } //if1 ?> 

<?php endforeach;?>


<!-- get task where the user is guest-->
<?php foreach($model->getgueststasks(date("Y-m",$date->getTimestamp())."-".$days[$i]) as $rcalendar1): ?>
 
<?php if (!empty(trim($rcalendar1->__GET('taskid')))) { //if1 ?>    
<?php if ($controlevents < 3) { //if2 ?>

<?php if($rcalendar1->__GET('priority')=="1") { ?>
    <div id="eventon" style="float: right;  background-color: #00b307; margin-top: 5px; padding:2px; width: 100%; text-align: left; height: 20px; font-size:10px; cursor:pointer;">
<?php } elseif($rcalendar1->__GET('priority')=="2") { ?>
    <div id="eventon" style="float: right;  background-color: #0aceff; margin-top: 5px; padding:2px; width: 100%; text-align: left; height: 20px; font-size:10px; cursor:pointer;">
<?php } elseif($rcalendar1->__GET('priority')=="3") { ?>
    <div id="eventon" style="float: right;  background-color: #ff1100; margin-top: 5px; padding:2px; width: 100%; text-align: left; height: 20px; font-size:10px; cursor:pointer;">
<?php } else { ?>
    <div id="eventon" style="float: right;  background-color: #e4d01d; margin-top: 5px; padding:2px; width: 100%; text-align: left; height: 20px; font-size:10px; cursor:pointer;">
<?php } ?>
<a data-toggle="tooltip" title="Evento: <?php echo $rcalendar1->__GET('taskname');?>" style="color:#fff;"><?php echo $rcalendar1->__GET('taskid');?>-<?php echo mb_substr($rcalendar1->__GET('taskname'),0,10); ?>.. </a>
<div style="    float: right !important;margin-right: 2px; font-size: 11px;">
<a class="acalend" data-toggle="tooltip" title="Ver evento" style="margin-right:2px;"><i class="fa fa-eye" aria-hidden="true"></i></a>
<a class="acalend"><i class="fa fa-window-close" aria-hidden="true" data-toggle="tooltip" title="Eliminar evento"></i></a>
</div>
</div> <!--eventon -->

<?php $controlevents++;?>
    <?php } else { //if2

$cantofexc++;

    }//if2 ?> 
<?php } //if1 ?> 

<?php endforeach;?>


<!--cumpleaños-->         
<?php foreach($model->selectall() as $r): ?>
  


<?php
/*Comparar fecha de str a date*/
$date1 = new DateTime($r->__GET('fec_nac'));
$date2 = new DateTime("0000-00-00");

if ($date1->format('Y-m-d') != $date2->format('Y-m-d')) { //if2 ?> 

<?php
/*Comparar fecha de cumpleaaños con fecha actual*/
$date3 = new DateTime(date("Y",$date->getTimestamp())."-".$date1->format('m-d'));
$date4 = new DateTime(date("Y-m",$date->getTimestamp())."-".$days[$i]);
if ($date3->format('Y-m-d') == $date4->format('Y-m-d')) { //if1
    
 if ($controlevents < 3) { //if3 

/*Calculamos edad*/
$difference = $date3->diff($date1);
$age = $difference->y;
?> 

<div id="eventon" style="float: right;  background-color: #ff8761; margin-top: 5px; padding:2px; width: 100%; text-align: left; height: 20px; font-size:11px; cursor:pointer;" data-toggle="tooltip" title="Cumpleaños Nro. <?php echo $age;?> de <?php echo $r->__GET('name'); echo " "; echo $r->__GET('lastname');?>">
<a   style="color:#fff; padding-left:3px;"></i><?php echo mb_substr($r->__GET('name'),0,15); ?>.. </a>
<div style="    float: right !important;margin-right: 2px; font-size: 11px;">
<a class="acalend" style="margin-right:2px;"><i style="margin-left:3px; margin-right: 2px;" class="fa fa-birthday-cake" aria-hidden="true"></i></a>
</div>
</div> <!--eventon -->

<?php $controlevents++;?>
<?php } else { //if3

$cantofexc++;

    }//if3 ?> 

<?php } //if1 ?>
<?php } //if2 ?>





<?php endforeach;?>


<!--cumpleaños contactos-->
<?php foreach($model->getcontacts() as $r): ?>

<?php
/*Comparar fecha de str a date*/
$date1 = new DateTime($r->__GET('birthdaycontact'));
$date2 = new DateTime("0000-00-00");

if ($date1->format('Y-m-d') != $date2->format('Y-m-d')) { //if2 ?> 

<?php
/*Comparar fecha de cumpleaaños con fecha actual*/
$date3 = new DateTime(date("Y",$date->getTimestamp())."-".$date1->format('m-d'));
$date4 = new DateTime(date("Y-m",$date->getTimestamp())."-".$days[$i]);
if ($date3->format('Y-m-d') == $date4->format('Y-m-d')) { //if1 

    if ($controlevents < 3) { //if3 

/*Calculamos edad*/
$difference = $date3->diff($date1);
$age = $difference->y;
?> 

<div id="eventon" style="float: right;     overflow: hidden;  background-color: #9C27B0; margin-top: 5px; padding:2px; width: 100%; text-align: left; height: 20px; font-size:11px; cursor:pointer;" data-toggle="tooltip" title="Cumpleaños Nro. <?php echo $age;?> de <?php echo $r->__GET('namecontact'); echo " "; echo $r->__GET('lastnamecontact');?>">
<a   style="color:#fff; padding-left:3px; min-width:130px;"></i><?php echo mb_substr($r->__GET('companycontact'),0,12); ?>..</a>
<div style="    float: right !important;margin-right: 2px; font-size: 11px;">
<a class="acalend" style="margin-right:2px;"><i style="margin-left:3px; margin-right: 2px;" class="fa fa-birthday-cake" aria-hidden="true"></i></a>
</div>
</div> <!--eventon -->


<?php $controlevents++;?>
<?php } else { //if3

$cantofexc++;

    }//if3 ?>  

<?php } //if1 ?>
<?php } //if2 ?>
<?php endforeach;?>

<!--resto de los eventos-->
<?php if ($cantofexc != 0){ ?>
<div id="eventon" style="float: right;      border: 1px solid;   overflow: hidden;  background-color: #fff; margin-top: 5px; padding:2px; width: 100%; text-align: center;; height: 20px; font-size:11px; cursor:pointer;" data-toggle="tooltip" title="">
<a   style="color:#000; padding-left:3px; min-width:130px;"></i><?php echo $cantofexc; ?> evento(s) más</a>
<div style="    float: right !important;margin-right: 2px; font-size: 11px;">
<a  style="margin-right:2px;"><i style="margin-left:3px; margin-right: 2px;" class="fa fa-eye" aria-hidden="true"></i></a>
</div>
</div> <!--eventon -->
<?php } ?>


 </li>



<?php } else { ?>

<li > 
<?php if(($fecha1) >= ($fecha2)) {?>
<a href="##" style="float: left;" data-toggle="modal" data-target="#addevent<?php echo date("Y-m",$date->getTimestamp())."-".$days[$i];?>"> <i class="fa fa-plus fa-lg"></i> </a>
<?php } ?>
 <span >  <?php echo $days[$i]; ?> <span > 

<?php $controlevents = 0;
$cantofexc = 0;
?>

 <?php foreach($model->gettasksforthecalendar(date("Y-m",$date->getTimestamp())."-".$days[$i]) as $rprospects2): ?>
 
 <?php if (!empty(trim($rprospects2->__GET('taskid')))) { //if1 ?>

    <?php if ($controlevents < 3) { //if1 ?>

<?php if($rprospects2->__GET('priority')=="1") { ?>
    <div id="eventon" style="float: right;  background-color: #00b307; margin-top: 5px; padding:2px; width: 100%; text-align: left; height: 20px; font-size:10px; cursor:pointer;">
<?php } elseif($rprospects2->__GET('priority')=="2") { ?>
    <div id="eventon" style="float: right;  background-color: #0aceff; margin-top: 5px; padding:2px; width: 100%; text-align: left; height: 20px; font-size:10px; cursor:pointer;">
<?php } elseif($rprospects2->__GET('priority')=="3") { ?>
    <div id="eventon" style="float: right;  background-color: #ff1100; margin-top: 5px; padding:2px; width: 100%; text-align: left; height: 20px; font-size:10px; cursor:pointer;">
<?php } else { ?>
    <div id="eventon" style="float: right;  background-color: #e4d01d; margin-top: 5px; padding:2px; width: 100%; text-align: left; height: 20px; font-size:10px; cursor:pointer;">
<?php } ?>
<a data-toggle="tooltip" title="Evento: <?php echo $rprospects2->__GET('taskname');?>" style="color:#fff;"><?php echo $rprospects2->__GET('taskid');?>-<?php echo mb_substr($rprospects2->__GET('taskname'),0,10); ?>.. </a>
<div style="    float: right !important;margin-right: 2px; font-size: 11px;">
<a class="acalend" data-toggle="tooltip" title="Ver evento" style="margin-right:2px;"><i class="fa fa-eye" aria-hidden="true"></i></a>
<a class="acalend"><i class="fa fa-window-close" aria-hidden="true" data-toggle="tooltip" title="Eliminar evento"></i></a>
</div>
</div> <!--eventon -->


<?php $controlevents++;?>

    <?php } else { //if2

$cantofexc++;

    }//if2 ?> 

 <?php } //if1 ?> 

<?php endforeach;?>
 

<!-- tareas de prospectos -->
<?php foreach($model->gettasksfromprospect(date("Y-m",$date->getTimestamp())."-".$days[$i]) as $rprospects55): ?>       
    
<?php if (!empty(trim($rprospects55->__GET('taskid')))) { //if1 ?>    
<?php if ($controlevents < 3) { //if2 ?>

    <div id="eventon" style="float: right;  background-color: #e4d01d; margin-top: 5px; padding:2px; width: 100%; text-align: left; height: 20px; font-size:10px; cursor:pointer;" data-toggle="tooltip" title="<?php echo $rprospects55->__GET('tasktype');?>: <?php echo $rprospects55->__GET('taskname');?>">
    <a  style="color:#fff;">Prospecto:<?php echo mb_substr($rprospects55->__GET('namecontact')." ".$rprospects55->__GET('lastnamecontact'),0,8); ?>..</a>
    <div style="    float: right !important;margin-right: 2px; font-size: 11px;">
<a class="acalend" data-toggle="tooltip" title="Recordatorio" style="margin-right:2px;"><i class="fa fa-clock-o" aria-hidden="true"></i></a>
</div>
 </div> <!--eventon -->

 <?php $controlevents++;?>

    <?php } else { //if2

$cantofexc++;

    }//if2 ?> 

<?php } //if1 ?> 

<?php endforeach;?>


<!-- get task where the user is guest-->
<?php foreach($model->getgueststasks(date("Y-m",$date->getTimestamp())."-".$days[$i]) as $rcalendar1): ?>
 
<?php if (!empty(trim($rcalendar1->__GET('taskid')))) { //if1 ?>    
<?php if ($controlevents < 3) { //if2 ?>

<?php if($rcalendar1->__GET('priority')=="1") { ?>
    <div id="eventon" style="float: right;  background-color: #00b307; margin-top: 5px; padding:2px; width: 100%; text-align: left; height: 20px; font-size:10px; cursor:pointer;">
<?php } elseif($rcalendar1->__GET('priority')=="2") { ?>
    <div id="eventon" style="float: right;  background-color: #0aceff; margin-top: 5px; padding:2px; width: 100%; text-align: left; height: 20px; font-size:10px; cursor:pointer;">
<?php } elseif($rcalendar1->__GET('priority')=="3") { ?>
    <div id="eventon" style="float: right;  background-color: #ff1100; margin-top: 5px; padding:2px; width: 100%; text-align: left; height: 20px; font-size:10px; cursor:pointer;">
<?php } else { ?>
    <div id="eventon" style="float: right;  background-color: #e4d01d; margin-top: 5px; padding:2px; width: 100%; text-align: left; height: 20px; font-size:10px; cursor:pointer;">
<?php } ?>
<a data-toggle="tooltip" title="Evento: <?php echo $rcalendar1->__GET('taskname');?>" style="color:#fff;"><?php echo $rcalendar1->__GET('taskid');?>-<?php echo mb_substr($rcalendar1->__GET('taskname'),0,10); ?>.. </a>
<div style="    float: right !important;margin-right: 2px; font-size: 11px;">
<a class="acalend" data-toggle="tooltip" title="Ver evento" style="margin-right:2px;"><i class="fa fa-eye" aria-hidden="true"></i></a>
<a class="acalend"><i class="fa fa-window-close" aria-hidden="true" data-toggle="tooltip" title="Eliminar evento"></i></a>
</div>
</div> <!--eventon -->

<?php $controlevents++;?>

    <?php } else { //if2

$cantofexc++;

    }//if2 ?> 

<?php } //if1 ?> 

<?php endforeach;?>


<!--cumpleaños-->         
<?php foreach($model->selectall() as $r): ?>
  


<?php
/*Comparar fecha de str a date*/
$date1 = new DateTime($r->__GET('fec_nac'));
$date2 = new DateTime("0000-00-00");

if ($date1->format('Y-m-d') != $date2->format('Y-m-d')) { //if2 ?> 

<?php
/*Comparar fecha de cumpleaaños con fecha actual*/
$date3 = new DateTime(date("Y",$date->getTimestamp())."-".$date1->format('m-d'));
$date4 = new DateTime(date("Y-m",$date->getTimestamp())."-".$days[$i]);
if ($date3->format('Y-m-d') == $date4->format('Y-m-d')) { //if1
    
 if ($controlevents < 3) { //if3 

/*Calculamos edad*/
$difference = $date3->diff($date1);
$age = $difference->y;
?> 

<div id="eventon" style="float: right;  background-color: #ff8761; margin-top: 5px; padding:2px; width: 100%; text-align: left; height: 20px; font-size:11px; cursor:pointer;" data-toggle="tooltip" title="Cumpleaños Nro. <?php echo $age;?> de <?php echo $r->__GET('name'); echo " "; echo $r->__GET('lastname');?>">
<a   style="color:#fff; padding-left:3px;"></i><?php echo mb_substr($r->__GET('name'),0,15); ?>.. </a>
<div style="    float: right !important;margin-right: 2px; font-size: 11px;">
<a class="acalend" style="margin-right:2px;"><i style="margin-left:3px; margin-right: 2px;" class="fa fa-birthday-cake" aria-hidden="true"></i></a>
</div>
</div> <!--eventon -->

<?php $controlevents++;?>

<?php } else { //if3

$cantofexc++;

    }//if3 ?> 


<?php } //if1 ?>
<?php } //if2 ?>





<?php endforeach;?>


<!--cumpleaños contactos-->
<?php foreach($model->getcontacts() as $r): ?>

<?php
/*Comparar fecha de str a date*/
$date1 = new DateTime($r->__GET('birthdaycontact'));
$date2 = new DateTime("0000-00-00");

if ($date1->format('Y-m-d') != $date2->format('Y-m-d')) { //if2 ?> 

<?php
/*Comparar fecha de cumpleaaños con fecha actual*/
$date3 = new DateTime(date("Y",$date->getTimestamp())."-".$date1->format('m-d'));
$date4 = new DateTime(date("Y-m",$date->getTimestamp())."-".$days[$i]);
if ($date3->format('Y-m-d') == $date4->format('Y-m-d')) { //if1 

    if ($controlevents < 3) { //if3 

/*Calculamos edad*/
$difference = $date3->diff($date1);
$age = $difference->y;
?> 

<div id="eventon" style="float: right;     overflow: hidden;  background-color: #9C27B0; margin-top: 5px; padding:2px; width: 100%; text-align: left; height: 20px; font-size:11px; cursor:pointer;" data-toggle="tooltip" title="Cumpleaños Nro. <?php echo $age;?> de <?php echo $r->__GET('namecontact'); echo " "; echo $r->__GET('lastnamecontact');?>">
<a   style="color:#fff; padding-left:3px; min-width:130px;"></i><?php echo mb_substr($r->__GET('companycontact'),0,12); ?>..</a>
<div style="    float: right !important;margin-right: 2px; font-size: 11px;">
<a class="acalend" style="margin-right:2px;"><i style="margin-left:3px; margin-right: 2px;" class="fa fa-birthday-cake" aria-hidden="true"></i></a>
</div>
</div> <!--eventon -->
<?php $controlevents++;?>
<?php } else { //if3
$cantofexc++;

    }//if3 ?> 
<?php } //if1 ?>
<?php } //if2 ?>
<?php endforeach;?>



<!--resto de los eventos-->
<?php if ($cantofexc != 0){ ?>
<div id="eventon" style="float: right;      border: 1px solid;   overflow: hidden;  background-color: #fff; margin-top: 5px; padding:2px; width: 100%; text-align: center;; height: 20px; font-size:11px; cursor:pointer;" data-toggle="tooltip" title="">
<a   style="color:#000; padding-left:3px; min-width:130px;"></i><?php echo $cantofexc; ?> evento(s) más</a>
<div style="    float: right !important;margin-right: 2px; font-size: 11px;">
<a  style="margin-right:2px;"><i style="margin-left:3px; margin-right: 2px;" class="fa fa-eye" aria-hidden="true"></i></a>
</div>
</div> <!--eventon -->
<?php } ?>


 </li>

<?php } ?>


<?php } else { ?>

	<li style="visibility:hidden;"><?php echo 'N/A'; ?>	</li>

<?php } ?>
	
<?php endfor; ?>
<?php endforeach; ?>
</ul>

</div><!--maincalendar-->
</div> <!--panelbody-->


<div style="display:none;">
<input type="text" value="<?php echo date("Y-m",$date->getTimestamp());?>" name="inputcontrol" id="inputcontrol" />
<input type="text" value="" name="inputaction" id="inputaction" />
</div>
</div> <!--primarydiv-->


</form>


<script>
/*Submit*/

function nextmonth() {
document.getElementById("inputaction").value="next";

var inputaction=jQuery('#inputaction').val();
var inputcontrol=jQuery('#inputcontrol').val();

$.ajax({
  type: "POST",
  url: "<?php echo (isset($_SERVER['HTTPS']) ? "https://" : "http://").$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];?>",
  /*data: dataString,*/
  data: {inputaction: inputaction, inputcontrol: inputcontrol,} ,
  success: function(data) {


   $("#formcalendar").load("<?php echo (isset($_SERVER['HTTPS']) ? "https://" : "http://").$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];?>&inputaction="+ inputaction +"&inputcontrol="+ inputcontrol +" #primarydiv"); 
  }
});
return false;
}

function prevmonth() {
document.getElementById("inputaction").value="prev";

var inputaction=jQuery('#inputaction').val();
var inputcontrol=jQuery('#inputcontrol').val();

$.ajax({
  type: "POST",
  url: "<?php echo (isset($_SERVER['HTTPS']) ? "https://" : "http://").$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];?>",
  /*data: dataString,*/
  data: {inputaction: inputaction, inputcontrol: inputcontrol,} ,
  success: function(data) {


   $("#formcalendar").load("<?php echo (isset($_SERVER['HTTPS']) ? "https://" : "http://").$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];?>&inputaction="+ inputaction +"&inputcontrol="+ inputcontrol +" #primarydiv"); 
  }
});
return false;

}

</script>



<!--calendar ends up -->

            </div>
          <!-- Termina 2do tab hacia arriba -->

            </div>
        </div>
    </div>

<!-- CONTENIDO HASTA AQUI hacia ARRIBA -->


  
  </div>
</div>
</div>






<!--modal for adding events down-->
  <?php foreach ($calendar as $days) : ?>
<?php for ($i=1;$i<=7;$i++) : ?>

<?php if (isset($days[$i])) { ?>
<!--modal starts down -->


<?php if(($fecha1) >= ($fecha2)) {?>
  <!-- Modal -->
  <div class="modal fade" id="addevent<?php echo date("Y-m",$date->getTimestamp())."-".$days[$i];?>" role="dialog">
    <div class="modal-dialog" style="margin-top: 150px;">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color: #ffffff;  color: #000;">
          <button type="button" onclick="clear123();" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"> Agregar evento para el día: <?php echo $days[$i]."-".date("m-Y",$date->getTimestamp());?></h4>
        </div>
        <div class="modal-body">
   <!-- a partir de aqui contenido nuevo evento -->

   <div class="row">
<div class="col-md-12">


     <div class="form-group"> 
    <div class="col-md-12 selectContainer" style="margin-bottom:15px;" >
    <strong >Indique el tipo de actividad </strong> 

    <div class="input-group" style="    padding-top: 10px;">
        <span class="input-group-addon"><i class="fa fa-tasks fa-lg" aria-hidden="true"></i></span>
    <select name="tasktodo1" id="tasktodo2<?php echo date("Y-m",$date->getTimestamp())."-".$days[$i];?>" class="form-control selectpicker" required>
    <option value="" selected>Ninguna</option>
<option value="Llamada" >Llamada</option>
<option value="Correo electrónico" >Correo electrónico</option>
<option value="Reunión" >Reunión</option>
<option value="Tarea">Tarea</option>
<option value="Personalizada">Personalizada</option>
    </select>
  </div>
</div>
</div>


<script>
$(function(){
 $('#tasktodo2<?php echo date("Y-m",$date->getTimestamp())."-".$days[$i];?>').change(function(){

    if(document.getElementById("tasktodo2<?php echo date("Y-m",$date->getTimestamp())."-".$days[$i];?>").value == "Personalizada"){

$('#divtoshow3<?php echo date("Y-m",$date->getTimestamp())."-".$days[$i];?>').show( "slow" );
$('#activitycustom1<?php echo date("Y-m",$date->getTimestamp())."-".$days[$i];?>').attr( "disabled", false );
    } else {

$('#divtoshow2<?php echo date("Y-m",$date->getTimestamp())."-".$days[$i];?>').hide( "slow" );
$('#activitycustom1<?php echo date("Y-m",$date->getTimestamp())."-".$days[$i];?>').val("");
$('#activitycustom1<?php echo date("Y-m",$date->getTimestamp())."-".$days[$i];?>').attr( "disabled", true );
    }

});
});

</script>

<div class="col-md-12 inputGroupContainer" id="divtoshow3<?php echo date("Y-m",$date->getTimestamp())."-".$days[$i];?>" style=" display:none; margin-bottom: 15px; padding-left: 15px; 
     padding-right: 15px;">
   <div class="input-group">
   <span class="input-group-addon">Personalizada:</span>
   <input type="text" name="activitycustom" id="activitycustom1<?php echo date("Y-m",$date->getTimestamp())."-".$days[$i];?>" placeholder="Indique la actividad a realizar" value="" max-length="45" class="form-control"/ disabled>
     </div>
   </div>

   <div class="form-group"> 
    <div class="col-md-12 selectContainer" style="margin-bottom:15px;" >
    <strong >Indique la prioridad del evento </strong> 
   <div class="input-group" style="    padding-top: 10px;">
        <span class="input-group-addon"><i class="fa fa-tasks fa-lg" aria-hidden="true"></i></span>
    <select name=colors id="colors1" class="form-control selectpicker" required>
 
    <option class="Seleccionar" value= "">Seleccionar </option>
    <option class="green" value= "1">Baja </option>
    <option class="blue" value= "2"> Normal </option>
    <option class="red" value= "3">Alta </option>
    </select>
 
  </div>
</div>
</div>



<div class="col-md-12 inputGroupContainer" style=" margin-bottom: 15px; padding-left: 15px; 
     padding-right: 15px;">
     <strong >Detalle de la actividad: </strong> 

   <div class="input-group" style="    padding-top: 5px;">
   <span class="input-group-addon"><i class="fa fa-info-circle fa-lg"></i></span>
   <input type="text" name="taskasunto1" id="taskasunto1" placeholder="Asunto" value="" max-length="45" class="form-control"/ required>
     </div>
   </div>
 
 <?php
 $fechaFFase = date("Y-m-d", time());
 $nuevafecha = new DateTime($fechaFFase);
 $nuevafecha->modify('+1 day');
 
 ?>
 
 
 <br> 
   <div class="col-md-12 inputGroupContainer" style="margin-bottom: 15px;  padding-left: 15px;
     padding-right: 15px;">
     <strong >Fecha actividad: </strong> 
   <div class="input-group" style="    padding-top: 5px;">
 
   <span class="input-group-addon"><i class="fa fa-clock-o fa-lg"></i></span>
   <input type="datetime-local" style="    width: auto; max-width: 170px; font-size: 11px; letter-spacing: -1px;  padding: 0px; padding-left: 5px;"name="date_limitasunto1" id="date_limitasunto1" value="<?php echo date("Y/m",$date->getTimestamp())."/".$days[$i];?>T<?php echo "15:00";?>" min=<?php echo date("Y-m-d", time())."T".date("H:i", time());?> class="form-control"/>
     </div>
   </div>
 
 <div class="form-group">
 <div class="col-md-12 inputGroupContainer" style="margin-bottom:20px;">
 <strong>Descripción:</strong>
 <textarea  name="taskdescription1"  style="height: auto !important;" id="contactnotes1" class="form-control"  rows="5" maxlegth="250" required></textarea>
 </div>
 </div>

</div><!--col-md-12-->
</div><!--ro-->

<!-- a partir de aqui nuevo evento..-->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div><!--modal-dialog-->
  </div> <!--modal fade-->

<?php } ?>





<!--modal ends up-->
<?php } ?>
<?php endfor; ?>
<?php endforeach; ?>
<!--modal for adding events down-->



 <!-- Modal -->
 <div class="modal fade" id="newevent">   
  <div class="modal-dialog" id="model-company" style=" max-width:700px; margin-bottom: 70px; width: 100% !important;">
      <!-- Modal content-->

<form action="" method="post" id="formaddevent">

      <div class="modal-content">
        <div class="modal-header" style="background-color: #ffffff; color: #000;">
          <h4> Agregar nuevo evento 
          <button type="button" onclick="clear123();" class="close" data-dismiss="modal">&times;</button>
          </h4>
        </div>
        <div class="modal-body">
        <div class="row">
<div class="col-md-12">


  
     <!--empieza agregar evento -->



     <div class="form-group"> 
    <div class="col-md-12 selectContainer" style="margin-bottom:15px;" >
    <strong >Indique el tipo de actividad </strong> 

    <div class="input-group" style="    padding-top: 10px;">
        <span class="input-group-addon"><i class="fa fa-tasks fa-lg" aria-hidden="true"></i></span>
    <select name="tasktodo1" id="tasktodo1" class="form-control selectpicker" required>
    <option value="" selected>Ninguna</option>
<option value="Llamada" >Llamada</option>
<option value="Correo electrónico" >Correo electrónico</option>
<option value="Reunión" >Reunión</option>
<option value="Tarea">Tarea</option>
<option value="Personalizada">Personalizada</option>
    </select>
  </div>
</div>
</div>


<script>
$(function(){
 $('#tasktodo1').change(function(){

    if(document.getElementById("tasktodo1").value == "Personalizada"){

$('#divtoshow2').show( "slow" );
$('#activitycustom').attr( "disabled", false );
    } else {

$('#divtoshow2').hide( "slow" );
$('#activitycustom').val("");
$('#activitycustom').attr( "disabled", true );
    }

});
});

</script>

<div class="col-md-12 inputGroupContainer" id="divtoshow2" style=" display:none; margin-bottom: 15px; padding-left: 15px; 
     padding-right: 15px;">
   <div class="input-group">
   <span class="input-group-addon">Personalizada:</span>
   <input type="text" name="activitycustom" id="activitycustom" placeholder="Indique la actividad a realizar" value="" max-length="45" class="form-control"/ disabled>
     </div>
   </div>


   <div class="form-group"> 
    <div class="col-md-12 selectContainer" style="margin-bottom:15px;" >
    <strong >Indique la prioridad del evento </strong> 
   <div class="input-group" style="    padding-top: 10px;">
        <span class="input-group-addon"><i class="fa fa-tasks fa-lg" aria-hidden="true"></i></span>
    <select name=colors id="colors" class="form-control selectpicker" required>
 
    <option class="Seleccionar" value= "">Seleccionar </option>
    <option class="green" value= "1">Baja </option>
    <option class="blue" value= "2"> Normal </option>
    <option class="red" value= "3">Alta </option>
    </select>
 
  </div>
</div>
</div>





     <div class="col-md-12 inputGroupContainer" style=" margin-bottom: 15px; padding-left: 15px; 
     padding-right: 15px;">
     <strong >Detalle de la actividad: </strong> 

   <div class="input-group" style="    padding-top: 5px;">
   <span class="input-group-addon"><i class="fa fa-info-circle fa-lg"></i></span>
   <input type="text" name="taskasunto1" id="taskasunto1" placeholder="Asunto" value="" max-length="45" class="form-control"/ required>
     </div>
   </div>
 
 <?php
 $fechaFFase = date("Y-m-d", time());
 $nuevafecha = new DateTime($fechaFFase);
 $nuevafecha->modify('+1 day');
 
 ?>
 
 
 <br> 
   <div class="col-md-12 inputGroupContainer" style="margin-bottom: 15px;  padding-left: 15px;
     padding-right: 15px;">
     <strong >Fecha actividad: </strong> 
   <div class="input-group" style="    padding-top: 5px;">
 
   <span class="input-group-addon"><i class="fa fa-clock-o fa-lg"></i></span>
   <input type="datetime-local" style="    width: auto; max-width: 170px; font-size: 11px; letter-spacing: -1px;  padding: 0px; padding-left: 5px;"name="date_limitasunto1" id="date_limitasunto1" value="<?php echo $nuevafecha->format('Y-m-d');?>T<?php echo "15:00";?>" min=<?php echo date("Y-m-d", time())."T".date("H:i", time());?> class="form-control"/>
     </div>
   </div>
 
 <div class="form-group">
 <div class="col-md-12 inputGroupContainer" style="margin-bottom:20px;">
 <strong>Descripción:</strong>
 <textarea  name="taskdescription1"  style="height: auto !important;" id="contactnotes1" class="form-control"  rows="5" maxlegth="250" required></textarea>
 </div>
 </div>
 


 <div class="form-group">
    <div class="col-md-12 inputGroupContainer">
   
<div class="col-md-12" style="text-align:right;">
    <div class="checkbox">
   <input type="checkbox"  value="1" id="isprivate" name="isprivate" /> ¿Evento privado? <i class="fa fa-info-circle fa-lg" style=" cursor: pointer; margin-left:5px;     color: #8e8e8e;"  data-toggle="tooltip" data-placement="right" title="Los eventos privados son solamente visibles para el usuario que lo creó y sus invitados."></i> 
    </div>
</div>

  </div>
</div>


     <!--termina agregar evento-->
     
<br>
<br>
<br>

</div> <!-- col-md-12 -->


      </div>


      <div style="    border: 1px solid #ccc;  min-height: 90px; margin-left: 10px;  margin-right: 10px; padding: 10px; margin-bottom: 15px;">
<strong>Agregar invitados:</strong>


<br><br>

<select data-placeholder="Seleccionar..." name="inputToarray[]" class="chosen-select form-control selectpicker" multiple >
        <option value=""></option>
    <?php foreach($model->select() as $r): ?>
                        <option  value=" <?php echo $r->__GET('id'); ?>"><?php echo $r->__GET('name'); ?> <?php echo $r->__GET('lastname'); ?> - (<?php echo $r->__GET('email'); ?>)</option>
    <?php endforeach; ?>
         </select>

  


  <script src="../../<?php echo $install_page;?>/source/chosen/chosen.jquery.js" type="text/javascript"></script>
  <script src="../../<?php echo $install_page;?>/source/chosen/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
  <script src="../../<?php echo $install_page;?>/source/chosen/docsupport/init.js" type="text/javascript" charset="utf-8"></script>





</div><!--add guests -->



        <div class="modal-footer">
<button type="submit" id="addeventbtn" name="addeventbtn" class="btn btn-success">Agregar <i class="fa fa-plus fa-lg" style="margin-left:10px;"></i></button>

        </div>
      </div>

</form>

    </div> <!-- modal dialog -->
    </div> <!-- modal fade -->

<script>

function clear123() {

    $( ".search-choice-close" ).click();

}

</script>



</body>
</html>