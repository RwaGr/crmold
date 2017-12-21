<?php
require_once '../../../'.$_GET['rootpage'].'/function.php';
require_once '../../../'.$_GET['rootpage'].'/config.php';

$alm = new pdv_var();
$model = new consulta();


 ?>





<style>
/*.col-md-8{
  float: right;
    width: 66.66%;
}

.col-md-4{
  float: left;
    width: 33.33%;
}
*/
/* Salto de pagina */
hr {
  page-break-after: always;
  border: 0;
  margin: 0;
  padding: 0;
}
/* Salto de pagina str_pad($invID, 4, '0', STR_PAD_LEFT); */

.td-table{
  border: 1px solid #a7a7a7;
  height: 30px; 
  padding-left: 10px;
  padding-right: 10px; 
}

</style>

<!--$almcuotes1->__SET('cuotesid', $rcuotes1->id);
			$almcuotes1->__SET('prospect', $rcuotes1->prospect);
			$almcuotes1->__SET('cuotedate', $rcuotes1->added_date);
			$almcuotes1->__SET('totalcuote', $rcuotes1->total);
			$almcuotes1->__SET('cuotename', $rcuotes1->name);
			$almcuotes1->__SET('cuotelastname', $rcuotes1->lastname);
			$almcuotes1->__SET('emailcontact', $rcuotes1->email);
			$almcuotes1->__SET('phonecontact', $rcuotes1->phone);
			$almcuotes1->__SET('companycontact', $rcuotes1->companyname);
-->

<?php foreach($model->getcuotesoftheprospect() as $rcuotes1):  ?>

<div style="width:100%;">
<div style="border-bottom: 3px solid #136cc2; padding-bottom: 5px;  margin-bottom: 15px;">
<img src="<?php echo $_SERVER["DOCUMENT_ROOT"];?>/<?php echo $install_page;?>/images/<?php echo $logoreports;?>" style="width:200px; max-height:60px; margin-left:5%;     margin-bottom: 20px;"  alt="">

<div style="float:right;" >

<p>
<strong>Fecha:  </strong><?php echo $rcuotes1->__GET('cuotedate');?>
<br><strong>Nro. cotización:  </strong><?php echo str_pad($rcuotes1->__GET('cuotesid'), 6, '0', STR_PAD_LEFT);?>
</p>

</div>



</div>
</div>

<div style="width:100%; ">
<p style="font-size:22px; text-align:center; font-weight: 700;"> Datos de la cotización </p>
<table  cellspacing="0" style=" border-collapse: collapse; width:100%; position:absolute;">


<tr class="tr-table">
<td class="td-table" style="background-color: rgba(228, 228, 228, 0.7); ">
<strong>Empresa:</strong>
</td>
<td class="td-table" style="width:25%;">
<?php echo $rcuotes1->__GET('companycontact');?>
</td>


<td class="td-table" style="background-color: rgba(228, 228, 228, 0.7); ">
<strong>Contacto:</strong>
</td>
<td class="td-table">
<?php echo $rcuotes1->__GET('cuotename');?> <?php echo $rcuotes1->__GET('cuotelastname');?>
</td>

</tr>



<tr class="tr-table" >
<td class="td-table" style="background-color: rgba(228, 228, 228, 0.7);">
<strong>Teléfono:</strong>
</td>
<td class="td-table">
<?php echo $rcuotes1->__GET('phonecontact');?>
</td>

<td class="td-table" style="background-color: rgba(228, 228, 228, 0.7);">
<strong>Correo electrónico:</strong>
</td>
<td  class="td-table">
<?php echo $rcuotes1->__GET('emailcontact');?>
</td>
</tr>


</table>
</div>

<br>
<br>
<br>
<br>
<br>
<br>


<div style="width:100%;">
<table  cellspacing="0" style=" border-collapse: collapse; width:100%; position:absolute;">

<tr class="tr-table" style="background-color: rgba(228, 228, 228, 0.7);">
<td class="td-table"><strong>Cant</strong></td>
<td class="td-table"><strong>Descripción</strong></td>
<td class="td-table"><strong>Precio unitario</strong></td>
<td class="td-table"><strong>Descuento</strong></td>
<td class="td-table"><strong>Sub-total</strong></td>
</tr>




<?php foreach($model->getpp3foracuote('0') as $rcuotepp3): ?>

<tr class="tr-table">

<td class="td-table" >
<?php echo $rcuotepp3->__GET('pp3_quantity');?>
</td>
<td class="td-table" >
<?php echo $rcuotepp3->__GET('productname');?>
</td>

<td class="td-table" style="text-align:center;">
<?php echo number_format($rcuotepp3->__GET('priceofthecuote'),0, ',', '.');?>
</td>

<td class="td-table" style="text-align:center;">
<?php echo $rcuotepp3->__GET('pp3_discount');?> %
</td>

<td class="td-table" style="text-align:center;">
<?php echo number_format($rcuotepp3->__GET('pp3_priceafter'),0, ',', '.');?>
</td>

</tr>

<?php endforeach; ?>

<tr >

<td colspan=3 class="td-table" style="border-bottom: 0px; border-left: 0px;">
</td>


<td class="td-table" style="background-color: rgba(228, 228, 228, 0.7);">
<strong>Neto ($):</strong>
</td>

<td class="td-table" style="background-color: rgba(228, 228, 228, 0.7); text-align:center;">
<?php echo number_format($rcuotes1->__GET('totalcuote'),0, ',', '.');?>
</td>
</tr>




</table>


</div>

<!--
<div style="width:100%; border-top: 3px solid #136cc2; position:fixed; top:770px">

INFO FOOTER

</div>
-->


<?php endforeach;?>
