<?php

    //EDIT FILE DEPENDING IN WHAT YOU WANT TO DO!!!!

    //This file initializes for database creation
    //$conn = mysqli_connect("localhost", "root", "");

    //this initializes for table creation or alteration
    $conn = mysqli_connect("localhost", "root", "", "UsersDatabase");

    
    //this command adds new column to the table
    //$sql_newColumn = "ALTER TABLE EventTable ADD End_Time varchar(255);";

    $sqlTableCreation = "CREATE TABLE UsersTable( 
                         UserName varchar(255),
                         Password varchar(255)
                            )";
    

    //Create conncetion with server
    if(!$conn){

            die("Connection Failed: " . mysqli_connect_error());

    }else{
        echo "Succesful connection";
        echo "<br>";
    }

    //Create Database
    /*
    $sql = "CREATE DATABASE UsersDatabase";
    
    if(mysqli_query($conn, $sql)){
        echo "Database was created successfully!";
    }else{
        echo "Error in connection!";
    }*/
    

    //Create table
    if(mysqli_query($conn, $sqlTableCreation)){

        echo "Table was created successfully";

    }else{
        echo "Problem creating database: " . mysqli_error($conn);
    }


    //Add column
    /*
    if(mysqli_query($conn, $sql_newColumn)){
        echo "column was added successfully";
    }else{
        echo "Error adding database";
    }
    */

    //close connection
    mysqli_close($conn);
?>