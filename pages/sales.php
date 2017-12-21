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
  }
//redirect to viewall
  echo '<script type="text/javascript">location.href = "'.$homeurl.'pages/sales'.$session.'&action=viewall";</script>';
    }






?>

</div>
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





<?php if(!isset($_GET['action'])) { ?>
  <div class="tab-pane fade in active" id="dashboard">
                  <?php } else { ?>
                    <div class="tab-pane fade in" id="dashboard">
                    <?php } ?>
          <!-- comienza homedo tab hacia abajo -->
          <div class="row"  >
          <div class="col-sm-6">
          <div class="widget-num-6" data-toggle="tooltip" data-placement="right" title='Muestra el valor correspondiente a la suma las ventas realizadas  en el mes por el ejecutivo de la sesión activa.'>
          <div class="crm-offer-title-orange" style="text-align:center;"><strong> Total de ventas individual (Mes) </strong> <i style=" margin-right: 15px; margin-top: 10px; margin-left: 5px;" class="fa fa-info-circle fa-lg"></i></div>
          
          <div class="widget-num-content">
          
          
       
          <?php 
$totaltoshow1 = 0;
foreach($model->getcommissionoftheuser() as $rcommission){
    $totaltoshow1 = ($totaltoshow1 + $rcommission->__GET('totalcommission'));   
} ?>


<?php 
if(isset($rcommission)){
echo "$ ".number_format($totaltoshow1,0,',','.');
} else { 
 echo "$ 0.00"; 
}?>
</div>
</div><!-- card-->
</div><!--col-md-6-->
          

<div class="col-sm-6">
<div class="widget-num-6" data-toggle="tooltip" data-placement="right" title='Muestra el total de comisiones mensual que le corresponde al ejecutivo de la sesión activa.'>
<div class="crm-offer-title-orange" style="text-align:center;"><strong> Total de comisiones individual por venta de  <?php //echo $rcommission->__GET('commission')."%";?> (Mes) </strong> <i style=" margin-right: 15px; margin-top: 10px; margin-left: 5px;" class="fa fa-info-circle fa-lg"></i></div>
<div class="widget-num-content">
          <?php 
          if(isset($rcommission)){
          $comissionoftheuser = (($totaltoshow1*$rcommission->__GET('commission'))/100);
          echo "$ ".number_format($comissionoftheuser,0,',','.');    
          } else { 
          echo "$ 0.00"; 
          }?>
</div>
</div><!-- card-->
</div><!--col-md-6-->
</div> <!--row-->


<?php        //Fechas y valores de la grafica
/*MES ACTUAL*/
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
/*valor*/
$totaltoshow0 = 0;
foreach($model->getsalesquantityofthemonth(date("m", time())) as $rsalesmonth){
    $totaltoshow0 = ($totaltoshow0 + $rsalesmonth->__GET('totalcuote'));     
} 
/*denied*/
$totaldenied = 0;
foreach($model->getpricesofprospectsdown(date("m", time())) as $rdown){
  $totaldenied = ($totaldenied + $rdown->__GET('totalprice'));     
} 


/*menos 1*/
$nuevafecha1 = strtotime ( '-1 month' , strtotime ( $fecha ) ) ;
$nuevafecha1 = date ( 'd/m/Y' , $nuevafecha1 );
$date1 = DateTime::createFromFormat("d/m/Y", $nuevafecha1);
//echo strtoupper(strftime("%B",$date1->getTimestamp()));
$alm1 = $model->getprospectsdeniedcount(date("m",$date1->getTimestamp()));
//echo '<script> alert("'.$alm1->__GET('rowcount').'"); </script>';
$currentmonth1 = $alm1->__GET('rowcount');
$alm1 = $model->getprospectsaprovedcount(date("m",$date1->getTimestamp()));
$currentmonth1aproved = $alm1->__GET('rowcount');
/*valor*/
$totaltoshow1 = 0;
foreach($model->getsalesquantityofthemonth(date("m",$date1->getTimestamp())) as $rsalesmonth){
    $totaltoshow1 = ($totaltoshow1 + $rsalesmonth->__GET('totalcuote'));     
} 
/*denied*/
$totaldenied1 = 0;
foreach($model->getpricesofprospectsdown(date("m",$date1->getTimestamp())) as $rdown){
  $totaldenied1 = ($totaldenied1 + $rdown->__GET('totalprice'));     
} 



$nuevafecha2 = strtotime ( '-2 month' , strtotime ( $fecha ) ) ;
$nuevafecha2 = date ( 'd/m/Y' , $nuevafecha2 );
$date2 = DateTime::createFromFormat("d/m/Y", $nuevafecha2);
//echo strtoupper(strftime("%B",$date2->getTimestamp()));
//echo date("m",$date2->getTimestamp());
$alm1 = $model->getprospectsdeniedcount(date("m",$date2->getTimestamp()));
$currentmonth2 = $alm1->__GET('rowcount');
$alm1 = $model->getprospectsaprovedcount(date("m",$date2->getTimestamp()));
$currentmonth2aproved = $alm1->__GET('rowcount');
/*valor*/
$totaltoshow2 = 0;
foreach($model->getsalesquantityofthemonth(date("m",$date2->getTimestamp())) as $rsalesmonth){
    $totaltoshow2 = ($totaltoshow2 + $rsalesmonth->__GET('totalcuote'));     
} 

/*denied*/
$totaldenied2 = 0;
foreach($model->getpricesofprospectsdown(date("m",$date2->getTimestamp())) as $rdown){
  $totaldenied2 = ($totaldenied2 + $rdown->__GET('totalprice'));     
} 


$nuevafecha3 = strtotime ( '-3 month' , strtotime ( $fecha ) ) ;
$nuevafecha3 = date ( 'd/m/Y' , $nuevafecha3 );
$date3 = DateTime::createFromFormat("d/m/Y", $nuevafecha3);
//echo strtoupper(strftime("%B",$date2->getTimestamp()));
//echo date("m",$date2->getTimestamp());
$alm1 = $model->getprospectsdeniedcount(date("m",$date3->getTimestamp()));
$currentmonth3 = $alm1->__GET('rowcount');
$alm1 = $model->getprospectsaprovedcount(date("m",$date3->getTimestamp()));
$currentmonth3aproved = $alm1->__GET('rowcount');
/*valor*/
$totaltoshow3 = 0;
foreach($model->getsalesquantityofthemonth(date("m",$date3->getTimestamp())) as $rsalesmonth){
    $totaltoshow3 = ($totaltoshow3 + $rsalesmonth->__GET('totalcuote'));     
} 

/*denied*/
$totaldenied3 = 0;
foreach($model->getpricesofprospectsdown(date("m",$date3->getTimestamp())) as $rdown){
  $totaldenied3 = ($totaldenied3 + $rdown->__GET('totalprice'));     
} 


/*valores de la grafica */



?>




<div class="row">
<div class="col-md-12">
<div class="widget-num-12" style="background-color: rgb(255, 255, 255) !important;">
<div class="crm-offer-title" style="text-align:center;  " data-toogle="tool-tip" data-placement="right" title='Muestra el monto total de las oportunidades convertidas en ventas (Aprobadas 100%) y el monto total de las oportunidades denegadas (0%).'><strong> Total de oportunidades convertidas en ventas y denegadas. ($) (Últimos 4 meses) <i style=" margin-right: 15px; margin-top: 10px; margin-left: 5px;" class="fa fa-info-circle fa-lg"></i></strong></div>

  <div id="chart_div55" style="height:300px;"></div>
      

<script>

google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(drawBasic);

function drawBasic() {

      var data = google.visualization.arrayToDataTable([
    ['Mes', 'Denegadas (0%)', 'Ventas (Aprobados 100%)'],
    ['<?php echo strtoupper(strftime("%B",$date3->getTimestamp()));?>',  <?php echo $totaldenied3;?>, <?php echo $totaltoshow3;?>],
    ['<?php echo strtoupper(strftime("%B",$date2->getTimestamp()));?>',  <?php echo $totaldenied2;?>, <?php echo $totaltoshow2;?>],
    ['<?php echo strtoupper(strftime("%B",$date1->getTimestamp()));?>',  <?php echo $totaldenied1;?>, <?php echo $totaltoshow1;?>], 
    ['<?php echo strtoupper(strftime("%B",$date->getTimestamp()));?>',  <?php echo $totaldenied;?>, <?php echo $totaltoshow0;?>]

  ]);



      var options = {
        /* title: '',*/
         colors:['c9302c', '5cb85c'],
         backgroundColor: 'fff',

chartArea: {
    width:'80%',height:'65%',
   'backgroundColor': { 'fill': 'fff', 'opacity': 100 }, 
},
legend: {position: 'bottom'},
/*
hAxis: {
          title: 'Time'
        },*/
        vAxis: {
          title: 'Total ($)'
        }

       };



      var chart = new google.visualization.LineChart(document.getElementById('chart_div55'));

      chart.draw(data, options);

    }


      
  


     $(window).resize(function(){
        drawBasic();
     });


</script>
</div><!--card2-->
</div><!--col-md-12-->
</div><!--row -->

<div class="row" style="margin-bottom: 60px;">
<div class="col-md-12">
<div class="widget-num-12" data-toggle="tooltip" data-placement="right" title='Muestra el valor correspondiente a la suma las ventas realizadas en el mes por todos los ejecutivos.'>
<div class="crm-offer-title-widgets" style="text-align:center;"><strong> Total de ventas general (Mes) </strong> <i style=" margin-right: 15px; margin-top: 10px; margin-left: 5px;" class="fa fa-info-circle fa-lg"></i></div>

<div class="widget-num-content">





<?php echo "$ ".number_format($totaltoshow0,0,',','.');?>






</div> 
</div>
</div> 
</div>



            </div>
          <!-- Termina homedo tab hacia arriba -->



          <?php if(isset($_GET['action'])) { ?>
  <?php if ((($_GET['action'])=="newsale")) { ?>
    <div class="tab-pane fade in active" id="newsale"> 
   <?php } else { ?>
    <div class="tab-pane fade in " id="newsale">
    <?php } ?>
<?php } else { ?>
  <div class="tab-pane fade in " id="newsale">
  <?php } ?>
      
<form action="<?php echo $homeurl."pages/sales".$session;?>" method="post" id="prospectsform">

<div class="card1 " style="min-height: 200px;   border-radius:0px;   margin-bottom: 0;   background -image: linear-gradient(to bottom,#ffffff 0,#ffffff 100%); background-color: #fff !important; padding: 0;">
<div class="crm-offer-title"  style="padding-left:5%; font-size:18px;"><i class="fa fa-handshake-o" style="margin-right:10px;" aria-hidden="true"></i>  Datos del prospecto </div>


<div class="row">
<div class="col-md-12">
<div class="maindiv" >


<?php if (!isset($_GET['prospectid'])){ ?>

<strong>Seleccione un prospecto</strong>

<div class="form-group"> 
    <div class="col-md-6 selectContainer" style="margin-top:15px;">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-user-plus fa-lg" aria-hidden="true"></i></span>
    <select name="prospect" id="prospect" class="form-control selectpicker" required>
      <option value="">Seleccionar</option>
   

<?php foreach($model->getpricesofnegociations() as $rprospects1): ?>

<option value="<?php echo $homeurl."pages/sales".$session."&action=newsale&prospectid=".$rprospects1->__GET('prospectid');?>" ><?php echo $rprospects1->__GET('prospectid'); ?>- <?php echo $rprospects1->__GET('namecontact');?> <?php echo $rprospects1->__GET('lastnamecontact');?>  (<?php echo $rprospects1->__GET('companyname');?>)</option>

<?php endforeach;?>
    </select>
  </div>
</div>
</div>

<script>
    $(function(){
      // bind change event to select
      $('#prospect').on('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });
</script>

<br>
<br>


<div class="row">
<div class="col-md-12">
<p><strong> Nota:</strong> Las ventas solo pueden ser generadas a partir de una cotización pre-existente, es decir que el prospecto debe tener el estado: "Negociando".</p>
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
<?php foreach($model->getpricesofnegociations() as $rprospects1): ?>





<tr class="tr-table">
<td class="td-table">
<p><?php echo $rprospects1->__GET('prospectid'); ?> <input type="text" style="display:none;" name="prospecttobesucceeded" value="<?php echo $rprospects1->__GET('prospectid'); ?>" />
</p>
</td>
<td class="td-table">
<p><?php echo $rprospects1->__GET('namecontact');?> <?php echo $rprospects1->__GET('lastnamecontact');?></p>
</td>
<td class="td-table">
<p><?php echo $rprospects1->__GET('emailcontact');?></p>
</td>
<td class="td-table">
<p><?php echo $rprospects1->__GET('phonecontact');?></p>
</td>
</tr>



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

<tr class="tr-table">
<td class="td-table">
<p><?php echo $rprospects1->__GET('chargecontact');?></p>
</td>
<td class="td-table">
<p><?php echo $rprospects1->__GET('companyname');?></p>
</td>
</tr>


<?php endforeach;?>

</tbody>
</table>
</div>

<br>
<br>




  <?php } ?>



</div>
</div>
</div>
</div>

</form>




<!-- desde aqui -->


<?php if (isset($_GET['prospectid'])){ ?>


  <form  action="" method="post" id="cuotes_form" enctype="multipart/form-data" style="margin-bottom:0px;">
<fieldset>


<div class="card1 " style="min-height: 200px;   border-radius:0px;   margin-bottom: 0;   background -image: linear-gradient(to bottom,#ffffff 0,#ffffff 100%); background-color: #fff !important; padding: 0;">
<div class="crm-offer-title"  style="padding-left:5%; font-size:18px;"><i class="fa fa-square-o" style="margin-right:10px;" aria-hidden="true"></i>  Cotizaciones para el prospecto </div>


<div class="row">
<div class="col-md-12">
<div class="maindiv" >

<input type="text" style="display:none;" name="prospectidtobeupdated" value="<?php echo $rprospects1->__GET('prospectid');?>" />


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



</div>

<div class="panel-footer col-md-12" style="margin-bottom:30px;">

<div class="row">

<div class="col-md-6" style="margin-bottom:10px; margin-top:10px;  padding-top: 5px;" >
<button type="Button" class="btn btn-danger pull-left" name="detelecuote" id="detelecuote"  style="margin-left: 5px;" ><i class="fa fa-trash"></i> Eliminar</button> 
<input type="text" style="display:none;" name="detelecuoteinput" id="detelecuoteinput" value="submit" /disabled>
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
<input  type="text" style="display:none;" name="succeedcuote" id="succeedcuote" value="submit" /disabled>

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
</div> <!--panel-footer-->


</div>
</div>
</div>
</div>

</fieldset>
</form>



<?php } ?>

<!-- hasta aqui -->




            </div>
          <!-- Termina 1er tab hacia arriba -->

          <!-- comienza 2do tab hacia abajo -->



          <?php if(isset($_GET['action'])) { ?>
  <?php if ((($_GET['action'])=="viewall")) { ?>
    
    <div class="tab-pane fade in active" id="viewall">
   <?php } else { ?>
   
    <div class="tab-pane fade in" id="viewall">
    <?php } ?>
<?php } else { ?>
 
  <div class="tab-pane fade in" id="viewall">
  <?php } ?>

<div class="row">



<div class="col-md-4" id="padding15" style="text-align:right; padding-right:0px;">
<div class="form-group" style="width:100%">
  <div class="col-md-12 inputGroupContainer" style="padding:0px;">
  <div class="input-group">
  <span class="input-group-addon" id="border992" ><i class="fa fa-search"></i></span>
  <input  name="inputprospect" style="border-radius:0px;" id="inputprospect" onkeyup="search();" placeholder="Buscar cliente por nombre o empresa"  class="form-control" autocomplete="off" type="text">
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
</div> <!--col-md-4-->


<div class="col-md-4" id="padding15" style="text-align:right; padding-left:0px; padding-right:0px;">
<div class="form-group"> 
    <div class="col-md-12 selectContainer" style="padding:0px;">
    <div class="input-group">
        <span class="input-group-addon" id="border992" style="border-radius:0px;"><i class="fa fa-user fa-lg" aria-hidden="true"></i></span>
    <select name="filterfusers" id="filterfusers" class="form-control selectpicker" style="border-radius:0px;" required>
      <option value="">Seleccionar</option>
<?php if (isset($_GET['date'])) { ?>

  <?php if (isset($_GET['check'])) { ?>

<option value="<?php echo $homeurl."pages/sales".$session."&action=viewall&date=".$_GET['date']."";?>">Todas</option>
<option value="<?php echo $homeurl."pages/sales".$session."&action=viewall&check=mysales&date=".$_GET['date']."";?>" selected>Mis ventas</option>
  <?php } else { ?>

<option value="<?php echo $homeurl."pages/sales".$session."&action=viewall&date=".$_GET['date']."";?>">Todas</option>
<option value="<?php echo $homeurl."pages/sales".$session."&action=viewall&check=mysales&date=".$_GET['date']."";?>">Mis ventas</option>

  <?php } ?>

<?php } else { ?>


  <?php if (isset($_GET['check'])) { ?>

  <option value="<?php echo $homeurl."pages/sales".$session."&action=viewall";?>">Todas</option>
  <option value="<?php echo $homeurl."pages/sales".$session."&action=viewall&check=mysales";?>" selected>Mis ventas</option>
   
  <?php } else { ?>

  <option value="<?php echo $homeurl."pages/sales".$session."&action=viewall";?>">Todas</option>
  <option value="<?php echo $homeurl."pages/sales".$session."&action=viewall&check=mysales";?>">Mis ventas</option>
 
  <?php } ?>  


<?php } ?>  
   
    </select>
  </div>
</div>
</div>
</div><!--col-md-4-->


<script>
    $(function(){
      // bind change event to select
      $('#filterfusers').on('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });
</script>

<?php 
/*$nuevafecha3 = strtotime ( '- month' , strtotime ( $fecha ) ) ;
$nuevafecha3 = date ( 'd/m/Y' , $nuevafecha3 );
$date3 = DateTime::createFromFormat("d/m/Y", $nuevafecha3);*/

?>



<div class="col-md-4" id="padding15" style="text-align:right; padding-left:0px;">
<div class="form-group"> 
    <div class="col-md-12 selectContainer" style="padding:0px;">
    <div class="input-group">
        <span class="input-group-addon" id="border992" style="border-radius:0px;"><i class="fa fa-clock-o fa-lg" aria-hidden="true"></i></span>
    <select name="filterfordates"  id="filterfordates" class="form-control selectpicker" required>

<?php if (isset($_GET['check'])) { ?>

  <?php if (isset($_GET['date'])) { ?>

<option value="">Seleccionar</option>
<option value="<?php echo $homeurl."pages/sales".$session."&action=viewall&check=".$_GET['check']."&date=".date("Y-m-d", time());?>" <?php echo $_GET['date'] == date("Y-m-d", time()) ? 'selected' : '';?>>Hoy</option>
<option value="<?php echo $homeurl."pages/sales".$session."&action=viewall&check=".$_GET['check']."&date=".date("Y-m", time())."-01";?>" <?php echo $_GET['date'] == date("Y-m", time())."-01" ? 'selected' : '';?>>Este mes</option>
<option value="<?php echo $homeurl."pages/sales".$session."&action=viewall&check=".$_GET['check']."&date=".date("Y", time())."-01-01";?>" <?php echo $_GET['date'] == date("Y", time())."-01-01" ? 'selected' : '';?>>Este año</option>
<option value="<?php echo $homeurl."pages/sales".$session."&action=viewall&check=".$_GET['check']."";?>">Ver todo</option>

<?php } else { ?>

<option value="">Seleccionar</option>
<option value="<?php echo $homeurl."pages/sales".$session."&action=viewall&check=".$_GET['check']."&date=".date("Y-m-d", time());?>">Hoy</option>
<option value="<?php echo $homeurl."pages/sales".$session."&action=viewall&check=".$_GET['check']."&date=".date("Y-m", time())."-01";?>">Este mes</option>
<option value="<?php echo $homeurl."pages/sales".$session."&action=viewall&check=".$_GET['check']."&date=".date("Y", time())."-01-01";?>">Este año</option>
<option value="<?php echo $homeurl."pages/sales".$session."&action=viewall&check=".$_GET['check']."";?>">Ver todo</option>

  <?php } ?>

<?php } else { ?>

  <?php if (isset($_GET['date'])) { ?>

<option value="">Seleccionar</option>
<option value="<?php echo $homeurl."pages/sales".$session."&action=viewall&date=".date("Y-m-d", time());?>" <?php echo $_GET['date'] == date("Y-m-d", time()) ? 'selected' : '';?>>Hoy</option>
<option value="<?php echo $homeurl."pages/sales".$session."&action=viewall&&date=".date("Y-m", time())."-01";?>" <?php echo $_GET['date'] == date("Y-m", time())."-01" ? 'selected' : '';?>>Este mes</option>
<option value="<?php echo $homeurl."pages/sales".$session."&action=viewall&date=".date("Y", time())."-01-01";?>" <?php echo $_GET['date'] == date("Y", time())."-01-01" ? 'selected' : '';?>>Este año</option>
<option value="<?php echo $homeurl."pages/sales".$session."&action=viewall";?>">Ver todo</option>

  <?php } else { ?>

<option value="">Seleccionar</option>
<option value="<?php echo $homeurl."pages/sales".$session."&action=viewall&date=".date("Y-m-d", time());?>">Hoy</option>
<option value="<?php echo $homeurl."pages/sales".$session."&action=viewall&date=".date("Y-m", time())."-01";?>">Este mes</option>
<option value="<?php echo $homeurl."pages/sales".$session."&action=viewall&date=".date("Y", time())."-01-01";?>">Este año</option>
<option value="<?php echo $homeurl."pages/sales".$session."&action=viewall";?>">Ver todo</option>

  <?php } ?>

<?php } ?>

    </select>
  </div>
</div>
</div>
</div><!--col-md-4-->

<script>
    $(function(){
      // bind change event to select
      $('#filterfordates').on('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });
</script>



</div>


   
   <!-- empieza ver todas abajo-->


   <div class="panel-body col-md-12" id="tablediv_contacts" >

<table id="table_contacts" class="table table-bordered" cellspacing="0" style=" border-collapse: collapse; width:100%;">


  <thead id="head_contacttable">
  <tr>
  <th style="text-align:center; max-width: 80px; min-width: 70px;  width: 80px; ">ID </th>
    <th style="min-width: 260px;  max-width: 280px;" colspan=2>Cliente </th>
    <th style="    min-width: 300px; max-width: 300px; width: 300px; text-align:center;">Cotización asociada</th>
    <th style="    min-width: 180px;  max-width: 180px; width: 180px; text-align:center;">Fecha de venta</th>
    <th style="min-width:160px; max-width: 160px; width: 160px; text-align:center;">Total venta </th>
  </tr>

  </thead>
  <tbody>
  
  <?php $varcontrol = 0;?>

<?php foreach($model->getsales() as $rclients): ?>
<tr class="tr-table">
<td class="td-table" style="text-align:center;"><?php echo $rclients->__GET('salesid');?><input style="margin-left:4px;" type="checkbox" value="<?php echo $rclients->__GET('salesid');?>" /></td>                


<td class="td-table" style=" width:60px !important; text-align:center; "><!--cliente-->
<div class="col-md-2" style="text-align:center; width:30px !important; max-width: 60px;">
<div id="imgdiv30" class="imgdiv30" style="margin-bottom: 5px; text-align:center; " >
<?php if ($rclients->__GET('imgcontact') == "") { ?>
<img id="contact_img30" class="imgrounded30" src="../../<?php echo $_SESSION['install_page'];?>/images/default/default.png" />
<?php } else { ?>
  <img id="contact_img30" class="imgrounded30" src="../../<?php echo $_SESSION['install_page'];?>/images/contacts/<?php echo $rclients->__GET('imgcontact');?>" />
<?php } ?>
</div>     
</div>  <!--col-md-3-->
<div class="col-md-2" style="text-align:center; width:30px !important; max-width: 60px;">
<a href="<?php echo $homeurl."pages/sales".$session."&action=viewsale&idsale=".$rclients->__GET('salesid')."";?>">Ver</a>
</div>
</td>

<td class="td-table" ><!--cliente-->

<p><?php echo $rclients->__GET('namecontact');?> <?php echo $rclients->__GET('lastnamecontact');?>
<br>Empresa: <?php echo $rclients->__GET('companycontact');?> 
</p>

</td><!--cliente-->

<td class="td-table" style="text-align:center;">Cotizacion Nro.<?php echo $rclients->__GET('cuotesid');?>
<a data-toggle="tooltip" style="margin-left:10px;" data-placement="right" title='Exportar cotización en pdf' href="../../<?php echo $_SESSION['install_page'];?>/source/output.php?t=pdf&name=cotizacion<?php echo $rclients->__GET('cuotesid');?>&prospectid=<?php echo $rclients->__GET('prospectid');?>&from=cuotes&cuoteid=<?php echo $rclients->__GET('cuotesid');?>"><i class="fa fa-file-pdf-o fa-lg"></i></a> 
</td>


<td class="td-table" style="text-align:center;"><?php echo date("d-m-Y", strtotime($rclients->__GET('salesdate')));?></td>


<td class="td-table" style="text-align:center;">$ <?php echo number_format($rclients->__GET('totalcuote'),0, ',','.');?></td>
                
            
</tr>


<?php $varcontrol = $rclients->__GET('rowcount');?>

  <?php endforeach; ?>

  <?php if($varcontrol=='0'){?>
<tr>
<td style="border: 0px solid #fff;" colspan="7">No se han encontrado resultados para su busqueda...</td>
</tr>

    <?php } ?>



  </tbody>
</table>


</div>

<!-- termina ver todas arriba -->

            </div>
          <!-- Termina 2do tab hacia arriba -->

     <!-- comienza 3er tab hacia abajo -->
  <?php if(isset($_GET['action'])) { ?>
  <?php if ((($_GET['action'])=="commissions")) { ?>   
<div class="tab-pane fade in active" id="commissions">
   <?php } else { ?>
<div class="tab-pane fade in" id="commissions">
    <?php } ?>
<?php } else { ?>
<div class="tab-pane fade in" id="commissions">
  <?php } ?>
<!-- INICIO COMISIONES ABAJO-->



<form action="" method="post" id="formcommissions"> 


<div class="col-md-12 panel-body" style="padding: 0;     height: 250px; margin-bottom:0px !important;" >
<table id="myTable" class="table table-bordered" cellspacing="0" style=" border-collapse: collapse; width:100%; margin-bottom:0px !important;">
 <thead style="background-color: rgba(228, 228, 228, 0.7);">
 <th style="    min-width: 120px;text-align:center;">Fecha</th>
 <th style="    min-width: 50px; text-align:center;">ID (VENTA)</th>
 <th style="    min-width: 190px;">Cliente</th>
 <th style="    min-width: 120px; width:120px !important;text-align:center;">% comisión</th>
 <th style="    min-width: 150px; width::150px !important;text-align:center;">Total venta</th>
 <th style="    min-width: 140px; width:140px !important;text-align:center;">Sub-total comisión</th>
</thead>
<tbody>

<?php $totalcomm = 0; ?>

<?php $varcontrol = 0;?>

<?php foreach($model->getsales() as $rclients): ?>

<tr>
<td style="text-align:center;"><?php echo date("d-m-Y", strtotime($rclients->__GET('salesdate')));?></td>
<td style="text-align:center;"><?php echo $rclients->__GET('salesid');?></td>
<td><?php echo $rclients->__GET('namecontact');?> <?php echo $rclients->__GET('lastnamecontact');?></td>
<td style="text-align:center;"><?php echo $rclients->__GET('commission');?>% </td>
<td style="text-align:center;">$ <?php echo number_format($rclients->__GET('totalcuote'),0, ',','.');?></td>
<td style="text-align:center;"><?php echo number_format((($rclients->__GET('totalcuote')*$rclients->__GET('commission'))/100),0, ',','.');?></td>
</tr>

<?php $totalcomm = ( (($rclients->__GET('totalcuote')*$rclients->__GET('commission'))/100) + $totalcomm); ?>


<?php $varcontrol = $rclients->__GET('rowcount');?>

  <?php endforeach; ?>

  <?php if($varcontrol=='0'){?>
<tr>
<td style="border: 0px solid #fff;" colspan="7">No se han encontrado resultados para su busqueda...</td>
</tr>

    <?php } ?>



</tbody>
</table>
</div>
<table id="myTable" class="table table-bordered" cellspacing="0" style=" border-collapse: collapse; width:100%; margin-bottom:0px;">
 <tbody style="background-color: rgba(228, 228, 228, 0.7);">

 <tr style="text-align:right;">
    <td style="width:75%;"><strong>Total comisiones:</strong></td>
    <td style="width:25%; background-color: rgba(255, 236, 3, 0.62);    min-width: 120px;">$ <strong> <?php echo number_format($totalcomm ,0,',','.');?> </strong> </td>
  </tr>
</tbody>
</table>


<!-- busqueda -->


<div class="row" style="margin-bottom: 10px; margin-top:15px;">
<div class="col-md-12">
<strong>Seleccione un rango de fecha:</strong>
</div><!--col-md-12-->
</div> <!-- row-->

<div class="row">
<div class="col-md-4" >
<div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;  padding-left: 0px;
    padding-right: 0px;">
  <div class="input-group">
  <span class="input-group-addon">Inicio:</span>
<?php if (isset($_POST['initdate'])) { ?>
  <input type="date"  name="initdate" id="initdate" value="<?php echo $_POST['initdate'];?>" class="form-control"/>
<?php } else { ?>
  <input type="date"  name="initdate" id="initdate" value="<?php echo date("Y-m", time())."-01";?>" class="form-control"/>
<?php } ?>   
    </div>
  </div>
</div><!--col-md-4-->
</div><!--row-->

<div class="row">
<div class="col-md-4" >
<div class="col-md-12 inputGroupContainer" style="margin-bottom: 10px;  padding-left: 0px;
    padding-right: 0px;">
  <div class="input-group">
  <span class="input-group-addon">Fin:</span>

  <?php if (isset($_POST['initdate'])) { ?>
  <input type="date"  name="enddate" id="enddate"  value="<?php echo $_POST['enddate'];?>" class="form-control"/>
<?php } else { ?>
  <input type="date"  name="enddate" id="enddate" value="<?php echo date("Y-m-d", time());?>" class="form-control"/>
  <?php } ?>   
    </div>
  </div>
  </div><!--col-md-4-->
</div><!--row-->

<div class="row">
<div class="col-md-4" style="margin-bottom: 25px; text-align:right;" >

<button class="btn btn-info" type="button" id="buttonsub" >Calcular <i style="margin-left:10px;" class="fa fa-search fa-lg"></i></button> 

<script>

$('#buttonsub').on('click', function () {
  //check initdate
if(document.getElementById('initdate').value == ""){
  alert("Debe seleccionar un rango de fechas válido");
} else {
  //check enddate
  if(document.getElementById('enddate').value == ""){

    alert("Debe seleccionar un rango de fechas válido");

  } else {

//check that initdate is not after enddate
  if(document.getElementById('enddate').value < document.getElementById('initdate').value){
    alert("La fecha de inicio no puede ser despues de la fecha de fin.");
  } else {
    $('#formcommissions').submit();
  }

  }


}
});
</script>



</div><!--col-md-4-->
</div><!--row-->


</form>

<!--fin de comisiones arriba -->

</div>
          <!-- Termina 3er tab hacia arriba -->





    <!-- comienza 4to tab hacia abajo -->
    <?php if(isset($_GET['action'])) { ?>
  <?php if ((($_GET['action'])=="viewsale")) { ?>
    
    <div class="tab-pane fade in active" id="viewsale">
   <?php } else { ?>
   
    <div class="tab-pane fade in" id="viewsale">
    <?php } ?>
<?php } else { ?>
 
  <div class="tab-pane fade in" id="viewsale">
  <?php } ?>
                

 

<div class="col-md-12" >
<div class="crm-offer-title" style="padding-left:5%;">
<i class="fa fa-handshake-o fa-lg" aria-hidden="true" style="margin-right:10px;"></i><strong>  Detalle de la venta</strong>
</div>

<form class="well form-horizontal" action="" method="post" id="company_form" enctype="multipart/form-data" style="background-image: linear-gradient(to bottom,#ffffff 0,#f5f5f5 100%); color: #88898c;     font-size: 14px;">
<fieldset>
<?php if(isset($_GET['idsale'])) { ?>
<div class="row">
<div class="col-md-12">
<div class="col-md-4">

<strong> Datos del cliente </strong> <input type="text" style="display:none;" name="idsaleinput" value="<?php echo $_GET['idsale'];?>" />

<br><br>

<div id="imgdiv" class="imgdiv" style="margin-bottom: 15px;" >
<?php if ($rclients->__GET('imgcontact') == "") { ?>
<img id="contact_img" class="imgrounded" src="../../<?php echo $_SESSION['install_page'];?>/images/default/default.png" />
<?php } else { ?>
  <img id="contact_img" class="imgrounded" src="../../<?php echo $_SESSION['install_page'];?>/images/contacts/<?php echo $rclients->__GET('imgcontact');?>" />
<?php } ?>
</div>     


<div class="paddingH-md10"> 
                <br> Nombre: <?php echo $rclients->__GET('namecontact');?> <?php echo $rclients->__GET('lastnamecontact');?>               
                <br><i style="margin-right:4px;" class="fa fa-phone"></i> <?php echo $rclients->__GET('phonecontact'); ?>
                <br><i style="margin-right:4px;" class="fa fa-envelope-o"></i> <?php echo $rclients->__GET('emailcontact'); ?>
                <br> <strong>Empresa:</strong> <?php echo $rclients->__GET('companycontact');?> 
                <br><strong> Cargo:</strong> <?php echo $rclients->__GET('chargecontact'); ?>
                <br><strong>Cotización asociada: </strong> Nro. <?php echo $rclients->__GET('cuotesid');?> <a data-toggle="tooltip" style="margin-left:10px;" data-placement="right" title='Exportar cotización en pdf' href="../../<?php echo $_SESSION['install_page'];?>/source/output.php?t=pdf&name=cotizacion<?php echo $rclients->__GET('cuotesid');?>&prospectid=<?php echo $rclients->__GET('prospectid');?>&from=cuotes&cuoteid=<?php echo $rclients->__GET('cuotesid');?>"><i class="fa fa-file-pdf-o fa-lg"></i></a> 

                <br> 
</div><!--paddingH-md10-->
</div><!--col-md-5-->



<div class="col-md-8">

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

<tbody>

<?php $varidbefore = $rclients->__GET('cuotesid');?>


<?php foreach($model->getpp3foracuote($varidbefore) as $rcuotepp3): ?>

<tr class="tr-table">

<td class="td-table" >
<?php echo $rcuotepp3->__GET('pp3_productid');?>
</td>

<td class="td-table" >
<?php echo $rcuotepp3->__GET('productname');?>
</td>

<td class="td-table" style="text-align:center;">
<?php echo $rcuotepp3->__GET('pp3_quantity');?>
</td>

<td class="td-table" style="text-align:center;">
<?php echo $rcuotepp3->__GET('pp3_discount');?> %
</td>

<td class="td-table" style="text-align:center;">
<?php echo number_format($rcuotepp3->__GET('priceofthecuote'),0, ',', '.');?>
</td>

<td class="td-table" style="text-align:center;">
<?php echo number_format($rcuotepp3->__GET('pp3_priceafter'),0, ',', '.');?>
</td>

</tr>

<?php endforeach; ?>


</tbody>

</table>
</div>
<table id="myTable" class="table table-bordered" cellspacing="0" style=" border-collapse: collapse; width:100%; margin-bottom:0px;">
 <tbody style="background-color: rgba(228, 228, 228, 0.7);">

 <tr style="text-align:right;">
    <td style="width:75%;"><strong>Total:</strong></td>
    <td style="width:25%; background-color: rgba(255, 236, 3, 0.62);    min-width: 120px;">$ <strong> <?php echo number_format($rclients->__GET('totalcuote'),0,',','.');?> </strong> </td>
  </tr>


</tbody>
</table>

</div><!--col-md-8-->

</div><!--col-md-12-->
</div> <!--row-->

<?php } ?>
</fieldset>
</form>
</div><!--col-md-12-->



            </div>
          <!-- Termina 4to tab hacia arriba -->



            </div>
        </div>
    </div>






<!-- CONTENIDO HASTA AQUI hacia ARRIBA -->




  
  </div>
</div>
</div>


</body>
</html>