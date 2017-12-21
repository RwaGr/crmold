<?php
 session_start(); 

 require_once '../../'.$_SESSION['install_page'].'/config.php';


require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$tipo = isset($_REQUEST['t']) ? $_REQUEST['t'] : 'excel';
$extension = '.xls';

if($tipo == 'word') $extension = '.doc';

// Si queremos exportar a PDF
if($tipo == 'pdf'){

    require_once '../../'.$_SESSION['install_page'].'/config.php';
    
/*
    require_once 'lib/dompdf/dompdf_config.inc.php';
    
    $dompdf = new DOMPDF();
    
    $dompdf->load_html( file_get_contents( $homeurl.'source/product_report.php?idproduct='.$_GET['id'] ) );
    $dompdf->render();

   $dompdf->stream($_GET['name'].".pdf");*/
    

   $dompdf = new DOMPDF();

if(isset($_GET['from'])){

    if($_GET['from']=="contact"){
        
        $dompdf->loadHtml( file_get_contents($homeurl.'source/reports/contacts_report.php?idcontact='.$_GET['id'].'&rootpage='.$_SESSION['install_page'].''));        

    }

    if($_GET['from']=="company"){
        
        $dompdf->loadHtml( file_get_contents($homeurl.'source/reports/companies_report.php?idcompany='.$_GET['id'].'&rootpage='.$_SESSION['install_page'].''));        

    }

    if($_GET['from']=="cuotes"){
        
        $dompdf->loadHtml( file_get_contents($homeurl.'source/reports/cuotes_generator.php?prospectid='.$_GET['prospectid'].'&cuoteid='.$_GET['cuoteid'].'&rootpage='.$_SESSION['install_page'].''));        

    }


    if($_GET['from']=="cat"){
        
        if(isset($_POST['exportthiscat'])) {


$varto= $_POST['exportthiscat'];
            foreach ($varto as $getit){

        $dompdf->loadHtml( file_get_contents($homeurl.'source/reports/categories_report.php?idcategory='.$getit.'&rootpage='.$_SESSION['install_page'].''));        
    
    }
       
    
    } else {

$session = $_POST['session'];

            echo '<script type="text/javascript">location.href = "'.$homeurl.'pages/products'.$session.'&action=selectcategory&response=error";</script>';
        

        }

    }


} else {

if(isset($_GET['id'])){

  $dompdf->loadHtml( file_get_contents($homeurl.'source/reports/product_report.php?idproduct='.$_GET['id'].'&rootpage='.$_SESSION['install_page'].''));

} else {

    $dompdf->loadHtml( file_get_contents($homeurl.'source/reports/product_report.php?rootpage='.$_SESSION['install_page'].''));
    
}

}
   $dompdf->setPaper('letter', 'portrait'); // (Opcional) Configurar papel y orientación

$dompdf->render(); // Generar el PDF desde contenido HTML
$pdf = $dompdf->output(); // Obtener el PDF generado

if(isset($_GET['name'])){

    $dompdf->stream($_GET['name'].".pdf"); 

} else {

    $dompdf->stream("catalogo de productos.pdf"); 
    

}



} else{

    
    require_once 'report.php';
    
    header("Content-type: application/vnd.ms-$tipo");
    header("Content-Disposition: attachment; filename=mi_archivo$extension");
    header("Pragma: no-cache");
    header("Expires: 0");    
}