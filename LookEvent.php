<html>
    <head>
        <title>Look for Events</title>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="Main.css">
        <script>
            $(document).ready(function(){

                $("#retButton").click(function(){

                    window.open("Main.php","_self",false);

                });

            });
        </script>
    </head>

    <body>

        <?php

            //set time zone
            date_default_timezone_set("America/Mexico_City");
            
            //get data from database and write each event
            //create connection with the database: EventDatabase
            $conn = mysqli_connect("localhost", "root", "", "EventDataBase");

            //Handling connection errors
            if(!$conn){

                echo "
                        <script>

                             $(document).ready(function(){

                            $('#TextArea').append('There is trouble with the connection');

                        });

                        </script>
                 
                    ";
            }

            //Get data from event table
            $sql = "SELECT Organizer, Name, Description, Address, Init_date, End_date, Init_Time, End_Time FROM Eventtable";
            $result = mysqli_query($conn, $sql);

            //var_dump($result); //Check info of object $result
            if($result->num_rows > 0){

                //output data as JS (more like side effect on screen)
                while($row = mysqli_fetch_assoc($result)) {

                        //set to temporal vars to pass them easier to the jquery
                        $tempOrg = $row['Organizer'];
                        $tempName = $row['Name'];
                        $tempDesc = $row['Description'];
                        $tempAddr = $row['Address'];
                        $tempInit_date = $row['Init_date'];
                        $tempEnd_date = $row['End_date'];
                        $tempInit_time = $row['Init_Time'];
                        $tempEnd_time = $row['End_Time'];

                        //Check if it is still a valid event (it has not passed), if not take event out of DB else print the event
                        //get current formats
                        $external_init = $tempInit_date  . " " . $tempInit_time; 
                        $external_end = $tempEnd_date . " " . $tempEnd_time;

                        //change date format
                        $current_format = "m/d/Y h:i A";
                        $dateObject_init = DateTime::createFromFormat($current_format, $external_init);
                        $dateObject_end = DateTime::createFromFormat($current_format, $external_end);
                        $_eventInit = $dateObject_init->format(DateTime::ATOM);
                        $_eventEnd = $dateObject_end->format(DateTime::ATOM);

                        //This JQUERY gets the vars from PHP and prints them into their corresponding box
                        if(strtotime($_eventInit) > time()){

                                //Print in 'future' box
                                echo "<script>

                                         $(document).ready(function(){
                                            $('#Future_TextArea').append('Who?: ' + 
                                                        '$tempOrg' + '<br>' + 'What?: ' + '$tempName' + '<br>' + 'Details: ' +
                                                        '$tempDesc' +  '<br>' + 'Where?: ' + '$tempAddr' + '<br>' + 
                                                        'From: ' +  '$tempInit_date' + ' ' + '$tempInit_time' + '<br>' +
                                                        'to: ' + '$tempEnd_date' + ' ' + '$tempEnd_time' + '<br>');

                                            $('#Future_TextArea').append('<br><br>=====================================================<br><br>');
        
                                        });

                                        </script>";
                        //print in current event box
                        }elseif(strtotime($_eventInit)<time() and strtotime($_eventEnd)>time()){

                                echo "<script>

                                         $(document).ready(function(){
                                            $('#Current_TextArea').append('Who?: ' + 
                                                        '$tempOrg' + '<br>' + 'What?: ' + '$tempName' + '<br>' + 'Details: ' +
                                                        '$tempDesc' +  '<br>' + 'Where?: ' + '$tempAddr' + '<br>' + 
                                                        'From: ' +  '$tempInit_date' + ' ' + '$tempInit_time' + '<br>' +
                                                        'to: ' + '$tempEnd_date' + ' ' + '$tempEnd_time' + '<br>');

                                            $('#Current_TextArea').append('<br><br>=====================================================<br><br>');
        
                                        });

                                        </script>";

                        }elseif(strtotime($_eventEnd) < time()){
                            //destroy the event because it already happened
                            $sql_delete = "DELETE From Eventtable WHERE End_Time = '$tempEnd_time'"; 
                            mysqli_query($conn, $sql_delete);
                        }
                }
            }
            //close connection 
            mysqli_close($conn);

        ?>

        <h3 style='text-align: center;'>Event Finder: </h3>
            <table style= "width = 100%; align-items: center;">
                <tr>
                    <td><div  id='Current_TextArea' style='margin: auto,0; text-align: center; border-color: yellowgreen;
                                   background: olive; border:1px solid #aaa; 
                                   width:500px; height:400px; overflow:auto;'>
                                   <h4>Current Events</h4>
                    </div></td>

                   <td><div  id='Future_TextArea' style='margin: auto,0; text-align: center; border-color: yellowgreen;
                                background: olive; border:1px solid #aaa; 
                                width:500px; height:400px; overflow:auto;'>
                                <h4>Future Events</h4>
                    </div></td>
                </tr>
            </table>

            <div id="buttonHolder">
                <input type="button" id="retButton" value="RETURN TO MAIN PAGE">
            </div>

    </body>
</html>