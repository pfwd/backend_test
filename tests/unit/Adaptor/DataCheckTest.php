<?php
declare(strict_types=1);

namespace App\Tests;

use App\DataLoader\FileAdaptor;
use App\DataLoader\FileHandler;
use App\Entity\Author;
use Codeception\Test\Unit;
use Exception;

class DataCheckTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected UnitTester $tester;

    /**
     * @throws Exception
     */
    public function testFindSteveJobs(): void
    {
        $file = new FileHandler();
        $file->setPath('quotes.json');

        $adaptor = new FileAdaptor($file);
        $authors = $adaptor->hydrate();
        /* @var Author $author */
        $found = false;
        foreach ($authors as $author) {
            if ('Steve Jobs' === $author->getName()) {
                $found = true;
                $this->assertCount(2, $author->getQuotes());
            }
        }
        $this->assertTrue($found);
    }

    /**
     * @throws Exception
     */
    public function testFindAudreyHepburn(): void
    {
        $file = new FileHandler();
        $file->setPath('quotes.json');

        $adaptor = new FileAdaptor($file);
        $authors = $adaptor->hydrate();
        /* @var Author $author */
        $found = false;
        foreach ($authors as $author) {
            if ('Audrey Hepburn' === $author->getName()) {
                $found = true;
                $this->assertCount(1, $author->getQuotes());
            }
        }
        $this->assertTrue($found);
    }
}