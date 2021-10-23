<?php 

require '../helpers/dbClass.php';

require '../helpers/validateClass.php';


$id = $_GET['id'];

$validation = new validator;
$db         = new Database;

if($validation -> validate($id,'int')){

    // code ...... 
  $sql = "delete from articles where id = $id";
  $op  = $db -> DoQuery($sql);
//   var_dump($op);
//   exit;
//   echo mysqli_error($db -> con);
  
  
  if($op){
      $Message = "Raw removed";
  }else{
      $Message = "Error Try Again";
  }

}else{

    $Message = "Invalid Id";

}


$_SESSION['Message'] = [$Message];

header("Location: index.php");




?>