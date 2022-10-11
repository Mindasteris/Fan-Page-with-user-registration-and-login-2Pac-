<?php
    require_once('inc/db.php');
    session_start();

    //EDIT comment id from URL $_GET
    $update_id = $_GET['update_id'];

    $updateName = "";
    $updateContent = "";

    // Error Alerts
    $errorMsg = "";
    $successMsg = "";

    // preg_match() pattern check for special symbols
    $pattern = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';

    if(isset($_POST['comment_update']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $updateName = $_POST['comment_name'];
        $updateContent = $_POST['comment_content'];

         // Validation
        // Empty Inputs
        if(empty($updateName) || empty($updateContent)) {
            $errorMsg = "<div class='bar error-w100'>All fields are required ! Please fill all fields.</div>";
        }
        // For 'Name' field not allow numbers and symbols
        else if(!preg_match("/^([^0-9]+)$/", $updateName) || preg_match($pattern, $updateName)) {
            $errorMsg = "<div class='bar error-w100'>'Name' field cannot contain any numbers or special symbols. Only letters allowed.</div>";
        }
        else {
            // Update data from DB
            $sql_update = "UPDATE feedback SET comment_name = ?, comment_content = ?, date = now() WHERE comment_id = ?";
            $stmt = $conn->prepare($sql_update);
            $stmt->bind_param("ssi", $updateName, $updateContent, $update_id);
            $stmt->execute();
            $result = $stmt->get_result();
            header("location: community.php");
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

        <div class="feedback">

            <h3>Update your comment:</h3>

            <form action="" method="POST">
                 <!-- PHP -->
                 <?php echo $errorMsg; echo $successMsg; ?>

                 <!-- GET id for content in input (value="") START PHP -->
                <?php
                    if(isset($_GET['update_id'])) {
                        $update_id = $_GET['update_id'];

                        $sql = "SELECT * FROM feedback WHERE comment_id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param('i', $update_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while($row = $result->fetch_assoc()) {
                            $uName = $row['comment_name'];
                            $uContent = $row['comment_content'];
                        }
                ?>

                <div class="all-inputs">
                        <label for="comment_name">Name:</label> <br>
                        <input type="text" name="comment_name" value="<?php echo $uName; ?>"> <br><br>

                        <label for="comment_content">Content:</label> <br>
                        <textarea name="comment_content" cols="38" rows="10"><?php echo $uContent; ?></textarea> <br><br>

                        <button class="btn-comment-post" type="submit" name="comment_update" value="comment_update">Update</button>
                </div>
            </form>
            <?php $stmt->close(); $conn->close(); } ?> <!-- END PHP -->
        </div>

    </div>

    <?php include ('inc/footer.php'); ?>

</body>
</html>