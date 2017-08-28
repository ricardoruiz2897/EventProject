<?php

    //This files receives the events and handless them
    //Then sends them back to look event

    //MANAGES MYSQLi                          
    //GETING EVENT DATA
    $eOrg = $_POST["eventOrgBox"];
    $eName = $_POST["eventNameBox"];
    $eDesc = $_POST["eventDescBox"];

    //Create connection with database
    $conn = mysqli_connect("localhost", "root", "", "newDataBase");

    //Check connection_status
    if(!$conn){

        die("Connection Failed: " . mysqli_connect_error());

    }else{

        echo "connection successful";
        echo "<br>";
        
    }

    
    //this funtion writes the passed values to the database FirstTable
    function WritetoFirstTable($conn, $number, $organizer, $nameofEvent, $Description){
         
         //Table struct:
        /*Number1, Organizer, Name, Description*/

        //push elements into database
        $sql = "INSERT INTO FirstTable(Number1, Organizer, Name, Description)
                VALUES ('$number', '$organizer', '$nameofEvent', '$Description');";
    
        if(mysqli_multi_query($conn, $sql)){

            //send to thank you
            echo "<script>
                    $(document).ready(function(){

                        window.open('thanksPage.php','_self',false);


                    }); 
                 </script>";
            //echo "Arguments were passed correctly";

        }else{

            echo "Error: " . mysqli_error($conn);

        }

    }

    WritetoFirstTable($conn, 1, $eOrg, $eName, $eDesc);

    //close connection to datatabase
    mysqli_close($conn);

?>