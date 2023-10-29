# Project 2
+ By: Andrii Poltoratskyi
+ URL: <http://p2.anphp.me/>

## Game planning

This is a simple TicTacToe game. I use POST to pass data to process.php page where the main logic stores.
I chose Design C as a main form processing flow since it allows user to submit form multiple times and "stays" on the same page all the time.

+ Create a table (board) by using *for* loop
+ Each cell contains a button
+ Post button coordinates $i and $j as a string (in the form)
+ Convert array $board to a string
+ Post $board as a sting via POST (in the same form)
+ Merge new Cell coordinated received from POST to $board if this cell is empty
+ Seach for winning combination in $board by matching current $board array with prepared $winningCombinations array
+ If there is a match - display Winning message and Reset button


## Outside resources
+ PHP forms documentation <https://www.w3schools.com/php/php_forms.asp>


## Notes for instructor
After the first project I installed Xdebug on my server and configured it in VS code. However, I still cannot understand how to use breakpoints when navigating in the browser. Console debugging works Ok but it is not enough when you need to debug user inputs. It would be great to have some tutorial on this topic.

Also I was not able to figure out why POST cannot send json_encode($var) value as a string to process.php page. It works only if I use urlencode function.
