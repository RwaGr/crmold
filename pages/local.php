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

AQUI




  </div>
</div>
</div>

</body>
</html>