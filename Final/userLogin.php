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


    $sql = "SELECT * FROM userTable";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["user_id"]. " - User/Pass: " . $row["username"]. " " . $row["password"]. "<br>";
    }
    } else {
    echo "0 results";
    }
    
?>




<html>
    
    <head>
<link rel="stylesheet" type="text/css" href="style.css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

</head>
    <body>
        
    
    

            <form class = "form-group" action="" method="post">
               <h2>Sign Up</h2><br>
               <div id= "availability"></div>
                UserName: <input class = "form-control" type="text" id = "user"><br>
                Password: <input class = "form-control" type="text" id="password"><br>
                <input type="submit" id="addUserSubmit"></input>
            </form>
        
    
    <div id="signedIn"></div>

    <form class="form-group" action="loginResult.php" method="post">
        <h2>Sign In</h2><br>
        UserName: <input class = "form-control"  type="text" name="username"><br>
        Password: <input class = "form-control"  type="text" name="userPass"><br>
        <input type="submit"></input>
    </form>
    
        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="fpJS.js"></script>
    </body>
</html>


