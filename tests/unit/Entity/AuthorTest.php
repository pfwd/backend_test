<?php
declare(strict_types=1);

namespace App\Tests;

use App\Entity\Author;
use App\Entity\Quote;
use Codeception\Test\Unit;

class AuthorTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected UnitTester $tester;

    public function testGetName(): void
    {
        $author = new Author();
        $author->setName('Steve Jobs');
        $this->assertSame('Steve Jobs', $author->getName());
    }

    public function testGetId(): void
    {
        $author = new Author();
        $this->assertNotNull($author->getId());
        $this->assertIsString($author->getId());
    }

    public function testToString(): void
    {
        $author = new Author();
        $author->setName('Steve Jobs');
        $this->assertSame('Steve Jobs', (string)$author);
    }

    public function testAddQuote(): void
    {
        $author = new Author();
        $author->addQuote(new Quote('hello world'));
        $this->assertCount(1, $author->getQuotes());
    }
    public function testGetQuotes(): void
    {
        $quotes = [
            new Quote('Hello World'),
            new Quote('Hello Again'),
        ];

        $author = new Author();
        $author->setQuotes($quotes);

        $this->assertTrue($author->getQuotes()->contains($quotes[0]));
        $this->assertTrue($author->getQuotes()->contains($quotes[1]));
    }
}