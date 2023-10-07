</html><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Black Jack GAME</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
    <h1>Black Jack GAME</h1>
    <div class="row">
        <div class="column">
            <div class="player">
                <?php 
                    if (isset($_SESSION["playerCards"])) {
                        echo $_SESSION["playerCards"];
                    }
                ?>
            </div>
        </div>
        <div class="column">
            <div class="dealer">
                <?php 
                    if (isset($_SESSION["dealerCards"])) {
                        echo $_SESSION["dealerCards"];
                    }
                ?>
            </div>
        </div>
    </div>
    </main>

<br><br>
    <footer>
        <div class="footer-content">
            <form method="post" id="buttons">
                <button type="submit" name="start">Start the Game</button>
                <button type="submit" name="hit">Hit</button>
                <button type="submit" name="stay">Stay</button>
                <button type="submit" name="reset">Reset</button>
            </form>
        </div>
        
    </footer> 
    
</body>

</html>