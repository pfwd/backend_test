<?php
declare(strict_types=1);

namespace App\Tests;

use App\Entity\Quote;
use Codeception\Test\Unit;

class QuoteTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected UnitTester $tester;

    public function testGetText(): void
    {
        $quote = new Quote();
        $quote->setContent('The only way to do great work is to love what you do');
        $this->assertSame('The only way to do great work is to love what you do', $quote->getContent());
    }

    public function testToString(): void
    {
        $quote = new Quote();
        $quote->setContent('The only way to do great work is to love what you do');
        $this->assertSame('The only way to do great work is to love what you do', (string)$quote);
    }

    public function testGetId(): void
    {
        $quote = new Quote();
        $this->assertNotNull($quote->getId());
        $this->assertIsString($quote->getId());
    }
}