<html>
    <head>
        <title>Create an Event</title>
        <!-- ajax jquery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

        <!-- Jquery UI library -->
        <link rel="stylesheet" href="jquery-UI/jquery-ui-1.12.1.custom/jquery-ui.min.css">
        <script src="jquery-UI/jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
        <script src="jquery-UI/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>

        <!-- Jquery timepicker library -->
        <script src="jquery-UI/jquery-timepicker/jquery.timepicker.js"></script>
        <link rel="stylesheet" href="jquery-UI/jquery-timepicker/jquery.timepicker.css">
        <script src="jquery-UI/jquery-timepicker/jquery.timepicker.min.js"></script>

        <!-- Main CSS -->
        <link rel="stylesheet" href="Main.css">

        <script>

            var eOrg;
            var eName;
            var eDesc;
            var eAddr;
            var eInit;
            var eEnd;
            var eInit_Time;
            var eEnd_Time;

            $(document).ready(function(){

                $("#generateForm").click(function(){

                    eOrg = $("#eventOrg").val();
                    eName = $("#eventName").val();
                    eDesc = $("#eventDesc").val();
                    eAddr = $("#eventAddr").val();
                    eInit = $("#init_date").val();
                    eEnd = $("#ending_date").val();
                    eInit_Time = $("#init_time").val();
                    eEnd_Time = $("#end_time").val();

                    //Submit Event to the database will be handled in database-php, here we just generate the event inside the webpage
                    $("#eventData").append(eOrg + "<br>" + 
                                           eName + "<br>" +
                                           eDesc + "<br>" +
                                           eAddr + "<br>" + 
                                           "from: " + eInit + " " + eInit_Time + "<br>" +
                                           "to: " + eEnd + " " + eEnd_Time + "<br>");
                });

                $("submitForm").click(function(){


                    //("#eventData").text("Your event has been submitted");
                    window.open("thanksPage.php", "_self", false);

                }); 

                $(function(){
                    $("#init_date").datepicker();
                    $("#ending_date").datepicker();
                    $("#init_time").timepicker({ 'timeFormat': 'h:i A' });
                    $("#end_time").timepicker({ 'timeFormat': 'h:i A' });
                });            
            });

        </script>
    </head>
    <body>
        <div>
            <h1 id="Register"> Register an Event: </h1>
        </div>

        <div id="MainForm">
        
            <form method="post" action="thanksPage.php"> 

                <p>Organizer: </p> <input type="text" id="eventOrg" name="eventOrgBox"> 
                <p>Name of Event: </p> <input type="text" id="eventName" name="eventNameBox"> 
                <p>Description: </p><textarea type="text" id="eventDesc" name="eventDescBox" rows="4"></textarea><br>
                <div>
                    <p>Where?: </p><textarea type="text" id="eventAddr" name="eventAddrBox" rows="4"></textarea><br>
                    <p>When?: </p><p>Starting Date-Time: <input type="text" id="init_date" name="eventInitBox"></input> 
                       - <input type="text" id="init_time" name="eventInitTimeBox"></input></p> 
                       <p>Ending Date-Time: <input type="text" id="ending_date" name="eventEndBox"></input> - 
                       <input type="text" id="end_time" name="eventEndTimeBox"></input></p>
                </div>

                <input type="button" value="generate" id="generateForm">
                <input type="submit" value="submit" id="submitForm">

            </form>
        </div>

        <div>
            <p id="eventData"><p>

        </div>
        
        <?php

            if($_SERVER["REQUEST_METHOD"] == "POST"){

                //collect data
                $eOrg = $_REQUEST["eventOrgBox"];
                $eName = $_REQUEST["eventNameBox"];
                $eDesc = $_REQUEST["eventDescBox"];
                $eAddr = $_REQUEST["eventAddrBox"];
                $eInit = $_REQUEST["eventInitBox"];
                $eEnd = $_REQUEST["eventEndBox"];
                $eInit_Time = $_REQUEST["eventInitTimeBox"];
                $eEnd_Time = $_REQUEST["eventEndTimeBox"];

                //if empty fields
                if(empty($eOrg) || empty($eName) || empty($eDesc)){

                    echo "some fields are empty";

                }else{
                    echo $eOrg;
                    echo '<br>';
                    echo $eName;
                    echo '<br>';
                    echo $eDesc;
                    echo '<br>';
                    echo $eAddr;
                    echo '<br>';
                }
            }        

        ?>

    </body>
</html>