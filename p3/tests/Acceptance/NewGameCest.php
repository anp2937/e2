<?php

namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class NewGameCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function HomePageValidation(AcceptanceTester $I)
    {
        //go to homepage
        $I->amOnPage('/');

        //check title
        $I->seeInTitle('TicTacToe');

        // checkt button "start new game" is available on home page
        $I->seeElement('[name=game]');
    }

    public function NegativeValidation(AcceptanceTester $I)
    {
        $I->amOnPage('/');

        $move = 'A';
        $I->fillField('[name=first-move]', $move);

        $I->click('[name=game]');

        $I->seeElement('[test=error]');
        $I->dontSee('[name=board]');
    }

    public function NoValueValidation(AcceptanceTester $I)
    {
        $I->amOnPage('/');

        $I->click('[name=game]');

        $I->seeElement('[test=generalError]');
        $I->dontSee('[name=board]');
    }

    public function NewGameX(AcceptanceTester $I)
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

    public function NewGameO(AcceptanceTester $I)
    {
        $I->amOnPage('/');

        $move = 'O';

        $I->fillField('[name=first-move]', $move);

        $I->click('[name=game]');

        $I->seeElement('[name=board]');

        $I->click('.1_1');

        $I->see($move, '.1_1');
        $I->dontSee('[test=generalError]');
        $I->dontSee('[test=error]');
    }
}
