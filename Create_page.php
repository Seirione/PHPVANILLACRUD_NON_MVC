<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php include "./Includes/Navigation.php" ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Page</title>
</head>
<body>

<h1>Student Information Form</h1>
<form action="./BackEnd/Create.php" method="POST">
    <label for="first_name">First Name:</label><br>
    <input type="text" id="first_name" name="student_first_name" required ><br><br>

    <label for="last_name">Last Name:</label><br>
    <input type="text" id="last_name" name="student_last_name" required><br><br>

    <label for="age">Age:</label><br>
    <input type="number" id="age" name="student_age" min="1" max="120" required><br><br>

    <input type="submit" value="Submit" name="submit_student_input">
</form>

</body>
</html>