<?php
include "../database_connection.php"; // Include your database connection

// Check if the button has been submitted
if (isset($_POST['submit_student_input'])) {

    // Get the variables 
    $student_first_name = $_POST['student_first_name'];
    $student_last_name = $_POST['student_last_name'];
    $student_age = $_POST['student_age'];

    // Check if any input is blank
    if (trim($student_first_name) == "" || trim($student_last_name) == "" || trim($student_age) == "") {
        header("location: ../index.php?message=The Data Input is Empty");
        exit; // Stop further execution
    }

    // Check if the student already exists
    $check_query = "SELECT * FROM `students` WHERE `student_first_name` = '$student_first_name' AND `student_last_name` = '$student_last_name'";
    $check_result = mysqli_query($connection, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        header("location: ../index.php?message=Student already exists");
        exit; // Stop further execution
    }

    // Process the data
    try {
        $query = "INSERT INTO `students` (`student_first_name`, `student_last_name`, `student_age`) 
                  VALUES ('$student_first_name', '$student_last_name', '$student_age')";
        
        $result = mysqli_query($connection, $query);

        if (!$result) {
            throw new Exception(mysqli_error($connection)); // Throw an exception if the query fails
        }

        // Redirect on success
        header("location: ../index.php?message=Student added successfully");
        exit; // Stop further execution

    } catch (Exception $e) {
        header("location: ../index.php?message=There was an error while creating the data");
        exit; // Stop further execution
    }

} else { // If button not submitted
    header("location: ../index.php?message=The Button Has not Been Submitted");
    exit; // Stop further execution
}
?>