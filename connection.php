<?php 

	include (BookRoom.php);
	/* CONNECTING TO DATABASE */
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$dbname = 'pramanahotel';
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass);

	if (!$conn)     
		die('Could not connect: ' . mysqli_error($conn));
	if (!mysqli_select_db($conn, $dbname))    
		die("Can't select database");	

	$name =  $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$stayInDate = $_POST['stayInDate'];
	$lengthOfStay = $_POST['lengthOfStay'];
	$roomTypeID = $_POST['roomType'];

	/*CHECK IF CUSTOMER ALREADY EXISTS OR NOT*/
	$query = "SELECT CustomerID FROM customer WHERE Email ='" .$email."'";
	$result=mysqli_query($conn,$query); 

	/*ADD NEW CUSTOMER INTO CUSTOMER TABLE*/
	if(mysqli_num_rows($result) == 0)
	{
		$query = "INSERT INTO customer VALUES (DEFAULT,'".$name."','".$email."',".$phone.");";
	    if (mysqli_query($conn, $query)) {
		    echo "Customer record created successfully";
		} else {
		    echo "Error: " . $query . "<br>" . mysqli_error($conn);
		}
	}
	
	/*GET CUSTOMER ID FROM CUSTOMER TABLE TO STORE IN TRANSACTION TABLE*/
	$query = "SELECT CustomerID FROM customer WHERE Email ='" .$email."'";	
	$result = mysqli_query($conn,$query); 
	$CustomerID = mysqli_fetch_row($result);

	/*STORA DATA IN TRANSACTION TABLES*/
	$query = "INSERT INTO transaction VALUES (DEFAULT,".$CustomerID[0].",".$roomTypeID.",".$lengthOfStay.",CAST('".$stayInDate."' AS DATE));";
	if (mysqli_query($conn, $query)) {
	    echo "Transaction record created successfully";
	} else {
	    echo "Error: " . $query . "<br>" . mysqli_error($conn);
	}


	/* IF CUSTOMER ORDERS ANY ADDITIONAL SERVICE */
	if(!empty($_POST['additionalService'])) {
		$additionalCharge = $_POST['additionalService'];
		$transactionID = mysqli_insert_id($conn);
		foreach ($additionalCharge as $value) {
			$query = "INSERT INTO transactiondetails VALUES(".$transactionID.",".$value.");";
			mysqli_query($conn,$query); 
		}
	}

	echo '<script>window.location.href = "success.php";</script>';

?>