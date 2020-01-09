<?php namespace App\Tests;

use Codeception\Util\HttpCode;

class ShoutQuoteCest
{
    // tests
    public function shoutQuotesViaAPI(ApiTester $I): void
    {
        $I->sendGet('/shout/steve-jobs');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType(['string']);
    }

    public function shoutQuoteWithLimitViaAPI(ApiTester $I): void
    {
        $I->sendGet('/shout/steve-jobs?limit=1');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType(['string']);
    }

    public function shoutQuoteWithInValidLimitViaAPI(ApiTester $I): void
    {
        $I->sendGet('/shout/steve-jobs?limit=foobar');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType(['string']);
    }

    public function shoutQuoteWithZeroLimitViaAPI(ApiTester $I): void
    {
        $I->sendGet('/shout/steve-jobs?limit=0');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType(['string']);
    }

    public function shoutQuoteWithUnknownAuthorViaAPI(ApiTester $I): void
    {
        $I->sendGet('/shout/foo-bar');
        $I->seeResponseCodeIs(HttpCode::NOT_FOUND);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType(['error' => 'string']);
    }

    public function postAShoutViaAPI(ApiTester $I): void
    {
        $I->sendPOST('/shout/foo-bar');
        $I->seeResponseCodeIs(HttpCode::METHOD_NOT_ALLOWED);
    }

    public function shoutWithALimitGreaterThanTenViaAPI(ApiTester $I): void
    {
        $I->sendGet('/shout/steve-jobs?limit=11');
        $I->seeResponseCodeIs(HttpCode::BAD_REQUEST);
        $I->seeResponseMatchesJsonType(['error' => 'string']);
    }
}
