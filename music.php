<?php
    session_start();
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
        
        <h1 class="heading-1">Discography</h1>
        <br>
        <blockquote>
            <q class="quote"><i> His music touched all hearts. His music changed the whole world. </i></q>
        </blockquote>
        

        <div class="main"> 
            <div class="wraps-albums" id="music">
                <figure>
                    <img src="albums/2Pacalypse Now.jpg" alt="2Pacalypse" title="2Pacalypse">
                    <figcaption>2Pacalypse Now</figcaption>
                </figure>

                <figure>
                    <img src="albums/Strictly 4 My N.I.G.G.A.Z..jpg" alt="Strictly 4" title="Strictly 4 My N.I.G.G.A.Z.">
                    <figcaption>Strictly 4 My N.I.G.G.A.Z.</figcaption>
                </figure>

                <figure>
                    <img src="albums/Me Against the World.jpg" alt="Me Against the World" title="Me Against the World">
                    <figcaption>Me Against the World</figcaption>
                </figure>

                <figure>
                    <img src="albums/All Eyez on Me.jpg" alt="All Eyez on Me" title="All Eyez on Me">
                    <figcaption>All Eyez on Me</figcaption>
                </figure>

                <figure>
                    <img src="albums/The Don Killuminati The 7 Day Theory.jpg" alt="The Don Killuminati" title="The Don Killuminati The 7 Day Theory">
                    <figcaption>The Don Killuminati: The 7 Day</figcaption>
                </figure>

                <figure>
                    <img src="albums/R U Still Down.jpg" alt="R U Still Down" title="R U Still Down">
                    <figcaption>R U Still Down? (Remember Me)</figcaption>
                </figure>

                <figure>
                    <img src="albums/Still I Rise.jpg" alt="Still I Rise" title="Still I Rise">
                    <figcaption>Still I Rise</figcaption>
                </figure>

                <figure>
                    <img src="albums/Until the End of Time.jpg" alt="Until the End of Time" title="Until the End of Time">
                    <figcaption>Until the End of Time</figcaption>
                </figure>

                <figure>
                    <img src="albums/Better Dayz.jpg" alt="Better Dayz" title="Better Dayz">
                    <figcaption>Better Dayz</figcaption>
                </figure>

                <figure>
                    <img src="albums/Loyal to the Game.jpg" alt="Loyal to the Game" title="Loyal to the Game">
                    <figcaption>Loyal to the Game</figcaption>
                </figure>

                <figure>
                    <img src="albums/Pac's Life.jpg" alt="Pac's Life" title="Pac's Life">
                    <figcaption>Pac's Life</figcaption>
                </figure>

                <figure>
                    <img src="albums/Tupac Resurrection.jpg" alt="Tupac Resurrection" title="Tupac Resurrection">
                    <figcaption>Tupac Resurrection</figcaption>
                </figure>
            </div>
                
        </div>
    </div>

    <?php include ('inc/footer.php'); ?>

</body>
</html>