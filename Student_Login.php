<?php include "Head1.php"; ?>

<html>
<head>
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .login-container {
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }

        input[type="text"], input[type="password"], button {
            display: block;
            width: 100%;
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .password-container {
            position: relative;
        }

        #password {
            padding-right: 30px;
        }

        #img1 {
            position: absolute;
            right: 10px;
            top: 65%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Welcome to Valo HighSchool Student Login Portal </h1>
    <div class="login-container">
        <h2>Student Login</h2>

        <?php
        // Initialize $lang variable
        $lang = "EN";

        // Handle language selection using cookies
        if (isset($_POST["lang"])) {
            $lang = $_POST["lang"];
            setcookie("lang", $lang, time() + (86400 * 30), "/"); // Set cookie for 30 days
            echo "Language set via form: $lang";
        } else {
            // If language is not set via form, check if it's already set in the cookie
            if(isset($_COOKIE["lang"])) {
                $lang = $_COOKIE["lang"];
            } else {
                // Default language if no selection is made
                $lang = "EN";
                echo "Default language: $lang";
            }
        }

        if (isset($_POST["username"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];

            $sql = "SELECT Student_Password FROM Student WHERE Student_Username = '$username'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if ($row['Student_Password'] == $password) {
                    $_SESSION["username"] = $username;
                    setcookie("username", $username, time() + (86400 * 30), "/"); // Set cookie for 30 days
                    header("Location: Student_Home.php");
                    exit(); // Add exit to stop further execution
                } else {
                    echo "<p> Username or password incorrect </p>";
                }
            } else {
                echo "<p> Username does not exist </p>";
            }
        }
        ?>

        <form method="POST" action="Student_Login.php">
            Username: <input type="text" name="username"><br>
            <!-- Password input wrapped in container for eye icon -->
            <div class="password-container">
                Password: 
                <input type="password" name="password" id="password">
                <img id="img1" src="eyesclose.jpeg" width="20" onclick="togglePasswordVisibility()">
            </div>
            <br>
            <select name="lang">
                <option value="EN" <?php if($lang == "EN") echo "selected"; ?>>English</option>
                <option value="BM" <?php if($lang == "BM") echo "selected"; ?>>Malay</option>
            </select>
            <br>
            <button type="submit" value="Login">Login</button>
        </form>
        <script>
            function togglePasswordVisibility() {
                let passwordField = document.getElementById("password");
                let eyeIcon = document.getElementById("img1");

                if (passwordField.type === "password") {
                    passwordField.type = "text";
                    eyeIcon.src = "eyesopen.png";
                } else {
                    passwordField.type = "password";
                    eyeIcon.src = "eyesclose.jpeg";
                }
            }
        </script> 
    </div>
</body>
</html>
