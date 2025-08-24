<?php
// Include database connection at the top
include './database_connection.php'; // Adjust the path as necessary

$query = "SELECT * FROM `students`"; 
$result = mysqli_query($connection, $query);

if (!$result) {
    echo "Error: " . mysqli_error($connection);
    echo '<script>console.log("The Error is: ' . mysqli_error($connection) . '");</script>';
    exit; // Stop further execution if there's an error
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
        <link rel="icon" href="./Assest/Images/What-is-crud.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD_Php</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4; /* Light background color */
            margin: 0;
            padding: 20px;
        }

        h6 {
            color: #d9534f; /* Red color for messages */
            text-align: center;
        }

        .create-button, .delete, .update {
            display: inline-block;
            padding: 10px 15px;
            background-color: #28a745; /* Green background for Create */
            color: white; /* White text */
            text-decoration: none; /* Remove underline */
            border-radius: 5px; /* Rounded corners */
            margin-bottom: 15px; /* Space below the button */
            transition: background-color 0.3s; /* Smooth transition */
        }

        .delete {
            background-color: #dc3545; /* Red background for Delete */
        }

        .create-button:hover {
            background-color: #218838; /* Darker green on hover */
        }

        .delete:hover {
            background-color: #c82333; /* Darker red on hover */
        }

        table {
            width: 100%; /* Full width */
            border-collapse: collapse; /* Collapse borders */
            margin-top: 20px; /* Space above the table */
            background-color: #fff; /* White background for the table */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Shadow effect */
        }

        th, td {
            padding: 12px; /* Padding for table cells */
            text-align: left; /* Align text to the left */
            border-bottom: 1px solid #ddd; /* Bottom border for rows */
        }

        th {
            background-color: #f8f9fa; /* Light grey background for headers */
        }

        tr:hover {
            background-color: #f1f1f1; /* Light grey background on row hover */
        }
    </style>
</head>
<body>
<?php
 if(isset($_GET['message'])){
    $message = $_GET['message'];
    echo "<h6>" . htmlspecialchars($message) . "</h6>"; 
 }
?>
<?php include './Includes/Navigation.php'; ?>

<!-- Create Page Button -->
<a href="create_page.php" class="create-button">Create Page</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
               <th>Age</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        // Now you can safely loop through the results
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['id']) . '</td>';
            echo '<td>' . htmlspecialchars($row['student_first_name']) . '</td>';
            echo '<td>' . htmlspecialchars($row['student_last_name']) . '</td>';
            echo '<td>' . htmlspecialchars($row['student_age']) . '</td>';
            echo '<td><a href="./BackEnd/Update.php?id=' . $row['id'] . '" name="update" class="update">Update</a></td>';
            echo '<td><a href="./BackEnd/Delete.php?id=' . $row['id'] . '" name="delete" class="delete">Delete</a></td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>
    
</body>
</html>