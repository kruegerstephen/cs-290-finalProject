<?php


   $servername = "oniddb.cws.oregonstate.edu";
    $username = "kruegest-db";
    $password = "FjPg4gghz9FXQqS7";
    $database = "kruegest-db";


    $db = new mysqli($servername, $username, $password, $database);

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    } 

    $sql = "CREATE DATABASE fpDatabase";
        if ($db->query($sql) === TRUE) {
            echo "Database created successfully";
        } else {
            echo "Error creating database: " . $db->error;
        }
        
    $sql = "CREATE TABLE userTable (
                user_id INT(6) UNSIGNED AUTO_INCREMENT , 
                username VARCHAR(30) NOT NULL,
                password VARCHAR(30) NOT NULL,
                reg_date TIMESTAMP,
                PRIMARY KEY (user_id)
            )";
            
    $sql_2 = "CREATE TABLE movieList (
                u_id INT(6), 
                movieList_id INT(6) UNSIGNED AUTO_INCREMENT,
                movieList_name VARCHAR(30) NOT NULL,
                movieID_1 VARCHAR(30) NOT NULL,
                movieID_2 VARCHAR(30) NOT NULL,
                movieID_3 VARCHAR(30) NOT NULL,
                movieID_4 VARCHAR(30) NOT NULL,
                movieID_5 VARCHAR(30) NOT NULL,
                PRIMARY KEY (movieList_id)
            )";

    if ($db->query($sql) === TRUE) {
        echo "Table userTable created successfully";
    } else {
        echo "Error creating table: " . $db->error;
    }
    
    if ($db->query($sql_2) === TRUE) {
        echo "Table Movie created successfully";
    } else {
        echo "Error creating table: " . $db->error;
    }
    
    
?>