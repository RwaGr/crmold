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



//Delete cuote
if(isset($_POST['detelecuoteinput'])){

$cuotetodelete = $_POST['idofthecuote'];

foreach ($cuotetodelete as $idcuoteto){
   // echo '<script>alert("'.$idcuoteto.'");</script>';
    $model->deletecuote($idcuoteto); 

}

$alm->__SET('lastmod_date',  date("Y-m-d", time()));
$alm->__SET('prospectid', $_POST['prospectidtobeupdated']);
$model->updateprospectlastmoddate($alm);



  }
  

//succeed a cuote 
if(isset($_POST['succeedcuote'])){
  
  $cuotetodelete = $_POST['idofthecuote'];
  
  foreach ($cuotetodelete as $idcuoteto){
//aquieasg

 $alm->__SET('salesprospectid', $_POST['prospectidtobeupdated']);
 $alm->__SET('salesdate',  date("Y-m-d", time()));
 $alm->__SET('salescuoteid', $idcuoteto);
  $model->createnewsale($alm);
          

  $alm->__SET('status_prospect', '100');
  $alm->__SET('prospectid', $_POST['prospectidtobeupdated']);
  $model->updateprospectstatus($alm);



  
  $alm->__SET('lastmod_date',  date("Y-m-d", time()));
  $alm->__SET('prospectid', $_POST['prospectidtobeupdated']);
  $model->updateprospectlastmoddate($alm);




   //  echo '<script>alert("'.$idcuoteto.'");</script>';
  
  }
  
    }
    



//change status to 0
if(isset($_POST['deniedprospect'])){
//  echo '<script>alert("CAMBIAR A 0%");</script>';
  $alm->__SET('status_prospect', '0');
  $alm->__SET('prospectid', $_POST['prospectidtobeupdated']);
  $model->updateprospectstatus($alm);


  $alm->__SET('lastmod_date',  date("Y-m-d", time()));
  $alm->__SET('prospectid', $_POST['prospectidtobeupdated']);
  $model->updateprospectlastmoddate($alm);
  



}





if(isset($_POST['reactivate'])){

  if(!empty($_POST['reactivatestatus'])){

  //  echo '<script>alert("CAMBIAR A 0%");</script>';
    $alm->__SET('status_prospect', $_POST['reactivatestatus']);
    $alm->__SET('prospectid', $_POST['prospectidtobeupdated']);
    $model->updateprospectstatus($alm);

    $alm->__SET('lastmod_date',  date("Y-m-d", time()));
    $alm->__SET('prospectid', $_POST['prospectidtobeupdated']);
    $model->updateprospectlastmoddate($alm);
    
  }


}


if(isset($_POST['createcuote'])){
  //echo '<script>alert("CAMBIAR A 75%");</script>';


  	
 foreach($model->getprospectsandtasks() as $rprospects1): 
		
		$alm->__SET('contact_prospect', $rprospects1->__GET('prospectid'));
		$alm->__SET('creation_date_prospect',  date("Y-m-d", time()));
		$alm->__SET('totalcuote', $rprospects1->__GET('totalprice'));
		  $model->createcuote($alm);
		
		endforeach;

  
    $almcuotes = $model->getcuoteid(trim($_POST['prospectidtobeupdated']));
    $cuotesid123 = $almcuotes->__GET('cuotesid');

  /*add to pp3 from pp2*/
foreach($model->getpp2fromprospect($_GET['prospectid']) as $rprospects3): 
          $alm->__SET('cuotesid',  $cuotesid123);
          $alm->__SET('pp3_productid',  $rprospects3->__GET('productid'));
          $alm->__SET('pp3_discount', $rprospects3->__GET('pp2_discount'));
          $alm->__SET('pp3_quantity', $rprospects3->__GET('pp2_quantity'));
          $alm->__SET('pp3_priceafter', $rprospects3->__GET('pp2_priceafter'));
          $alm->__SET('priceofthecuote', $rprospects3->__GET('currentprice'));
          $model->addpp3frompros($alm);
 endforeach;


 $alm->__SET('status_prospect', '75');
 $alm->__SET('prospectid', $_POST['prospectidtobeupdated']);
 $model->updateprospectstatus($alm);
  


 $alm->__SET('has_cuotes', '1');
 $alm->__SET('prospectid', $_POST['prospectidtobeupdated']);
 $model->updatehas_cuotesofprospect($alm);


 $alm->__SET('lastmod_date',  date("Y-m-d", time()));
 $alm->__SET('prospectid', $_POST['prospectidtobeupdated']);
 $model->updateprospectlastmoddate($alm);
 

}



// delete pp2
if(isset($_POST['deletepp2input'])){


$vartobedeleted = $_POST['idproducttobeprospected1'];
$totalfinal1 = 0;
foreach ($vartobedeleted as $varpp2delete){

 // echo'<script>alert("'.$varpp2delete.'");</script>';
  $model->deletepp2fromprospect($varpp2delete); 
 // deletepp2fromprospect
}


// actualizar precio total del prospecto
foreach($model->getpp2fromprospect($_POST['prospectidtobeupdated']) as $rprospects7){
  
  $totalfinal1 = ($totalfinal1 + $rprospects7->__GET('pp2_priceafter'));
  
      }
  
   //   echo'<script>alert("total='.$totalfinal1.'");</script>'; 
    
      $alm->__SET('priceafterdis', $totalfinal1);
      $alm->__SET('prospectid',  $_POST['prospectidtobeupdated']);
      $model->updateprospecttotalprice($alm);
  
   //   echo '<script type="text/javascript">location.href = "'.$homeurl.'pages/opportunities'.$session.'&action=checkingprospects&prospectid='.$_POST['prospectidtobeupdated'].'";</script>';
      
   $alm->__SET('lastmod_date',  date("Y-m-d", time()));
   $alm->__SET('prospectid', $_POST['prospectidtobeupdated']);
   $model->updateprospectlastmoddate($alm);
   
 

}  else { 


//Add new product to a prospect
if (isset($_POST['addproducttoprospectnew'])){

  if ($_POST['addproducttoprospectnew']!=""){

  //  check if the product already exist for this prospect
$almprospect9 = $model->checkpp2oftheprospect($_POST['addproducttoprospectnew']);
    
      if($almprospect9->__GET('rowcount') > 0) { 

     echo'<script>alert("El producto que intenta agregar ya existe");</script>'; 
    


      } else { //add the products to the prospect

        $totalfinal21 = 0;


 foreach($model->getproductprice($_POST['addproducttoprospectnew']) as $rprospects1){
    
$priceoftheproduct = $rprospects1->__GET('productprice');
$hasquantvar = $rprospects1->__GET('producthas_quant');
$quantvar = $rprospects1->__GET('productquantity');

        }

if (($hasquantvar == '1') && ($quantvar == '0') ) {
  
  echo'<script>alert("El producto que intenta agregar no posee stock disponible");</script>';

} else {

        $alm->__SET('prospectid',  $_POST['prospectidtobeupdated']);
        $alm->__SET('pp2_productid',  $_POST['addproducttoprospectnew']);
        $alm->__SET('pp2_discount', '0');
        $alm->__SET('pp2_quantity', '1');
        $alm->__SET('priceafterdis', $priceoftheproduct );
        $alm->__SET('currentprice', $priceoftheproduct );
        $model->addpp2frompros($alm);


// actualizar precio total del prospecto
foreach($model->getpp2fromprospect($_POST['prospectidtobeupdated']) as $rprospects3){
  
  $totalfinal21 = ($totalfinal21 + $rprospects3->__GET('pp2_priceafter'));
  
      }
  
      $alm->__SET('priceafterdis', $totalfinal21);
      $alm->__SET('prospectid',  $_POST['prospectidtobeupdated']);
      $model->updateprospecttotalprice($alm);

      $alm->__SET('lastmod_date',  date("Y-m-d", time()));
      $alm->__SET('prospectid', $_POST['prospectidtobeupdated']);
      $model->updateprospectlastmoddate($alm);


}

      }

  }

} else {
 //agregar else aqui 


//actualizar  prospecto
if (isset($_POST['updateprospect'])){


//updateresponsable
  if (isset($_POST['responsableofprospecttoupdate'])){

          $alm->__SET('responsable',  $_POST['responsableofprospecttoupdate']);
          $alm->__SET('prospectid',  $_POST['prospectidtobeupdated']);
        
          $model->updateprospectresponsable($alm);


          $alm->__SET('lastmod_date',  date("Y-m-d", time()));
          $alm->__SET('prospectid', $_POST['prospectidtobeupdated']);
          $model->updateprospectlastmoddate($alm);
          
  }
    
  //actualizar notas del prospecto
  if ($_POST['prospectnotesimp'] != "No tiene notas o aspectos de interés para el prospecto"){

  //  echo'<script>alert("'.$_POST['prospectnotesimp'].'");</script>';
$notesdif = $_POST['prospectnotesimp'];


} else {

  $notesdif = "";

}


if(isset($_POST['updatestatus'])){
    $alm->__SET('prospectnotes', $notesdif);
    $alm->__SET('prospectid',  $_POST['prospectidtobeupdated']);
    $alm->__SET('status_prospect',  $_POST['updatestatus']);
  
    $model->updateprospectnotes($alm);



    $alm->__SET('lastmod_date',  date("Y-m-d", time()));
    $alm->__SET('prospectid', $_POST['prospectidtobeupdated']);
    $model->updateprospectlastmoddate($alm);
    


}

  



  //actualizar pp2 del prospecto
  if(isset($_POST['idproducttobeprospected1'])){
    
    $varforpro1 = $_POST['idproducttobeprospected1'];
    $quantforpro1 = $_POST['quantityproforpros1'];
    $discountforpro1 = $_POST['rangediscount1'];
    $priceforpros1 = $_POST['pricetobeposted1'];
    $i1= 0;
   $total1 = "";
  
   
    foreach ($varforpro1 as $secondvar1){
     // echo'<script>alert("idpp2='.$secondvar1.'------quantity='.$quantforpro1[$i1].'---------discount='.$discountforpro1[$i1].'-------priceprospect='.$priceforpros1[$i1].'");</script>';     
      $total1 = (($quantforpro1[$i1]*$priceforpros1[$i1]) - ((($quantforpro1[$i1]*$priceforpros1[$i1])*$discountforpro1[$i1])/100));   
    //  echo'<script>alert("total='.$total1.'");</script>';
      
              $alm->__SET('pp2_quantity', $quantforpro1[$i1]);
              $alm->__SET('pp2_discounts', $discountforpro1[$i1]);
              $alm->__SET('pp2_priceafter', $total1);
              $alm->__SET('pp2_productid',  $secondvar1);
              $alm->__SET('currentprice',  $priceforpros1[$i1]);
              
              $model->updatepp2forprospect($alm);
          
              $i1++;
    }

$totalfinal31 = 0;

// actualizar precio total del prospecto
    foreach($model->getpp2fromprospect($_POST['prospectidtobeupdated']) as $rprospects67){

$totalfinal31 = ($totalfinal31 + $rprospects67->__GET('pp2_priceafter'));

    }

 //   echo'<script>alert("total='.$totalfinal1.'");</script>'; 
  
    $alm->__SET('priceafterdis', $totalfinal31);
    $alm->__SET('prospectid',  $_POST['prospectidtobeupdated']);
    $model->updateprospecttotalprice($alm);


    $alm->__SET('lastmod_date',  date("Y-m-d", time()));
    $alm->__SET('prospectid', $_POST['prospectidtobeupdated']);
    $model->updateprospectlastmoddate($alm);
    


  }


}

//actualizar tarea existente empieza
if (isset($_POST['taskid'])){
  
  //Eliminar
if(empty($_POST['tasktodo1'])){

 // echo '<script>alert("prospectid ='.$_POST['prospectidtobeupdated'].' ----ELIMINAR'.$_POST['taskid'].'- tarea='.$_POST['tasktodo1'].'");</script>';
  
  $model->deletetaskinprospect($_POST['taskid']); 

  $alm->__SET('has_tasks_prospect', '0');
  $alm->__SET('prospectid',         $_POST['prospectidtobeupdated']);
  $model->updatetaskinprospect($alm);


  $alm->__SET('lastmod_date',  date("Y-m-d", time()));
  $alm->__SET('prospectid', $_POST['prospectidtobeupdated']);
  $model->updateprospectlastmoddate($alm);
  


} else {  //actualizar

 // echo '<script>alert("prospectid ='.$_POST['prospectidtobeupdated'].' ----CAMBIAR'.$_POST['taskid'].'- tarea='.$_POST['tasktodo1'].'");</script>';


  $alm->__SET('taskname', $_POST['taskasunto1']);
  $alm->__SET('taskdescrip',         $_POST['taskdescription1']);
  $alm->__SET('tasklimitdate', $_POST['date_limitasunto1']);
  $alm->__SET('tasktype', $_POST['tasktodo1']);
  $alm->__SET('taskid',         $_POST['taskid']);
  $model->updatetaskintasks($alm);

  $alm->__SET('has_tasks_prospect', $_POST['tasktodo1']);
  $alm->__SET('prospectid',         $_POST['prospectidtobeupdated']);
  $model->updatetaskinprospect($alm);

  $alm->__SET('lastmod_date',  date("Y-m-d", time()));
  $alm->__SET('prospectid', $_POST['prospectidtobeupdated']);
  $model->updateprospectlastmoddate($alm);
  


}


}
//actualizar tarea existente termina



//agregar nueva tarea para prospecto empieza
if (isset($_POST['taskidnew'])){

  if(!empty($_POST['tasktodo1'])){


    $alm->__SET('taskname', $_POST['taskasunto1']);
    $alm->__SET('taskdescrip', $_POST['taskdescription1']);
    $alm->__SET('taskdate',  date("Y-m-d", time()));
    $alm->__SET('tasklimitdate',   $_POST['date_limitasunto1']);
    $alm->__SET('tasktype', $_POST['tasktodo1']);
    $alm->__SET('taskasocprospect',  $_POST['prospectidtobeupdated']);
    
    $model->addtasksfromprospect($alm);

    $alm->__SET('has_tasks_prospect', $_POST['tasktodo1']);
    $alm->__SET('prospectid',         $_POST['prospectidtobeupdated']);
    $model->updatetaskinprospect($alm);

 // echo '<script>alert("'.$_POST['taskidnew'].'");</script>';  


 $alm->__SET('lastmod_date',  date("Y-m-d", time()));
 $alm->__SET('prospectid', $_POST['prospectidtobeupdated']);
 $model->updateprospectlastmoddate($alm);
 


}
}

//agregar nueva tarea para prospecto termina 

} //add pp2 else




} //delete else

if(isset($_GET['idcontact'])){

 
    $almprospect = $model->getprospectscount(trim($_GET['idcontact']));
    
      if($almprospect->__GET('rowcount') > 0) { 

echo '<script type="text/javascript">location.href = "'.$homeurl.'pages/opportunities'.$session.'&action=newprospect&answer=exist";</script>';

      }
}






if(isset($_POST['addprospect'])){

    
//echo '<script> alert("status:'.$_POST['statusoftheprospect'].'------Responsable:'.$_POST['responsableofprospect'].'---------tareaparahacer:'.$_POST['tasktodo'].'------id='.$_POST['idcontacttoprospect'].'");</script>';


$alm->__SET('contact_prospect', $_POST['idcontacttoprospect']);
$alm->__SET('responsable_prospect', $_POST['responsableofprospect']);
$alm->__SET('status_prospect', $_POST['statusoftheprospect']);
$alm->__SET('creation_date_prospect',  date("Y-m-d", time()));
$alm->__SET('has_tasks_prospect', $_POST['tasktodo'] != '' ? $_POST['tasktodo'] : '0' );
$alm->__SET('prospectnotes', $_POST['prospectnotes']);
$alm->__SET('lastmod_date',  date("Y-m-d", time()));

$model->addprospect($alm);



/* add tasks and products to pdv_pp2 */
$almprospect = $model->getprospectscount(trim($_POST['idcontacttoprospect']));
$prospectidtodothings = $almprospect->__GET('prospectid');


if(trim($_POST['tasktodo']) != ""){


    $alm->__SET('taskname', $_POST['taskasunto']);
    $alm->__SET('taskdescrip', $_POST['taskdescription']);
    $alm->__SET('taskdate',  date("Y-m-d", time()));
    $alm->__SET('tasklimitdate',   $_POST['date_limitasunto']);
    $alm->__SET('tasktype', $_POST['tasktodo']);
    $alm->__SET('taskasocprospect', $prospectidtodothings );
    
    $model->addtasksfromprospect($alm);

   // echo '<script> alert("AQUI:'.$almprospect->__GET('prospectid').'"); </script>';



}


if(isset($_POST['idproducttobeprospected'])){

$varforpro = $_POST['idproducttobeprospected'];
$quantforpro = $_POST['quantityproforpros'];
$discountforpro = $_POST['rangediscount'];
$priceforpros = $_POST['pricetobeposted'];
$i= 0;
$total = "";
$totalfinal = 0;

foreach ($varforpro as $secondvar){

//echo '<script> alert("prospect='.$almprospect->__GET('prospectid').'-------id='.$secondvar.'--- quanttity='.$quantforpro[$i].'------discount='.$discountforpro[$i].'");</script>';
//echo '<script> alert("id='.$secondvar.'--- quanttity='.$quantforpro[$i].'------discount='.$discountforpro[$i].'-----'.$priceforpros[$i].'");</script>';
$total = (($quantforpro[$i]*$priceforpros[$i]) - ((($quantforpro[$i]*$priceforpros[$i])*$discountforpro[$i])/100));
//echo '<script> alert("TOTAL='.$total.'");</script>';
$totalfinal = $totalfinal + $total;

    $alm->__SET('prospectid',  $almprospect->__GET('prospectid'));
    $alm->__SET('pp2_productid',  $secondvar);
    $alm->__SET('pp2_discount', $discountforpro[$i]);
    $alm->__SET('pp2_quantity', $quantforpro[$i] );
    $alm->__SET('priceafterdis', $total );
    $alm->__SET('currentprice', $priceforpros[$i]);
    $model->addpp2frompros($alm);

$i++;

}

$alm->__SET('prospectid', $prospectidtodothings);
$alm->__SET('totalprice', $totalfinal);
$model->updatefinalpriceinprospect($alm);

}
}



/*Asign vars for the chat rounded*/
      $almchart = $model->getprospectscountedbystatus('25');
$varindeciso = $almchart->__GET('rowcount');
 // echo '<script>alert("'.$varindeciso.'");</script>';
      $almchart = $model->getprospectscountedbystatus('50');
$varenprogreso = $almchart->__GET('rowcount');
 // echo '<script>alert("'.$varenprogreso.'");</script>';
      $almchart = $model->getprospectscountedbystatus('75');
$varnegociando = $almchart->__GET('rowcount');
//echo '<script>alert("'.$varnegociando.'");</script>';
      $almchart = $model->getprospectscountedbystatus('0');
$vartodos = $almchart->__GET('rowcount');



//echo '<script>alert("'.$vartodos.'");</script>';

?>



</div>


<style>



#slidecontainer {
    width: 100%; /* Width of the outside container */
}

/* The slider itself */
.slider {
    -webkit-appearance: none;  /* Override default CSS styles */
    appearance: none;
    width: 100%; /* Full-width */
    height: 5px; /* Specified height */
    background: #d3d3d3; /* Grey background */
    outline: none; /* Remove outline */
    opacity: 0.7; /* Set transparency (for mouse-over effects on hover) */
    -webkit-transition: .2s; /* 0.2 seconds transition on hover */
    transition: opacity .2s;
}

/* Mouse-over effects */
.slider:hover {
    opacity: 1; /* Fully shown on mouse-over */
}

/* The slider handle (use webkit (Chrome, Opera, Safari, Edge) and moz (Firefox) to override default look) */ 
.slider::-webkit-slider-thumb {
    -webkit-appearance: none; /* Override default look */
    appearance: none;
    width: 15px; /* Set a specific slider handle width */
    height: 15px; /* Slider handle height */
    background: rgba(250, 133, 0, 0.68);                  
    cursor: pointer; /* Cursor on hover */
    border-radius:15px;
}

.slider::-moz-range-thumb {
    width: 25px; /* Set a specific slider handle width */
    height: 25px; /* Slider handle height */
    background: #4CAF50; /* Green background */
    cursor: pointer; /* Cursor on hover */
}
</style>


</head>


<body >

<div id="profile_cont" class="container" style="margin: 0px; padding: 0px; width: 100%;">
<div class="row">
  <div  id="sidebar_div" class="col-sm-3">
   
  <!-- including sidebar from templates-->
<?php require_once '../../'.$_SESSION['install_page'].'/template/sidebar.php'; ?>




  </div>

  <div class="col-sm-9">



  <div class="row" style="padding:10px; ">
        <div class="col-sm-12" style="    margin-bottom: 20%;" id="marginmas768">
            <div class="tab-content">

<br>


<!-- dashboard-->
      
<?php if(!isset($_GET['action'])) { ?>
                      <div class="tab-pane fade in active" >
                  <?php } else { ?>
                    <div class="tab-pane fade in" id="check">
                    <?php } ?>

<!-- empieza dashboard-->



<!-- negociaciones en progreso empieza abajo -->
<div class="row">
<div class="col-md-12">
<div class="widget-num-12" data-toggle="tooltip" data-placement="right" title='Muestra el valor correspondiente a la suma de los totales de cada prospecto en estado de: "Indeciso", "En progreso y "Negociando""'>
<div class="crm-offer-title-widgets" style="text-align:center;"  ><strong > Total de oportunidades (prospectos) activas </strong> <i style=" margin-right: 15px; margin-top: 10px; margin-left: 5px;" class="fa fa-info-circle fa-lg"></i></div>

<div class="widget-num-content">

<?php 

$totaltoshow = 0;


foreach($model->getpricesofnegociations1() as $rprospects1){

    $totaltoshow = ($totaltoshow + $rprospects1->__GET('totalprice'));
      
} ?>


<?php echo "$ ".number_format($totaltoshow,0, ',', '.' );?>

</div>


</div><!-- card-->
</div><!--col-md-12-->
</div> <!--row-->
<!--negociaciones en progreso termina arriba -->



<!-- negociaciones en progreso empieza abajo -->
<div class="row">
<div class="col-md-12">
<div class="widget-num-12" style="
    background-color: rgb(241, 71, 71) !important;" data-toggle="tooltip" data-placement="right" title='Muestra el valor en ($) de todos los prospectos denegados del mes'>
<div class="crm-offer-title-widgets" style="text-align:center;  "  ><strong > Total de oportunidades (prospectos) denegados en el mes </strong> <i style=" margin-right: 15px; margin-top: 10px; margin-left: 5px;" class="fa fa-info-circle fa-lg"></i></div>

<div class="widget-num-content">
<?php 
$totaldenied = 0;
foreach($model->getpricesofprospectsdown(date("m", time())) as $rdown){
  $totaldenied = ($totaldenied + $rdown->__GET('totalprice'));     
}  ?>

<?php echo "$ ".number_format($totaldenied,0, ',', '.' );?>

</div>

</div><!-- card-->
</div><!--col-md-12-->
</div> <!--row-->
<!--negociaciones en progreso termina arriba -->




<div class="row">
<div class="col-md-8">




<div class="card2" style=" background-color: #fff !important; padding: 0; cursor:pointer;" >
<div class="crm-offer-title"  style="padding-left:5%; text-align:center;  background-color: rgb(132, 184, 249) !important;" data-toogle="tool-tip" data-placement="right" title="Cantidad de prospectos denegados y aprobados de los ultimos 3 meses"><strong>Relación de prospectos denegados (0%) y aprobados (100%) (Últimos 4 meses) <i style=" margin-right: 15px; margin-top: 10px; margin-left: 5px;" class="fa fa-info-circle fa-lg"></i></strong> </div>





<?php


 


//Fechas de la grafica
$fecha = date('Y-m-01');
$nuevafecha = strtotime ( '-0 month' , strtotime ( $fecha ) ) ;
$nuevafecha = date ( 'd/m/Y' , $nuevafecha );
$date = DateTime::createFromFormat("d/m/Y", $nuevafecha);
//echo strtoupper(strftime("%B",$date->getTimestamp()));
$alm1 = $model->getprospectsdeniedcount(date("m",$date->getTimestamp()));
//echo '<script> alert("'.$alm1->__GET('rowcount').'"); </script>';
$currentmonth = $alm1->__GET('rowcount');
$alm1 = $model->getprospectsaprovedcount(date("m",$date->getTimestamp()));
$currentmonthaproved = $alm1->__GET('rowcount');


$nuevafecha1 = strtotime ( '-1 month' , strtotime ( $fecha ) ) ;
$nuevafecha1 = date ( 'd/m/Y' , $nuevafecha1 );
$date1 = DateTime::createFromFormat("d/m/Y", $nuevafecha1);
//echo strtoupper(strftime("%B",$date1->getTimestamp()));
$alm1 = $model->getprospectsdeniedcount(date("m",$date1->getTimestamp()));
//echo '<script> alert("'.$alm1->__GET('rowcount').'"); </script>';
$currentmonth1 = $alm1->__GET('rowcount');
$alm1 = $model->getprospectsaprovedcount(date("m",$date1->getTimestamp()));
$currentmonth1aproved = $alm1->__GET('rowcount');



$nuevafecha2 = strtotime ( '-2 month' , strtotime ( $fecha ) ) ;
$nuevafecha2 = date ( 'd/m/Y' , $nuevafecha2 );
$date2 = DateTime::createFromFormat("d/m/Y", $nuevafecha2);
//echo strtoupper(strftime("%B",$date2->getTimestamp()));
//echo date("m",$date2->getTimestamp());
$alm1 = $model->getprospectsdeniedcount(date("m",$date2->getTimestamp()));
$currentmonth2 = $alm1->__GET('rowcount');
$alm1 = $model->getprospectsaprovedcount(date("m",$date2->getTimestamp()));
$currentmonth2aproved = $alm1->__GET('rowcount');



$nuevafecha3 = strtotime ( '-3 month' , strtotime ( $fecha ) ) ;
$nuevafecha3 = date ( 'd/m/Y' , $nuevafecha3 );
$date3 = DateTime::createFromFormat("d/m/Y", $nuevafecha3);
//echo strtoupper(strftime("%B",$date2->getTimestamp()));
//echo date("m",$date2->getTimestamp());
$alm1 = $model->getprospectsdeniedcount(date("m",$date3->getTimestamp()));
$currentmonth3 = $alm1->__GET('rowcount');
$alm1 = $model->getprospectsaprovedcount(date("m",$date3->getTimestamp()));
$currentmonth3aproved = $alm1->__GET('rowcount');


?>




<div id="chart_div33" class="chart" style="height:350px; padding-left:5%;"></div>


<script>

google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart33);
function drawChart33() {
  var data = google.visualization.arrayToDataTable([
    ['Mes', 'Denegados (0%)', 'Aprobados (100%)'],
    ['<?php echo strtoupper(strftime("%B",$date3->getTimestamp()));?>',  <?php echo $currentmonth3;?>, <?php echo $currentmonth3aproved;?>],
    ['<?php echo strtoupper(strftime("%B",$date2->getTimestamp()));?>',  <?php echo $currentmonth2;?>, <?php echo $currentmonth2aproved;?>],
    ['<?php echo strtoupper(strftime("%B",$date1->getTimestamp()));?>',  <?php echo $currentmonth1;?>, <?php echo $currentmonth1aproved;?>],
    ['<?php echo strtoupper(strftime("%B",$date->getTimestamp()));?>',  <?php echo $currentmonth;?>, <?php echo $currentmonthaproved;?>]
  ]);
  var options = {
   /* title: '',*/
    colors:['c9302c', '5cb85c'],
          backgroundColor: 'fff',

 chartArea: {
     width:'80%',height:'75%',
 },
 legend: {position: 'bottom'},

    hAxis: {title: '', titleTextStyle: {color: 'red'}}

    

 };

var chart = new google.visualization.ColumnChart(document.getElementById('chart_div33'));
  chart.draw(data, options);
}


$(window).resize(function(){
  drawChart33();

});

</script>




   </div> <!--ccard-->

</div><!--col-md-8-->



<div class="col-md-4">

<div class="card2" style=" background-color: #fff !important; padding: 0; cursor:pointer;"  >
<div class="crm-offer-title" style="text-align:center;  " data-toogle="tool-tip" data-placement="right" title='Muestra la relación del estado de los prospectos activos ("Indeciso", "En progreso" y "Negociando")'><strong>Relación de prospectos activos <i style=" margin-right: 15px; margin-top: 10px; margin-left: 5px;" class="fa fa-info-circle fa-lg"></i></strong></div>


       <div id="piechart" style="height:350px; " ></div>
   
   <script>
       google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        <?php if($vartodos == 0){?>
        var data = google.visualization.arrayToDataTable([
          ['Task', ''],
          ['No hay prospectos activos', 1]
        ]);
        <?php } else { ?>
          var data = google.visualization.arrayToDataTable([
          ['Task', ''],
          ['Indeciso',    <?php echo $varindeciso;?>],
          ['En proceso',     <?php echo $varenprogreso;?>],
          ['Negociando',    <?php echo $varnegociando;?>]   
          ]);
        <?php } ?>
        var options = {
         /* title: '',*/
          colors:['c9302c', '31b0d5', '5cb85c'],
          backgroundColor: 'fff',

 chartArea: {
     width:'80%',height:'80%',
    'backgroundColor': { 'fill': '000', 'opacity': 100 }, 
 },
 legend: {position: 'bottom'},


        };

       

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }



      $(window).resize(function(){
        drawChart();
});
</script>
</div><!--card-->
</div><!--col-md-4-->
</div><!--row-->






<!-- termina dashboard arriba -->

            </div> <!-- tab-pane fade in-->


<!-- dashboard-->

            <!-- comienza 1er tab hacia abajo -->
            
          <?php if(isset($_GET['action'])) { ?>
                    <?php if ((($_GET['action'])=="newprospect")) { ?>
                      <div class="tab-pane fade in active" id="new">
                      <?php } else { ?>
                        <div class="tab-pane fade in " id="new">
                        <?php } ?>
                  <?php } else { ?>
                    <div class="tab-pane fade in " id="new">
                    
                    <?php } ?>

         
               <!-- NUEVO PROSPECTO empieza abajo-->

<?php if(isset($_GET['answer'])) { ?>

<div class="alert alert-danger alert-dismissable" style="width:90%; margin-left:5%;">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong><i class="fa fa-exclamation-triangle" style="margin-right:10px;"></i></strong> Este contacto ya posee una oportunidad abierta, si desea crear otra debe cambiar o editar el estado de la anterior.
</div>

<?php } ?>



<form action="<?php echo $homeurl."pages/opportunities".$session."&action=viewprospects&status=".$defaultprospectsview;?>" method="post" id="prospectsform">


<div class="card1 " style="min-height: 200px;   border-radius:0px;   margin-bottom: 0;   background-image: linear-gradient(to bottom,#ffffff 0,#ffffff 100%); background-color: #fff !important; padding: 0;">
<div class="crm-offer-title"  style="padding-left:5%; font-size:18px;"><i class="fa fa-user-plus " aria-hidden="true"></i>  Datos del contacto </div>


<div class="row">

<div class="col-md-12">

<div class="maindiv" >


<?php if (!isset($_GET['idcontact'])){ ?>

<strong>Seleccione un contacto</strong>

<div class="form-group"> 
    <div class="col-md-6 selectContainer" style="margin-top:15px;">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-user fa-lg" aria-hidden="true"></i></span>
    <select name="contact" id="contact" class="form-control selectpicker" required>
      <option value="">Seleccionar</option>
   
<?php foreach($model->getcontacts() as $r): ?>

<option value="<?php echo $homeurl."pages/opportunities".$session."&action=newprospect&idcontact=".$r->__GET('id');?>" ><?php echo $r->__GET('id'); ?>- <?php echo $r->__GET('namecontact');?> <?php echo $r->__GET('lastnamecontact');?>  (<?php echo $r->__GET('companycontact');?>)</option>

<?php endforeach;?>
    </select>
  </div>
</div>
</div>

<?php } else { ?>



<strong>Datos personales</strong>
<br><br>

<div style="overflow-x:auto;">
    <table  class="table table-bordered" cellspacing="0" style=" border-collapse: collapse; width:100%;">
<thead style="background-color: rgba(228, 228, 228, 0.7);">
<th>
ID
</th>
<th style="    min-width: 150px;">
Nombre contacto
</th>
<th style="    min-width: 150px;">
E-mail
</th>
<th style="    min-width: 120px;">
Teléfono
</th>

</thead>

<tbody>
    <?php foreach($model->getcontacts() as $r): ?>

    <?php $varresp = $r->__GET('responsable'); ?>


<tr class="tr-table">
<td class="td-table">
<p><?php echo $r->__GET('id'); ?> <input style="display:none;" type="text" name="idcontacttoprospect" value="<?php echo $r->__GET('id'); ?>" />
</p>
</td>
<td class="td-table">
<p><?php echo $r->__GET('namecontact');?> <?php echo $r->__GET('lastnamecontact');?></p>
</td>
<td class="td-table">
<p><?php echo $r->__GET('emailcontact');?></p>
</td>
<td class="td-table">
<p><?php echo $r->__GET('phonecontact');?></p>
</td>
</tr>





<?php endforeach;?>
</tbody>
</table>
</div>


<strong>Datos Empresariales</strong>
<br><br>

<div style="overflow-x:auto;">
    <table  class="table table-bordered" cellspacing="0" style=" border-collapse: collapse; width:100%;">
<thead style="background-color: rgba(228, 228, 228, 0.7);">
<th>

Cargo
</th>
<th>
Empresa
</th>

</thead>

<tbody>
    <?php foreach($model->getcontacts() as $r): ?>


<tr class="tr-table">
<td class="td-table">
<p><?php echo $r->__GET('chargecontact');?></p>
</td>
<td class="td-table">
<p><?php echo $r->__GET('companycontact');?></p>
</td>
</tr>


<?php endforeach;?>
</tbody>
</table>
</div>


<?php } ?>



<script>
    $(function(){
      // bind change event to select
      $('#contact').on('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });
</script>







</div><!--maindiv-->


</div> <!--colmd12-->
</div><!--row-->








</div><!--card-->



<?php if (isset($_GET['idcontact'])){ ?>
<div class="card1 " style="min-height: 200px;   border-radius:0px;   margin-bottom: 0;   background-image: linear-gradient(to bottom,#ffffff 0,#ffffff 100%); background-color: #fff !important; padding: 0;">
<div class="crm-offer-title"  style="padding-left:5%; font-size:18px;"><i class="fa fa-cube " aria-hidden="true"></i>  Datos del producto </div>


<div class="row">

<div class="col-md-12">


<div class="maindiv" >
<strong>Seleccione los productos de interés para el prospecto</strong> 


<div class="col-md-12" style="overflow-x:auto; margin-top:20px;">
  
<div class="col-md-6" style="text-align:right; margin-bottom:20px;">
            
            <div class="form-group" style="width:100%">
              <div class="col-md-12 inputGroupContainer">
              <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-search"></i></span>
              <input  name="inputcompany1" id="inputcompany1" placeholder="Buscar por producto o categoria" onkeyup="search1();" class="form-control"  type="text" autofocus>
                </div>
              </div>
            </div>
            
    </div>
  
   



<div class="col-md-12 panel-body" style="padding: 0;     height: 380px; margin-bottom:20px;" >

    <table id="myTable" class="table table-bordered" cellspacing="0" style=" border-collapse: collapse; width:100%;">


 <thead style="background-color: rgba(228, 228, 228, 0.7);">
 <th style="    min-width: 50px;">
 ID
 </th>
 <th style="    min-width: 190px;">
 Producto
 </th>
 <th style="    min-width: 140px;">
 Categoria
 </th>
 <th style="    min-width: 150px;">
Cantidad
 </th>
 <th style="    min-width: 150px; width::150px !important;">
Descuento
 </th>
 <th style="    min-width: 120px; width:120px !important;">
 Precio
 </th>
 

</thead>

<tbody  >



<?php foreach($model->getproducts() as $rproduct): ?>
      
<tr readonly>
<td> <?php echo $rproduct->__GET('productid');?><input  value="<?php echo $rproduct->__GET('productid');?>" id="check<?php echo $rproduct->__GET('productid');?>" name="idproducttobeprospected[]" style="margin-left: 3px;"  class="classcheckbox" type="checkbox"/></td>
<td> <?php echo $rproduct->__GET('productname');?>

<br> <p style="font-size:11px;">Existencia:

<?php if($rproduct->__GET('producthas_quant') == 1){ ?>

    <?php if ($rproduct->__GET('productquantity') <= $rproduct->__GET('critical_quant')) {?>
        <span  style="color: #ca3b37;  font-weight: 900;"><?php echo  $rproduct->__GET('productquantity'); ?></span>
    <?php } else {?>
 <?php echo  $rproduct->__GET('productquantity'); ?>
        <?php } ?>


<?php } else {?>

No aplica

<?php } ?>

</p>

</td>


<td> <?php echo $rproduct->__GET('productcategory');?></td>

<td>

<?php if($rproduct->__GET('producthas_quant') == 1){ ?>

<input name="quantityproforpros[]" style="width: 50px;" type="number" id="quant<?php echo $rproduct->__GET('productid');?>" min=0 max="<?php echo $rproduct->__GET('productquantity');?>" onblur="notmore<?php echo $rproduct->__GET('productid');?>();" onKeypress="if (event.keyCode < 47 || event.keyCode > 57) event.returnValue = false;" value="0"/ disabled>


<script>

var valueinv<?php echo $rproduct->__GET('productid');?> = "<?php echo  $rproduct->__GET('productquantity'); ?>";


function notmore<?php echo $rproduct->__GET('productid');?>(){
    if( parseInt(document.getElementById("quant<?php echo $rproduct->__GET('productid');?>").value) > parseInt(valueinv<?php echo $rproduct->__GET('productid');?>)) {
alert("No existe suficiente stock para este producto");
$('#quant<?php echo $rproduct->__GET('productid');?>').val('1');
  }

}





$(function(){
 $('#check<?php echo $rproduct->__GET('productid');?>').click(function(){
   
    if(valueinv<?php echo $rproduct->__GET('productid');?> == 0){
alert("El producto que desea agregar no posee inventario suficiente");
$('#check<?php echo $rproduct->__GET('productid');?>').attr('checked', false);
  } else {

  if (document.getElementById("check<?php echo $rproduct->__GET('productid');?>").checked == true) {
    
$('#quant<?php echo $rproduct->__GET('productid');?>').attr('disabled', false);

    $('#quant<?php echo $rproduct->__GET('productid');?>').val('1');
$('#myRange<?php echo $rproduct->__GET('productid');?>').attr('disabled', false);
$('#priceinput<?php echo $rproduct->__GET('productid');?>').attr('disabled', false);


}else{

    $('#quant<?php echo $rproduct->__GET('productid');?>').attr('disabled', true);
    $('#quant<?php echo $rproduct->__GET('productid');?>').val('0');
    $('#myRange<?php echo $rproduct->__GET('productid');?>').attr('disabled', true);
    $('#myRange<?php echo $rproduct->__GET('productid');?>').val('0');
    $('#demo<?php echo $rproduct->__GET('productid');?>').html('0%');
    $('#priceinput<?php echo $rproduct->__GET('productid');?>').attr('disabled', true);
}

 }
});
});
</script>


<?php } else { ?>

    <input style="display:none;" name="quantityproforpros[]" style="width: 50px;" type="number" id="quant<?php echo $rproduct->__GET('productid');?>" min=1 max=1  value="1"/ disabled>

No Aplica


<script>

var valueinv<?php echo $rproduct->__GET('productid');?> = "1";






$(function(){
    $('#check<?php echo $rproduct->__GET('productid');?>').click(function(){
      
  
   
     if (document.getElementById("check<?php echo $rproduct->__GET('productid');?>").checked == true) {
       
   $('#quant<?php echo $rproduct->__GET('productid');?>').attr('disabled', false);
   
       $('#quant<?php echo $rproduct->__GET('productid');?>').val('1');
   $('#myRange<?php echo $rproduct->__GET('productid');?>').attr('disabled', false);
   $('#priceinput<?php echo $rproduct->__GET('productid');?>').attr('disabled', false);
   
   
   }else{
   
       $('#quant<?php echo $rproduct->__GET('productid');?>').attr('disabled', true);
       $('#quant<?php echo $rproduct->__GET('productid');?>').val('0');
       $('#myRange<?php echo $rproduct->__GET('productid');?>').attr('disabled', true);
       $('#myRange<?php echo $rproduct->__GET('productid');?>').val('0');
       $('#demo<?php echo $rproduct->__GET('productid');?>').html('0%');
       $('#priceinput<?php echo $rproduct->__GET('productid');?>').attr('disabled', true);



   
   }
   
    
   });
   });
</script>




<?php } ?>

</td>

<td>

<div id="slidecontainer">

  <input style="margin-top:3%; margin-bottom:5%;" type="range" scale="5" min="0" max="100" value="0" class="slider" id="myRange<?php echo $rproduct->__GET('productid');?>" name="rangediscount[]" disabled>
 <p>Descuento: <span id="demo<?php echo $rproduct->__GET('productid');?>"></span></p>
</div>


<script>
var slider<?php echo $rproduct->__GET('productid');?> = document.getElementById("myRange<?php echo $rproduct->__GET('productid');?>");
var output<?php echo $rproduct->__GET('productid');?> = document.getElementById("demo<?php echo $rproduct->__GET('productid');?>");
output<?php echo $rproduct->__GET('productid');?>.innerHTML = (slider<?php echo $rproduct->__GET('productid');?>.value)+"%";

slider<?php echo $rproduct->__GET('productid');?>.oninput = function() {
  output<?php echo $rproduct->__GET('productid');?>.innerHTML = this.value+"%";
}
</script>


 </td>

 <?php $number = $rproduct->__GET('productprice');?>

<td style="">$ <?php echo number_format($number, 0, ',','.');?>

<input type="number" value="<?php echo $rproduct->__GET('productprice');?>" id="priceinput<?php echo $rproduct->__GET('productid');?>" style="display:none;" name="pricetobeposted[]" /disabled>

</td>


</tr>

<?php endforeach;?>





</tbody>
</table>
</div>
</div>



<script>



function search1() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("inputcompany1");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");



for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
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


}


/*sumar empieza*/
function SumarColumna(grilla, columna) {
 
    var resultVal = 0.0; 
         
   // $("#" + grilla + " tbody tr").not(':last').each(
        $("#" + grilla + " tbody tr").each(

        function() {
         
            var celdaValor = $(this).find('td:eq(' + columna + ')');
            
            if (celdaValor.val() != null)
                    resultVal += parseFloat(celdaValor.html().replace(',','.'));
                     
        } //function
         
    ) //each
    
//$("#" + grilla + " tbody tr:last td:eq(" + columna + ")").html(resultVal.toFixed(2).toString().replace('.',','));   
 
document.getElementById("result").innerHTML = resultVal.toFixed(2).toString().replace('.',',');

}   


function trigger() {

    SumarColumna('myTable', 4);


}

/*sumar termina*/


</script>



</div> <!--maindiv-->

</div> <!--colmd12-->
</div><!--row-->


</div><!--card-->

<!--Datos de oportunidad abajo-->

<div class="card1 " style="min-height: 200px;   border-radius:0px;   margin-bottom: 0;   background-image: linear-gradient(to bottom,#ffffff 0,#ffffff 100%); background-color: #fff !important; padding: 0;">
<div class="crm-offer-title"  style="padding-left:5%; font-size:18px;"><i class="fa fa-search " aria-hidden="true"></i>  Datos de la oportunidad </div>

<div class="row">

<div class="col-md-12">


<div class="maindiv" >



<div class="col-md-12" style="margin-bottom:20px;">

<strong>Indique los datos correspondientes a esta oportunidad</strong> 



<div class="form-group"> 
    <div class="col-md-6 selectContainer" style="margin-top:15px;">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-info-circle fa-lg" aria-hidden="true"></i></span>
    <select name="statusoftheprospect" id="statusoftheprospect" class="form-control selectpicker" required>
      <option value="">Seleccionar</option>
   
      <?php foreach($model->getstatus_prospect() as $rmeta): ?> 

      <?php if (($rmeta->__GET('metavalue') <'51') && ($rmeta->__GET('metavalue') >'24')){?>
<option value="<?php echo $rmeta->__GET('metavalue');?>"  <?php echo $rmeta->__GET('metavalue') == '50' ? 'selected' : '';?>><?php echo $rmeta->__GET('metatitle');?> (<?php echo $rmeta->__GET('metavalue');?>%) - <?php echo $rmeta->__GET('metavalue') == '50' ? '(Por defecto)' : '';?></option>
      <?php } ?>


<?php endforeach;?>


    </select>
  </div>
</div>
</div>

</div><!--col-md-12 arriba de form-group-->


<div class="col-md-12" style="margin-bottom:20px;">
<strong>Indique el tipo de actividad a realizar</strong> 



<div class="form-group"> 
    <div class="col-md-6 selectContainer" style="margin-top:15px;">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-tasks fa-lg" aria-hidden="true"></i></span>
    <select name="tasktodo" id="tasktodo" class="form-control selectpicker">
      <option value="" selected>Seleccionar</option>
   
<option value="Llamada">Llamada</option>
<option value="Correo electrónico">Correo electrónico</option>
<option value="Reunión">Reunión</option>
<option value="Tarea">Tarea</option>
<option value="">Ninguna</option>
    </select>
  </div>
</div>
</div>

<script>
$(function(){
 $('#tasktodo').change(function(){

    if(document.getElementById("tasktodo").value != ""){

$('#divtoshow').show( "slow" );

    } else {

$('#divtoshow').hide( "slow" );

    }

});
});

</script>


</div>


<div class="col-md-12" id="divtoshow" style="margin-bottom:20px; display:none;">
<strong>Datos de la tarea</strong> 
<br>
<br>




<div class="row ">


  <div class="col-md-6 inputGroupContainer" style="margin-top: 10px;">
  <div class="input-group">

  <span class="input-group-addon"><i class="fa fa-info-circle fa-lg"></i></span>
  <input type="text" name="taskasunto" id="taskasunto" placeholder="Asunto" value="" max-length="50" class="form-control"/>
  
    </div>
  </div>

<?php

$fechaFFase = date("Y-m-d", time());
$nuevafecha = new DateTime($fechaFFase);
$nuevafecha->modify('+1 day');
//echo $nuevafecha->format('Y-m-d');

//echo date("Y-m-d", time());


?>

  <div class="col-md-6 inputGroupContainer" style="margin-top: 10px;">
  <div class="input-group">

  <span class="input-group-addon"><i class="fa fa-clock-o fa-lg"></i></span>
  <input type="datetime-local" style="    width: auto; max-width: 170px; font-size: 11px; letter-spacing: -1px;  padding: 0px; padding-left: 5px;" name="date_limitasunto" id="date_limitasunto" value="<?php echo $nuevafecha->format('Y-m-d');?>T<?php echo "15:00";?>" class="form-control"/>
    </div>
  </div>





</div> <!--row-->

<div class="row ">

<div class="form-group">
<div class="col-md-12 inputGroupContainer">
<br><strong>Descripción:</strong>
<textarea  name="taskdescription"  style="height: auto !important;" id="contactnotes" class="form-control"  rows="5" maxlegth="250"></textarea>
</div>
</div>

</div> <!--row-->
</div><!--col-md-12> -->


<div class="col-md-12" style="margin-bottom:20px;">

<strong>Seleccione ejecutivo responsable del prospecto</strong> 



<div class="form-group"> 
    <div class="col-md-6 selectContainer" style="margin-top:15px;">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-black-tie fa-lg" aria-hidden="true"></i></span>
    <select name="responsableofprospect" id="responsableofprospect" class="form-control selectpicker" required >
      <option value="">Seleccionar</option>
   
<?php foreach($model->selectall() as $r): ?>

<option value="<?php echo $r->__GET('id'); ?>" <?php echo $r->__GET('id') == $varresp ? 'selected' : '';?>><?php echo $r->__GET('name'); echo " "; echo $r->__GET('lastname');?></option>
<?php endforeach;?>
    </select>
  </div>
</div>
</div>
<br>
<br>
<div class="col-md-12">
<p><strong>Nota:</strong>  El ejecutivo responsable por defecto será el seleccionado anteriormente para la empresa.</p>
</div>


</div><!--col-md-12 arriba de form-group-->


<div class="col-md-12" style="margin-bottom:20px;">

<strong>Notas o aspectos de interés para el prospecto</strong> 
<br><br>
<!-- Text input-->
<div class="form-group">
    <div class="col-md-12 inputGroupContainer">    
  <textarea  name="prospectnotes" style="height: auto !important;" id="prospectnotes" class="form-control"  rows="5" maxlegth="250"></textarea>
  </div>
</div>


</div><!--col-md-12 arriba de form-group-->

<div class="col-md-12" style="margin-bottom:20px; margin-top:60px;">
<div class="row" >
<div class="col-sm-6" style="text-align:center; margin-bottom: 10px;">
<a type="button" class="btn btn-danger" href="<?php echo $homeurl."pages/opportunities".$session;?>" ><i class="fa fa-arrow-circle-o-left fa-lg"></i> Cancelar</a>
</div>
<div class="col-sm-6" style="text-align:center;  margin-bottom: 10px;">
<button type="button" class="btn btn-success" name="addprospect" id="addprospect" >Agregar <i class="fa fa-plus-circle fa-lg"></i></button>

<input type="text" value="submit" name="addprospect" style="display:none;"/>

</div>
</div>
</div>

<script>

$( '#addprospect' ).on( 'click', function() {
    if( $('.classcheckbox').is(':checked') ){
       // alert("SI");


//Check status
       if( $('#statusoftheprospect').val() != "" ){
       // alert("SI");


//checkresponsable
       if( $('#responsableofprospect').val() != "" ){
       // alert("SI");

       $('#prospectsform').submit();

    } else {
        alert("Debe seleccionar el ejecutivo responsable");
    }


    } else {
        alert("Debe indicar el estado de esta oportunidad");
    }



    } else {
        alert("Debe seleccionar por lo menos 1 producto para continuar.");
    }


});


</script>




</div> <!--maindiv-->

</div> <!--colmd12-->
</div><!--row-->


</div><!--card-->

<!-- datos de oportunidad arriba -->

<?php } ?>


</form>






               <!-- NUEVO PROSPECTO termina arriba-->


            </div>
          <!-- Termina 1er tab hacia arriba -->

          <!-- comienza 2do tab hacia abajo -->




          <?php if(isset($_GET['action'])) { ?>
                    <?php if ((($_GET['action'])=="viewprospects")) { ?>
                      <div class="tab-pane fade in active" id="viewall">
                      <?php } else { ?>
                        <div class="tab-pane fade in" id="viewall">
                        <?php } ?>
                  <?php } else { ?>
                    <div class="tab-pane fade in" id="viewall">

                    <?php } ?>

               

                 

<div class="col-md-6" style="text-align:right;">

<div class="form-group" style="width:100%">
  <div class="col-md-12 inputGroupContainer" style="padding:0px;">
  <div class="input-group">
  <span class="input-group-addon"><i class="fa fa-search"></i></span>
  <input  name="inputprospect" id="inputprospect" onkeyup="search();" placeholder="Buscar prospecto por nombre o empresa"  class="form-control" autocomplete="off" type="text">
    </div>
  </div>
</div>


<script>

function search() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("inputprospect");
  filter = input.value.toUpperCase();
  table = document.getElementById("table_contacts");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2]; 


    if (td) {

      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";


      } else {

        tr[i].style.display = "none";

      }
    }       
  }
}


</script>



</div><!--col-md-6-->

<div class="col-md-6" style="text-align:right;">
<!--filtro aqui -->

<div class="form-group"> 
    <div class="col-md-12 selectContainer" style="padding:0px;">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-info-circle fa-lg" aria-hidden="true"></i></span>
    <select name="filterforprospects" id="filterforprospects" class="form-control selectpicker" required>
      <option value="<?php echo $homeurl."pages/opportunities".$session."&action=viewprospects";?>">Ver todos</option>
   
<?php foreach($model->getstatus_prospect() as $rmeta): ?> 

<?php if(isset($_GET['status'])){?>
<option value="<?php echo $homeurl."pages/opportunities".$session."&action=viewprospects&status=";?><?php echo $rmeta->__GET('metavalue');?>"  <?php echo $rmeta->__GET('metavalue') == $_GET['status'] ? 'selected' : '';?>><?php echo $rmeta->__GET('metatitle');?> (<?php echo $rmeta->__GET('metavalue');?>%)</option>
<?php } else { ?>
<option value="<?php echo $homeurl."pages/opportunities".$session."&action=viewprospects&status=";?><?php echo $rmeta->__GET('metavalue');?>"><?php echo $rmeta->__GET('metatitle');?> (<?php echo $rmeta->__GET('metavalue');?>%)</option>
<?php }?>

<?php endforeach;?>


    </select>
  </div>
</div>
</div>

</div><!--col-md-6-->


<script>
    $(function(){
      // bind change event to select
      $('#filterforprospects').on('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });
</script>




<div class="panel-body col-md-12" id="tablediv_contacts" >

<table id="table_contacts" class="table table-bordered" cellspacing="0" style=" border-collapse: collapse; width:100%;">

<thead id="head_contacttable">
<tr>
  <th style="text-align:center; max-width: 80px; min-width: 70px;  width: 80px; ">ID </th>
    <th style="min-width: 260px;  max-width: 280px;" colspan=3>Prospecto </th>
    <th style="    min-width: 300px; max-width: 300px; width: 300px;">Tarea </th>
    <th style="    min-width: 180px;  max-width: 180px; width: 180px; text-align:center;">Estado  </th>
    <th style="min-width:160px; max-width: 160px; width: 160px; text-align:center;">Total  </th>
</tr>
</thead>


  <tbody>
  
<?php $varcontrol = 0;?>

  <?php foreach($model->getprospectsandtasks() as $rprospects1): ?>
            <tr class="tr-table">

            <!-- id prospecto -->
                    <td class="td-table" style="text-align:center;"><?php echo $rprospects1->__GET('prospectid');?><input style="margin-left:4px;" type="checkbox" value="<?php echo $rprospects1->__GET('prospectid');?>" /></td>
                  
            
                  <!-- datos del prospecto -->

<td class="td-table" style="width:60px; text-align:center;">
<div  style=" width:30px !important; max-width: 60px; height: 20px; text-align:center;">
<div id="imgdiv30" class="imgdiv30" style="margin-bottom: 0px;" >
<?php if ($rprospects1->__GET('imgcontact') == "") { ?>
<img id="contact_img30" class="imgrounded30" src="../../<?php echo $_SESSION['install_page'];?>/images/default/default.png" />
<?php } else { ?>
  <img id="contact_img30" class="imgrounded30" src="../../<?php echo $_SESSION['install_page'];?>/images/contacts/<?php echo $rprospects1->__GET('imgcontact');?>" />
<?php } ?>
</div>     
</div>  
<br>
<div  style=" width:30px !important; max-width: 60px; text-align:center;">
<a href="<?php echo $homeurl."pages/opportunities".$session."&action=checkingprospects&prospectid=".$rprospects1->__GET('prospectid');?>">Ver</a>
</div>
</td>
                    <td class="td-table">
                    <div class="row">
                  <div class="col-md-9" style="width:75% !important; float:left;">  
                 <p> <?php echo $rprospects1->__GET('namecontact');?> <?php echo $rprospects1->__GET('lastnamecontact');?>
                  <br> <span style="margin:0px !important;"> Empresa: <?php echo $rprospects1->__GET('companyname');?> </span>
                <br><span style="font-size: 11px; margin:0px !important;">Cargo: <?php echo $rprospects1->__GET('chargecontact'); ?>
                <br><i style="margin-right:4px;" class="fa fa-phone"></i> <?php echo $rprospects1->__GET('phonecontact'); ?>
                <br><i style="margin-right:4px;" class="fa fa-envelope-o"></i> <?php echo $rprospects1->__GET('emailcontact'); ?>
        </span> </p>
              </div>
                    </div> <!--row-->
                    </td>

               <td class="td-table">
</td>


                  
                  <!-- empresa 

                    <td class="td-table"><?php// echo $rprospects1->__GET('companyname');?></td> -->

                    <!--tarea -->
                    <td class="td-table">

                    <?php if($rprospects1->__GET('status_prospect') != "100") { ?>

                    <?php if ($rprospects1->__GET('has_tasks_prospect') == '0') { ?>

                   <p> No posee tareas asignadas </p>
                    
                    <?php } else { ?>
                    
          <?php foreach($model->gettasksfromprospect($rprospects1->__GET('prospectid')) as $rprospects2): ?>

                 <p> <strong>Actividad:</strong> <?php echo $rprospects1->__GET('has_tasks_prospect');?>
                    <br> <strong>Fecha actividad: </strong> <?php echo $rprospects2->__GET('tasklimitdate');?>
                    <br> <strong>Asunto: </strong> <?php echo $rprospects2->__GET('taskname');?>
                    <br> <strong> Descripción: </strong> <?php echo $rprospects2->__GET('taskdescrip');?>
                 </p>

          <?php endforeach;?>

                    <?php } ?>

                    <?php }else { ?>
                 



 <?php foreach($model->getcuotesucceeded($rprospects1->__GET('prospectid')) as $rcuotes2): ?> 
 <div style="font-size:11px;">El prospecto tomó cotización Nro.  <?php if($rcuotes2->__GET('succeeded') == 1){ ?>
                    <?php echo $rcuotes2->__GET('cuotesid');?> 
                      por <span style="background-color:#f7eb5b;">$ <?php echo number_format($rcuotes2->__GET('totalcuote'),0, ',','.');?> </span>
                      el 	<?php echo $rcuotes2->__GET('cuotedate');?>

                      </div>
                  <?php } ?>

<?php endforeach;?>


                    <?php } ?>

                    </td>

<!--progress bar estado de oportunidad -->
                    <td class="td-table">
                    <div class="progress" style="border-radius: 0px; cursor: pointer;" data-toggle="tooltip" data-placement="right" title="<?php echo $rprospects1->__GET('metatitle');?>">
                   
                   <?php if($rprospects1->__GET('status_prospect') == "50"){ ?>
                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?php echo $rprospects1->__GET('status_prospect');?>" aria-valuemin="1" aria-valuemax="100" style="width:<?php echo $rprospects1->__GET('status_prospect');?>%">
                    <?php } elseif($rprospects1->__GET('status_prospect') == "25") { ?>
                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php echo $rprospects1->__GET('status_prospect');?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $rprospects1->__GET('status_prospect');?>%">

                   <?php } elseif($rprospects1->__GET('status_prospect') >= "75") { ?>
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $rprospects1->__GET('status_prospect');?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $rprospects1->__GET('status_prospect');?>%">

                    <?php } elseif($rprospects1->__GET('status_prospect') >= "0") { ?>
                    <div style="color:#000;"  class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php echo $rprospects1->__GET('status_prospect');?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $rprospects1->__GET('status_prospect');?>%">

                   <?php } ?>   

                   

                        <?php echo $rprospects1->__GET('status_prospect');?>% 
                    </div>
                    </div>

      
                    </td>


<!-- total oportunidad -->
                    <td class="td-table" style="text-align:center;">$ <?php echo number_format($rprospects1->__GET('totalprice'),0,',','.');?></td>


</tr>

<?php $varcontrol = $rprospects1->__GET('rowcount');?>


    <?php endforeach; ?>

    <?php if($varcontrol=='0'){?>

<tr  >
<td style="border: 0px solid #fff;" colspan="7">No se han encontrado resultados para su busqueda...</td>
</tr>

    <?php } ?>



  </tbody>
</table>


</div>

            </div>
          <!-- Termina 2do tab hacia arriba -->

     <!-- comienza 3er tab hacia abajo -->



      
     <?php if(isset($_GET['action'])) { ?>
                    <?php if ((($_GET['action'])=="checkingprospects")) { ?>
                      <div class="tab-pane fade in active" id="check">
                      <?php } else { ?>
                      <div class="tab-pane fade in" id="check">
                      <?php } ?>
                  <?php } else { ?>
                    <div class="tab-pane fade in" id="check">
                    <?php } ?>
<!-- empieza abajo checkprospect -->                





<style>
#company_form, #cuotes_form, #formtosubmitcuote{
background-image: linear-gradient(to bottom,#ffffff 0,#f5f5f5 100%);
color: #88898c;
    font-size: 14px;
}
</style>



<div class="col-md-12" >
<div class="crm-offer-title" style="padding-left:5%;">
<i class="fa fa-user-plus " aria-hidden="true"></i><strong>  Detalle del prospecto</strong>
</div>


    <form class="well form-horizontal" action="" method="post" id="company_form" enctype="multipart/form-data" >
<fieldset>

<div class="row">
<div class="col-md-12">

<div class="col-md-5">

<?php foreach($model->getprospectsandtasks() as $rprospects1): ?>

<strong> Datos del prospecto </strong> <input type="text" style="display:none;" name="prospectidtobeupdated" value="<?php echo $rprospects1->__GET('prospectid');?>" />

<br><br>

<div id="imgdiv" class="imgdiv" style="margin-bottom: 15px;" >
<?php if ($rprospects1->__GET('imgcontact') == "") { ?>
<img id="contact_img" class="imgrounded" src="../../<?php echo $_SESSION['install_page'];?>/images/default/default.png" />
<?php } else { ?>
  <img id="contact_img" class="imgrounded" src="../../<?php echo $_SESSION['install_page'];?>/images/contacts/<?php echo $rprospects1->__GET('imgcontact');?>" />
<?php } ?>
</div>     



               <div class="paddingH-md10"> 
                <br> Nombre: <?php echo $rprospects1->__GET('namecontact');?> <?php echo $rprospects1->__GET('lastnamecontact');?>               
                <br><i style="margin-right:4px;" class="fa fa-phone"></i> <?php echo $rprospects1->__GET('phonecontact'); ?>
                <br><i style="margin-right:4px;" class="fa fa-envelope-o"></i> <?php echo $rprospects1->__GET('emailcontact'); ?>
                <br> <strong>Empresa:</strong> <?php echo $rprospects1->__GET('companyname');?> 
                <br><strong> Cargo:</strong> <?php echo $rprospects1->__GET('chargecontact'); ?>
                <br> 
                
               

<?php if ( ($_GET['rol'] =="ADMIN" ) || ($_GET['activeuser'] == $rprospects1->__GET('responsable')) ) { ?>
               
                <div class="form-group"> 
                <div class="col-md-12 selectContainer" style="margin-top:15px;">
                <div class="input-group">
                    <span class="input-group-addon"><strong>Responsable: </strong> </span>
                <select name="responsableofprospecttoupdate" id="responsableofprospecttoupdate" class="form-control selectpicker" <?php echo $rprospects1->__GET('status_prospect') == '100' ? 'disabled' : 'required';?> <?php echo $rprospects1->__GET('status_prospect') == '0' ? 'disabled' : '';?>>

               
                  <?php foreach($model->selectall() as $r): ?>
            
            <option value="<?php echo $r->__GET('id'); ?>" <?php echo $r->__GET('id') == $rprospects1->__GET('responsable') ? 'selected' : '';?>><?php echo $r->__GET('name'); echo " "; echo $r->__GET('lastname');?></option>
            <?php endforeach;?>
                </select>
              </div>
            </div>
            </div>

                <?php } else { ?>

  <strong>Responsable: </strong> </i> <?php echo $rprospects1->__GET('responsable_prospectname'); ?> <?php echo $rprospects1->__GET('responsable_prospectlastname'); ?>

                <?php } ?>

                <br>  <br> <strong>Estado:</strong> <div class="progress" style="border-radius: 0px; cursor: pointer;" data-toggle="tooltip" data-placement="right" title="<?php echo $rprospects1->__GET('metatitle');?>">      
                   <?php if($rprospects1->__GET('status_prospect') == "50"){ ?>
                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?php echo $rprospects1->__GET('status_prospect');?>" aria-valuemin="1" aria-valuemax="100" style="width:<?php echo $rprospects1->__GET('status_prospect');?>%">
                    <?php } elseif($rprospects1->__GET('status_prospect') == "25") { ?>
                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php echo $rprospects1->__GET('status_prospect');?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $rprospects1->__GET('status_prospect');?>%">

                   <?php } elseif($rprospects1->__GET('status_prospect') >= "75") { ?>
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $rprospects1->__GET('status_prospect');?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $rprospects1->__GET('status_prospect');?>%">

                    <?php } elseif($rprospects1->__GET('status_prospect') >= "0") { ?>
                    <div style="color:#000;"  class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php echo $rprospects1->__GET('status_prospect');?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $rprospects1->__GET('status_prospect');?>%">

                   <?php } ?>   
                        <?php echo $rprospects1->__GET('status_prospect');?>%  <?php echo $rprospects1->__GET('metatitle');?>
</div>
</div>
              </div>

                  
         



<?php endforeach;?>






<div class="paddingH-md10"> 


<?php if(($rprospects1->__GET('status_prospect') != '0') && ($rprospects1->__GET('status_prospect') < '75')) { ?>


  <div class="form-group"> 
    <div class="col-md-12 selectContainer" id="margin25768" style="margin-top:15px;">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-info-circle fa-lg" aria-hidden="true"></i></span>
    <select name="updatestatus" id="updatestatus" class="form-control selectpicker" required>
   
      <?php foreach($model->getstatus_prospect() as $rmeta): ?> 

      <?php if (($rmeta->__GET('metavalue') <'51') && ($rmeta->__GET('metavalue') >'24')){?>



      
<option value="<?php echo $rmeta->__GET('metavalue');?>" <?php echo $rmeta->__GET('metavalue') == $rprospects1->__GET('status_prospect') ? 'selected' : '';?>><?php echo $rmeta->__GET('metatitle');?> (<?php echo $rmeta->__GET('metavalue');?>%) </option>
      <?php } ?>


<?php endforeach;?>


    </select>
  </div>
</div>
</div>

      <?php } ?>

      </div><!--paddingH-md10-->



      <!-- TASKS-->
      <?php if(($rprospects1->__GET('status_prospect') > '0') && ($rprospects1->__GET('status_prospect') < '100')){ ?>

<?php if ($rprospects1->__GET('has_tasks_prospect') != '0') { ?>


<?php foreach($model->gettasksfromprospect(isset($_GET['prospectid']) ? $_GET['prospectid'] : '')  as $rprospects2): ?>



<div class="paddingH-md10"> 





<strong> Tarea de seguimiento asignada  <i class="fa fa-info-circle fa-lg" style="margin-left:5px; cursor:pointer;" data-toggle="tooltip" data-placement="right" title='Para eliminar una tarea debe seleccionar la opción de "Ninguna y actualizar"'></i> </strong>
<br><br>

<div class="col-md-12 inputGroupContainer" style=" margin-bottom: 15px; padding-left: 0px;
    padding-right: 0px;">
  <div class="input-group">

  <input type="text" style="display:none;" name="taskid" id="taskid" value="<?php echo $rprospects2->__GET('taskid');?>" />
    </div>
  </div>


<div class="form-group"> 
    <div class="col-md-12 selectContainer" >
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-tasks fa-lg" aria-hidden="true"></i></span>
    <select name="tasktodo1" id="tasktodo1" class="form-control selectpicker">
      <option value="" selected>Seleccionar</option>
   
<option value="Llamada" <?php echo $rprospects1->__GET('has_tasks_prospect') == 'Llamada' ? 'Selected': '';?>>Llamada</option>
<option value="Correo electrónico" <?php echo $rprospects1->__GET('has_tasks_prospect') == 'Correo electrónico' ? 'Selected': '';?>>Correo electrónico</option>
<option value="Reunión" <?php echo $rprospects1->__GET('has_tasks_prospect') == 'Reunión' ? 'Selected': '';?>>Reunión</option>
<option value="Tarea" <?php echo $rprospects1->__GET('has_tasks_prospect') == 'Tarea' ? 'Selected': '';?>>Tarea</option>
<option value="">Ninguna</option>
    </select>
  </div>
</div>
</div>


<script>
$(function(){
 $('#tasktodo1').change(function(){

    if(document.getElementById("tasktodo1").value != ""){

$('#divtoshow1').show( "slow" );

    } else {

$('#divtoshow1').hide( "slow" );

    }

});
});

</script>


<div id="divtoshow1">

  <div class="col-md-12 inputGroupContainer" style=" margin-bottom: 15px; padding-left: 0px;
    padding-right: 0px;">
  <div class="input-group">
  <span class="input-group-addon"><i class="fa fa-info-circle fa-lg"></i></span>
  <input type="text" name="taskasunto1" id="taskasunto1" placeholder="Asunto" value="<?php echo $rprospects2->__GET('taskname');?>" max-length="50" class="form-control"/>
    </div>
  </div>

<?php
//echo $rprospects2->__GET('tasklimitdate');


//$fechaFFase = date("Y-m-d", );
$nuevafecha = new DateTime($rprospects2->__GET('tasklimitdate'));



//$nuevafecha->modify('+1 day');
//echo $nuevafecha->format('Y-m-d');

//echo date("Y-m-d", time());


?>
<br> <strong>Fecha actividad: </strong> 
  <div class="col-md-12 inputGroupContainer" style="margin-bottom: 15px;  padding-left: 0px;
    padding-right: 0px;">
  <div class="input-group">

  <span class="input-group-addon"><i class="fa fa-clock-o fa-lg"></i></span>
  <input type="datetime-local" style="    width: auto; max-width: 170px; font-size: 11px; letter-spacing: -1px;  padding: 0px; padding-left: 5px;" name="date_limitasunto1" id="date_limitasunto1" value="<?php echo $nuevafecha->format('Y-m-d');?>T<?php echo $nuevafecha->format('H:i');?>" min=<?php echo date("Y-m-d", time())."T".date("H:i", time());?> class="form-control"/>
    </div>
  </div>





<div class="form-group">
<div class="col-md-12 inputGroupContainer">
<strong>Descripción:</strong>
<textarea  name="taskdescription1"  style="height: auto !important;" id="contactnotes1" class="form-control"  rows="5" maxlegth="250"><?php echo $rprospects2->__GET('taskdescrip');?></textarea>
</div>
</div>


</div>


</div>

<?php endforeach;?>


<br><br>

<?php } else { ?>

<!--SIN TAREAS AHORA NUEVA -->

<div class="paddingH-md10"> 

<strong> Tarea de seguimiento asignada <i class="fa fa-info-circle fa-lg" style="margin-left:5px; cursor:pointer;" data-toggle="tooltip" data-placement="right" title='Para agregar una tarea debe escogerla en el menu siguiente, rellenar los datos y actualizar"'></i> </strong>
<br><br>


<input type="text" style="display:none;" name="taskidnew" id="taskidnew" value="ok" />


<div class="form-group"> 
    <div class="col-md-12 selectContainer" >
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-tasks fa-lg" aria-hidden="true"></i></span>
    <select name="tasktodo1" id="tasktodo1" class="form-control selectpicker">
    <option value="" selected>Ninguna</option>
<option value="Llamada" >Llamada</option>
<option value="Correo electrónico" >Correo electrónico</option>
<option value="Reunión" >Reunión</option>
<option value="Tarea">Tarea</option>

    </select>
  </div>
</div>
</div>


<script>
$(function(){
 $('#tasktodo1').change(function(){

    if(document.getElementById("tasktodo1").value != ""){

$('#divtoshow1').show( "slow" );

    } else {

$('#divtoshow1').hide( "slow" );

    }

});
});

</script>


<div id="divtoshow1" style="display:none;">

  <div class="col-md-12 inputGroupContainer" style=" margin-bottom: 15px; padding-left: 0px;
    padding-right: 0px;">
  <div class="input-group">
  <span class="input-group-addon"><i class="fa fa-info-circle fa-lg"></i></span>
  <input type="text" name="taskasunto1" id="taskasunto1" placeholder="Asunto" value="" max-length="50" class="form-control"/>
    </div>
  </div>

<?php
$fechaFFase = date("Y-m-d", time());
$nuevafecha = new DateTime($fechaFFase);
$nuevafecha->modify('+1 day');

?>


<br> <strong>Fecha actividad: </strong> 
  <div class="col-md-12 inputGroupContainer" style="margin-bottom: 15px;  padding-left: 0px;
    padding-right: 0px;">
  <div class="input-group">

  <span class="input-group-addon"><i class="fa fa-clock-o fa-lg"></i></span>
  <input type="datetime-local" style="    width: auto; max-width: 170px; font-size: 11px; letter-spacing: -1px;  padding: 0px; padding-left: 5px;"name="date_limitasunto1" id="date_limitasunto1" value="<?php echo $nuevafecha->format('Y-m-d');?>T<?php echo "15:00";?>" min=<?php echo date("Y-m-d", time())."T".date("H:i", time());?> class="form-control"/>
    </div>
  </div>

<div class="form-group">
<div class="col-md-12 inputGroupContainer">
<strong>Descripción:</strong>
<textarea  name="taskdescription1"  style="height: auto !important;" id="contactnotes1" class="form-control"  rows="5" maxlegth="250"></textarea>
</div>
</div>

</div>
</div>

<?php } ?>

<?php } ?>


</div> <!-- col-md- 5 -->


<div class="col-md-7" >

<strong>Productos de interés para el prospecto</strong> <i class="fa fa-info-circle fa-lg" style="margin-left:5px; cursor:pointer;" data-toggle="tooltip" data-placement="right" title='Haga click en el ID del prospecto para habilitar la edición'></i>

<br>
<br>

<!-- empieza tabla de productos-->

<div class="col-md-12 panel-body" style="padding: 0;     height: 250px; margin-bottom:0px !important;" >
    <table id="myTable" class="table table-bordered" cellspacing="0" style=" border-collapse: collapse; width:100%; margin-bottom:0px !important;">
 <thead style="background-color: rgba(228, 228, 228, 0.7);">
 <th style="    min-width: 50px;">
 ID
 </th>
 <th style="    min-width: 190px;">
 Producto
 </th>
 <!--<th style="    min-width: 140px;">
 Categoria
 </th>-->
 <th style="    min-width: 120px;">
Cantidad
 </th>
 
 <th style="    min-width: 150px; width::150px !important;">
Descuento
 </th>
 <th style="    min-width: 140px; width:140px !important;">
 Precio unitario
 </th>


 <th style="    min-width: 120px; width:120px !important;">
Sub-total
 </th>
</thead>
<tbody  >

<?php if(isset($_GET['prospectid'])){ ?>

<?php foreach($model->getpp2fromprospect($_GET['prospectid']) as $rprospects3): ?>

             
<tr >
<td> <?php echo $rprospects3->__GET('pp2_productid');?><input  value="<?php echo $rprospects3->__GET('pp2_productid');?>" id="check<?php echo $rprospects3->__GET('pp2_productid');?>" name="idproducttobeprospected1[]" style="margin-left: 3px;"  class="classcheckbox1" type="checkbox"/ <?php echo $rprospects1->__GET('status_prospect') == '100' ? 'disabled' : '';?><?php echo $rprospects1->__GET('status_prospect') == '0' ? 'disabled' : '';?>></td>
<td> <?php echo $rprospects3->__GET('productname');?>
<br><p style="font-size:11px;"><strong> Categoría: </strong><?php echo $rprospects3->__GET('productcategory');?>
<br> <strong> Existencia actual: </strong>
<?php if($rprospects3->__GET('producthas_quant') == 1){ ?>
    <?php if ($rprospects3->__GET('productquantity') <= $rprospects3->__GET('critical_quant')) {?>
        <span  style="color: #ca3b37;  font-weight: 900;"><?php echo  $rprospects3->__GET('productquantity'); ?></span>
    <?php } else {?>
 <?php echo  $rprospects3->__GET('productquantity'); ?>
        <?php } ?>
<?php } else {?>
No aplica
<?php } ?>
</p>
</td>



 


<td>
<?php if($rprospects3->__GET('producthas_quant') == 1){ ?>
<input name="quantityproforpros1[]" style="width: 50px;" type="number" id="quant<?php echo $rprospects3->__GET('pp2_productid');?>" min=0 max="<?php echo $rprospects3->__GET('productquantity');?>" onblur="notmore<?php echo $rprospects3->__GET('pp2_productid');?>();" onKeypress="if (event.keyCode < 47 || event.keyCode > 57) event.returnValue = false;" value="<?php echo $rprospects3->__GET('pp2_quantity');?>"/ disabled>
<script>
var valueinv<?php echo $rprospects3->__GET('pp2_productid');?> = "<?php echo  $rprospects3->__GET('productquantity'); ?>";
function notmore<?php echo $rprospects3->__GET('pp2_productid');?>(){
    if( parseInt(document.getElementById("quant<?php echo $rprospects3->__GET('pp2_productid');?>").value) > parseInt(valueinv<?php echo $rprospects3->__GET('pp2_productid');?>)) {
alert("No existe suficiente stock para este producto");
$('#quant<?php echo $rprospects3->__GET('pp2_productid');?>').val('<?php echo $rprospects3->__GET('pp2_quantity');?>');
  }
}
$(function(){
 $('#check<?php echo $rprospects3->__GET('pp2_productid');?>').click(function(){
    if(valueinv<?php echo $rprospects3->__GET('pp2_productid');?> == 0){
alert("El producto que desea agregar no posee inventario suficiente");
$('#check<?php echo $rprospects3->__GET('pp2_productid');?>').attr('checked', false);
  } else {
  if (document.getElementById("check<?php echo $rprospects3->__GET('pp2_productid');?>").checked == true) {
$('#quant<?php echo $rprospects3->__GET('pp2_productid');?>').attr('disabled', false);
    $('#quant<?php echo $rprospects3->__GET('pp2_productid');?>').val('<?php echo $rprospects3->__GET('pp2_quantity');?>');
$('#myRange<?php echo $rprospects3->__GET('pp2_productid');?>').attr('disabled', false);
$('#priceinput<?php echo $rprospects3->__GET('pp2_productid');?>').attr('disabled', false);
}else{
    $('#quant<?php echo $rprospects3->__GET('pp2_productid');?>').attr('disabled', true);
    $('#quant<?php echo $rprospects3->__GET('pp2_productid');?>').val('<?php echo $rprospects3->__GET('pp2_quantity');?>');
    $('#myRange<?php echo $rprospects3->__GET('pp2_productid');?>').attr('disabled', true);
    $('#myRange<?php echo $rprospects3->__GET('pp2_productid');?>').val('<?php echo $rprospects3->__GET('pp2_discount');?>');
    $('#demo<?php echo $rprospects3->__GET('pp2_productid');?>').html('<?php echo $rprospects3->__GET('pp2_discount');?>%');
    $('#priceinput<?php echo $rprospects3->__GET('pp2_productid');?>').attr('disabled', true);
}
 }
});
});
</script>
<?php } else { ?>
  



  <input style="display:none;"  name="quantityproforpros1[]" style="width: 50px;" type="number" id="quant<?php echo $rprospects3->__GET('pp2_productid');?>" min=1 max=1  value="1"/ disabled>
No Aplica (1)
<script>
var valueinv<?php echo $rprospects3->__GET('pp2_productid');?> = "1";
$(function(){
   

  $('#check<?php echo $rprospects3->__GET('pp2_productid');?>').click(function(){
     if (document.getElementById("check<?php echo $rprospects3->__GET('pp2_productid');?>").checked == true) {

      $('#quant<?php echo $rprospects3->__GET('pp2_productid');?>').attr('disabled', false);
       $('#quant<?php echo $rprospects3->__GET('pp2_productid');?>').val('1');
   $('#myRange<?php echo $rprospects3->__GET('pp2_productid');?>').attr('disabled', false);
   $('#priceinput<?php echo $rprospects3->__GET('pp2_productid');?>').attr('disabled', false);

   }else{
      
    $('#quant<?php echo $rprospects3->__GET('pp2_productid');?>').attr('disabled', true);
       $('#quant<?php echo $rprospects3->__GET('pp2_productid');?>').val('1');
       $('#myRange<?php echo $rprospects3->__GET('pp2_productid');?>').attr('disabled', true);
       $('#myRange<?php echo $rprospects3->__GET('pp2_productid');?>').val('<?php echo $rprospects3->__GET('pp2_discount');?>');
       $('#demo<?php echo $rprospects3->__GET('pp2_productid');?>').html('<?php echo $rprospects3->__GET('pp2_discount');?>%');
       $('#priceinput<?php echo $rprospects3->__GET('pp2_productid');?>').attr('disabled', true);


   }
   });



   });
</script>






<?php } ?>
</td>




<td>
<div id="slidecontainer">
  <input style="margin-top:3%; margin-bottom:5%;" type="range" scale="5" min="0" max="100" value="<?php echo $rprospects3->__GET('pp2_discount');?>" class="slider" id="myRange<?php echo $rprospects3->__GET('pp2_productid');?>" name="rangediscount1[]" disabled>
 <p>Descuento: <span id="demo<?php echo $rprospects3->__GET('pp2_productid');?>"></span></p>
</div>
<script>
var slider<?php echo $rprospects3->__GET('pp2_productid');?> = document.getElementById("myRange<?php echo $rprospects3->__GET('pp2_productid');?>");
var output<?php echo $rprospects3->__GET('pp2_productid');?> = document.getElementById("demo<?php echo $rprospects3->__GET('pp2_productid');?>");
output<?php echo $rprospects3->__GET('pp2_productid');?>.innerHTML = (slider<?php echo $rprospects3->__GET('pp2_productid');?>.value)+"%";
slider<?php echo $rprospects3->__GET('pp2_productid');?>.oninput = function() {
  output<?php echo $rprospects3->__GET('pp2_productid');?>.innerHTML = this.value+"%";
}
</script>
 </td>



<!--precio-->
<?php $number = $rprospects3->__GET('productprice');?>


<td >
<?php if($rprospects3->__GET('currentprice') == $rprospects3->__GET('productprice')) { ?>
$ <?php echo number_format($number, 0,',','.');?>

<?php } else { ?>
<div style="    font-size: 11px;">
Anterior: $ <?php echo number_format($rprospects3->__GET('currentprice'), 0 , ',','.');?><br>
Actual: $ <?php echo number_format($number, 0,',','.');?>
</div>
<?php $varchanges = "changes were made"; ?>

<?php } ?>

<input type="number" style="display:none;" value="<?php echo $rprospects3->__GET('productprice');?>" id="priceinput<?php echo $rprospects3->__GET('pp2_productid');?>"  name="pricetobeposted1[]" /disabled>
</td>


<!--precio-->
<?php $number = $rprospects3->__GET('pp2_priceafter');?>
<td style="">$ <?php echo number_format($number, 0,',','.');?>
</td>




 </tr>

<?php endforeach;?>

<?php } ?> <!--if isset(prospectid)-->

</tbody>
</table>
</div>

<table id="myTable" class="table table-bordered" cellspacing="0" style=" border-collapse: collapse; width:100%; margin-bottom:0px;">
 <tbody style="background-color: rgba(228, 228, 228, 0.7);">

 <tr style="text-align:right;">
    <td style="width:75%;"><strong>Total:</strong></td>
    <td style="width:25%; background-color: rgba(255, 236, 3, 0.62);    min-width: 120px;">$ <strong> <?php echo number_format($rprospects1->__GET('totalprice'),0,',','.');?> </strong> </td>
  </tr>


</tbody>
</table>


<?php if ( ($_GET['rol'] =="ADMIN" ) || ($_GET['activeuser'] == $rprospects1->__GET('responsable')) ) { ?>
               
<?php if(($rprospects1->__GET('status_prospect') > '0') && ($rprospects1->__GET('status_prospect') < '100')){ ?>

<div class="panel-footer col-md-12" style="margin-bottom:30px;">

<div class="row">

<div class="col-md-6" style="margin-bottom:10px; margin-top:10px;  padding-top: 5px;" >
<a href="##" id="addproducta" style="    padding-top: 5px;">Agregar producto <i class="fa fa-plus fa-lg" style="margin-left:5px;"></i></a>
<a href="##" style="display:none;     padding-top: 5px;" id="addproductcancel">Cancelar <i class="fa fa-close fa-lg" style="margin-left:5px;"></i></a>

</div>

<div class="col-md-6" style="margin-bottom:10px; margin-top:10px;" >
<input  type="text" value="NOT" style="display:none;" name="deletepp2input" id="deletepp2input" /disabled>
<button type="button" class="btn btn-danger pull-right" name="deletepp2" id="deletepp2"  style="margin-left: 5px;" ><i class="fa fa-trash"></i> Eliminar</button> 
</div>

</div> <!--row-->
</div>

<?php } ?>

<?php } ?>

<script>
$( '#deletepp2' ).on( 'click', function() {
    if( $('.classcheckbox1').is(':checked') ){
       // alert("SI");
     $('#deletepp2input').val('delete');
     $('#deletepp2input').attr('disabled', false);

   //  alert("Selected");
     $('#company_form').submit();
    } else {
    $('#deletepp2input').val('NOT');
     $('#deletepp2input').attr('disabled', true);
        alert("Debe seleccionar por lo menos 1 producto para continuar.");
    }
});
</script>



<!-- add product to a prospect -->
<div class="paddingH-md10">


<script>
$(function(){
 $('#addproducta').click(function(){
$('#addproductdiv').show( "slow" );
$('#addproducta').hide( "slow" );
$('#addproductcancel').show( "slow" );
$('#addproducttoprospectnew').attr('disabled', false);

});
});


$(function(){
 $('#addproductcancel').click(function(){
$('#addproductdiv').hide( "slow" );
$('#addproducta').show( "slow" );
$('#addproductcancel').hide( "slow" );
$('#addproducttoprospectnew').attr('disabled', true);
});
});


</script>

</div> <!-- paddingH-md10 -->

<div class="col-md-12" style="margin-top:5px; margin-bottom:20px; display:none;" id="addproductdiv">


<div class="form-group"> 
    <div class="col-md-12 selectContainer" style="margin-top:15px;">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-tasks fa-lg" aria-hidden="true"></i></span>
    <select name="addproducttoprospectnew" id="addproducttoprospectnew" class="form-control selectpicker" autofocus disabled>
    <option value="" selected>Seleccionar</option>

<?php foreach($model->getproducts() as $rproduct): ?>
          
<option value="<?php echo $rproduct->__GET('productid'); ?>"><?php echo $rproduct->__GET('productname'); ?> (
  <?php if($rproduct->__GET('producthas_quant')== 0){ ?>
                No maneja inventario
                    <?php }else { ?>

                      <?php if($rproduct->__GET('productquantity') <= $rproduct->__GET('critical_quant')){ ?>

                    <span style="color: #ca3b37; font-weight: 900;"><?php echo $rproduct->__GET('productquantity');?> unidades disponibles</span>

                      <?php } else { ?>

                        <?php if($rproduct->__GET('productquantity') == 1){ ?>

                      <?php echo $rproduct->__GET('productquantity');?> unidad disponible

                        <?php } else { ?>

                         <?php echo $rproduct->__GET('productquantity');?> unidades disponibles

                        <?php } ?>


                      <?php } ?>

                    <?php } ?>
  )</option>

<?php endforeach; ?>

    </select>
  </div>
</div>
</div>


<button type="button" name="addpp2toprospect" id="addpp2toprospect" class="btn btn-success pull-right" >Agregar<span style="padding-left:5px;" class="fa fa-plus fa-lg"></span></button>


<script>
$( '#addpp2toprospect' ).on( 'click', function() {

if(document.getElementById('addproducttoprospectnew').value != ""){

  $('#company_form').submit();

} else {
  alert("Debe seleccionar por lo menos 1 producto para continuar.");

}


});
</script>



</div> <!--add product div -->


<?php if(isset($varchanges)){?>
<div class="alert alert-warning">
  <strong><i style="margin-right:10px;" class="fa fa-info-circle fa-lg"></i>  Ha habido cambios en el precio de uno o más productos, para actualizarlos debe seleccionar el producto y luego hacer click en el boton de actualizar.</strong>
</div>
<?php }?>

<?php echo $_GET["activeuser"] != $rprospects1->__GET("responsable") ? '<?php echo $_GET["rol"] == "ADMIN"  ? "" : "disabled";?>'  : '';?>



<div class="form-group">
<div class="col-md-12 inputGroupContainer">
<strong>Notas o aspectos de interés para el prospecto:</strong><br><br>
<textarea  name="prospectnotesimp" onclick="clearcontent();" onblur="getdefaulttext();"  style="height: auto !important;" id="prospectnotesimp" class="form-control"  rows="5" maxlegth="250" <?php echo $rprospects1->__GET('status_prospect') == '100' ? 'disabled' : '';?> <?php echo $rprospects1->__GET('status_prospect') == '0' ? 'disabled' : '';?> ><?php echo $rprospects1->__GET('prospectnotes') != '' ? $rprospects1->__GET('prospectnotes') : 'No tiene notas o aspectos de interés para el prospecto';?></textarea>
</div>
</div>

<!--termina tabla de productos -->


<script>
function clearcontent(){
document.getElementById("prospectnotesimp").value= "";
}

function getdefaulttext(){

if(document.getElementById("prospectnotesimp").value == ""){

  document.getElementById("prospectnotesimp").value= "<?php echo $rprospects1->__GET('prospectnotes') != '' ? $rprospects1->__GET('prospectnotes') : 'No tiene notas o aspectos de interés para el prospecto';?>";

}

}

</script>





 <?php if ( ($_GET['rol'] =="ADMIN" ) || ($_GET['activeuser'] == $rprospects1->__GET('responsable')) ) { ?>
               
 <?php if(($rprospects1->__GET('status_prospect') > '0') && ($rprospects1->__GET('status_prospect') < '100')){ ?>

<!-- Button -->
<div class="form-group">
  <label class="col-md-12 control-label"></label>
  <div class="col-md-12"><br>
  <a type="button" href="<?php echo $homeurl."pages/opportunities".$session."&action=viewprospects&status=".$defaultprospectsview;?>" class="btn btn-warning pull-left">Cancelar<span style="padding-left:5px;" class="fa fa-arrow-circle-o-left fa-lg"></span></a>

    <button type="submit" name="updateprospect" class="btn btn-success pull-right" >Actualizar<span style="padding-left:5px;" class="fa fa-check fa-lg"></span></button>
  </div>
</div>

 <?php } ?>
 <?php } ?>


</div> <!-- col-md-7 -->

</div> <!-- col-md-12 -->
</div> <!-- row -->



</fieldset>
</form>




    </div><!-- col-md-12 -->


<?php if (($rprospects1->__GET('status_prospect') >='75') || ($rprospects1->__GET('has_cuotes') =='1')){?>
<!--aqui tabla de cotizaciones -->


<div class="col-md-12" style="margin-bottom: 20px;">
<div class="crm-offer-title" style="padding-left:5%;">
<i class="fa fa-square-o" aria-hidden="true"></i> <strong> Cotizaciones para el prospecto</strong>  
</div>

<form class="well form-horizontal" action="" method="post" id="cuotes_form" enctype="multipart/form-data" style="margin-bottom:0px;">
<fieldset>
<div class="col-md-12" style="text-align:center;">

<input type="text" name="prospectidtobeupdated" style="display:none;" value="<?php echo $rprospects1->__GET('prospectid');?>" />



<div class="col-md-12 panel-body"  style="padding: 0;     height: 250px; margin-bottom:0px !important;" >
    <table id="myTable" class="table table-bordered" cellspacing="0" style=" border-collapse: collapse; width:100%; margin-bottom:0px !important;">
 <thead style="background-color: rgba(228, 228, 228, 0.7);">
 <th style="    min-width: 50px; wdith:50px; max-width:50px;">ID</th>
 <th style="    min-width: 120px; width:120px !important;">Fecha</th>
 <th style="    min-width: 190px; width:190px;">Prospecto</th>
 <th style="    min-width: 120px;">Total</th>
 <th style="    min-width: 120px; width:120px !important; text-align:center;">Acción</th>
</thead>


<tbody>  

      <?php foreach($model->getcuotesoftheprospect() as $rcuotes1): ?>


<tr <?php echo $rcuotes1->__GET('succeeded') == 1 ? 'style="background-color: #f7eb5b; color: #88898c;"' : '';?>>
<td><?php echo $rcuotes1->__GET('cuotesid');?> <input type="checkbox" class="classcheckbox2" name="idofthecuote[]" value="<?php echo $rcuotes1->__GET('cuotesid');?>" /<?php echo $rprospects1->__GET('status_prospect') == '100' ? 'disabled' : '';?> <?php echo $rprospects1->__GET('status_prospect') == '0' ? 'disabled' : '';?>></td>
<td><?php echo $rcuotes1->__GET('cuotedate');?></td>
<td><?php echo $rcuotes1->__GET('cuotename');?> <?php echo $rcuotes1->__GET('cuotelastname');?></td>
<td>$ <?php echo number_format($rcuotes1->__GET('totalcuote'),0, ',','.');?> </td>
<td> <a data-toggle="tooltip" data-placement="right" title='Exportar cotización en pdf' href="../../<?php echo $_SESSION['install_page'];?>/source/output.php?t=pdf&name=cotizacion<?php echo $rcuotes1->__GET('cuotesid');?>&prospectid=<?php echo $rprospects1->__GET('prospectid');?>&from=cuotes&cuoteid=<?php echo $rcuotes1->__GET('cuotesid');?>"><i class="fa fa-file-pdf-o fa-lg"></i></a>  |  <a href="##" data-toggle="tooltip" data-placement="right" title='Enviar cotización por correo electrónico'><i class="fa fa-envelope-o fa-lg"></i></a>
</td>



</tr>

<?php endforeach;?>

</tbody>
</table>

</div>


<script>


$(".classcheckbox2").on('click', function() {
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

<?php if ( ($_GET['rol'] =="ADMIN" ) || ($_GET['activeuser'] == $rprospects1->__GET('responsable')) ) { ?>
               
<?php if(($rprospects1->__GET('status_prospect') > '0') && ($rprospects1->__GET('status_prospect') < '100')){ ?>

<div class="panel-footer col-md-12" style="margin-bottom:30px;">

<div class="row">

<div class="col-md-6" style="margin-bottom:10px; margin-top:10px;  padding-top: 5px;" >
<button type="Button" class="btn btn-danger pull-left" name="detelecuote" id="detelecuote"  style="margin-left: 5px;" ><i class="fa fa-trash"></i> Eliminar</button> 
<input type="text" style="display:none;"  name="detelecuoteinput" id="detelecuoteinput" value="submit" /disabled>
<script>
$( '#detelecuote' ).on( 'click', function() {
    if( $('.classcheckbox2').is(':checked') ){

     $('#detelecuoteinput').attr('disabled', false);
    // alert("Selected");
     $('#cuotes_form').submit();


    } else {

     $('#detelecuoteinput').attr('disabled', true); 
     alert("Debe seleccionar por lo menos 1 cotización para eliminar.");

    }
});
</script>


</div>

<div class="col-md-6" style="margin-bottom:10px; margin-top:10px;" >

<button type="Button" class="btn btn-success pull-right" name="salesucceed" id="salesucceed" data-toggle="tooltip" data-placement="right" title='Cambia el estado a "Aprobado" y crea una venta con los datos de la cotización seleccionada' style="margin-left: 5px;" ><i class="fa fa-check"></i> Aprobar</button> 

<input style="display:none;" type="text" name="succeedcuote" id="succeedcuote" value="submit" /disabled>



<script>
$( '#salesucceed' ).on( 'click', function() {
    if( $('.classcheckbox2').is(':checked') ){

     $('#succeedcuote').attr('disabled', false);
    // alert("Selected");
     $('#cuotes_form').submit();


    } else {

     $('#succeedcuote').attr('disabled', true); 
     alert("Debe seleccionar 1 cotización.");

    }
});
</script>



</div>

</div> <!--row-->
</div>
<?php } ?>
<?php } ?>
  </div>
  </fieldset>
  </form>
  </div>
  <?php } ?>



  <?php if ( ($_GET['rol'] =="ADMIN" ) || ($_GET['activeuser'] == $rprospects1->__GET('responsable')) ) { ?>
               
  <?php if(($rprospects1->__GET('status_prospect') >= '0') && ($rprospects1->__GET('status_prospect') < '100')){ ?>

  <div class="col-md-12" >
<div class="crm-offer-title" style="padding-left:5%;">
<i class="fa fa-pencil-square-o" aria-hidden="true"></i> <strong> Acciones para el prospecto</strong>  
</div>

<form class="well form-horizontal" action="" method="post" id="formtosubmitcuote" enctype="multipart/form-data" style="margin-bottom:0px;">
<fieldset>
<div class="col-md-12" style="text-align:center;">

<input type="text" name="prospectidtobeupdated" style="display:none;" value="<?php echo $rprospects1->__GET('prospectid');?>" />



<?php if($rprospects1->__GET('status_prospect') == '0'){ ?>

  <style>
@media (min-width: 992px){

#margin25768 {

    margin-left: 25%;
}
}
    </style>

  <div class="form-group"> 
    <div class="col-md-6 selectContainer" id="margin25768" style="margin-top:15px;">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-info-circle fa-lg" aria-hidden="true"></i></span>
    <select name="reactivatestatus" id="reactivatestatus" class="form-control selectpicker" required>
      <option value="" selected>Seleccionar</option>
   
      <?php foreach($model->getstatus_prospect() as $rmeta): ?> 

      <?php if (($rmeta->__GET('metavalue') <'51') && ($rmeta->__GET('metavalue') >'24')){?>
<option value="<?php echo $rmeta->__GET('metavalue');?>"  ><?php echo $rmeta->__GET('metatitle');?> (<?php echo $rmeta->__GET('metavalue');?>%) </option>
      <?php } ?>


<?php endforeach;?>


    </select>
  </div>
</div>
</div>

<br>
  <button type="submit" name="reactivate" id="reactivate" class="btn btn-warning" data-toggle="tooltip" data-placement="right" title='Cambia el estado del prospecto' style="width: 90px; height: 90px; padding: 0px;"><i class="fa fa-check fa-lg"></i><br>REACTIVAR</button>

<?php } else { ?>

  <button type="submit" name="deniedprospect" id="deniedprospect" class="btn btn-danger" data-toggle="tooltip" data-placement="right" title='Cambia el estado del prospecto a "Denegado"' style="width: 90px; height: 90px; padding: 0px;"><i class="fa fa-close fa-lg"></i><br>DENEGADO</button>
  
<?php if ($rprospects1->__GET('status_prospect') !='75'){?>
  <button type="button" class="btn btn-default" onclick="confirmalert();" data-toggle="tooltip" data-placement="right" title='Genera cotización con los datos del prospecto y actualiza el estado a "Negociando"' style="width: 90px; height: 90px;"><i class="fa fa-square-o fa-lg"></i><br>COTIZAR</button>
  <input style="display:none;" type="text" id="createcuote" name="createcuote" value="submit" /disabled>
  
<?php } else { ?>
  <button type="submit"  class="btn btn-default" id="createcuote" name="createcuote" data-toggle="tooltip" data-placement="right" title='Genera cotización con los datos del prospecto' style="width: 90px; height: 90px;"><i class="fa fa-square-o fa-lg"></i><br>COTIZAR</button>
<?php } ?>

<script>

  function confirmalert() {
    var txt;
    var r = confirm('Si continua el estado del prospecto cambiara a "Negociando" y se generará una cotización con los datos actuales, ¿Desea continuar?');
    if (r == true) {

        txt = "ok";
        $('#createcuote').attr('disabled',false);
        $('#formtosubmitcuote').submit();

    } else {
        txt = "";
    }
  

}

</script>

<?php } ?>




</div>
</fieldset>
</form>


</div><!--col-md-12-->

  <?php } ?>
  <?php } ?>



<!-- termina arriba checkprospect -->
            </div>
          <!-- Termina 3er tab hacia arriba -->


   
        

          <!-- comienza 2do tab hacia abajo -->




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
  





  </div>
</div>
</div>


</body>





<?php
require_once '../../'.$_SESSION['install_page'].'/template/footer.php';
?>





</html>