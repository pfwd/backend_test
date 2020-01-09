<?php
declare(strict_types=1);

namespace App\Tests;

use App\Entity\Quote;
use App\Formatter\ShoutFormatDecorator;
use App\Formatter\Formatter;
use Codeception\Test\Unit;

class QuoteFormatterTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected UnitTester $tester;

    public function testShout(): void
    {
        $quote = new Quote('This is a test quote');
        $shoutDecorator = new ShoutFormatDecorator();
        $translator = new Formatter($shoutDecorator);
        $this->assertSame('THIS IS A TEST QUOTE!', $translator->format($quote->getContent()));
    }

}