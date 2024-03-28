<?php
// Include the database connection file
include "Database.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the entered code from the form
    $enteredCode = $_POST["code"];
    
    // Check if the entered code matches the random code
    session_start();
    $randomCode = $_SESSION['randomCode'];
    
    if ($enteredCode === $randomCode) {
        // Update the attendance in the database
        
        // Update attendance in the student table
        $sql = "UPDATE Student SET Attendance = 'MARKED' WHERE Student_Username = '{$_SESSION['username']}'";
        if ($conn->query($sql) === TRUE) {
            header("Location:Student_Home.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Incorrect code";
    }
}
?>
