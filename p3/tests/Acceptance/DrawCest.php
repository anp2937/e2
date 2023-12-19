<?php

namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class DrawCest
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
    public function Draw(AcceptanceTester $I)
    {
        //create a Draw combination

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
    }
}
