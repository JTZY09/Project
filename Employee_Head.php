<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            padding-top: 60px;
            background-color: rgba(51, 51, 51, 0.8); /* Black-gray background for body */
            background-image: url('GIF.gif');
            background-repeat: repeat;
            color: #333;
        }

        header {
            background-color: rgba(51, 51, 51, 0.8); /* Black-gray background for header */
            color: #fff; /* White text color */
            text-align: center;
            padding: 10px 0;
            width: 100%; /* Set the width to fill the entire viewport */
            position: fixed; /* Fix the header at the top of the viewport */
            top: 0; /* Align the top of the header with the top of the viewport */
            z-index: 2; /* Ensure header is above other content */
        }

        
        #navbar {
            position: fixed;
            top: 0;
            left: -250px;
            width: 250px;
            height: 100%;
            overflow-y: auto;
            transition: left 0.3s ease;
            z-index: 1;
            background-color: rgba(51, 51, 51, 0.8); /* Black-gray background color */
            color: white; /* Text color */
        }

        



        #navbar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 14px 16px;
        }

        #navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        #navbar h1 {
            text-align: center;
            margin-bottom: 30px;
            color: black;
        }

        #logout {
            margin-left: auto; /* Push the logout button to the right */
            color: red !important; /* Set the color to red */
        }
        
        #menu-icon {
            position: fixed;
            top: 20px;
            left: 20px;
            cursor: pointer;
            z-index: 2;
            color: black;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: black; /* Set text color to white */
        }

        #content {
            display: flex; /* Set the content area as a flex container */
            flex-direction: column; /* Arrange children vertically */
            align-items: center; /* Center children horizontally */
            justify-content: flex-start; /* Align children at the start of the main axis */
            width: 100%; /* Set the content area to fill the available width */
            color: white; /* Set text color to white */
        }
        
        .hidden {
            display: none; /* Hide the element */
        }
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            width: 100%; /* Set the width to fill the entire viewport */
            position: fixed; /* Fix the footer at the bottom of the viewport */
            bottom: 0; /* Align the bottom of the footer with the bottom of the viewport */
        }
        body {
            background-image: url('GIF.gif'); /* Set the background GIF */
            background-repeat: repeat; /* Repeat the GIF if necessary */
            color: #333; /* Set text color to a dark shade for better readability */
            font-family: Arial, sans-serif; /* Choose a professional font */
            margin: 0; /* Reset margin */
            padding: 0; /* Reset padding */
        }
    </style>
</head>
<body>
    <div id="navbar">
        <h1>Menu</h1>
        <a href="Employee_Home.php">Home</a>
        <a href="Employee_Class.php">Class Attendance</a>
        <a href="Employee_Results.php">Edit Results</a>
        <a href="Employee_Add_Student.php">Add Students</a>
        <a id="logout" href="Employee_Logout.php">Logout</a>
    </div>

    <!-- Hamburger icon -->
    <div id="menu-icon">&#9776;<span id="show-more" class="show-more"> Show more</span></div>

    <script>
        // JavaScript to toggle navbar visibility
        document.getElementById('menu-icon').addEventListener('click', function() {
            var navbar = document.getElementById('navbar');
            if (navbar.style.left === '0px') {
                navbar.style.left = '-250px';
                document.getElementById('show-more').classList.remove('hidden');
            } else {
                navbar.style.left = '0px';
                document.getElementById('show-more').classList.add('hidden');
            }
        });
    </script>
    <footer>
        <p>&copy; 2024 Student Result System. All rights reserved.</p>
    </footer>
</body>
</html>
