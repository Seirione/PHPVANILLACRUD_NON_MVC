<?php include '../database_connection.php';
 
// $query = "SELECT * FROM `students`"; 
// $result = mysqli_query($connection, $query);

$stmt = $connection ->prepare("SELECT * FROM `users`");
$stmt->execute();


  


   
