<?php
include 'vars.php';

session_start();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$user = mysqli_real_escape_string($conn,$_POST['user']);
$pass = mysqli_real_escape_string($conn,$_POST['password']); 

$sql = "SELECT id FROM users WHERE user = '$user' and password = '$pass'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$id = $row['id'];

$sql2 = "SELECT * FROM lists WHERE userid = '$id'";
$result2 = mysqli_query($conn,$sql2);

$count = mysqli_num_rows($result);
$count2 = mysqli_num_rows($result2);

echo '<script type="text/javascript">document.cookie = "numlists='.$count2.'";</script>';
echo '<script type="text/javascript">document.cookie = "listnames=";</script>';
echo '<script type="text/javascript">document.cookie = "listnames=[]";</script>';
$listnames = "[]";
if($count == 1) {
         $_SESSION['user'] = $user;
         
         //header("location: welcome.php");
		 echo "login success";
		 echo '<script type="text/javascript">document.cookie = "logged_in=true";</script>';
		 echo '<script type="text/javascript">document.cookie = "user='.$user.'";</script>';
		 echo '<script type="text/javascript">document.cookie = "id='.$id.'";</script>';
		 $getlist = (mysqli_query($conn, "SELECT * FROM lists WHERE userid = ".$id));
		 //$result = mysqli_fetch_array($getlist,MYSQLI_ASSOC);
		 
		 $result = array();
		 while ($row = mysqli_fetch_array($getlist, MYSQLI_NUM)) {
			$result[] = $row[2];
			//echo $row[2];
		 }
		 //$cookieVar = $_COOKIE["listnames"];
		 if (is_array($result) || is_object($result)){
			 foreach($result as $key => $field_value){
				 $listnames = substr($listnames,0,strlen($listnames) - 1).$field_value.',]';
			 }
			 echo '<script type="text/javascript">document.cookie = "listnames='.$listnames.'";</script>';
		 }
}
else{
         echo "Your Login Name or Password is invalid";
}


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
header("Refresh:0; url=http://162.243.47.130/success.html");
//echo "Connected successfully";

$conn->close();
?>