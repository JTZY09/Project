<?php
session_start();
include "Database.php";

$_SESSION["role"] = "Lecturer"; // Set session role for testing
if(!isset($_SESSION["role"]) || $_SESSION["role"] !== "Lecturer") {
    echo "Redirecting..."; // Debugging statement
    header("location: Lecturer_Login.php");
    exit;
}

if (isset($_COOKIE['lang']) && $_COOKIE['lang'] == 'BM') {
    include "BM.php";
} else {
    include "EN.php"; // Default to English if language is not set or not BM
}
?>

<html>
<head>
    <title>Examination Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            overflow-x: auto; /* Enable horizontal scrolling if content overflows */
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            table-layout: fixed; /* Fixed layout for the table */
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
            word-wrap: break-word; /* Wrap long words in cells */
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            width: 20%; /* Set the width for the header columns */
        }

        td {
            width: 20%; /* Set the width for the data columns */
        }
        td:nth-child(1) {
            background-color: #e6f7ff; /* Light blue background for the first column */
        }

        td:nth-child(2) {
            background-color: #fffacd; /* Light yellow background for the second column */
        }

        td:nth-child(3) {
            background-color: #ffe6e6; /* Light red background for the third column */
        }

        td:nth-child(4) {
            background-color: #e0e0eb; /* Light purple background for the fourth column */
        }
    </style>
</head>


<body>
    <?php include "Employee_Head.php" ?>
    <div class="container">
        <h1><?php echo _EXAMINATION_RESULT; ?></h1>
        

        <?php
        // Query the database to retrieve student information
        $query = "SELECT * FROM Student"; // Example query
        $result = $conn->query($query);
        
        if ($result && $result->num_rows > 0) {
            // Fetch student information as associative array
            $students = $result->fetch_all(MYSQLI_ASSOC);
            
            // Display student information in a table
            echo "<table>";
            echo "<tr><th>Student ID</th><th>Name</th><th>Edit</th><th>Add</th></tr>";
            foreach ($students as $student) {
                echo "<tr>";
                echo "<td>{$student['Student_ID']}</td>";
                echo "<td>{$student['Student_Username']}</td>";
                echo "<td><a href='Employee_Edit.php?Student_ID={$student['Student_ID']}'>Edit Result</a></td>"; // Link to edit result page with student ID as parameter
                echo "<td><a href='Employee_Add_Result.php?Student_ID={$student['Student_ID']}'>Add Result</a></td>"; // Link to edit result page with student ID as parameter
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No students found in the database.";
        }
        ?>
    </div>
</body>
</html>
