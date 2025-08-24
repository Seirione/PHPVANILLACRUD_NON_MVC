<?php
include "../database_connection.php"; // Include your database connection

// Check if the button has been submitted
if (isset($_POST['submit_student_input'])) {
    // Get the variables 
    $student_first_name = trim($_POST['student_first_name']);
    $student_last_name = trim($_POST['student_last_name']);
    $student_age = (int)$_POST['student_age']; // Cast age to integer
    $student_id = (int)$_POST['student_id']; // Assuming you pass the student ID



    // Check if any input is blank
    if ($student_first_name === "" || $student_last_name === "" || $student_age === "") {
        header("location: ../index.php?message=The Data Input is Empty");
        exit; // Stop further execution
    }

    // Process the data
    try {

        if(!isset($_GET['id_new'])){
             header("location: ../index.php?message=There was no ID");
             exit;
         }

        $student_id = $_GET['id_new'];
        // Use a prepared statement for security
        //prepare creates a place holder to prevent injections
        $stmt = $connection->prepare("UPDATE `students`  
                                       SET `student_first_name` = ?, 
                                           `student_last_name` = ?, 
                                           `student_age` = ? 
                                       WHERE `id` = ?");
                                       //bind_param() Purpose: Binds variables to the placeholders defined in 
                                       //the prepared statement. This method
        $stmt->bind_param("ssii", $student_first_name, $student_last_name, $student_age, $student_id);

        $result = $stmt->execute();

        if (!$result) {
            throw new Exception("Failed to execute query: " . $stmt->error);
        }

        // Redirect on success
        header("location: ../index.php?message=Student updated successfully");
        exit; // Stop further execution

    } catch (Exception $e) {
        header("location: ../index.php?message=There was an error while updating the data");
        exit; // Stop further execution
    }

} else { // If button not submitted
    header("location: ../index.php?message=The Button Has not Been Submitted");
    exit; // Stop further execution
}
?>