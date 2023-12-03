<?php

namespace App\Controllers;

class AppController extends Controller
{
    /**
     * This method is triggered by the route "/"
     */
    public function index()
    {
        $board = [[' ', ' ', ' '], [' ', ' ', ' '], [' ', ' ', ' ']];
        //replace $board with a value from the parameter (coming from method 'move')
        $cell = $this->app->old('cell');

        return $this->app->view('index', [
            'board' => $board,
            'cell' => $cell
        ]);
    }
    public function history()
    {
        return $this->app->view('history', [
            'email' => 'test@test.com'
        ]);
    }

    public function details()
    {
        return $this->app->view('details', [
            'email' => 'test@test.com'
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
        $cell = $this->app->input('cell');
        //dump($cell);

        //get $board from DB and pass it as a parameter
        return $this->app->redirect('/', ['cell' => $cell]);
    }
}