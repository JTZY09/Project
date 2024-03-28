<?php
session_start();
include"Database.php";

include"Employee_Head.php";


if (isset($_COOKIE['lang']) && $_COOKIE['lang'] == 'BM') {
    include "BM.php";
} else {
    include "EN.php"; // Default to English if language is not set or not BM
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
</head>
<body>
    <h1><?php echo _ADD_STUDENT;?></h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Add Student">
    </form>
</body>
</html>
<?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Insert student data into the database
        $sql = "INSERT INTO Student (Student_Username, Student_Password) VALUES ('$username', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "New student added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
}

?>