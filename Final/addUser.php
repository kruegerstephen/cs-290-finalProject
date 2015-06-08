<?php 

session_start(); 

	$servername = "oniddb.cws.oregonstate.edu";
    $username = "kruegest-db";
    $password = "FjPg4gghz9FXQqS7";
    $database = "kruegest-db";
    $dbport = 3306;


    $db = new mysqli($servername, $username, $password, $database, $dbport);

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    } 


	$user = $_POST["user"];
	$userpassword = $_POST["password"];
	echo $user;

	$query = "INSERT INTO userTable(username,password) VALUES(?, ?)";
	if($statement = $db->prepare($query)){
    	$statement->bind_param("ss",$user,$userpassword);
    	$result = $statement->execute();
    	if($result){
    	    echo true;
    	  }else{
    	      echo $statement->error;
    	  }
        $statement->free_result();
	}
	
	$db->close();
    

?>