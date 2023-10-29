<?php

session_start();

const winningCombinations = [
    // Rows
    [0, 1, 2],
    [3, 4, 5],
    [6, 7, 8],

    // Columns
    [0, 3, 6],
    [1, 4, 7],
    [2, 5, 8],

    // Diagonals
    [0, 4, 8],
    [2, 4, 6]
];

// get board
$board = $_SESSION['board'];

//get player
$player = $_SESSION['player'];

// get coordinates
$cell = $_GET['cell'];

list($row, $col) = explode('.', $cell);

// if cell was empty - assign X or O and switch the turn
if ($board[$row][$col] === ' ') {
    $board[$row][$col] = $player;
    // get turn
    if($player == 'X') {
        $_SESSION['player'] = 'O';
    } elseif ($player == 'O') {
        $_SESSION['player'] = 'X';
    }
}

// join elements from boards arrays into one level array
// to match with winning combinations
$oneArray = [];
foreach($board as $row) {
    foreach($row as $col) {
        array_push($oneArray, $col);
    }
}

// match new array against winning combinations

foreach(winningCombinations as $combination) {
    if($oneArray[$combination[0]] == $oneArray[$combination[1]] 
    && $oneArray[$combination[1]] == $oneArray[$combination[2]]
    && $oneArray[$combination[0]] != ' ') {
        $_SESSION['win'] = [true, $player];
    }
}


echo ($row);
$_SESSION['board'] = $board;


// clean all session data
if(isset($_POST['clean'])) {
    session_unset();
}

header('Location: index.php');