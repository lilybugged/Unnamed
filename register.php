<?php
include 'vars.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$first_name = mysqli_real_escape_string($conn, $_POST['name']);
$last_name = mysqli_real_escape_string($conn, $_POST['lastname']);
$email_address = mysqli_real_escape_string($conn, $_POST['email']);
$user = mysqli_real_escape_string($conn, $_POST['user']);
$pass = mysqli_real_escape_string($conn, $_POST['password']);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";

if (strpos($email_address, '@')!==false && strpos($email_address, '.')!==false && strlen($user)>0 && strlen($pass)>0 && !(preg_match("/\W/",$user)===1) && !(preg_match("/\W/",$pass)===1)){
	$sql = "INSERT INTO users (firstname, lastname, email, user, password)
	VALUES (LOWER('$first_name'), LOWER('$last_name'), LOWER('$email_address'), ('$user'), ('$pass'))";
	$q1 = $conn->query($sql) === TRUE;
}
else{
	echo "please input using correct syntax";
}

if ($q1) {
    header("Refresh:0; url=http://162.243.47.130/success.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>