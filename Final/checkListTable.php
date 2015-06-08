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
    
    
    $listName = $_POST["listName"];
    
    $query = "SELECT movieList_name FROM movieList WHERE movieList_name=?";

	if($statement = $db->prepare($query)){
    	$statement->bind_param("s",$listName);
    	$statement->execute();
    	$statement->bind_result($returned_result);
	    while($statement->fetch()){
            echo $returned_result;
        }
	}

    
?>