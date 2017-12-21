<?php


  //  session_start();
session_start(['cookie_lifetime' => 86400,]);
session_cache_limiter('private');


date_default_timezone_set('America/Santiago');
setlocale(LC_TIME, 'es_ES', 'Spanish_Spain', 'Spanish');  
define("CHARSET", "iso-8859-1");



require_once '../../'.$_POST['install_page_posted'].'/config.php';
require_once '../../'.$install_page.'/function.php';



$alm = new pdv_var();
$model = new consulta();

// VALIDACIONES

if ((!empty($_POST["email"])) and (!empty($_POST["password"]))):
    echo "Por favor espere, cargando...";
    $pass = (substr((sha1(substr((strrev(md5($_POST["password"]))),0,20))),3,23));

 //Get data from the email
 $alm = $model->getdata($_POST['email']);
 
 //get the result about the user 
 /*echo $alm->__GET('result');*/

    if ($alm->__GET('result') != "OK"):

	
		session_unset(); 
		session_destroy(); 
        echo '<script type="text/javascript">location.href = "'.$homeurl.'?user=error";</script>';

	
		
    else:

        //Checking passwords
        if ($pass === $alm->__GET('pass')):
            $alm->__SET('id',($alm->__GET('id')));
            $alm->__SET('key', substr((md5((date("d-m-Y").($alm->__GET('name'))))),1,20));
            $alm->__SET('last_log', date("Y-m-d"));
            $model->login($alm);

            if ($alm->__GET('rol') == 1) : $roluser = "ADMIN"; else: $roluser = "USER"; endif;

		  
            $_SESSION["homeurl"] = $homeurl;
            $_SESSION["session"] = "?activeuser=".$alm->__GET('id')."&rol=".$roluser."";
			$_SESSION['key'] = substr((md5((date("d-m-Y").($alm->__GET('name'))))),1,20);
            $_SESSION['install_page'] = $install_page;


      //    $session = "?activeuser=".$alm->__GET('id')."&rol=".$roluser."&key=".substr((md5((date("d-m-Y").($alm->__GET('name'))))),1,20)."";

          $session = "?activeuser=".$alm->__GET('id')."&rol=".$roluser."";
          
      echo '<script type="text/javascript">location.href = "'.$homeurl.'pages/home'.$session.'";</script>';
       
   /*  echo "$sessionelias----:".$session;
		echo '<br>';
      echo "$_SESSIONdefault----:".$_SESSION['key'];
	  echo '<br>';
      echo $homeurl.'pages/home'.$session;
	  */
	  
    else:
	
	session_unset(); 
session_destroy(); 
            echo '<script type="text/javascript">location.href = "'.$homeurl.'?password=error&email='.$_POST["email"].'";</script>';
        endif;
    endif;
else:

	session_unset(); 
		session_destroy(); 
    echo '<script type="text/javascript">location.href = "'.$homeurl.'?data=invalid";</script>';
endif;


?>


