<?php
// Include database connection at the top
include '../database_connection.php'; // Adjust the path as necessary

if (isset($_GET['id'])) { // Check if there is an ID
    $id = (int) $_GET['id'];
    try {
        $query = "SELECT * FROM `students` WHERE `id` = '$id'";
        $result = mysqli_query($connection, $query);

        if (!$result) {
            throw new Exception("The database failed to connect and to query."); // Handle query failure
        }

        // Check if any rows were returned
        if (mysqli_num_rows($result) === 0) {
            throw new Exception("No student found with the given ID."); // Handle case where no rows are returned
        }
    } catch (Exception $e) {
        header("location: ../index.php?message=Failed to fetch ID");
        echo '<script>console.log("The Error is: ' . $e->getMessage() . '");</script>';
        exit; // Stop further execution
    }
} else { // Handle case where no ID is provided
    header("location: ../index.php?message=There is no ID");
    echo '<script>console.log("There is no ID");</script>';
    exit; // Stop further execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #5cb85c;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>

<?php include '../Includes/Navigation.php'; ?>

<?php 
// Fetch the student data and display the form
while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <h2>Update Student Information</h2>
    <form action="Update_Process.php?id_new=<?php echo $id;?>" method="POST">
      
        <label for="student_first_name">First Name:</label>
        <input type="text" id="student_first_name" name="student_first_name" value="<?php echo htmlspecialchars($row['student_first_name']); ?>" required>

        <label for="student_last_name">Last Name:</label>
        <input type="text" id="student_last_name" name="student_last_name" value="<?php echo htmlspecialchars($row['student_last_name']); ?>" required>

        <label for="student_age">Age:</label>
        <input type="number" id="student_age" name="student_age" value="<?php echo htmlspecialchars($row['student_age']); ?>" required>

        <input type="submit" value="Submit" name="submit_student_input">
    </form>
    <?php
}
?>

</body>
</html>