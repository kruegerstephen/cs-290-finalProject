<?php 

session_start(); 
 $user_id = $_SESSION["userId"];

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
    
    
?>


<html>

<head>
<link rel="stylesheet" type="text/css" href="style.css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

</head>
<body>
        <div class='nav'>
               <ul class='navList'>
                    <li id="home" ><a class = "btn btn-default" role = "button" href = "home.php">Home</a></li>
                    <li id="Add List" ><a class = "btn btn-default" role = "button" href = "topoo.php">My Lists/Add List</a></li>
                    <?php
                    if($user_id==""){
                            echo "<li id='login'><a class = 'btn btn-default' role = 'button'  href = 'userLogin.php'>Login/Sign-up</a></li>";
                        }else{
                            echo "<li id='logout'><a class = 'btn btn-default' role = 'button'  href = 'logout.php'>Logout</a></li>";
                        }
                    ?>
                </ul>
        </div>
        
<div class = "movieTableSize">        
            <div class = "welcome-block">
               
                   <h2> Welcome to top5</h2> <br>
                    This is a website where you will be able to create a top5 movie list and share it with the community.    
            </div>
            
        
     <?php 
        
    	$sql = "SELECT movieList_name FROM movieList";
        $statement = $db->prepare($sql);
        if($statement){
        	$statement->execute();
        	$statement->bind_result($movieList_name);
        	echo "<h3>Public Lists: </h3>";
            echo "<button class ='clear_list'>Close List</button>";
          	echo "<table class = 'userList table table-striped table-responsive'></table>";
        	while($statement->fetch()){
                echo "<button class = 'movieList_Gen list-button'>".$movieList_name."</button><br>";

            }

        }
    ?>
    
    </div>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="fpJS.js"></script>
    </body>
</html>
