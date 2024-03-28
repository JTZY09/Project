<?php
session_start();
include "Database.php";

$_SESSION["role"] = "Employee"; // Set session role for testing
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "Employee") {
    echo "Redirecting..."; // Debugging statement
    header("location: Employee_Login.php");
    exit;
}

// Initialize $student_id and $student_name variables
$student_id = "";
$student_name = "";

// Check Student_ID is provided in the URL
if (isset($_GET["Student_ID"])) {
    $student_id = $_GET["Student_ID"];

    //  database to check if the student already has results
    $query = "SELECT * FROM result WHERE Student_ID = $student_id";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        // Results exist
        echo "User already has grades. <a href='Employee_Add_Result.php'>Back</a>";
        exit; 
    }

    //  fetch the student's name based on student ID
    $query = "SELECT Student_Username FROM Student WHERE Student_ID = $student_id";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        // Get student's name
        $row = $result->fetch_assoc();
        $student_name = $row['Student_Username'];
    } else {
        // student ID is not found or query fails
        echo "Student not found or query failed.";
    }
}

// Grading Marks
function generateGrade($marks) {
    if ($marks >= 81 && $marks <= 100) {
        return "A";
    } elseif ($marks >= 71 && $marks <= 80) {
        return "B";
    } elseif ($marks >= 61 && $marks <= 70) {
        return "C";
    } elseif ($marks >= 51 && $marks <= 60) {
        return "D";
    } elseif ($marks >= 41 && $marks <= 50) {
        return "E";
    } else {
        return "F";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $student_id = $_GET["Student_ID"];
    $english_marks = $_POST["english_marks"];
    $chinese_marks = $_POST["chinese_marks"];
    $malay_marks = $_POST["malay_marks"];
    $maths_marks = $_POST["maths_marks"];
    $science_marks = $_POST["science_marks"];

    // Generate grades based on marks
    $english_grade = generateGrade($english_marks);
    $chinese_grade = generateGrade($chinese_marks);
    $malay_grade = generateGrade($malay_marks);
    $maths_grade = generateGrade($maths_marks);
    $science_grade = generateGrade($science_marks);

    // Insert data into the database
    $query = "INSERT INTO result (Student_ID, English_Marks, English_Grade, Chinese_Marks, Chinese_Grade, Malay_Marks, Malay_Grade, Maths_Marks, Maths_Grade, Science_Marks, Science_Grade) 
              VALUES ('$student_id', '$english_marks', '$english_grade', '$chinese_marks', '$chinese_grade', '$malay_marks', '$malay_grade', '$maths_marks', '$maths_grade', '$science_marks', '$science_grade')";

    if ($conn->query($query) === TRUE) {
        // Redirect back to Employee_Results.php
        header("Location: Employee_Results.php?Student_ID=$student_id");
        exit;
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}
?>
<html>
<head>
    <title>Add Result</title>
</head>
<body>
<?php include "Employee_Head.php" ?>
    <h1>Add Result for <?php echo $student_name != "" ? $student_name : "Student ID $student_id"; ?></h1>
    <form method="POST" action="Employee_Add_Result.php?Student_ID=<?php echo $student_id; ?>">
        <label for="english_marks">English Marks:</label>
        <input type="text" id="english_marks" name="english_marks" value=""><br>

        <label for="chinese_marks">Chinese Marks:</label>
        <input type="text" id="chinese_marks" name="chinese_marks" value=""><br>

        <label for="malay_marks">Malay Marks:</label>
        <input type="text" id="malay_marks" name="malay_marks" value=""><br>

        <label for="maths_marks">Maths Marks:</label>
        <input type="text" id="maths_marks" name="maths_marks" value=""><br>

        <label for="science_marks">Science Marks:</label>
        <input type="text" id="science_marks" name="science_marks" value=""><br>

        <input type="submit" value="Add Result">
    </form>
    
</body>
</html>
