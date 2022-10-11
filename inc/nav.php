<?php
    require_once('inc/db.php');
    //$name = $_SESSION['login'];
?>

<?php if(!isset($_SESSION['login'])) {?>
    <header>
        <h1 class="logo">Tupac <span>Shakur</span></h1>
        <!-- "Hamburger menu" / "Bar icon" to toggle the navigation links -->
        <a href="javascript:void(0);" class="icon" onclick="hamburgerMenu()">
            <i class="fa fa-bars"></i></a>
            <nav>
                <ul class="menu" id="myLinks">
                    <li><a href="./index.php">Home</a></li>
                    <li><a href="./story.php">Story</a></li>
                    <li><a href="./music.php">Music</a></li>
                    <li><a href="./community.php">Community</a></li>
                    <li><a href="./contactus.php">Contact Us</a></li>
                </ul>
            </nav>
            <div class="login">
                <a href="login.php"><button>Login</button></a>
                <a href="signup.php"><button>Sign Up</button></a>
            </div>
    </header>

<?php } else {?>
    <header>
        <h1 class="logo">Tupac <span>Shakur</span></h1>
        <nav class="topnav">
            <ul class="menu" id="myLinks">
                    <li><a href="./index.php">Home</a></li>
                    <li><a href="./story.php">Story</a></li>
                    <li><a href="./music.php">Music</a></li>
                    <li><a href="./community.php">Community</a></li>
                    <li><a href="./contactus.php">Contact Us</a></li>
            </ul>
        </nav>
        <div class="logout">
            <?php echo "<h4> " . "" . $_SESSION['login'] . "</h4>"; ?>
            <a href="./logout.php"><button>Logout</button></a>
        </div>
    </header>
<?php } ?>

<script src="./script.js"></script>