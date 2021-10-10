<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

include 'DBConfig.php';
 
$con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
 
$json = file_get_contents('php://input');
 
$obj = json_decode($json,true);
 
$S_ID = $obj['book_Id'];
 
$S_Book = $obj['book_name'];
 
$S_Subjet = $obj['book_subjet'];
 
$S_Author = $obj['book_author'];
 
$S_Editorial = $obj['book_editorial'];
 

$Sql_Query = "UPDATE booklisttable SET book_name= '$S_Book', book_subjet = '$S_Subjet', book_author = '$S_Author', book_editorial = '$S_Editorial' WHERE book_Id = $S_ID";
 
 if(mysqli_query($con,$Sql_Query)){
 
$MSG = 'Los Datos del Libro han sido actualizados correctamente ...' ;
 
$json = json_encode($MSG);

 echo $json ;
 
 }
 else{
 
 echo 'Inténtelo de nuevo';
 
 }
 mysqli_close($con);
?>