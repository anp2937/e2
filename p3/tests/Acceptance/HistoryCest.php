<?php

namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class HistoryCest
{
    // tests
    public function XWinHistory(AcceptanceTester $I)
    {
        //create X win combination
        $I->amOnPage('/');

        $move = 'X';

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
    }

    public function OWinHistory(AcceptanceTester $I)
    {
        //create X win combination
        $I->amOnPage('/');

        $move = 'O';

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
    }

    public function DrawHistory(AcceptanceTester $I)
    {
        //create X win combination
        $I->amOnPage('/');

        $move = 'X';

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

        $I->see('Draw', '.alert-info');
        $I->dontSee('[test=generalError]');
        $I->dontSee('[test=error]');

        // check latest link to the board contains "X"
        $I->amOnPage('/history');
        $I->see('Draw', "//div[1]/ul/li[1]/a");
    }

    public function RedirectToGame(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->seeLink('Game History');

        $I->click('Game History');
        $I->seeLink('← Back to Game');

        $I->click('← Back to Game');
        $I->seeLink('Game History');
    }
}