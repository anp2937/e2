<!doctype html>
<html lang='en'>

<head>
    <title>TicTacToe</title>
    <meta charset='utf-8'>
    <style>
    h1 {
        text-align: center;
        margin-bottom: 50px;
    }

    table {
        border-collapse: collapse;
        margin-left: 50px;
        margin-top: 50px;
        margin: 0 auto;
        left: 50%;
    }

    table,
    td {
        border: 2px solid black;
    }

    td {
        width: 50px;
        height: 50px;
        text-align: center;
        font-size: 24px;
    }

    input {
        width: 100%;
        height: 100%;
        text-align: center;
        font-size: 24px;
        border: none;
        background: none;
    }

    button {
        width: 100%;
        height: 100%;
    }

    button.clean {
        width: 10%;
        height: 5%;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
    }

    .message {
        background-color: #4CAF50;
        color: white;
        padding: 10px;
        text-align: center;
        font-size: 18px;
    }

    h3 {
        color: grey;
        margin-top: 100px;
        text-align: center;
    }

    .frame {
        margin: 0 auto;
        margin-bottom: 50px;
        border: 2px solid #000;
        padding: 20px;
        width: 40%;
    }
    </style>
</head>

<body>
    <h1>Tic-Tac-Toe Game</h1>
    <fieldset class="frame">
        <legend>Game Rules</legend>
        <p>
            - The game is played on a grid that's 3 squares by 3 squares.<br>
            - You are X, your friend is O. Players take turns putting their marks in empty squares.<br>
            - The first player to get 3 of her marks in a row (up, down, across, or diagonally) is the winner.<br>
        </p>
    </fieldset>
    <?php
// Display win message:
if($win) {
    echo '<div class="message">'.$winner." - WINs".'</div>';
    echo '</br>';
    echo '</br>';
}
?>
    <!-- Display game board -->
    <form method="POST" action="process.php">
        <table>
            <?php for ($i = 0; $i < 3; $i++): ?>
            <tr>
                <?php for ($j = 0; $j < 3; $j++): ?>
                <td>
                    <button type="submit" name="cell" value="<?= $i . '.' . $j ?>" <?= $win ? 'disabled' : '' ?>>
                        <?= $board[$i][$j] ?>
                    </button>
                </td>
                <?php endfor; ?>
            </tr>
            <?php endfor; ?>
        </table>

        <!-- Hidden input fields -->
        <input type="hidden" name="board" value='<?= json_encode($board) ?>'>
        <input type="hidden" name="player" value='<?= $player ?>'>

        <br>
        <br>

        <!-- Restart button -->
        <?php if ($win): ?>
        <button type="submit" class="clean" name="clean" value="clean">Restart</button>
        <?php endif; ?>
    </form>

    ?>
    </br>
    </br>
    <h3> Next move: <?=$player ?></h3>
</body>

</html>