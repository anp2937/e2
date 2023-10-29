<?php

session_start();

// check win condition
if (isset($_SESSION['win'][0])) {
    $win = true;
    $winner = $_SESSION['win'][1];
} else {
    $win = false;
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
} else {
    $player = $_SESSION['player'];
}

//reset SESSION data on page reload
$_SESSION['board'] = null;
$_SESSION['win'] = null;
$_SESSION['player'] = null;


require 'index-view.php';
