<?php

session_start();

$answer = $_POST['answer'];

$haveAnswer = true;

if ($answer == '') {
    $haveAnswer = false;
} elseif ($answer == $_SESSION['guess']) {
    $correct = true;
    unset($_SESSION['guess']);
} else {
    $correct = false;
    $_SESSION['newWord'] = false;
}

$_SESSION['results'] = [
    'haveAnswer' => $haveAnswer,
    'correct' => $correct
];

header('Location: index.php');
