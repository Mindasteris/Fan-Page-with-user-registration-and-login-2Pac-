<?php
    require_once('inc/db.php');
    session_start();

    $contactName = "";
    $contactEmail = "";
    $contactTitle = "";
    $contactContent = "";

    // Error Alerts
    $errorMsg = "";
    $successMsg = "";

    // preg_match() pattern check for special symbols
    $pattern = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';

    if(isset($_POST['contact_send']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $contactName = $conn->real_escape_string($_POST['contact_name']);
        $contactEmail = $conn->real_escape_string($_POST['contact_email']);
        $contactTitle = $conn->real_escape_string($_POST['contact_title']);
        $contactContent = $_POST['contact_content'];

        // Validation
        // Empty Inputs
        if(empty($contactName) || empty($contactEmail) || empty($contactTitle) || empty($contactContent)) {
            $errorMsg = "<div class='bar error'>All fields are required ! Please fill all fields.</div>";
        }
        // For 'Name' field not allow numbers and symbols
        else if(!preg_match("/^([^0-9]+)$/", $contactName) || preg_match($pattern, $contactName)) {
            $errorMsg = "<div class='bar error'>'Name' field cannot contain any numbers or special symbols. Only letters allowed.</div>";
        }
        else {
            $sql = "INSERT INTO contact(contact_name, contact_email, contact_title, contact_content)
            VALUES(?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $contactName, $contactEmail, $contactTitle, $contactContent);
            $stmt->execute();
            
            $stmt->close();
            $conn->close();

            $successMsg = "<div class='bar success'>The message successfully sent. Thank You !</div>";
        } 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Mindaugas Šunokas">
    <meta name="description" content="This is fan page about legendary Hip Hop artist- Tupac Amaru Shakur">
    <meta name="keywords" content="Hip Hop, 2Pac, Tupac, Amaru, Shakur, HTML, CSS">
    <!-- Style CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- Tab Icon -->
    <link rel="icon" href="images/tab_icon.png">
    <!-- BS Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- Font Awesome for (Hamburger Menu) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title>Home</title>
</head>
<body>

    <?php include ('inc/nav.php'); ?>

    <div class="container">

        <h1 class="heading-1">Contact Us</h1>

        <div class="main">
                <form action="" method="POST">
                    <div class="all-inputs">
                    <!-- PHP -->
                    <?php echo $errorMsg; echo $successMsg; ?>
                        <div>
                            <label for="contact_name">Name:</label> &nbsp;
                            <input type="text" name="contact_name" placeholder="Please Enter Your Name">
                        </div>
                        <br>
                        <div>
                            <label for="contact_email">Email:</label> &nbsp;
                            <input type="email" name="contact_email" placeholder="Please Enter Your Email">
                        </div>
                        <br>
                        <div>
                            <label for="contact_title">Title:</label> &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="text" name="contact_title" placeholder="Please Enter Title or Subject">
                        </div>
                        <br>
                        <div>
                            <label for="contact_content">Your Message:</label> <br>
                            <textarea name="contact_content" cols="40" rows="10" placeholder="Your Message"></textarea>
                        </div>

                        <button class="btn-login" type="submit" name="contact_send" value="contact_send">Send</button>
                    </div>
                </form>
        </div>

    </div>

    <?php include ('inc/footer.php'); ?>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>