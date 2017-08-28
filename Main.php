<html>
    <head>
        <title>Find me Events</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="Main.css">
        <script>

            $(document).ready(function(){

                $("#registerButton").click(function(){

                    window.open ('LogIn.php','_self',false);

                });

                $("#lookButton").click(function(){

                    window.open ('LookEvent.php','_self',false);
                    
                });  

            });

        </script>
    </head>
    <?php 
        date_default_timezone_set("America/Mexico_City");
        //echo "The time is: " . strtotime(date("h:i:sa"));
        //echo "The date is: " . date("m/d/Y");
        //echo "    ";
        //echo time();
        //echo strtotime(date("m/d/Y"));
        //echo strtotime(date("m/d/Y"));
    ?>
    <body>
        <h1>I want to:</h1>
        <div id='buttonHolder'>
        <input type="button" value="Register an Event!" id="registerButton" class='button_'>
        <input type="button" value="Look for an Event!" id="lookButton" class='button_'>
        </div>
    </body>
</html>