<?php
    $host_name  = "db645677917.db.1and1.com";
    $database   = "db645677917";
    $user_name  = "dbo645677917";
    $password   = "Anabelsuz83!";

    
    $connect = mysqli_connect($host_name, $user_name, $password, $database);
    
    if(mysqli_connect_errno())
    {
      die("'Connection Failed!'.mysqli_connect_error().");
    }

    if (array_key_exists('email', $_POST) OR array_key_exists('password', $_POST)) {
        
        $query = "SELECT `id` FROM `users` WHERE email = '".mysqli_real_escape_string($connect, $_POST['email'])."'";
        $result = mysqli_query($connect,$query);

        if (mysqli_num_rows($result) > 0) {
            echo "That email has already been taken!";
        } else {
            $query = "INSERT INTO `users` (`email`,`password`) VALUES('".mysqli_real_escape_string($connect, $_POST['email'])."', '".mysqli_real_escape_string($connect, $_POST['password'])."')";

            if(mysqli_query($connect,$query)) {
                echo "Thanks For Registering!";
            } else {
                echo "Please Try Again!";
            }
            
        }

    }
    
  

    //Add new query
    //$query = "INSERT INTO `users` (`email`, `password`) VALUES('anabelelise@gmail.com','ilovemydad')";

    //Update query
    //$query = "UPDATE `users` SET password = '6ER23IO' WHERE email = 'anotherEmail83@gmail.com' LIMIT 1";

    
?>

<!DOCTYPE html>
<html>
<head>
    <title>Test Database</title>
</head>
<body>
<form method="post">
<h3>Email: <input name="email" type="text" placeholder="Enter Email" required></h3>
<h3>Password: <input name="password" type="password" placeholder="Enter Password" required></h3>
<input type="submit" name="Submit">
</form>
</body>
</html>