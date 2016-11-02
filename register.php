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
	/*$sql2 = "INSERT INTO lists (userid, lists) 
	VALUES ('$newid','[]')";
	echo $newid;*/
	
}
else if(preg_match("/([^A-Za-z])/",$first_name)==1){
	echo "only letters and numbers allowed";
}
else{
	echo "email address invalid";
}


$q2 = $conn->query($sql2) === TRUE;
if ($q1) {
    //echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
if ($q2) {
    //echo "New record created successfully";
} else {
	echo "Error: " . $sql2 . "<br>" . $conn->error;
}
if ($q1 && $q2) {
	header("Refresh:0; url=http://162.243.47.130/success.html");
}

$conn->close();
?>