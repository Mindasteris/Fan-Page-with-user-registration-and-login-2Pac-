<?php
    require_once('inc/db.php');
    session_start();

    $commentName = "";
    $commentContent = "";
    $comment_result = "";

    // Error Alerts
    $errorMsg = "";
    $successMsg = "";

    // preg_match() pattern check for special symbols
    $pattern = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';

    if(isset($_POST['comment_send']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $commentName = $_POST['comment_name'];
        $commentContent = $_POST['comment_content'];

         // Validation
        // Empty Inputs
        if(empty($commentName) || empty($commentContent)) {
            $errorMsg = "<div class='bar error-w100'>All fields are required ! Please fill all fields.</div>";
        }
        // For 'Name' field not allow numbers and symbols
        else if(!preg_match("/^([^0-9]+)$/", $commentName) || preg_match($pattern, $commentName)) {
            $errorMsg = "<div class='bar error-w100'>'Name' field cannot contain any numbers or special symbols. Only letters allowed.</div>";
        }
        else {
            // Insert data to DB
            $sql = "INSERT INTO feedback(comment_name, comment_content, date)
            VALUES(?, ?, now())";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $commentName, $commentContent);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();

            $successMsg = "<div class='bar success-w100'>Comment was successfully added.</div>";

            // OOP method do not work !!!!!!!!!!!!!!!!!!!!!!!! Neveikia - Fatal error: Call to a member function fetch_assoc() on string
             // Show data from DB
            //  $sql_select_comment = "SELECT * FROM feedback";
            //  $stmt->prepare($sql_select_comment);
            //  $stmt->bind_param("ss", $commentName, $commentContent);
            //  $stmt->execute();
            //  $comment_result = $stmt->get_result();
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

        <h1 class="heading-1">Comments</h1>

        <div class="feedback">

            <h3 class="text-center">Leave a comment :</h3>

            <form action="" method="POST">
                 <!-- PHP -->
                 <?php echo $errorMsg; echo $successMsg; ?>
                <div class="all-inputs">
                        <label for="comment_name">Name:</label> <br>
                        <input type="text" name="comment_name" placeholder="Please Enter Your Name"> <br><br>

                        <label for="comment_content">Content:</label> <br>
                        <textarea name="comment_content" cols="38" rows="10" placeholder="Your Message"></textarea> <br><br>

                        <button class="btn-comment-post" type="submit" name="comment_send" value="comment_send">Post</button>
                </div>
            </form>
        </div>

        <h1 class="heading-1">Feedback</h1> <br> <hr>

        <div class="all-comments">
            <!-- PHP SQL -->
            <?php
                // Show data from DB (EDIT and DELETE)
                $sql_select_comment = "SELECT * FROM feedback";
                $comment_result = $conn->query($sql_select_comment);
                    
                    while($row = $comment_result->fetch_assoc()) {
                        $id = $row['comment_id'];
                        $name = $row['comment_name'];
                        $message = $row['comment_content'];
                        $date = $row['date'];
                        
                        echo "<div class='show-post'>";
                        echo "<h4>" . $name . "</h4>" . "<br>";
                        echo "<p>" . $message . "</p>" . "<br>";
                        echo "<h6> Post Date: &nbsp;" . $date . "</h6>";
                        echo "<br>";
                        echo "<a class='edit-link' href='update.php?update_id=$id'>Edit</a>&nbsp";
                        echo "<a class='delete-link' href='?delete_id=$id'>Delete</a></td>'";
                        echo "<hr><hr>";
                        echo "</div>";
                    }
                    // OOP method do not work !!!!!!!!!!!!!!!!!!!!!!!!
                    // $stmt->close();
                    // $conn->close();

                    // Delete post
                    if(isset($_GET['delete_id'])) {
                        $delete_id = $_GET['delete_id'];
                        $sql_delete = "DELETE FROM feedback WHERE comment_id = $delete_id";
                        $delete_result = $conn->query($sql_delete);
                        header("location: community.php");
                        $conn->close();
                    }
            ?>
            
        </div>

    </div>

    <?php include ('inc/footer.php'); ?>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>