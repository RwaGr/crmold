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



  
<!-- CONTENIDO A PARTIR DE AQUI hacia abajo-->
<div class="row" style="padding:10px;">
        <div class="col-sm-12">
            <div class="tab-content">

<br>

            <!-- comienza 1er tab hacia abajo -->
            <div class="tab-pane fade in " id="new">
                <div class="list-group">
                        <div class="list-group-item"> <span class="text-center">
                NUEVA
                        </div>
                </div>
            </div>
          <!-- Termina 1er tab hacia arriba -->

          <!-- comienza 2do tab hacia abajo -->
            <div class="tab-pane fade in active" id="viewall">
                <div class="list-group">
                    <div class="list-group-item"> <span class="text-center">
                VER TODAS
                    </div>
                </div>
            </div>
          <!-- Termina 2do tab hacia arriba -->





            </div>
        </div>
    </div>






<!-- CONTENIDO HASTA AQUI hacia ARRIBA -->




  </div>
</div>
</div>


</body>
</html>