<?php

namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class HistoryDetailsCest
{
    public function XWinHistoryDetails(AcceptanceTester $I)
    {
        //create X win combination
        $I->amOnPage('/');

        $move = 'X';
        $next = 'O';

        $I->fillField('[name=first-move]', $move);

        $I->click('[name=game]');

        $I->click('.1_1');
        $I->click('.2_1');
        $I->click('.1_2');
        $I->click('.2_2');
        $I->click('.1_3');

        $I->see($move.' - WINs', '.alert-info');
        $I->dontSee('[test=generalError]');
        $I->dontSee('[test=error]');

        // check latest link to the board contains "X"
        $I->amOnPage('/history');
        $I->see('Winner- '.$move, "//div[1]/ul/li[1]/a");

        //click the link to open details page

        $I->click("//div[1]/ul/li[1]/a");

        //check winner
        $I->see('Winner - '.$move, "//body/h3");

        //check board details where X placed
        $I->see($move, '.1_1');
        $I->see($move, '.1_2');
        $I->see($move, '.1_3');


        // check board cell with O
        $I->see($next, '.2_1');
        $I->see($next, '.2_2');

        //check other cells empty
        $I->see('', '.2_3');
        $I->see('', '.3_1');
        $I->see('', '.3_2');
        $I->see('', '.3_3');
    }

    public function OWinHistoryDetails(AcceptanceTester $I)
    {
        //create X win combination
        $I->amOnPage('/');

        $move = 'O';
        $next = 'X';

        $I->fillField('[name=first-move]', $move);

        $I->click('[name=game]');

        $I->click('.1_1');
        $I->click('.2_1');
        $I->click('.1_2');
        $I->click('.2_2');
        $I->click('.1_3');

        $I->see($move.' - WINs', '.alert-info');
        $I->dontSee('[test=generalError]');
        $I->dontSee('[test=error]');

        // check latest link to the board contains "X"
        $I->amOnPage('/history');
        $I->see('Winner- '.$move, "//div[1]/ul/li[1]/a");

        //click the link to open details page

        $I->click("//div[1]/ul/li[1]/a");

        //check winner
        $I->see('Winner - '.$move, "//body/h3");

        //check board details where X placed
        $I->see($move, '.1_1');
        $I->see($move, '.1_2');
        $I->see($move, '.1_3');


        // check board cell with O
        $I->see($next, '.2_1');
        $I->see($next, '.2_2');

        //check other cells empty
        $I->see('', '.2_3');
        $I->see('', '.3_1');
        $I->see('', '.3_2');
        $I->see('', '.3_3');
    }

    public function DrawHistoryDetails(AcceptanceTester $I)
    {
        //create X win combination
        $I->amOnPage('/');

        $move = 'X';
        $next = 'O';

        $I->fillField('[name=first-move]', $move);

        $I->click('[name=game]');

        $I->click('.1_1');
        $I->click('.2_1');
        $I->click('.1_2');
        $I->click('.2_2');
        $I->click('.2_3');
        $I->click('.1_3');
        $I->click('.3_1');
        $I->click('.3_2');
        $I->click('.3_3');

        $I->dontSee('[test=generalError]');
        $I->dontSee('[test=error]');

        // check latest link to the board contains "X"
        $I->amOnPage('/history');
        $I->see('Winner- Draw', "//div[1]/ul/li[1]/a");
        $I->seeLink('← Back to Game');

        //click the link to open details page

        $I->click("//div[1]/ul/li[1]/a");

        //check winner
        $I->see('Winner - Draw', "//body/h3");
        // check "return to history" link

        $I->seeLink('← Back to Game History');


        //check board details where X placed
        $I->see($move, '.1_1');
        $I->see($move, '.1_2');
        $I->see($move, '.2_3');
        $I->see($move, '.3_1');
        $I->see($move, '.3_3');

        // check board cell with O
        $I->see($next, '.2_1');
        $I->see($next, '.2_2');
        $I->see($next, '.1_3');
        $I->see($next, '.3_2');
    }

    public function RedirectToHistory(AcceptanceTester $I)
    {
        $I->amOnPage('/history');
        $I->seeLink('← Back to Game');

        $I->click("//div[1]/ul/li[1]/a");
        $I->seeLink('← Back to Game History');

        $I->click('← Back to Game History');
        $I->seeLink('← Back to Game');
    }
}