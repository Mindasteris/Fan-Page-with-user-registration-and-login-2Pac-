<?php
    require_once('inc/db.php');
    //$name = $_SESSION['login'];
?>

<?php if(!isset($_SESSION['login'])) {?>
    <header>
        <nav class="navbar navbar-expand-md shadow-sm">
            <a class="logo-link mx-5" href="./index.php"><h1 class="logo">Tupac <span>Shakur</span></h1></a>

            <!-- Mobile Button -->
            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Navbar -->
                <ul class="navbar-nav ms-auto menu">
                        <li><a class="nav-link" href="./index.php">Home</a></li>
                        <li><a class="nav-link" href="./story.php">Story</a></li>
                        <li><a class="nav-link" href="./music.php">Music</a></li>
                        <li><a class="nav-link" href="./community.php">Community</a></li>
                        <li><a class="nav-link" href="./contactus.php">Contact Us</a></li>
                </ul>
            </div>
        </nav>

                <div class="login">
                    <a href="login.php"><button>Login</button></a>
                    <a href="signup.php"><button>Sign Up</button></a>
                </div>
    </header>

    <?php } else {?>
    <header>
        <nav class="navbar navbar-expand-md shadow-sm">
            <a class="logo-link mx-5" href="./index.php"><h1 class="logo">Tupac <span>Shakur</span></h1></a>

            <!-- Mobile Button -->
            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Navbar -->
                <ul class="navbar-nav ms-auto menu">
                        <li><a href="./index.php">Home</a></li>
                        <li><a href="./story.php">Story</a></li>
                        <li><a href="./music.php">Music</a></li>
                        <li><a href="./community.php">Community</a></li>
                        <li><a href="./contactus.php">Contact Us</a></li>
                </ul>
            </div>
        </nav>

        <div class="logout">
            <?php echo "<h4> " . "" . $_SESSION['login'] . "</h4>"; ?>
            <a href="./logout.php"><button>Logout</button></a>
        </div>
    </header>
           
<?php } ?>