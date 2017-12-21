<?php
session_start(['cookie_lifetime' => 86400,]);
session_cache_limiter('private');


date_default_timezone_set('America/Santiago');
setlocale(LC_TIME, 'es_ES', 'Spanish_Spain', 'Spanish');  
define("CHARSET", "iso-8859-1");



require_once '../../'.$_SESSION['install_page'].'/config.php';
require_once '../../'.$_SESSION['install_page'].'/function.php';

$alm = new pdv_var();
$model = new consulta();

// logging out

$alm->__SET('id',($_GET['activeuser']));
$alm->__SET('key', substr((md5("logout")),1,20));
$model->logout($alm);

//echo substr((md5("logout")),1,20);



echo "Cerrando sesión...";


session_unset(); 
session_destroy(); 


echo '<script type="text/javascript">location.href = "'.$homeurl.'";</script>';


?>