<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff; /* Fill the border with white color */
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:last-child td {
            border-bottom: none; /* Remove border on last row */
        }

        /* Style for table column */
        td {
            background-color: #fff; /* White background */
            color: #333; /* Dark text color */
        }

        /* Alternate row background color */
        tr:nth-child(even) td {
            background-color: #f2f2f2; /* Light gray background for even rows */
        }

        /* Adjustments for specific columns */
        .marks-column,
        .grades-column {
            text-align: right; /* Align content to the right */
            font-size: 14px; /* Smaller font size */
            width: 100px; /* Adjust the width as needed */
        }

        /* Increase font size for subjects */
        .subjects-column {
            font-size: 16px; /* Larger font size */
            text-align: left; /* Align content to the left */
        }

        /* Style for student name and ID */
        .student-info {
            font-weight: bold; /* Make text bold */
            color: #ff5733; /* Custom color for student info */
        }
    </style>
</head>
<body>
    <?php 
        include "Database.php"; 

        // Start session
        session_start();

        include "Student_Head.php";

        // Check if user is logged in
        if (!isset($_SESSION['username'])) {
            header("Location: Student_Login.php");
            exit();
        }

        if (isset($_COOKIE['lang']) && $_COOKIE['lang'] == 'BM') {
            include "BM.php";
        } else {
            include "EN.php"; // Default to English if language is not set or not BM
        }

        // Retrieve username from session
        $username = $_SESSION['username'];

        // Query database to get student ID based on username
        $sql = "SELECT `Student_ID` FROM `Student` WHERE `Student_Username` = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $studentID = $row['Student_ID'];

            // Query database to get result based on student ID
            $resultSql = "SELECT * FROM `Result` WHERE `Student_ID` = '$studentID'";
            $resultResult = $conn->query($resultSql);

            if ($resultResult->num_rows > 0) {
                // Display results
                echo "<h1>" . _STUDENT_RESULT . "</h1>";
                echo "<table border='1'>
                      <tr>
                      <th class='student-info' colspan='3'>" . _STUDENT_NAME . ": $username </th>
                      <br>
                      </tr>
                      <tr>
                     
                      <th class='student-info' colspan='3'>" . _STUDENT_ID . ": $studentID</th>
                      </tr>
                      <tr>
                      <th class='subjects-column'>" . _SUBJECT . "</th>
                      <th class='marks-column'>" . _MARKS . "</th>
                      <th class='grades-column'>" . _GRADE . "</th>
                      </tr>";

                // Mapping subjects to their corresponding marks and grades columns
                $subjects = array(
                    "English" => array("Marks" => "English_Marks", "Grade" => "English_Grade"),
                    "Chinese" => array("Marks" => "Chinese_Marks", "Grade" => "Chinese_Grade"),
                    "Malay" => array("Marks" => "Malay_Marks", "Grade" => "Malay_Grade"),
                    "Maths" => array("Marks" => "Maths_Marks", "Grade" => "Maths_Grade"),
                    "Science" => array("Marks" => "Science_Marks", "Grade" => "Science_Grade")
                );

                while ($row = $resultResult->fetch_assoc()) {
                    foreach ($subjects as $subject => $columns) {
                        echo "<tr>";
                        echo "<td class='subjects-column'>$subject</td>";
                        echo "<td class='marks-column'>" . (isset($row[$columns['Marks']]) ? $row[$columns['Marks']] : 'N/A') . "</td>";
                        echo "<td class='grades-column'>" . (isset($row[$columns['Grade']]) ? $row[$columns['Grade']] : 'N/A') . "</td>";
                        echo "</tr>";
                    }
                }
                echo "</table>";
            } else {
                echo "<p>No results found for this student.</p>";
            }
        } else {
            echo "<p>Error retrieving student information.</p>";
        }
    ?>
</body>
</html>
