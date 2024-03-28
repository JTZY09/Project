<html>
<?php
if (isset($_COOKIE['lang']) && $_COOKIE['lang'] == 'BM') {
    include "BM.php";
} else {
    include "EN.php"; // Default to English if language is not set or not BM
}
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        

        .container {
            max-width: 800px;
            margin: 50px auto;
            text-align: center;
        }
        h1 {
            color: #333;
        }
        .image-container {
            display: flex;
            justify-content: space-around;
            margin-top: 30px;
        }
        .image-container img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
        }
        .image-container img:hover {
            transform: scale(1.5);
        }
        .image-text {
            display: none; /* Initially hide the text */
            position: absolute; /* Position text absolutely relative to its container */
            top: 80%; /* Initial position */
            left: 50%; /* Place text horizontally centered */
            transform: translate(-50%, -50%); /* Center text properly */
            background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent background */
            color: white;
            padding: 10px;
            border-radius: 5px;
            transition: top 0.3s; /* Add transition for smooth animation */
        }
        .image-container:hover .image-text {
            display: block; /* Show text on image container hover */
            top: 50%; /* Adjust position when hovering */
        }
    </style>
<head>
    <title>Welcome</title>
    
</head>

<body>
    <?php $username = $_COOKIE["username"];?>
    <?php include "Employee_Head.php" ?>
    <h1><?php echo _WELCOME_TO_THE_LECTURER_PORTAL; ?>, <?php echo $username;?></h1>



    <div class="container">
        <div class="image-container">
            <div>
                <a href="Employee_Class.php">
                    <img src="Attendance.png" alt="Attendance">
                    <div class="image-text">Click to view attendance</div>
                </a>
            </div>
            <div>
                <a href="Employee_Results.php">
                    <img src="Result.png" alt="Result">
                    <div class="image-text">Click to add/edit student results</div>
                </a>
            </div>
            <div>
                <a href="Employee_Add_Student.php">
                    <img src="Student.png" alt="Result">
                    <div class="image-text">Click to add student</div>
                </a>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Student Result System. All rights reserved.</p>
    </footer>

    <script>
        // Hide all image texts initially
        const imageTexts = document.querySelectorAll('.image-text');
        imageTexts.forEach(text => text.style.display = 'none');

        // Show only the text associated with the hovered image and adjust its position
        document.querySelectorAll('.image-container a').forEach(anchor => {
            anchor.addEventListener('mouseover', function() {
                // Hide all image texts
                imageTexts.forEach(text => text.style.display = 'none');
                // Show only the text associated with the hovered image and adjust its position
                const textToShow = this.querySelector('.image-text');
                textToShow.style.display = 'block';
                textToShow.style.top = '50%';
            });
            anchor.addEventListener('mouseout', function() {
                // Hide all image texts when mouse moves out
                imageTexts.forEach(text => text.style.display = 'none');
                // Lower the position of the text when mouse moves out
                const textToHide = this.querySelector('.image-text');
                textToHide.style.top = '80%';
            });
        });
    </script>
</body>
</html>
