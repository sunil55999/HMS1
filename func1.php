<?php
session_start();

// Secure database connection using environment variables
$host = getenv('DB_HOST') ?: 'trolley.proxy.rlwy.net';
$user = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS') ?: 'bHfEAViCgGwleFihLjvuCIpZYUFseDTx';
$database = getenv('DB_NAME') ?: 'railway';
$port = getenv('DB_PORT') ?: 16391;

// Establish connection
$con = mysqli_connect($host, $user, $password, $database, $port);

// Check connection
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Doctor Login
if (isset($_POST['docsub1'])) {
    $dname = $_POST['username3'];
    $dpass = $_POST['password3'];
    $query = "SELECT * FROM doctb WHERE username='$dname' AND password='$dpass';";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $_SESSION['dname'] = $row['username'];
        }
        header("Location: doctor-panel.php");
    } else {
        echo "<script>alert('Invalid Username or Password. Try Again!');
              window.location.href = 'index.php';</script>";
    }
}

// Display doctors in dropdown
function display_docs()
{
    global $con;
    $query = "SELECT * FROM doctb";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
        $name = $row['name'];
        echo '<option value="' . $name . '">' . $name . '</option>';
    }
}

// Display Admin Panel UI
function display_admin_panel()
{
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
            <a class="navbar-brand" href="#">Global Hospital</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
                <form class="form-inline my-2 my-lg-0" method="post" action="search.php">
                    <input class="form-control mr-sm-2" type="text" placeholder="Enter Contact" name="contact">
                    <input type="submit" class="btn btn-outline-light" name="search_submit" value="Search">
                </form>
            </div>
        </nav>
    </head>
    <body style="padding-top:50px;">
        <div class="jumbotron"></div>
        <div class="container-fluid" style="margin-top:50px;">
            <div class="row">
                <div class="col-md-4">
                    <div class="list-group">
                        <a class="list-group-item list-group-item-action active">Appointment</a>
                        <a class="list-group-item list-group-item-action" href="patientdetails.php">Patient List</a>
                        <a class="list-group-item list-group-item-action">Payment Status</a>
                        <a class="list-group-item list-group-item-action">Prescription</a>
                        <a class="list-group-item list-group-item-action">Doctors Section</a>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <center><h4>Create an Appointment</h4></center><br>
                            <form class="form-group" method="post" action="appointment.php">
                                <label>First Name:</label>
                                <input type="text" class="form-control" name="fname"><br>
                                <label>Last Name:</label>
                                <input type="text" class="form-control" name="lname"><br>
                                <label>Email:</label>
                                <input type="text" class="form-control" name="email"><br>
                                <label>Contact:</label>
                                <input type="text" class="form-control" name="contact"><br>
                                <label>Doctor:</label>
                                <select name="doctor" class="form-control">';
                                    display_docs();
    echo                        '</select><br>
                                <label>Payment:</label>
                                <select name="payment" class="form-control">
                                    <option value="Paid">Paid</option>
                                    <option value="Pay later">Pay later</option>
                                </select><br>
                                <input type="submit" name="entry_submit" value="Create new entry" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    </body>
    </html>';
}
?>
