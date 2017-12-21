<?php
session_start();
require_once '../../'.$_SESSION['install_page'].'/config.php';
require_once '../../'.$_SESSION['install_page'].'/function.php';

$alm = new pdv_var();
$model = new consulta();



if (isset($_GET['delete'])){

/* REMOVE IMAGE*/

if ($_GET['delete']!=""){

echo "Procesando...";
$activeuser=$_GET['activeuser'];
   
$rol=$_GET['rol'];
$session="?activeuser=".$activeuser."&rol=".$rol."";
$user_img= $_GET['delete'];

if ((file_exists("../../".$_SESSION['install_page']."/images/".$user_img)  && (!empty(trim($user_img))))) {
    
unlink("../../".$_SESSION['install_page']."/images/".$user_img);

}

$alm->__SET('user_img', "");
$alm->__SET('id',         $_REQUEST['activeuser']);
$model->changeimg($alm);
header('Location: ../../'.$_SESSION['install_page'].'/profile.php'.$session.'&upload=success');

}else{
    echo "Procesando...";
    $activeuser=$_GET['activeuser'];
    $key1 = date("Hi"); 
    $rol=$_GET['rol'];
    $session="?activeuser=".$activeuser."&rol=".$rol."";
    $user_img= $_GET['delete'];
    header('Location: ../../'.$_SESSION['install_page'].'/profile.php'.$session.'');

}

} else {

    /*UPLOAD IMG */
/* GET THE VARS */
$session = $_POST['sesion'];
$activeuser=$_GET['activeuser'];
$key1 = date("Hi");
$target_dir = "../../".$_SESSION['install_page']."/images/";
$target_file1 = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file1,PATHINFO_EXTENSION);
$target_file = $target_dir . $activeuser.$key1.".".$imageFileType;
// Check if image file is a actual image or fake image
/*if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
       echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
      //  echo "El archivo no es una imagen";
        $uploadOk = 1;
    }
}*/
// Reemplazar imagen existente
if (file_exists($target_file)) {
 //   echo "Sorry, file already exists.";
    $uploadOk = 1;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 2000000) {
    echo "Max. 2MB";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF"){
    echo "Solamente se permiten archivos JPG, JPEG, PNG y GIF";
    $uploadOk = 2;
}
// Archivo demasiado pesado
if ($uploadOk == 0) {
    echo "El archivo es demasiado pesado...";


 // Archivo diferente formato   
} elseif($uploadOk == 2) {



// Carga del archivo
} elseif($uploadOk == 1) {


    $user_imgtodelete =  $_POST['imgprofileto'];
    
    if ((file_exists("../../".$_SESSION['install_page']."/images/".$user_imgtodelete)) && (!empty(trim($user_imgtodelete))))  {
        
         unlink("../../".$_SESSION['install_page']."/images/".$user_imgtodelete);
         
    }


    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
     //   echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";



  

     $key1 = date("Hi");

     $alm->__SET('user_img', $activeuser.$key1.".".$imageFileType);
     $alm->__SET('id', $_REQUEST['activeuser']);

     $model->changeimg($alm);
     header('Location: ../../'.$_SESSION['install_page'].'/profile.php'.$session.'&upload=success');


// Error al cargar archivo
    } else {
        echo "No se ha podido cargar la imagen...";
        header('Location: ../../'.$_SESSION['install_page'].'/profile.php'.$session.'&upload=error');
    }
}


} //CHECKING IF DELETE IS SET

?>