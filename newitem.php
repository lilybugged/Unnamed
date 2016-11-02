<?php
include 'vars.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$itemname = mysqli_real_escape_string($conn, $_POST['itemname']);
$itemupc = mysqli_real_escape_string($conn, $_POST['itemupc']);
$itembrand = mysqli_real_escape_string($conn, $_POST['itembrand']);
$itemprice = mysqli_real_escape_string($conn, $_POST['itemprice']);
$itemurl = mysqli_real_escape_string($conn, $_POST['itemurl']);
$listname = mysqli_real_escape_string($conn, $_POST['listname']);

$user = $_COOKIE["user"];
$id = $_COOKIE["id"];

$sql = "SELECT lists FROM lists WHERE userid = '$id'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$list = $row['lists'];


if (strlen($list)===2){
	$concat = "[".$itemname.",".$itemupc.",".$itembrand.",".$itemprice.",".$itemurl."]";
}
else{
	$concat = ",[".$itemname.",".$itemupc.",".$itembrand.",".$itemprice.",".$itemurl."]";
}
$list = substr($list,0,strlen($list)-1).$concat.substr($list,strlen($list)-1,strlen($list));

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";

//insert


$newid = mysqli_insert_id($conn);
$sql2 = "UPDATE lists
SET lists = '".$list."'
WHERE userid = ".$id." AND listname='".$listname."';";

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