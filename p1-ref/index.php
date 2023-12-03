<?php

// Start the session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// set default button visibility status to active
$class = "";
// declare notification message variable
$notificationMessage = "";

// start the game is Start button was clicked
if(array_key_exists('start', $_POST)) {

    // reset all variables and SESSION
    session_unset();
    $playerCards = [];
    $dealerCards = [];

    $_SESSION["cards"] = getAllCards();
    $_SESSION["playerCards"] = [];
    $_SESSION["dealerCards"] = [];
    $_SESSION['player'] = 0;
    $_SESSION['dealer'] = 0;

    // init player deck
    playerDeck($playerCards, $_SESSION["cards"]);
    //init dealer deck
    dealerDeck($_SESSION["cards"]);
}

// add card to Players deck if HIT button was clicked
if(array_key_exists('hit', $_POST)) {
    if (isset($_SESSION["cards"])){
        hit($_SESSION["cards"], $class, $notificationMessage);
    } else {
        $notificationMessage = "Game not started. Click START to start the game";
    }
}

// add cards to dealer untill the score total equal or more that 17
if(array_key_exists('stay', $_POST)) {
    //add more cards untill condition met
    if (isset($_SESSION["cards"])){
        while ($_SESSION['dealer'] <= 17) {
            $newCard = getOneCard($_SESSION["cards"]);
            array_push ($_SESSION['dealerCards'], $newCard);
            $_SESSION['dealer'] += cardValue($newCard);
        } 
        if ($_SESSION['dealer'] > 21 || $_SESSION['dealer'] < $_SESSION['player']) {
            $notificationMessage = "You win";
            $class = "disabled";
        }
        elseif ($_SESSION['dealer'] <=21 && $_SESSION['dealer'] > $_SESSION['player']) {
            $notificationMessage = "Dealer Wins";
            $class = "disabled";
        }
        elseif ($_SESSION['dealer'] == $_SESSION['player']) {
            $notificationMessage = "Draw";
            $class = "disabled";
        }
    } else {
        $notificationMessage = "Game not started. Click START to start the game";
    }
}

// function to render players current conbination of cards on the deck
function playerDeck($playerCards, &$cards) {

    if(!$playerCards){
        array_push($playerCards, getOneCard($cards));
    }
    array_push($playerCards, getOneCard($cards));

    foreach($playerCards as $card){
        array_push($_SESSION['playerCards'], $card);
        $_SESSION['player'] += cardValue($card);
    }
}

//transform array of Player cards stored in session into string to render on page.
// input parameter is $SESSION['playerDeck']
function renderPlayerDeck($cards) {
    $playerDeck = '';
    foreach($cards as $card) {
        $playerDeck .= renderCard($card);
    }
    return $playerDeck;
}

//return number (card value)
function cardValue($card) {
    $value = strtok($card, '_');
    switch ($value) {
        case "ace":
          return 11;
        case "jack":
          return 10;
        case "queen":
            return 10;
        case "king":
            return 10;    
        default:
          return intval($value);
      }
}

// function to collect dealer current combination of cards and store to session
function dealerDeck(&$cards) {
    $_SESSION["dealerCards"] = [];

    $card = getOneCard($cards);
    array_push($_SESSION["dealerCards"],$card);
    // count first card
    $_SESSION['dealer'] = cardValue($card);
}

// return string of dealer card combination.
function renderDealerDeck($cards) {
    $dealerDeck = '';
    foreach($cards as $card){
        $dealerDeck .= renderCard($card);
    }
    return $dealerDeck;
}

//get top card from the cards stack
function getOneCard(&$cards) {

    $randCardName = array_pop($cards);
    return $randCardName;
}

//convert cart to html image
function renderCard($card) {
    return "<img src='img/cards/{$card}' alt=''>";
}

// get list of cards from img/cards directory
// https://code.google.com/archive/p/vector-playing-cards/downloads
function getAllCards() {
    
    $cards = scandir("img/cards");
    // remove two first elements "." and ".." of folder hierarchy
    array_splice($cards, 0, 2);
    shuffle($cards);

    return $cards;
}

function hit (&$cards, &$class, &$notificationMessage) {
    $newCardName = getOneCard($cards);
    array_push($_SESSION['playerCards'], $newCardName);

    // add function that will check card value and add it to the Total
    $_SESSION['player'] += cardValue($newCardName);
        // check that Total <= 21 and save it to $SESSION['total'].
    if ($_SESSION['player'] > 21) {
        $notificationMessage = "Busted";
        $class = "disabled";
    } elseif($_SESSION['player'] == 21) {
        $notificationMessage = "BlackJack!";
        $class = "disabled";
    }
}

include 'index-view.php';