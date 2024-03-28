<?php

session_start();
include"Database.php";




// Check if the form is submitted and the required fields are set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Student_ID"])) {
    // Get the student ID and grades from the form
    $student_id = $_POST["Student_ID"];
    $english_marks = $_POST["english_marks"];
    $english_grade = $_POST["english_grade"];
    $chinese_marks = $_POST["chinese_marks"];
    $chinese_grade = $_POST["chinese_grade"];
    $malay_marks = $_POST["malay_marks"];
    $malay_grade = $_POST["malay_grade"];
    $maths_marks = $_POST["maths_marks"];
    $maths_grade = $_POST["maths_grade"];
    $science_marks = $_POST["science_marks"];
    $science_grade = $_POST["science_grade"];

    // Prepare the update query
    $query = "UPDATE result SET 
              English_Marks = '$english_marks', English_Grade = '$english_grade',
              Chinese_Marks = '$chinese_marks', Chinese_Grade = '$chinese_grade',
              Malay_Marks = '$malay_marks', Malay_Grade = '$malay_grade',
              Maths_Marks = '$maths_marks', Maths_Grade = '$maths_grade',
              Science_Marks = '$science_marks', Science_Grade = '$science_grade'
              WHERE Student_ID = $student_id";

    // Execute the update query
    if ($conn->query($query) === TRUE) {
        echo "Grades updated successfully.";
        header("location: Employee_Results.php"); // Redirect to Employee_Results.php after updating grades
        exit; // Terminate script execution after redirection
    } else {
        echo "Error updating grades: " . $conn->error;
    }
}
?>