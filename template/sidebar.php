  
  <div class="sidebar-nav" style="height:100vh;  padding-right: 0px !important; max-width:280px;">
      <div class="navbar navbar-default" id="sidebartohide" style="background-image: linear-gradient(to bottom,#fff 0,#fff 100%); height:100%" role="navigation">
        <div class="navbar-collapse collapse sidebar-navbar-collapse" >



        <?php  $alm1 = $model->getmsgscount($_GET['activeuser']);?>  

        <nav class="main-menu" style="box-shadow: 4px 4px 8px 4px rgba(0,0,0,0.2);">
            <ul >


    


                <li  class="has-subnav">
                    <a  href="<?php echo $homeurl;?>profile<?php echo $session; ?>">  
                        

<div style="width: 60px;">
                    <div id="profileimg_nav" class="imgdiv30" style="width: 30px; margin: auto;  height: 30px;  margin-top: 3px;">
    <?php if (!empty($alm->__GET('user_img'))) :?>
<img src="<?php echo $homeurl;?>images/<?php echo $alm->__GET('user_img'); ?>?<?php echo $alm->__GET('id'); ?>" class="imgrounded30" id="profileimg_img">
    <?php else:?>
<img src="<?php echo $homeurl;?>images/default/default.png" class="imgrounded30" id="profileimg_img">
    <?php endif; ?>
</div>
</div>


                        <span style="  width:100%;  text-align: left; font-size: 15px !important;" class="nav-text fa1">
                          Perfil de <?php echo $parte[0]; ?>

                            <?php if ((basename($_SERVER['PHP_SELF']) != "messages.php") ) { ?>
                            <?php if ((basename($_SERVER['PHP_SELF']) != "home.php") ) { ?>
                            <?php if ((basename($_SERVER['PHP_SELF']) != "profile.php") ) { ?>
                            <?php if ((basename($_SERVER['PHP_SELF']) != "edit-profile.php") ) { ?>
                    
<span id="msgcounter1312412"></span>
<script>
$("#msgcounter1312412").load("<?php echo $homeurl;?>source/intervals.php<?php echo $session;?> #msgcounter13124121"); 
setInterval(function(){ 
    $("#msgcounter1312412").load("<?php echo $homeurl;?>source/intervals.php<?php echo $session;?> #msgcounter13124121"); 
}, 10000);
</script>
                           <?php } ?>
                           <?php } ?>
                           <?php } ?>
                           <?php } ?>

                        </span>
                    </a> 
                </li>

       
                <hr class="">


            <!-- MENSAJES -->
            <?php if (basename($_SERVER['PHP_SELF']) == "messages.php") { ?>

               

                <li class="has-subnav">
                    <a href="" data-toggle="modal" data-target="#modalnew">
            
                        <span class="nav-text">            <i class="fa fa-plus fa-2x fa1"></i>
                           Nuevo
                        </span>
                    </a>
                </li>


<?php if (isset($_GET['location'])) { ?>
    
  <?php  if ($_GET['location'] == "received"){ ?>

    <li class="has-subnav active">
        
  <?php } else { ?>

    <li class="has-subnav">

  <?php } ?>

  <?php } else { ?>

    <li class="has-subnav active">

  <?php } ?>


              
                    <a href="messages<?php echo $session; ?>&location=received"  >
                   
                        <span class="nav-text">     <i class="fa fa-inbox fa-2x fa1"></i>
                          Recibidos     
                           
                          <span id="msgcounter1312412"></span>
                          <script>
                          $("#msgcounter1312412").load("<?php echo $homeurl;?>source/intervals.php<?php echo $session;?> #msgcounter13124121"); 
                          setInterval(function(){ 
                              $("#msgcounter1312412").load("<?php echo $homeurl;?>source/intervals.php<?php echo $session;?> #msgcounter13124121"); 
                          }, 5000);
                          </script>
                           
                        </span>
                        
                    </a>
                    
                </li>



<?php if (isset($_GET['location'])) { ?>
    

  <?php  if ($_GET['location'] == "sent"){ ?>

    <li class="has-subnav active">
        
  <?php } else { ?>

    <li class="has-subnav">

  <?php } ?>

  <?php } else { ?>

    <li class="has-subnav">

  <?php } ?>


                    <a href="messages<?php echo $session; ?>&location=sent">
               
                        <span class="nav-text">         <i class="fa fa-paper-plane fa-2x fa1"></i>
                           Enviados       
                        </span>
                        
                    </a>
                    
                </li> 

    <!--
<?php if (isset($_GET['location'])) { ?>
    

  <?php  if ($_GET['location'] == "trash"){ ?>

    <li class="has-subnav active">
        
  <?php } else { ?>

    <li class="has-subnav">

  <?php } ?>

  <?php } else { ?>

    <li class="has-subnav">

  <?php } ?>
                    <a href="messages<?php echo $session; ?>&location=trash">
                        <i class="fa fa-trash fa-2x fa1"></i>
                        <span class="nav-text">
                           Papelera      
                        </span>
                        
                    </a>
                    
                </li> -->

                <hr class="">

            <?php } ?>

  
            <?/*MIRED */?>
            <?php if((basename($_SERVER['PHP_SELF']) == "local.php") ) { ?>

                <li> 
                        <span class="nav-text">  <i class="fa fa-tasks fa-2x fa1"></i>
                        <strong>  Tareas </strong>
                        </span>               
                </li>

                <li>
                    <a  href="#">  
            
                        <span style="    text-align: left; padding-left: 60px; font-size: 13px !important;" class="nav-text fa1">
                            Nueva tarea
                        </span>
                    </a> 
                </li>
                <li>
                    <a  href="#">  
                        
                        <span style="text-align: left; padding-left: 60px; font-size: 13px !important;" class="nav-text fa1">
                            Ver todas
                        </span>
                    </a> 
                </li>

                <li> 
                        <span class="nav-text">  <i class="fa fa-bell-o fa-2x fa1"></i>
                        <strong>     Alertas </strong>
                        </span>               
                </li>

                <li>
                    <a  href="#">  
                        
                        <span style="    text-align: left; padding-left: 60px; font-size: 13px !important;" class="nav-text fa1">
                            Nueva alerta
                        </span>
                    </a> 
                </li>
                <li>
                    <a  href="#">  
                        
                        <span style="text-align: left; padding-left: 60px; font-size: 13px !important;" class="nav-text fa1">
                            Ver todas
                        </span>
                    </a> 
                </li>


                <li> 
                        <span class="nav-text"><i class="fa fa-users fa-2x fa1"></i>
                          <strong>  Departamentos </strong>
                        </span>               
                </li>


                <li>
                    <a  href="#">  
                        
                        <span style="    text-align: left; padding-left: 60px; font-size: 13px !important;" class="nav-text fa1">
                           Ventas
                        </span>
                    </a> 
                </li>
                <li>
                    <a  href="#">  
                        
                        <span style="text-align: left; padding-left: 60px; font-size: 13px !important;" class="nav-text fa1">
                            Seguimiento
                        </span>
                    </a> 
                </li>
                <li>
                    <a  href="#">  
                        
                        <span style="text-align: left; padding-left: 60px; font-size: 13px !important;" class="nav-text fa1">
                            Consultas
                        </span>
                    </a> 
                </li>

            <?php } ?>
            <?/*MIRED */?>


            <?/*PRODUCTOS */?>
            <?php if((basename($_SERVER['PHP_SELF']) == "products.php") ) { ?>


<?php if(isset($_GET['action'])) { ?>
  <?php if(($_GET['action'])=="new") { ?>
    <li class="active"> 
   <?php } else { ?>
    <li> 
    <?php } ?>
<?php } else { ?>
    <li> 
<?php } ?>
                <a href="<?php echo $homeurl;?>pages/products<?php echo $session; ?>&action=new" > 
                
                        <span class="nav-text">        <i  class="fa fa-plus fa-2x fa1"></i>
                       Nuevo producto
                        </span>      
                        </a>         
                </li>



<?php if(isset($_GET['action'])) { ?>
  <?php if ((($_GET['action'])=="viewall") || (($_GET['action'])=="add")) { ?>
    <li class="active"> 
   <?php } else { ?>
    <li > 
    <?php } ?>
<?php } else { ?>
    <li class="active"> 
<?php } ?>
        
                <a href="<?php echo $homeurl;?>pages/products<?php echo $session; ?>&action=viewall" >
                   
                        <span class="nav-text">     <i  class="fa fa-bars fa-2x fa1"></i>
                      Ver todos
                        </span>      
                        </a>         
                </li>
         
        <li >      



 

                <hr class="">

                <?php if(isset($_GET['action'])) { ?>
                    <?php if(($_GET['action'])=="newcategory") { ?>
                        <li class="active">
                        <?php } else { ?>
                        <li>
                        <?php } ?>
                  <?php } else { ?>
                    <li>
                    <?php } ?>     


                <a href="<?php echo $homeurl;?>pages/products<?php echo $session; ?>&action=newcategory" > 
               
                        <span class="nav-text"><i  class="fa fa-tags fa-2x fa1"></i>
                        Categorias
                        </span>      
                        </a>         
                </li>

          
       
            <hr class="">

            <li> 
           
                        
                          <strong><span class="nav-text"> <i class="fa fa-file-pdf-o fa-2x fa1"></i>  Catálogo </span>  </strong>
                                     
                </li>


                <li>
                <a href="<?php echo $homeurl;?>/source/output.php?t=pdf"  data-toggle="tooltip" data-placement="right" title="Generar catalogo de todos los productos.">
                
                        <span style="    text-align: left; padding-left: 60px; font-size: 13px !important;" class="nav-text fa1">
                          Todos los productos
                        </span>
                    </a> 
                </li>
                <li>
      
    
                <?php if(isset($_GET['action'])) { ?>
                    <?php if(($_GET['action'])=="selectcategory") { ?>
                        <li class="active">
                        <?php } else { ?>
                        <li>
                        <?php } ?>
                  <?php } else { ?>
                    <li>
                    <?php } ?>     

                <a href="<?php echo $homeurl."pages/products".$session."&action=selectcategory";?>"  data-toggle="tooltip" data-placement="right" title="Generar catalogo de las categorias seleccionadas.">
                
                        <span style="    text-align: left; padding-left: 60px; font-size: 13px !important;" class="nav-text fa1">
                          Seleccionar categoria
                        </span>
                    </a> 
                </li>
                <li>
      
                <?php } ?>

            <?/*Productos */?>





            <?/*CONTACTOS */?>
            <?php if((basename($_SERVER['PHP_SELF']) == "contacts.php") ) { ?>


<?php if(isset($_GET['action'])) { ?>
  <?php if(($_GET['action'])=="new") { ?>
    <li class="active"> 
   <?php } else { ?>
    <li> 
    <?php } ?>
<?php } else { ?>
    <li> 
<?php } ?>
                <a href="<?php echo $homeurl;?>pages/contacts<?php echo $session; ?>&action=new" > 
                        <span class="nav-text"><i class="fa fa-plus fa-2x fa1"></i>
                       Nuevo contacto
                        </span>      
                        </a>         
                </li>



<?php if(isset($_GET['action'])) { ?>
  <?php if ((($_GET['action'])=="viewall") || (($_GET['action'])=="add")) { ?>
    <li class="active"> 
   <?php } else { ?>
    <li > 
    <?php } ?>
<?php } else { ?>
    <li class="active"> 
<?php } ?>
        
                <a href="<?php echo $homeurl;?>pages/contacts<?php echo $session; ?>&action=viewall" >
                        <span class="nav-text">  <i class="fa fa-bars fa-2x fa1"></i>
                      Ver todos
                        </span>      
                        </a>         
                </li>

            <!--    <li> 
                <a href="messages<?php// echo $session; ?>#import" data-toggle="tab"> 
                        <i class="fa fa-upload fa-2x fa1"></i>
                        <span class="nav-text">
                      Importar
                        </span>      
                        </a>         
                </li>-->

        


            <?php } ?>
            <?/*CONTACTOS */?>
            


            <?/*EMPRESAS */?>
            <?php if((basename($_SERVER['PHP_SELF']) == "company.php") ) { ?>

<?php if(isset($_GET['action'])) { ?>
  <?php if(($_GET['action'])=="new") { ?>
    <li class="active"> 
   <?php } else { ?>
    <li> 
    <?php } ?>
<?php } else { ?>
    <li> 
<?php } ?>              
                 <a href="company<?php echo $session; ?>&action=new"> 
                        <span class="nav-text"><i class="fa fa-plus fa-2x fa1"></i>
                       Nueva empresa
                        </span>      
                        </a>         
                </li>


<?php if(isset($_GET['action'])) { ?>
  <?php if ((($_GET['action'])=="viewall") || (($_GET['action'])=="add")) { ?>
    <li class="active"> 
   <?php } else { ?>
    <li > 
    <?php } ?>
<?php } else { ?>
    <li class="active"> 
<?php } ?>
                <a href="company<?php echo $session; ?>&action=viewall"> 
                        <span class="nav-text">  <i class="fa fa-bars fa-2x fa1"></i>
                      Ver todas
                        </span>      
                        </a>         
                </li>

              <!--  <li> 
                <a href="company<?php// echo $session; ?>#update" data-toggle="tab"> 
                        <i class="fa fa-upload fa-2x fa1"></i>
                        <span class="nav-text">
                      Actualizar
                        </span>      
                        </a>         
                </li> -->

            <?php } ?>
            <?/*EMPRESAS */?>


            <?/*EMPRESAS */?>
            <?php if((basename($_SERVER['PHP_SELF']) == "campaigns.php") ) { ?>

                <li> 
                <a href="campaigns<?php echo $session; ?>#new" data-toggle="tab"> 
                        <span class="nav-text">  <i class="fa fa-plus fa-2x fa1"></i>
                       Nueva campaña
                        </span>      
                        </a>         
                </li>

                <li> 
                <a href="campaigns<?php echo $session; ?>#viewall" data-toggle="tab">                      
                        <span class="nav-text">    <i class="fa fa-bars fa-2x fa1"></i>
                      Ver todas
                        </span>      
                        </a>         
                </li>

            

            <?php } ?>
            <?/*EMPRESAS */?>



            <?/*OPORTUNIDADES*/?>
            <?php if((basename($_SERVER['PHP_SELF']) == "opportunities.php") ) { ?>

                <li>                       
                        <strong><span class="nav-text"> <i class="fa fa-user-plus fa-2x fa1"></i>  Prospectos </strong>
                        </span>               
                </li>

<?php if(isset($_GET['action'])) { ?>
  <?php if ((($_GET['action'])=="newprospect")) { ?>
    <li class="active"> 
   <?php } else { ?>
    <li > 
    <?php } ?>
<?php } else { ?>
    <li > 
  <?php } ?>
                    <a  href="<?php echo $homeurl."pages/opportunities".$session."&action=newprospect";?>">   
                        <span style="    text-align: left; padding-left: 60px; font-size: 13px !important;" class="nav-text fa1">
                            Nuevo
                        </span>
                    </a> 
                </li>



                <?php if(isset($_GET['action'])) { ?>
                    <?php if ((($_GET['action'])=="viewprospects")) { ?>
                      <li class="active"> 
                     <?php } else { ?>
                      <li > 
                      <?php } ?>
                  <?php } else { ?>
                       <li> 
                    <?php } ?>
                    <a  href="<?php echo $homeurl."pages/opportunities".$session."&action=viewprospects&status=".$defaultprospectsview;?>">  
                        
                        <span style="text-align: left; padding-left: 60px; font-size: 13px !important;" class="nav-text fa1">
                            Ver todos
                        </span>
                    </a> 
                </li>



            

        


            <?php } ?>
            <?/*OPORTUNIDADES */?>


            <?/*EMPRESAS */?>
            <?php if((basename($_SERVER['PHP_SELF']) == "sales.php") ) { ?>


                <li> 
              
                        <span class="nav-text">          <i class="fa fa-money fa-2x fa1"></i>
                        <strong>  Ventas </strong>
                        </span>               
                </li>


<?php if(isset($_GET['action'])) { ?>
  <?php if ((($_GET['action'])=="newsale")) { ?>
    <li class="active"> 
   <?php } else { ?>
    <li > 
    <?php } ?>
<?php } else { ?>
    <li > 
  <?php } ?>
                <a href="sales<?php echo $session; ?>&action=newsale" >
                        <span  style="    text-align: left; padding-left: 60px; font-size: 13px !important;" class="nav-text fa1">
                       Nueva 
                        </span>      
                        </a>         
                </li>

                <?php if(isset($_GET['action'])) { ?>
  <?php if ((($_GET['action'])=="viewall")) { ?>
    <li class="active"> 
   <?php } else { ?>
    <li > 
    <?php } ?>
<?php } else { ?>
    <li > 
  <?php } ?>
                <a href="sales<?php echo $session; ?>&action=viewall" >           
    
                        <span  style="    text-align: left; padding-left: 60px; font-size: 13px !important;" class="nav-text fa1">
                      Ver todas
                        </span>      
                        </a>         
                </li>

                <?php if(isset($_GET['action'])) { ?>
                    <?php if ((($_GET['action'])=="commissions")) { ?>
                      <li class="active"> 
                     <?php } else { ?>
                      <li > 
                      <?php } ?>
                  <?php } else { ?>
                      <li > 
                    <?php } ?>
                                  <a href="sales<?php echo $session; ?>&action=commissions" >     

                        <span  style="    text-align: left; padding-left: 60px; font-size: 13px !important;" class="nav-text fa1">
                      Mis comisiones
                        </span>      
                        </a>         
                </li>

            <?php } ?>
            <?/*EMPRESAS */?>


            <?/*Reportes */?>
            <?php if((basename($_SERVER['PHP_SELF']) == "report.php") ) { ?>

                <li> 
                        <span class="nav-text"> <i class="fa fa-handshake-o fa-2x fa1"></i>
                      Ventas
                        </span>      
                        </a>         
                <li> 

                <li> 
                        <span class="nav-text">  <i class="fa fa-square-o fa-2x fa1"></i>
                      Cotizaciones
                        </span>      
                        </a>         
                <li> 
                <li> 
                        <span class="nav-text">  <i class="fa fa-user-plus fa-2x fa1"></i>
                     Prospectos
                        </span>      
                        </a>         
                <li> 
                <li> 
                        <span class="nav-text"><i class="fa fa-building-o fa-2x fa1"></i>
                     Empresas
                        </span>      
                        </a>         
                <li> 
                <li> 
                        <span class="nav-text">  <i class="fa fa-address-book fa-2x fa1"></i>
                     Contactos
                        </span>      
                        </a>         
                <li> 
                <li> 
                        <span class="nav-text">  <i class="fa fa-cart-plus fa-2x fa1"></i>
                     Campañas
                        </span>      
                        </a>         
                <li> 

              

            <?php } ?>
            <?/*REPORTES */?>


            <?php if((basename($_SERVER['PHP_SELF']) == "calendar.php"))  { ?>

            <li class="has-subnav">
                    <a href="" data-toggle="modal" data-target="#newevent">
                        <i class="fa fa-plus fa-2x fa1"></i>
                        <span class="nav-text">
                           Agregar evento
                        </span>
                    </a>
                </li>

                <li class="has-subnav">
                    <a href="">
                        <i class="fa fa-list fa-2x fa1"></i>
                        <span class="nav-text">
                          Ver mis eventos
                        </span>
                    </a>
                </li>


            <?php } ?>

            <?php if((basename($_SERVER['PHP_SELF']) == "profile.php") || (basename($_SERVER['PHP_SELF']) == "edit-profile.php")  || (basename($_SERVER['PHP_SELF']) == "home.php")   ) { ?>
                <li>
                    <a href="<?php echo $homeurl."edit-profile".$session; ?>">  

                        <span class="nav-text"> <i class="fa fa-pencil-square-o fa-2x fa1"></i>
                            Editar perfil
                        </span>
                    </a>
                  
                </li>
           
                <li class="has-subnav">
                    <a href="<?php echo $homeurl."messages".$session; ?>">                      
                        <span class="nav-text">  <i class="fa fa-envelope-o fa-2x fa1"></i>
                           Mensajería     
                           
                           
                           <span id="msgcounter1312412"></span>
                           <script>
                           $("#msgcounter1312412").load("<?php echo $homeurl;?>source/intervals.php<?php echo $session;?> #msgcounter13124121"); 
                           setInterval(function(){ 
                               $("#msgcounter1312412").load("<?php echo $homeurl;?>source/intervals.php<?php echo $session;?> #msgcounter13124121"); 
                           }, 5000);
                           </script>

                        </span>
                        
                    </a>
                    
                </li>

                <li class="has-subnav">
                    <a href="<?php echo $homeurl."template/calendar".$session;?>">                        
                        <span class="nav-text"> <i class="fa fa-calendar fa-2x fa1"></i>
                            Calendario
                        </span>
                    </a>
                    
                </li>

                <li class="has-subnav">
                    <a href="#">                   
                        <span class="nav-text">  <i class="fa fa-clock-o fa-2x fa1" aria-hidden="true"></i>
                            Asistenica
                        </span>
                    </a>
                    
                </li>


                <li class="has-subnav">
                    <a href="#">                        
                        <span class="nav-text"> <i class="fa fa-shield fa-2x fa1"></i>
                            Opciones de seguridad
                        </span>
                    </a>
                    

                </li>

                <li class="has-subnav">
                       <a href="<?php echo $homeurl;?>source/logout<?php echo $session;?>">                        
                        <span class="nav-text">  <i class="fa fa-power-off fa-2x fa1"></i>
                            Cerrar sesión
                        </span>
                    </a>
                </li> 


                <?php } // PAGE ?>

<?php if( $alm->__GET('rol') == 1123){ ?>
    <hr class="">

<li>

  <i class="fa fa-unlock-alt fa-2x fa1" ></i>
  <span class="nav-text">
  <strong>Opciones de administrador</strong>
   </span>
   </li> 

   
 
   <li>
       <a href="#">
         <i class="fa fa-users fa-2x fa1" aria-hidden="true"></i>
          <span class="nav-text">
             Empleados
        </span>
       </a>
   </li>  

   <li>
       <a href="#">
         <i class="fa fa-building fa-2x fa1" aria-hidden="true"></i>
          <span class="nav-text">
             Departamentos
        </span>
       </a>
   </li>  
     
   <?php } // ADMIN ?>




                <?php // if((basename($_SERVER['PHP_SELF']) != "profile") && (basename($_SERVER['PHP_SELF']) != "edit-profile") && (basename($_SERVER['PHP_SELF']) != "messages")) { ?>
            <!--    <li>
                    <a href="http://justinfarrow.com">
                        <i class="fa fa-home fa-2x fa1"></i>
                        <span class="nav-text">
                            Dashboard
                        </span>
                    </a>
                  
                </li>
                <li class="has-subnav">
                    <a href="#">
                        <i class="fa fa-laptop fa-2x fa1"></i>
                        <span class="nav-text">
                            UI Components
                        </span>
                    </a>
                    
                </li>
                <li class="has-subnav">
                    <a href="#">
                       <i class="fa fa-list fa-2x fa1"></i>
                        <span class="nav-text">
                            Forms
                        </span>
                    </a>
                    
                </li>
                <li class="has-subnav">
                    <a href="#">
                       <i class="fa fa-folder-open fa-2x fa1"></i>
                        <span class="nav-text">
                            Pages
                        </span>
                    </a>
                   
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-bar-chart-o fa-2x fa1"></i>
                        <span class="nav-text">
                            Graphs and Statistics
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-font fa-2x fa1"></i>
                        <span class="nav-text">
                            Typography and Icons
                        </span>
                    </a>
                </li>
                <li>
                   <a href="#">
                       <i class="fa fa-table fa-2x fa1"></i>
                        <span class="nav-text">
                            Tables
                        </span>
                    </a>
                </li>
                <li>
                   <a href="#">
                        <i class="fa fa-map-marker fa-2x fa1"></i>
                        <span class="nav-text">
                            Maps
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                       <i class="fa fa-info fa-2x fa1"></i>
                        <span class="nav-text">
                            Documentation
                        </span>
                    </a>
                </li>-->

                <?php// } ?>

            </ul>

            <!-- Parte de abaoj -->
          <!--  <ul class="logout" style="margin-bottom: 160px;
    width: 100%;">
         
            <li>
                   <a href="<?php //echo $homeurl;?>source/logout<?php// echo $session;?>">
                         <i class="fa fa-power-off fa-2x fa1"></i>
                        <span class="nav-text">
                            Cerrar sesión
                        </span>
                    </a>
                </li>  


            </ul>-->
        </nav>
        
        
        </div>  
      </div> 
     </div>  


