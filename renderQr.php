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
	function decodeString($str,$phone) {
// Mỗi khoảng trắng sẽ là một phần tử trong mảng<br />
//$arrayName = trim(var_dump(explode(' ', $str)));

//$nameUser = trim(implode($arrayName));
//chuyển chuỗi string thành chuỗi ascii hex

// echo bin2hex($str)."</br>"; 
		$chuoiHex = trim(bin2hex($str));
//đếm xem có bao nhiêu kí tự trong string
// echo strlen($str)."</br>";
		$number = strlen($str);

//tách chuỗi thành mảng với điều kiện $separator và limit có thể null
// print_r(explode("20", $chuoiHex))."</br>";

		$phone1 = bin2hex($phone);
// echo $phone1."</br>";

		return $chuoiHex."2F".$phone1;
// echo $final;
//nối các thành phần của mảng thành chuỗi với khoảng phân biệt separator có thể null
//implode($separator, $array);
//space có mã ascii hex là 20

	}
	
	$conn = new mysqli($servername, $username, $password, $dbname);

	$sql = 'INSERT INTO check_gate (id, name, phone)
	VALUES (null, "'.$name.'", "'.$phone.'")';
	if ($conn->query($sql) === TRUE) {
		$codeContents = decodeString($name, $phone);
    // we need to generate filename somehow, 
    // with md5 or with database ID used to obtains $codeContents...
		$fileName = $phone.md5($phone).'.png';

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
		header("Location: index.php?image=".$fileName);
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();

	
}
//cấu trúc khi gửi đi doan van tinh/0965893632 = >
?>