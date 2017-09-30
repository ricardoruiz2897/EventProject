<html>
    <head>
    <title>Thank you page</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="Main.css">
        <script>
            $(document).ready(function(){

                $("#registerButton").click(function(){

                    window.open('Main.php','_self',false);

                });
            });

        </script>
    </head>
    <body>
        <?php
            //MANAGES MYSQLi                          
            //GETING EVENT DATA
            $eOrg = $_POST["eventOrgBox"];
            $eName = $_POST["eventNameBox"];
            $eDesc = $_POST["eventDescBox"];
            $eAddr = $_POST["eventAddrBox"];
            $eInit = $_POST["eventInitBox"];
            $eEnd = $_POST["eventEndBox"];
            $eInit_Time = $_POST["eventInitTimeBox"];
            $eEnd_Time = $_POST["eventEndTimeBox"];


            //Create connection with database: EventDataBase
            $conn = mysqli_connect("localhost", "root", "", "EventDataBase");

            //Check connection_status
            if(!$conn){

                die("Connection Failed: " . mysqli_connect_error());

            }else{

                //echo "connection successful";
                //echo "<br>";

            }

        //Table struct:
        /*Number1, Organizer, Name, Description*/

        //push elements into database
        $sql = "INSERT INTO EventTable(ID, Organizer, Name, Description, Address, Init_date, End_date, Init_Time, End_Time)
                VALUES (1, '$eOrg', '$eName', '$eDesc', '$eAddr', '$eInit', '$eEnd', '$eInit_Time', '$eEnd_Time');";
    
        if(mysqli_multi_query($conn, $sql)){

            //send to thank you
            //echo "Arguments were passed correctly";
            //echo "Arguments were passed correctly";

            }else{

            echo "Error: " . mysqli_error($conn);

            }
            
         //close connection
         mysqli_close($conn);

        ?>
        <h1>THANK YOU!!</h1>
        <div id='MainForm'>
        <h3>Your event has been submitted!</h3>
        <input type="button" id="registerButton" value="RETURN TO MAIN PAGE">
        </div>
    </body>
</html>