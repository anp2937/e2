<?php

session_start();

// set win condition to false by default
if(!isset($_SESSION['win'])) {
    $_SESSION['win'][0] = false;
}


// if this is new game - $board should be an empty array.
if(!isset($_SESSION['board'])) {
    $board = [
        [' ', ' ', ' '],
        [' ', ' ', ' '],
        [' ', ' ', ' '],
    ];
// if game is in progress then take array with data from SESSION
} else {
    $board = $_SESSION['board'];
}

// define who plays "X" or "O"
if(!isset($_SESSION['player'])) {
    $player = "X";
    $_SESSION['player'] = $player;
} else {
    $player = $_SESSION['player'];
}

$_SESSION['board'] = $board;


require 'index-view.php';
