<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>

<link rel="icon" href="../../<?php echo $_SESSION['install_page'];?>/images/favicon.png" type="image/x-icon">

<div  id="header">

<link rel="stylesheet" href="../../<?php echo $_SESSION['install_page'];?>/css/style.css">





<!-- graficos termina arriba -->


<?php
require_once '../../'.$_SESSION['install_page'].'/config.php';
require_once '../../'.$_SESSION['install_page'].'/header.php';





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

  <div class="col-sm-9" style="padding-left: 30px;">

<!-- empiezan graficos abajo-->
<br>


<!-- negociaciones en progreso empieza abajo -->
<div class="row">
<div class="col-md-12">
<div class="widget-num-12" data-toggle="tooltip" data-placement="right" title='Valor correspondiente a la suma de los totales de cada prospecto en estado de: "Indeciso", "En progreso y "Negociando""'>
<div class="crm-offer-title-widgets" style="text-align:center;"  ><strong > Total de negociaciones (prospectos) actuales </strong> <i style=" margin-right: 15px; margin-top: 10px; margin-left: 5px;" class="fa fa-info-circle fa-lg"></i></div>

<div class="widget-num-content">

<?php 

$totaltoshow = 0;


foreach($model->getpricesofnegociations1() as $rprospects1){

    $totaltoshow = ($totaltoshow + $rprospects1->__GET('totalprice'));
      
} ?>


<?php echo "$ ".number_format($totaltoshow,0,',','.');?>


</div>


</div><!-- card-->
</div><!--col-md-12-->
</div> <!--row-->
<!--negociaciones en progreso termina arriba -->


<div class="row">



<div class="col-md-8">
<div class="card2" style="background-color: rgb(255, 255, 255) !important; cursor:pointer;">
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
    width:'75%',height:'65%',
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
</div><!--col-md-8-->




<div class="col-md-4">
<div class="card2" style=" background-color: #fff !important; padding: 0; cursor:pointer;"  >
<div class="crm-offer-title" style="text-align:center;  " data-toogle="tool-tip" data-placement="right" title='Muestra la relación del estado de los prospectos activos ("Indeciso", "En progreso" y "Negociando")'><strong>Relación de prospectos activos <i style=" margin-right: 15px; margin-top: 10px; margin-left: 5px; cursor:pointer;" class="fa fa-info-circle fa-lg"></i></strong></div>


       <div id="piechart" style="height:400px; " ></div>
   
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
     width:'70%',height:'70%',
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

</div> <!--row-->




<!-- widgets dobles -->
<div class="row"  style="margin-bottom: 60px;">
<div class="col-sm-6">
<div class="widget-num-6" data-toggle="tooltip" data-placement="right" title='Muestra el valor correspondiente a la suma las ventas realizadas en el mes por todos los ejecutivos.'>
<div class="crm-offer-title-orange" style="text-align:center;"><strong> Total de ventas general (Mes) </strong> <i style=" margin-right: 15px; margin-top: 10px; margin-left: 5px; cursor:pointer;" class="fa fa-info-circle fa-lg"></i></div>

<div class="widget-num-content">



<?php 
$totaltoshow2 = 0;


foreach($model->getsalesquantityofthemonth(date("m", time())) as $rsalesmonth){

    $totaltoshow2 = ($totaltoshow2 + $rsalesmonth->__GET('totalcuote'));
      
} ?>

<?php echo "$ ".number_format($totaltoshow2,0,',','.');?>

</div>


</div><!-- card-->
</div><!--col-md-6-->


<div class="col-sm-6">
<div class="widget-num-6" data-toggle="tooltip" data-placement="right" title='Valor correspondiente a la suma las ventas realizadas en el día.'>
<div class="crm-offer-title-orange" style="text-align:center;"><strong> Total de ventas de hoy </strong> <i style=" margin-right: 15px; margin-top: 10px; margin-left: 5px;" class="fa fa-info-circle fa-lg"></i></div>
<div class="widget-num-content">
<?php 
$totaltoshow1 = 0;
foreach($model->getsalesquantityoftheday() as $rsales){
    $totaltoshow1 = ($totaltoshow1 + $rsales->__GET('totalcuote'));   
} ?>
<?php echo "$ ".number_format($totaltoshow1,0,',','.');?>
</div>

</div><!-- card-->
</div><!--col-md-6-->



</div> <!--row-->
<!--negociaciones en progreso termina arriba -->



<!-- terminar graficos arriba -->


<div class="row" style="margin-bottom: 60px;">
<p></p>
</div>


  </div>
</div>
</div>



</body>

<?php
require_once '../../'.$_SESSION['install_page'].'/template/footer.php';
?>





</html>