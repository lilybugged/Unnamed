<?php
$servername = "localhost";
$username = "root";
$password = "kc8pQ6qsab";
$dbname = "makeup";
session_start();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$user = mysqli_real_escape_string($conn,$_POST['user']);
$pass = mysqli_real_escape_string($conn,$_POST['password']); 

$sql = "SELECT id FROM users WHERE user = '$user' and password = '$pass'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$active = $row['active'];

$count = mysqli_num_rows($result);

if($count == 1) {
         $_SESSION['user'] = $user;
         
         //header("location: welcome.php");
		 echo "login success";
		 echo '<script type="text/javascript">document.cookie = "logged_in=true";</script>';
		 echo '<script type="text/javascript">document.cookie = "user='.$user.'";</script>';
		 $getList = (mysqli_query($conn, "SELECT lists FROM lists WHERE userid = 1"));
		 echo '<script type="text/javascript">document.cookie = "lists='.$getList.'";</script>';
		 echo $getList;
		 
}
else{
         echo "Your Login Name or Password is invalid";
}


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";

$conn->close();
?>