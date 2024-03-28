<?php
session_start();
include "Database.php";
?>

<?php
if (isset($_GET["language"])) {
    if ($_GET["language"] == "EN") {
        include("EN.php");
    } else if ($_GET["language"] == "BM") {
        include("BM.php");
    }
} else {
    include("En.php");
}
/**
 *
 *
 */

?>

<?php if (strpos($_SERVER['REQUEST_URI'], 'Student_Login.php') !== false): ?>
    <a href="Employee_Login.php">Not a student? Click me!</a>
<?php elseif (strpos($_SERVER['REQUEST_URI'], 'Employee_Login.php') !== false): ?>
    <a href="Student_Login.php">Not an employee? Click me!</a>
<?php endif; ?>





