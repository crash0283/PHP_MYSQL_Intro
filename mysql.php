<?php
    $host_name  = "db645906944.db.1and1.com";
    $database   = "db645906944";
    $user_name  = "dbo645906944";
    $password   = "Jbuffett83!";

    
    $connect = mysqli_connect($host_name, $user_name, $password, $database);
    
    if(mysqli_connect_errno())
    {
      die("'Connection Failed!'.mysqli_connect_error().");
    }

    

    if (array_key_exists('arrive', $_POST) OR array_key_exists('depart', $_POST)) {
        
        if ($_POST['arrive'] == '' || $_POST['depart'] == '') {
            echo "Please Choose Reservation Dates!";
        } else {
            

        

        $query = "SELECT `id` FROM `reserve` WHERE `checkOut` > date('".mysqli_escape_string($connect, $_POST['arrive'])."')";

        $result = mysqli_query($connect,$query);


        if (mysqli_num_rows($result) > 0) {
            echo "That date has already been taken!";
        } 

        else {

            $query = "INSERT INTO `reserve` (`checkIn`,`checkOut`) VALUES('".mysqli_real_escape_string($connect, $_POST['arrive'])."', '".mysqli_real_escape_string($connect, $_POST['depart'])."')";

            if(mysqli_query($connect,$query)) {
                echo "Thanks For Your Reservation!  We Hope You Enjoy Your Stay!";
            } 

            else {
                echo "Please Try Again!";
            }
            
        }
        }

    }
    
    
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Test Database</title>
        <script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="datedropper.js"></script>
        <script type="text/javascript" src="flatpickr-gh-pages/dist/flatpickr.min.js"></script>
        <link rel="stylesheet" type="text/css" href="flatpickr-gh-pages/dist/flatpickr.min.css">
        <link rel="stylesheet" type="text/css" href="datedropper.css">
    </head>

    <body>
        <form method="post">
            <input id="arrive" name="arrive" type="text" placeholder="Arrive" required>
            <input id="depart" name="depart" type="text" placeholder="Depart" required>
            <input type="submit" name="Search" value="Search">
        </form>
        <script type="text/javascript">
            var check_in = $("#arrive").flatpickr({
                altInput: true,
                altFormat: "Y-m-d",
                minDate: new Date()
            });

            var check_out = $("#depart").flatpickr({
                altInput: true,
                altFormat: "Y-m-d",
                minDate: new Date()
            });

            check_in.config.onChange = dateObj => check_out.set("minDate", dateObj.fp_incr(1));
            check_out.config.onChange = dateObj => check_in.set("maxDate", dateObj.fp_incr(-1));
        </script>
    </body>

    </html>