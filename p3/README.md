# Project 3
+ By: Andrii Poltoratskyi
+ URL: <http://p3.anphp.me/>

## Graduate requirement

+ [x] I have integrated testing into my application
+ [ ] I am taking this course for undergraduate credit and have opted out of integrating testing into my application

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
+ Validate user input for the first move. Use a e2framework validation.
+ Implement a custom validation for this input field to limit the input options to X or O
+ Create a new record in tables *board* and *round* after Start button hit
+ Store current boardId to Session to now if this is the same game or a new one
+ Write to the *board* table information every time when user cick on board, using ID stored in session.
+ Check current board state after each move and compare it to the wining combination 
+ When the game is over - create a record in *history* table.
+ Implement error handling.
+ Cover by Acceptance tests

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

## Codeception testing output

```
Codeception PHP Testing Framework v5.0.12 https://stand-with-ukraine.pp.ua

Tests.Acceptance Tests (16) ---------------------------------------------------------------------------------------------------------------------------------------------------------------
DrawCest: Draw
Signature: Tests\Acceptance\DrawCest:Draw
Test: tests/Acceptance/DrawCest.php:Draw
Scenario --
 I am on page "/"
 I fill field "[name=first-move]","X"
 I click "[name=game]"
 I see element "[name=board]"
 I click ".1_1"
 I see "X",".1_1"
 I don't see "[test=generalError]"
 I don't see "[test=error]"
 I click ".2_1"
 I click ".1_2"
 I click ".2_2"
 I click ".2_3"
 I click ".1_3"
 I click ".3_1"
 I click ".3_2"
 I click ".3_3"
 I see "Draw",".alert-info"
 I don't see "[test=generalError]"
 I don't see "[test=error]"
 PASSED 

HistoryCest: X win history
Signature: Tests\Acceptance\HistoryCest:XWinHistory
Test: tests/Acceptance/HistoryCest.php:XWinHistory
Scenario --
 I am on page "/"
 I fill field "[name=first-move]","X"
 I click "[name=game]"
 I click ".1_1"
 I click ".2_1"
 I click ".1_2"
 I click ".2_2"
 I click ".1_3"
 I see "X - WINs",".alert-info"
 I don't see "[test=generalError]"
 I don't see "[test=error]"
 I am on page "/history"
 I see "Winner- X","//div[1]/ul/li[1]/a"
 PASSED 

HistoryCest: O win history
Signature: Tests\Acceptance\HistoryCest:OWinHistory
Test: tests/Acceptance/HistoryCest.php:OWinHistory
Scenario --
 I am on page "/"
 I fill field "[name=first-move]","O"
 I click "[name=game]"
 I click ".1_1"
 I click ".2_1"
 I click ".1_2"
 I click ".2_2"
 I click ".1_3"
 I see "O - WINs",".alert-info"
 I don't see "[test=generalError]"
 I don't see "[test=error]"
 I am on page "/history"
 I see "Winner- O","//div[1]/ul/li[1]/a"
 PASSED 

HistoryCest: Draw history
Signature: Tests\Acceptance\HistoryCest:DrawHistory
Test: tests/Acceptance/HistoryCest.php:DrawHistory
Scenario --
 I am on page "/"
 I fill field "[name=first-move]","X"
 I click "[name=game]"
 I click ".1_1"
 I click ".2_1"
 I click ".1_2"
 I click ".2_2"
 I click ".2_3"
 I click ".1_3"
 I click ".3_1"
 I click ".3_2"
 I click ".3_3"
 I see "Draw",".alert-info"
 I don't see "[test=generalError]"
 I don't see "[test=error]"
 I am on page "/history"
 I see "Draw","//div[1]/ul/li[1]/a"
 PASSED 

HistoryCest: Redirect to game
Signature: Tests\Acceptance\HistoryCest:RedirectToGame
Test: tests/Acceptance/HistoryCest.php:RedirectToGame
Scenario --
 I am on page "/"
 I see link "Game History"
 I click "Game History"
 I see link "← Back to Game"
 I click "← Back to Game"
 I see link "Game History"
 PASSED 

HistoryDetailsCest: X win history details
Signature: Tests\Acceptance\HistoryDetailsCest:XWinHistoryDetails
Test: tests/Acceptance/HistoryDetailsCest.php:XWinHistoryDetails
Scenario --
 I am on page "/"
 I fill field "[name=first-move]","X"
 I click "[name=game]"
 I click ".1_1"
 I click ".2_1"
 I click ".1_2"
 I click ".2_2"
 I click ".1_3"
 I see "X - WINs",".alert-info"
 I don't see "[test=generalError]"
 I don't see "[test=error]"
 I am on page "/history"
 I see "Winner- X","//div[1]/ul/li[1]/a"
 I click "//div[1]/ul/li[1]/a"
 I see "Winner - X","//body/h3"
 I see "X",".1_1"
 I see "X",".1_2"
 I see "X",".1_3"
 I see "O",".2_1"
 I see "O",".2_2"
 I see "",".2_3"
 I see "",".3_1"
 I see "",".3_2"
 I see "",".3_3"
 PASSED 

HistoryDetailsCest: O win history details
Signature: Tests\Acceptance\HistoryDetailsCest:OWinHistoryDetails
Test: tests/Acceptance/HistoryDetailsCest.php:OWinHistoryDetails
Scenario --
 I am on page "/"
 I fill field "[name=first-move]","O"
 I click "[name=game]"
 I click ".1_1"
 I click ".2_1"
 I click ".1_2"
 I click ".2_2"
 I click ".1_3"
 I see "O - WINs",".alert-info"
 I don't see "[test=generalError]"
 I don't see "[test=error]"
 I am on page "/history"
 I see "Winner- O","//div[1]/ul/li[1]/a"
 I click "//div[1]/ul/li[1]/a"
 I see "Winner - O","//body/h3"
 I see "O",".1_1"
 I see "O",".1_2"
 I see "O",".1_3"
 I see "X",".2_1"
 I see "X",".2_2"
 I see "",".2_3"
 I see "",".3_1"
 I see "",".3_2"
 I see "",".3_3"
 PASSED 

HistoryDetailsCest: Draw history details
Signature: Tests\Acceptance\HistoryDetailsCest:DrawHistoryDetails
Test: tests/Acceptance/HistoryDetailsCest.php:DrawHistoryDetails
Scenario --
 I am on page "/"
 I fill field "[name=first-move]","X"
 I click "[name=game]"
 I click ".1_1"
 I click ".2_1"
 I click ".1_2"
 I click ".2_2"
 I click ".2_3"
 I click ".1_3"
 I click ".3_1"
 I click ".3_2"
 I click ".3_3"
 I don't see "[test=generalError]"
 I don't see "[test=error]"
 I am on page "/history"
 I see "Winner- Draw","//div[1]/ul/li[1]/a"
 I see link "← Back to Game"
 I click "//div[1]/ul/li[1]/a"
 I see "Winner - Draw","//body/h3"
 I see link "← Back to Game History"
 I see "X",".1_1"
 I see "X",".1_2"
 I see "X",".2_3"
 I see "X",".3_1"
 I see "X",".3_3"
 I see "O",".2_1"
 I see "O",".2_2"
 I see "O",".1_3"
 I see "O",".3_2"
 PASSED 

HistoryDetailsCest: Redirect to history
Signature: Tests\Acceptance\HistoryDetailsCest:RedirectToHistory
Test: tests/Acceptance/HistoryDetailsCest.php:RedirectToHistory
Scenario --
 I am on page "/history"
 I see link "← Back to Game"
 I click "//div[1]/ul/li[1]/a"
 I see link "← Back to Game History"
 I click "← Back to Game History"
 I see link "← Back to Game"
 PASSED 

NewGameCest: Home page validation
Signature: Tests\Acceptance\NewGameCest:HomePageValidation
Test: tests/Acceptance/NewGameCest.php:HomePageValidation
Scenario --
 I am on page "/"
 I see in title "TicTacToe"
 I see element "[name=game]"
 PASSED 

NewGameCest: Negative validation
Signature: Tests\Acceptance\NewGameCest:NegativeValidation
Test: tests/Acceptance/NewGameCest.php:NegativeValidation
Scenario --
 I am on page "/"
 I fill field "[name=first-move]","A"
 I click "[name=game]"
 I see element "[test=error]"
 I don't see "[name=board]"
 PASSED 

NewGameCest: No value validation
Signature: Tests\Acceptance\NewGameCest:NoValueValidation
Test: tests/Acceptance/NewGameCest.php:NoValueValidation
Scenario --
 I am on page "/"
 I click "[name=game]"
 I see element "[test=generalError]"
 I don't see "[name=board]"
 PASSED 

NewGameCest: New game x
Signature: Tests\Acceptance\NewGameCest:NewGameX
Test: tests/Acceptance/NewGameCest.php:NewGameX
Scenario --
 I am on page "/"
 I fill field "[name=first-move]","X"
 I click "[name=game]"
 I see element "[name=board]"
 I click ".1_1"
 I see "X",".1_1"
 I don't see "[test=generalError]"
 I don't see "[test=error]"
 PASSED 

NewGameCest: New game o
Signature: Tests\Acceptance\NewGameCest:NewGameO
Test: tests/Acceptance/NewGameCest.php:NewGameO
Scenario --
 I am on page "/"
 I fill field "[name=first-move]","O"
 I click "[name=game]"
 I see element "[name=board]"
 I click ".1_1"
 I see "O",".1_1"
 I don't see "[test=generalError]"
 I don't see "[test=error]"
 PASSED 

XWinCest: X win
Signature: Tests\Acceptance\XWinCest:XWin
Test: tests/Acceptance/WinCest.php:XWin
Scenario --
 I am on page "/"
 I fill field "[name=first-move]","X"
 I click "[name=game]"
 I see element "[name=board]"
 I click ".1_1"
 I see "X",".1_1"
 I don't see "[test=generalError]"
 I don't see "[test=error]"
 I click ".2_1"
 I click ".1_2"
 I click ".2_2"
 I click ".1_3"
 I see "X - WINs",".alert-info"
 I don't see "[test=generalError]"
 I don't see "[test=error]"
 PASSED 

XWinCest: O win
Signature: Tests\Acceptance\XWinCest:OWin
Test: tests/Acceptance/WinCest.php:OWin
Scenario --
 I am on page "/"
 I fill field "[name=first-move]","X"
 I click "[name=game]"
 I see element "[name=board]"
 I click ".1_1"
 I see "X",".1_1"
 I don't see "[test=generalError]"
 I don't see "[test=error]"
 I click ".2_1"
 I click ".3_2"
 I click ".2_2"
 I click ".1_3"
 I click ".2_3"
 I see "O - WINs",".alert-info"
 I don't see "[test=generalError]"
 I don't see "[test=error]"
 PASSED 

-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Time: 00:03.082, Memory: 14.00 MB

OK (16 tests, 96 assertions)
```
