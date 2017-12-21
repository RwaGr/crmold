
<!DOCTYPE html>
<html lang="en">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<link rel="icon" href="images/favicon.png" type="image/x-icon">




<div  id="header">

<link rel="stylesheet" href="css/style.css">
<script src="js/5e65484344.js"></script>



<style>





@media screen and (min-width:992px) {
    
    #paddingright {
    padding-right:0px;
    margin-left: 4%;
}

#paddingleft {
    padding-left:0px;
}


td, th {

    border-top: 0px solid #fff !important;
}


#paddingright, #paddingleft{
 
    width: 48%;

}

}



li {
    width: 11.11%;
    max-height: 36px;
     }


.chat
{
    list-style: none;
    margin: 0;
    padding: 0;
}

.chat li
{
    margin-bottom: 10px;
    padding-bottom: 5px;
    border-bottom: 1px dotted #B3A9A9;
}

.chat li.left .chat-body
{
    margin-left: 60px;
}

.chat li.right .chat-body
{
    margin-right: 60px;
}


.chat li .chat-body p
{
    margin: 0;
    color: #777777;
}

.panel .slidedown .glyphicon, .chat .glyphicon
{
    margin-right: 5px;
}

.panel-body
{
    background-color: #FFF;
    overflow-y: scroll;
    height: 400px;
}



::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}

::-webkit-scrollbar-thumb
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
}

</style>



<?php
include 'config.php';
include 'header.php';

// Delete messages
if (isset($_POST['deleting'])) {

$name = $_POST['delete'];
    
    foreach ($name as $color){ 
        echo '<script>alert("'.$color.'");</script>';
    //   $model->deletesent($color);


    }

}



if (isset($_GET['selectedid'])) {

    if ($_GET['selectedid']!="") {

if(isset($_GET['location'])){


    $model->updatemsgstatustobyid($_GET['activeuser']);


} else {



    if (isset($_GET['msg'])) {
        // send message 
            if ($_POST['msg_content'] != ""){
                
        $alm->__SET('msgfromuser', $_GET['activeuser']);
        $alm->__SET('msgto', $_GET['selectedid']);
        $alm->__SET('msgsubject', $_POST['msg_subject']);
        $alm->__SET('msgcontent', $_POST['msg_content']);
        $alm->__SET('msgstatus', '2');
        $alm->__SET('msglocation','received');
        $alm->__SET('fromuser', '1');
        $alm->__SET('touser','1');
      
        $model->sendmsgfromchat($alm);
        
            }
        
        } 

    }

    }

}


//send new message from form
if(isset($_POST["sendmessage"])) {
if(($_POST["inputSubject"] != "") || ($_POST["inputBody"] != "") || ($_POST["inputTo"] != "") )  {

    $alm->__SET('msgfromuser', $_GET['activeuser']);
    $alm->__SET('msgto', trim($_POST['inputid']), " ");
    $alm->__SET('msgsubject', $_POST['inputSubject']);
    $alm->__SET('msgcontent', $_POST['inputBody']);
    $alm->__SET('msgstatus', '2');
    $alm->__SET('msglocation','received');
    $alm->__SET('fromuser', '1');
    $alm->__SET('touser','1');
    $model->sendmsgfromchat($alm);

}
}



?>

</div>



</head>


<body>




<div id="profile_cont" class="container" style="margin: 0px; padding: 0px; width: 100%;">
<div class="row">
  <div  id="sidebar_div" class="col-sm-3">
  <!-- including sidebar from templates-->
<?php include 'template/sidebar.php'; ?>
  </div>

 

  <div class="col-sm-9" >

<br>


<div class="col-md-6" id="paddingright">
    <div class="row">
       
        <div class="col-sm-12">
            <div class="tab-content">



            <?php if (isset($_GET['location'])) { ?>
    
  <?php  if ($_GET['location'] == "sent"){ ?>

    <div class="tab-pane fade in  active" id="send">
        
  <?php } else { ?>

    <div class="tab-pane fade in" id="send">

  <?php } ?>

  <?php } else { ?>
    <div class="tab-pane fade in" id="send">

  <?php } ?>



                 <!-- Enviados-->
       <div class="panel-body">
                 <form action="<?php echo $homeurl."messages".$session; ?>&location=sent" method="post">

                 <?php foreach($model->getmsgsent($_GET['activeuser']) as $r): ?>


<a href="<?php echo $homeurl."messages".$session."&selectedid=".$r->__GET('msgto') ?>&location=sent" data-toggle="tooltip" data-placement="right" title="<?php echo $r->__GET('msgsubject');?>" class="list-group-item">  

<table style="width:100%;">
<tr style="width:100%;">


<style>
#imgtd, #datetd {
    width: 15%;
}
#msgdesc{
width: 70%;
}

@media screen and (max-width: 768px){
#imgtd {
    width: 20%;
}
#datetd{
    display:none;
}
#msgdesc{
width: 80%;
} 
}

</style>

<td id="imgtd" >

<div  class="imgdiv30">
    <?php if (!empty($r->__GET('msgimguser'))) :?>
<img src="<?php echo $homeurl;?>images/<?php echo $r->__GET('msgimguser'); ?>?<?php echo $r->__GET('msgid'); ?>" class="imgrounded30"  >
    <?php else:?>
<img src="<?php echo $homeurl;?>images/default/default.png" class="imgrounded30" >
    <?php endif; ?>
</div>

</td>

<td id="msgdesc">
<?php
$cadena1 = $r->__GET('msgfromuser'); 
$parte1 = explode(" ",$cadena1); 

$cadena2 = $r->__GET('msglastname'); 
$parte2 = explode(" ",$cadena2); 
?>
                            <div class="checkbox">
                                <label class="">
                                    <input type="checkbox" name="delete[]" value="<?php echo $r->__GET('msgid'); ?>" class="">
                                    <span class="name" style="display: inline-block; margin-bottom: 5px;"><strong><?php echo $parte1[0]." ".$parte2[0]; ?> </strong></span>                        
                                </label>
                                <br> <span class="left"  data-toggle="tooltip" data-placement="right" title="<?php echo $r->__GET('msgsubject');?>"><?php echo substr($r->__GET('msgsubject'),0,20); ?>...</span>




                            </div>
</td>                          


<td id="datetd">

<span class="badge"><?php echo substr ($r->__GET('msgdate'),0,10); ?></span> <span class="pull-right"></span>

</td>                          
</tr>
</table>

                             </a>


<?php endforeach; ?>

</div>
	

<div class="panel-footer col-sm-12">

<div class="row">
<div class="col-sm-6" style="margin-top:5px;">
<input type="checkbox" id="maincheck1"/> Seleccionar todo
</div>
<div class="col-sm-6" >
<button type="submit" class="btn btn-danger pull-right" name="deleting"  ><i class="fa fa-trash"></i> Papelera</button> 
</div>
</div>


<script>
$('#maincheck1').click(function() {

    $(this.form.elements).filter(':checkbox').prop('checked', this.checked);
});
</script>


</div>

</form>



                                     <!-- Enviados-->
 </div>


<?php if (isset($_GET['location'])) { ?>
    
  <?php  if ($_GET['location'] == "received"){ ?>

    <div class="tab-pane fade in  active" id="received">
        
  <?php } else { ?>

    <div class="tab-pane fade in" id="received">

  <?php } ?>

  <?php } else { ?>

    <div class="tab-pane fade in  active" id="received">

  <?php } ?>
               
                    <div class="list-group">


                    <form action="<?php echo $homeurl."messages".$session; ?>&location=received" method="post">
       
                    <div class="panel-body">         
               <!--RECIBIDOS -->
                    <?php foreach($model->getmsgbyid($_GET['activeuser']) as $r): ?>
   

<a href="<?php echo $homeurl."messages".$session."&selectedid=".$r->__GET('msgfrom') ?>&location=received" data-toggle="tooltip" data-placement="right" title="<?php echo $r->__GET('msgsubject');?>" class="list-group-item">  

<table style="width:100%;">
<tr style="width:100%;">


<style>
#imgtd, #datetd {
    width: 15%;
}
#msgdesc{
width: 70%;
}

@media screen and (max-width: 768px){
#imgtd {
    width: 20%;
}
#datetd{
    display:none;
}
#msgdesc{
width: 80%;
} 
}

</style>

<td id="imgtd" >

<div class="imgdiv30" >
    <?php if (!empty($r->__GET('msgimguser'))) :?>
<img src="<?php echo $homeurl;?>images/<?php echo $r->__GET('msgimguser'); ?>?<?php echo $r->__GET('msgid'); ?>" class="imgrounded30" >
    <?php else:?>
<img src="<?php echo $homeurl;?>images/default/default.png" class="imgrounded30" >
    <?php endif; ?>
</div>

</td>

<td id="msgdesc">
<?php
$cadena1 = $r->__GET('msgfromuser'); 
$parte1 = explode(" ",$cadena1); 

$cadena2 = $r->__GET('msglastname'); 
$parte2 = explode(" ",$cadena2); 
?>
                            <div class="checkbox">
                                <label class="">
                                    <input type="checkbox" name="delete[]" value="<?php echo $r->__GET('msgid'); ?>" class="">
                                </label>
                            </div>
                           <span class="name" style="display: inline-block; margin-bottom: 5px;"><strong><?php echo $parte1[0]." ".$parte2[0]; ?> </strong></span>                        
                           <br> <span class="left"><?php echo substr($r->__GET('msgsubject'),0,20); ?>...</span>


                          

                        </td>                          


<td id="datetd">

<span class="badge"><?php echo substr ($r->__GET('msgdate'),0,10); ?></span> <span class="pull-right"></span>


<?php if($r->__GET('msgstatus')==2){ ?>
    <br>
<div class="pull-right">
<span class="badge" style="    background-color: #ef0101; width: 15px; height: 15px;     margin: 10px;"> </span>
</div>
<?php } ?>

</td>                          
</tr>
</table>

                             </a>


<?php endforeach; ?>
</div>
<div class="panel-footer col-sm-12">

<div class="row">
<div class="col-sm-6" style="margin-top:5px;">
<input type="checkbox" id="maincheck"/> Seleccionar todo
</div>
<div class="col-sm-6" >
<button type="submit" class="btn btn-danger pull-right" name="deleting"  ><i class="fa fa-trash"></i> Papelera</button> 
</div>

</div>



<script>
	
$('#maincheck').click(function() {
    $(this.form.elements).filter(':checkbox').prop('checked', this.checked);
});
	
	</script>


</div>

</form>


<!-- RECIBIDOS -->
                               
                    </div>
                </div>




                <?php if (isset($_GET['location'])) { ?>
    
  <?php  if ($_GET['location'] == "trash"){ ?>

    <div class="tab-pane fade in active" id="trash">
        
  <?php } else { ?>

    <div class="tab-pane fade in" id="trash">

  <?php } ?>

  <?php } else { ?>
    <div class="tab-pane fade in" id="trash">

  <?php } ?>

               


  <div class="list-group">
  
  
                      <form action="<?php echo $homeurl."messages".$session; ?>&location=trash" method="post">
         
                      <div class="panel-body">         
                 <!--TRASH -->
                      <?php foreach($model->getmsgbyidtrash($_GET['activeuser']) as $r): ?>
  
  
  
  
  <a href="<?php echo $homeurl."messages".$session."&selectedid=".$r->__GET('msgfrom') ?>&location=trash" data-toggle="tooltip" data-placement="right" title="<?php echo $r->__GET('msgsubject');?>" class="list-group-item">  
  
  <table style="width:100%;">
  <tr style="width:100%;">
  
  
  <style>
  #imgtd, #datetd {
      width: 15%;
  }
  #msgdesc{
  width: 70%;
  }
  
  @media screen and (max-width: 768px){
  #imgtd {
      width: 20%;
  }
  #datetd{
      display:none;
  }
  #msgdesc{
  width: 80%;
  } 
  }
  
  </style>
  
  <td id="imgtd" >
  
  <div class="imgdiv30" >
      <?php if (!empty($r->__GET('msgimguser'))) :?>
  <img src="<?php echo $homeurl;?>images/<?php echo $r->__GET('msgimguser'); ?>?<?php echo $r->__GET('msgid'); ?>" class="imgrounded30" >
      <?php else:?>
  <img src="<?php echo $homeurl;?>images/default/default.png" class="imgrounded30" >
      <?php endif; ?>
  </div>
  
  </td>
  
  <td id="msgdesc">
  <?php
  $cadena1 = $r->__GET('msgfromuser'); 
  $parte1 = explode(" ",$cadena1); 
  
  $cadena2 = $r->__GET('msglastname'); 
  $parte2 = explode(" ",$cadena2); 
  ?>
                              <div class="checkbox">
                                  <label class="">
                                      <input type="checkbox" name="delete[]" value="<?php echo $r->__GET('msgid'); ?>" class="">
                                  </label>
                              </div>
                             <span class="name" style="display: inline-block; margin-bottom: 5px;"><strong><?php echo $parte1[0]." ".$parte2[0]; ?> </strong></span>                        
                             <br> <span class="left"><?php echo substr($r->__GET('msgsubject'),0,20); ?>...</span>
  
  
                            
  
                          </td>                          
  
  
  <td id="datetd">
  
  <span class="badge"><?php echo substr ($r->__GET('msgdate'),0,10); ?></span> <span class="pull-right"></span>
  
  
  <?php if($r->__GET('msgstatus')==2){ ?>
      <br>
  <div class="pull-right">
  <span class="badge" style="    background-color: #ef0101; width: 15px; height: 15px;     margin: 10px;"> </span>
  </div>
  <?php } ?>
  
  </td>                          
  </tr>
  </table>
  
                               </a>
  
  
  <?php endforeach; ?>
  </div>
  <div class="panel-footer col-sm-12">
  
  <div class="row">
  <div class="col-sm-6" style="margin-top:5px;">
  <input type="checkbox" id="maincheck8"/> Seleccionar todo
  </div>
  <div class="col-sm-6" >
  <button type="submit" class="btn btn-danger pull-right" name="deleting"  ><i class="fa fa-trash"></i> Eliminar</button> 
  </div>
  
  </div>
  
  
  
  <script>
      
  $('#maincheck8').click(function() {
      $(this.form.elements).filter(':checkbox').prop('checked', this.checked);
  });
      
      </script>
  
  
  </div>
  
  </form>
  
  
  <!-- TRASH -->
                                 
                      </div>-->
 </div>

              <!-- message here-->





            </div>
        </div>
    </div>
</div><!-- new div col sm6 -->




<!-- chat-->


        <div class="col-md-6" id="paddingleft">
            <div class="panel panel-primary" style="border-color: #fff;">

                <div class="panel-body">
                    <ul class="chat">
<!-- chat starts -->


<?php if (isset($_GET['selectedid'])){ ?>

    <?php if ($_GET['selectedid'] != "" ) { ?>

        <?php if (!isset($_GET['msg'])) { ?>
        


<?php foreach($model->getonemsgbyid($_GET['activeuser']) as $r): ?>

<?php echo     $r->__GET('fromuser'); ?><?php echo     $r->__GET('touser'); ?>  

<?php if ($_GET['activeuser'] == $r->__GET('msgto')) { ?>

<!-- Mensajes de usuario contrario -->

<li class="left clearfix" style="max-height: 100% !important; width:100%;"><span class="chat-img pull-left" >                           
<div   class="imgdiv30" >
                        <?php if (!empty($r->__GET('msgimguser'))) :?>
<img src="<?php echo $homeurl;?>images/<?php echo $r->__GET('msgimguser'); ?>?<?php echo $r->__GET('msgto');?>" class="imgrounded30">
    <?php else:?>
<img src="<?php echo $homeurl;?>images/default/default.png" class="imgrounded30" >
    <?php endif; ?>
            </div>                          
               </span>
                   <div class="chat-body clearfix">
                        <div class="header">
                           <strong class="primary-font"><?php echo $r->__GET('msgfromuser'); ?></strong> <small class="pull-right text-muted">

<?php
date_default_timezone_set('America/Santiago');
$datenow = date('m/d/Y h:i:s a', time());



$dteStart = new DateTime($datenow); 
$dteEnd   = new DateTime($r->__GET('msgdate')); 

$dteDiff  = $dteStart->diff($dteEnd); 

$horas= $dteDiff->format("%H");
$diascal = $dteDiff->format('%a')."\n";


if ($diascal > 0){
    $complemento="día(s)";
    $horatoshow = $dteDiff->format('%a')."\n";


} else {
if ($horas == 1){
    $complemento ="hora";
    $horatoshow = $dteDiff->format("%H");
} elseif  ($horas > 1 ) {
    $complemento ="horas";
    $horatoshow = $dteDiff->format("%H");
} elseif  ($horas == 0 ) {
    $complemento="min";
    $horatoshow = $dteDiff->format("%I"); 
    
}
}


$havis = "Hace";


?>
                                                        
                                        <span class="glyphicon glyphicon-time"></span><?php echo $havis;  ?> <?php print  $horatoshow; echo " ";  echo $complemento; ?></small>
                                </div>
                                <p>
                                <?php echo $r->__GET('msgcontent'); ?>
                                </p>
                            </div>
                        </li>



<?php } else { ?>

<!-- mensaje de current user -->

<li class="right clearfix" style="max-height: 100% !important; width:100%;"><span class="chat-img pull-right">
<div  class="imgdiv30" >
                        <?php if (!empty($r->__GET('msgimguser'))) :?>
<img src="<?php echo $homeurl;?>images/<?php echo $r->__GET('msgimguser'); ?>?<?php echo $r->__GET('msgto');?>" class="imgrounded30" >
    <?php else:?>
<img src="<?php echo $homeurl;?>images/default/default.png" class="imgrounded30" >
    <?php endif; ?>
            </div>    
</span>
<div class="chat-body clearfix">
    <div class="header">
       
<?php
date_default_timezone_set('America/Santiago');
$datenow = date('m/d/Y h:i:s a', time());



$dteStart = new DateTime($datenow); 
$dteEnd   = new DateTime($r->__GET('msgdate')); 

$dteDiff  = $dteStart->diff($dteEnd); 

$horas= $dteDiff->format("%H");
if ($horas == 1){
    $complemento ="hora";
    $horatoshow = $dteDiff->format("%H");
} elseif  ($horas > 1 ) {
    $complemento ="horas";
    $horatoshow = $dteDiff->format("%H");
} elseif  ($horas == 0 ) {
    $complemento="min";
    $horatoshow = $dteDiff->format("%I");
}



?>                          
                                        <span class="glyphicon glyphicon-time"></span>Hace <?php print  $horatoshow; echo " ";  echo $complemento; ?></small>
        <strong class="pull-right primary-font"><?php echo $r->__GET('msgfromuser'); ?></strong>
    </div>
    <p>
    <?php echo $r->__GET('msgcontent'); ?>
    </p>
</div>
</li>


<?php } ?>
<?php endforeach; ?>

<input style="border: #fff;" type="text" value="" autofocus readonly/>


<?php } else { ?>
    
    <li class="left clearfix" style="max-height: 100% !important; width:100%;"><span class="chat-img pull-left"> 

No se ha seleccionado ningun mensaje

</li>

<?php }?>


<?php } else { ?>
    
    <li class="left clearfix" style="max-height: 100% !important; width:100%;"><span class="chat-img pull-left"> 

No se ha seleccionado ningun mensaje

</li>

<?php }?>


<!-- No messages -->
<?php } else { ?>

<li class="left clearfix" style="max-height: 100% !important; width:100%;"><span class="chat-img pull-left"> 

No se ha seleccionado ningun mensaje

</li>

<?php } ?>
               <!-- chat ends-->
                   
                    </ul>
                </div>
                <div class="panel-footer" style="min-height: 53px;">

       <?php if(isset($_GET['location']) && ($_GET['location']!="trash") ){ ?> 
                <form action="<?php echo $homeurl."messages".$session."&selectedid=";?><?php echo (isset($_GET['selectedid'])) ? $_GET['selectedid'] : '';?>&msg=true" method="post">
                    <div class="input-group">                                              
                        <input id="btn-input" type="text" maxlength="254" class="form-control input-sm" name="msg_content" autocomplete="off" placeholder="Escribe tu mensaje aqui..." / required>
                        <input id="input" type="text" maxlength="100" class="form-control input-sm" name="msg_subject" style="display:none;" value="Sin asunto" />
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-success btn-sm" id="btn-chat">
                                Enviar</button>
                        </span>
                    </div>
                </form>
     <?php } ?>
                </div>
            </div>
        </div>


<!-- chat -->






</div> <!-- col-sm-9-->



<div class="modal fade" id="modalnew">
<div class="modal-dialog" id="modal_msg">
    <div class="modal-content">

	 <form action="<?php echo $homeurl;?>messages<?php echo $session;?>&location=sent" id="form_main" method="post" enctype="multipart/form-data">
	
       <div class="modal-header" style="background-color: #5596e6;  border-radius: 5px 5px 0px 0px;  color: #fff;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="clear123();">×</button>
            <h4 class="modal-title">Nuevo mensaje</h4>
          </div>
       
          <div class="modal-body">
          
                <div class="form-group">
          
                  <div class="col-sm-12" style="padding-bottom: 10px;"><input type="text" class="form-control" id="inputTo" name="inputTo" onkeyup="myFunction()" placeholder="Para" autocomplete="off" required></div>
                </div>


<!-- table with data -->
<table class="table" id="myTable" style="width:100%; display:none; min-height: 150px;">
  
  
  <tr class="header" style=" display:none; width:100%; text-align:left !important;">
      <th style="width:10%; display:none;">Id</th>
    <th style="width:50%;"><strong>Nombre</strong></th>
    <th style="width:40%;"><strong>Usuario</strong></th>
  </tr>

    <?php foreach($model->select() as $r): ?>
                        <tr>
                            <td style="display:none;" id="<?php echo $r->__GET('id'); ?>-1"> <?php echo $r->__GET('id'); ?></td>
                            <td><a href="#" onclick="myFunction<?php echo $r->__GET('id'); ?>()"><?php echo $r->__GET('name'); ?></a></td>
                            <td id="<?php echo $r->__GET('id'); ?>"><?php echo $r->__GET('email'); ?></td>   
                        </tr>

                        <?php

echo '<script>
function myFunction'.$r->__GET('id').'() {
 
 document.getElementById("inputTo").value = document.getElementById("'.$r->__GET('id').'").innerHTML;
 document.getElementById("inputid").value = document.getElementById("'.$r->__GET('id').'-1").innerHTML;
 $("#inputTo").attr("readonly", true);

 document.getElementById("divcontent").style.display = "block";
        document.getElementById("myTable").style.display = "none";

}
</script>';
?>


    <?php endforeach; ?>


    <tr id='noresult' style="display:none;"><td>No hay resultados<td></tr>

</table>



<script>

function clear123() {
    document.getElementById("form_main").reset();
    document.getElementById("divcontent").style.display = "block";
    document.getElementById("myTable").style.display = "none";
    $("#inputTo").attr("readonly", false);
}


/* checking the table */
function myFunction() {

    if (document.getElementById("inputTo").value == "") {
        
        document.getElementById("divcontent").style.display = "block";
        document.getElementById("myTable").style.display = "none";
        
        } else {
        
        document.getElementById("divcontent").style.display = "none";
        document.getElementById("myTable").style.display = "block";
        
        }

  var input, filter, table, tr, td, i;
  input = document.getElementById("inputTo");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  
 var control = 0;
 var controlength = (tr.length - 1);
  
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";


        
      } else {
        tr[i].style.display = "none";

control = control + 1;


if (control < controlength) {
    
    document.getElementById("noresult").style.display = "none";

} else {
    document.getElementById("noresult").style.display = "block";

}

      }
    }       
  } 



}
</script>

                <div id="divcontent">
                <div class="form-group">
                
                  <div class="col-sm-12"><input type="text"  class="form-control" id="inputSubject" name="inputSubject" placeholder="Asunto"  autocomplete="off" required></div>
                  <div class="col-sm-10" style="display:none;"><input type="text" class="form-control" maxlength="50"  id="inputid" name="inputid" placeholder="" autocomplete="off" required></div>

                </div>
           
                <div class="form-group" >
               
                  <div class="col-sm-12"><textarea class="form-control" style=" margin-top:10px;   height: auto !important;" id="inputBody" name="inputBody" maxlength="254" rows="10" autocomplete="off" placeholder="Escriba su mensaje aqui..." required></textarea></div>
                </div>
                </div> <!-- divcontent -->
          </div>
   

         
          <div class="modal-footer"     style="border-top: 0px solid #e5e5e5;" >

    <div class="row" >
    <div class="form-group">
  <div class="col-md-12 inputGroupContainer" style="margin-bottom:10px;">

  <div class="checkbox">
 <input type="checkbox" value="1" name="copytomailcheck" id="copytomailcheck"/>¿Enviar copia al correo electrónico?
  </div>
</div>
</div>
</div>

            <button type="button" class="btn btn-default pull-left" style="margin-top:10px;" data-dismiss="modal" onclick="clear123();" value="Reset form"> <i class="fa fa-arrow-circle-o-left fa-lg"></i> Cerrar</button> 
            <button type="button" class="btn btn-danger pull-left"  style="margin-top:10px;"  onclick="clear123();">
Cancelar <i class="fa fa-trash fa-lg" aria-hidden="true"></i> 
</button>
            <button type="submit" class="btn btn-success" name="sendmessage" style="margin-top:10px;">Enviar<i class="fa fa-arrow-circle-right fa-lg" style="margin-left:5px;"></i></button>
           
            
          </div>

        </form>
    </div> <!-- modal content -->
</div> <!-- modal dialog -->
</div> <!-- modal_img -->





</div>
</div>

</body>
</html>



