<?php 

session_start(); 

 $servername = "oniddb.cws.oregonstate.edu";
    $username = "kruegest-db";
    $password = "FjPg4gghz9FXQqS7";
    $database = "kruegest-db";
    $dbport = 3306;


    // Create connection
    $db = new mysqli($servername, $username, $password, $database, $dbport);

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
    
	$user = $_POST["username"];
	
	$query = "SELECT user_id FROM userTable WHERE username = ?";
	if($statement = $db->prepare($query)){
    	$statement->bind_param("s",$user);
    	$statement->execute();
    	$statement->bind_result($returned_result);
	    while($statement->fetch()){
            echo $returned_result . '<br />';
        }
	}
	
	
	

    
?>