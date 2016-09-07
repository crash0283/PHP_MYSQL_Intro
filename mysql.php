<?php
    $host_name  = "db645906944.db.1and1.com";
    $database   = "db645906944";
    $user_name  = "dbo645906944";
    $password   = "Jbuffett83!";


    $connect = mysqli_connect($host_name, $user_name, $password, $database);
    $alert = '';
    $error = '';

    if(mysqli_connect_errno())
    {
      die("'Connection Failed!'.mysqli_connect_error().");
    }



    if (array_key_exists('arrive', $_POST) OR array_key_exists('depart', $_POST)) {

        if ($_POST['arrive'] == '' || $_POST['depart'] == '') {
            $error = "Please Choose Reservation Dates!";
        } else {




        $query = "SELECT `id` FROM `reserve` WHERE `checkOut` > date('".mysqli_escape_string($connect, $_POST['arrive'])."')";

        $result = mysqli_query($connect,$query);


        if (mysqli_num_rows($result) > 0) {
            $error = "That date has already been taken!";
        }

        else {

            $query = "INSERT INTO `reserve` (`checkIn`,`checkOut`) VALUES('".mysqli_real_escape_string($connect, $_POST['arrive'])."', '".mysqli_real_escape_string($connect, $_POST['depart'])."')";

            if(mysqli_query($connect,$query)) {
                $alert = "Thanks For Your Reservation!  We Hope You Enjoy Your Stay!";
            }

            else {
                $error =  "Please Try Again!";
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
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="datedropper.js"></script>
        <script type="text/javascript" src="flatpickr-gh-pages/dist/flatpickr.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="flatpickr-gh-pages/dist/flatpickr.material_blue.min.css">
        <link rel="stylesheet" type="text/css" href="datedropper.css">
        <link rel="stylesheet" type="text/css" href="mysql.css">
    </head>

    <body>
        <div class="container">
            <div class="row">
                <form class="form-inline" method="post">
                    <div class="form-group">
                        <div class="input-group">
                            <input class="form-control" id="arrive" name="arrive" type="text" placeholder="Arrive">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input class="form-control" id="depart" name="depart" type="text" placeholder="Depart">
                        </div>
                    </div>
                    <input class="btn btn-primary" type="submit" name="Search" value="Search Reservations">
                </form>
                <div class="output"><?php 
                    if($alert) {
                        echo '<div class="alert alert-success" role="alert">'.$alert.'</div>';
                    } 
                    else if($error) {
                        echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
                        }?>
                            
                </div>
            </div>
        </div>
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
