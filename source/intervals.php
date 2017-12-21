<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>


<?php
require_once '../../'.$_SESSION['install_page'].'/config.php';
require_once '../../'.$_SESSION['install_page'].'/header.php';
?>

</head>


<body>

<?php require_once '../../'.$_SESSION['install_page'].'/template/sidebar.php'; ?>



<!-- sidebar message counter -->
<span id="msgcounter13124121">
<?php if($alm1->__GET('rowcount') > 0) { ?>
  <span class="badge" style="background-color: #ff0505; padding: 3px 10px !important; margin-left: 5px; margin-bottom: 3px;"><?php echo $alm1->__GET('rowcount'); ?></span>
  <?php } else { ?>
 <span class="badge" style="padding: 3px 10px !important; margin-left: 5px; margin-bottom: 3px;"><?php echo $alm1->__GET('rowcount'); ?></span>
 <?php } ?>
</span>
<!-- sidebar message counter -->






<li style="    max-height: 100%; width: 100%;" id="titlecal">


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

/*CALENDAR NEXT_PREV starts down*/
if (isset($_GET['inputaction'])){
    if ($_GET['inputaction']=="next"){


        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "test";
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        $sql = "INSERT INTO tecnic (username, password, nombre, email)
        VALUES ('action: ".$_GET['inputaction']."', '2a', 'control:".$_GET['inputcontrol']."', 'NuevaFecha:".date("Y-m",$date->getTimestamp())."')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();
    }}



 
 /*CALENDAR NEXT_PREV ends up*/
?>


    <?php echo utf8_encode(strtoupper(strftime("%B",$date->getTimestamp())));?>, <?php echo date("Y",$date->getTimestamp());?> 
    </li>




</body>
</html>