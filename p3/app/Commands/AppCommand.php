<?php

namespace App\Commands;

class AppCommand extends Command
{
    public function fresh()
    {
        $this->migrate();
        $this->seedWinCombinations();
    }

    public function migrate()
    {
        $this->app->db()->createTable('round', [
            'board_id' => 'int',
            'turn' => 'varchar(1)',
        ]);

        $this->app->db()->createTable('board', [
            'cell1_1' => 'varchar(1)',
            'cell1_2' => 'varchar(1)',
            'cell1_3' => 'varchar(1)',
            'cell2_1' => 'varchar(1)',
            'cell2_2' => 'varchar(1)',
            'cell2_3' => 'varchar(1)',
            'cell3_1' => 'varchar(1)',
            'cell3_2' => 'varchar(1)',
            'cell3_3' => 'varchar(1)',
        ]);

        $this->app->db()->createTable('history', [
            'board_id' => 'int',
            'date' => 'datetime',
            'winner' => 'varchar(5)',
        ]);

        $this->app->db()->createTable('win_combinations', [
            'cell1_1' => 'varchar(1)',
            'cell1_2' => 'varchar(1)',
            'cell1_3' => 'varchar(1)',
            'cell2_1' => 'varchar(1)',
            'cell2_2' => 'varchar(1)',
            'cell2_3' => 'varchar(1)',
            'cell3_1' => 'varchar(1)',
            'cell3_2' => 'varchar(1)',
            'cell3_3' => 'varchar(1)',
        ]);

        dump('Migration complete; check the database for your new tables.');
    }


    public function seedWinCombinations()
    {
        $wins = $this->app->path('database/winCombinations.json');
        $wins = file_get_contents($wins);
        $wins = json_decode($wins, true);

        foreach ($wins as $win) {

            # Insert win combination
            $this->app->db()->insert('win_combinations', $win);
        }
        dump('wining combinations table has been seeded');
    }
}