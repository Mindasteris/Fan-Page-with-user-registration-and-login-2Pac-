<?php
    session_start();
    require_once('inc/db.php');

    // Error Alerts
    $errorMsg = "";
    $successMsg = "";

    // Password compare with hash from DB
    $hashPassword = "";

    if(isset($_POST['login'])) {
        $loginEmail = $conn->real_escape_string($_POST['email']);
        $loginPassword = $conn->real_escape_string($_POST['pass1']);

        // Validation
        // Empty Inputs
        if(empty($loginEmail) || empty($loginPassword)) {
            $errorMsg = "<div class='bar error'>All fields are required ! Please fill all fields.</div>";
        }
        else {
            $sql = "SELECT * FROM users WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $loginEmail);
            $stmt->execute();
            $result = $stmt->get_result();

            while($row = $result->fetch_assoc()) {
                $name = $row['name'];
                $hashPassword = $row['password'];
            }

            if(password_verify($loginPassword, $hashPassword)) {
                $_SESSION['login'] = $name;
                header("Location index.php");
            }
            else {
                $errorMsg = "<div class='bar error'>Bad Credentials !</div>";
            }

            $stmt->close();
            $conn->close();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Style CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Tab Icon -->
    <link rel="icon" href="images/tab_icon.png">
    <!-- BS Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- Font Awesome for (Hamburger Menu) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title>Login</title>
</head>
<body>
    <?php include('inc/nav.php'); ?>

    <div class="container bg-pac-login">

        <h1 class="heading-1">Please Login</h1>

        <div class="main">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="all-inputs">
                    <!-- PHP -->
                    <?php echo $errorMsg; ?>
                    <div>
                        <label class="label" for="email"><i class="bi bi-envelope-fill"></i> &nbsp;Email:</label> <br>
                        <input type="email" name="email" placeholder="Please Enter Your Email" autocomplete="off">
                    </div>
                    <br>
                    <div>
                        <label class="label" for="pass1"><i class="bi bi-key"></i> &nbsp;Password:</label> <br>
                        <input type="password" name="pass1" placeholder="Please Enter Your Password">
                    </div>

                    <!-- <input class="btn-login" type="submit" name="login" value="Login"> -->
                    <button class="btn-login" type="submit" name="login" value="Login">Login</button>
                </div>
                <a class="login-link" href="./signup.php">Don't have an account? Please create a new user.</a>
            </form>
        </div>
    </div>

    <?php include ('inc/footer.php'); ?>

</body>
</html>