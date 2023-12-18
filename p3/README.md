# Project 3
+ By: Andrii Poltoratskyi
+ URL: <http://p3.anphp.me/>

## Game planning

This is a simple TicTacToe game built using e2framework. It has 3 views "index" - main gameplay,
"history" - page with the list of history records and "details" - where passed game details available.
I re-used some logic from P2 project but mostly it is a new code since I had to integrate it with database.

+ Create a table (board) by using *for* loop
+ Each cell contains a button
+ Post button coordinates $i and $j as a string (in the form)
+ Create DB *ttt*
+ Create migrate() function to generate 4 tables:
  - board
  - round
  - history
  - win_combinations
+ Seed *win_combination* table with winning combination prepared in json file.
+ To start the game - it requires you to enter X or O.It will have a e2framework validation
+ Implement a custom validation for this input field to limit the input options to X or O
+ Create a new record in tables *board* and *round* after Start button hit
+ Write to the *board* table information every time when user cick on board
+ Check current board state after each move and compare it to the wining combination 
+ When the game is over - create a record in *history* table.
+ Implement error handling.

## Installation

To install application - please run `php console App fresh`. It will generate tables and
seed the data to *win_combination* table.

## Outside resources
+ PHP forms documentation <https://www.w3schools.com/php>
+ CSS bootstrap <https://getbootstrap.com/docs/4.1/components>


## Notes for instructor
I noticed that public/css/app.css can't be read correctly by Safari browser. As a result - no styles work in Safari.
I fixed this by creating a different file "ttt.css" with the same content (after noticing we did same thing in zipfoods project).
Also the DB structure could be minimized to 1-3 tables, but I decided to create more tables to keep specific data in a specifically named table.
