<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Record Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        body {
         
            background-image: linear-gradient(to top, #30cfd0 0%, #330867 100%);/* Pastel background color */
            padding: 20px;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 1000px;
        }

        .dashboard-card {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #fff;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1>Student Record Application</h1>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-success"><a href="add.php" class="text-light">Add New</a></button>

                        <br/>
                        <br/>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Mobile</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $connection = mysqli_connect("localhost", "root", "");
                                $db = mysqli_select_db($connection, "dbcrud");
                                $sql = "SELECT * FROM student";
                                $run = mysqli_query($connection, $sql);
                                $id = 1;

                                while ($row = mysqli_fetch_array($run)) {
                                    $uid = $row['id'];
                                    $name = $row['Name'];
                                    $address = $row['Address'];
                                    $mobile = $row['Mobile'];
                                ?>
                                    <tr>
                                        <td><?php echo $id ?></td>
                                        <td><?php echo $name ?></td>
                                        <td><?php echo $address ?></td>
                                        <td><?php echo $mobile ?></td>
                                        <td>
                                            <button class="btn btn-success"><a href='edit.php?edit=<?php echo $uid ?>' class="text-light">Edit</a></button>
                                            <button class="btn btn-danger"><a href='delete.php?del=<?php echo $uid ?>' class="text-light">Delete</a></button>
                                        </td>
                                    </tr>
                                <?php $id++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="notification" style="position: fixed; bottom: 20px; right: 20px; background-color: #fff; padding: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
    <span id="notification-text"></span>
</div>

    <?php


    // Check if the user is logged in, otherwise redirect to the login page
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }

    // Retrieve the user ID from the session
    $userID = $_SESSION['user_id'];

    // Connect to the database (Update with your database credentials)
    $conn = new mysqli('localhost', 'root', '', 'dbcrud');

    // Check for connection errors
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Prepare the SQL statement to fetch user information
    $stmt = $conn->prepare("SELECT username FROM users WHERE id = ?");
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $stmt->bind_result($username);
    $stmt->fetch();
    $stmt->close();
    $conn->close();
    ?>

    <div class="dashboard-card">
        <h5>Welcome, <?php echo $username; ?>!</h5>
        
        <button class="btn btn-primary btn-sm"><a href='logout.php' class="text-light">Logout</a></button>
    </div>
    <div class="dashboard-card">
    <h5>Welcome, <?php echo $username; ?>!</h5>
    <button class="btn btn-primary btn-sm"><a href='logout.php' class="text-light">Logout</a></button>
</div>
<script>
    // Display the notification message
    var notification = document.getElementById('notification-text');
    notification.textContent = 'Login Successfull: <?php echo $username; ?>';
</script>

</body>
</html>
