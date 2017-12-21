
<style>


@media screen and (min-width:100px) and (max-width:768px) {

    .footer-menu{

    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    border-top: 1px solid rgba(255,255,255,.2);
    box-shadow: 0 0 6px rgba(0,0,0,.7);
    z-index: 9999;
    height: 55px;
    background-color: #fbfbfb;
    display: block !important;

}

}



</style>



<div class="footer-menu" style="display:none;">
<div class="row" style="    padding-left: 10px;">


<!-- INICIO perfil-editar-home-->
<?php if((basename($_SERVER['PHP_SELF']) == "profile.php") || (basename($_SERVER['PHP_SELF']) == "edit-profile.php")  || (basename($_SERVER['PHP_SELF']) == "home.php")   ) { ?>

    <div style="width:20%; float: left; text-align:center;    padding: 15px;"><a style="    color: #000000;" href="<?php echo $homeurl."home".$session."";?>"><i class="fa fa-home fa-lg"></i></a>
</div>

<div style="width:20%; float: left; text-align:center;   padding: 15px;"><a  style="    color: #000000;" href="<?php echo $homeurl."messages".$session; ?>"><i class="fa fa-envelope-o fa-lg"></i></a>
</div>
<div style="width:20%; float: left; text-align:center;    padding: 15px;"><a style="    color: #000000;" href="<?php echo $homeurl."template/calendar".$session; ?>"><i class="fa fa-calendar fa-lg"></i></a>
</div>
<div style="width:20%; float: left; text-align:center;    padding: 15px;"><a style="    color: #000000;" href="<?php echo $homeurl."edit-profile".$session; ?>"><i class="fa fa-pencil-square-o fa-lg"></i></a>
</div>
<div style="width:20%; float: left; text-align:center;     padding: 15px;"><p style="text-align:center;"><a style="    color: #000000;" href="<?php echo $homeurl;?>source/logout<?php echo $session;?>"><i class="fa fa-power-off fa-lg"></i></p></a>
</div>
<?php } ?>


  <!-- MENSAJES -->
<?php if (basename($_SERVER['PHP_SELF']) == "messages.php") { ?>
 
    <div style="width:25%; float: left; text-align:center;    padding: 15px;"><a style="    color: #000000;" href="<?php echo $homeurl."home".$session."";?>"><i class="fa fa-home fa-lg"></i></a>
</div>

    <div style="width:25%; float: left; text-align:center;    padding: 15px;"><a style="    color: #000000;" href="<?php echo $homeurl."messages".$session."&location=sent";?>"><i class="fa fa-paper-plane fa-lg"></i></a>
</div>

<div style="width:25%; float: left; text-align:center;    padding: 15px;"><a style="    color: #000000;" href="<?php echo $homeurl."messages".$session."&location=received";?>"><i class="fa fa-inbox fa-lg"></i></a>
</div>

<div style="width:25%; float: left; text-align:center;   padding: 15px;"><a  style="    color: #000000;" href="" data-toggle="modal" data-target="#modalnew"><i class="fa fa-plus fa-lg"></i></a>
</div>
<?php } ?>
               
  <!-- Contactos -->
  <?php if (basename($_SERVER['PHP_SELF']) == "contacts.php") { ?>

    <div style="width:33.33%; float: left; text-align:center;    padding: 15px;"><a style="    color: #000000;" href="<?php echo $homeurl."home".$session."";?>"><i class="fa fa-home fa-lg"></i></a>
    </div>
    <div style="width:33.33%; float: left; text-align:center;    padding: 15px;"><a style="    color: #000000;" href="<?php echo $homeurl."pages/contacts".$session."&action=viewall";?>"><i class="fa fa-bars fa-lg"></i></a>
    </div>
    <div style="width:33.33%; float: left; text-align:center;   padding: 15px;"><a  style="    color: #000000;" href="<?php echo $homeurl."pages/contacts".$session."&action=new";?>"><i class="fa fa-plus fa-lg"></i></a>
    </div>

<?php } ?>


  <!-- Empresas -->
  <?php if (basename($_SERVER['PHP_SELF']) == "company.php") { ?>

<div style="width:33.33%; float: left; text-align:center;    padding: 15px;"><a style="    color: #000000;" href="<?php echo $homeurl."home".$session."";?>"><i class="fa fa-home fa-lg"></i></a>
</div>
<div style="width:33.33%; float: left; text-align:center;    padding: 15px;"><a style="    color: #000000;" href="<?php echo $homeurl."pages/company".$session."&action=viewall";?>"><i class="fa fa-bars fa-lg"></i></a>
</div>
<div style="width:33.33%; float: left; text-align:center;   padding: 15px;"><a  style="    color: #000000;" href="<?php echo $homeurl."pages/company".$session."&action=new";?>"><i class="fa fa-plus fa-lg"></i></a>
</div>

<?php } ?>



  <!-- Productos -->
  <?php if (basename($_SERVER['PHP_SELF']) == "products.php") { ?>

<div style="width:25%; float: left; text-align:center;    padding: 15px;"><a style="    color: #000000;" href="<?php echo $homeurl."home".$session."";?>"><i class="fa fa-home fa-lg"></i></a>
</div>
<div style="width:25%; float: left; text-align:center;    padding: 15px;"><a style="    color: #000000;" href="<?php echo $homeurl."pages/products".$session."&action=viewall";?>"><i class="fa fa-bars fa-lg"></i></a>
</div>

<div style="width:25%; float: left; text-align:center;   padding: 15px;"><a  style="    color: #000000;" href="<?php echo $homeurl."pages/products".$session."&action=newcategory";?>"><i class="fa fa-tags fa-lg"></i></a>
</div>

<div style="width:25%; float: left; text-align:center;   padding: 15px;"><a  style="    color: #000000;" href="<?php echo $homeurl."pages/products".$session."&action=new";?>"><i class="fa fa-plus fa-lg"></i></a>
</div>

<?php } ?>

  <!-- Oportunidades -->
  <?php if (basename($_SERVER['PHP_SELF']) == "opportunities.php") { ?>

<div style="width:33.33%; float: left; text-align:center;    padding: 15px;"><a style="    color: #000000;" href="<?php echo $homeurl."home".$session."";?>"><i class="fa fa-home fa-lg"></i></a>
</div>
<div style="width:33.33%; float: left; text-align:center;    padding: 15px;"><a style="    color: #000000;" href="<?php echo $homeurl."pages/opportunities".$session."&action=viewprospects&status=".$defaultprospectsview;?>"><i class="fa fa-bars fa-lg"></i></a>
</div>
<div style="width:33.33%; float: left; text-align:center;   padding: 15px;"><a  style="    color: #000000;" href="<?php echo $homeurl."pages/opportunities".$session."&action=newprospect";?>"><i class="fa fa-plus fa-lg"></i></a>
</div>

<?php } ?>







                    <a href="" >


</div> <!-- row -->
</div><!-- footer-menu -->