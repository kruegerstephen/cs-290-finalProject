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
	$userpassword = $_POST["userPass"];

	$query = "SELECT user_id FROM userTable WHERE password = ?";
	$statement = $db->prepare($query);
	
	if($statement){
        $statement->bind_param("s",$userpassword);
    	$statement->execute();
    	$statement->store_result();
    	$statement->bind_result($user_id);
    	while($statement->fetch()){
    	     $_SESSION["userId"] = $user_id;
        }
	}else{
	  
	   echo "Sign-in Failed, Try Again";

	}

	$statement->free_result();
      		header('Location: http://people.oregonstate.edu/~kruegest/Final/topoo.php');  



	
?>

<html>
    <body>
    <a href = "topoo.php">Go Home</a>
    <br>
 
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="fpJS.js"></script>
    
    </body>
</html>