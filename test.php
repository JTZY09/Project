<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Result System</title>
    <link rel="stylesheet" href="styles.css">

<style>
    /* Reset default margin and padding */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
}

header {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 20px 0;
}

nav {
    background-color: #444;
}

nav ul {
    list-style-type: none;
    padding: 10px 0;
    text-align: center;
}

nav ul li {
    display: inline;
    margin: 0 10px;
}

nav ul li a {
    color: #fff;
    text-decoration: none;
}

main {
    padding: 20px;
}

.welcome-section {
    margin-bottom: 20px;
}

.result-section {
    border: 1px solid #ccc;
    padding: 10px;
}

.result-section h2 {
    margin-bottom: 10px;
}

footer {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 10px 0;
}

</style>
</head>
<body>
    <header>
        <h1>Student Result System</h1>
    </header>
    <nav>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Results</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Logout</a></li>
        </ul>
    </nav>
    <main>
        <section class="welcome-section">
            <h2>Welcome, [Student Name]!</h2>
            <p>Check your latest results and update your profile.</p>
        </section>
        <section class="result-section">
            <h2>Recent Results</h2>
            <ul>
                <li><strong>Subject 1:</strong> Grade A</li>
                <li><strong>Subject 2:</strong> Grade B</li>
                <li><strong>Subject 3:</strong> Grade A+</li>
                <!-- Add more recent results here -->
            </ul>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Student Result System. All rights reserved.</p>
    </footer>
</body>
</html>
