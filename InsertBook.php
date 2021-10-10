<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');
// Importar la conexion
include 'DBConfig.php';
 
// Conectar a la base de datos
 $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
 
 // Obteniendo los datos en la variable $json.
 $json = file_get_contents('php://input');
 
 // Decodificando los datos en formato JSON en la variables $obj.
 $obj = json_decode($json,true);
 
 // Crear variables por cada campo.
 $S_Book = $obj['book_name'];
 
 $S_Subjet = $obj['book_subjet'];
 
 $S_Author= $obj['book_author'];
 
 $S_Editorial = $obj['book_editorial'];
 
 // Instrucción SQL para agregar el estudiante.
 if($S_Book == '' || $S_Subjet == '' || $S_Author == '' || $S_Editorial == ''){
    $Mensaje = 'Todos los Campos son Requeridos';
    $jsonMsg = json_encode($Mensaje);
    echo $jsonMsg;
 } else {
   $Sql_Query = "INSERT into booklisttable (book_name,book_subjet,book_author,book_editorial) values ('$S_Book','$S_Subjet','$S_Author','$S_Editorial')";


   if (mysqli_query($con, $Sql_Query)) {

      $MSG = 'Libro registrado correctamente...';

      $json = json_encode($MSG);


      echo $json;
   } else {

      echo 'Inténtelo de nuevo...';
   }
   mysqli_close($con);
}
