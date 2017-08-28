<?php

    //This file is for user to take out desired elements from the database
    //connect to Db
    $conn = mysqli_connect("localhost", "root", "", "EventDataBase");

    if(!$conn){
        echo "connection error";
    }else{
        echo "connection successfull ";
    }

    //delete specific
    $sql = "DELETE From Eventtable WHERE Organizer = 'Ricardo'";
    
    //delete All
    //$sql = "DELETE FROM Eventtable";

    if(mysqli_query($conn, $sql)){

        echo "task completed";

    }else{

        echo "error in task";

    }

    //close connection 
    mysqli_close($conn);
?>