<?php
session_start();

// Function to generate a random 4-digit code
function generateRandomCode() {
    return str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
}

// Generate a random 4-digit code and store it in session
$_SESSION['randomCode'] = generateRandomCode();
$randomCode = $_SESSION['randomCode'];


if (isset($_COOKIE['lang']) && $_COOKIE['lang'] == 'BM') {
    include "BM.php";
} else {
    include "EN.php"; // Default to English if language is not set or not BM
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Page</title>
    <!-- Include jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .question-button {
            background-color: #007bff; /* Blue background color */
            color: #fff; /* White text color */
            padding: 5px 10px; /* Padding around the text */
            border: none; /* No border */
            border-radius: 5px; /* Rounded corners */
            font-size: 6px; /* Font size */
            cursor: pointer; /* Cursor style */
            display: inline-block; /* Display as inline block */
            text-decoration: none; /* Remove underline */
        }

        .question-button:hover {
            background-color: #0056b3; /* Darker blue color on hover */
        }

        .question-mark {
            font-size: 12px; /* Adjust size of the question mark */
            vertical-align: middle; /* Align vertically */
            margin-right: 5px; /* Add space between question mark and text */
        }

        #additionalText {
            display: none; /* Initially hide the additional text */
        }
    </style>
</head>
<body>
    <?php include "Student_Head.php" ?>
    <h1><?php echo _STUDENT_PAGE; ?></h1> 

    <!-- Display QR code for scanning -->
    <img id="qrCode" src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo urlencode($randomCode); ?>&choe=UTF-8" alt="QR Code">

    <!-- Form to enter the 4-digit code -->
    <form id="attendanceForm" action="Update_attendance.php" method="POST">
        <label for="code">Enter 4-digit Code:</label>
        <input type="text" id="code" name="code" required>
        <button type="submit">Submit</button>
        <br>
        <a href="#" class="question-button" id="questionButton">
            <span class="question-mark">&#63; Click to learn more</span> <!-- Question mark icon -->
        </a>
        <a></a>
        <div id="additionalText">
            To mark your attendance, scan this QR code and fill the number given.
        </div>
    </form>

    <script>
        $(document).ready(function() {
            $('#questionButton').click(function() {
                $('#additionalText').toggle(); // Toggle visibility of additional text
            });
        });
    </script>
</body>
</html>
