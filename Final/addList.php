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
    $id_1 = $_POST["id_1"];
    $id_2 = $_POST["id_2"];
    $id_3 = $_POST["id_3"];
    $id_4 = $_POST["id_4"];
    $id_5 = $_POST["id_5"];
    $user_id = $_SESSION["userId"];
    
    echo $id_1;
    echo $id_2;
   
    
    
	$query = "INSERT INTO movieList(u_id,movieList_name,movieID_1,movieID_2,movieID_3,movieID_4,movieID_5) VALUES(?,?,?,?,?,?,?)";
	$statement = $db->prepare($query);
	if($statement){
    	$statement->bind_param("issssss",$user_id,$listName,$id_1,$id_2,$id_3,$id_4,$id_5);
    	$result = $statement->execute();
    	if($result){
    	    echo "true";
    	}else{
	        echo $statement->error;
    	}
	}else{
	    echo "false";
	}
    
    $statement->free_result();
	$db->close();
    

?>