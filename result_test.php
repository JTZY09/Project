<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: test.php");
    exit();
}


// Sample student results data (replace with actual data retrieval logic)
$student_results = array(
    array("name" => "John Doe", "subject" => "Math", "marks" => 85),
    array("name" => "Jane Smith", "subject" => "Science", "marks" => 92),
    array("name" => "David Brown", "subject" => "English", "marks" => 78)
);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Result System - Results</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="results-container">
        <h2>Welcome, <?php echo $_SESSION["username"]; ?>!</h2>
        <h3>Your Results</h3>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Marks</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($student_results as $result) { ?>
                    <tr>
                        <td><?php echo $result['name']; ?></td>
                        <td><?php echo $result['subject']; ?></td>
                        <td><?php echo $result['marks']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>