<html>
    <head>
        <title>Log In</title>

        <!--Ajax jquery-->>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        
        <!-- Main CSS -->
        <link rel="stylesheet" href="Main.css">
    </head>

    <body>

        <h3>Log In</h3>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
           <div id="MainForm"> 
            <p>User Name</p><input type="text" name="UserBox"></input>
            <p>Password</p><input type="password" name="PswdBox"></input><br><br>
            <input type="submit" id="enter_button"></input>
           </div> 
        </form>
        
        <?php

            if($_SERVER['REQUEST_METHOD']== "POST"){

                $eUID = $_REQUEST["UserBox"];
                $ePswd = $_REQUEST["PswdBox"];

                /****
                We open database to verify user is in database
                ****/
                $conn = mysqli_connect("localhost", "root", "", "UsersDataBase");

                //handle conncection errors
                if(!$conn){
                        echo "
                                <script>
                                    $(document).ready(function(){
                                        $('#TextArea').append('There is trouble with the connection');
                                    });
                                </script>
                         ";
                        }
                
                $sql = "SELECT UserName, PassWord FROM userstable";
                $result = mysqli_query($conn, $sql);
                
                //if not empty
                if($result->num_rows > 0){

                    //iterate throught size of database table
                    while($row = mysqli_fetch_assoc($result)){

                        //if there is a valid combination with database, then go to next screen 
                        if($eUID == $row['UserName'] and $ePswd == $row['PassWord']){

                            //close the connection first
                            mysqli_close($conn);

                            //go to the event creator window, since it is a valid user
                            echo "<script> window.open('CreateEvent.php' , '_self', false); </script>";
                            

                        }

                    }

                }

                //close the connection first
                mysqli_close($conn);

                //tell the user is not on file
                echo "Your username or password is incorrect!";


            }
 

        ?>

    </body>
</html>