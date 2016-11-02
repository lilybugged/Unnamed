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

if (strpos($email_address, '@')!==false && strpos($email_address, '.')!==false){
	$sql = "INSERT INTO users (firstname, lastname, email, user, password)
	VALUES (LOWER('$first_name'), LOWER('$last_name'), LOWER('$email_address'), ('$user'), ('$pass'))";
	$q1 = $conn->query($sql) === TRUE;
	
	$newid = mysqli_insert_id($conn);
	echo $newid;
	
}
else{
	echo "email address invalid";
}

if ($q1) {
    //echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
if ($q1 && $q2) {
	header("Refresh:0; url=http://162.243.47.130/success.html");
}

$conn->close();
?>