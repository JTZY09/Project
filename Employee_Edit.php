<?php
session_start();
include "Database.php";

$_SESSION["role"] = "Employee"; // Set session role for testing
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "Employee") {
    echo "Redirecting..."; // Debugging statement
    header("location: Employee_Login.php");
    exit;
}

// Check if student ID is provided in the URL
if (isset($_GET["Student_ID"])) {
    $student_id = $_GET["Student_ID"];

    // Query the database to fetch the current grades for the selected student
    $query = "SELECT * FROM result WHERE Student_ID = $student_id";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $grades = $result->fetch_assoc();
    } else {
        echo "No grades found for the selected student. <a href='Employee_Results.php'>Back</a>";
        exit;
    }
} else {
    echo "No student ID provided.";
    exit;
}

// Function to calculate grades based on marks
function calculateGrade($marks) {
    if ($marks >= 80 && $marks <= 100) {
        return "A";
    } elseif ($marks >= 70 && $marks <= 79) {
        return "B";
    } elseif ($marks >= 60 && $marks <= 69) {
        return "C";
    } elseif ($marks >= 50 && $marks <= 59) {
        return "D";
    } elseif ($marks >= 40 && $marks <= 49) {
        return "E";
    } else {
        return "F";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $english_marks = $_POST["english_marks"];
    $chinese_marks = $_POST["chinese_marks"];
    $malay_marks = $_POST["malay_marks"];
    $maths_marks = $_POST["maths_marks"];
    $science_marks = $_POST["science_marks"];

    // Update grades based on the updated marks
    $english_grade = calculateGrade($english_marks);
    $chinese_grade = calculateGrade($chinese_marks);
    $malay_grade = calculateGrade($malay_marks);
    $maths_grade = calculateGrade($maths_marks);
    $science_grade = calculateGrade($science_marks);

    // Update the grades in the database
    $update_query = "UPDATE result SET 
                    English_Marks = '$english_marks', English_Grade = '$english_grade', 
                    Chinese_Marks = '$chinese_marks', Chinese_Grade = '$chinese_grade', 
                    Malay_Marks = '$malay_marks', Malay_Grade = '$malay_grade', 
                    Maths_Marks = '$maths_marks', Maths_Grade = '$maths_grade', 
                    Science_Marks = '$science_marks', Science_Grade = '$science_grade' 
                    WHERE Student_ID = $student_id";

    if ($conn->query($update_query) === TRUE) {
        header("Location: Employee_Results.php"); // Redirect to Employee_Results.php
        exit;
    } else {
        echo "Error updating grades: " . $conn->error;
    }
}
?>

<html>
<head>
    <title>Edit Grades</title>
</head>
<body>
    <?php include "Employee_Head.php" ?>
    <h1>Edit Grades</h1>
    <form method="POST" action="">
        <input type="hidden" name="Student_ID" value="<?php echo $student_id; ?>">

        <label for="english_marks">English Marks:</label>
        <input type="text" id="english_marks" name="english_marks"
               value="<?php echo isset($grades['English_Marks']) ? $grades['English_Marks'] : ''; ?>"><br>

        <label for="chinese_marks">Chinese Marks:</label>
        <input type="text" id="chinese_marks" name="chinese_marks"
               value="<?php echo isset($grades['Chinese_Marks']) ? $grades['Chinese_Marks'] : ''; ?>"><br>

        <label for="malay_marks">Malay Marks:</label>
        <input type="text" id="malay_marks" name="malay_marks"
               value="<?php echo isset($grades['Malay_Marks']) ? $grades['Malay_Marks'] : ''; ?>"><br>

        <label for="maths_marks">Maths Marks:</label>
        <input type="text" id="maths_marks" name="maths_marks"
               value="<?php echo isset($grades['Maths_Marks']) ? $grades['Maths_Marks'] : ''; ?>"><br>

        <label for="science_marks">Science Marks:</label>
        <input type="text" id="science_marks" name="science_marks"
               value="<?php echo isset($grades['Science_Marks']) ? $grades['Science_Marks'] : ''; ?>"><br>

        <input type="submit" value="Update Grades">
    </form>
</body>
</html>
