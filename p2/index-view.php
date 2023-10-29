<!doctype html>
<html lang='en'>

<head>
    <title>TicTacToe</title>
    <meta charset='utf-8'>
    <style>
        h1 {
            text-align: center;
            margin-bottom: 100px;
        }
        table {
            border-collapse: collapse;
            margin-left: 50px;
            margin-top: 50px;
            margin: 0 auto;
            left: 50%;
        }
        table, td {
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
    </style>
</head>
<body>
<h1>Tic-Tac-Toe Game</h1>

<?php
// win message:
if($_SESSION['win'][0]) {
    echo '<div class="message">'.$_SESSION['win'][1]." - WINs".'</div>';
    echo '</br>';
    echo '</br>';
    echo '<form method="POST" action="process.php">';
    echo '<button type="submit" class="clean" name="clean" value="clean">Restart</button>';
}

// Display game board
echo '<form method="GET" action="process.php">';
echo '<table>';
for ($i = 0; $i < 3; $i++) {
    echo '<tr>';
    for ($j = 0; $j < 3; $j++) {
        echo '<td><button type="submit" name="cell" value="' . $i .'.'. $j . '" ' .
        ($_SESSION['win'][0] ? 'disabled' : '') .
        '>' .
        $board[$i][$j] .
        '</button>
        <input type="hidden" name="restart" value="'.$restart.'">
        </td>';
    }
    echo '</tr>';
}
echo '</table>';
echo '</form>';

?>
</br>
</br>
<h3> Next move: <?=$player ?></h3>
</body>
</html>
