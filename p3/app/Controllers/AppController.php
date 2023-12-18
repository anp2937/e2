<?php

namespace App\Controllers;

class AppController extends Controller
{
    private $history = [];

    public function fetchHistory()
    {
        if (empty($this->history)) {
            // Fetch all records from the history table if the history variable is empty
            $this->history = $this->app->db()->all('history');
        }
    }

    /**
     * This method is triggered by the route "/"
     */

    public function index()
    {

        $boardId = $this->app->sessionGet('board_id') ?: 1;
        $board = $this->app->db()->findById('board', $boardId);
        $error = $this->app->old('error');
        $info = $this->app->old('info');
        $newGame = ($this->app->old('newGame') === null) ? true : false;

        $wins = $this->getWinCombinations();


        // compare each winning combination against current board
        // check previous turn to know what player did a move.
        if (!$newGame) {

            $turn = $this->app->db()->findByColumn('round', 'board_id', '=', $boardId);
            $turn = ($turn[0]['turn'] == "X") ? "O" : "X";

            $t = 0;
            $date = date('Y-m-d H:i:s');
            $data = [
                'board_id' => $boardId,
                'date' => $date,
                'winner' => $turn
            ];
            foreach ($wins as $win) {
                foreach($win as $key => $value) {
                    if ($board[$key] == $turn) {
                        $t += 1;
                    }
                }
                // check winner
                if ($t >= 3) {
                    $newGame = true;
                    $info = $turn." - WINs";
                    // write results to the "history table"
                    $this->app->db()->insert('history', $data);
                }
                $t = 0;
            }
            // check draw
            if (!in_array(null, $board, true)) {
                $newGame = true;
                $info = "Draw";
                $data['winner'] = $info;
                // write results to the "history table"
                $this->app->db()->insert('history', $data);
            }
        }

        return $this->app->view('index', [
            'board' => $board,
            'info' => $info,
            'newGame' => $newGame,
            'error' => $error,
        ]);
    }


    public function history()
    {

        $this->fetchHistory();

        return $this->app->view('history', [
            'email' => 'test@test.com',
            'history' => $this->history,
        ]);
    }

    public function details()
    {
        //get board id from url param
        $boardId = $this->app->param('boardId');

        if (is_null($boardId)) {
            $this->app->redirect('/history');
        }

        $roundDetails = $this->app->db()->findByColumn('board', 'id', '=', $boardId);
        $winner = $this->app->db()->findByColumn('history', 'board_id', '=', $boardId);

        return $this->app->view('details', [
            'board' => $roundDetails[0],
            'winner' => $winner[0]['winner'],
            'roundNumber' => $winner[0]['id']
        ]);
    }


    public function backHome()
    {
        return $this->app->redirect('/');
    }
    public function backHistory()
    {
        return $this->app->redirect('/history');
    }

    public function move()
    {
        $error = '';
        $info = '';
        // get active board ID
        $boardId = $this->app->sessionGet('board_id') ?: 1;
        // get previous turn
        $turn = $this->app->db()->findByColumn('round', 'board_id', '=', $boardId);
        $turn = $turn[0]['turn'];

        $cell = 'cell'.$this->app->input('cell');

        //check if the field is empty
        $row = $this->app->db()->findById('board', $boardId);
        if(!$row[$cell]) {
            $this->app->db()->run("UPDATE board SET `{$cell}` = '{$turn}' WHERE id = {$boardId}");
        } else {
            $error = 'this cell is not empty';
        }

        //switch turn
        $turn = ($turn == "X") ? "O" : "X";
        $this->app->db()->run("UPDATE round SET `turn` = '{$turn}' WHERE board_id = {$boardId}");

        //get $board from DB and pass it as a parameter
        return $this->app->redirect('/', ['cell' => $cell, 'error' => $error, 'newGame' => false]);
    }

    public function game()
    {
        // start new Game:
        // 1.create new row in 'board';
        $board = [
            'cell1_1' => null,
            'cell1_2' => null,
            'cell1_3' => null,
            'cell2_1' => null,
            'cell2_2' => null,
            'cell2_3' => null,
            'cell3_1' => null,
            'cell3_2' => null,
            'cell3_3' => null,
        ];
        $rowId = $this->app->db()->insert('board', $board);

        // 2.create new round entry in table round
        $this->app->validate([
            'first-move' => 'alpha|maxLength:1'
        ]);

        $firstMove = $this->app->input('first-move');

        if($firstMove !== "X" && $firstMove !== "x" && $firstMove !== "O" && $firstMove !== "o") {
            $error = "Please enter X or O";
            return $this->app->redirect('/', ['error' => $error]);
        }

        $round = [
            'board_id' => $rowId,
            'turn' => $firstMove,
        ];
        $this->app->db()->insert('round', $round);


        // 3. If new game started pass new rowID as a play board id to Session
        $this->app->sessionSet("board_id", $rowId);

        return $this->app->redirect('/', ['newGame' => false]);
    }

    protected function getWinCombinations()
    {

        // get winning combination as an array
        $winCombinations = $this->app->db()->all('win_combinations');

        // remove empty values
        foreach ($winCombinations as $combination) {
            $winCombinationsOnly[] = array_filter($combination, function ($value) {
                return $value !== "0";
            });
        }

        // remove id from each aray:
        foreach ($winCombinationsOnly as $combinationOnly) {
            unset($combinationOnly['id']);
            $wins[] = $combinationOnly;
        }
        return $wins;

    }

}