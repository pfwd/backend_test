<?php
declare(strict_types=1);

namespace App\Tests;

use App\DataLoader\FileAdaptor;
use App\DataLoader\FileHandler;
use App\Entity\Author;
use Codeception\Test\Unit;

class FileAdaptorTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected UnitTester $tester;

    public function testHydrateFromFile(): void
    {
        $file = new FileHandler();
        $file->setPath('quotes.json');

        $adaptor = new FileAdaptor($file);
        $data = $adaptor->hydrate();
        $this->assertIsArray($data);
        $this->assertInstanceOf(Author::class, $data[0]);
    }


}