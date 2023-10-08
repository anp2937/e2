# Project 1
+ By: Andrii Poltoratskyi
+ URL: <http://p1.anphp.me/>

## Game planning

This game requires User interactions. Im using POST to submit information about user action. Since all variables data removed right after POST has been sent, I had to use $_SESSION global variable to preserve the game state between page reloads.

+ Create buttons to interact with the game deck.
+ Download card images from https://code.google.com/archive/p/vector-playing-cards/downloads
+ Create a function to parse list of images and create an array and shuffle it.
+ Create a function to get one cart at a time from the top (end) of card array.
+ Create a function to get each card value (2 - 11) parsing the name of the image.
+ Create a function to convert image name into the valid HTML image tag
+ Validate what button was click by checking button name in $_POST variable
+ Implement different logic for each button
  + Start:
    + clean previous sessions
    + initialize all sessions variables
    + build user and dealer decks (user gets two cards and dealer just one)
    + store card array to SESSION
    + calculate total cards value and store to to another session variable
  + Hit:
    + get one card from cards array stored in current session variable
    + display it on the Players deck. Add new card value to the Players total
    + Check if players total < 21
    + if Total = 21 show message "Blackjack"
    + if Total > 21 show message "Busted"
  + Stay:
    + Get one card from card array and display it to Dealer deck
    + Add card value to the Dealer total
    + repeat while Dealer total <=17
    + check Dealer total <= 21
    + check Dealer total < or == Player total
    + Show message who won


## Outside resources
+ Card images archive: <https://code.google.com/archive/p/vector-playing-cards/downloads>
+ Blackjack rules: <https://bicyclecards.com/how-to-play/blackjack>
+ PHP session manual I used : <https://www.php.net/manual/en/ref.session.php> 


## Notes for instructor
I know I should not implement user interactions but it was not possible to create this game without it.
This game is simplified version of Blackjack game and does not have some features like SPLIT or DOUBLE. Also I did not implement betting mechanism.
