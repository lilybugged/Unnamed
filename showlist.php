<?php
$servername = "localhost";
$username = "root";
$password = "kc8pQ6qsab";
$dbname = "makeup";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$listname = mysqli_real_escape_string($conn, $_POST['myselect']);

$user = $_COOKIE["user"];
$id = $_COOKIE["id"];

$sql = "SELECT lists FROM lists WHERE userid = '$id' and listname=".$listname;
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$list = $row['lists'];


$sql1 = "SELECT * FROM lists WHERE userid = ".$id;
$result1 = $conn->query($sql1);

$count = mysqli_num_rows($result1);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";


$q2 = $conn->query($sql2) === TRUE;

if ($q2) {
    //"New record created successfully";
} else {
	echo "Error: " . $sql2 . "<br>" . $conn->error;
}
if ($q2) {
	header("Refresh:0; url=http://162.243.47.130/success.html");
}

$conn->close();
?>