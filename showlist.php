<?php
include 'vars.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$listname = mysqli_real_escape_string($conn, $_POST['leest']);

$user = $_COOKIE["user"];
$id = $_COOKIE["id"];

$sql = "SELECT lists FROM lists WHERE userid = '$id' AND listname = '".$listname."'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$list = $row['lists'];
$list = preg_split("/(\[|\]|,)/",$list);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "<link rel=\"shortcut icon\" href=\"/favicon.ico\" type=\"image/x-icon\">
<link rel=\"icon\" href=\"/favicon.ico\" type=\"image/x-icon\">
<link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\">
<title>Makeup Inventory</title>
</head>
<body id=\"b1\">

<h1>Makeup Inventory</h1>
<p id=\"p1\"><img src=\"card hq 3.png\" alt=\"sad face\" style=\"float:right;width:500px;height:500px;\">". "Now Displaying: ".$listname."</p>";

//echo "Connected successfully";
if (sizeOf($list)<4){
	echo "This list is <b>empty!</b> Add an item first.";
	echo "<p></p>";
}
else{
	echo "<table>";
	$title = "";
	for ($i=0;$i<((sizeOf($list)-2)/7);$i=$i+1){
		for ($a=1;$a<7;$a=$a+1){
			switch($a){
				/*case 0:
					$title = "";
				break;*/
				case 1:
					$title = "-----------------------------------------------";
				break;
				case 2:
					$title = "Name";
				break;
				case 3:
					$title = "UPC Code";
				break;
				case 4:
					$title = "Brand";
				break;
				case 5:
					$title = "Retail Price";
				break;
				case 6:
					$title = "Image";
				break;
			}
			//echo "<tr><td>" . $title . "</td><td>" . $list[($i*7 + ($a))] . "</td></tr>";  
			if ($a===6){
				echo "<tr><td>" . $title . "</td><td>" . "<img src=\"".$list[($i*7 + ($a))]."\" alt=\"img\" height=\"42\" width=\"42\"></img>" . "</td></tr>"; 
			}
			/*else if ($a===0){
				echo "<tr><td>" . $title . "</td><td>" . "<img src=\"".$list[($i*7 + ($a))]."\" alt=\"img\" height=\"42\" width=\"42\"></img>" . "</td></tr>"; 
			}*/
			else{
				echo "<tr><td>" . $title . "</td><td>" . $list[($i*7 + ($a))] . "</td></tr>"; 
			}
		}
	}
	echo "</table>"; //Close the table in HTML
}
echo "<button onclick=\"window.location = 'http://162.243.47.130/'\">Return to Home</button>";


/*if ($q2) {
    //"New record created successfully";
} else {
	echo "Error: " . $sql2 . "<br>" . $conn->error;
}
if ($q2) {
	header("Refresh:0; url=http://162.243.47.130/success.html");
}
*/

$conn->close();
?>