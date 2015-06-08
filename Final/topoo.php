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
        
        <div class="back_ground">
        <div class='nav'>
            
                <ul class='navList'>
                    <li id="home" ><a class = "btn btn-default" role = "button" href = "home.php">Home</a></li>
                     <?php
                    if($user_id==""){
                            echo "<li id='login'><a class = 'btn btn-default' role = 'button'  href = 'userLogin.php'>Login</a></li>";
                        }else{
                            echo "<li id='logout'><a class = 'btn btn-default' role = 'button'  href = 'logout.php'>Logout</a></li>";
                        }
                    ?>
                </ul>
            
        </div>
        
        
    
     <div class = "searchbar  center-block">
       <h2>Search for Movies:</h2><input type="text" id="filmSearch">
        <button class = "button" id = "searchForFilm">Search</button>
        </div>
    <div class = movieTableSize>
        <?php 
        if($user_id!=null){
    	$sql = "SELECT movieList_name FROM movieList WHERE u_id = ?";
        $statement = $db->prepare($sql);
        if($statement){
            $statement->bind_param("s",$user_id);
        	$statement->execute();
        	$statement->bind_result($movieList_name);
        	echo "<h3>User Lists: </h3>";
            echo "<button class ='clear_list'>Close List</button>";
        	echo "<table class = 'userList table table-striped table-responsive'></table>";
        	while($statement->fetch()){
                echo "<button class = ' list-button movieList_Gen'>".$movieList_name."</button><br>";
            }
        }
    	}else{
    	    echo "<h4>You are not currently logged in. You can still create a guest list, but if you wish for your list to be linked to your account you will need to login.</h4>";
    	}
    ?>
    
    <br>
    <br>

    <div class = "seperator"></div>


        <h2 class = "cList">Current List</h2> 
        <h3>This is your current list. Search for movies above, add 5, title your list, and hit save!</h3>
        <h4>Hint: Come up with a creative title.</h4>
            <h3>Enter List Name:</h3><input type="text" class="listSavedName" style="
    height: 36px;"/>
            <input type="submit" value = "Save" class="button saveList"/>
    <table class = "curList table table-striped table-responsive">
        
    </table>

    <br>
    <br>

    <div class = "seperator"></div>

      <h2>Search Results:</h2>

        <table class = "movieDiv table table-striped table-responsive">
            
        </table>
    </div>
    
    
    
    
        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="fpJS.js"></script>
    </body>
</html>
