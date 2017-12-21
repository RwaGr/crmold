<?php
require_once '../../../'.$_GET['rootpage'].'/function.php';
require_once '../../../'.$_GET['rootpage'].'/config.php';


$alm = new pdv_var();
$model = new consulta();

 $control= 0;
 $controltitle= 0;
 
 $controltitlecat = 0;
 ?>





<style>
.col-md-8{
  float: right;
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


/*
.imgrounded {
    height:100%;
    width:auto;
    margin: auto;
    max-height:150px;
}
*/


</style>



<?php foreach($model->getproducts() as $rproduct):  ?>
<!--principal abajo -->


<?php if($control==2){?>

<!--<hr>-->
<?php $control= 0;?>

<?php } ?>



<?php if (!isset($cat1)){ ?>



<?php } else { ?>


    <?php $cat2 = $rproduct->__GET('productcategory'); ?>

<?php if (($cat1!=$cat2)) { ?>

<hr>
<?php $control= 0;?>

<?php } ?>

<?php } ?>


<!--head-->

<?php if($control==0){?>

<div style="width:100%;">
<div style="border-bottom: 3px solid #136cc2; padding-bottom: 5px;  margin-bottom: 15px;">
<img src="<?php echo $_SERVER["DOCUMENT_ROOT"];?>/<?php echo $install_page;?>/images/<?php echo $logoreports;?>" style="width:200px; max-height:60px; margin-left:5%;     margin-bottom: 20px;"  alt="">

</div>

<?php if($controltitle==0){?>

<?php if(!isset($_GET['idproduct'])) { ?>
<div  style="    text-align: center;    font-size: 24px;" id="main" >
 <strong>Catálogo de productos</strong>
</div>
<br>
<?php } ?>

<?php $controltitle = 1;?>


<?php } ?>




<?php if (!isset($cat1)){ ?>



<div  style="    text-align: left;    font-size: 20px;"  >
Categoría: <strong><?php echo mb_strtoupper($rproduct->__GET('productcategory')); ?></strong>
</div>
<br>



<?php } else { ?>


    <?php $cat2 = $rproduct->__GET('productcategory'); ?>

<?php if (($cat1!=$cat2)) { ?>

<div  style="    text-align: left;    font-size: 20px;"  >
Categoría: <strong><?php echo mb_strtoupper($rproduct->__GET('productcategory')); ?></strong>
</div>
<br>



<?php } else { ?>

<div style="min-height:20px; margin-top: 70px;
    margin-bottom: 20px;">

</div>


<?php } ?>
<?php } ?>


</div> <!-- 100% -->

<?php if($controltitle==0){?>

<br>
<br>

<?php } ?>

</div>


<?php } ?>


<!--head ends up-->







<div style="width:100%; height:320px; margin-top:10px;" >

<div style="   text-align: left;  margin-left: 5%;  font-size: 20px;" id="main" >

 -Detalle del producto: <strong><?php echo  $rproduct->__GET('productname'); ?></strong>

<br>
<br>

</div>

<div  >

<div class="col-md-4" style="text-align:center;">

<?php if (!empty($rproduct->__GET('productimg')) ) { ?>

<img src="<?php echo $_SERVER["DOCUMENT_ROOT"];?>/<?php echo $install_page;?>/images/products/<?php echo  $rproduct->__GET('productimg'); ?>" style="width:100; max-height:100;"  alt="">

<?php } else { ?>

  <img src="<?php echo $_SERVER["DOCUMENT_ROOT"];?>/<?php echo $install_page;?>/images/default/default-product.png" style="width:100; max-height:100;"  alt="">

<?php } ?>

</div>

<div class="col-md-8">
<table  cellspacing="0" style=" border-collapse: collapse; width:100%;">

  <tbody>

    <tr>
        <td  ><strong>ID:</strong></td>
        <td  ><?php echo $rproduct->__GET('productid'); ?></td>

    </tr>
    <tr>
    <td  ><strong>Nombre del producto:</strong></td>
    <td  ><?php echo $rproduct->__GET('productname'); ?></td>
</tr>

    <tr>
    <td  ><strong>Categoria:</strong></td>
    <td  ><?php echo $rproduct->__GET('productcategory'); ?></td>
    </tr>


    <tr>
    <td  ><strong>Maneja inventario:</strong></td>
    <td  ><?php echo $rproduct->__GET('producthas_quant') == 1 ? 'Si' : 'No'; ?></td>
    </tr>


    <tr>
    <td  ><strong>Cantidad inventario:</strong></td>

  <td>  <?php if($rproduct->__GET('producthas_quant') == 1){ ?>

    <?php if ($rproduct->__GET('productquantity') <= $rproduct->__GET('critical_quant')) {?>
        <span  style="color: #ca3b37;  font-weight: 900;"><?php echo  $rproduct->__GET('productquantity'); ?></span>
    <?php } else {?>
 <?php echo  $rproduct->__GET('productquantity'); ?>
        <?php } ?>


<?php } else {?>

No aplica

<?php } ?></td>

    </tr>


   <!-- <tr>
    <td  ><strong>Cantidad inventario:</strong></td>
    <td  ><?php// echo $rproduct->__GET('critical_quant') == 0 ? 'No aplica' : $rproduct->__GET('critical_quant') ; ?></td>
    </tr> -->

    <?php  $number = $rproduct->__GET('productprice');?>

    <tr>
    <td  ><strong>Precio:</strong></td>
    <td  >$ <?php  echo number_format($number,0,',','.'); ?></td>
    </tr>

    <tr>
    <td  ><strong>Unidad de medida:</strong></td>
    <td  ><?php echo $rproduct->__GET('productunit') == 'NA' ? 'No aplica' : $rproduct->__GET('productunit'); ?></td>
    </tr>


</tbody>
</table>

<br>
<strong style="font-size:18px;">Descripción del producto:</strong>
 <p><?php echo  $rproduct->__GET('productdescription'); ?></p>


</div>
</div>


<br>    
<br>
<br>



</div> <!--fin principal-->
<br>

<br>


<?php $control++; ?>


<?php $cat1 = $rproduct->__GET('productcategory'); ?>


<?php endforeach ; ?>








