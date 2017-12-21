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


         

<?php foreach($model->getcompanies() as $r):  ?>
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
 <strong style="border-bottom: 2px solid #136cc2;">Ficha de empresa</strong>
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

 -Nombre de la empresa: <strong><?php echo  $r->__GET('name'); ?> </strong>

<br>
<br>

</div>


<div class="col-md-4" style="text-align:center;">

<?php if (!empty($r->__GET('companyimg')) ) { ?>


<img src="<?php echo $_SERVER["DOCUMENT_ROOT"];?>/<?php echo $install_page;?>/images/companies/<?php echo  $r->__GET('companyimg'); ?>" style="width:100; max-height:100;"  alt="">

<?php } else { ?>

 <img src="<?php echo $_SERVER["DOCUMENT_ROOT"];?>/<?php echo $install_page;?>/images/default/company-default.png" style="width:100; max-height:100;"  alt="">

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
    <td  ><strong>R.U.T:</strong></td>
    <td  ><?php echo $r->__GET('rf'); ?></td>

    </tr>
    <tr>
    <td  ><strong>URL:</strong></td>
    <td  ><?php echo $r->__GET('website'); ?></td>
    </tr>


    <tr>
    <td  ><strong>Industria:</strong></td>
    <td  ><?php echo $r->__GET('industry'); ?></td>
    </tr>


    <tr>
    <td  ><strong>Empleados</strong></td>
    <td  >
    
        
    <?php if (trim($r->__GET('quant')) == "9") {?>

Menos de 9

  <?php } elseif (trim($r->__GET('quant')) == "1019") { ?>

  Entre 10 y 19

    <?php } elseif (trim($r->__GET('quant')) == "2049") { ?>

Entre 20 y 49

    <?php } elseif (trim($r->__GET('quant')) == "mas50") { ?>

 Mas de 50

    <?php } ?>
    
    
    
    </td>
    </tr>


    <tr>
    <td  ><strong>Dirección:</strong></td>
    <td  ><?php echo $r->__GET('address'); ?></td>
    </tr>
    
    <?php   $almname = $model->getusername(trim($r->__GET('responsable')));  ?>

    <tr>
    <td  ><strong>Responsable:</strong></td>
    <td  ><?php echo $almname->__GET('name')." ".$almname->__GET('lastname');?></td>
    </tr>

</tbody>
</table>



<?php// if($control==1){?>

<div  style=" width:100%; padding-top:15px; ">

<?php// } else { ?>

 <!--   <div  style=" width:100%; padding-top:15px;  text-align: center;
    margin-top: 10% !important; margin-bottom:5%;"> -->

<?php// } ?>

<strong style=" border-bottom: 2px solid #136cc2;   font-size: 18px;">Notas de la empresa</strong>
<br>

<?php if (!empty(trim($r->__GET('notes')))) { ?>
<p><?php echo  $r->__GET('notes'); ?></p>
<?php } else { ?>

    <p>No tiene notas establecidas</p>

<?php } ?>

</div>

<br>

<!-- termina notas arriba -->




</div>



</div> <!--fin principal-->

<?php $control++;

if($control==2){?>

<hr>
<?php $control= 0;?>

<?php } ?>




<?php endforeach ; ?>








