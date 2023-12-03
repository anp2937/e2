<?php

# Set up cards - • Use 10 • So you have an • even number of cards to distribute
$cards = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
shuffle($cards);
# Initialize empty arrays for playerCards and computerCards
$playerCards = [];
$computerCards = [];
#
#
#
# Your code to distribute the cards in an alternating fashion
# to playerCards and computerCards would go here

while(count($cards) > 0) {
    $playerCards[] = array_pop($cards);
    $computerCards[] = array_pop($cards);
}

function distribute1($cards) {
    return array_pop($cards);
}
function distribute2($cards) {
    return array_pop($cards);
}

while (count($cards)>0){
    $playerCards[] = distribute1($cards);
    $computerCards[] = distribute2($cards);
}

# Verify results var_dump ($playerCards) ; # Should yield 5 random cards
 var_dump ($computerCards); # Should yield 5 different random cards
 var_dump ($playerCards);