<!DOCTYPE html>
<html lang="en">
<?php
if (isset($_COOKIE['lang']) && $_COOKIE['lang'] == 'BM') {
    include "BM.php";
} else {
    include "EN.php"; // Default to English if language is not set or not BM
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Attendance</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e6e6e6; /* Light gray background  */
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333; /* Dark text color for heading */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: 2px solid #ff0000; /* Border color (changed to red) */
            background-color: #ffffff; /* White background */
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            color: #333; /* Dark text color for cells */
        }

        th {
            background-color: #ff0000; /* Red background for header cells */
            color: #fff; /* White text color for header cells */
        }

        tr:last-child td {
            border-bottom: none; /* Remove border on last row */
        }

        /* Alternate row background color */
        tr:nth-child(even) td {
            background-color: #f5f5f5; /* Light gray background for even rows */
            
        }

        /* Hover effect on table rows */
        tr:hover {
            background-color: #ffe6ff; /* Light pink background on hover */
            
        }

        .attendance-row td:nth-child(2) {
            color: #ff0000; /* Red color for the "Attendance" text */
        }
    </style>
</head>
<body>

<?php include "Employee_Head.php" ?>

<h1><?php echo _ATTENDANCE_TABLE; ?></h1>

<table>
    <tr>
        <th>Student Username</th>
        <th>Attendance</th>
    </tr>
    <?php
    // Establish database connection
    include "Database.php";

    // Fetch attendance data from the database
    $sql = "SELECT Student_Username, Attendance FROM student";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            $class = ($row["Attendance"] == "Attendance") ? "attendance-row" : ""; // Check if it's the row containing "Attendance"
            echo "<tr class='$class'>";
            echo "<td>" . $row["Student_Username"] . "</td>";
            echo "<td>" . $row["Attendance"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='2'>No attendance records found</td></tr>";
    }
    $conn->close();
    ?>
</table>
<br>


</body>
</html>
