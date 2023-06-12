<?
/* Credentials */
$servername = "localhost";
$username = "root";
$password = "";
$database = "assessment360";

/* Connection */
$conn = new mysqli($servername, $username, $password, $database);
$conn->query("SET NAMES 'utf8'");

/* If connection fails for some reason */
if ($conn->connect_error) {
	die("Connection fail"/* . $conn->connect_error*/);
}
?>