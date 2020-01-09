<?php
declare(strict_types=1);

namespace App\Tests;

use App\DataLoader\FileHandler;
use Codeception\Test\Unit;
use Exception;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

class FileHandlerTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected UnitTester $tester;

    public function testSetPath(): void
    {
        $file = new FileHandler();
        $file->setPath('../quotes.json');
        $this->assertSame('../quotes.json', $file->getPath());
    }

    public function testFileNotFoundException(): void
    {
        $this->tester->expectThrowable(
            FileNotFoundException::class,
            static function () {
                $file = new FileHandler();
                $file->setPath('file_cannot_be_found.json');
                $file->read();
            }
        );
    }

    /**
     * @throws Exception
     */
    public function testFileRead(): void
    {
        $file = new FileHandler();
        $file->setPath('quotes.json');
        $this->assertIsString($file->read());
    }

}