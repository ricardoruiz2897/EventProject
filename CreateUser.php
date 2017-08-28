<html>
    <head>
        <title>Create User: Admin Only</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    </head>
    <body>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <p>UserName: <input type="text" id="uid" name="cUserNameBox"></input></p>
        <p>Password: <input type="text" id="pswd" name="cUserPasswordBox"></input></p>
        <input type="submit"></input>
        </form>
    </body>
    <?php
        //this file helps the ADMIN create user names and pswds and push them to the users database
        if($_SERVER["REQUEST_METHOD"] == "POST"){

            //Edit for the desired user and password
            $newUser = $_REQUEST["cUserNameBox"];
            $newPswd = $_REQUEST["cUserPasswordBox"];

            //Create connection with database: EventDataBase
            $conn = mysqli_connect("localhost", "root", "", "usersdatabase");

            //sql command
            $sql = "INSERT INTO userstable(UserName, Password) VALUES('$newUser', '$newPswd');";

            //Check connection_status
            if(!$conn){

                die("Connection Failed: " . mysqli_connect_error());

            }

            if(mysqli_multi_query($conn, $sql)){

                echo "User was added correctly ";
                echo "Password was added correctly";
            
            }else{
                echo "Error: " . mysqli_error($conn);
            }

            //close connection 
            mysqli_close($conn);    

        }
    ?>
</html>