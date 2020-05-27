<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="index.css">
</head>
<body>

<h2>HTML Table</h2>

<table>
  <tr>
    <th style="width: 30%">Thông tin</th>
    <th>QR</th>
  </tr>  
   <tr>
    <th>
    	<form action="renderQr.php" method="POST">
    		<input type="text" name="name" placeholder="Tên"></br>
    		<input type="text" name="phone" placeholder="Số Điện Thoại"></br>
    		<input type="submit" name="submit">
    	</form>

    </th>
    <th>
    	<?php 
    	if(isset($_GET['image'])){
    	$name = "qrImage/".$_GET['image'];
    	echo '<img src='.$name .' class="center">' ;
    	}else{
    	echo '<img src="images.png" class="center">' ;
    }
    	?>
    	<!-- <img src= <?php $name ?> class="center"> -->
    	
    </th>
    
  </tr>  
</table>

</body>
</html>
