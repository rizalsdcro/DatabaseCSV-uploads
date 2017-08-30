<?php


$servername = "localhost";
$username = "root";
$password = "";
$db = "csv_to_db";
 
try {
   
    $conn = mysqli_connect($servername, $username, $password, $db);
     //echo "Connected successfully"; 
    }
catch(exception $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }


 if(isset($_POST["upload"])&&isset($_FILES['csvfile'])){
		
		$filename=$_FILES["csvfile"]["tmp_name"];		
 
 
		 if($_FILES["csvfile"]["size"] > 0)
		 {
		  	$file = fopen($filename, "r");
	        while (($getData = fgetcsv($file, 1000, ",",'"')) !== FALSE)
	         {
 		//define your own table names depending on the csv values
	         	//also you cld get the first column as you table headern and insert them directly
	           $sql = "INSERT into users (names,phone_number,location) 
                   values ('".$getData[0]."','".$getData[1]."','".$getData[2]."')";
                   $result = mysqli_query($conn, $sql);
				if(!isset($result))
				{
					echo "<script type=\"text/javascript\">
							alert(\"Invalid File:Please Upload CSV File.\");
							window.location = \"index.php\"	
						  </script>";	
				}
				else {
					  echo "<script type=\"text/javascript\">
						alert(\"CSV File has been successfully Imported.\");
						window.location = \"index.php\"
					</script>";
				}
	         }
			
	         fclose($file);	
		 }
	}	 
 
 
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>csv</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	<form class="form-control" method="POST" action="" enctype='multipart/form-data'>
		

		<div class="form-group">
			<label>select CSV file to upload</label>
			<input type="file" name="csvfile">
		</div>
		<div class="form-group">
			<button class="btn btn-success" name="upload"> Up-load File</button>
		</div>
	</form>
</body>
</html>