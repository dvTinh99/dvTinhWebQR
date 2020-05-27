<?php
include('phpqrcode/qrlib.php');

    // how to save PNG codes to server

$tempDir = "qrImage/";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "checkgate";



if (isset($_POST["submit"])) {
	$name = $_POST["name"];
	$phone = $_POST["phone"];
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	$sql = 'INSERT INTO check_gate (id, name, phone)
	VALUES (null, "'.$name.'", "'.$phone.'")';
	if ($conn->query($sql) === TRUE) {
		$codeContents = $name.'/'.$phone;
    // we need to generate filename somehow, 
    // with md5 or with database ID used to obtains $codeContents...
		$fileName = $phone.md5($codeContents).'.png';

		$pngAbsoluteFilePath = $tempDir.$fileName;
		$urlRelativeFilePath = $tempDir.$fileName;

    // generating
		if (!file_exists($pngAbsoluteFilePath)) {
			QRcode::png($codeContents, $pngAbsoluteFilePath);
			echo 'File generated!';
			echo '<hr />';
		} else {
			echo 'File already generated! We can use this cached file to speed up site on common codes!';
			echo '<hr />';
		}

		echo 'Server PNG File: '.$pngAbsoluteFilePath;
		echo '<hr />';

    // displaying
    //echo '<img src="'.$urlRelativeFilePath.'" />';
		header("Location: index.php?image=".$fileName);
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	
	$conn->close();

	
}




?>