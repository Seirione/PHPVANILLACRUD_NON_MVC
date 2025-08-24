<?php
include '../database_connection.php';

if (isset($_GET['id'])) { // Check if the delete parameter is set
    try {
        $id = (int)$_GET["id"]; // Fetch the ID
        var_dump($id);
        if (!$id) {
            throw new Exception("There is no ID fetched!"); 
        }

        // Prepare the DELETE SQL statement
        $stmt = $connection->prepare("DELETE FROM `students` WHERE `id` = ?");
        $stmt->bind_param("i", $id); // Bind the ID parameter

        // Execute the DELETE statement
        if ($stmt->execute()) {
            header("location: ../index.php?message=Student deleted successfully");
        } else {
            throw new Exception("Failed to delete the student: " . $stmt->error);
        }

    } catch (Exception $e) {
        header("location: ../index.php?message=" . urlencode($e->getMessage()));
    }
} else { // Handle case where no ID is provided
    header("location: ../index.php?message=There is no ID");
}
?>

