<?php

//Set the main url 
$install_page ="CRM";
$homeurl = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]/".$install_page."/";


//Set the  data from the website

$title ="CRM Plan de Ventas";
$logo = "logo.png";
$description = "";

//Set the DB data connection

$dbhost= "localhost";
$dbname="crm_pdv";
$dbuser = "root";
$dbpass = "";

$dsn = 'mysql:host='.$dbhost.';dbname='.$dbname.'';

/*prospects view default*/
$defaultprospectsview = "50";

/*image of the reports*/
$logoreports = "logo-crm.png";


?>

