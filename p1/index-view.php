</html><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BlackJack GAME</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
    <h1>BlackJack GAME</h1>
    <div class="alert" style="opacity: <?php echo $notificationMessage ? 1:0;?>">
        <?= $notificationMessage;?>
    </div>
    <div class="row">
        <div class="column">
            <div class="player">
                <?php 
                    if (isset($_SESSION["playerCards"])) {
                        echo renderPlayerDeck($_SESSION["playerCards"]);
                    }
                ?>
            </div>
        </div>
        <div class="column">
            <div class="dealer">
                <?php 
                    if (isset($_SESSION["dealerCards"])) {
                        echo '<img src="img/card_back.png" alt="">'.renderDealerDeck($_SESSION["dealerCards"]);
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
                <button type="submit" name="start">Start</button>
                <button <?php echo $class ?> type="submit" name="hit">Hit</button>
                <button <?php echo $class ?> type="submit" name="stay">Stay</button>
            </form>
        </div>
        
    </footer> 
    
</body>

</html>