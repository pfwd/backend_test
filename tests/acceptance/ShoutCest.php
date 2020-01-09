<?php namespace App\Tests;

class ShoutCest
{
    // tests
    public function tryToShoutWithoutNameTest(AcceptanceTester $I): void
    {
        $I->amOnPage('/shout');
        $I->canSeeResponseCodeIs(404);
    }

    public function tryToShoutWithNumbersTest(AcceptanceTester $I): void
    {
        $I->amOnPage('/shout/1234');
        $I->canSeeResponseCodeIs(404);
    }

    public function tryToShoutWithSteveJobs(AcceptanceTester $I): void
    {
        $I->amOnPage('/shout/steve-jobs');
        $I->canSeeResponseCodeIs(200);
    }

    public function tryToShoutWithUnknownName(AcceptanceTester $I): void
    {
        $I->amOnPage('/shout/this-name-is-unknown');
        $I->canSeeResponseCodeIs(404);
    }
}
