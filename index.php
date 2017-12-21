<?php session_start(); ?>
<!DOCTYPE html>


<?php 
if ((isset($_GET['user'])) || (isset($_GET['password'])) || (isset($_GET['data']))  || (isset($_GET['token'])) ) { //if1

} else { //if1

if (isset($_SESSION["session"])) {  //if2
    echo '<script type="text/javascript">location.href = "'.$_SESSION['homeurl'].'pages/home'.$_SESSION["session"].'";</script>';
} //if2

}//if1
?>


<html>
<head>


<link rel="icon" href="images/favicon.png" type="image/x-icon">
<link rel="stylesheet" href="css/style.css">
<!--<script src="js/5e65484344.js"></script>-->


<?php
require_once 'config.php';
require_once 'header.php';
?>

</head>

<body>

<style>

.card-container.card {
    max-width: 350px;
    padding: 40px 40px;
}

.btn {
    font-weight: 700;
    height: 36px;
    -moz-user-select: none;
    -webkit-user-select: none;
    user-select: none;
    cursor: default;
}

/*
 * Card component
 */
.card {
    background-color: #F7F7F7;
    /* just in case there no content*/
    padding: 20px 25px 30px;
    margin: 0 auto 25px;
    margin-top: 50px;
    /* shadows and rounded borders */
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}

.profile-img-card {
    width: 96px;
    height: 96px;
    margin: 0 auto 10px;
    display: block;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    border-radius: 50%;
}

/*
 * Form styles
 */
.profile-name-card {
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    margin: 10px 0 0;
    min-height: 1em;
}

.reauth-email {
    display: block;
    color: #404040;
    line-height: 2;
    margin-bottom: 10px;
    font-size: 14px;
    text-align: center;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signin #inputEmail,
.form-signin #inputPassword {
    direction: ltr;
    height: 44px;
    font-size: 16px;
}

.form-signin input[type=email],
.form-signin input[type=password],
.form-signin input[type=text],
.form-signin button {
    width: 100%;
    display: block;
    margin-bottom: 10px;
    z-index: 1;
    position: relative;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signin .form-control:focus {
    border-color: rgb(104, 145, 162);
    outline: 0;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
}

.btn.btn-signin {
    /*background-color: #4d90fe; */
    background-color: rgb(104, 145, 162);
    /* background-color: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));*/
    padding: 0px;
    font-weight: 700;
    font-size: 14px;
    height: 36px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    border: none;
    -o-transition: all 0.218s;
    -moz-transition: all 0.218s;
    -webkit-transition: all 0.218s;
    transition: all 0.218s;
}

.btn.btn-signin:hover,
.btn.btn-signin:active,
.btn.btn-signin:focus {
    background-color: rgb(12, 97, 33);
}

.forgot-password {
    color: rgb(104, 145, 162);
}

.forgot-password:hover,
.forgot-password:active,
.forgot-password:focus{
    color: rgb(12, 97, 33);
}


/*BANNER */
#banner{
    left: 0;
    top: 0px;
    position: fixed;
    z-index: -1;
    height: 100%;
    width: auto;
}

.banner:after {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(4, 4, 4, 0.55);
    content: "";
}
.card {
    background-color: rgba(247, 247, 247, 0.79);
    padding-top: 20px !important;
    margin-top: 60px;
}


#setbackground{

    width: 100%;
    max-height: 100%;
    overflow: hidden;
}


</style>
<div id="setbackground">
<img src="images/banner.jpg" id="banner" class="banner">
</div>


    <div class="container" >
        <div class="card card-container">
            <form class="form-signin" action="source/login.php" method="post">

<input style="display:none;" type="text" value="<?php echo basename(__DIR__);?>" name="install_page_posted"/>


<?php if (isset($_GET['password'])): ?>
<div class="alert alert-danger alert-dismissable" style="text-align:center; padding-right: 15px">
<i class="fa fa-exclamation-circle fa-2x" aria-hidden="true"></i><br> <strong>Datos inválidos</strong> 
</div>
<?php endif; ?>

<?php if (isset($_GET['token'])): ?>
<div class="alert alert-danger alert-dismissable" style="text-align:center; padding-right: 15px">
<i class="fa fa-exclamation-circle fa-2x" aria-hidden="true"></i><br> <strong>CREDENCIALES INVÁLIDAS</strong> 
</div>


<?php elseif (isset($_GET['user'])): ?>

<div class="alert alert-info alert-dismissable" style="text-align:center; padding-right: 15px">
<i class="fa fa-exclamation-circle fa-2x" aria-hidden="true"></i><br><strong>El email ingresado no esta registrado</strong> 
</div>

<?php elseif (isset($_GET['data'])): ?>

<div class="alert alert-warning alert-dismissable" style="text-align:center; padding-right: 15px">
<i class="fa fa-exclamation-circle fa-2x" aria-hidden="true"></i> <br> <strong>Los campos no pueden estar vacios</strong> 
</div>


<?php endif; ?>


<div style="text-align:center;">
                <img src="images/logo.png" style="width:35%">

                <div style="max-width:170px; margin:auto;">

                <p id="pdv_title" style="color:#000;  font-size: 1.5rem;">Plan de Ventas </p>
<p id="subtitle_crm" style="color:#000;">CRM</p>
</div>
</div>
<br>

                <input type="email" id="email" name="email" class="form-control" placeholder="Correo electrónico" value="<?php if (isset($_GET['email'])): echo $_GET['email']; endif; ?>" required autofocus>
                <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" required>
        
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Ingresar</button>
            </form><!-- /form -->
            <a href="#" class="forgot-password" >
               <div style="text-align:center;"> ¿Olvidaste tu contraseña? </div>
            </a>
        </div><!-- /card-container -->
    </div><!-- /container -->

</body>

</html>