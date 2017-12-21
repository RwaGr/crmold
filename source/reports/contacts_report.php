<?php
require_once '../../../'.$_GET['rootpage'].'/function.php';
require_once '../../../'.$_GET['rootpage'].'/config.php';
$alm = new pdv_var();
$model = new consulta();

 $control= 0;
 $controltitle= 0;?>





<style>
.col-md-8{
  float: left;
    width: 66.66%;
}

.col-md-4{
  float: left;
    width: 33.33%;
}

/* Salto de pagina */
hr {
  page-break-after: always;
  border: 0;
  margin: 0;
  padding: 0;
}
/* Salto de pagina */




</style>


         

<?php foreach($model->getcontacts() as $r):  ?>
<!--principal abajo -->


<!--head-->

<?php if($control==0){?>

<div style="width:100%;">
<div style="border-bottom: 3px solid #136cc2; padding-bottom: 5px;  margin-bottom: 15px;">
<img src="<?php echo $_SERVER["DOCUMENT_ROOT"];?>/<?php echo $install_page;?>/images/<?php echo $logoreports;?>" style="width:200px; max-height:60px; margin-left:5%;     margin-bottom: 20px;"  alt="">

</div>

<?php if($controltitle==0){?>

<?php if(!isset($_GET['idproduct'])) { ?>
<div  style="    text-align: center;    font-size: 24px;" id="main" >
 <strong style="border-bottom: 2px solid #136cc2;">Ficha de contacto</strong>
</div>
<br>
<?php } ?>

<?php $controltitle = 1;?>


<?php } ?>

</div> <!-- 100% -->

<?php if($controltitle==0){?>

<br>
<br>

<?php } ?>

</div>


<?php } ?>


<!--head ends up-->



<!--
//CONTACTS
	private $namecontact;
	private $lastnamecontact;
	private $sexcontact;
	private $emailcontact;
	private $phonecontact;
	private $birthdaycontact;
	private $notescontact;
	private $companycontact;
	private $chargecontact;
	private $imgcontact;
	private $addedby;
	private $assignto;
	private $added_date;
-->


<div >

<div style="   text-align: left;  margin-left: 5%;  font-size: 20px;" id="main" >

 -Nombre del contacto: <strong><?php echo  $r->__GET('namecontact'); ?> <?php echo  $r->__GET('lastnamecontact'); ?></strong>

<br>
<br>

</div>


<div class="col-md-4" style="text-align:center;">

<?php if (!empty($r->__GET('imgcontact')) ) { ?>


<img src="<?php echo $_SERVER["DOCUMENT_ROOT"];?>/<?php echo $install_page;?>/images/contacts/<?php echo  $r->__GET('imgcontact'); ?>" style="width:100; max-height:100;"  alt="">

<?php } else { ?>


 <img src="<?php echo $_SERVER["DOCUMENT_ROOT"];?>/<?php echo $install_page;?>/images/default/default.png" style="width:100; max-height:100;"  alt="">

<?php } ?>

</div>

<div class="col-md-8">
<table  cellspacing="0" style=" border-collapse: collapse; width:100%;">

  <tbody>

  <!--  <tr>
        <td  ><strong>ID:</strong></td>
        <td  ><?php// echo $r->__GET('productid'); ?></td>

    </tr> -->
    <tr>
    <td  ><strong>Sexo:</strong></td>
    <td  ><?php echo $r->__GET('sexcontact'); ?></td>

    </tr>
    <tr>
    <td  ><strong>e-mail:</strong></td>
    <td  ><?php echo $r->__GET('emailcontact'); ?></td>
    </tr>


    <tr>
    <td  ><strong>Telefono:</strong></td>
    <td  ><?php echo $r->__GET('phonecontact'); ?></td>
    </tr>


    <tr>
    <td  ><strong>Fecha de cumpleaños:</strong></td>
    <td  ><?php echo $r->__GET('birthdaycontact'); ?></td>
    </tr>

</tbody>
</table>
<br>
<br>

<strong style=" border-bottom: 2px solid #136cc2;   font-size: 18px;">Redes sociales</strong>
<br>
<br>
<?php
$emailtocheck = $r->__GET('id');;
$controlvar = 0;


 foreach($model->getsocial($emailtocheck) as $rsn): ?>


<?php if(trim($rsn->__GET('social_content'))!="") { ?>

<table>
    <tbody>
<tr>
<td><strong><?php echo $rsn->__GET('social_name');?>:</strong></td>
<td><?php echo $rsn->__GET('social_content');?></td>
</tr>


</tbody>
</table>


<?php ++$controlvar;?>



<?php } ?>

<?php endforeach; ?>



<?php if($controlvar == 0) { ?>

<p  style="line-height: 1;
    font-size: 14px;">No tiene redes sociales asociadas</p>
  <?php } ?>

<!-- termina redes sociales arriba-->


<br>    


<?php// if($control==1){?>

<div  style=" width:100%; padding-top:15px; ">

<?php// } else { ?>

 <!--   <div  style=" width:100%; padding-top:15px;  text-align: center;
    margin-top: 10% !important; margin-bottom:5%;"> -->

<?php// } ?>

<strong style=" border-bottom: 2px solid #136cc2;   font-size: 18px;">Notas del contacto</strong>
<br>

<?php if (!empty($r->__GET('notescontact'))) { ?>
<p><?php echo  $r->__GET('notescontact'); ?></p>
<?php } else { ?>

    <p>No tiene notas establecidas</p>

<?php } ?>

</div>

<br>

<!-- termina notas arriba -->


<strong style=" border-bottom: 2px solid #136cc2;   font-size: 18px;">  Datos empresariales</strong>
  <br>
  <br>

  <table>
      <tbody>
<tr>
    <td><strong>Cargo: </strong></td>
    <td><?php echo $r->__GET('chargecontact');?></td>
</tr>

<tr>
    <td><strong>Empresa: </strong></td>
    <td><?php echo $r->__GET('companycontact');?></td>
</tr>

<tbody>
  </table>




</div>



</div> <!--fin principal-->

<?php $control++;

if($control==2){?>

<hr>
<?php $control= 0;?>

<?php } ?>




<?php endforeach ; ?>








