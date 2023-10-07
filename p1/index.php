<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    $_SESSION["playerCards"] = '';
    $_SESSION["dealerCards"] = '';
}

// Start the session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// function to render players current conbination of cusrd on the deck
function playerDeck($playerCards, &$cards) {

    if(!$playerCards){
        $playerCards .= getOneCard($cards);
    }
    $playerCards .= getOneCard($cards);

    if(!$_SESSION['playerCards']){
        $_SESSION['playerCards'] = $playerCards;
    } else {
        $_SESSION['playerCards'] .= $playerCards;
    }

}

// function to render dealer current conbination of cusrd on the deck
function dealerDeck($dealerCards, &$cards) {

    //if this is begining of the game - add the first one 
    if (!$dealerCards){
        $dealerCards = '<img src="img/card_back.png" alt="">';
    }

    $dealerCards .= getOneCard($cards);

    $_SESSION["dealerCards"] .= $dealerCards;
}


//get top card from the cards stack
function getOneCard(&$cards) {

    $randCardName = array_pop($cards);
    $card = "<img src='img/cards/{$randCardName}' alt=''>";
    return $card;
}


//get list of cards from img/cards directory
// https://code.google.com/archive/p/vector-playing-cards/downloads
function getAllCards() {
    
    $cards = scandir("img/cards");
    // remove two first elements "." and ".." of folder hierarchy
    array_splice($cards, 0, 2);
    shuffle($cards);

    return $cards;
}


function hit (&$cards, $playerDeck) {
    $newCardName = getOneCard($cards);
    $_SESSION['playerCards'] .= $newCardName;
}

// playerDeck($playerCards, $_SESSION["cards"]);
// dealerDeck($dealerCards, $_SESSION["cards"]);
// hit($_SESSION["cards"], $_SESSION["playerCards"]);

if(array_key_exists('start', $_POST)) {

    $playerCards = '';
    $dealerCards = '';

    $_SESSION["cards"] = getAllCards();
    $_SESSION["playerCards"] = '';
    $_SESSION["dealerCards"] = '';

    // init player deck
    playerDeck($playerCards, $_SESSION["cards"]);
    //init dealer deck
    dealerDeck($dealerCards, $_SESSION["cards"]);
}

if(array_key_exists('hit', $_POST)) {
    hit($_SESSION["cards"], $_SESSION["playerCards"]);
}

if(array_key_exists('stay', $_POST)) {
    $newCardName = getOneCard($_SESSION["cards"]);
    $_SESSION['dealerCards'] .= $newCardName;
}

if(array_key_exists('reset', $_POST)) {
    if (session_status() === PHP_SESSION_ACTIVE) {
        session_destroy();
        $_SESSION["playerCards"] = '';
        $_SESSION["dealerCards"] = '';
     }
}


include 'index-view.php';