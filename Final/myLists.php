<?php 

    session_start(); 
    $user_id = $_SESSION["userId"];
    $arr;

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

    $movieList_name = $_POST['movieList_name'];

	$sql = "SELECT movieList_name, movieID_1, movieID_2, movieID_3, movieID_4, movieID_5 FROM movieList WHERE movieList_name = ?";
    $statement = $db->prepare($sql);
    if($statement){
        $statement->bind_param("s",$movieList_name);
    	$statement->execute();
    	$statement->bind_result($movieList_name,$id_1,$id_2,$id_3,$id_4,$id_5);
    	while($statement->fetch()){
    	    $arr = array ($id_1,$id_2,$id_3,$id_4,$id_5);
            echo json_encode($arr);
        }
	}else{
	    echo $statement->error;
	}
	
	$statement->free_result();
	$db->close();
	
?>