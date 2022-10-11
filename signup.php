<?php
    require_once('inc/db.php');

    $registerName = "";
    $registerEmail = "";
    $registerPass1 = "";
    $registerPass2 = "";
    
    // Error Alerts
    $errorMsg = "";
    $successMsg = "";

    // preg_match() pattern check for special symbols
    $pattern = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';

    if(isset($_POST['signup']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $registerName = $conn->real_escape_string($_POST['name']);
        $registerEmail = $conn->real_escape_string($_POST['email']);
        $registerPass1 = $conn->real_escape_string($_POST['pass1']);
        $registerPass2 = $conn->real_escape_string($_POST['pass2']);

        $hash_password = password_hash($registerPass1, PASSWORD_DEFAULT);

        // Validation
        // Empty Inputs
        if(empty($registerName) || empty($registerEmail) || empty($registerPass1) || empty($registerPass2)) {
            $errorMsg = "<div class='bar error'>All fields are required ! Please fill all fields.</div>";
        }
        // For 'Name' field not allow numbers and symbols
        else if(!preg_match("/^([^0-9]+)$/", $registerName) || preg_match($pattern, $registerName)) {
            $errorMsg = "<div class='bar error'>'Name' field cannot contain any numbers or special symbols. Only letters allowed.</div>";
        }
        // Password check
        else if(strlen($registerPass1) < 8) {
            $errorMsg = "<div class='bar error'>Password is too short. Password must be 8 characters or longer.</div>";
        }
        else if($registerPass1 != $registerPass2) {
            $errorMsg = "<div class='bar error'>Passwords do not match! Please check it.</div>";
        }
        else {
            // Check if user exists
            $sql_exist = "SELECT email FROM users WHERE email = ?";
            $stmt = $conn->prepare($sql_exist);
            $stmt->bind_param("s", $registerEmail);
            $stmt->execute();
            $stmt->bind_result($user_exists);
            $stmt->fetch();

            $stmt->close();

            if($user_exists) {
                $errorMsg = "<div class='bar error'>User with this Email Address already exist.</div>";
            }
            // Add user to database
            else {
                $sql = "INSERT INTO users(name, email, password)
                VALUES(?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $registerName, $registerEmail, $hash_password);
                $stmt->execute();

                $stmt->close();
                $conn->close();

                $successMsg = "<div class='bar success'>You have successfully Registered. You can now Login.</div>";
            }
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

    <div class="container bg-pac-signup">

        <h1 class="heading-1">Create a New User</h1>

        <div class="main">
            <form action="./signup.php" method="POST" enctype="multipart/form-data">
                <div class="all-inputs">
                    <!-- PHP -->
                    <?php echo $errorMsg; echo $successMsg; ?>
                    <div>
                        <label for="name"><i class="bi bi-person-plus-fill"></i> &nbsp;Name:</label> <br>
                        <input type="text" name="name" placeholder="Please Enter Your Name" autocomplete="off">
                    </div>
                    <br>
                    <div>
                    <label for="email"><i class="bi bi-envelope-fill"></i> &nbsp;E-Mail:</label> <br>
                    <input type="email" name="email" placeholder="Please Enter Your Email" autocomplete="off">
                    </div>
                    <br>
                    <div>
                    <label for="pass1"><i class="bi bi-key"></i> &nbsp;Password:</label> <br>
                    <input type="password" name="pass1" placeholder="Please Enter Your Password">
                    </div>
                    <br>
                    <div>
                    <label for="pass2"><i class="bi bi-key"></i> &nbsp;Confirm Password:</label> <br>
                    <input type="password" name="pass2" placeholder="Please Confirm Your Password">
                    </div>

                    <!-- <input class="btn-login" type="submit" name="signup" value="Sign Up"> -->
                    <button class="btn-login" type="submit" name="signup" value="Signup">Sign Up</button>
                </div>
                <a class="login-link" href="./login.php">Already have an account? PLease Login.</a>
            </form>
        </div>
    </div>

    <?php include ('inc/footer.php'); ?>

</body>
</html>