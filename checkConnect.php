<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "checkgate";

$conn = new mysqli($servername, $username, $password ,$dbname);
	$name = "dinh van toan" ;

$sql = 'INSERT INTO check_gate (id, name, phone)
	VALUES (null,"'.$name.'", "123452324")';
	if ($conn->query($sql) === TRUE) {
		echo $sql;
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
	$conn->close();
?>