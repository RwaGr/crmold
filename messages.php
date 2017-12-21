<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<link rel="icon" href="images/favicon.png" type="image/x-icon">


<!-- chosen import-->
<link rel="stylesheet" href="source/chosen/docsupport/prism.css">
<link rel="stylesheet" href="source/chosen/chosen.css">
<!--chosen import -->

<div  id="header">

<link rel="stylesheet" href="css/style.css">
<!--<script src="js/5e65484344.js"></script>-->



<style>

#hoverit:hover, #hoverit-unread:hover {
background-color:rgba(247, 132, 3, 0.3);
}

#hoverit-unread{
    background-color: #dedede; 
}

#hoverit-selected{
    background-color:rgba(247, 132, 3, 0.3);
}


#paddingleft {
    margin-bottom:100px;
}

@media screen and (min-width:1078px) {

#colsm9margin-{
    width: 80% !important;
    margin-left: 240px !important;
}

}




@media screen and (min-width:992px) {
    
#colsm9margin- {
 margin-top:-10px !important;
}



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


#paddingright {
  
    width: 30%;

}

#paddingleft {
    width: 66%;
}

#panelleft {
    height: 657px !important;
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
    height: 550px;
    overflow-x: hidden;
    
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

/*Estilo de los mensajes en buzon*/
#msgdesc{
width: 70%;
width: 100%;
padding-left: 5px;
border-left: 1px solid #cacaca;
}


#tableofamsg{
    width: 100%;
    height: 100%;
    padding: 0px !important;
    margin: 0px;  
}

#datetd{
    min-width: 60px;
    font-size: 10px;
    padding-top: 0px !important;
}


#buttondele {
    color: #1fa0da;
}

#buttondele:hover {
    color: #000;
}

/*Estilo de los mensajes en buzon*/


</style>



<?php
require_once 'config.php';
require_once 'header.php';

// Delete messages
if (isset($_POST['deleting'])) { //if2

    if (isset($_POST['delete'])) { //if1

$name = $_POST['delete'];
    
    foreach ($name as $color){ 
     //   echo '<script>alert("'.$color.'");</script>';
  
   $model->deletemsg($color); 

    }
  } //if1
} //if2



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
if(($_POST["inputSubject"] != "") || ($_POST["inputBody"] != "") || ($_POST["inputToarray"] != "") )  {


    if(isset($_POST['inputToarray'])){
        
        $var = $_POST['inputToarray'];
        
        foreach ($var as $var1){ 
        

            $alm->__SET('msgfromuser', $_GET['activeuser']);
            $alm->__SET('msgto', trim($var1));
            $alm->__SET('msgsubject', $_POST['inputSubject']);
            $alm->__SET('msgcontent', $_POST['inputBody']);
            $alm->__SET('msgstatus', '2');
            $alm->__SET('msglocation','received');
            $alm->__SET('fromuser', '1');
            $alm->__SET('touser','1');
            $model->sendmsgfromchat($alm);
        
      // echo '<script>alert("'.$var1.'");</script>';
        
        }
        
        }

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
<?php require_once 'template/sidebar.php'; ?>
  </div>

 



<div id="newdiv">
  <div class="col-sm-9" id="colsm9margin-"  >

<br>





<div class="col-md-6" id="paddingright">
    <div class="row" id="questediv">
       
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
       <div class="panel-body" id="panelleft" style="padding:0px !important; background-color: #f5f5f5;">
       <form action="<?php echo $homeurl."messages".$session; ?>&location=sent" method="post">

             
       <div  style="height:40px; border-bottom:1px solid #dcd8d8; width:100%;" >
<div style=" height:100%; text-align:center;">

<table style="height:100%;">
<tr style="height:100%;">
<td style="min-width:26px;height:100%; border-right: 1px solid #cacaca;">
    <input type="checkbox" id="maincheck1" style="margin-top: 10px;"/> 

</td>

<td style="width: 100%; text-align: right;">

<button id="buttondele" style="margin-right:10px; margin-right: 10px; background-color: rgba(43, 33, 33, 0); border: 0px solid;" type="submit"  name="deleting" >
<i class="fa fa-trash fa-lg"></i>
</button> 

</td>
</tr>
</table>

</div>
</div>     
             
       
                 <?php foreach($model->getmsgsent($_GET['activeuser']) as $r): ?>



<?php if(isset($_GET['selectedid']) && ($_GET['selectedid']==$r->__GET('msgid'))){ //if2 ?>
    <a id="hoverit-selected" style="padding: 0px; " href="<?php echo $homeurl."messages".$session."&selectedid=".$r->__GET('msgto') ?>&location=sent" data-toggle="tooltip" data-placement="right" title="<?php echo $r->__GET('msgsubject');?>" class="list-group-item">  
<?php } else {  //if2?>
    <a id="hoverit" style="padding: 0px; " href="<?php echo $homeurl."messages".$session."&selectedid=".$r->__GET('msgto') ?>&location=sent" data-toggle="tooltip" data-placement="right" title="<?php echo $r->__GET('msgsubject');?>" class="list-group-item">  
<?php } //if2?>



<table id="tableofamsg" style="width:100%;">
<tr style="width:100%; ">


<td style="min-width: 25px; text-align: center;">
<?php if(isset($_GET['selectedid']) && ($_GET['selectedid']==$r->__GET('msgid'))){ //if1 ?>
    <input type="checkbox" name="delete[]" value="<?php echo $r->__GET('msgid'); ?>" class="" checked>
<?php } else { //if1 ?>
    <input type="checkbox" name="delete[]" value="<?php echo $r->__GET('msgid'); ?>" class="" >
<?php } ?>
</td>




<td id="msgdesc" style="width:100%; ">
<?php
$cadena1 = $r->__GET('msgfromuser'); 
$parte1 = explode(" ",$cadena1); 

$cadena2 = $r->__GET('msglastname'); 
$parte2 = explode(" ",$cadena2); 
?>
<div class="checkbox">
    <span class="name" style="display: inline-block; margin-bottom: 5px;"><strong><?php echo $parte1[0]." ".$parte2[0]; ?> </strong></span>                        
     <br> 
    <span class="left"  data-toggle="tooltip" data-placement="right" title="<?php echo $r->__GET('msgsubject');?>"><?php echo mb_substr($r->__GET('msgsubject'),0,20); ?>...</span>
</div>
</td>                          


<td  id="datetd">

<span style="position: absolute; top: 5px;"><?php echo mb_substr ($r->__GET('msgdate'),0,10); ?></span> <span class="pull-right"></span>

</td>                          
</tr>
</table>

                             </a>


<?php endforeach; ?>

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
       

                    <div class="panel-body" id="panelleft" style="padding:0px !important; background-color: #f5f5f5;">         
              
              <div id="secondpanelleft">
              
               <!--RECIBIDOS -->
<div  style="height:40px; border-bottom:1px solid #dcd8d8; width:100%;" >
<div style=" height:100%; text-align:center;">

<table style="height:100%;">
<tr style="height:100%;">
<td style="min-width:26px;height:100%; border-right: 1px solid #cacaca;">
    <input type="checkbox" id="maincheck" class="maincheck"  style="margin-top: 10px;"/> 



</td>

<td style="width: 100%; text-align: right;">

<!--AQUIi-->

<button id="buttondele" style="margin-right:10px; margin-right: 10px; background-color: rgba(43, 33, 33, 0); border: 0px solid;" type="submit"  name="deleting" >
<i class="fa fa-trash fa-lg"></i>
</button> 

</td>
</tr>
</table>

</div>
</div>     
                 
                    <?php foreach($model->getmsgbyid($_GET['activeuser']) as $r): ?>


<?php if($r->__GET('msgstatus')==2){ //if1?>
    <a id="hoverit-unread" style="padding: 0px; " href="<?php echo $homeurl."messages".$session."&selectedid=".$r->__GET('msgfrom') ?>&location=received" data-toggle="tooltip" data-placement="right" title="<?php echo $r->__GET('msgsubject');?>" class="list-group-item">  
<?php } else { //if1 ?>

<?php if(isset($_GET['selectedid']) && ($_GET['selectedid']==$r->__GET('msgid'))){ //if2 ?>
    <a id="hoverit-selected" style="padding: 0px; " href="<?php echo $homeurl."messages".$session."&selectedid=".$r->__GET('msgfrom') ?>&location=received" data-toggle="tooltip" data-placement="right" title="<?php echo $r->__GET('msgsubject');?>" class="list-group-item">  
<?php } else {  //if2?>
    <a id="hoverit" style="padding: 0px; " href="<?php echo $homeurl."messages".$session."&selectedid=".$r->__GET('msgfrom') ?>&location=received" data-toggle="tooltip" data-placement="right" title="<?php echo $r->__GET('msgsubject');?>" class="list-group-item">  
<?php } //if2?>

<?php } //if1?>

<table id="tableofamsg" style="width:100%;">
<tr style="width:100%; ">


<td style="min-width: 25px; text-align: center;">
<?php if(isset($_GET['selectedid']) && ($_GET['selectedid']==$r->__GET('msgid'))){ //if1 ?>
    <input type="checkbox" name="delete[]" value="<?php echo $r->__GET('msgid'); ?>" class="" checked>
<?php } else { //if1 ?>
    <input type="checkbox" name="delete[]" value="<?php echo $r->__GET('msgid'); ?>" class="" >
<?php } ?>
</td>


<td id="msgdesc">
<?php
$cadena1 = $r->__GET('msgfromuser'); 
$parte1 = explode(" ",$cadena1); 

$cadena2 = $r->__GET('msglastname'); 
$parte2 = explode(" ",$cadena2); 
?>

<div class="checkbox">           
    <span class="name" style="display: inline-block; margin-bottom: 5px;"><strong><?php echo $parte1[0]." ".$parte2[0]; ?> </strong></span>                        
    <br> <span class="left"><?php echo mb_substr($r->__GET('msgsubject'),0,20); ?>...</span>                     
</div>
</td>                          



<td  id="datetd">
<span style="position: absolute; top: 5px;"><?php echo mb_substr ($r->__GET('msgdate'),0,10); ?></span> <span class="pull-right"></span>
</td>


</tr>
</table>

                             </a>


<?php endforeach; ?>

</div><!--secondpanelleft-->

</div>

</form>


<!-- RECIBIDOS -->
                               
                    </div>
                </div>




           

              <!-- message here-->





            </div>
        </div>
    </div>
</div><!-- new div col sm6 -->




<!-- chat-->


        <div class="col-md-6" id="paddingleft">
            <div class="panel panel-primary" style="border-color: #fff;">

<div id="secondtorel">
                <div class="panel-body" id="divtoreload">
                    <ul class="chat">
<!-- chat starts -->


<?php if (isset($_GET['selectedid'])){ ?>

    <?php if ($_GET['selectedid'] != "" ) { ?>
       


<?php foreach($model->getonemsgbyid($_GET['activeuser']) as $r): ?>

<!--<?php// echo     $r->__GET('fromuser'); ?><?php// echo     $r->__GET('touser'); ?>  -->

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
                           <strong class="primary-font"><?php echo $r->__GET('msgfromuser'); ?></strong> 
                           
                          <small class="pull-right text-muted">

<?php

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
                                <?php echo nl2br($r->__GET('msgcontent')); ?>
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
<strong class="pull-right primary-font"><p style="margin-top: 5px; margin-right: 10px;"><?php echo $r->__GET('msgfromuser'); ?></p></strong>

<div class="chat-body clearfix">
    <div class="header">
    
    <small class="pull-left text-muted">
       
<?php


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
                                        <span class="glyphicon glyphicon-time"></span>Hace <?php print  $horatoshow; echo " ";  echo $complemento; ?></small><br>
      
    </div>
    <p>
    <?php echo nl2br($r->__GET('msgcontent')); ?>
    </p>
</div>
</li>





<?php } ?>
<?php endforeach; ?>





<span id="msgnewfromajax">


</span>



<input id="focues" style="border: #fff; margin-top:100px;" type="text" value="" readonly/>



<?php } else { ?>
    




<img src="<?php echo $homeurl."images/default/nomsg.jpg";?>">


No se ha seleccionado ningun mensaje

</li>

<?php }?>


<!-- No messages -->
<?php } else { ?>

<li class="left clearfix" style="max-height: 100% !important;      margin-top: 10%;   color: #a5a5a5; width:100%; text-align:center; border-bottom: 0px dotted #B3A9A9;">

<img src="<?php echo $homeurl."images/default/nomsg.jpg";?>"><br>

<p style="margin-top:10px;">No se ha seleccionado ningun mensaje</p>

</li>

<?php } ?>
               <!-- chat ends-->
                   
                    </ul>
                </div>





</div><!--segundo nuevo-->

                <div class="panel-footer" style="min-height: 53px;">
                <?php if(isset($_GET['location'])) { ?>
<?php if ( ($_GET['location']!="sent")) { ?>
                <form action="<?php echo $homeurl."messages".$session;?><?php echo (isset($_GET['selectedid'])) ? "&selectedid=".$_GET['selectedid'] : '';?>&msg=true" method="post">
                    <div class="input-group">                                              
                        <textarea id="btn-input" rows="4" maxlength="254" class="form-control input-sm" name="msg_content" autocomplete="off" placeholder="Escribe tu mensaje aqui..." / required ></textarea>
                        <input id="input" type="text" maxlength="100" class="form-control input-sm" name="msg_subject" style="display:none;" value="Sin asunto" />
                        <span class="input-group-btn">
                            <button type="submit" style="height: 83px; text-align:center;" class="btn btn-success btn-sm" id="btn-chat">
                              <i class="fa fa-paper-plane"></i><br>  Enviar</button>
                        </span>
                    </div>
                </form>
<?php } else { ?>

   <form action="<?php echo $homeurl."messages".$session;?><?php echo (isset($_GET['selectedid'])) ? "&selectedid=".$_GET['selectedid'] : '';?>&msg=true" method="post">
                    <div class="input-group">                                              
                        <textarea id="btn-input" rows="4" maxlength="254" class="form-control input-sm" name="msg_content" autocomplete="off" placeholder="Escribe tu mensaje aqui..." / disabled></textarea>
                        <input id="input" type="text" maxlength="100" class="form-control input-sm" name="msg_subject" style="display:none;" value="Sin asunto" />
                        <span class="input-group-btn">
                            <button type="submit" style="height: 83px; text-align:center;" class="btn btn-success btn-sm" id="btn-chat" disabled>
                              <i class="fa fa-paper-plane"></i><br>  Enviar</button>
                        </span>
                    </div>
                </form>
    <?php } ?>

<?php }  else { ?>

   <form action="<?php echo $homeurl."messages".$session;?><?php echo (isset($_GET['selectedid'])) ? "&selectedid=".$_GET['selectedid'] : '';?>&msg=true" method="post">
                    <div class="input-group">                                              
                        <textarea id="btn-input" rows="4" maxlength="254" class="form-control input-sm" name="msg_content" autocomplete="off" placeholder="Escribe tu mensaje aqui..." / ></textarea>
                        <input id="input" type="text" maxlength="100" class="form-control input-sm" name="msg_subject" style="display:none;" value="Sin asunto" />
                        <span class="input-group-btn">
                            <button type="submit" style="height: 83px; text-align:center;" class="btn btn-success btn-sm" id="btn-chat">
                              <i class="fa fa-paper-plane"></i><br>  Enviar</button>
                        </span>
                    </div>
                </form>
    <?php } ?>


</div>
            </div>
        </div>


<!-- chat -->


<div class="row" style="margin-bottom: 60px;">

<p></p>
</div>




</div> <!-- col-sm-9-->







</div>
</div>


</div><!--nuevodiv-->





<div class="modal fade" id="modalnew" style="z-index: 1099999; padding-left:0px !important;">
<div class="modal-dialog" id="modal_msg">
    <div class="modal-content">

	 <form action="<?php echo $homeurl;?>messages<?php echo $session;?>" id="form_main" method="post" enctype="multipart/form-data">
	
       <div class="modal-header" style="background-color: #5596e6;    color: #fff;">
            <a type="button" onclick="clear123();" class="close" data-dismiss="modal" aria-hidden="true" >x</a>
            <h4 class="modal-title">Nuevo mensaje interno</h4>
          </div>
       
          <div class="modal-body">
                  

        <select data-placeholder="Seleccione el destinatario..." name="inputToarray[]" class="chosen-select form-control selectpicker" multiple >
        <option value=""></option>
    <?php foreach($model->select() as $r): ?>
                        <option  value=" <?php echo $r->__GET('id'); ?>"><?php echo $r->__GET('name'); ?> <?php echo $r->__GET('lastname'); ?> - (<?php echo $r->__GET('email'); ?>)</option>
    <?php endforeach; ?>
         </select>

  


  <script src="source/chosen/chosen.jquery.js" type="text/javascript"></script>
  <script src="source/chosen/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
  <script src="source/chosen/docsupport/init.js" type="text/javascript" charset="utf-8"></script>





<script>

function clear123() {
    document.getElementById("form_main").reset();
    $( ".search-choice-close" ).click();

}


</script>

                <div id="divcontent">
                <div class="form-group">
                
                  <div class="col-sm-12"><input type="text"  class="form-control" id="inputSubject" name="inputSubject" placeholder="Asunto"  autocomplete="off" required></div>
                 

                </div>
           
                <div class="form-group" >
               
                  <div class="col-sm-12"><textarea class="form-control" style=" margin-top:10px;   height: auto !important;" id="inputBody" name="inputBody" maxlength="254" rows="10" autocomplete="off" placeholder="Escriba su mensaje aqui..." required></textarea></div>
                </div>
                </div> <!-- divcontent -->
          
 
          
          </div>
   
          
       
         
          <div class="modal-footer"     style="border-top: 0px solid #e5e5e5;" >

   
          <br>
   <br>
   <div class="col-md-12">
<input style="margin-right:10px; margin-top: 20px;" type="checkbox" value="1" name="copytomailcheck" id="copytomailcheck"/>¿Enviar copia al correo electrónico?
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


<script>





/*empieza enviar mensaje*/

$(function() {
    $("#btn-chat").click(function() {

var msg_content=jQuery('#btn-input').val();
var msg_subject=jQuery('#input').val();

$.ajax({
  type: "POST",
  url: "<?php echo $homeurl."messages".$session;?><?php echo (isset($_GET['selectedid'])) ? "&selectedid=".$_GET['selectedid'] : '';?>&msg=true",
  /*data: dataString,*/
  data: {msg_content: msg_content, msg_subject: msg_subject,} ,
  success: function(data) {

/*alert("Enviado");*/

$("#msgnewfromajax").append('<li class="right clearfix" style="max-height: 100% !important; width:100%;"><span class="chat-img pull-right">  <div  class="imgdiv30" > <?php if (!empty($alm->__GET('user_img'))) :?> <img src="<?php echo $homeurl;?>images/<?php echo $alm->__GET('user_img'); ?>?<?php echo $alm->__GET('id'); ?>" class="imgrounded30" > <?php else:?> <img src="<?php echo $homeurl;?>images/default/default.png" class="imgrounded30" > <?php endif; ?> </div>    </span> <strong class="pull-right primary-font"><p style="margin-top: 5px; margin-right: 10px;"><?php echo $cadena; ?></p></strong>  <div class="chat-body clearfix"> <div class="header">  <small class="pull-left text-muted"><span class="glyphicon glyphicon-time"></span>Hace 00 min</small><br>  </div> <p> '+ nl2br(msg_content) +' </p> </div> </li> ');

var objDiv = document.getElementById("divtoreload");
objDiv.scrollTop = objDiv.scrollHeight;

$("#btn-input").val(""); 
$("#btn-input").focus(); 


  }
});
return false;

    });
  });
/*fin enviar mensaje*/




$('#maincheck1').click(function() {

    $(this.form.elements).filter(':checkbox').prop('checked', this.checked);
});


$('.maincheck').click(function() {
    $(this.form.elements).filter(':checkbox').prop('checked', this.checked);
});

var objDiv = document.getElementById("divtoreload");
objDiv.scrollTop = objDiv.scrollHeight;

function nl2br (str, is_xhtml) {
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}


</script>


</body>


<?php
require_once 'template/footer.php';
?>






</html>



