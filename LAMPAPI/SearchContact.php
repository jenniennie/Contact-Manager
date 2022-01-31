<?php
	$inData = getRequestInfo();
	
	$search = $_POST['search'];
	$userId = $inData["userId"];
	$FirstName = $inData["FirstName"];
	$LastName = $inData["LastName"];
	$Email = $inData["Email"];
	$Phone = $inData["Phone"];
	$today = date("Y-m-d H:i:s"); 
	$DateCreated = $today;

	$conn = new mysqli("localhost", "TheBeast", "WeLoveCOP4331", "COP4331");
	if ($conn->connect_error) 
	{
		returnWithError( $conn->connect_error );
	} 
	else 
	{
		$sql = "SELECT * FROM contacts WHERE name like '%$search%'";
		$result = $conn->query($sql);
		returnWithError("");
	}	

	function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}

	function sendResultInfoAsJson( $obj )
	{
		header('Content-type: application/json');
		echo $obj;
	}
	
	function returnWithError( $err )
	{
		$retValue = '{"error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}
	
?>