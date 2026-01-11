<?php
define("HOSTNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASE", "crud_php");

try {
    $connection = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);
    
    if (!$connection) {
        throw new Exception("Database Connection Failed");
    }
    

    
} catch (Exception $e) {
    echo '<script>console.log("The Error is:'.$e->getMessage().'");</script>';
    
}
