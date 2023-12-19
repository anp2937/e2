<?php

namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class XWinCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/');

        $move = 'X';

        $I->fillField('[name=first-move]', $move);

        $I->click('[name=game]');

        $I->seeElement('[name=board]');

        $I->click('.1_1');

        $I->see($move, '.1_1');
        $I->dontSee('[test=generalError]');
        $I->dontSee('[test=error]');
    }

    // tests
    public function XWin(AcceptanceTester $I)
    {
        //create X win combination

        $I->click('.2_1');
        $I->click('.1_2');
        $I->click('.2_2');
        $I->click('.1_3');

        $I->see('X - WINs', '.alert-info');
        $I->dontSee('[test=generalError]');
        $I->dontSee('[test=error]');
    }

    public function OWin(AcceptanceTester $I)
    {
        //create O win combination

        $I->click('.2_1');
        $I->click('.3_2');
        $I->click('.2_2');
        $I->click('.1_3');
        $I->click('.2_3');

        $I->see('O - WINs', '.alert-info');
        $I->dontSee('[test=generalError]');
        $I->dontSee('[test=error]');
    }
}